<?php

/*------------------------------------------------------------------------------
  $Id$

  AbanteCart, Ideal OpenSource Ecommerce Solution
  http://www.AbanteCart.com

  Copyright © 2011-2021 Belavier Commerce LLC

  This source file is subject to Open Software License (OSL 3.0)
  License details is bundled with this package in the file LICENSE.txt.
  It is also available at this URL:
  <http://www.opensource.org/licenses/OSL-3.0>

 UPGRADE NOTE:
   Do not edit or add to this file if you wish to upgrade AbanteCart to newer
   versions in the future. If you wish to customize AbanteCart for your
   needs please refer to http://www.AbanteCart.com for more information.
------------------------------------------------------------------------------*/
if (!defined('DIR_CORE')) {
    header('Location: static_pages/');
}

class ControllerPagesCheckoutGuestStep2 extends AController
{
    public $error = [];

    public function main()
    {
        //init controller data
        $this->extensions->hk_InitData($this, __FUNCTION__);

        $session =& $this->session->data;

        //is this an embed mode
        $cart_rt = 'checkout/cart';
        if ($this->config->get('embed_mode') == true) {
            $cart_rt = 'r/checkout/cart/embed';
        }

        if (!$this->cart->hasProducts()
            || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))
        ) {
            redirect($this->html->getSecureURL($cart_rt));
        }

        //validate if order min/max are met
        if (!$this->cart->hasMinRequirement() || !$this->cart->hasMaxRequirement()) {
            redirect($this->html->getSecureURL($cart_rt));
        }

        if ($this->customer->isLogged()) {
            redirect($this->html->getSecureURL('checkout/shipping'));
        }

        if (!$this->config->get('config_guest_checkout') || $this->cart->hasDownload()) {
            $session['redirect'] = $this->html->getSecureURL('checkout/shipping');
            redirect($this->html->getSecureURL('account/login'));
        }

        if (!isset($session['guest'])) {
            redirect($this->html->getSecureURL('checkout/guest_step_1'));
        }

        if (!$this->cart->hasShipping()) {
            unset(
                $session['shipping_method'],
                $session['shipping_methods']
            );
            $this->tax->setZone($session['country_id'], $session['zone_id']);
        }

        $this->document->setTitle($this->language->get('heading_title'));

        if ($this->request->is_POST()) {
            if (!$this->csrftoken->isTokenValid()) {
                $this->error['warning'] = $this->language->get('error_unknown');
            } else {
                if (isset($this->request->post['coupon'])) {
                    if (isset($this->request->post['reset_coupon'])) {
                        //remove coupon
                        unset($session['coupon']);
                        $session['success'] = $this->language->get('text_coupon_removal');

                        //process data
                        $this->extensions->hk_ProcessData($this, 'reset_coupon');
                        redirect($this->html->getSecureURL('checkout/guest_step_3'));
                    } else {
                        if ($this->_validateCoupon()) {
                            $session['coupon'] = $this->request->post['coupon'];
                            $session['success'] = $this->language->get('text_success');

                            if ($this->cart->getFinalTotal() == 0 && $this->request->get['mode'] != 'edit') {
                                $session['payment_method'] = [
                                    'id'    => 'no_payment_required',
                                    'title' => $this->language->get('no_payment_required'),
                                ];
                            }
                            //process data
                            $this->extensions->hk_ProcessData($this, 'apply_coupon');
                            redirect($this->html->getSecureURL('checkout/guest_step_3'));
                        }
                    }
                }

                if (!isset($this->request->post['coupon']) && $this->validate()) {
                    if (isset($this->request->post['shipping_method'])) {
                        $shipping = explode('.', $this->request->post['shipping_method']);
                        $session['shipping_method'] = $session['shipping_methods'][$shipping[0]]['quote'][$shipping[1]];
                    }
                    if ($this->cart->getFinalTotal() == 0 && $this->request->get['mode'] != 'edit') {
                        $session['payment_method'] = [
                            'id'    => 'no_payment_required',
                            'title' => $this->language->get('no_payment_required'),
                        ];
                    } else {
                        $session['payment_method'] =
                            $session['payment_methods'][$this->request->post['payment_method']];
                    }
                    $session['comment'] = $this->request->post['comment'];
                    $this->extensions->hk_ProcessData($this);
                    redirect($this->html->getSecureURL('checkout/guest_step_3'));
                }
            }
        }

        $this->loadModel('checkout/extension');
        // Shipping Methods
        $ext_setgs = [];
        if ($this->cart->hasShipping()
            && (!isset($session['shipping_methods'])
                || !$this->config->get('config_shipping_session'))
        ) {
            $quote_data = [];

            $results = $this->model_checkout_extension->getExtensions('shipping');
            foreach ($results as $result) {
                /** @var ModelExtensionDefaultFlatRateShipping $mdl */
                $mdl = $this->loadModel('extension/'.$result['key']);
                if (isset($session['guest']['shipping'])) {
                    $quote = $mdl->getQuote($session['guest']['shipping']);
                } else {
                    $quote = $mdl->getQuote($session['guest']);
                }

                if ($quote) {
                    $quote_data[$result['key']] = [
                        'title'      => $quote['title'],
                        'quote'      => $quote['quote'],
                        'sort_order' => $quote['sort_order'],
                        'error'      => $quote['error'],
                    ];

                    //# Add storefront icon if available
                    $ext_setgs = $this->model_checkout_extension->getSettings($result['key']);
                    $icon = $ext_setgs[$result['key']."_shipping_storefront_icon"];
                    if (has_value($icon)) {
                        $icon_data = $this->model_checkout_extension->getSettingImage($icon);
                        $icon_data['image'] = is_numeric($icon)
                            ? $icon_data['type_dir'].'/'.$icon_data['resource_path']
                            : $icon;
                        $quote_data[$result['key']]['icon'] = $icon_data;
                    }
                }
            }

            $sort_order = [];
            foreach ($quote_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }
            array_multisort($sort_order, SORT_ASC, $quote_data);
            $session['shipping_methods'] = $quote_data;
        }

        // Payment Methods
        $total = $this->cart->buildTotalDisplay();
        $this->data['order_totals'] = $total;
        $method_data = [];
        $psettings = [];
        $results = $this->model_checkout_extension->getExtensions('payment');
        foreach ($results as $result) {
            #filter only allowed payment methods based on total min/max
            $pkey = $result['key'];
            $psettings[$pkey] = $this->model_checkout_extension->getSettings($pkey);
            $min = $psettings[$pkey][$pkey."_payment_minimum_total"];
            $max = $ext_setgs[$pkey][$pkey."_payment_maximum_total"];
            if ((has_value($min) && $total['total'] < $min)
                || (has_value($max) && $total['total'] > $max)
            ) {
                continue;
            }

            /** @var ModelExtensionDefaultCOD $mdl */
            $mdl = $this->loadModel('extension/'.$pkey);
            $method = $mdl->getMethod($session['guest']);
            if ($method) {
                $method_data[$pkey] = $method;
                $method_data[$pkey]['extension_id'] = $result['extension_id'];

                //# Add storefront icon if available
                $icon = $psettings[$pkey][$pkey."_payment_storefront_icon"];
                if (has_value($icon)) {
                    $icon_data = $this->model_checkout_extension->getSettingImage($icon);
                    $icon_data['image'] = is_numeric($icon)
                        ? $icon_data['type_dir'].'/'.$icon_data['resource_path']
                        : $icon;
                    $method_data[$result['key']]['icon'] = $icon_data;
                }
                //check if this is a redirect type of the payment
                if ($psettings[$pkey][$pkey."_redirect_payment"]) {
                    $method_data[$pkey]['is_redirect_payment'] = true;
                }
            }
        }
        //sort payments
        $sort_order = [];
        foreach ($method_data as $key => $value) {
            $sort_order[$key] = $value['sort_order'];
        }

        array_multisort($sort_order, SORT_ASC, $method_data);
        $session['payment_methods'] = $method_data;

        $skip_step = false;
        $method_name = '';
        //# If only 1 shipping and 1 payment it is set to be defaulted, select and skip and redirect to checkout guest_step_3
        if (count((array) $session['shipping_methods']) == 1) {
            //set only method
            $only_method = $session['shipping_methods'];
            foreach ($only_method as $method_name => $value) {
                #Check config if we allowed to set this shipping and skip the step
                $ext_config = $this->model_checkout_extension->getSettings($method_name);
                if ($ext_config[$method_name."_autoselect"]) {
                    //take first quote. This needs to be accounted for if configure shipping to be autoselected
                    if (sizeof($only_method[$method_name]['quote']) == 1) {
                        $session['shipping_method'] = current($only_method[$method_name]['quote']);
                        $skip_step = true;
                    }
                }
            }
        } else {
            if (count((array) $session['shipping_methods']) == 0 && !$this->cart->hasShipping()) {
                //if not shipment, skip
                $skip_step = true;
            }
        }

        if ($skip_step && $this->request->get['mode'] != 'edit') {
            $ac_payments = [];
            #Check config if selected shipping method have accepted payments restriction
            $ship_ext_config = $this->model_checkout_extension->getSettings($method_name);
            $accept_payment_ids = $ship_ext_config[$method_name."_accept_payments"];
            if (is_array($accept_payment_ids) && count($accept_payment_ids)) {
                #filter only allowed payment methods based on shipping
                foreach ($session['payment_methods'] as $key => $res_payment) {
                    if (in_array($res_payment['extension_id'], $accept_payment_ids)) {
                        $ac_payments[$key] = $res_payment;
                    }
                }
            } else {
                $ac_payments = $session['payment_methods'];
            }

            if (count($ac_payments) == 1) {
                //set only method
                $only_method = $ac_payments;
                reset($only_method);
                $pkey = key($only_method);
                if ($psettings[$pkey][$pkey."_autoselect"]) {
                    $session['payment_method'] = $only_method[$pkey];
                    redirect($this->html->getSecureURL('checkout/guest_step_3'));
                }
            }
        }

        $this->document->resetBreadcrumbs();
        $this->document->addBreadcrumb(
            [
                'href'      => $this->html->getHomeURL(),
                'text'      => $this->language->get('text_home'),
                'separator' => false,
            ]
        );
        $this->document->addBreadcrumb(
            [
                'href'      => $this->html->getSecureURL($cart_rt),
                'text'      => $this->language->get('text_cart'),
                'separator' => $this->language->get('text_separator'),
            ]
        );
        $this->document->addBreadcrumb(
            [
                'href'      => $this->html->getSecureURL('checkout/guest_step_1'),
                'text'      => $this->language->get('text_guest_step_1'),
                'separator' => $this->language->get('text_separator'),
            ]
        );
        $this->document->addBreadcrumb(
            [
                'href'      => $this->html->getSecureURL('checkout/guest_step_2'),
                'text'      => $this->language->get('text_guest_step_2'),
                'separator' => $this->language->get('text_separator'),
            ]
        );

        $this->data['text_payment_methods'] = $this->language->get('text_payment_methods');
        $this->data['text_coupon'] = $this->language->get('text_coupon');
        $this->data['entry_coupon'] = $this->language->get('entry_coupon');

        if (isset($session['error'])) {
            $this->view->assign('error_warning', $session['error']);
            unset($session['error']);
        } elseif (isset($this->error['warning'])) {
            $this->view->assign('error_warning', $this->error['warning']);
        } else {
            $this->view->assign('error_warning', '');
        }

        $this->view->assign('success', $session['success']);
        if (isset($session['success'])) {
            unset($session['success']);
        }
        $mode = $this->request->get['mode'] ? : '';
        $action = $this->html->getSecureURL(
            'checkout/guest_step_2',
            ($mode ? '&mode='.$mode : ''),
            true
        );

        if ($this->config->get('coupon_status')) {
            $this->data['coupon_status'] = $this->config->get('coupon_status');
            $coupon_form = $this->dispatch('blocks/coupon_codes', ['action' => $action]);
            $this->data['coupon_form'] = $coupon_form->dispatchGetOutput();
            unset($coupon_form);
        }

        $item = $this->html->buildElement(
            [
                'type'  => 'button',
                'name'  => 'change_address',
                'style' => 'button',
                'text'  => $this->language->get('button_change_address'),
            ]
        );
        $this->data['change_address'] = $item->getHTML();

        if (isset($session['shipping_methods']) && !$session['shipping_methods']) {
            $this->view->assign('error_warning', $this->language->get('error_no_shipping'));
        }

        $form = new AForm();
        $form->setForm(['form_name' => 'guest']);
        $this->data['form']['form_open'] = $form->getFieldHtml(
            [
                'type'   => 'form',
                'name'   => 'guest',
                'action' => $action,
                'csrf'   => true,
            ]
        );

        $this->data['shipping_methods'] = $session['shipping_methods'] ? : [];
        $shipping = array_key_exists('shipping_method', $this->request->post) && $this->request->post['shipping_method']
            ? $this->request->post['shipping_method']
            : $session['shipping_method']['id'];
        if ($this->data['shipping_methods']) {
            foreach ($this->data['shipping_methods'] as $k => $v) {
                if ($v['quote'] && is_array($v['quote'])) {
                    foreach ($v['quote'] as $key => $val) {
                        $this->data['shipping_methods'][$k]['quote'][$key]['radio'] = $form->getFieldHtml(
                            [
                                'type'    => 'radio',
                                'id'      => $val['id'],
                                'name'    => 'shipping_method',
                                'options' => [$val['id'] => ''],
                                'value'   => ($shipping == $val['id']),
                            ]
                        );
                    }
                }
            }
        } else {
            $this->data['shipping_methods'] = [];
        }

        $payment = array_key_exists('payment_method', $this->request->post) && $this->request->post['payment_method']
            ? $this->request->post['payment_method']
            : $session['payment_method']['id'];

        if ($session['payment_methods']) {
            if ($session['shipping_methods']) {
                //build array with payments available per each shipping
                foreach ($session['shipping_methods'] as $method_name => $method_val) {
                    #Check config of selected shipping method and see if we have accepted payments restriction
                    $ship_ext_config = $this->model_checkout_extension->getSettings($method_name);
                    $accept_payment_ids = $ship_ext_config[$method_name."_accept_payments"];
                    if (is_array($accept_payment_ids) && count($accept_payment_ids)) {
                        #filter only allowed payment methods
                        $ac_payments = [];
                        foreach ($session['payment_methods'] as $key => $res_payment) {
                            if (in_array($res_payment['extension_id'], $accept_payment_ids)) {
                                $ac_payments[$key] = $res_payment;
                            }
                        }
                    } else {
                        $ac_payments = $session['payment_methods'];
                    }
                    foreach ($ac_payments as $key => $value) {
                        $selected = false;
                        if ($payment == $value['id']) {
                            $selected = true;
                        } else {
                            if ($psettings[$key][$key."_autoselect"]) {
                                $selected = true;
                            }
                        }
                        $this->data['payment_methods'][$method_name][$key] = $value;
                        $this->data['payment_methods'][$method_name][$key]['radio'] = $form->getFieldHtml(
                            [
                                'type'    => 'radio',
                                'name'    => 'payment_method',
                                'options' => [$value['id'] => ''],
                                'value'   => $selected,
                            ]
                        );
                    }
                }
            } else {
                //no shipping available show one set of payments
                foreach ($session['payment_methods'] as $key => $value) {
                    $selected = false;
                    if ($payment == $value['id']) {
                        $selected = true;
                    } else {
                        if ($psettings[$key][$key."_autoselect"]) {
                            $selected = true;
                        }
                    }
                    $this->data['payment_methods']['no_shipping'][$key] = $value;
                    $this->data['payment_methods']['no_shipping'][$key]['radio'] = $form->getFieldHtml(
                        [
                            'type'    => 'radio',
                            'name'    => 'payment_method',
                            'options' => [$value['id'] => ''],
                            'value'   => $selected,
                        ]
                    );
                }
            }
        } else {
            $this->data['payment_methods'] = [];
        }

        $this->data['comment'] = array_key_exists('comment', $this->request->post) && $this->request->post['comment']
            ? $this->request->post['comment']
            : $session['comment'];
        $this->data['form']['comment'] = $form->getFieldHtml(
            [
                'type'  => 'textarea',
                'name'  => 'comment',
                'value' => $this->data['comment'],
                'attr'  => ' rows="3" style="width: 99%" ',
            ]
        );

        if ($this->config->get('config_checkout_id')) {
            $this->loadModel('catalog/content');
            $content_info = $this->model_catalog_content->getContent($this->config->get('config_checkout_id'));
            if ($content_info) {
                $this->data['text_agree'] = $this->language->get('text_agree');
                $this->data['text_agree_href'] = $this->html->getURL(
                    'r/content/content/loadInfo',
                    '&content_id='.$this->config->get('config_checkout_id')
                );
                $this->data['text_agree_href_text'] = $content_info['title'];
            } else {
                $this->data['text_agree'] = '';
            }
        } else {
            $this->data['text_agree'] = '';
        }

        if ($this->data['text_agree']) {
            $this->data['form']['agree'] = $form->getFieldHtml(
                [
                    'type'    => 'checkbox',
                    'name'    => 'agree',
                    'value'   => '1',
                    'checked' => ($this->request->post['agree'] ? true : false),
                ]
            );
        }

        $this->data['agree'] = $this->request->post['agree'];
        $this->data['back'] = $this->html->getSecureURL('checkout/guest_step_1');
        $this->data['form']['back'] = $form->getFieldHtml(
            [
                'type'  => 'button',
                'name'  => 'back',
                'style' => 'button',
                'text'  => $this->language->get('button_back'),
            ]
        );
        $this->data['form']['continue'] = $form->getFieldHtml(
            [
                'type' => 'submit',
                'name' => $this->language->get('button_continue'),
            ]
        );

        //render buttons
        $this->view->batchAssign($this->data);
        $this->view->assign('buttons', $this->view->fetch('pages/checkout/payment.buttons.tpl'));

        $this->processTemplate('pages/checkout/guest_step_2.tpl');

        //init controller data
        $this->extensions->hk_UpdateData($this, __FUNCTION__);
    }

    public function validate()
    {
        if ($this->cart->hasShipping()) {
            if (!isset($this->request->post['shipping_method']) || !$this->request->post['shipping_method']) {
                $this->error['warning'] = $this->language->get('error_shipping');
                return false;
            } else {
                $shipping = explode('.', $this->request->post['shipping_method']);
                if (!isset($this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]])) {
                    $this->error['warning'] = $this->language->get('error_shipping');
                    return false;
                }
            }
        }
        if ($this->cart->getFinalTotal()) {
            if (!isset($this->request->post['payment_method'])) {
                $this->error['warning'] = $this->language->get('error_payment');
                return false;
            } else {
                if (!isset($this->session->data['payment_methods'][$this->request->post['payment_method']])) {
                    $this->error['warning'] = $this->language->get('error_payment');
                    return false;
                }
            }
        }
        if ($this->config->get('config_checkout_id')) {
            $this->loadModel('catalog/content');

            $content_info = $this->model_catalog_content->getContent($this->config->get('config_checkout_id'));

            if ($content_info) {
                if (!isset($this->request->post['agree'])) {
                    $this->error['warning'] = sprintf($this->language->get('error_agree'), $content_info['title']);
                    return false;
                }
            }
        }

        //validate post data
        $this->extensions->hk_ValidateData($this);

        return (!$this->error);
    }

    protected function _validateCoupon()
    {
        $this->loadLanguage('checkout/payment');
        $promotion = new APromotion();
        $coupon = $promotion->getCouponData($this->request->post['coupon']);
        if (!$coupon) {
            $this->error['warning'] = $this->language->get('error_coupon');
        }

        $this->extensions->hk_ValidateData($this);

        return (!$this->error);
    }
}
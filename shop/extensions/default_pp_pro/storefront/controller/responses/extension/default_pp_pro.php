<?php
/*------------------------------------------------------------------------------
  $Id$

  AbanteCart, Ideal OpenSource Ecommerce Solution
  http://www.AbanteCart.com

  Copyright © 2011-2020 Belavier Commerce LLC

  This source file is subject to Open Software License (OSL 3.0)
  Licence details is bundled with this package in the file LICENSE.txt.
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

/** @noinspection PhpUndefinedClassInspection
 *
 * Class ControllerResponsesExtensionDefaultPPPro
 *
 * @property ModelExtensionDefaultPPPro $model_extension_default_pp_pro
 */
class ControllerResponsesExtensionDefaultPPPro extends AController
{
    public $data = array();

    public function main()
    {
        $this->loadLanguage('default_pp_pro/default_pp_pro');
        $this->load->model('checkout/order');
        $this->load->model('extension/default_pp_pro');
        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        $data['action'] = $this->html->getSecureURL('extension/default_pp_pro/send');

        //build submit form
        $form = new AForm();
        $form->setForm(array('form_name' => 'paypal'));
        $data['form_open'] = $form->getFieldHtml(
            array(
                'type' => 'form',
                'name' => 'paypal',
                'attr' => 'class = "form-horizontal validate-creditcard"',
                'csrf' => true,
            )
        );

        $data['cc_owner'] = $form->getFieldHtml(
            array(
                'type'  => 'input',
                'name'  => 'cc_owner',
                'value' => $order_info['payment_firstname'].' '.$order_info['payment_lastname'],
                'style' => 'input-medium',
            )
        );

        //load accepted card types
        $cardtypes = $this->model_extension_default_pp_pro->getCreditCardTypes();
        $cards = unserialize($this->config->get('default_pp_pro_creditcard_types'));
        $options = array('' => $this->language->get('entry_cc_type'));
        foreach ($cards as $card) {
            if ($card && isset($cardtypes[$card])) {
                $options[$card] = $cardtypes[$card];
            }
        }
        $data['accepted_cards'] = $options;
        $data['cc_type'] = $form->getFieldHtml(
            array(
                'type'    => 'hidden',
                'name'    => 'cc_type',
            )
        );

        $data['cc_number'] = $form->getFieldHtml(
            array(
                'type'  => 'input',
                'name'  => 'cc_number',
                'value' => '',
                'style' => 'input-medium',
                'attr'  => 'autocomplete="off"',
            )
        );

        $months = array();
        for ($i = 1; $i <= 12; $i++) {
            $months[sprintf('%02d', $i)] = strftime('%B', mktime(0, 0, 0, $i, 1, 2000));
        }
        $data['cc_expire_date_month'] = $form->getFieldHtml(
            array(
                'type'    => 'selectbox',
                'name'    => 'cc_expire_date_month',
                'value'   => sprintf('%02d', date('m')),
                'options' => $months,
                'style'   => 'short input-small',
            )
        );

        $today = getdate();
        $years = array();
        for ($i = $today['year']; $i < $today['year'] + 11; $i++) {
            $years[strftime('%Y', mktime(0, 0, 0, 1, 1, $i))] = strftime('%Y', mktime(0, 0, 0, 1, 1, $i));
        }
        $data['cc_expire_date_year'] = $form->getFieldHtml(
            array(
                'type'    => 'selectbox',
                'name'    => 'cc_expire_date_year',
                'value'   => sprintf('%02d', date('Y') + 1),
                'options' => $years,
                'style'   => 'short input-small',
            )
        );
        $data['cc_start_date_month'] = $form->getFieldHtml(
            array(
                'type'    => 'selectbox',
                'name'    => 'cc_start_date_month',
                'value'   => sprintf('%02d', date('m')),
                'options' => $months,
                'style'   => 'short input-small',
            )
        );

        $years = array();
        for ($i = $today['year'] - 10; $i < $today['year'] + 2; $i++) {
            $years[strftime('%Y', mktime(0, 0, 0, 1, 1, $i))] = strftime('%Y', mktime(0, 0, 0, 1, 1, $i));
        }
        $data['cc_start_date_year'] = $form->getFieldHtml(
            array(
                'type'    => 'selectbox',
                'name'    => 'cc_start_date_year',
                'value'   => sprintf('%02d', date('Y')),
                'options' => $years,
                'style'   => 'short input-small',
            )
        );

        $data['cc_cvv2'] = $form->getFieldHtml(
            array(
                'type'  => 'input',
                'name'  => 'cc_cvv2',
                'value' => '',
                'style' => 'short',
                'attr'  => ' size="3" maxlength="4" autocomplete="off"',
            )
        );
        $data['cc_issue'] = $form->getFieldHtml(
            array(
                'type'  => 'input',
                'name'  => 'cc_issue',
                'value' => '',
                'style' => 'short',
                'attr'  => ' size="1" maxlength="2" autocomplete="off"',
            )
        );

        if ($this->request->get['rt'] == 'checkout/guest_step_3') {
            $back_url = $this->html->getSecureURL('checkout/guest_step_2', '&mode=edit', true);
        } else {
            $back_url = $this->html->getSecureURL('checkout/payment', '&mode=edit', true);
        }

        $data['back'] = $this->html->buildElement(
            array(
                'type'  => 'button',
                'name'  => 'back',
                'text'  => $this->language->get('button_back'),
                'style' => 'button',
                'href'  => $back_url,
            )
        );

        $data['submit'] = $this->html->buildElement(
            array(
                'type'  => 'button',
                'name'  => 'paypal_button',
                'text'  => $this->language->get('button_confirm'),
                'style' => 'button btn-orange',
            )
        );

        //load creditcard input validation
        $this->document->addScriptBottom($this->view->templateResource('/javascript/credit_card_validation.js'));

        $this->view->batchAssign($data);
        $this->processTemplate('responses/default_pp_pro.tpl');
    }

    public function send()
    {
        $json = array();

        if (!$this->csrftoken->isTokenValid()) {
            $json['error'] = $this->language->get('error_unknown');
            $this->load->library('json');
            $this->response->setOutput(AJson::encode($json));
            return;
        }

        if (!$this->config->get('default_pp_pro_test')) {
            $api_endpoint = 'https://api-3t.paypal.com/nvp';
        } else {
            $api_endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
        }

        if (!$this->config->get('default_pp_pro_transaction')) {
            $payment_type = 'Authorization';
        } else {
            $payment_type = 'Sale';
        }

        $this->load->model('checkout/order');
        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        $order_total = $this->currency->format($order_info['total'], $order_info['currency'], '', false);

        $products_data = $this->_get_products_data(array(
            'currency'    => $order_info['currency'],
            'value'       => '',
            'order_total' => $order_total,
        ));

        $payment_data = array(
            'METHOD'         => 'DoDirectPayment',
            'VERSION'        => '51.0',
            'USER'           => html_entity_decode($this->config->get('default_pp_pro_username'), ENT_QUOTES, 'UTF-8'),
            'PWD'            => html_entity_decode($this->config->get('default_pp_pro_password'), ENT_QUOTES, 'UTF-8'),
            'SIGNATURE'      => html_entity_decode($this->config->get('default_pp_pro_signature'), ENT_QUOTES, 'UTF-8'),
            'CUSTREF'        => $order_info['order_id'],
            'CUSTOM'         => $order_info['order_id'],
            'INVNUM'         => '#'.$order_info['order_id'],
            'PAYMENTACTION'  => $payment_type,
            'AMT'            => $this->currency->format(
                                        $order_info['total'],
                                        $order_info['currency'],
                                        $order_info['value'],
                                        false
            ),
            'ITEMAMT'        => (float)$this->data['items_total'],
            'TAXAMT'         => (float)$this->data['tax_total'],
            'SHIPPINGAMT'    => (float)$this->data['shipping_total'],
            'HANDLINGAMT'    => (float)$this->data['handling_total'],
            'CREDITCARDTYPE' => $this->request->post['cc_type'],
            'ACCT'           => str_replace(' ', '', $this->request->post['cc_number']),
            'CARDSTART'      => $this->request->post['cc_start_date_month'].$this->request->post['cc_start_date_year'],
            'EXPDATE'        => $this->request->post['cc_expire_date_month']
                                    .$this->request->post['cc_expire_date_year'],
            'CVV2'           => $this->request->post['cc_cvv2'],
            'CARDISSUE'      => $this->request->post['cc_issue'],
            'FIRSTNAME'      => $order_info['payment_firstname'],
            'LASTNAME'       => $order_info['payment_lastname'],
            'EMAIL'          => $order_info['email'],
            'PHONENUM'       => $order_info['telephone'],
            'IPADDRESS'      => $this->request->getRemoteIP(),
            'STREET'         => $order_info['payment_address_1'],
            'CITY'           => $order_info['payment_city'],
            'STATE'          => ($order_info['payment_iso_code_2'] != 'US')
                                ? $order_info['payment_zone']
                                : $order_info['payment_zone_code'],
            'ZIP'            => $order_info['payment_postcode'],
            'COUNTRYCODE'    => $order_info['payment_iso_code_2'],
            'CURRENCYCODE'   => $order_info['currency'],
            'BUTTONSOURCE'   => 'Abante_Cart',
            'NOTIFYURL'      => $this->html->getSecureURL('extension/default_pp_pro/callback'),
        );

        if ($this->cart->hasShipping()) {
            $payment_data = array_merge($payment_data, array(
                'SHIPTONAME'        => $order_info['shipping_firstname'].' '.$order_info['shipping_lastname'],
                'SHIPTOSTREET'      => $order_info['shipping_address_1'],
                'SHIPTOCITY'        => $order_info['shipping_city'],
                'SHIPTOSTATE'       => ($order_info['shipping_iso_code_2'] != 'US')
                                        ? $order_info['shipping_zone']
                                        : $order_info['shipping_zone_code'],
                'SHIPTOCOUNTRYCODE' => $order_info['shipping_iso_code_2'],
                'SHIPTOZIP'         => $order_info['shipping_postcode'],
            ));
        } else {
            $payment_data = array_merge($payment_data, array(
                'SHIPTONAME'        => $order_info['payment_firstname'].' '.$order_info['payment_lastname'],
                'SHIPTOSTREET'      => $order_info['payment_address_1'],
                'SHIPTOCITY'        => $order_info['payment_city'],
                'SHIPTOSTATE'       => ($order_info['payment_iso_code_2'] != 'US')
                                        ? $order_info['payment_zone']
                                        : $order_info['payment_zone_code'],
                'SHIPTOCOUNTRYCODE' => $order_info['payment_iso_code_2'],
                'SHIPTOZIP'         => $order_info['payment_postcode'],
            ));
        }

        //items list
        //check amounts
        $calc_total = $this->data['items_total'] + $this->data['shipping_total']
            + $this->data['tax_total'] + $this->data['handling_total'];
        $skip_item_list = false;

        if (($calc_total - $order_total) !== 0.0) {
            $skip_item_list = true;
            $payment_data['ITEMAMT'] = 0;
            $payment_data['TAXAMT'] = 0;
            $payment_data['SHIPPINGAMT'] = 0;
            $payment_data['HANDLINGAMT'] = 0;
        }
        if (!$skip_item_list) {
            foreach ($products_data as $key => $product) {
                $payment_data['L_NAME'.$key] = $product['name'];
                $payment_data['L_AMT'.$key] = (float)$product['price'];
                $payment_data['L_NUMBER'.$key] = $product['model'];
                $payment_data['L_QTY'.$key] = $product['quantity'];
            }
        }

        $curl = curl_init($api_endpoint);

        curl_setopt($curl, CURLOPT_PORT, 443);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($payment_data));

        $response = curl_exec($curl);
        if (!$response) {
            $json['error'] = 'Cannot establish a connection to the server';
            $err = new AError('Paypal Pro Error: DoDirectPayment failed: '.curl_error($curl).'('.curl_errno($curl).')');
            $err->toLog()->toDebug();
        } else {

            $response_data = array();
            parse_str($response, $response_data);

            if (($response_data['ACK'] == 'Success') || ($response_data['ACK'] == 'SuccessWithWarning')) {
                $this->model_checkout_order->confirm($this->session->data['order_id'],
                    $this->config->get('config_order_status_id'));

                $message = '';
                if (isset($response_data['AVSCODE'])) {
                    $message .= 'AVSCODE: '.$response_data['AVSCODE']."\n";
                }

                if (isset($response_data['CVV2MATCH'])) {
                    $message .= 'CVV2MATCH: '.$response_data['CVV2MATCH']."\n";
                }

                if (isset($response_data['TRANSACTIONID'])) {
                    $message .= 'TRANSACTIONID: '.$response_data['TRANSACTIONID']."\n";
                }

                $response_data['PAYMENTACTION'] = $payment_type;
                $response_data['payment_method'] = 'default_pp_pro';

                $this->model_checkout_order->updatePaymentMethodData($this->session->data['order_id'],
                    serialize($response_data));
                $this->model_checkout_order->update($this->session->data['order_id'],
                    $this->config->get('default_pp_pro_order_status_id'), $message, false);

                $json['success'] = $this->html->getSecureURL('checkout/success');
            } else {
                $json['error'] = $response_data['L_LONGMESSAGE0'];
            }
        }
        curl_close($curl);
        if (isset($json['error'])) {
            if ($json['error']) {
                $csrftoken = $this->registry->get('csrftoken');
                $json['csrfinstance'] = $csrftoken->setInstance();
                $json['csrftoken'] = $csrftoken->setToken();
            }
        }
        $this->load->library('json');
        $this->response->setOutput(AJson::encode($json));
    }

    protected function _get_products_data($order_info)
    {

        $this->load->library('encryption');
        $encryption = new AEncryption($this->config->get('encryption_key'));

        $this->data['products'] = array();
        $this->data['items_total'] = 0.0;
        $products = $this->cart->getProducts();

        foreach ($products as $product) {
            $option_data = array();

            foreach ($product['option'] as $option) {
                if ($option['type'] != 'file') {
                    $value = $option['value'];
                } else {
                    $filename = $encryption->decrypt($option['value']);
                    $value = mb_substr($filename, 0, mb_strrpos($filename, '.'));
                }

                $option_data[] = array(
                    'name'  => $option['name'],
                    'value' => (mb_strlen($value) > 20 ? mb_substr($value, 0, 20).'..' : $value),
                );
            }
            $price = $this->currency->format($product['price'], $order_info['currency'], $order_info['value'], false);
            $this->data['products'][] = array(
                'name'        => $product['name'],
                'model'       => $product['model'],
                'price'       => $price,
                'quantity'    => $product['quantity'],
                'option'      => $option_data,
                'weight'      => $product['weight'],
                'weight_type' => $product['weight_type'],
            );
            $this->data['items_total'] += $price * $product['quantity'];
        }

        //check for virtual product such as gift certificate
        $virtual_products = $this->cart->getVirtualProducts();

        if ($virtual_products) {
            foreach ($virtual_products as $k => $virtual) {
                $this->data['products'][] = array(
                    'name'     => ($virtual['name'] ? $virtual['name'] : 'Virtual Product'),
                    'model'    => '',
                    'price'    => $this->currency->format(
                        $virtual['amount'],
                        $order_info['currency'],
                        $order_info['value'],
                        false
                    ),
                    'quantity' => ($virtual['quantity'] ? $virtual['quantity'] : 1),
                    'option'   => array(),
                    'weight'   => 0,
                );
                $this->data['items_total'] += ($virtual['quantity'] ? $virtual['quantity'] : 1)
                    * $this->currency->format($virtual['amount'], $order_info['currency'], $order_info['value'], false);
            }
        }

        $this->data['discount_amount_cart'] = 0;
        $totals = $this->cart->buildTotalDisplay();

        foreach ($totals['total_data'] as $total) {
            if (in_array($total['id'], array('subtotal', 'total'))) {
                continue;
            }

            if (in_array($total['id'], array('promotion', 'coupon'))) {
                $total['value'] = $total['value'] < 0 ? $total['value'] * -1 : $total['value'];
                $this->data['discount_amount_cart'] += $total['value'];
            } else {
                $price = $this->currency->format($total['value'], $order_info['currency'], $order_info['value'], false);

                if (in_array($total['total_type'], array('tax'))) {
                    $this->data['tax_total'] += $price;
                } elseif (in_array($total['total_type'], array('shipping'))) {
                    $this->data['shipping_total'] += $price;
                } elseif (in_array($total['total_type'], array('handling', 'fee'))) {
                    $this->data['handling_total'] += $price;
                } else {
                    $this->data['items_total'] += $price;
                }

                $this->data['products'][$total['id']] = array(
                    'name'     => $total['title'],
                    'model'    => '',
                    'price'    => $price,
                    'quantity' => 1,
                    'option'   => array(),
                    'weight'   => 0,
                );

            }
        }

        $calc_total = $this->data['items_total']
            + $this->data['shipping_total']
            + $this->data['tax_total']
            + $this->data['handling_total'];

        if (($calc_total - $order_info['order_total']) !== 0.0) {
            foreach ($totals['total_data'] as $total) {
                if (in_array($total['id'], array('subtotal', 'total', 'promotion', 'coupon'))) {
                    continue;
                }

                $price = $this->currency->format($total['value'], $order_info['currency'], $order_info['value'], false);
                $this->data['products'][$total['id']] = array(
                    'name'     => $total['title'],
                    'model'    => '',
                    'price'    => $price,
                    'quantity' => 1,
                    'option'   => array(),
                    'weight'   => 0,
                );
            }
        }

        if ($this->data['discount_amount_cart'] > 0) {
            $price = -1 * $this->currency->format($this->data['discount_amount_cart'], $order_info['currency'],
                    $order_info['value'], false);
            $this->data['products'][] = array(
                'name'     => $this->language->get('text_discount'),
                'model'    => '',
                'price'    => $price,
                'quantity' => 1,
                'option'   => array(),
                'weight'   => 0,
            );
            $this->data['items_total'] += $price;
        }

        return $this->data['products'];
    }

    public function callback()
    {

        if (isset($this->request->post['invoice'])) {
            $order_id = (int)$this->request->post['invoice'];
        } else {
            $order_id = 0;
        }

        $this->load->model('checkout/order');
        $order_info = $this->model_checkout_order->getOrder($order_id);

        if ($order_info && $this->request->post['payment_status'] == 'Refunded') {
            $order_status_id = $this->order_status->getStatusByTextId('refunded');
            if ($order_status_id) {
                $this->model_checkout_order->update($order_id, $order_status_id);
            }
        } elseif ($order_info && $this->request->post['payment_status'] == 'Denied') {
            $order_status_id = $this->order_status->getStatusByTextId('denied');
            if ($order_status_id) {
                $this->model_checkout_order->update($order_id, $order_status_id);
            }
        }
    }

}
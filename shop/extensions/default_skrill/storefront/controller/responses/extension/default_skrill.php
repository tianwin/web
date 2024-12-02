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

class ControllerResponsesExtensionDefaultSkrill extends AController
{
    public function main()
    {
        $this->load->model('checkout/order');
        $this->loadLanguage('default_skrill/default_skrill');

        $cancel_url =
            $this->request->get['rt'] != 'checkout/guest_step_3' ? $this->html->getSecureURL('checkout/payment')
                : $this->html->getSecureURL('checkout/guest_step_2');

        $logo = '';
        if (is_numeric($this->config->get('config_logo'))) {
            $resource = new AResource('image');
            $image = $resource->getResource($this->config->get('config_logo'));
            $img_sub_path = $image['type_name'].'/'.$image['resource_path'];
            if (is_file(DIR_RESOURCE.$img_sub_path)) {
                $logo = 'https:'.HTTPS_DIR_RESOURCE.$img_sub_path;
            }
        } elseif (is_file(DIR_RESOURCE.$this->config->get('config_logo'))) {
            $logo = HTTPS_DIR_RESOURCE.$this->config->get('config_logo');
        } else {
            $logo = $this->config->get('config_logo');
        }

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
        $products = '';
        foreach ($this->cart->getProducts() as $product) {
            $products .= $product['quantity'].' x '.$product['name'].', ';
        }

        $this->load->library('encryption');
        $encryption = new AEncryption($this->config->get('encryption_key'));

        $skrill_url = 'https://pay.skrill.com';
        //$skrill_url = 'https://sandbox.dev.skrillws.net/pay';
        $fields = [
            'rid'                   => '53571612',
            'ext_ref_id'            => 'abantecart',
            'pay_to_email'          => $this->config->get('default_skrill_email'),
            'recipient_description' => $this->config->get('store_name'),
            'transaction_id'        => $this->session->data['order_id'].'_'.UNIQUE_ID,
            'return_url'            => $this->html->getSecureURL('checkout/success'),
            'cancel_url'            => $cancel_url,
            'status_url'            => $this->html->getSecureURL('extension/default_skrill/callback'),
            'language'              => $this->session->data['language'],
            'logo_url'              => $logo,
            'pay_from_email'        => $order_info['email'],
            'firstname'             => $order_info['payment_firstname'],
            'lastname'              => $order_info['payment_lastname'],
            'address'               => $order_info['payment_address_1'],
            'address2'              => $order_info['payment_address_2'],
            'phone_number'          => $order_info['telephone'],
            'postal_code'           => substr($order_info['payment_postcode'], 0, 9),
            'city'                  => $order_info['payment_city'],
            'state'                 => $order_info['payment_zone'],
            'country'               => $order_info['payment_iso_code_3'],
            'amount'                => $this->currency->format(
                $order_info['total'], $order_info['currency'], $order_info['value'], false
            ),
            'currency'              => $order_info['currency'],
            'detail1_text'          => $products,
            'merchant_fields'       => 'order_id',
            'order_id'              => $encryption->encrypt($this->session->data['order_id']),
        ];

        $form = new AForm();
        $form->setForm(['form_name' => 'checkout']);
        $data['form']['form_open'] = $form->getFieldHtml(
            [
                'type'    => 'form',
                'name'    => 'checkout',
                'action'  => $skrill_url,
                'enctype' => 'application/x-www-form-urlencoded',
            ]
        );

        foreach ($fields as $key => $value) {
            $data['form'][$key] = $form->getFieldHtml(
                [
                    'type'  => 'hidden',
                    'name'  => $key,
                    'value' => $value,
                ]
            );
        }

        $data['form']['back'] = $form->getFieldHtml(
            [
                'type'  => 'button',
                'name'  => 'back',
                'text'  => $this->language->get('button_back'),
                'style' => 'button',
                'href'  => $cancel_url,
            ]
        );

        $data['form']['submit'] = $form->getFieldHtml(
            [
                'type' => 'submit',
                'name' => $this->language->get('button_confirm'),
            ]
        );
        $this->view->batchAssign($data);
        $this->processTemplate('responses/default_skrill.tpl');
    }

    public function callback()
    {
        $this->load->library('encryption');
        $encryption = new AEncryption($this->config->get('encryption_key'));
        if (isset($this->request->post['order_id'])) {
            $order_id = $encryption->decrypt($this->request->post['order_id']);
        } else {
            return null;
        }

        $this->load->model('checkout/order');
        $order_info = $this->model_checkout_order->getOrder($order_id);
        if (!$order_info) {
            return null;
        }

        $md5_ok = false;
        if ($this->config->get('default_skrill_email')) {
            $our_hash = $this->request->post['merchant_id'];
            $our_hash .= $this->request->post['transaction_id'].'_'.UNIQUE_ID;
            $our_hash .= strtoupper(md5($this->config->get('default_skrill_secret')));
            $our_hash .= $this->request->post['mb_amount'];
            $our_hash .= $this->request->post['mb_currency'];
            $our_hash .= $this->request->post['status'];
            $our_md5_hash = strtoupper(md5($our_hash));
            $their_md5_sig = $this->request->post['md5sig'];
            if ($our_md5_hash == $their_md5_sig) {
                $md5_ok = true;
            }
        }

        $this->model_checkout_order->confirm($order_id, $this->config->get('config_order_status_id'));
        if ($md5_ok) {
            switch ($this->request->post['status']) {
                case '2':
                    $this->model_checkout_order->update($order_id, $this->config->get('default_skrill_order_status_id'), '', true);
                    break;
                case '0':
                    $this->model_checkout_order->update($order_id, $this->config->get('default_skrill_order_status_pending_id'), '', true);
                    break;
                case '-1':
                    $this->model_checkout_order->update($order_id, $this->config->get('default_skrill_order_status_canceled_id'), '', true);
                    break;
                case '-2':
                    $this->model_checkout_order->update(
                        $order_id,
                        $this->config->get('default_skrill_order_status_failed_id'),
                        'Reason code: '.$this->request->post['failed_reason_code'],
                        true);
                    break;
                case '-3':
                    $this->model_checkout_order->update($order_id, $this->config->get('default_skrill_order_status_chargeback_id'), '', true);
                    break;
            }
        } else {
            //Security HASH verification failed
            $this->model_checkout_order->addHistory(
                $order_id,
                $this->config->get('default_skrill_order_status_pending_id'),
                'Manual order verification is required! MD5 hash returned (' + $their_md5_sig + ') does not match generated (' + $our_md5_hash + ').'
            );
        }
        return null;
    }
}

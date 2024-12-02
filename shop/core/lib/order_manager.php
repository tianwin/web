<?php
/*------------------------------------------------------------------------------
  $Id$

  AbanteCart, Ideal OpenSource Ecommerce Solution
  http://www.AbanteCart.com

  Copyright © 2011-2020 Belavier Commerce LLC

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

/**
 * Class AOrderManager
 */
class AOrderManager extends AOrder
{
    /**
     * @var Registry
     */
    protected $registry;
    /**
     * @var int
     */
    protected $order_id;
    /**
     * @var array
     */
    protected $order_data;

    /**
     * @param string $order_id
     *
     * @throws AException
     */
    public function __construct($order_id = '')
    {
        $this->registry = Registry::getInstance();
        if ((int)$order_id) {
            $this->order_id = (int)$order_id;
        }
        parent::__construct($this->registry, $this->order_id);
        if (!IS_ADMIN) { // forbid for non admin calls
            throw new AException (AC_ERR_LOAD, 'Error: permission denied to access package manager');
        }
    }

    /**
     * @param array $skip_totals
     * @param array $new_totals
     *
     * @throws AException
     * @return array
     * NOTE: Admin only method to recalculate existing order totals.
     * Consideration: This section needs to be simplified with SF process call.
     */
    public function recalcTotals($skip_totals = array(), $new_totals = array())
    {
        if (!IS_ADMIN) { // forbid for non admin calls
            throw new AException (AC_ERR_LOAD, 'Error: permission denied to access order recalculation');
        }
        if (!has_value($this->order_id)) {
            return array('error' => "Missing required details");
        }
        /**
         * @var $adm_order_mdl ModelSaleOrder
         */
        $adm_order_mdl = $this->load->model('sale/order');
        $customer_gr_mdl = $this->load->model('sale/customer_group');
        $customer_data = array();
        $skip_recalc = array('handling', 'balance');

        //load order details
        $order_info = $adm_order_mdl->getOrder($this->order_id);
        $original_totals = $adm_order_mdl->getOrderTotals($this->order_id);

        //identify totals with shared keys (example tax) and link to total ids
        $total2ids = array();
        foreach ($original_totals as $t_old) {
            $total2ids[$t_old['key']][] = $t_old['order_total_id'];
        }

        //update total with new values passed and mark to skip recalc
        if (!empty($new_totals)) {
            //build new totals
            $upd_total = array('totals' => $new_totals);
            foreach ($new_totals as $total_id => $value) {
                $skip_totals[] = $total_id;
            }
            //add old totals before saving whole array
            foreach ($original_totals as $t_old) {
                if (!$upd_total['totals'][$t_old['order_total_id']]) {
                    $upd_total['totals'][$t_old['order_total_id']] = $t_old['value'];
                }
            }
            //save new totals
            $adm_order_mdl->editOrder($this->order_id, $upd_total);
            //reload original total as it has changed
            $original_totals = $adm_order_mdl->getOrderTotals($this->order_id);
        }

        //This totals are skipped for calculation
        if ($skip_totals) {
            foreach ($skip_totals as $total_id) {
                foreach ($original_totals as $total) {
                    if ($total_id == $total['order_total_id']) {
                        //check if this total is shared and all a skipped
                        if (sizeof($total2ids[$total['key']]) > 1) {
                            $dup_cnt = 0;
                            foreach ($total2ids[$total['key']] as $dup) {
                                if (in_array($dup, $skip_totals)) {
                                    $dup_cnt++;
                                }
                            }
                            if (sizeof($total2ids[$total['key']]) == $dup_cnt) {
                                $skip_recalc[] = $total['key'];
                            }
                        } else {
                            $skip_recalc[] = $total['key'];
                        }
                    }
                }
            }
        }

        //build customer data before cart loading
        $customer_data['currency'] = $order_info['currency'];
        $customer_data['current_store_id'] = $order_info['store_id'];
        $customer_data['country_id'] = $order_info['shipping_country_id'];
        $customer_data['zone_id'] = $order_info['shipping_zone_id'];
        $customer_data['customer_id'] = $order_info['customer_id'];
        //need to include customer_group_id to calculate promotions
        $customer_data['customer_group_id'] = $order_info['customer_group_id'];
        if ($customer_data['customer_group_id']) {
            //get customer data to pull tax exemption
            $cust_info = $customer_gr_mdl->getCustomerGroup($customer_data['customer_group_id']);
            $customer_data['tax_exempt'] = $cust_info['tax_exempt'];
        }
        //get coupon code from coupon_id
        if (has_value($order_info['coupon_id'])) {
            /**
             * @var $adm_coupon_mdl ModelSaleCoupon
             */
            $adm_coupon_mdl = $this->load->model('sale/coupon');
            $cpn_data = $adm_coupon_mdl->getCouponByID($order_info['coupon_id']);
            if ($cpn_data['code']) {
                $customer_data['coupon'] = $cpn_data['code'];
            }
        }

        //prepare shipping and payment address 
        $shipping_address = array(
            'firstname'      => $order_info['shipping_firstname'],
            'lastname'       => $order_info['shipping_lastname'],
            'company'        => $order_info['shipping_company'],
            'address_1'      => $order_info['shipping_address_1'],
            'address_2'      => $order_info['shipping_address_2'],
            'postcode'       => $order_info['shipping_postcode'],
            'city'           => $order_info['shipping_city'],
            'zone_id'        => $order_info['shipping_zone_id'],
            'zone'           => $order_info['shipping_zone'],
            'zone_code'      => $order_info['shipping_zone_code'],
            'country_id'     => $order_info['shipping_country_id'],
            'country'        => $order_info['shipping_country'],
            'iso_code_2'     => $order_info['shipping_iso_code_2'],
            'iso_code_3'     => $order_info['shipping_iso_code_3'],
            'address_format' => $order_info['shipping_address_format'],
        );
        $payment_address = array(
            'firstname'      => $order_info['payment_firstname'],
            'lastname'       => $order_info['payment_lastname'],
            'company'        => $order_info['payment_company'],
            'address_1'      => $order_info['payment_address_1'],
            'address_2'      => $order_info['payment_address_2'],
            'postcode'       => $order_info['payment_postcode'],
            'city'           => $order_info['payment_city'],
            'zone_id'        => $order_info['payment_zone_id'],
            'zone'           => $order_info['payment_zone'],
            'zone_code'      => $order_info['payment_zone_code'],
            'country_id'     => $order_info['payment_country_id'],
            'country'        => $order_info['payment_country'],
            'iso_code_2'     => $order_info['payment_iso_code_2'],
            'iso_code_3'     => $order_info['payment_iso_code_3'],
            'address_format' => $order_info['payment_address_format'],
        );

        //override storefront session currency with order currency
        $this->session->data['currency'] = $order_info['currency'];
        //reload currency
        $this->registry->set('currency', new ACurrency($this->registry));
        //add cart to registry before working with shipments and payments
        $this->registry->set('cart', new ACart($this->registry, $customer_data));
        // Tax
        $this->registry->set('tax', new ATax($this->registry, $customer_data));
        $this->tax->setZone($order_info['shipping_country_id'], $order_info['shipping_zone_id']);

        $products = array();
        $order_products = $adm_order_mdl->getOrderProducts($this->order_id);
        foreach ($order_products as $order_product) {
            $option_data = array();
            $options = $adm_order_mdl->getOrderOptions($this->order_id, $order_product['order_product_id']);
            foreach ($options as $option) {
                $option_data[$option['product_option_id']] = $option['product_option_value_id'];
            }
            //add product one at the time
            $this->cart->add($order_product['product_id'], $order_product['quantity'], $option_data);
        }

        //locate shipping method quote
        $quote_data = array();
        /**
         * @var $sf_ext_mdl ModelCheckoutExtension
         */
        $sf_ext_mdl = $this->load->model('checkout/extension', 'storefront');

        //recalc shipping only if we know the shipping method key
        if ($order_info['shipping_method_key']) {
            //Load weight/length classes
            $this->registry->set('weight', new AWeight($this->registry));
            $this->registry->set('length', new ALength($this->registry));

            $shipping_method_key = explode('.', $order_info['shipping_method_key']);

            $shipping_method_option = $shipping_method_key[1] ? $shipping_method_key[1] : $shipping_method_key[0];

            $results = $sf_ext_mdl->getExtensions('shipping');
            foreach ($results as $result) {
                if ($shipping_method_key[0] == $result['key']) {
                    $this->load->model('extension/'.$result['key'], 'storefront');
                    $quote = $this->{'model_extension_'.$result['key']}->getQuote($shipping_address);
                    if ($quote) {
                        $customer_data['shipping_method'] = array(
                            'id'           => $quote['quote'][$shipping_method_option]['id'],
                            'cost'         => $quote['quote'][$shipping_method_option]['cost'],
                            'tax_class_id' => $quote['quote'][$shipping_method_option]['tax_class_id'],
                            'text'         => $quote['quote'][$shipping_method_option]['text'],
                        );
                    }
                }
            }
        } else {
            //skip shipping recalculation
            $skip_recalc[] = 'shipping';
        }

        $total_data = array();
        $calc_order = array();
        $total = 0;
        //get applied taxes
        $taxes = $this->cart->getAppliedTaxes(true);
        //recalc required totals
        $total_extns = $sf_ext_mdl->getExtensions('total');
        foreach ($total_extns as $value) {
            $calc_order[$value['key']] = (int)$this->config->get($value['key'].'_calculation_order');
        }

        //need to perform action of calculation totals one by one and build array by reference
        array_multisort($calc_order, SORT_ASC, $total_extns);
        foreach ($total_extns as $extn) {
            $include = false;
            //completely skip if not part of current total. 
            foreach ($original_totals as $ototal) {
                if (str_replace('_', '', $ototal['key']) == str_replace('_', '', $extn['key'])) {
                    $include = true;
                }
            }
            if (!$include) {
                continue;
            }
            //skip recalculation and write original values 
            if (in_array($extn['key'], $skip_recalc)) {
                //copy original totals
                foreach ($original_totals as $or_total) {
                    if (str_replace('_', '', $or_total['key']) == str_replace('_', '', $extn['key'])) {
                        $total_data[] = array(
                            'id'         => $or_total['key'],
                            'title'      => $or_total['title'],
                            'text'       => $or_total['text']
                                ? $or_total['text']
                                : $this->currency->format($or_total['value'], $order_info['currency'],
                                    $order_info['value'], true),
                            'value'      => $or_total['value'],
                            'sort_order' => $or_total['sort_order'],
                            'total_type' => $or_total['type'],
                            'source'     => 'original',
                        );
                        $total += $or_total['value'];
                        break;
                    }
                }
            } else {
                //process storefront total models
                /**
                 * @var $sf_total_mdl ModelTotalTotal etc
                 */
                $sf_total_mdl = $this->load->model('total/'.$extn['key'], 'storefront');
                /**
                 * parameters are references!!!
                 */
                $sf_total_mdl->getTotal($total_data, $total, $taxes, $customer_data);
                $sf_total_mdl = null;
            }
        }

        //Create new totals, based on old order.
        $is_missing_keys = false;
        $upd_total = array('totals' => array());
        $shift = 0;
        foreach ($original_totals as $i => $t_old) {
            $found = false;
            if (empty($t_old['key'])) {
                $is_missing_keys = true;
            }
            //set shift back if new list is missing some total compare to old list.
            $j = $i - $shift;
            $t_new = $total_data[$j];
            if (str_replace('_', '', $t_new['id']) != str_replace('_', '', $t_old['key'])) {
                // need to set text value to 0 for removed new total
                $zero_text_val = $this->currency->format(0, $order_info['currency'], $order_info['value'], true);
                $upd_total['totals'][$t_old['order_total_id']] = $zero_text_val;
                $shift++;
            } else {
                $upd_total['totals'][$t_old['order_total_id']] = $t_new['text'];
            }
        }

        //check if this is a shared key total, correct totals to match on the title. 
        //This will NOT work on multilingual sites if order originally placed in diff language
        foreach ($total2ids as $key => $t2i) {
            if (sizeof($t2i) > 1) {
                foreach ($original_totals as $t_old) {
                    if (in_array($t_old['order_total_id'], $t2i)) {
                        $found = false;
                        foreach ($total_data as $t_new) {
                            //rely on title to match and if match update
                            if ($t_new['id'] == $key && $t_new['title'] == $t_old['title']) {
                                $upd_total['totals'][$t_old['order_total_id']] = $t_new['text'];
                                $found = true;
                            }
                        }
                        if (!$found) {
                            $zero_text_val = $this->currency->format(0, $order_info['currency'], $order_info['value'], true);
                            $upd_total['totals'][$t_old['order_total_id']] = $zero_text_val;
                        }
                    }
                }
            }
        }

        //update all totals at once
        $adm_order_mdl->editOrder($this->order_id, $upd_total);
        //do we have errors?
        if ($is_missing_keys) {
            //messing total keys. This is older order 
            return array('error' => "Cannot recalculate some or all of the totals. Possibly this order was built prior to upgrade and does not have required data.");
        }

        return array('order_status_id' => $order_info['order_status_id']);
    }

}

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

class ModelCatalogManufacturer extends Model
{
    /**
     * @param $manufacturer_id
     *
     * @return array
     */
    public function getManufacturer($manufacturer_id)
    {
        $manufacturer_id = (int)$manufacturer_id;
        $store_id = (int)$this->config->get('config_store_id');
        $cache_key = 'manufacturer.'.$manufacturer_id.'.store_'.$store_id;
        $output = $this->cache->pull($cache_key);
        if ($output !== false) {
            return $output;
        }
        $query = $this->db->query("SELECT *
									FROM ".$this->db->table("manufacturers")." m
									LEFT JOIN ".$this->db->table("manufacturers_to_stores")." m2s
										ON (m.manufacturer_id = m2s.manufacturer_id)
									WHERE m.manufacturer_id = '".$manufacturer_id."'
										AND m2s.store_id = '".$store_id."'");
        $output = $query->row;
        $this->cache->push($cache_key, $output);
        return $output;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function getManufacturers($data = array())
    {
        $store_id = (int)$this->config->get('config_store_id');

        if (isset($data['start']) || isset($data['limit'])) {
            $data['start'] = (int)$data['start'];
            $data['limit'] = (int)$data['limit'];

            if ($data['start'] < 0) {
                $data['start'] = 0;
            }
            if ($data['limit'] < 1) {
                $data['limit'] = 0;
            }
            $cache_key = 'manufacturer.list.'.md5((int)$data['start'].(int)$data['limit']).'.store_'.$store_id;
        } else {
            $cache_key = 'manufacturer.list.store_'.$store_id;
            unset($data['limit']);
        }

        $output = $this->cache->pull($cache_key);

        if ($output !== false) {
            return $output;
        }

        $sql = "SELECT *
				FROM ".$this->db->table("manufacturers")." m
				LEFT JOIN ".$this->db->table("manufacturers_to_stores")." m2s
					ON (m.manufacturer_id = m2s.manufacturer_id)
				WHERE m2s.store_id = '".$store_id."'
				ORDER BY sort_order, LCASE(m.name) ASC";

        if ($data['limit']) {
            $sql .= " LIMIT ".(int)$data['start'].",".(int)$data['limit'];
        }
        $query = $this->db->query($sql);
        $output = $query->rows;
        $this->cache->push($cache_key, $output);
        return $output;
    }

    /**
     * @param $product_id
     *
     * @return array
     */
    public function getManufacturerByProductId($product_id)
    {
        $query = $this->db->query("SELECT *
										FROM ".$this->db->table("manufacturers")." m
										RIGHT JOIN ".$this->db->table("products")." p ON (m.manufacturer_id = p.manufacturer_id)
										WHERE p.product_id = '".(int)$product_id."'");
        return $query->rows;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function getManufacturersData($data = array())
    {
        $sql = "SELECT *,
						(SELECT count(*) as cnt
				        FROM ".$this->db->table('products')." p
				        WHERE p.manufacturer_id = m.manufacturer_id and p.status=1) as products_count
					FROM ".$this->db->table("manufacturers")." m
					LEFT JOIN ".$this->db->table("manufacturers_to_stores")." m2s ON (m.manufacturer_id = m2s.manufacturer_id)";

        $sql .= " WHERE m2s.store_id = '".(int)$this->config->get('config_store_id')."' ";
        if (!empty($data['subsql_filter'])) {
            $sql .= ' AND '.$data['subsql_filter'];
        }
        $sql .= " ORDER BY sort_order, LCASE(m.name) ASC";

        $query = $this->db->query($sql);
        return $query->rows;
    }
}
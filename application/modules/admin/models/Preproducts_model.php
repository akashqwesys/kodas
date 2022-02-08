<?php

class Preproducts_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function deleteProduct($id) {
		$this->db->trans_begin();

		$this->db->where('pre_products.id', $id);
		$query = $this->db->select('pre_products.folder, pre_products.image')->get('pre_products');
		$result = $query->row_array();

		if (!empty($result['image'])) {
			$imagedelete = $_SERVER['DOCUMENT_ROOT'] . '/attachments/shop_images/' . $result['image'];
			@unlink($imagedelete);
		}
		if (!empty($result['folder'])) {
			$folderdelete = $_SERVER['DOCUMENT_ROOT'] . '/attachments/shop_images/' . $result['folder'];
			$this->rrmdir($folderdelete);
		}

		$this->db->where('for_id', $id);
		if (!$this->db->delete('pre_products_translations')) {
			log_message('error', print_r($this->db->error(), true));
		}

		$this->db->where('preproductid', $id);
		if (!$this->db->delete('product_attribute')) {
			log_message('error', print_r($this->db->error(), true));
		}

		$this->db->where('id', $id);
		if (!$this->db->delete('pre_products')) {
			log_message('error', print_r($this->db->error(), true));
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
		}
	}

	public function rrmdir($dir) {
		if (is_dir($dir)) {
			$objects = scandir($dir);
			foreach ($objects as $object) {
				if ($object != '.' && $object != '..') {
					if (filetype($dir . '/' . $object) == 'dir') {rrmdir($dir . '/' . $object);} else {unlink($dir . '/' . $object);}
				}
			}

			reset($objects);
			rmdir($dir);
		}
	}

	public function productsCount($search_title = null, $category = null) {
		if ($search_title != null) {
			$search_title = trim($this->db->escape_like_str($search_title));
			$this->db->where("(pre_products_translations.title LIKE '%$search_title%')");
		}
		if ($category != null) {
			$this->db->where('shop_categorie', $category);
		}
		$this->db->join('pre_products_translations', 'pre_products_translations.for_id = pre_products.id', 'left');
		$this->db->where('pre_products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
		return $this->db->count_all_results('pre_products');
	}

	public function getProducts($limit, $page, $search_title = null, $orderby = null, $category = null, $vendor = null) {
		if ($search_title != null) {
			$search_title = trim($this->db->escape_like_str($search_title));
			$this->db->where("(pre_products_translations.title LIKE '%$search_title%')");
		}
		if ($orderby !== null) {
			$ord = explode('=', $orderby);
			if (isset($ord[0]) && isset($ord[1])) {
				$this->db->order_by('pre_products.' . $ord[0], $ord[1]);
			}
		} else {
			$this->db->order_by('pre_products.position', 'asc');
		}
		if ($category != null) {
			$this->db->where('shop_categorie', $category);
		}
		if ($vendor != null) {
			$this->db->where('vendor_id', $vendor);
		}
		$this->db->join('vendors', 'vendors.id = pre_products.vendor_id', 'left');
		$this->db->join('pre_products_translations', 'pre_products_translations.for_id = pre_products.id', 'left');
		$this->db->where('pre_products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
		$query = $this->db->select('vendors.name as vendor_name, vendors.id as vendor_id, pre_products.*, pre_products_translations.title, pre_products_translations.description, pre_products_translations.price, pre_products_translations.old_price, pre_products_translations.abbr, pre_products.url, pre_products_translations.for_id, pre_products_translations.basic_description')->get('pre_products', $limit, $page);
		return $query->result();
	}

	public function numShopProducts() {
		return $this->db->count_all_results('products');
	}

	public function getOneProduct($id) {
		$this->db->select('vendors.name as vendor_name, vendors.id as vendor_id, pre_products.*, pre_products_translations.price');
		$this->db->where('pre_products.id', $id);
		$this->db->join('vendors', 'vendors.id = pre_products.vendor_id', 'left');
		$this->db->join('pre_products_translations', 'pre_products_translations.for_id = pre_products.id', 'inner');
		$this->db->where('pre_products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
		$query = $this->db->get('pre_products');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function productStatusChange($id, $to_status) {
		$this->db->where('id', $id);
		$result = $this->db->update('pre_products', array('visibility' => $to_status));
		return $result;
	}

	public function setProduct($post, $id = 0) {
		if (!isset($post['brand_id'])) {
			$post['brand_id'] = null;
		}
		if (!isset($post['virtual_products'])) {
			$post['virtual_products'] = null;
		}
		$this->db->trans_begin();
		$is_update = false;
		if ($id > 0) {
			$is_update = true;

			$this->db->where('preproductid', $id);
			if (!$this->db->delete('product_attribute')) {
				log_message('error', print_r($this->db->error(), true));
			}
			
			$this->db->where('refProduct_id', $id);
			$this->db->delete('product_attribute1');
			foreach ($post['refattributes_id'] as $key => $value) {
				if (isset($value[0]) && $value[0] != '') {
					$this->db->insert('product_attribute1', array(
						'refProduct_id' => $id,
						'refAttributesgroup_id' => $key,
						'refattributes_id' => $value[0]
					));
				}
			}

			foreach ($post['shop_attribute'] as $key => $value) {
				if (isset($value[0]) && $value[0] != '') {
					$this->db->insert('product_attribute', array(
						'preproductid' => $id,
						'keyid' => $key,
						'valueid' => $value[0],
					));
				}
			}
			if (!$this->db->where('id', $id)->update('pre_products', array(
				'image' => $post['image'] != null ? $_POST['image'] : $_POST['old_image'],
				'shop_categorie' => $post['shop_categorie'],
				'quantity' => $post['quantity'],
				'product_type' => $post['product_type'],
				'product_pcs' => $post['product_pcs'],
				'min_qty' => $post['min_qty'],
				'videoid' => $post['videoid'],
				//'in_slider' => $post['in_slider'],
				'position' => $post['position'],
				'virtual_products' => $post['virtual_products'],
				'brand_id' => $post['brand_id'],
				'time_update' => time(),
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
		} else {
			/*
				             * Lets get what is default tranlsation number
				             * in titles and convert it to url
				             * We want our plaform public ulrs to be in default
				             * language that we use
			*/
			$i = 0;
			foreach ($_POST['translations'] as $translation) {
				if ($translation == MY_DEFAULT_LANGUAGE_ABBR) {
					$myTranslationNum = $i;
				}
				$i++;
			}
			if (!$this->db->insert('pre_products', array(
				'image' => $post['image'],
				'shop_categorie' => $post['shop_categorie'],
				'quantity' => $post['quantity'],
				'product_type' => $post['product_type'],
				'product_pcs' => $post['product_pcs'],
				'min_qty' => $post['min_qty'],
				'videoid' => $post['videoid'],
				//'in_slider' => $post['in_slider'],
				'position' => $post['position'],
				'virtual_products' => $post['virtual_products'],
				'folder' => $post['folder'],
				'brand_id' => $post['brand_id'],
				'time' => time(),
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			$id = $this->db->insert_id();


			$this->db->where('refProduct_id', $id);
			$this->db->delete('product_attribute1');
			foreach ($post['refattributes_id'] as $key => $value) {
				if (isset($value[0]) && $value[0] != '') {
					$this->db->insert('product_attribute1', array(
						'refProduct_id' => $id,
						'refAttributesgroup_id' => $key,
						'refattributes_id' => $value[0]
					));
				}
			}



			foreach ($post['shop_attribute'] as $key => $value) {
				if (isset($value[0]) && $value[0] != '') {
					$this->db->insert('product_attribute', array(
						'preproductid' => $id,
						'keyid' => $key,
						'valueid' => $value[0],
					));
				}
			}
			$this->db->where('id', $id);
			if (!$this->db->update('pre_products', array(
				'url' => except_letters($_POST['title'][$myTranslationNum]) . '_' . $id,
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
		}
		$this->setProductTranslation($post, $id, $is_update);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
		}
	}

	private function setProductTranslation($post, $id, $is_update) {
		$i = 0;
		$current_trans = $this->getTranslations($id);
		foreach ($post['translations'] as $abbr) {
			$arr = array();
			$emergency_insert = false;
			if (!isset($current_trans[$abbr])) {
				$emergency_insert = true;
			}
			$post['title'][$i] = str_replace('"', "'", $post['title'][$i]);
			$post['price'][$i] = str_replace(' ', '', $post['price'][$i]);
			$post['price'][$i] = str_replace(',', '.', $post['price'][$i]);
			$post['price'][$i] = preg_replace("/[^0-9,.]/", "", $post['price'][$i]);
			$post['old_price'][$i] = str_replace(' ', '', $post['old_price'][$i]);
			$post['old_price'][$i] = str_replace(',', '.', $post['old_price'][$i]);
			$post['old_price'][$i] = preg_replace("/[^0-9,.]/", "", $post['old_price'][$i]);
			$arr = array(
				'title' => $post['title'][$i],
				'basic_description' => $post['basic_description'][$i],
				'description' => $post['description'][$i],
				'price' => $post['price'][$i],
				'old_price' => $post['old_price'][$i],
				'abbr' => $abbr,
				'for_id' => $id,
			);
			if ($is_update === true && $emergency_insert === false) {
				$abbr = $arr['abbr'];
				unset($arr['for_id'], $arr['abbr'], $arr['url']);
				if (!$this->db->where('abbr', $abbr)->where('for_id', $id)->update('pre_products_translations', $arr)) {
					log_message('error', print_r($this->db->error(), true));
				}
			} else {
				if (!$this->db->insert('pre_products_translations', $arr)) {
					log_message('error', print_r($this->db->error(), true));
				}
			}
			$i++;
		}
	}

	public function getTranslations($id) {
		$this->db->where('for_id', $id);
		$query = $this->db->get('pre_products_translations');
		$arr = array();
		foreach ($query->result() as $row) {
			$arr[$row->abbr]['title'] = $row->title;
			$arr[$row->abbr]['basic_description'] = $row->basic_description;
			$arr[$row->abbr]['description'] = $row->description;
			$arr[$row->abbr]['price'] = $row->price;
			$arr[$row->abbr]['old_price'] = $row->old_price;
		}
		return $arr;
	}

}

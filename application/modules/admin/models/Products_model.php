<?php

class Products_model extends CI_Model {

	public function __construct() {
		parent::__construct();
		include APPPATH . 'third_party/vendor/image-resize/imageresize.php';
	}

	public function deleteProduct($id) {
		$this->db->trans_begin();

		//rmdir($dirname);

		$this->db->where('products.id', $id);
		$query = $this->db->select('products.folder, products.image')->get('products');
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
		if (!$this->db->delete('products_translations')) {
			log_message('error', print_r($this->db->error(), true));
		}

		$this->db->where('productid', $id);
		if (!$this->db->delete('notificationdata')) {
			log_message('error', print_r($this->db->error(), true));
		}

		$this->db->where('productid', $id);
		if (!$this->db->delete('userrecentview')) {
			log_message('error', print_r($this->db->error(), true));
		}

		$this->db->where('productid', $id);
		if (!$this->db->delete('product_attribute')) {
			log_message('error', print_r($this->db->error(), true));
		}

		$this->db->where('id', $id);
		if (!$this->db->delete('products')) {
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
			$this->db->where("(products_translations.title LIKE '%$search_title%')");
		}
		if ($category != null) {
			$this->db->where('shop_categorie', $category);
		}
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
		return $this->db->count_all_results('products');
	}

	public function getProducts($limit, $page, $search_title = null, $orderby = null, $category = null, $vendor = null) {
		if ($search_title != null) {
			$search_title = trim($this->db->escape_like_str($search_title));
			$this->db->where("(products_translations.title LIKE '%$search_title%')");
		}
		if ($orderby !== null) {
			$ord = explode('=', $orderby);
			if (isset($ord[0]) && isset($ord[1])) {
				$this->db->order_by('products.' . $ord[0], $ord[1]);
			}
		} else {
			$this->db->order_by('products.id', 'desc');
		}
		if ($category != null) {
			$this->db->where('shop_categorie', $category);
		}
		if ($vendor != null) {
			$this->db->where('vendor_id', $vendor);
		}
		$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
		$query = $this->db->select('vendors.name as vendor_name, vendors.id as vendor_id, products.*, products_translations.title, products_translations.description, products_translations.price, products_translations.old_price, products_translations.abbr, products.url, products_translations.for_id, products_translations.basic_description')->get('products', $limit, $page);
		return $query->result();
	}

	public function numShopProducts() {
		return $this->db->count_all_results('products');
	}

	public function getOneProduct($id) {
		$this->db->select('vendors.name as vendor_name, vendors.id as vendor_id, products.*, products_translations.title,products_translations.theli_title');
		$this->db->where('products.id', $id);
		$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'inner');
		$this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
		$query = $this->db->get('products');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function productStatusChange($id, $to_status) {
		$this->db->where('id', $id);
		$result = $this->db->update('products', array('visibility' => $to_status));
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

			$this->db->where('productid', $id);
			if (!$this->db->delete('product_attribute')) {
				log_message('error', print_r($this->db->error(), true));
			}
			$this->db->where('productid', $id);
			if (!$this->db->delete('productcat')) {
				log_message('error', print_r($this->db->error(), true));
			}

			$this->db->where('refProduct_id', $id);
			$this->db->delete('product_attribute1');
			foreach ($post['refattributes_id'] as $key => $value) {
				foreach($value as $row){
					if ($row != '' && !empty($row)) {
						$this->db->insert('product_attribute1', array(
							'refProduct_id' => $id,
							'refAttributesgroup_id' => $key,
							'refattributes_id' => $row
						));
					}
				}
			}

			$this->db->where('productid', $id);
			$this->db->delete('productcat');
			foreach ($post['shop_categorie'] as $key => $value) {
				if (!empty($value[0])) {
					$this->db->insert('productcat', array(
						'productid' => $id,
						'catid' => $value,
						'timeanddate' => time(),
					));
				}
			}
			if(isset($post['connectedProduct'])){
				$this->db->where('refProductId', $id);
				$this->db->delete('connproduct');	
				foreach ($post['connectedProduct'] as $key => $value) {
					if (!empty($value[0])) {
						$this->db->insert('connproduct', array(
							'refProductId' => $id,
							'connProductId' => $value						
						));
					}
				}
			}
			// if(isset($_FILES['products_others_image'])){
				if (($_FILES['products_others_image']['name'][0]) != '') {				
					$products_others_image = multiImageUpload('products_others_image');
					foreach ($products_others_image as $poi) {
						$params = array();
						$params['refProduct_id'] = $id;
						$params['img_name'] = $poi[2]['file_name'];
						// $params['status'] = 1;
						$this->db->insert('product_image',$params);
					}
				}
			// }

			// foreach ($post['shop_attribute'] as $key => $value) {
			// 	if (!empty($value[0])) {
			// 		$this->db->insert('product_attribute', array(
			// 			'productid' => $id,
			// 			'keyid' => $key,
			// 			'valueid' => $value[0],
			// 		));
			// 	}
			// }
			isset($_POST['old_image']) ? $oldimg = $_POST['old_image'] : $oldimg = '';
			if (!$this->db->where('id', $id)->update('products', array(
				'designNo' => $post['designNo'],
				'image' => $post['image'] != null ? $_POST['image'] : $oldimg,
				// 'shop_categorie' => $post['shop_categorie'],
				'quantity' => $post['quantity'],
				// 'product_type' => $post['product_type'],
				'product_pcs' => $post['product_pcs'],
				'refPackagingtype_id' => $post['refPackagingtype_id'],
				'min_qty' => $post['min_qty'],				
				'videoid' => $post['videoid'],
				//'in_slider' => $post['in_slider'],
				'price1' => $post['price1'],
				'price2' => $post['price2'],
				'price3' => $post['price3'],
				'theli_price1' => $post['theli_price1'],
				'theli_price2' => $post['theli_price2'],
				'theli_price3' => $post['theli_price3'],
				// 'price4' => $post['price4'],
				'position' => $post['position'],
				'virtual_products' => $post['virtual_products'],
				'brand_id' => $post['brand_id'],
				'productviewtype' => implode(',', $post['productviewtype']),
				'productoffertype' => implode(',', $post['productoffertype']),
				'time_update' => time()
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			// echo $this->db->last_query();exit;
		} else {

			$i = 0;
			foreach ($_POST['translations'] as $translation) {
				if ($translation == MY_DEFAULT_LANGUAGE_ABBR) {
					$myTranslationNum = $i;
				}
				$i++;
			}
			if (!$this->db->insert('products', array(				
				'designNo' => $post['designNo'],
				'image' => $post['image'],
				// 'shop_categorie' => $post['shop_categorie'],
				'quantity' => $post['quantity'],
				// 'product_type' => $post['product_type'],
				'product_pcs' => $post['product_pcs'],
				'refPackagingtype_id' => $post['refPackagingtype_id'],
				'min_qty' => $post['min_qty'],
				
				'videoid' => $post['videoid'],
				//'in_slider' => $post['in_slider'],
				'price1' => $post['price1'],
				'price2' => $post['price2'],
				'price3' => $post['price3'],
				'theli_price1' => $post['theli_price1'],
				'theli_price2' => $post['theli_price2'],
				'theli_price3' => $post['theli_price3'],
				// 'price4' => $post['price4'],
				'position' => $post['position'],
				'virtual_products' => $post['virtual_products'],
				'folder' => $post['folder'],
				'brand_id' => $post['brand_id'],
				'productviewtype' => implode(',', $post['productviewtype']),
				'productoffertype' => implode(',', $post['productoffertype']),
				'time' => time()
			))) {
				log_message('error', print_r($this->db->error(), true));
			}

			$id = $this->db->insert_id();
			
			if (($_FILES['products_others_image']['name'][0]) != '') {				
				$products_others_image = multiImageUpload('products_others_image');
				foreach ($products_others_image as $poi) {
					$params = array();
					$params['refProduct_id'] = $id;
					$params['img_name'] = $poi[2]['file_name'];
					// $params['status'] = 1;
					$this->db->insert('product_image',$params);
				}
			}
			


			$this->sendproductnotification('New product added ' . $post['title'][0], $post['image'], $id);
			// foreach ($post['shop_attribute'] as $key => $value) {
			// 	if (!empty($value[0])) {
			// 		$this->db->insert('product_attribute', array(
			// 			'productid' => $id,
			// 			'keyid' => $key,
			// 			'valueid' => $value[0],
			// 		));
			// 	}
			// }
				
			// echo '<pre>';print_r($post['refattributes_id']);die;
			$this->db->where('refProduct_id', $id);
			$this->db->delete('product_attribute1');
			foreach ($post['refattributes_id'] as $key => $value) {
				foreach($value as $row){
					if ($row != '' && !empty($row)) {
						$this->db->insert('product_attribute1', array(
							'refProduct_id' => $id,
							'refAttributesgroup_id' => $key,
							'refattributes_id' => $row
						));
					}
				}
			}
					
			if (!empty($post['stock'])) {
				$this->db->insert('stock', array(
					'refProduct_id' => $id,
					'qty' => $post['stock'],
					'timeanddate' => time(),
				));
			}			

			$this->db->where('productid', $id);
			$this->db->delete('productcat');
			foreach ($post['shop_categorie'] as $key => $value) {
				if (!empty($value[0])) {
					$this->db->insert('productcat', array(
						'productid' => $id,
						'catid' => $value,
						'timeanddate' => time(),
					));
				}
			}

			if(isset($post['connectedProduct'])){
				$this->db->where('refProductId', $id);
				$this->db->delete('connproduct');
				foreach ($post['connectedProduct'] as $key => $value) {
					if (!empty($value[0])) {
						$this->db->insert('connproduct', array(
							'refProductId' => $id,
							'connProductId' => $value						
						));
					}
				}
			}
			$this->db->where('id', $id);
			if (!$this->db->update('products', array(
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


	public function remove_img($id) {
		$this->db->where('product_image_id', $id);
		$this->db->delete('product_image');
		return true;
	}

	public function getConnProducts() {		
		$this->db->select('products.id as p_id,products_translations.*');	
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');	
		$result = $this->db->get('products');		
		return $result->result_array();
	}
	public function getUsers() {		
		$this->db->select('id,name');			
		$result = $this->db->get('user_app');		
		return $result->result_array();
	}
	public function load_shipping($params){
        $userid = $params['userid'];
        $shipping = $this->db->query("SELECT * FROM useraddress WHERE userid=$userid AND (addresstype='Shipping' OR addresstype='Both')");
        return $shipping->result_array();
    }
	public function load_billing($params){
        $userid = $params['userid'];
        $billing= $this->db->query("SELECT * FROM useraddress WHERE userid=$userid AND (addresstype='Billing' OR addresstype='Both')");
        return $billing->result_array();
    }	

	public function addStock($post)
    {
        $this->db->insert('stock', array(
            'qty' => $post['qty'],
            'refProduct_id' => $post['refProduct_id'],                       
            'timeanddate' => time()
        ));
        $id = $this->db->insert_id();
        if ($id) {
            return true;
        } else {
            log_message('error', print_r($this->db->error(), true));
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
			// $post['price'][$i] = str_replace(' ', '', $post['price'][$i]);
			// $post['price'][$i] = str_replace(',', '.', $post['price'][$i]);
			// $post['price'][$i] = preg_replace("/[^0-9,.]/", "", $post['price'][$i]);
			$post['old_price'][$i] = str_replace(' ', '', $post['old_price'][$i]);
			$post['old_price'][$i] = str_replace(',', '.', $post['old_price'][$i]);
			$post['old_price'][$i] = preg_replace("/[^0-9,.]/", "", $post['old_price'][$i]);

			// echo $post['description'][$i];die;

			$arr = array(
				'title' => $post['title'][$i],
				'theli_title' => $post['theli_title'][$i],
				'basic_description' => $post['basic_description'][$i],
				'description' => $post['description'][$i],
				// 'price' => $post['price'][$i],
				'old_price' => $post['old_price'][$i],
				'abbr' => $abbr,
				'for_id' => $id,
			);
			if ($is_update === true && $emergency_insert === false) {
				$abbr = $arr['abbr'];
				unset($arr['for_id'], $arr['abbr'], $arr['url']);
				if (!$this->db->where('abbr', $abbr)->where('for_id', $id)->update('products_translations', $arr)) {
					log_message('error', print_r($this->db->error(), true));
				}
			} else {
				if (!$this->db->insert('products_translations', $arr)) {
					log_message('error', print_r($this->db->error(), true));
				}
			}
			$i++;
		}
	}

	public function getTranslations($id) {
		$this->db->where('for_id', $id);
		$query = $this->db->get('products_translations');
		$arr = array();
		foreach ($query->result() as $row) {
			$arr[$row->abbr]['title'] = $row->title;
			$arr[$row->abbr]['theli_title'] = $row->theli_title;
			$arr[$row->abbr]['basic_description'] = $row->basic_description;
			$arr[$row->abbr]['description'] = $row->description;
			$arr[$row->abbr]['price'] = $row->price;
			$arr[$row->abbr]['old_price'] = $row->old_price;
		}
		return $arr;
	}
	public function getMulticat($id) {
		$this->db->where('productid', $id);
		$query = $this->db->get('productcat');
		$arr = array();
		$i = 0;
		foreach ($query->result() as $row) {
			$arr[$i] = $row->catid;
			$i++;
		}
		return $arr;
	}
	public function getMultiConnProduct($id) {
		$this->db->where('refProductId', $id);
		$query = $this->db->get('connproduct');
		$arr = array();
		$i = 0;
		foreach ($query->result() as $row) {
			$arr[$i] = $row->connProductId;
			$i++;
		}
		return $arr;
	}
	public function sendproductnotification($title, $image, $pid) {
		$this->db->select('*');
		$this->db->where('fcmtoken !=', '');
		$result = $this->db->get('user_app');
		$this->db->last_query();
		$row = $result->result_array();
		$fcmtoken = array();
		$imgurl = base_url('attachments/shop_images/' . $image);
		foreach ($row as $rows) {			
			$notidata['title'] = $title;
			$notidata['productid'] = $pid;
			$notidata['userid'] = $rows['id'];
			$notidata['ordertype'] = 'Product';
			$notidata['dateandtime'] = time();
			$result_check = $this->db->insert('notificationdata', $notidata);
			$fcmtoken[] = $rows['fcmtoken'];
		}
		notifications($title, '', $fcmtoken, $imgurl, $title, $pid, 'product');
	}
}

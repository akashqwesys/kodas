<?php

class Likedislikepreproimg_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function deleteProduct($id) {
		$this->db->trans_begin();
		$this->db->where('id', $id);
		if (!$this->db->delete('user_app')) {
			log_message('error', print_r($this->db->error(), true));
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
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
		return $this->db->count_all_results('user_app');
	}

	public function getProducts($limit, $page, $search_title = null, $orderby = null, $category = null, $vendor = null, $status = null) {

		$this->db->where('likepreproduct.productid', $page);
		$this->db->where('likepreproduct.likestatus', $status);
		$this->db->join('user_app', 'user_app.id = likepreproduct.userid', 'left');
		$query = $this->db->select('user_app.name,user_app.mobilenumber')->get('likepreproduct');

		return $query->result();
	}

	public function numShopProducts() {
		return $this->db->count_all_results('user_app');
	}

	public function getOneProduct($id) {
		$this->db->select('user_app.*');
		$this->db->where('user_app.id', $id);
		$query = $this->db->get('user_app');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function productStatusChange($id, $to_status) {
		$this->db->where('id', $id);
		$result = $this->db->update('user_app', array('visibility' => $to_status));
		return $result;
	}

	public function getproductinfo($id) {
		$this->db->where('pre_products.id', $id);
		$this->db->limit(1);
		$query = $this->db->select('pre_products.image as product_image, pre_products.folder as imgfolder')->get('pre_products');
		$result = $query->result_array();
		$data = array();
		$image_link = array();
		$i = 0;
		$singalimg = $result[0]['product_image'];
		if (isset($singalimg) && $singalimg != '') {
			$imgnameextension = str_replace(base_url('attachments/shop_images/'), "", $singalimg);
			$without_extension = substr($imgnameextension, 0, strrpos($imgnameextension, "."));

			$this->db->where('likepreproductimg.imgname', $without_extension);
			$this->db->where('likestatus', '1');
			$querylike = $this->db->count_all_results('likepreproductimg');
			$nid = 1;

			$likeuserdata = $this->likedislikeuserdata($without_extension, '1');
			$dislikeuserdata = $this->likedislikeuserdata($without_extension, '0');
			$image_link[0]['Image'] = !empty($singalimg) ? base_url('attachments/shop_images/' . $singalimg) : '';
			$image_link[0]['ImageName'] = $without_extension;
			$image_link[0]['LikeStatus'] = $querylike;
			$image_link[0]['LikeUserData'] = $likeuserdata;
			$this->db->where('likepreproductimg.imgname', $without_extension);
			$this->db->where('likestatus', '0');
			$querylikedi = $this->db->count_all_results('likepreproductimg');
			$image_link[0]['DisLikeStatus'] = $querylikedi;
			$image_link[0]['DisLikeUserData'] = $dislikeuserdata;
			$a = 1;
		} else {
			$a = 0;
		}

		$multiimg = $result[0]['imgfolder'];
		$multiimgarray = $this->productmultiimg($multiimg);
		$pdfurl = $this->productmultiimg($multiimg, 0, 'pdfurl');

		foreach ($multiimgarray as $key => $value) {
			$imgnameextension = str_replace(base_url('attachments/shop_images/' . $multiimg . '/'), "", $value);
			$without_extension = substr($imgnameextension, 0, strrpos($imgnameextension, "."));
			$this->db->where('likepreproductimg.imgname', $without_extension);
			$this->db->where('likestatus', '0');
			$querydislike = $this->db->count_all_results('likepreproductimg');
			$this->db->where('likepreproductimg.imgname', $without_extension);
			$this->db->where('likestatus', '1');
			$querylike = $this->db->count_all_results('likepreproductimg');
			$likeuserdata = $this->likedislikeuserdata($without_extension, '1');
			$dislikeuserdata = $this->likedislikeuserdata($without_extension, '0');
			$image_link[$a]['Image'] = $value;
			$image_link[$a]['ImageName'] = $without_extension;
			$image_link[$a]['LikeStatus'] = $querylike;
			$image_link[$a]['LikeUserData'] = $likeuserdata;
			$image_link[$a]['DisLikeStatus'] = $querydislike;
			$image_link[$a]['DisLikeUserData'] = $dislikeuserdata;
			$a++;
		}

		return $image_link;
	}
	private function likedislikeuserdata($imgname, $status) {
		$this->db->select('user_app.name,user_app.mobilenumber');
		$this->db->join('user_app', 'user_app.id = likepreproductimg.userid', 'left');
		$this->db->where('likepreproductimg.likestatus', $status);
		$this->db->where('likepreproductimg.imgname', $imgname);
		$query = $this->db->get('likepreproductimg');
		$data = array();
		$i = 0;
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			foreach ($result as $key => $value) {
				$data[$i]['Name'] = $value['name'];
				$data[$i]['MobileNumber'] = $value['mobilenumber'];
				$i++;
			}
			return $data;
		} else {
			return false;
		}
	}
	private function productmultiimg($multiimg, $pos = 0, $pdfget = 0) {
		$output = array();
		if (isset($multiimg) && $multiimg != null) {
			$dir = 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $multiimg . DIRECTORY_SEPARATOR;
			if (is_dir($dir)) {
				if ($dh = opendir($dir)) {
					$a = 0;
					while (($file = readdir($dh)) !== false) {
						if (is_file($dir . $file)) {
							$extention = strtolower(substr($file, strrpos($file, '.') + 1));
							if ($extention != 'pdf' && $pdfget === 0) {
								$output[] = base_url('attachments/shop_images/' . $multiimg . '/' . $file);
							}
							if ($extention === 'pdf' && $pdfget === 'pdfurl') {
								$output[] = base_url('attachments/shop_images/' . $multiimg . '/' . $file);
							}
						}
						$a++;
					}
					closedir($dh);
					sort($output);
				}
			}
		}
		return $output;
	}

	public function setProduct($post, $id = 0) {
		if (!isset($post['premiumuser'])) {
			$post['premiumuser'] = 0;
		}
		$this->db->trans_begin();
		$is_update = false;
		if ($id > 0) {
			$is_update = true;
			if (!$this->db->where('id', $id)->update('user_app', array(
				'name' => $post['name'],
				'mobilenumber' => $post['mobilenumber'],
				'emailid' => $post['emailid'],
				'address' => $post['address'],
				'pviewcount' => $post['pviewcount'],
				'isverified' => $post['isverified'],
				'premiumuser' => $post['premiumuser'],
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			$firmnamelist = '';
			if (isset($_POST['firmname'])) {
				$firmnamelist = array_filter($_POST['firmname']);
			}

			if (!empty($firmnamelist)) {
				$this->db->where('userid', $id);
				if (!$this->db->delete('user_firmlist')) {
					log_message('error', print_r($this->db->error(), true));
				}
				foreach ($firmnamelist as $key => $value) {

					if (!$this->db->insert('user_firmlist', array(
						'userid' => $id,
						'firmname' => $value,
					))) {
						log_message('error', print_r($this->db->error(), true));
					}
				}
			}

		} else {
			/*
				             * Lets get what is default tranlsation number
				             * in titles and convert it to url
				             * We want our plaform public ulrs to be in default
				             * language that we use
			*/
			if (!$this->db->insert('user_app', array(
				'name' => $post['name'],
				'mobilenumber' => $post['mobilenumber'],
				'emailid' => $post['emailid'],
				'address' => $post['address'],
				'pviewcount' => $post['pviewcount'],
				'isverified' => $post['isverified'],
				'premiumuser' => $post['premiumuser'],
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			$id = $this->db->insert_id();
			$firmnamelist = array_filter($_POST['firmname']);
			if (!empty($firmnamelist)) {
				foreach ($firmnamelist as $key => $value) {
					if (!$this->db->insert('user_firmlist', array(
						'userid' => $id,
						'firmname' => $value,
					))) {
						log_message('error', print_r($this->db->error(), true));
					}
				}
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
		if (isset($post['translations'])) {
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
	}

	public function getTranslations($id) {
		$this->db->where('for_id', $id);
		$query = $this->db->get('products_translations');
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

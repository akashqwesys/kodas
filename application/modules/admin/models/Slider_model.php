<?php

class Slider_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function deleteProduct($id) {
		$this->db->where('app_slider.id', $id);
		$query = $this->db->select('app_slider.imagename')->get('app_slider');
		$result = $query->row_array();

		if (!empty($result['imagename'])) {
			$imagedelete = $_SERVER['DOCUMENT_ROOT'] . '/attachments/slider_img/' . $result['imagename'];
			@unlink($imagedelete);
		}
		$this->db->trans_begin();
		$this->db->where('id', $id);
		if (!$this->db->delete('app_slider')) {
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

	public function getSlider($limit, $page, $search_title = null, $orderby = null, $category = null, $vendor = null, $type) {
		if ($orderby !== null) {
			$ord = explode('=', $orderby);
			if (isset($ord[0]) && isset($ord[1])) {
				$this->db->order_by('app_slider.' . $ord[0], $ord[1]);
			}
		}
		if ($type == 'app') {
			$this->db->where('app_slider.slider_type', 'Application');
		}
		if ($type == 'web') {
			$this->db->where('app_slider.slider_type', 'Website');
		}
		$this->db->order_by('app_slider.id', 'DESC');
		$this->db->where('products.visibility', 1);
		$this->db->join('products', 'products.id = app_slider.productid', 'left');
		$this->db->join('products_translations', 'products_translations.for_id = app_slider.productid', 'left');
		$query = $this->db->select('products_translations.title,app_slider.imagename,app_slider.position,app_slider.youtubeurl,app_slider.id, `app_slider`.`productid`, `app_slider`.`slider_type`')->get('app_slider', $limit, $page);

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

	public function setSlider($post, $id = 0) {

		$this->db->trans_begin();
		$is_update = false;
		if ($id > 0) {

			$is_update = true;
			if (!$this->db->where('id', $id)->update('app_slider', array(
				'imagename' => $post['image'],
				'productid' => $post['productid'],
				'slider_type' => $post['slider_type'],
				'position' => $post['postition'],
				'youtubeurl' => $post['youtubeurl'],
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
			if (!$this->db->insert('app_slider', array(
				'imagename' => $post['image'],
				'productid' => $post['productid'],
				'slider_type' => $post['slider_type'],
				'position' => $post['postition'],
				'youtubeurl' => $post['youtubeurl'],
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

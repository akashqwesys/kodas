<?php
class About_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function deleteAbout($id) {
		$this->db->trans_begin();
		$this->db->where('id', $id);
		if (!$this->db->delete('aboutpage')) {
			log_message('error', print_r($this->db->error(), true));
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
		}
	}

	public function AboutsCount() {
		// if ($search_title != null) {
		// 	$search_title = trim($this->db->escape_like_str($search_title));
		// 	$this->db->where("(products_translations.title LIKE '%$search_title%')");
		// }
		// if ($category != null) {
		// 	$this->db->where('shop_categorie', $category);
		// }
		return $this->db->count_all_results('aboutpage');
	}

	public function getAbouts($limit, $page, $search_title = null, $orderby = null, $category = null, $vendor = null) {
		if ($orderby !== null) {
			$ord = explode('=', $orderby);
			if (isset($ord[0]) && isset($ord[1])) {
				$this->db->order_by('aboutpage.' . $ord[0], $ord[1]);
			}
		}
		$query = $this->db->select('id,title,description')->get('aboutpage', $limit, $page);

		return $query->result();
	}

	public function numShopProducts() {
		return $this->db->count_all_results('aboutpage');
	}

	public function getAbout($id) {
		$this->db->select('aboutpage.*');
		$this->db->where('aboutpage.id', $id);
		$query = $this->db->get('aboutpage');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function productStatusChange($id, $to_status) {
		$this->db->where('id', $id);
		$result = $this->db->update('aboutpage', array('visibility' => $to_status));
		return $result;
	}

	public function setAbout($post, $id = 0) {

		$is_update = false;
		if ($id > 0) {
			$is_update = true;
			if (!$this->db->where('id', $id)->update('aboutpage', array(
				'title' => $post['title'],
				'description' => $post['description'],
			))) {
				log_message('error', print_r($this->db->error(), true));
			}

		} else {

			if (!$this->db->insert('aboutpage', array(
				'title' => $post['title'],
				'description' => $post['description'],
				'dateandtime' => time(),
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			$id = $this->db->insert_id();
		}

		// $this->setProductTranslation($post, $id, $is_update);
		// if ($this->db->trans_status() === FALSE) {
		// 	$this->db->trans_rollback();
		// 	show_error(lang('database_error'));
		// } else {
		// 	$this->db->trans_commit();
		// }
	}

}

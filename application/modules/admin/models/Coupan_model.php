<?php
class Coupan_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function deleteCoupan($id) {
		$this->db->trans_begin();
		$this->db->where('id', $id);
		if (!$this->db->delete('coupan')) {
			log_message('error', print_r($this->db->error(), true));
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
		}
	}

	public function CoupansCount() {
		// if ($search_title != null) {
		// 	$search_title = trim($this->db->escape_like_str($search_title));
		// 	$this->db->where("(products_translations.title LIKE '%$search_title%')");
		// }
		// if ($category != null) {
		// 	$this->db->where('shop_categorie', $category);
		// }
		return $this->db->count_all_results('coupan');
	}

	public function getCoupans($limit, $page, $search_title = null, $orderby = null, $category = null, $vendor = null) {
		if ($orderby !== null) {
			$ord = explode('=', $orderby);
			if (isset($ord[0]) && isset($ord[1])) {
				$this->db->order_by('coupan.' . $ord[0], $ord[1]);
			}
		}
		$query = $this->db->select('id,name,code,codelimit,enddate,isactive,discount,discounttype')->get('coupan', $limit, $page);

		return $query->result();
	}

	public function numShopProducts() {
		return $this->db->count_all_results('coupan');
	}

	public function getCoupan($id) {
		$this->db->select('coupan.*');
		$this->db->where('coupan.id', $id);
		$query = $this->db->get('coupan');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function productStatusChange($id, $to_status) {
		$this->db->where('id', $id);
		$result = $this->db->update('coupan', array('visibility' => $to_status));
		return $result;
	}

	public function setCoupan($post, $id = 0) {

		$is_update = false;
		if ($id > 0) {
			$is_update = true;
			if (!$this->db->where('id', $id)->update('coupan', array(
				'name' => $post['name'],
				'code' => $post['code'],
				'isactive' => $post['isactive'],
				'discount' => $post['discount'],
				'discounttype' => $post['discounttype'],
				// 'codelimit' => $post['codelimit'],
				'enddate' => strtotime($post['enddate']),
			))) {
				log_message('error', print_r($this->db->error(), true));
			}

		} else {

			if (!$this->db->insert('coupan', array(
				'name' => $post['name'],
				'code' => $post['code'],
				'isactive' => $post['isactive'],
				'discount' => $post['discount'],
				'discounttype' => $post['discounttype'],
				// 'codelimit' => $post['codelimit'],
				'enddate' => strtotime($post['enddate']),
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			$id = $this->db->insert_id();
		}
	}

}

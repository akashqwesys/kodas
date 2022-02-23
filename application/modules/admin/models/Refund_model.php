<?php
class Refund_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function deleteRefund($id) {
		$this->db->trans_begin();
		$this->db->where('id', $id);
		if (!$this->db->delete('refundpage')) {
			log_message('error', print_r($this->db->error(), true));
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
		}
	}

	public function RefundsCount() {
		return $this->db->count_all_results('refundpage');
	}

	public function getRefunds($limit, $page, $search_title = null, $orderby = null, $category = null, $vendor = null) {
		if ($orderby !== null) {
			$ord = explode('=', $orderby);
			if (isset($ord[0]) && isset($ord[1])) {
				$this->db->order_by('refundpage.' . $ord[0], $ord[1]);
			}
		}
		$query = $this->db->select('id,title,description')->get('refundpage', $limit, $page);

		return $query->result();
	}

	public function numShopProducts() {
		return $this->db->count_all_results('refundpage');
	}

	public function getRefund($id) {
		$this->db->select('refundpage.*');
		$this->db->where('refundpage.id', $id);
		$query = $this->db->get('refundpage');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function productStatusChange($id, $to_status) {
		$this->db->where('id', $id);
		$result = $this->db->update('refundpage', array('visibility' => $to_status));
		return $result;
	}

	public function setRefund($post, $id = 0) {

		$is_update = false;
		if ($id > 0) {
			$is_update = true;
			if (!$this->db->where('id', $id)->update('refundpage', array(
				'title' => $post['title'],
				'description' => $post['description'],
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			else{
				return true;
			}

		} else {

			if (!$this->db->insert('refundpage', array(
				'title' => $post['title'],
				'description' => $post['description'],
				'dateandtime' => time(),
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			$id = $this->db->insert_id();
			if(!empty($id)){
				return true;
			}
		}
	}

}

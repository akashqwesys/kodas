<?php
class Mobileuser_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function deleteMobileuser($id) {
		$this->db->trans_begin();
		$this->db->where('id', $id);
		$this->db->where('users.usertype', 'mobileuser');
		if (!$this->db->delete('users')) {
			log_message('error', print_r($this->db->error(), true));
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
		}
	}

	public function MobileuserCount() {
		$this->db->where('users.usertype', 'mobileuser');
		return $this->db->count_all_results('users');
	}

	public function getMobileusers($limit, $page) {
		$this->db->where('users.usertype', 'mobileuser');
		$query = $this->db->select('*')->get('users', $limit, $page);
		return $query->result();
	}

	public function getMobileuser($id) {
		$this->db->select('users.*');
		$this->db->where('users.id', $id);
		$this->db->where('users.usertype', 'mobileuser');
		$query = $this->db->get('users');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}

	public function setMobileuser($post, $id = 0) {
		$is_update = false;
		if ($id > 0) {
			$is_update = true;
			$dataup['username'] = $post['name'];
			$dataup['name'] = $post['name'];
			$dataup['mobilenumber'] = $post['mobilenumber'];
			$dataup['usertype'] = 'mobileuser';
			if (trim($post['passwordm']) == '') {
				unset($post['passwordm']);
			} else {
				$dataup['password'] = md5($post['passwordm']);
			}
			if (!$this->db->where('id', $id)->update('users', $dataup)) {
				log_message('error', print_r($this->db->error(), true));
			}
		} else {
			$datain['username'] = $post['name'];
			$datain['name'] = $post['name'];
			$datain['mobilenumber'] = $post['mobilenumber'];
			$datain['usertype'] = 'mobileuser';
			$datain['password'] = md5($post['passwordm']);
			if (!$this->db->insert('users', $datain)) {
				log_message('error', print_r($this->db->error(), true));
			}
			$id = $this->db->insert_id();
		}
	}

}

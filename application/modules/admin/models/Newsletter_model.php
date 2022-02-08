<?php
class Newsletter_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function deleteNewsletter($id) {
		$this->db->trans_begin();
		$this->db->where('id', $id);
		if (!$this->db->delete('newsletter')) {
			log_message('error', print_r($this->db->error(), true));
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
		}
	}

	public function newslettersCount() {
		return $this->db->count_all_results('newsletter');
	}

	public function getNewsletters($limit, $page) {
		$this->db->order_by('id', 'DESC');
		$query = $this->db->select('id,email,dateadded')->get('newsletter', $limit, $page);
		return $query->result();
	}
}

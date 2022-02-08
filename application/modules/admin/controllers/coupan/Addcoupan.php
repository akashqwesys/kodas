<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Addcoupan extends ADMIN_Controller {
	private $num_rows = 10;

	public function __construct() {
		parent::__construct();
		$this->load->model(array(
			'Coupan_model', 'Languages_model',
		));
	}

	public function index($page = 0, $id = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addcoupan', $adminid) & $id == 0) {redirect('admin');}
		if (!in_array('editcoupan', $adminid) & $id != 0) {redirect('admin');}
		$is_update = false;
		$trans_load = null;
		// if ($id > 0 && $_POST == null) {
		// 	$_POST = $this->Coupan_model->getCoupan($id);
		// }
		if (isset($_POST['submit'])) {
			if (isset($_GET['to_lang'])) {
				$id = 0;
			}
			$code = $_POST['code'];

			$exists = $this->db->query("Select code from coupan where(code='" . $code . "') Limit 1");
			if ($exists->num_rows() > 0) {
				$this->session->set_flashdata('result_publish', 'Coupan With Same Code Alredy Exits!');
				redirect('admin/addcoupan');
			} else {
				$this->Coupan_model->setCoupan($_POST);
			}

			if ($id == 0) {
				$this->session->set_flashdata('result_publish', 'Create Coupan Successfully!');
				$this->saveHistory('Success create Coupan');
			} else {
				$this->session->set_flashdata('result_publish', 'Updated Coupan Successfully!');
				$this->saveHistory('Updated This Coupan ' . $id);
			}
		}

		if (isset($_POST['update'])) {
			if (isset($_GET['to_lang'])) {
				$id = 0;
			}
			$code = $_POST['code'];

			$updateid = $_POST['updateid'];

			$exists = $this->db->query("Select code from coupan where(code='" . $code . "') AND id != $updateid Limit 1");
			if ($exists->num_rows() > 0) {
				$this->session->set_flashdata('result_publish', 'Coupan With Same Code Alredy Exits!');
				redirect('admin/addcoupan');
			} else {
				$this->session->set_flashdata('result_publish', 'Updated Coupan Successfully!');
				$this->Coupan_model->setCoupan($_POST, $_POST['updateid']);
			}

			if ($id == 0) {
				$this->session->set_flashdata('result_publish', 'Updated Coupan Successfully!');
				$this->saveHistory('Success create Coupan');
			} else {
				$this->session->set_flashdata('result_publish', 'Updated Coupan Successfully!');
				$this->saveHistory('Updated This Coupan ' . $id);
			}
		}

		if (isset($_GET['delete'])) {
			$this->Coupan_model->deleteCoupan($_GET['delete']);
			$this->session->set_flashdata('result_publish', 'coupan is deleted!');
			$this->saveHistory('Delete coupan id - ' . $_GET['delete']);
			redirect('admin/addcoupan');
		}

		$data = array();
		$head = array();
		$head['title'] = 'Coupan';
		$head['description'] = '!';
		$head['keywords'] = '';
		$data['id'] = $id;
		$data['languages'] = $this->Languages_model->getLanguages();
		$data['trans_load'] = $trans_load;
		$rowscount = $this->Coupan_model->CoupansCount();
		$data['coupanlist'] = $this->Coupan_model->getCoupans($this->num_rows, $page);
		if (isset($_GET['edit'])) {
			$data['singlecoupanlist'] = $this->Coupan_model->getCoupan($_GET['edit']);
		}
		$data['links_pagination'] = pagination('admin/addcoupan', $rowscount, $this->num_rows, 3);
		$this->load->view('_parts/header', $head);
		$this->load->view('coupan/addcoupan', $data);
		$this->load->view('_parts/footer');
		$this->saveHistory('Go to Add Coupan');
	}

	function check_coupan($coupanid) {
		$unique_number = !empty($coupanid) ? $coupanid : 0;
		$exists = $this->db->query("Select * from coupan where(id='" . $unique_number . "') Limit 1");
		if ($exists->num_rows() > 0) {
			$results = $this->check_number();
			// echo "MATCH FOUND";
		} else {
			$results = $unique_number;
			// echo "MATCH NOT FOUND";
			return $results;
		}
	}

}

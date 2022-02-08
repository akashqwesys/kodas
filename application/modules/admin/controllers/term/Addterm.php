<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Addterm extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array(
			'Term_model', 'Languages_model',
		));
	}

	public function index($id = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addterm', $adminid) & $id == 0) {redirect('admin');}
		if (!in_array('editterm', $adminid) & $id != 0) {redirect('admin');}
		$is_update = false;
		$trans_load = null;
		if ($id > 0 && $_POST == null) {
			$_POST = $this->Term_model->getTerm($id);
		}
		if (isset($_POST['submit'])) {
			if (isset($_GET['to_lang'])) {
				exit;
				$id = 0;
			}
			$this->Term_model->setTerm($_POST, $id);
			if ($id == 0) {
				$this->session->set_flashdata('result_publish', 'Create Term Successfully!');
				$this->saveHistory('Success create Term');
			} else {
				$this->session->set_flashdata('result_publish', 'Updated Term Successfully!');
				$this->saveHistory('Updated This Term ' . $id);
			}
			// if (isset($_SESSION['filter']) && $id > 0) {
			// 	$get = '';
			// 	foreach ($_SESSION['filter'] as $key => $value) {
			// 		$get .= trim($key) . '=' . trim($value) . '&';
			// 	}
			// 	redirect(base_url('admin/listterm?' . $get));
			// } else {
			// 	redirect('admin/listterm');
			// }
		}
		$data = array();
		$head = array();
		$head['title'] = 'Administration - Publish Product';
		$head['description'] = '!';
		$head['keywords'] = '';
		$data['id'] = $id;
		$data['languages'] = $this->Languages_model->getLanguages();
		$data['trans_load'] = $trans_load;
		$this->load->view('_parts/header', $head);
		$this->load->view('term/addterm', $data);
		$this->load->view('_parts/footer');
		$this->saveHistory('Go to Add Term');
	}

}

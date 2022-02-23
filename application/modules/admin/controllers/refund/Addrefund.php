<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Addrefund extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array(
			'Refund_model', 'Languages_model',
		));
	}

	public function index($id = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addrefund', $adminid) & $id == 0) {redirect('admin');}
		if (!in_array('editrefund', $adminid) & $id != 0) {redirect('admin');}
		$is_update = false;
		$trans_load = null;
		if ($id > 0 && $_POST == null) {
			$_POST = $this->Refund_model->getRefund($id);
		}
		if (isset($_POST['submit'])) {
			if (isset($_GET['to_lang'])) {
				exit;
				$id = 0;
			}
			$res=$this->Refund_model->setRefund($_POST, $id);
			if(!empty($res)){
				redirect('admin/listrefund');	
			}
			if ($id == 0) {
				$this->session->set_flashdata('result_publish', 'Create Refund Successfully!');
				$this->saveHistory('Success create Refund');
			} else {
				$this->session->set_flashdata('result_publish', 'Updated Refund Successfully!');
				$this->saveHistory('Updated This Refund ' . $id);
			}
			// if (isset($_SESSION['filter']) && $id > 0) {
			// 	$get = '';
			// 	foreach ($_SESSION['filter'] as $key => $value) {
			// 		$get .= trim($key) . '=' . trim($value) . '&';
			// 	}
			// 	redirect(base_url('admin/listrefund?' . $get));
			// } else {
			// 	redirect('admin/listrefund');
			// }
		}
		$data = array();
		$head = array();
		$head['title'] = 'Administration - Publish Refund';
		$head['description'] = '!';
		$head['keywords'] = '';
		$data['id'] = $id;
		$data['languages'] = $this->Languages_model->getLanguages();
		$data['trans_load'] = $trans_load;
		$this->load->view('_parts/header', $head);
		$this->load->view('refund/addrefund', $data);
		$this->load->view('_parts/footer');
		$this->saveHistory('Go to Add Refund');
	}

}

<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Addprivacy extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array(
			'Privacy_model', 'Languages_model',
		));
	}

	public function index($id = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addprivacy', $adminid) & $id == 0) {redirect('admin');}
		if (!in_array('editprivacy', $adminid) & $id != 0) {redirect('admin');}
		$is_update = false;
		$trans_load = null;
		if ($id > 0 && $_POST == null) {
			$_POST = $this->Privacy_model->getPrivacy($id);
		}
		if (isset($_POST['submit'])) {
			if (isset($_GET['to_lang'])) {
				exit;
				$id = 0;
			}
			$this->Privacy_model->setPrivacy($_POST, $id);
			if ($id == 0) {
				$this->session->set_flashdata('result_publish', 'Create Privacy Successfully!');
				$this->saveHistory('Success create Privacy');
			} else {
				$this->session->set_flashdata('result_publish', 'Updated Privacy Successfully!');
				$this->saveHistory('Updated This Privacy ' . $id);
			}
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
		$this->load->view('privacy/addprivacy', $data);
		$this->load->view('_parts/footer');
		$this->saveHistory('Go to Add Privacy');
	}

}

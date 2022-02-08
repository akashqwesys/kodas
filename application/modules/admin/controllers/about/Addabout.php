<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Addabout extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array(
			'About_model', 'Languages_model',
		));
	}

	public function index($id = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addabout', $adminid) & $id == 0) {redirect('admin');}
		if (!in_array('editabout', $adminid) & $id != 0) {redirect('admin');}
		$is_update = false;
		$trans_load = null;
		if ($id > 0 && $_POST == null) {
			$_POST = $this->About_model->getAbout($id);
		}
		if (isset($_POST['submit'])) {
			if (isset($_GET['to_lang'])) {
				exit;
				$id = 0;
			}
			$this->About_model->setAbout($_POST, $id);
			if ($id == 0) {
				$this->session->set_flashdata('result_publish', 'Create About Successfully!');
				$this->saveHistory('Success create About');
			} else {
				$this->session->set_flashdata('result_publish', 'Updated About Successfully!');
				$this->saveHistory('Updated This About ' . $id);
			}
			// if (isset($_SESSION['filter']) && $id > 0) {
			// 	$get = '';
			// 	foreach ($_SESSION['filter'] as $key => $value) {
			// 		$get .= trim($key) . '=' . trim($value) . '&';
			// 	}
			// 	redirect(base_url('admin/listabout?' . $get));
			// } else {
			// 	redirect('admin/listabout');
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
		$this->load->view('about/addabout', $data);
		$this->load->view('_parts/footer');
		$this->saveHistory('Go to Add About');
	}

}

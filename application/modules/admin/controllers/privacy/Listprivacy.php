<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Listprivacy extends ADMIN_Controller {

	private $num_rows = 10;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Privacy_model'));
	}

	public function index($page = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addprivacy', $adminid) || !in_array('editprivacy', $adminid) || !in_array('delprivacy', $adminid)) {redirect('admin');}
		$data = array();
		$head = array();
		$head['title'] = 'Administration - View privacy';
		$head['description'] = '!';
		$head['keywords'] = '';

		if (isset($_GET['delete'])) {
			if (!in_array('delprivacy', $adminid)) {redirect('admin');}
			$this->Privacy_model->deletePrivacy($_GET['delete']);
			$this->session->set_flashdata('result_delete', 'privacy is deleted!');
			$this->saveHistory('Delete privacy id - ' . $_GET['delete']);
			redirect('admin/listprivacy');
		}
		$orderby = null;
		if ($this->input->get('order_by') !== NULL) {
			$orderby = $this->input->get('order_by');
			$_SESSION['filter']['order_by '] = $orderby;
		}

		$rowscount = $this->Privacy_model->PrivacysCount();
		$data['privacylist'] = $this->Privacy_model->getPrivacys($this->num_rows, $page, $orderby);
		$data['links_pagination'] = pagination('admin/listprivacy', $rowscount, $this->num_rows, 3);
		$this->saveHistory('Go to products');
		$this->load->view('_parts/header', $head);
		$this->load->view('privacy/listprivacy', $data);
		$this->load->view('_parts/footer');
	}

	public function getProductInfo($id, $noLoginCheck = false) {
		if ($noLoginCheck == false) {
			$this->login_check();
		}
		return $this->Privacy_model->getOneProduct($id);
	}

	public function productStatusChange() {
		$this->login_check();
		$result = $this->Privacy_model->productStatusChange($_POST['id'], $_POST['to_status']);
		if ($result == true) {
			echo 1;
		} else {
			echo 0;
		}
		$this->saveHistory('Change product id ' . $_POST['id'] . ' to status ' . $_POST['to_status']);
	}

}

<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Listterm extends ADMIN_Controller {

	private $num_rows = 10;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Term_model'));
	}

	public function index($page = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addterm', $adminid) || !in_array('editterm', $adminid) || !in_array('delterm', $adminid)) {redirect('admin');}
		$data = array();
		$head = array();
		$head['title'] = 'Administration - View term';
		$head['description'] = '!';
		$head['keywords'] = '';

		if (isset($_GET['delete'])) {
			if (!in_array('delterm', $adminid)) {redirect('admin');}
			$this->Term_model->deleteTerm($_GET['delete']);
			$this->session->set_flashdata('result_delete', 'term is deleted!');
			$this->saveHistory('Delete term id - ' . $_GET['delete']);
			redirect('admin/listterm');
		}
		$orderby = null;
		if ($this->input->get('order_by') !== NULL) {
			$orderby = $this->input->get('order_by');
			$_SESSION['filter']['order_by '] = $orderby;
		}

		$rowscount = $this->Term_model->TermsCount();
		$data['termlist'] = $this->Term_model->getTerms($this->num_rows, $page, $orderby);
		$data['links_pagination'] = pagination('admin/listterm', $rowscount, $this->num_rows, 3);
		$this->saveHistory('Go to products');
		$this->load->view('_parts/header', $head);
		$this->load->view('term/listterm', $data);
		$this->load->view('_parts/footer');
	}

	public function getProductInfo($id, $noLoginCheck = false) {
		if ($noLoginCheck == false) {
			$this->login_check();
		}
		return $this->Term_model->getOneProduct($id);
	}

	public function productStatusChange() {
		$this->login_check();
		$result = $this->Term_model->productStatusChange($_POST['id'], $_POST['to_status']);
		if ($result == true) {
			echo 1;
		} else {
			echo 0;
		}
		$this->saveHistory('Change product id ' . $_POST['id'] . ' to status ' . $_POST['to_status']);
	}

}

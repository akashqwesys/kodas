<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Listrefund extends ADMIN_Controller {
	private $num_rows = 10;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Refund_model'));
	}

	public function index($page = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addrefund', $adminid) || !in_array('editrefund', $adminid) || !in_array('delrefund', $adminid)) {redirect('admin');}
		$data = array();
		$head = array();
		$head['title'] = 'Administration - View Refund';
		$head['description'] = '!';
		$head['keywords'] = '';

		if (isset($_GET['delete'])) {
			if (!in_array('delrefund', $adminid)) {redirect('admin');}
			$this->Refund_model->deleteRefund($_GET['delete']);
			$this->session->set_flashdata('result_delete', 'refund is deleted!');
			$this->saveHistory('Delete refund id - ' . $_GET['delete']);
			redirect('admin/listrefund');
		}
		$orderby = null;
		if ($this->input->get('order_by') !== NULL) {
			$orderby = $this->input->get('order_by');
			$_SESSION['filter']['order_by '] = $orderby;
		}

		$rowscount = $this->Refund_model->RefundsCount();
		$data['refundlist'] = $this->Refund_model->getRefunds($this->num_rows, $page, $orderby);
		$data['links_pagination'] = pagination('admin/listrefund', $rowscount, $this->num_rows, 3);
		$this->saveHistory('Go to products');
		$this->load->view('_parts/header', $head);
		$this->load->view('refund/listrefund', $data);
		$this->load->view('_parts/footer');
	}

	public function getProductInfo($id, $noLoginCheck = false) {
		if ($noLoginCheck == false) {
			$this->login_check();
		}
		return $this->Refund_model->getOneProduct($id);
	}

	public function productStatusChange() {
		$this->login_check();
		$result = $this->Refund_model->productStatusChange($_POST['id'], $_POST['to_status']);
		if ($result == true) {
			echo 1;
		} else {
			echo 0;
		}
		$this->saveHistory('Change product id ' . $_POST['id'] . ' to status ' . $_POST['to_status']);
	}

}

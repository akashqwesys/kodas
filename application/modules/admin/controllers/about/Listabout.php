<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Listabout extends ADMIN_Controller {

	private $num_rows = 10;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('About_model'));
	}

	public function index($page = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addabout', $adminid) || !in_array('editabout', $adminid) || !in_array('delabout', $adminid)) {redirect('admin');}
		$data = array();
		$head = array();
		$head['title'] = 'Administration - View about';
		$head['description'] = '!';
		$head['keywords'] = '';

		if (isset($_GET['delete'])) {
			if (!in_array('delabout', $adminid)) {redirect('admin');}
			$this->About_model->deleteAbout($_GET['delete']);
			$this->session->set_flashdata('result_delete', 'about is deleted!');
			$this->saveHistory('Delete about id - ' . $_GET['delete']);
			redirect('admin/listabout');
		}

		// unset($_SESSION['filter']);
		// $search_title = null;
		// if ($this->input->get('search_title') !== NULL) {
		// 	$search_title = $this->input->get('search_title');
		// 	$_SESSION['filter']['search_title'] = $search_title;
		// 	$this->saveHistory('Search for product title - ' . $search_title);
		// }
		$orderby = null;
		if ($this->input->get('order_by') !== NULL) {
			$orderby = $this->input->get('order_by');
			$_SESSION['filter']['order_by '] = $orderby;
		}
		// $category = null;
		// if ($this->input->get('category') !== NULL) {
		// 	$category = $this->input->get('category');
		// 	$_SESSION['filter']['category '] = $category;
		// 	$this->saveHistory('Search for product code - ' . $category);
		// }
		// $vendor = null;
		// if ($this->input->get('show_vendor') !== NULL) {
		// 	$vendor = $this->input->get('show_vendor');
		// }
		$rowscount = $this->About_model->AboutsCount();
		$data['aboutlist'] = $this->About_model->getAbouts($this->num_rows, $page, $orderby);
		$data['links_pagination'] = pagination('admin/listabout', $rowscount, $this->num_rows, 3);
		// echo "<pre>";
		// print_r($data);
		$this->saveHistory('Go to products');
		$this->load->view('_parts/header', $head);
		$this->load->view('about/listabout', $data);
		$this->load->view('_parts/footer');
	}

	public function getProductInfo($id, $noLoginCheck = false) {
		/*
			         * if method is called from public(template) page
		*/
		if ($noLoginCheck == false) {
			$this->login_check();
		}
		return $this->About_model->getOneProduct($id);
	}

	/*
		     * called from ajax
	*/

	public function productStatusChange() {
		$this->login_check();
		$result = $this->About_model->productStatusChange($_POST['id'], $_POST['to_status']);
		if ($result == true) {
			echo 1;
		} else {
			echo 0;
		}
		$this->saveHistory('Change product id ' . $_POST['id'] . ' to status ' . $_POST['to_status']);
	}

}

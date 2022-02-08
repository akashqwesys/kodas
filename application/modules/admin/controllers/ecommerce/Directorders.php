<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Directorders extends ADMIN_Controller {

	private $num_rows = 10;

	public function __construct() {
		parent::__construct();
		$this->load->library('SendMail');
		$this->load->model(array('Directorders_model', 'Home_admin_model'));
	}

	public function index($page = 0) {

		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('viewdirectorder', $adminid)) {redirect('admin');}
		$data = array();
		$head = array();
		$head['title'] = 'Administration - Orders';
		$head['description'] = '!';
		$head['keywords'] = '';

		$order_by = null;
		if (isset($_GET['order_by'])) {
			$order_by = $_GET['order_by'];
		}

		$status = null;
		if (isset($_GET['status'])) {
			$status = $_GET['status'];
		}

		$startdate = null;
		if (isset($_GET['startdate'])) {
			$startdate = $_GET['startdate'];
		}

		$enddate = null;
		if (isset($_GET['enddate'])) {
			$enddate = $_GET['enddate'];
		}

		$orderid = null;
		if (isset($_GET['orderid'])) {
			$orderid = $_GET['orderid'];
		}

		$rowscount = $this->Directorders_model->ordersCount($status, $startdate, $enddate, $orderid);
		$data['orders'] = $this->Directorders_model->orders($this->num_rows, $page, $order_by, $status, $startdate, $enddate, $orderid);
		$data['links_pagination'] = pagination('admin/directorders', $rowscount, $this->num_rows, 3);
		$data['paypal_sandbox'] = $this->Home_admin_model->getValueStore('paypal_sandbox');
		$data['paypal_email'] = $this->Home_admin_model->getValueStore('paypal_email');
		$data['cashondelivery_visibility'] = $this->Home_admin_model->getValueStore('cashondelivery_visibility');
		$data['bank_account'] = $this->Directorders_model->getBankAccountSettings();
		$this->load->view('_parts/header', $head);
		$this->load->view('ecommerce/directorders', $data);
		$this->load->view('_parts/footer');
		if ($page == 0) {
			$this->saveHistory('Go to orders page');
		}
	}

	public function changeOrdersOrderStatus() {
		$this->login_check();

		$result = false;
		$sendedVirtualProducts = true;
		$virtualProducts = $this->Home_admin_model->getValueStore('virtualProducts');
		/*
			         * If we want to use Virtual Products
			         * Lets send email with download links to user email
			         * In error logs will be saved if cant send email from PhpMailer
		*/
		if ($virtualProducts == 1) {
			if ($_POST['to_status'] == 1) {
				$sendedVirtualProducts = $this->sendVirtualProducts();
			}
		}

		if ($sendedVirtualProducts == true) {
			$result = $this->Directorders_model->changeOrderStatus($_POST['the_id'], $_POST['to_status']);
		}

		if ($result == true && $sendedVirtualProducts == true) {
			echo 1;
		} else {
			echo 0;
		}
		$this->saveHistory('Change status of Order Id ' . $_POST['the_id'] . ' to status ' . $_POST['to_status']);
	}

	private function sendVirtualProducts() {
		if (isset($_POST['products']) && $_POST['products'] != '') {
			$products = unserialize(html_entity_decode($_POST['products']));
			foreach ($products as $product_id => $product_quantity) {
				$productInfo = modules::run('admin/ecommerce/products/getProductInfo', $product_id);
				/*
					                 * If is virtual product, lets send email to user
				*/
				if ($productInfo['virtual_products'] != null) {
					if (!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)) {
						log_message('error', 'Ivalid customer email address! Cant send him virtual products!');
						return false;
					}
					$result = $this->sendmail->sendTo($_POST['userEmail'], 'Dear Customer', 'Virtual products', $productInfo['virtual_products']);
					return $result;
				}
			}
			return true;
		}
	}

}

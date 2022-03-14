<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Orders extends ADMIN_Controller {

	private $num_rows = 10;

	public function __construct() {
		parent::__construct();
		$this->load->library('SendMail');
		$this->load->model(array('Orders_model', 'Home_admin_model','Ordersdt_model','Products_model','Api_model'));
	}

	public function index($page = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('vieworder', $adminid)) {redirect('admin');}
		$data = array();
		$head = array();
		$head['title'] = 'Orders-List';
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
		$rowscount = $this->Orders_model->ordersCount($status, $startdate, $enddate, $orderid);
		$data['orders'] = $this->Orders_model->orders($this->num_rows, $page, $order_by, $status, $startdate, $enddate, $orderid);
		$data['links_pagination'] = pagination('admin/orders', $rowscount, $this->num_rows, 3);
		if (isset($_POST['paypal_sandbox'])) {
			$this->Home_admin_model->setValueStore('paypal_sandbox', $_POST['paypal_sandbox']);
			if ($_POST['paypal_sandbox'] == 1) {
				$msg = 'Paypal sandbox mode activated';
			} else {
				$msg = 'Paypal sandbox mode disabled';
			}
			$this->session->set_flashdata('paypal_sandbox', $msg);
			$this->saveHistory($msg);
			redirect('admin/orders?settings');
		}
		if (isset($_POST['paypal_email'])) {
			$this->Home_admin_model->setValueStore('paypal_email', $_POST['paypal_email']);
			$this->session->set_flashdata('paypal_email', 'Public quantity visibility changed');
			$this->saveHistory('Change paypal business email to: ' . $_POST['paypal_email']);
			redirect('admin/orders?settings');
		}
		if (isset($_POST['cashondelivery_visibility'])) {
			$this->Home_admin_model->setValueStore('cashondelivery_visibility', $_POST['cashondelivery_visibility']);
			$this->session->set_flashdata('cashondelivery_visibility', 'Cash On Delivery Visibility Changed');
			$this->saveHistory('Change Cash On Delivery Visibility - ' . $_POST['cashondelivery_visibility']);
			redirect('admin/orders?settings');
		}
		if (isset($_POST['iban'])) {
			$this->Orders_model->setBankAccountSettings($_POST);
			$this->session->set_flashdata('bank_account', 'Bank account settings saved');
			$this->saveHistory('Bank account settings saved for : ' . $_POST['name']);
			redirect('admin/orders?settings');
		}
		$data['paypal_sandbox'] = $this->Home_admin_model->getValueStore('paypal_sandbox');
		$data['statusList'] = $this->Orders_model->getStatusList();
		$data['paypal_email'] = $this->Home_admin_model->getValueStore('paypal_email');
		$data['cashondelivery_visibility'] = $this->Home_admin_model->getValueStore('cashondelivery_visibility');
		$data['bank_account'] = $this->Orders_model->getBankAccountSettings();
		$this->load->view('_parts/header', $head);
		$this->load->view('ecommerce/list-orders', $data);
		$this->load->view('_parts/footer');
		if ($page == 0) {
			$this->saveHistory('Go to orders page');
		}
	}



	public function order_list() {
		// echo 'hi';die;       
        $this->login_check();             
        $list = $this->Ordersdt_model->get_datatables($_REQUEST['orderStatus']);
        $data = array();
        $no = $_POST['start'];



        foreach ($list as $datarow) {                			
            // $active_inactive_badge='';
            // if($datarow->status==1){
            //     $active_inactive_badge='<span class="badge badge-success badge-status-'.$datarow->id.'">Active</span>';
            // }
            // if($datarow->status==0){
            //     $active_inactive_badge='<span class="badge badge-danger badge-status-'.$datarow->id.'">inActive</span>';
            // }            
            // if($datarow->status==1){
            //     $str='Inactive';
            //     $class="btn-danger";
            //     $status=0;
            // }
            // if($datarow->status==0){
            //     $str='Active';
            //     $class="btn-success";
            //     $status=1;
            // }
            $view_url=base_url('admin/ordersdetails/'). $datarow->id;           
            $actionBtn = '<a href="'.$view_url.'" class="btn btn-xs btn-warning">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $datarow->id;        
            $row[] = date('d-m-Y', $datarow->date); 
            // $row[]=$datarow->ag_title;   
            // $row[]=$active_inactive_badge;
			$row[] = $datarow->first_name;  
			$row[] = $datarow->businessname;  
			$row[] = $datarow->phone;
			$row[] = $datarow->processed;  
            $row[]=$actionBtn;               
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Ordersdt_model->count_all($_REQUEST['orderStatus']),
            "recordsFiltered" => $this->Ordersdt_model->count_filtered($_REQUEST['orderStatus']),
            "data" => $data,
        );
        echo json_encode($output);
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
			$result = $this->Orders_model->changeOrderStatus($_POST['the_id'], $_POST['to_status']);
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
	public function addOrder() {

		if(isset($_POST['UserId'])){
			$post=$_POST;
			$_POST=array();
			$i=0;			
			foreach($post['ItemId'] as $row){
				$_POST['UserId']=$post['UserId'];
				$_POST['ItemId']=$post['ItemId'][$i];
				$_POST['Qty']=$post['Qty'][$i];
				$_POST['ProductType']=$post['ProductType'][$i];
				$_POST['Comment']='';
				$_POST['HindiComment']='';
				$_POST['user_type']='admin';		
				$this->Api_model->AddToCart();
				$i=$i+1;
			}
			$_REQUEST['UserId']=$post['UserId'];
			$_REQUEST['user_type']='admin';	
			$res=$this->Api_model->GetMyCart();
			$_REQUEST['GSTamount']=0;
			if(!empty($res)){
				foreach($res as $row_dt){				
					$_REQUEST['GSTamount']=$row_dt[0]['GSTAmount'];
					break;
				}									
			}
			$_REQUEST['PaymentMode']='ofline';
			$_REQUEST['ShipId']=$post['ShipId'];
			$_REQUEST['BillId']=$post['BillId'];
			
			$checkout=$this->Api_model->CheckOutfun();
			if(!empty($checkout)){
				if($checkout['IsSuccess']==1){
					redirect('admin/orders');	
				}
			}
		}
		$data = array();
		$head = array();
		$head['title'] = 'Add-Order';
		$head['description'] = '!';
		$head['keywords'] = '';

		$data['users'] = $this->Products_model->getUsers();
		$data['conn_products'] = $this->Products_model->getConnProducts();
		$this->load->view('_parts/header', $head);
		$this->load->view('ecommerce/add-order', $data);
		$this->load->view('_parts/footer');			
	}

	public function load_address(){
        if($_REQUEST['userid']){            
            $shipping = $this->Products_model->load_shipping($_POST);
			$billing = $this->Products_model->load_billing($_POST);            
            $result=array();
            $result['shipping']=$shipping; 
			$result['billing']=$billing;                        
            echo json_encode($result);
        }
    }
	
}

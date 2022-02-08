<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Directordersdetails extends ADMIN_Controller
{

    private $num_rows = 10;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('SendMail');
        $this->load->model(array('Directordersdetails_model', 'Home_admin_model'));
    }

    public function directorder($order_id,$page = 0)
    {
        $this->login_check();
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Orders';
        $head['description'] = '!';
        $head['keywords'] = '';

        $order_by = null;
        if (isset($_GET['order_by'])) {
            $order_by = $_GET['order_by'];
        }
        $rowscount = $this->Directordersdetails_model->ordersCount();
        $data['orders_details'] = $this->Directordersdetails_model->orders($order_id,$this->num_rows, $page, $order_by);
		$data['ordercomment'] = $this->Directordersdetails_model->ordercomment($order_id);
        $data['links_pagination'] = pagination('admin/orders', $rowscount, $this->num_rows, 3);
		if (isset($_POST['sendcomment']) && isset($_POST['ordercommentmsg'])) {
			
			$this->Directordersdetails_model->sendordersmsg($order_id);
			redirect('admin/directordersdetails/'.$order_id);
		}
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/directordersdetails', $data);
        $this->load->view('_parts/footer');
        if ($page == 0) {
            $this->saveHistory('Go to orders page');
        }
    }

    public function changedirectOrderStatus()
    {
        $this->login_check();

        $result = false;
        $result = $this->Directordersdetails_model->changeOrderStatus($_POST['the_id'], $_POST['to_status']);

        if ($result == true) {
            echo 1;
        } else {
            echo 0;
        }
        $this->saveHistory('Change status of Order Id ' . $_POST['the_id'] . ' to status ' . $_POST['to_status']);
    }

    private function sendVirtualProducts()
    {
        if(isset($_POST['products']) && $_POST['products'] != '') {
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

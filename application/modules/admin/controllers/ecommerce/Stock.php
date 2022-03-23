<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Stock extends ADMIN_Controller
{
    public function __construct()
    {
        parent::__construct();                         
        $this->load->model(array(
            'Stock_model','Products_model'
        ));
    }

    public function index($productid)
    {        
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addproduct', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editproduct', $adminid)) {
            redirect('admin');
        }  
        
        $product=$this->Products_model->getOneProduct($productid);       

        $data = array();
        $head = array();
        $head['title'] = 'List-Stock';
        $head['description'] = '!';
        $head['keywords'] = '';

        $data['product']=$product;
        $data['productid']=$productid;
        $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/list-stock', $data);
        $this->load->view('_parts/footer');       
    }

    public function stock_list() {       
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addattributesgroup', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editattributesgroup', $adminid)) {
            redirect('admin');
        } 
        $list = $this->Stock_model->get_datatables($_REQUEST['productid']);
        $data = array();
        $no = $_POST['start'];

        // echo '<pre>';print_r($list);die;

        $cnt=count($list);
        if($cnt<=1){
            $list=array();
        }        
        $i=1;
        foreach ($list as $datarow) {    
            if($i==$cnt){}else{                      
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $datarow->qty;        
                $row[] = date('d-m-Y', $datarow->timeanddate);                                 
                $data[] = $row;
            }
            $i=$i+1;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Stock_model->count_all($_REQUEST['productid']),
            "recordsFiltered" => $this->Stock_model->count_filtered($_REQUEST['productid']),
            "data" => $data,
        );
        echo json_encode($output);
    }
}

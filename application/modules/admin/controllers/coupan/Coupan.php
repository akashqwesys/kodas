<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Coupan extends ADMIN_Controller
{
    public function __construct()
    {
        parent::__construct();                         
        $this->load->model(array(
            'Coupan_model'
        ));
    }

    public function index()
    {        
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addcoupan', $adminid)) {redirect('admin');}
		if (!in_array('editcoupan', $adminid)) {redirect('admin');}                   
        $data = array();
        $head = array();
        $head['title'] = 'List-Coupan';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('coupan/list-coupan', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add coupan');
    }

    public function coupan_list() {       
        $this->login_check();
        // $adminid = $this->session->userdata('logged_roledata');
        // if (!in_array('addcoupan', $adminid)) {
        //     redirect('admin');
        // }
        // if (!in_array('editcoupan', $adminid)) {
        //     redirect('admin');
        // } 
        $list = $this->Coupan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];

        // echo '<pre>';print_r($list);die;

        foreach ($list as $datarow) {    
            
            $active_inactive_badge='';
            if($datarow->isactive==1){
                $active_inactive_badge='<span class="badge badge-success badge-status-'.$datarow->id.'">Active</span>';
            }
            if($datarow->isactive==0){
                $active_inactive_badge='<span class="badge badge-danger badge-status-'.$datarow->id.'">inActive</span>';
            }            
            if($datarow->isactive==1){
                $str='Inactive';
                $class="btn-danger";
                $status=0;
            }
            if($datarow->isactive==0){
                $str='Active';
                $class="btn-success";
                $status=1;
            }
            if($datarow->discounttype=="Percentage"){
                $str_p='%';
            }else{
                $str_p='';
            }
            $edit_url=base_url('admin/editcoupan/'). $datarow->id;           
            $actionBtn = '<a href="'.$edit_url.'" class="btn btn-xs btn-warning">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>             
            <button class="btn btn-xs '.$class.' active_inactive_button" data-id="' . $datarow->id . '" data-status="' . $status . '" data-table="coupan" data-wherefield="id" data-updatefield="isactive" data-module="coupan">'.$str.'</button>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $datarow->name;        
            $row[] = $datarow->code; 
            $row[]=$datarow->codelimit; 
            $row[]=date('d-m-Y', $datarow->enddate); 
            $row[]=$datarow->discount.$str_p;
            $row[]=$datarow->discounttype;               
            $row[]=$active_inactive_badge;                          
            $row[]=$actionBtn;               
            $data[] = $row;
        }
        // print_r($data);die;
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Coupan_model->count_all(),
            "recordsFiltered" => $this->Coupan_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function add_coupan()
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addcoupan', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editcoupan', $adminid)) {
            redirect('admin');
        }           
        if (isset($_POST['submit'])) {            
            $res=$this->Coupan_model->addCoupan($_POST);
            if ($res) {
                $this->session->set_flashdata('add_coupan', 'Create Coupan Successfully!');
                $this->saveHistory('Success create Coupan');  
                redirect('admin/listcoupan');              
            }else{
                $this->session->set_flashdata('add_coupan', 'somthing happen wrong!');
                $this->saveHistory('Failed create coupan');    
            }
        } 
                   
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Add Coupan';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('coupan/addcoupan', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add Coupan');
    }
    public function edit_coupan($id)
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addcoupan', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editcoupan', $adminid)) {
            redirect('admin');
        }           
        if (isset($_POST['submit'])) {            
            $res=$this->Coupan_model->editCoupan($_POST);
            if ($res) {
                $this->session->set_flashdata('edit_coupan', 'Update Coupon Successfully!');
                $this->saveHistory('Success update Coupon');  
                redirect('admin/listcoupan');              
            }else{
                $this->session->set_flashdata('edit_coupan', 'somthing happen wrong!');
                $this->saveHistory('Failed update Coupon');    
            }
        }             
        $data = array();        
        $data['coupan_result']=$this->Coupan_model->get_coupan_details($id);
        $head = array();
        $head['title'] = 'Administration - Edit Coupan';
        $head['description'] = '!';
        $head['keywords'] = '';
        $this->load->view('_parts/header', $head);
        $this->load->view('coupan/editcoupan', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Edit Coupan');
    }

    public function approve_status() {        
        if (isset($_REQUEST['table_id'])) {
            $res = $this->Coupan_model->approve_status($_REQUEST);
            if ($res) {
                $data = array(
                    'suceess' => true
                );
            }
            echo json_encode($data);
        }
    }
}

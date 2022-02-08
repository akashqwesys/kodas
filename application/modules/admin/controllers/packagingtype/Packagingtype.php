<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Packagingtype extends ADMIN_Controller
{
    public function __construct()
    {
        parent::__construct();                         
        $this->load->model(array(
            'Packagingtype_model',
        ));
    }

    public function index()
    {        
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addpackagingtype', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editpackagingtype', $adminid)) {
            redirect('admin');
        }                    
        $data = array();
        $head = array();
        $head['title'] = 'List-Packagingtype';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('packagingtype/list-packagingtype', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add Packagingtype');
    }

    public function packagingtype_list() {       
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addpackagingtype', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editpackagingtype', $adminid)) {
            redirect('admin');
        } 
        $list = $this->Packagingtype_model->get_datatables();
        $data = array();
        $no = $_POST['start'];

        // echo '<pre>';print_r($list);die;

        foreach ($list as $datarow) {    
            
            $active_inactive_badge='';
            if($datarow->status==1){
                $active_inactive_badge='<span class="badge badge-success badge-status-'.$datarow->packagingtype_id.'">Active</span>';
            }
            if($datarow->status==0){
                $active_inactive_badge='<span class="badge badge-danger badge-status-'.$datarow->packagingtype_id.'">inActive</span>';
            }            
            if($datarow->status==1){
                $str='Inactive';
                $class="btn-danger";
                $status=0;
            }
            if($datarow->status==0){
                $str='Active';
                $class="btn-success";
                $status=1;
            }
            $edit_url=base_url('admin/editpackagingtype/'). $datarow->packagingtype_id;           
            $actionBtn = '<a href="'.$edit_url.'" class="btn btn-xs btn-warning">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>             
            <button class="btn btn-xs '.$class.' active_inactive_button" data-id="' . $datarow->packagingtype_id . '" data-status="' . $status . '" data-table="packagingtype" data-wherefield="packagingtype_id" data-updatefield="status" data-module="packagingtype">'.$str.'</button>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $datarow->title;        
            $row[] = $datarow->pcs; 
            // $row[]=$datarow->ag_title;   
            $row[]=$active_inactive_badge;  
            $row[]=$actionBtn;               
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Packagingtype_model->count_all(),
            "recordsFiltered" => $this->Packagingtype_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function add_packagingtype()
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addpackagingtype', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editpackagingtype', $adminid)) {
            redirect('admin');
        }           
        if (isset($_POST['submit'])) {            
            $res=$this->Packagingtype_model->addPackagingtype($_POST);
            if ($res) {
                $this->session->set_flashdata('add_packagingtype', 'Create Packagingtype Successfully!');
                $this->saveHistory('Success create Packagingtype');  
                redirect('admin/listpackagingtype');              
            }else{
                $this->session->set_flashdata('add_packagingtype', 'somthing happen wrong!');
                $this->saveHistory('Failed create Packagingtype');    
            }
        } 
                   
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Add Packagingtype';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('packagingtype/addpackagingtype', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add Packagingtype');
    }
    public function edit_packagingtype($id)
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addpackagingtype', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editpackagingtype', $adminid)) {
            redirect('admin');
        }           
        if (isset($_POST['submit'])) {            
            $res=$this->Packagingtype_model->editPackagingtype($_POST);
            if ($res) {
                $this->session->set_flashdata('edit_packagingtype', 'Update Packagingtype Successfully!');
                $this->saveHistory('Success update Packagingtype');  
                redirect('admin/listpackagingtype');              
            }else{
                $this->session->set_flashdata('edit_packagingtype', 'somthing happen wrong!');
                $this->saveHistory('Failed update Packagingtype');    
            }
        }             
        $data = array();        
        $data['packagingtype_result']=$this->Packagingtype_model->get_packagingtype_details($id);
        $head = array();
        $head['title'] = 'Administration - Edit Packagingtype';
        $head['description'] = '!';
        $head['keywords'] = '';
        $this->load->view('_parts/header', $head);
        $this->load->view('packagingtype/editpackagingtype', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Edit Packagingtype');
    }

    public function approve_status() {        
        if (isset($_REQUEST['table_id'])) {
            $res = $this->Packagingtype_model->approve_status($_REQUEST);
            if ($res) {
                $data = array(
                    'suceess' => true
                );
            }
            echo json_encode($data);
        }
    }
}

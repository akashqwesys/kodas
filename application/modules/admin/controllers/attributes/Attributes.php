<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Attributes extends ADMIN_Controller
{
    public function __construct()
    {
        parent::__construct();                         
        $this->load->model(array(
            'Attributes_model',
        ));
    }

    public function index()
    {        
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addattributes', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editattributes', $adminid)) {
            redirect('admin');
        }                    
        $data = array();
        $head = array();
        $head['title'] = 'List-Attributes';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('attributes/list-attributes', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add Attributes');
    }

    public function attributes_list() {       
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addattributes', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editattributes', $adminid)) {
            redirect('admin');
        } 
        $list = $this->Attributes_model->get_datatables();
        $data = array();
        $no = $_POST['start'];

        // echo '<pre>';print_r($list);die;

        foreach ($list as $datarow) {    
            
            $active_inactive_badge='';
            if($datarow->status==1){
                $active_inactive_badge='<span class="badge badge-success badge-status-'.$datarow->attributes_id.'">Active</span>';
            }
            if($datarow->status==0){
                $active_inactive_badge='<span class="badge badge-danger badge-status-'.$datarow->attributes_id.'">inActive</span>';
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
            $edit_url=base_url('admin/editattributes/'). $datarow->attributes_id;           
            $actionBtn = '<a href="'.$edit_url.'" class="btn btn-xs btn-warning">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>             
            <button class="btn btn-xs '.$class.' active_inactive_button" data-id="' . $datarow->attributes_id . '" data-status="' . $status . '" data-table="attributes" data-wherefield="attributes_id" data-updatefield="status" data-module="attributes">'.$str.'</button>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $datarow->title;        
            $row[] = $datarow->sort_order; 
            $row[]=$datarow->ag_title;   
            $row[]=$active_inactive_badge;  
            $row[]=$actionBtn;               
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Attributes_model->count_all(),
            "recordsFiltered" => $this->Attributes_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function add_attributes()
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addattributes', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editattributes', $adminid)) {
            redirect('admin');
        }           
        if (isset($_POST['submit'])) {            
            $res=$this->Attributes_model->addAttributes($_POST);
            if ($res) {
                $this->session->set_flashdata('add_attributes', 'Create Attributes Successfully!');
                $this->saveHistory('Success create Attributes');  
                redirect('admin/listattributes');              
            }else{
                $this->session->set_flashdata('add_attributes', 'somthing happen wrong!');
                $this->saveHistory('Failed create Attributes');    
            }
        } 
                   
        $data = array();

        $data['attributes_group_result']=$this->Attributes_model->get_attributes_group(); 

        $head = array();
        $head['title'] = 'Administration - Add Attributes';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('attributes/addattributes', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add Attributes');
    }
    public function edit_attributes($id)
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addattributes', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editattributes', $adminid)) {
            redirect('admin');
        }           
        if (isset($_POST['submit'])) {            
            $res=$this->Attributes_model->editAttributes($_POST);
            if ($res) {
                $this->session->set_flashdata('edit_attributes', 'Update Attributes Successfully!');
                $this->saveHistory('Success update Attributes');  
                redirect('admin/listattributes');              
            }else{
                $this->session->set_flashdata('edit_attributes', 'somthing happen wrong!');
                $this->saveHistory('Failed update Attributes');    
            }
        }             
        $data = array();
        $data['attributes_group_result']=$this->Attributes_model->get_attributes_group(); 
        $data['attributes_result']=$this->Attributes_model->get_attributes_details($id);

        $head = array();
        $head['title'] = 'Administration - Edit Attributes';
        $head['description'] = '!';
        $head['keywords'] = '';
        $this->load->view('_parts/header', $head);
        $this->load->view('attributes/editattributes', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Edit Attributes');
    }

    public function approve_status() {        
        if (isset($_REQUEST['table_id'])) {
            $res = $this->Attributes_model->approve_status($_REQUEST);
            if ($res) {
                $data = array(
                    'suceess' => true
                );
            }
            echo json_encode($data);
        }
    }
}

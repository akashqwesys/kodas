<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Attributesgroup extends ADMIN_Controller
{
    public function __construct()
    {
        parent::__construct();                         
        $this->load->model(array(
            'Attributesgroup_model',
        ));
    }

    public function index()
    {        
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addattributesgroup', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editattributesgroup', $adminid)) {
            redirect('admin');
        }                    
        $data = array();
        $head = array();
        $head['title'] = 'List-Attributesgroup';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('attributesgroup/list-attributesgroup', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add Attribute groups');
    }

    public function attributesgroup_list() {       
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addattributesgroup', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editattributesgroup', $adminid)) {
            redirect('admin');
        } 
        $list = $this->Attributesgroup_model->get_datatables();
        $data = array();
        $no = $_POST['start'];

        // echo '<pre>';print_r($list);die;

        foreach ($list as $datarow) {    
            
            $active_inactive_badge='';
            if($datarow->status==1){
                $active_inactive_badge='<span class="badge badge-success badge-status-'.$datarow->attributesgroup_id.'">Active</span>';
            }
            if($datarow->status==0){
                $active_inactive_badge='<span class="badge badge-danger badge-status-'.$datarow->attributesgroup_id.'">inActive</span>';
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
            $edit_url=base_url('admin/editattributesgroup/'). $datarow->attributesgroup_id;           
            $actionBtn = '<a href="'.$edit_url.'" class="btn btn-xs btn-warning">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>             
            <button class="btn btn-xs '.$class.' active_inactive_button" data-id="' . $datarow->attributesgroup_id . '" data-status="' . $status . '" data-table="attributes_group" data-wherefield="attributesgroup_id" data-updatefield="status" data-module="attributesgroup">'.$str.'</button>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $datarow->title;        
            $row[] = $datarow->sort_order; 
            // $row[]=$datarow->ag_title;   
            $row[]=$active_inactive_badge;  
            $row[]=$actionBtn;               
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Attributesgroup_model->count_all(),
            "recordsFiltered" => $this->Attributesgroup_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function add_attributesgroup()
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addattributesgroup', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editattributesgroup', $adminid)) {
            redirect('admin');
        }           
        if (isset($_POST['submit'])) {            
            $res=$this->Attributesgroup_model->addAttributesgroup($_POST);
            if ($res) {
                $this->session->set_flashdata('add_attributesgroup', 'Create Attributesgroup Successfully!');
                $this->saveHistory('Success create Attribute group');  
                redirect('admin/listattributesgroup');              
            }else{
                $this->session->set_flashdata('add_attributesgroup', 'somthing happen wrong!');
                $this->saveHistory('Failed create Attribute group');    
            }
        } 
                   
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Add Attributesgroup';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('attributesgroup/addattributesgroup', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add Attribute group');
    }
    public function edit_attributesgroup($id)
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addattributesgroup', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editattributesgroup', $adminid)) {
            redirect('admin');
        }           
        if (isset($_POST['submit'])) {            
            $res=$this->Attributesgroup_model->editAttributesgroup($_POST);
            if ($res) {
                $this->session->set_flashdata('edit_attributesgroup', 'Update Attribute group Successfully!');
                $this->saveHistory('Success update Attribute group');  
                redirect('admin/listattributesgroup');              
            }else{
                $this->session->set_flashdata('edit_attributesgroup', 'somthing happen wrong!');
                $this->saveHistory('Failed update Attribute group');    
            }
        }             
        $data = array();        
        $data['attributesgroup_result']=$this->Attributesgroup_model->get_attributesgroup_details($id);
        $head = array();
        $head['title'] = 'Administration - Edit Attributesgroup';
        $head['description'] = '!';
        $head['keywords'] = '';
        $this->load->view('_parts/header', $head);
        $this->load->view('attributesgroup/editattributesgroup', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Edit Attribute group');
    }

    public function approve_status() {        
        if (isset($_REQUEST['table_id'])) {
            $res = $this->Attributesgroup_model->approve_status($_REQUEST);
            if ($res) {
                $data = array(
                    'suceess' => true
                );
            }
            echo json_encode($data);
        }
    }
}

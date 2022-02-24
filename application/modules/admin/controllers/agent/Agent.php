<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Agent extends ADMIN_Controller
{
    public function __construct()
    {
        parent::__construct();                         
        $this->load->model(array(
            'Agent_model',
            'Customer_model',
            'Agent_history_model'
        ));
    }

    public function index()
    {        
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addagent', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editagent', $adminid)) {
            redirect('admin');
        }                    
        $data = array();
        $head = array();
        $head['title'] = 'List-Agent';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('agent/list-agent', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add Agent');
    }

    public function agent_list() {       
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addagent', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editagent', $adminid)) {
            redirect('admin');
        } 
        $list = $this->Agent_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $datarow) {    
            

            $active_inactive_badge='';
            if($datarow->status==1){
                $active_inactive_badge='<span class="badge badge-success badge-status-'.$datarow->agent_id.'">Active</span>';
            }
            if($datarow->status==0){
                $active_inactive_badge='<span class="badge badge-danger badge-status-'.$datarow->agent_id.'">inActive</span>';
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
            $edit_url=base_url('admin/editagent/'). $datarow->agent_id;
            $alocate_url=base_url('admin/allocate-user/'). $datarow->agent_id;
            $history_url=base_url('admin/agent-history/'). $datarow->agent_id;
            $actionBtn = '<a href="'.$edit_url.'" class="btn btn-xs btn-warning">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>             
            <button class="btn btn-xs '.$class.' active_inactive_button" data-id="' . $datarow->agent_id . '" data-status="' . $status . '" data-table="agent" data-wherefield="agent_id" data-updatefield="status" data-module="agent">'.$str.'</button>
            <a href="'.$history_url.'" class="btn btn-xs btn-info">Device History <i class="fa fa-history" aria-hidden="true"></i></a>
            <a href="'.$alocate_url.'" class="btn btn-xs btn-primary">Customers <i class="fa fa-check" aria-hidden="true"></i></a>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $datarow->name;        
            $row[] = $datarow->phone;
            $row[] = $datarow->address;     
            $row[]=$datarow->email;
            $row[]=$active_inactive_badge;  
            $row[]=$actionBtn;               
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Agent_model->count_all(),
            "recordsFiltered" => $this->Agent_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }


    public function allocate_user($id)
    {        
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addagent', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editagent', $adminid)) {
            redirect('admin');
        }                    
        $data = array();
        $data['id']=$id;
        $head = array();
        $head['title'] = 'List-Allocate-User';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('agent/list-alocate-user', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add Agent');
    }

    public function allocate_user_list($id) {       
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addagent', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editagent', $adminid)) {
            redirect('admin');
        } 
        $list = $this->Customer_model->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $datarow) {    
            
            $allocate_badge='';
            if($datarow->alocation_agent_id>0){
                $allocate_badge='<span class="badge badge-success badge-status-'.$datarow->id.'">Allocated</span>';
            }
            if($datarow->alocation_agent_id==0){
                $allocate_badge='<span class="badge badge-danger badge-status-'.$datarow->id.'">Not Allocate</span>';
            }            
            if($datarow->alocation_agent_id==$id){
                $str='Remove';
                $class="btn-danger"; 
                $chek_a_r=0;              
            }
            if($datarow->alocation_agent_id==0){
                $str='Allocate';
                $class="btn-success";   
                $chek_a_r=1;             
            }           
            $actionBtn = '<button class="btn btn-xs '.$class.' allocation_button" data-ar="'.$chek_a_r.'" data-id="' . $datarow->id . '" data-status="' . $id . '" data-table="user_app" data-wherefield="id" data-updatefield="alocation_agent_id" data-module="user_app">'.$str.'</button>';
            $no++;
            $row = array();
            $row[] = $datarow->id;
            $row[] = $datarow->name;        
            $row[] = $datarow->mobilenumber;
            $row[] = $datarow->emailid;     
            $row[]=$datarow->address;
            $row[]=$datarow->businessname; 
            $row[]=$allocate_badge; 
            $row[]=$actionBtn;               
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Customer_model->count_all($id),
            "recordsFiltered" => $this->Customer_model->count_filtered($id),
            "data" => $data,
        );
        echo json_encode($output);
    }


    public function add_allocation()
    {
        // print_r($_POST);die;
        $res=$this->Agent_model->add_allocation($_POST);
        if ($res) {
            $this->session->set_flashdata('add_allocation_success', 'Allocation Successfully!');
            $this->saveHistory('Success allocation Customer');                          
        }else{
            $this->session->set_flashdata('add_allocation_failed', 'somthing happen wrong!');
            $this->saveHistory('Failed allocation Customer');    
        }
        redirect('admin/allocate-user/'.$_POST['agent_id']);
    }




    public function add_agent()
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addagent', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editagent', $adminid)) {
            redirect('admin');
        }           
        if (isset($_POST['submit'])) {            
            $res=$this->Agent_model->addAgent($_POST);
            if ($res) {
                $this->session->set_flashdata('add_agent', 'Create Agent Successfully!');
                $this->saveHistory('Success create Agent');  
                redirect('admin/listagent');              
            }else{
                $this->session->set_flashdata('add_agent', 'somthing happen wrong!');
                $this->saveHistory('Failed create Agent');    
            }
        }             
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Add Agent';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('agent/addagent', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add Agent');
    }
    public function edit_agent($id)
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addagent', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editagent', $adminid)) {
            redirect('admin');
        }           
        if (isset($_POST['submit'])) {            
            $res=$this->Agent_model->editAgent($_POST);
            if ($res) {
                $this->session->set_flashdata('edit_agent', 'Update Agent Successfully!');
                $this->saveHistory('Success update Agent');  
                redirect('admin/listagent');              
            }else{
                $this->session->set_flashdata('edit_agent', 'somthing happen wrong!');
                $this->saveHistory('Failed update Agent');    
            }
        }             
        $data = array();

        $data['agent_result']=$this->Agent_model->get_agent_details($id);

        $head = array();
        $head['title'] = 'Administration - Edit Agent';
        $head['description'] = '!';
        $head['keywords'] = '';
        $this->load->view('_parts/header', $head);
        $this->load->view('agent/editagent', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Edit Agent');
    }

    public function approve_status() {        
        if (isset($_REQUEST['table_id'])) {
            $res = $this->Agent_model->approve_status($_REQUEST);
            if ($res) {
                $data = array(
                    'suceess' => true
                );
            }
            echo json_encode($data);
        }
    }

    public function customer_allocation_change() {        
        if (isset($_REQUEST['table_id'])) {
            $res = $this->Agent_model->customer_allocation_change($_REQUEST);
            $ar=0;
            if($_REQUEST['ar']==0){
                $ar=1;
            }
            if ($res) {
                $data = array(
                    'suceess' => true,
                    'ar'=>$ar
                );
            }
            echo json_encode($data);
        }
    }






    public function agent_history($id)
    {        
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addagent', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editagent', $adminid)) {
            redirect('admin');
        }                    
        $data = array();
        $data['id']=$id;
        $head = array();
        $head['title'] = 'Agent-History';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('agent/agent-history', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Agent list');
    }

    public function agent_history_list($id) {       
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addagent', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editagent', $adminid)) {
            redirect('admin');
        } 
        $list = $this->Agent_history_model->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $datarow) {                
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $datarow->device_id;        
            $row[] = $datarow->datetime_added;               
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Agent_history_model->count_all($id),
            "recordsFiltered" => $this->Agent_history_model->count_filtered($id),
            "data" => $data,
        );
        echo json_encode($output);
    }



    //Bulk User
	public function addbulkagent() {
		if (isset($_POST['submit'])) {
			$userexits = array();
			$fp = fopen($_FILES['csvfile']['tmp_name'], 'r') or die("can't open file");
			$skip = 0;
			while (($line = fgetcsv($fp)) !== FALSE) {
				// print_r($line);die;
				if ($skip == 0) {
					$skip++;
				} else {
					// $getpremium = str_replace('"', '', strtolower("$line[7]"));
					// $getcoupan = str_replace('"', '', strtolower("$line[8]"));
					// $getcredit = str_replace('"', '', strtolower("$line[9]"));
					// if ($getpremium == 'yes') {
					// 	$premium = 1;
					// } else {
					// 	$premium = 0;
					// }
					// if ($getcoupan == 'yes') {
					// 	$coupan = 1;
					// } else {
					// 	$coupan = 0;
					// }
					// if ($getcredit == 'yes') {
					// 	$credit = 1;
					// } else {
					// 	$credit = 0;
					// }
					$data = array(
						'name' => str_replace('"', '', $line[0]),
						'ac_type' => str_replace('"', '', $line[1]),
						'city' => str_replace('"', '', $line[2]),
                        'phone' => str_replace('"', '', $line[3]),												
						'phone_1' => str_replace('"', '', $line[4]),
						'phone_2' => str_replace('"', '', $line[5]),
						'email' => str_replace('"', '', $line[6])								
					);

					$querymobile = $this->db->get_where('agent', array('phone' => $data['phone']));
					if ($querymobile->num_rows() > 0) {
						$this->session->set_flashdata('result_publish', 'Some Agent Mobile Already exits In System!');
						array_push($userexits, $data['phone']);
					} else {
						$this->db->insert('agent', $data);
					}
				}
			}
			fclose($fp) or die("can't close file");
			$List = implode(', ', $userexits);
			if ($List) {
				$this->session->set_flashdata('result_error', "Some Users Mobile Number Already exits In System! $List");
			}
			$this->session->set_flashdata('result_publish', 'Customers Imported Successfully');
			redirect('admin/listagent');
		}
	}

}

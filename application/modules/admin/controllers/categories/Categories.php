<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Categories extends ADMIN_Controller
{
    public function __construct()
    {
        parent::__construct();                         
        $this->load->model(array(
            'Categoriesdt_model',
        ));
    }

    public function index()
    {        
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addcategories', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editcategories', $adminid)) {
            redirect('admin');
        }                    
        $data = array();
        $head = array();
        $head['title'] = 'List-Categories';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('categories/list-categories', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add categories');
    }

    public function categories_list() {       
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addcategories', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editcategories', $adminid)) {
            redirect('admin');
        } 
        $list = $this->Categoriesdt_model->get_datatables();
        $data = array();
        $no = $_POST['start'];

        // echo '<pre>';print_r($list);die;

        foreach ($list as $datarow) {    
                       
            $edit_url=base_url('admin/editcategories/'). $datarow->id; 
            $delete_url=base_url('admin/deletecategories/'). $datarow->id;           
            $actionBtn = '<a href="'.$edit_url.'" class="btn btn-xs btn-warning">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>
            <a href="'.$delete_url.'" class="btn btn-xs btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></a>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $datarow->name;        
            $row[] = $datarow->position;                         
            $row[]=$actionBtn;               
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Categoriesdt_model->count_all(),
            "recordsFiltered" => $this->Categoriesdt_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function add_categories()
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addcategories', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editcategories', $adminid)) {
            redirect('admin');
        }           
        if (isset($_POST['submit'])) {      
            
            $_POST['image'] = $this->uploadImage();
			$_POST['webimage'] = $this->uploadImage('website');

            $res=$this->Categoriesdt_model->addCategories($_POST);
            if ($res) {
                $this->session->set_flashdata('add_categories', 'Create Categories Successfully!');
                $this->saveHistory('Success create Categories');  
                redirect('admin/listcategories');              
            }else{
                $this->session->set_flashdata('add_categories', 'somthing happen wrong!');
                $this->saveHistory('Failed create Categories');    
            }
        } 
                   
        $data = array();
        
        $head = array();
        $head['title'] = 'Administration - Add Categories';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('categories/addcategories', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add Categories');
    }
    public function edit_categories($id)
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addcategories', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editcategories', $adminid)) {
            redirect('admin');
        }           
        if (isset($_POST['submit'])) { 
            
            $_POST['image'] = $this->uploadImage();
			$_POST['webimage'] = $this->uploadImage('website');
            
            $res=$this->Categoriesdt_model->editCategories($_POST);
            if ($res) {
                $this->session->set_flashdata('edit_categories', 'Update Categories Successfully!');
                $this->saveHistory('Success update Categories');  
                redirect('admin/listcategories');              
            }else{
                $this->session->set_flashdata('edit_categories', 'somthing happen wrong!');
                $this->saveHistory('Failed update Categories');    
            }
        }             
        $data = array();       
        $data['result']=$this->Categoriesdt_model->get_categories_details($id);

        $head = array();
        $head['title'] = 'Administration - Edit Categories';
        $head['description'] = '!';
        $head['keywords'] = '';
        $this->load->view('_parts/header', $head);
        $this->load->view('categories/editcategories', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Edit Categories');
    }

    public function approve_status() {        
        if (isset($_REQUEST['table_id'])) {
            $res = $this->Categoriesdt_model->approve_status($_REQUEST);
            if ($res) {
                $data = array(
                    'suceess' => true
                );
            }
            echo json_encode($data);
        }
    }


    private function uploadImage($banner = null) {
		if ($banner == null) {
			if (isset($_FILES['catimg'])) {
				if (isset($_FILES['catimg']['name']) && $_FILES['catimg']['name'] != '') {
					$new_name = time() . '_' . $_FILES["catimg"]['name'];
					$config['upload_path'] = './attachments/cat_images/';
					$config['allowed_types'] = $this->allowed_img_types;
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('catimg')) {
						log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
					}
					$img = $this->upload->data();
					return $img['file_name'];
				} else {
					return !empty($_POST['olduserimg']) ? $_POST['olduserimg'] : '';
				}
			} else {
				return '';
			}
		}

		if ($banner == 'website') {
			if (isset($_FILES['websiteimg'])) {
				if (isset($_FILES['websiteimg']['name']) && $_FILES['websiteimg']['name'] != '') {
					$new_name = time() . '_' . $_FILES["websiteimg"]['name'];
					$config['upload_path'] = './attachments/cat_images/';
					$config['allowed_types'] = $this->allowed_img_types;
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('websiteimg')) {
						log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
					}
					$img = $this->upload->data();
					return $img['file_name'];
				} else {
					return !empty($_POST['oldwebsiteimg']) ? $_POST['oldwebsiteimg'] : '';
				}
			} else {
				return '';
			}
		}

		/*exit;
			        if($banner == null){
					$new_name = time().'_'.$_FILES["userfile"]['name'];
					$config['upload_path'] = './attachments/cat_images/';
					$config['allowed_types'] = $this->allowed_img_types;
					$config['file_name'] = $new_name;
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
					if (!$this->upload->do_upload('userfile')) {
						log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
					}
					$img = $this->upload->data();
					return $img['file_name'];
			        }

			        if($banner == 'website'){
			        $new_name = time().'_'.$_FILES["websiteimg"]['name'];
			        $config['upload_path'] = './attachments/cat_images/';
			        $config['allowed_types'] = $this->allowed_img_types;
			        $config['file_name'] = $new_name;
			        $this->load->library('upload', $config);
			        $this->upload->initialize($config);
			        if (!$this->upload->do_upload('websiteimg')) {
			            log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
			        }
			        $img = $this->upload->data();
			        return $img['file_name'];
		*/

	}
}

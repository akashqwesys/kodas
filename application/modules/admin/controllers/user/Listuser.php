<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Listuser extends ADMIN_Controller {

	private $num_rows = 10;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('User_model', 'Languages_model', 'Categories_model','Userlist_model'));
	}

	public function index($page = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addcustomer', $adminid) || !in_array('editcustomer', $adminid) || !in_array('delcustomer', $adminid)) {redirect('admin');}
		$data = array();
		$head = array();
		$head['title'] = 'List-Users';
		$head['description'] = '!';
		$head['keywords'] = '';

		if (isset($_GET['delete'])) {
			$this->User_model->deleteProduct($_GET['delete']);
			$this->session->set_flashdata('result_delete', 'product is deleted!');
			$this->saveHistory('Delete user id - ' . $_GET['delete']);
			redirect('admin/listuser');
		}

		unset($_SESSION['filter']);
		$search_title = null;
		if ($this->input->get('search_title') !== NULL) {
			$search_title = $this->input->get('search_title');
			$_SESSION['filter']['search_title'] = $search_title;
			$this->saveHistory('Search for user title - ' . $search_title);
		}
		$orderby = null;
		if ($this->input->get('order_by') !== NULL) {
			$orderby = $this->input->get('order_by');
			$_SESSION['filter']['order_by '] = $orderby;
		}
		$category = null;
		if ($this->input->get('category') !== NULL) {
			$category = $this->input->get('category');
			$_SESSION['filter']['category '] = $category;
			$this->saveHistory('Search for user code - ' . $category);
		}
		if (isset($_POST['selectuserstatus']) && isset($_POST['changestatuseuser'])) {
			$this->User_model->changestatususer($_POST);
			$this->saveHistory('Update Successfully');
		}
		$vendor = null;
		if ($this->input->get('show_vendor') !== NULL) {
			$vendor = $this->input->get('show_vendor');
		}
		$data['products_lang'] = $products_lang = $this->session->userdata('admin_lang_products');
		$rowscount = $this->User_model->productsCount($search_title, $orderby, $category);
		$data['userlist'] = $this->User_model->getproducts($this->num_rows, $page, $search_title, $orderby, $category, $vendor);
		$data['links_pagination'] = pagination('admin/listuser', $rowscount, $this->num_rows, 3);
		$data['num_shop_art'] = $this->User_model->numShopproducts();
		$data['languages'] = $this->Languages_model->getLanguages();
		$data['shop_categories'] = $this->Categories_model->getShopCategories(null, null, 2);
		$this->saveHistory('Go to user');
		$this->load->view('_parts/header', $head);
		$this->load->view('user/listuser', $data);
		$this->load->view('_parts/footer');
	}
	
	public function get_user_by_status($status='') {       
		$_SESSION['user_status']=$status;
		redirect('admin/listuser');
	}
	public function user_list() {       
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addcustomer', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editcustomer', $adminid)) {
            redirect('admin');
        } 
        $list = $this->Userlist_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $datarow) {    
            

            $active_inactive_badge='';
            if($datarow->isverified=='true'){
                $active_inactive_badge='<span class="badge badge-success badge-status-'.$datarow->id.'">Active</span>';
            }
            if($datarow->isverified=='false'){
                $active_inactive_badge='<span class="badge badge-danger badge-status-'.$datarow->id.'">inActive</span>';
            }            
            if($datarow->isverified=='true'){
                $str='Inactive';
                $class="btn-danger";
                $status='false';
            }
            if($datarow->isverified=='false'){
                $str='Active';
                $class="btn-success";
                $status='true';
            }
            $edit_url=base_url('admin/adduser/'). $datarow->id;
            $delete_url=base_url('admin/listuser?delete='). $datarow->id;
            $history_url=base_url('admin/customer-history/'). $datarow->id;
            $actionBtn = '<a href="'.$edit_url.'" class="btn btn-xs btn-warning">Edit <i class="fa fa-edit" aria-hidden="true"></i></a> 
			<a href="'.$delete_url.'" class="btn btn-xs btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></a>             
            <button class="btn btn-xs '.$class.' active_inactive_button" data-id="' . $datarow->id . '" data-status="' . $status . '" data-table="user_app" data-wherefield="id" data-updatefield="isverified" data-module="user_app">'.$str.'</button>
            <a href="'.$history_url.'" class="btn btn-xs btn-info">Device History <i class="fa fa-history" aria-hidden="true"></i></a>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $datarow->name;        
            $row[] = $datarow->mobilenumber;
            $row[] = $datarow->emailid;     
            $row[]=$datarow->compnay;
			$row[]=$datarow->a_name;
            $row[]=$active_inactive_badge;  
            $row[]=$actionBtn;               
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Userlist_model->count_all(),
            "recordsFiltered" => $this->Userlist_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

	public function getProductInfo($id, $noLoginCheck = false) {
		/*
			         * if method is called from public(template) page
		*/
		if ($noLoginCheck == false) {
			$this->login_check();
		}
		return $this->User_model->getOneProduct($id);
	}

	/*
		     * called from ajax
	*/

	public function productStatusChange() {
		$this->login_check();
		$result = $this->User_model->productStatusChange($_POST['id'], $_POST['to_status']);
		if ($result == true) {
			echo 1;
		} else {
			echo 0;
		}
		$this->saveHistory('Change user id ' . $_POST['id'] . ' to status ' . $_POST['to_status']);
	}

	
    public function approve_status() {        
        if (isset($_REQUEST['table_id'])) {
            $res = $this->Userlist_model->approve_status($_REQUEST);
            if ($res) {
                $data = array(
                    'suceess' => true
                );
            }
            echo json_encode($data);
        }
    }

}

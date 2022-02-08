<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Userreport extends ADMIN_Controller {

	private $num_rows = 10;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Report_model', 'Languages_model', 'Categories_model','Customer_history_model'));
	}

	public function index($page = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addcustomer', $adminid) || !in_array('editcustomer', $adminid) || !in_array('delcustomer', $adminid)) {redirect('admin');}
		$data = array();
		$head = array();
		$head['title'] = 'Administration - View products';
		$head['description'] = '!';
		$head['keywords'] = '';

		if (isset($_GET['delete'])) {
			$this->Report_model->deleteProduct($_GET['delete']);
			$this->session->set_flashdata('result_delete', 'product is deleted!');
			$this->saveHistory('Delete user id - ' . $_GET['delete']);
			redirect('admin/userreport');
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
		$vendor = null;
		if ($this->input->get('show_vendor') !== NULL) {
			$vendor = $this->input->get('show_vendor');
		}
		$data['products_lang'] = $products_lang = $this->session->userdata('admin_lang_products');
		$rowscount = $this->Report_model->productsCount($search_title, $orderby, $category);
		$data['usertype'] = $page;
		$data['userlist'] = $this->Report_model->getproducts($this->num_rows, $page, $search_title, $orderby, $category, $vendor);
		$data['changedevice'] = $this->Report_model->changedevice($this->num_rows, $page, $search_title, $orderby, $category, $vendor);
		$data['links_pagination'] = pagination('admin/userreport', $rowscount, $this->num_rows, 3);
		$data['num_shop_art'] = $this->Report_model->numShopproducts();
		$data['languages'] = $this->Languages_model->getLanguages();
		$data['shop_categories'] = $this->Categories_model->getShopCategories(null, null, 2);
		$this->saveHistory('Go to user');
		$this->load->view('_parts/header', $head);
		$this->load->view('user/userreport', $data);
		$this->load->view('_parts/footer');
	}

	public function getProductInfo($id, $noLoginCheck = false) {
		/*
			         * if method is called from public(template) page
		*/
		if ($noLoginCheck == false) {
			$this->login_check();
		}
		return $this->Report_model->getOneProduct($id);
	}

	/*
		     * called from ajax
	*/

	public function productStatusChange() {
		$this->login_check();
		$result = $this->Report_model->productStatusChange($_POST['id'], $_POST['to_status']);
		if ($result == true) {
			echo 1;
		} else {
			echo 0;
		}
		$this->saveHistory('Change user id ' . $_POST['id'] . ' to status ' . $_POST['to_status']);
	}



	public function customer_history($id)
    {        
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addcustomer', $adminid) || !in_array('editcustomer', $adminid) || !in_array('delcustomer', $adminid)) {redirect('admin');}                  
        $data = array();
        $data['id']=$id;
        $head = array();
        $head['title'] = 'Customer-History';
        $head['description'] = '!';
        $head['keywords'] = '';
  
        $this->load->view('_parts/header', $head);
        $this->load->view('user/customer-history', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Agent list');
    }

    public function customer_history_list($id) {       
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addcustomer', $adminid) || !in_array('editcustomer', $adminid) || !in_array('delcustomer', $adminid)) {redirect('admin');} 
        $list = $this->Customer_history_model->get_datatables($id);
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
            "recordsTotal" => $this->Customer_history_model->count_all($id),
            "recordsFiltered" => $this->Customer_history_model->count_filtered($id),
            "data" => $data,
        );
        echo json_encode($output);
    }

}

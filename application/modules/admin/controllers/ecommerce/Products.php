<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Products extends ADMIN_Controller {

	private $num_rows = 10;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Products_model', 'Languages_model', 'Categories_model','Productsdt_model'));
	}

	public function index($page = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addproduct', $adminid) || !in_array('editproduct', $adminid) || !in_array('deleteproduct', $adminid)) {redirect('admin');}
		$data = array();
		$head = array();
		$head['title'] = 'List-Products';
		$head['description'] = '!';
		$head['keywords'] = '';
		if (isset($_GET['delete'])) {
			if (!in_array('deleteproduct', $adminid)) {redirect('admin');}
			$this->Products_model->deleteProduct($_GET['delete']);
			$this->session->set_flashdata('result_delete', 'product is deleted!');
			$this->saveHistory('Delete product id - ' . $_GET['delete']);
			redirect('admin/products');
		}

		unset($_SESSION['filter']);
		$search_title = null;
		if ($this->input->get('search_title') !== NULL) {
			$search_title = $this->input->get('search_title');
			$_SESSION['filter']['search_title'] = $search_title;
			$this->saveHistory('Search for product title - ' . $search_title);
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
			$this->saveHistory('Search for product code - ' . $category);
		}
		$vendor = null;
		if ($this->input->get('show_vendor') !== NULL) {
			$vendor = $this->input->get('show_vendor');
		}
		$data['products_lang'] = $products_lang = $this->session->userdata('admin_lang_products');
		$rowscount = $this->Products_model->productsCount($search_title, $category);
		$data['products'] = $this->Products_model->getproducts($this->num_rows, $page, $search_title, $orderby, $category, $vendor);
		$data['links_pagination'] = pagination('admin/products', $rowscount, $this->num_rows, 3);
		$data['num_shop_art'] = $this->Products_model->numShopproducts();
		$data['languages'] = $this->Languages_model->getLanguages();
		$data['shop_categories'] = $this->Categories_model->getShopCategories(null, null, 2);
		$this->saveHistory('Go to products');
		$this->load->view('_parts/header', $head);
		$this->load->view('ecommerce/products', $data);
		$this->load->view('_parts/footer');
	}


	public function product_list() {       
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addproduct', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editproduct', $adminid)) {
            redirect('admin');
        } 
        $list = $this->Productsdt_model->get_datatables();
        $data = array();
        $no = $_POST['start'];

        // echo '<pre>';print_r($list);die;

        foreach ($list as $datarow) {    
           
			$cat=array();
			$catStr='';
			$categories = $this->Productsdt_model->get_productCat($datarow->id);			
			if(!empty($categories)){
				foreach($categories as $ct_row){
					array_push($cat,$ct_row['name']);
				}
				$catStr=implode(',',$cat);
			}
			

			$this->db->select_sum('qty');
			$this->db->where('itemid',$datarow->id);
			$result = $this->db->get('order_products')->row();  
			$totalStockOrder=$result->qty;

			$this->db->select_sum('qty');
			$this->db->where('refProduct_id', $datarow->id);
			$result = $this->db->get('stock')->row();  
			$totalStock=$result->qty;

			$stock_history_url=base_url('admin/stock/'). $datarow->id;
			$finalstock=$totalStock-$totalStockOrder;
			$stock='<a href="'.$stock_history_url.'">'.$finalstock.'</a>';

			$u_path = 'attachments/shop_images/';
			if ($datarow->image != null && file_exists($u_path . $datarow->image)) {
				$image = base_url($u_path . $datarow->image);
			} else {
				$image = base_url('attachments/no-image.png');
			}

			$img=' <a href="'.base_url('admin/likedislikeproimg/' . $datarow->id).'">
			<img src="'.$image.'" alt="No Image" class="img-thumbnail" style="height:100px;"></a>';


			$active_inactive_badge='';
            if($datarow->visibility==1){
                $active_inactive_badge='<span class="badge badge-success badge-status-'.$datarow->id.'">Active</span>';
            }
            if($datarow->visibility==0){
                $active_inactive_badge='<span class="badge badge-danger badge-status-'.$datarow->id.'">inActive</span>';
            }            
            if($datarow->visibility==1){
                $str='Inactive';
                $class="btn-danger";
                $status=0;
            }
            if($datarow->visibility==0){
                $str='Active';
                $class="btn-success";
                $status=1;
            }



			// $actionBtn = '<button class="btn btn-xs '.$class.' active_inactive_button" data-id="' . $datarow->attributes_id . '" data-status="' . $status . '" data-table="attributes" data-wherefield="attributes_id" data-updatefield="status" data-module="attributes">'.$str.'</button>';

            $edit_url=base_url('admin/publish/'). $datarow->id; 
			$delete_url=base_url('admin/products?delete='). $datarow->id;   
			$stock_url=base_url('admin/add-stock/'). $datarow->id;            
            $actionBtn = '<a href="'.$edit_url.'" class="btn btn-xs btn-warning">Edit <i class="fa fa-edit" aria-hidden="true"></i></a>             
			<a href="'.$delete_url.'" class="btn btn-xs btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></a>
			<button class="btn btn-xs '.$class.' active_inactive_button" data-id="' . $datarow->id . '" data-status="' . $status . '" data-table="products" data-wherefield="id" data-updatefield="visibility" data-module="products">'.$str.'</button>
			<a href="'.$stock_url.'" class="btn btn-xs btn-info">Stock <i class="fa fa-plus" aria-hidden="true"></i></a>
			';
            $no++;
            $row = array();
            $row[] = $no;
			$row[] = $img;
            $row[] = $datarow->title; 
			$row[] = $catStr;        
            $row[] = $datarow->price3;
			$row[] = $datarow->theli_price3; 
            $row[]=$datarow->product_pcs; 
			$row[]=$stock;  
            $row[]=$datarow->view_count;  
            $row[]=$this->db->count_all_results('userviewproduct');   
			$row[]=$active_inactive_badge; 
			$row[]=$actionBtn;             
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Productsdt_model->count_all(),
            "recordsFiltered" => $this->Productsdt_model->count_filtered(),
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
		return $this->Products_model->getOneProduct($id);
	}

	/*
		     * called from ajax
	*/

	public function productStatusChange() {
		$this->login_check();
		$result = $this->Products_model->productStatusChange($_POST['id'], $_POST['to_status']);
		if ($result == true) {
			echo 1;
		} else {
			echo 0;
		}
		$this->saveHistory('Change product id ' . $_POST['id'] . ' to status ' . $_POST['to_status']);
	}
	public function approve_status() {        
        if (isset($_REQUEST['table_id'])) {
            $res = $this->Productsdt_model->approve_status($_REQUEST);
            if ($res) {
                $data = array(
                    'suceess' => true
                );
            }
            echo json_encode($data);
        }
    }
	
	public function addStock($id=0) {		
		$this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addproduct', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editproduct', $adminid)) {
            redirect('admin');
        }          
		if (isset($_POST['submit'])) {            
			$res=$this->Products_model->addStock($_POST);
			if ($res) {
				$this->session->set_flashdata('add_stock', 'Stock Updated Successfully!');
				$this->saveHistory('Success Updated stock');  
				redirect('admin/products');              
			}else{
				$this->session->set_flashdata('add_stock', 'somthing happen wrong!');
				$this->saveHistory('Failed Update stock');    
			}
		} 
					
		$data = array();		
		$head = array();
		$head['title'] = 'Administration - Add Stock';
		$head['description'] = '!';
		$head['keywords'] = '';
	
		$data['id']=$id;
		$this->load->view('_parts/header', $head);
		$this->load->view('ecommerce/add-stock', $data);
		$this->load->view('_parts/footer');
		$this->saveHistory('Go to Add Stock');		
	}

}

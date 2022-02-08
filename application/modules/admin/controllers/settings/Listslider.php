<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Listslider extends ADMIN_Controller {

	private $num_rows = 100;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Products_model', 'Slider_model', 'Languages_model', 'Categories_model'));
	}

	public function index($page = 0, $id = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addslider', $adminid) || !in_array('editslider', $adminid) || !in_array('deleteslider', $adminid)) {redirect('admin');}
		$data = array();
		$head = array();
		$head['title'] = 'Administration - View products';
		$head['description'] = '!';
		$head['keywords'] = '';

		if (isset($_POST['submit'])) {
			$id = 0;
			if (isset($_POST['editsliderid'])) {
				$id = $_POST['editsliderid'];
			}
			if (!in_array('addslider', $adminid) & $id == 0) {redirect('admin');}
			if (!in_array('editslider', $adminid) & $id != 0) {redirect('admin');}
			$_POST['image'] = $this->uploadImage();
			$this->Slider_model->setSlider($_POST, $id);
			$this->session->set_flashdata('result_publish', 'Slider Successfully Added!');
			if ($id == 0) {
				$this->saveHistory('Success published Slider');
			} else {
				$this->saveHistory('Success updated Slider');
			}
			if (isset($_SESSION['filter']) && $id > 0) {
				$get = '';
				foreach ($_SESSION['filter'] as $key => $value) {
					$get .= trim($key) . '=' . trim($value) . '&';
				}
				redirect(base_url('admin/listslider?' . $get));
			} else {
				redirect('admin/listslider');
			}
		}

		if (isset($_GET['delete'])) {
			if (!in_array('deleteslider', $adminid)) {redirect('admin');}
			$this->Slider_model->deleteProduct($_GET['delete']);
			$this->session->set_flashdata('result_delete', 'slider is deleted!');
			$this->saveHistory('Delete slider id - ' . $_GET['delete']);
			redirect('admin/listslider');
		}

		unset($_SESSION['filter']);
		$search_title = null;
		if ($this->input->get('search_title') !== NULL) {
			$search_title = $this->input->get('search_title');
			$_SESSION['filter']['search_title'] = $search_title;
			$this->saveHistory('Search for slider title - ' . $search_title);
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
			$this->saveHistory('Search for slider code - ' . $category);
		}
		$vendor = null;
		if ($this->input->get('show_vendor') !== NULL) {
			$vendor = $this->input->get('show_vendor');
		}
		$data['products_lang'] = $products_lang = $this->session->userdata('admin_lang_products');
		$rowscount = $this->Slider_model->productsCount($search_title, $category);
		$data['appslidelist'] = $this->Slider_model->getSlider($this->num_rows, $page, $search_title, $orderby, $category, $vendor, 'app');
		$data['websiteslidelist'] = $this->Slider_model->getSlider($this->num_rows, $page, $search_title, $orderby, $category, $vendor, 'web');
		$data['links_pagination'] = pagination('admin/listuser', $rowscount, $this->num_rows, 3);
		$data['num_shop_art'] = $this->Slider_model->numShopproducts();
		$data['products'] = $this->Products_model->getproducts(500, $page, $search_title, $orderby, $category, $vendor);
		$data['languages'] = $this->Languages_model->getLanguages();
		$data['shop_categories'] = $this->Categories_model->getShopCategories(null, null, 2);
		$this->saveHistory('Go to slider page');
		$this->load->view('_parts/header', $head);
		$this->load->view('settings/listslider', $data);
		$this->load->view('_parts/footer');
	}

	private function uploadImage() {
		if (isset($_FILES['sliderfile'])) {
			if (isset($_FILES['sliderfile']['name']) && $_FILES['sliderfile']['name'] != '') {
				$new_name = time() . '_' . $_FILES["sliderfile"]['name'];
				$config['upload_path'] = './attachments/slider_img/';
				$config['allowed_types'] = $this->allowed_img_types;
				$config['file_name'] = $new_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('sliderfile')) {
					log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
				}
				$img = $this->upload->data();
				return $img['file_name'];
			} else {
				return !empty($_POST['oldsliderfile']) ? $_POST['oldsliderfile'] : '';
			}
		} else {
			return '';
		}
		/*$config['upload_path'] = './attachments/slider_img/';
			        $config['allowed_types'] = $this->allowed_img_types;
			        $this->load->library('upload', $config);
			        $this->upload->initialize($config);
			        if (!$this->upload->do_upload('sliderfile')) {
			            log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
			        }
			        $img = $this->upload->data();
		*/
	}

	public function getProductInfo($id, $noLoginCheck = false) {
		/*
			         * if method is called from public(template) page
		*/
		if ($noLoginCheck == false) {
			$this->login_check();
		}
		return $this->Slider_model->getOneProduct($id);
	}

	/*
		     * called from ajax
	*/

	public function productStatusChange() {
		$this->login_check();
		$result = $this->Slider_model->productStatusChange($_POST['id'], $_POST['to_status']);
		if ($result == true) {
			echo 1;
		} else {
			echo 0;
		}
		$this->saveHistory('Change product id ' . $_POST['id'] . ' to status ' . $_POST['to_status']);
	}

}

<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class ShopCategories extends ADMIN_Controller {

	private $num_rows = 20;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Categories_model', 'Languages_model'));
	}

	public function index($page = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		$data = array();
		$head = array();
		$head['title'] = 'Administration - Home Categories';
		$head['description'] = '!';
		$head['keywords'] = '';
		$data['shop_categories'] = $this->Categories_model->getShopCategories($this->num_rows, $page);
		$data['languages'] = $this->Languages_model->getLanguages();
		$rowscount = $this->Categories_model->categoriesCount();
		$data['links_pagination'] = pagination('admin/shopcategories', $rowscount, $this->num_rows, 3);
		if (isset($_GET['delete'])) {
			if (!in_array('deletecat', $adminid)) {redirect('admin');}
			$this->saveHistory('Delete a shop categorie');
			$this->Categories_model->deleteShopCategorie($_GET['delete']);
			$this->session->set_flashdata('result_delete', 'Shop Categorie is deleted!');
			redirect('admin/shopcategories');
		}
		if (isset($_POST['submit'])) {
			if (!in_array('addcat', $adminid)) {redirect('admin');}
			$id = 0;
			if (isset($_POST['editcatid'])) {
				$id = $_POST['editcatid'];
			}
			$_POST['image'] = $this->uploadImage();
			$_POST['webimage'] = $this->uploadImage('website');
			$this->Categories_model->setShopCategorie($_POST, $id);
			$this->session->set_flashdata('result_add', 'Shop categorie is added!');
			redirect('admin/shopcategories');
		}
		if (isset($_POST['editSubId'])) {
			if (!in_array('editcat', $adminid)) {redirect('admin');}
			$result = $this->Categories_model->editShopCategorieSub($_POST);
			if ($result === true) {
				$this->session->set_flashdata('result_add', 'Subcategory changed!');
				$this->saveHistory('Change subcategory for category id - ' . $_POST['editSubId']);
			} else {
				$this->session->set_flashdata('result_add', 'Problem with Shop category change!');
			}
			redirect('admin/shopcategories');
		}
		$this->load->view('_parts/header', $head);
		$this->load->view('ecommerce/shopcategories', $data);
		$this->load->view('_parts/footer');
		$this->saveHistory('Go to shop categories');
	}

	/*
		     * Called from ajax
	*/

	public function editShopCategorie() {
		$this->login_check();
		$result = $this->Categories_model->editShopCategorie($_POST);
		$this->saveHistory('Edit shop categorie to ' . $_POST['name']);
	}

	/*
		     * Called from ajax
	*/

	public function changePosition() {
		$this->login_check();
		$result = $this->Categories_model->editShopCategoriePosition($_POST);
		$this->saveHistory('Edit shop categorie position ' . $_POST['name']);
	}

	private function uploadImage($banner = null) {
		if ($banner == null) {
			if (isset($_FILES['userfile'])) {
				if (isset($_FILES['userfile']['name']) && $_FILES['userfile']['name'] != '') {
					$new_name = time() . '_' . $_FILES["userfile"]['name'];
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

<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class ShopAttribute extends ADMIN_Controller {

	private $num_rows = 20;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Attribute_model', 'Languages_model'));
	}

	public function index($page = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		$data = array();
		$head = array();
		$head['title'] = 'Administration - Home Attributes';
		$head['description'] = '!';
		$head['keywords'] = '';
		$data['shop_attribute'] = $this->Attribute_model->getShopAttribute($this->num_rows, $page);
		$data['shop_mainattribute'] = $this->Attribute_model->getShopmainAttribute($this->num_rows, $page);
		$data['languages'] = $this->Languages_model->getLanguages();
		$rowscount = $this->Attribute_model->attributeCount();
		$data['links_pagination'] = pagination('admin/shopattribute', $rowscount, $this->num_rows, 3);
		if (isset($_GET['delete'])) {
			if (!in_array('deleteattribute', $adminid)) {redirect('admin');}
			$this->saveHistory('Delete a Attribute');
			$this->Attribute_model->deleteShopAttribute($_GET['delete']);
			$this->session->set_flashdata('result_delete', 'Attribute is deleted!');
			redirect('admin/shopattribute');
		}
		if (isset($_POST['submit'])) {
			if (!in_array('addattribute', $adminid)) {redirect('admin');}
			$this->Attribute_model->setShopAttribute($_POST);
			$this->session->set_flashdata('result_add', 'Attribute is added!');
			redirect('admin/shopattribute');
		}
		if (isset($_POST['editSubId'])) {
			$result = $this->Attribute_model->editShopAttributeSub($_POST);
			if ($result === true) {
				$this->session->set_flashdata('result_add', 'Attribute changed!');
				$this->saveHistory('Change Group for Attribute id - ' . $_POST['editSubId']);
			} else {
				$this->session->set_flashdata('result_add', 'Problem with Shop Attribute change!');
			}
			redirect('admin/shopattribute');
		}
		$this->load->view('_parts/header', $head);
		$this->load->view('ecommerce/shopattribute', $data);
		$this->load->view('_parts/footer');
		$this->saveHistory('Go to shop categories');
	}

	/*
		     * Called from ajax
	*/

	public function editShopAttribute() {
		$this->login_check();
		$result = $this->Attribute_model->editShopAttribute($_POST);
		$this->saveHistory('Edit Attribute to ' . $_POST['name']);
	}

	/*
		     * Called from ajax
	*/

	public function changePositionAttr() {
		$this->login_check();
		$result = $this->Attribute_model->editShopAttributePosition($_POST);
		$this->saveHistory('Edit Attribute position ' . $_POST['name']);
	}

}

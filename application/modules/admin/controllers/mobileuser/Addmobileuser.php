<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Addmobileuser extends ADMIN_Controller {
	private $num_rows = 10;

	public function __construct() {
		parent::__construct();
		$this->load->model(array(
			'Mobileuser_model', 'Languages_model',
		));
	}

	public function index($page = 0, $id = 0) {
		$this->login_check();
		$is_update = false;
		$trans_load = null;
		// if ($id > 0 && $_POST == null) {
		// 	$_POST = $this->Mobileuser_model->getCoupan($id);
		// }
		if (isset($_POST['submit'])) {
			if (isset($_GET['to_lang'])) {
				$id = 0;
			}
			$name = $_POST['mobilenumber'];

			$exists = $this->db->query("Select mobilenumber from users where(mobilenumber='" . $name . "') Limit 1");
			if ($exists->num_rows() > 0) {
				$this->session->set_flashdata('result_publish', 'Same Mobileuser Alredy Exits!');
				redirect('admin/addmobileuser');
			} else {
				$this->Mobileuser_model->setMobileuser($_POST);
			}

			if ($id == 0) {
				$this->session->set_flashdata('result_publish', 'Create Mobileuser Successfully!');
				$this->saveHistory('Success create Mobileuser');
			} else {
				$this->session->set_flashdata('result_publish', 'Updated Mobileuser Successfully!');
				$this->saveHistory('Updated This Mobileuser ' . $id);
			}
		}

		if (isset($_POST['update'])) {
			if (isset($_GET['to_lang'])) {
				$id = 0;
			}
			$name = $_POST['mobilenumber'];

			$updateid = $_POST['updateid'];

			$exists = $this->db->query("Select mobilenumber from users where(mobilenumber='" . $name . "') AND id != $updateid Limit 1");
			if ($exists->num_rows() > 0) {
				$this->session->set_flashdata('result_publish', 'Mobileuser With Same Code Alredy Exits!');
				redirect('admin/addmobileuser');
			} else {
				$this->session->set_flashdata('result_publish', 'Updated Mobileuser Successfully!');
				$this->Mobileuser_model->setMobileuser($_POST, $_POST['updateid']);
			}

			if ($id == 0) {
				$this->session->set_flashdata('result_publish', 'Updated Mobileuser Successfully!');
				$this->saveHistory('Success create Mobileuser');
			} else {
				$this->session->set_flashdata('result_publish', 'Updated Mobileuser Successfully!');
				$this->saveHistory('Updated This Mobileuser ' . $id);
			}
		}

		if (isset($_GET['delete'])) {
			$this->Mobileuser_model->deleteMobileuser($_GET['delete']);
			$this->session->set_flashdata('result_publish', 'Mobileuser is deleted!');
			$this->saveHistory('Delete Mobileuser id - ' . $_GET['delete']);
			redirect('admin/addmobileuser');
		}

		$data = array();
		$head = array();
		$head['title'] = 'Mobileuser';
		$head['description'] = '!';
		$head['keywords'] = '';
		$data['id'] = $id;
		$data['languages'] = $this->Languages_model->getLanguages();
		$data['trans_load'] = $trans_load;

		$rowscount = $this->Mobileuser_model->MobileuserCount();
		$data['mobileuserlist'] = $this->Mobileuser_model->getMobileusers($this->num_rows, $page);
		if (isset($_GET['edit'])) {
			$data['singlemobileuserlist'] = $this->Mobileuser_model->getMobileuser($_GET['edit']);
		}
		$data['links_pagination'] = pagination('admin/addmobileuser', $rowscount, $this->num_rows, 3);

		$this->load->view('_parts/header', $head);
		$this->load->view('mobileuser/addmobileuser', $data);
		$this->load->view('_parts/footer');
		$this->saveHistory('Go to Add Mobileuser');
	}

	function check_coupan($coupanid) {
		$unique_number = !empty($coupanid) ? $coupanid : 0;
		$exists = $this->db->query("Select * from Mobileuser where(id='" . $unique_number . "') Limit 1");
		if ($exists->num_rows() > 0) {
			$results = $this->check_number();
			// echo "MATCH FOUND";
		} else {
			$results = $unique_number;
			// echo "MATCH NOT FOUND";
			return $results;
		}
	}

}

<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Adduser extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array(
			'User_model',
			'Languages_model',
			'Brands_model',
			'Categories_model',
		));
	}

	public function index($id = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addcustomer', $adminid) & $id == 0) {redirect('admin');}
		if (!in_array('editcustomer', $adminid) & $id != 0) {redirect('admin');}
		$is_update = false;
		$trans_load = null;
		if ($id > 0 && $_POST == null) {
			$_POST = $this->User_model->getOneProduct($id);
			$_POST['Addresslist'] = $this->User_model->getuseraddress($id);
			$_POST['Chatcomment'] = $this->User_model->chatcomment($id);
			$trans_load = $this->User_model->getTranslations($id);
		}
		if (isset($_POST['submit'])) {
			if (isset($_GET['to_lang'])) {
				$id = 0;
			}
			$_POST['image'] = $this->uploadImage();
			$this->User_model->setProduct($_POST, $id);
			if ($id == 0) {
				$this->session->set_flashdata('result_publish', 'Create User Successfully!');
				$this->saveHistory('Success create User');
			} else {
				$this->session->set_flashdata('result_publish', 'Updated Userdata Successfully!');
				$this->saveHistory('Updated This User ' . $id);
			}
			if (isset($_SESSION['filter']) && $id > 0) {
				$get = '';
				foreach ($_SESSION['filter'] as $key => $value) {
					$get .= trim($key) . '=' . trim($value) . '&';
				}
				redirect(base_url('admin/listuser?' . $get));
			} else {
				redirect('admin/listuser');
			}
		}
		if (isset($_POST['addresssubmit'])) {
			// if (!in_array('addcat', $adminid)) {redirect('admin');}
			$id = 0;
			if (isset($_POST['editaddressid'])) {
				$id = $_POST['editaddressid'];
			}
			$this->User_model->setUserAddress($_POST, $id);
			$this->session->set_flashdata('result_add', 'User Address is added!');
			redirect('admin/adduser/' . $_POST['userid']);
		}
		if (isset($_POST['editaddressid'])) {
			// if (!in_array('editcat', $adminid)) {redirect('admin');}
			// $result = $this->Categories_model->editShopCategorieSub($_POST);
			// if ($result === true) {
			// 	$this->session->set_flashdata('result_add', 'Subcategory changed!');
			// 	$this->saveHistory('Change subcategory for category id - ' . $_POST['editSubId']);
			// } else {
			// 	$this->session->set_flashdata('result_add', 'Problem with Shop category change!');
			// }
			// redirect('admin/shopcategories');
			$id = 0;
			if (isset($_POST['editaddressid'])) {
				$id = $_POST['editaddressid'];
			}
			$this->User_model->setUserAddress($_POST, $id);
			$this->session->set_flashdata('result_add', 'User Address is added!');
			redirect('admin/adduser/' . $_POST['userid']);
		}
		if (isset($_POST['sendmessagechat']) && isset($_POST['commentmsg'])) {

			$this->User_model->sendordersmsg($id);
			redirect('admin/adduser/' . $id);
		}
		$data = array();
		$head = array();
		$head['title'] = 'Administration - Publish Product';
		$head['description'] = '!';
		$head['keywords'] = '';
		$data['id'] = $id;
		$data['trans_load'] = $trans_load;
		$data['languages'] = $this->Languages_model->getLanguages();
		$data['shop_categories'] = $this->Categories_model->getShopCategories();
		$data['brands'] = $this->Brands_model->getBrands();
		$data['otherImgs'] = $this->loadOthersImages();
		$this->load->view('_parts/header', $head);
		$this->load->view('user/adduser', $data);
		$this->load->view('_parts/footer');
		$this->saveHistory('Go to Add User');
	}


	public function removeaddress() {        
        if (isset($_REQUEST['id'])) {
			$this->db->where('id', $_REQUEST['id']);
			$this->db->delete('useraddress');            
			$data = array(
				'suceess' => 'success'
			);            
            echo json_encode($data);
        }
    }

	private function uploadImage() {
		$config['upload_path'] = './attachments/shop_images/';
		$config['allowed_types'] = $this->allowed_img_types;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('userfile')) {
			log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
		}
		$img = $this->upload->data();
		return $img['file_name'];
	}

	/*
		             * called from ajax
	*/

	public function do_upload_others_images() {
		if ($this->input->is_ajax_request()) {
			$upath = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['folder'] . DIRECTORY_SEPARATOR;
			if (!file_exists($upath)) {
				mkdir($upath, 0777);
			}

			$this->load->library('upload');

			$files = $_FILES;
			$cpt = count($_FILES['others']['name']);
			for ($i = 0; $i < $cpt; $i++) {
				unset($_FILES);
				$_FILES['others']['name'] = $files['others']['name'][$i];
				$_FILES['others']['type'] = $files['others']['type'][$i];
				$_FILES['others']['tmp_name'] = $files['others']['tmp_name'][$i];
				$_FILES['others']['error'] = $files['others']['error'][$i];
				$_FILES['others']['size'] = $files['others']['size'][$i];

				$this->upload->initialize(array(
					'upload_path' => $upath,
					'allowed_types' => $this->allowed_img_types,
				));
				$this->upload->do_upload('others');
			}
		}
	}

	public function loadOthersImages() {
		$output = '';
		if (isset($_POST['folder']) && $_POST['folder'] != null) {
			$dir = 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['folder'] . DIRECTORY_SEPARATOR;
			if (is_dir($dir)) {
				if ($dh = opendir($dir)) {
					$i = 0;
					while (($file = readdir($dh)) !== false) {
						if (is_file($dir . $file)) {
							$output .= '
                                <div class="other-img" id="image-container-' . $i . '">
                                    <img src="' . base_url('attachments/shop_images/' . $_POST['folder'] . '/' . $file) . '" style="width:100px; height: 100px;">
                                    <a href="javascript:void(0);" onclick="removeSecondaryProductImage(\'' . $file . '\', \'' . $_POST['folder'] . '\', ' . $i . ')">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                </div>
                               ';
						}
						$i++;
					}
					closedir($dh);
				}
			}
		}
		if ($this->input->is_ajax_request()) {
			echo $output;
		} else {
			return $output;
		}
	}

	/*
		             * called from ajax
	*/

	public function removeSecondaryImage() {
		if ($this->input->is_ajax_request()) {
			$img = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . '' . $_POST['folder'] . DIRECTORY_SEPARATOR . $_POST['image'];
			unlink($img);
		}
	}

	//Bulk User
	public function addbulkuser() {
		if (isset($_POST['submit'])) {
			$userexits = array();
			$fp = fopen($_FILES['csvfile']['tmp_name'], 'r') or die("can't open file");
			$skip = 0;
			while (($line = fgetcsv($fp)) !== FALSE) {
				// echo '<pre>';print_r($line[3]);
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
					// print_r($line);
					$row=$this->User_model->getAgentId(str_replace('"', '', strtolower($line[3])));																			
					$agent_id=0;
					if (!empty($row)) {						
						$agent_id=$row['agent_id'];
					}
									
					$data = array(
						'name' => str_replace('"', '', "$line[0]"),
						'ac_type' => str_replace('"', '', "$line[1]"),
						'city' => str_replace('"', '', "$line[2]"),
						'alocation_agent_id' => $agent_id,
						'whatsapp' => str_replace('"', '', $line[4]),
						'mobilenumber' => str_replace('"', '', $line[5]),
						'phone_2' => str_replace('"', '', $line[6]),
						'emailid' => str_replace('"', '', $line[7]),
						'sms_no' => str_replace('"', '', $line[8]),											
						'gstin' => str_replace('"', '', $line[9]),
						'guest' => 1,	
						'isverified' => 'true'			
					);

					$querymobile = $this->db->get_where('user_app', array('whatsapp' => $data['whatsapp']));
					if ($querymobile->num_rows() > 0) {
						$this->session->set_flashdata('result_publish', 'Some Users Mobile Already exits In System!');
						array_push($userexits, $data['mobilenumber']);
					} else {
						$this->db->insert('user_app', $data);
					}
				}
			}
			// die;	
			fclose($fp) or die("can't close file");
			$List = implode(', ', $userexits);
			if ($List) {
				$this->session->set_flashdata('result_error', "Some Users Mobile Number Already exits In System! $List");
			}
			$this->session->set_flashdata('result_publish', 'Customers Imported Successfully');
			redirect('admin/listuser');
		}
	}


	public function approve_status() {        
        if (isset($_REQUEST['table_id'])) {
            $res = $this->User_model->approve_status($_REQUEST);
            if ($res) {
                $data = array(
                    'suceess' => true
                );
            }
            echo json_encode($data);
        }
    }

}

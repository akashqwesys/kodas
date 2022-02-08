<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Viewchat extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array(
			'AgentChat_model',
			'Languages_model',
			'Brands_model',
			'Categories_model',
		));
	}

	public function index($id = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addagent', $adminid) & $id == 0) {redirect('admin');}
		if (!in_array('editagent', $adminid) & $id != 0) {redirect('admin');}
		$is_update = false;
		$trans_load = null;
		if ($id > 0 && $_POST == null) {
			$_POST = $this->AgentChat_model->getOneProduct($id);
			$_POST['Addresslist'] = $this->AgentChat_model->getuseraddress($id);
			$_POST['Chatcomment'] = $this->AgentChat_model->chatcomment($id);
			$trans_load = $this->AgentChat_model->getTranslations($id);
		}
		if (isset($_POST['submit'])) {
			if (isset($_GET['to_lang'])) {
				$id = 0;
			}
			$_POST['image'] = $this->uploadImage();
			$this->AgentChat_model->setProduct($_POST, $id);
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
				redirect(base_url('admin/chatlistagent?' . $get));
			} else {
				redirect('admin/chatlistagent');
			}
		}
		if (isset($_POST['sendmessagechat']) && isset($_POST['commentmsg'])) {

			$this->AgentChat_model->sendordersmsg($id);
			redirect('admin/viewchatagent/' . $id);
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
		$this->load->view('agent/viewchat', $data);
		$this->load->view('_parts/footer');
		$this->saveHistory('Go to Add User');
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

	public function chatfunction() {
		// echo 'hi';die;
		$chatcomment = $this->AgentChat_model->chatcomment($_POST['agent_id']);
		// echo '<pre>';		
		$data = '';
		if (isset($chatcomment)) {
			foreach ($chatcomment as $key => $value) {
				$namemsg = '';
				if ($value['usertype'] == 'admin') {
					$test = $this->db->select('*')->where('id', $value['sender_id'])->get('users')->row();
					$namemsg = $test->username . ' (admin)';
				} else {
					$namemsg = @$value['name'];
				}

				$audiofile = !empty($value['audiofile']) ? base_url('attachments/audiofile/' . $value['audiofile']) : '';

				$data .= '<tr>
                  <td class="text-left">' . $namemsg . '</td>
                  <td class="text-left">' . $value['message'] . '</td>
                  <td class="text-left">';

				if (isset($audiofile) && $audiofile != '') {
					$data .= '<audio controls="">
                        <source src="' . $audiofile . '" type="audio/mpeg">
                      </audio>';
				}
				$data .= '</td>
                  <td class="text-left">' . date('d-m-Y h:i A', $value['timeanddate']) . '</td>
                </tr>';
			}
		}
		$retVal['chatdata'] = $data;
		$retVal['userid'] = $_POST['agent_id'];
		echo json_encode($retVal);
	}

	public function chatsendfunction() {
		$adminid = $this->session->userdata('logged_id');
		$data['sender_id'] = $adminid;
		$data['receiver_id'] = !empty($this->input->post("receiver_id")) ? $this->input->post("receiver_id") : '';
		$data['message'] = !empty($this->input->post("commentmsg")) ? $this->input->post("commentmsg") : '';
		$data['usertype'] = 'admin';
		$data['userid'] = !empty($this->input->post("receiver_id")) ? $this->input->post("receiver_id") : '';
		$data['timeanddate'] = time();
		$result_check = $this->db->insert('wpn_chatmessenger1', $data);
		$msg = '';
		if ($result_check == 1) {
			$msg = 'Message sent successfully!';
		}
		$retVal['msg'] = $msg;
		$retVal['userid'] = !empty($this->input->post("receiver_id")) ? $this->input->post("receiver_id") : '';
		echo json_encode($retVal);
	}

	//Bulk User
	public function addbulkuser() {
		if (isset($_POST['submit'])) {
			$userexits = array();
			$fp = fopen($_FILES['csvfile']['tmp_name'], 'r') or die("can't open file");
			$skip = 0;
			while (($line = fgetcsv($fp)) !== FALSE) {
				if ($skip == 0) {
					$skip++;
				} else {
					$getpremium = str_replace('"', '', strtolower("$line[7]"));
					$getcoupan = str_replace('"', '', strtolower("$line[8]"));
					$getcredit = str_replace('"', '', strtolower("$line[9]"));
					if ($getpremium == 'yes') {
						$premium = 1;
					} else {
						$premium = 0;
					}
					if ($getcoupan == 'yes') {
						$coupan = 1;
					} else {
						$coupan = 0;
					}
					if ($getcredit == 'yes') {
						$credit = 1;
					} else {
						$credit = 0;
					}
					$data = array(
						'name' => str_replace('"', '', $line[0]),
						'mobilenumber' => str_replace('"', '', $line[1]),
						'emailid' => str_replace('"', '', $line[2]),
						'address' => str_replace('"', '', $line[3]),
						'gstin' => str_replace('"', '', $line[4]),
						'businessname' => str_replace('"', '', $line[5]),
						'jobtitle' => str_replace('"', '', $line[6]),
						'isverified' => "true",
						'premiumuser' => $premium,
						'credit' => $credit,
						'coupan' => $coupan,
						'pviewcount' => 500,
					);

					$querymobile = $this->db->get_where('user_app', array('mobilenumber' => $data['mobilenumber']));
					if ($querymobile->num_rows() > 0) {
						$this->session->set_flashdata('result_publish', 'Some Users Mobile Already exits In System!');
						array_push($userexits, $data['mobilenumber']);
					} else {
						$this->db->insert('user_app', $data);
					}
				}
			}
			fclose($fp) or die("can't close file");
			$List = implode(', ', $userexits);
			if ($List) {
				$this->session->set_flashdata('result_error', "Some Users Mobile Number Already exits In System! $List");
			}
			$this->session->set_flashdata('result_publish', 'Customers Imported Successfully');
			redirect('admin/chatlistagent');
		}
	}

}

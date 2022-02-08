<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

class Publish extends ADMIN_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model(array(
			'Products_model',
			'Languages_model',
			'Brands_model',
			'Categories_model',
			'Attribute_model',
		));
		$this->load->library('Compress');
	}

	public function index($id = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addproduct', $adminid) & $id == 0) {redirect('admin');}
		if (!in_array('editproduct', $adminid) & $id != 0) {redirect('admin');}
		$is_update = false;
		$trans_load = null;
		if ($id > 0 && $_POST == null) {
			$_POST = $this->Products_model->getOneProduct($id);
			$_POST['multicat'] = $this->Products_model->getMulticat($id);
			$trans_load = $this->Products_model->getTranslations($id);
		}

		if (isset($_POST['submit'])) {

			if (isset($_GET['to_lang'])) {
				$id = 0;
			}
			$_POST['image'] = $this->uploadImage();
			$this->Products_model->setProduct($_POST, $id);
			$this->session->set_flashdata('result_publish', 'Product is published!');
			if ($id == 0) {
				$this->saveHistory('Success published product');
			} else {
				$this->saveHistory('Success updated product');
			}
			if (isset($_SESSION['filter']) && $id > 0) {
				$get = '';
				foreach ($_SESSION['filter'] as $key => $value) {
					$get .= trim($key) . '=' . trim($value) . '&';
				}
				redirect(base_url('admin/products?' . $get));
			} else {
				redirect('admin/products');
			}
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
		$data['shop_attribute'] = $this->Attribute_model->getShopAttribute();
		$data['shop_mainattribute'] = $this->Attribute_model->getShopmainAttribute();
		$data['brands'] = $this->Brands_model->getBrands();

		// echo $this->loadOthersImages();die;

		$data['otherImgs'] = $this->loadOthersImages();
		
		$this->load->view('_parts/header', $head);
		$this->load->view('ecommerce/publish', $data);
		$this->load->view('_parts/footer');
		$this->saveHistory('Go to publish product');
	}

	private function uploadImage() {
		if (empty($_FILES['userfile']['name']) && empty($_POST['old_image'])) {
			if (isset($_POST['folder']) && $_POST['folder'] != null) {
				$dir = 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['folder'] . DIRECTORY_SEPARATOR;
				if (is_dir($dir)) {
					if ($dh = opendir($dir)) {
						$a = 0;
						$filenames = array();
						while (($file = readdir($dh)) !== false) {
							if (is_file($dir . $file)) {
								$extention = strtolower(substr($file, strrpos($file, '.') + 1));
								if ($extention != 'pdf') {
									$filenames[] = $file; // base_url('attachments/shop_images/' . $_POST['folder'] . '/' . $file);
								}
							}
							$a++;
						}
						closedir($dh);
						sort($filenames);
						$org_image = $_SERVER['DOCUMENT_ROOT'] . '/attachments/shop_images/' . $_POST['folder'] . '/' . $filenames[0];
						$destination = $_SERVER['DOCUMENT_ROOT'] . '/attachments/shop_images';

						$img_name = basename($org_image);

						if (rename($org_image, $destination . '/' . $img_name)) {
							return $img['file_name'] = $img_name;
						}
					}
				}
			}

		} else {

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

	public function do_upload_others_pdf() {
		if ($this->input->is_ajax_request()) {
			$upath = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['folder'] . DIRECTORY_SEPARATOR;
			if (!file_exists($upath)) {
				mkdir($upath, 0777);
			}

			$output_dir = $upath;
			ini_set("display_errors", 1);
			if (isset($_FILES["pdffile"])) {
				$RandomNum = time();
				$ImageName = str_replace(' ', '-', strtolower($_FILES['pdffile']['name']));
				$ImageName = str_replace('(', '_', strtolower($ImageName));
				$ImageName = str_replace(')', '_', strtolower($ImageName));
				$ImageType = $_FILES['pdffile']['type']; //"image/png", image/jpeg etc.

				$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
				$ImageExt = str_replace('.', '', $ImageExt);

				if ($ImageExt != "pdf") {
					$message = "Invalid file format only <b>\"PDF\"</b> allowed.";
				} else {
					$ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
					$NewImageName = $ImageName . '-' . $RandomNum . '.' . $ImageExt;
					move_uploaded_file($_FILES["pdffile"]["tmp_name"], $output_dir . $NewImageName);
					$location = __DIR__;
					$name = $output_dir . $NewImageName;
					$num = $this->count_pages($name);
					$RandomNum = time();
					$nameto = $output_dir . $RandomNum . ".jpg";
					$location . " " . $convert = $location . " " . $name . " " . $nameto;
					exec("convert " . $convert);

					for ($i = 0; $i < $num; $i++) {
						$nameto = $RandomNum . '-' . $i . ".jpg";
						$file = base_url() . 'attachments/shop_images/' . $_POST['folder'] . '/' . $nameto; // file that you wanna compress
						$new_name_image = $RandomNum . '-' . $i; // name of new file compressed
						$quality = 60; // Value that I chose
						$pngQuality = 9; // Exclusive for PNG files
						$destination = base_url() . 'attachments/shop_images/' . $_POST['folder'] . '/'; // This destination must be exist on your project

						$compress = new Compress();
						$compress->file_url = $file;
						$compress->new_name_image = $new_name_image;
						$compress->quality = $quality;
						$compress->destination = $destination;
						$compress->compress_image();
					}
					//$pdffiledelete = $_SERVER['DOCUMENT_ROOT'].'/attachments/shop_images/'.$_POST['folder'].'/'.$NewImageName;
					//unlink($pdffiledelete);
				}
			}
		}
	}

	public function count_pages($pdfname) {
		$pdftext = file_get_contents($pdfname);
		$num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
		return $num;
	}

	public function loadOthersImages() {
		$output = '';
		
		if (isset($_POST['folder']) && $_POST['folder'] != null) {	
			// echo $_POST['folder'];die;	
			$dir = 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['folder'] . DIRECTORY_SEPARATOR;
			if (is_dir($dir)) {								
				if ($dh = opendir($dir)) {
					$i = 0;

					/*chdir($dir);
						array_multisort(array_map('filemtime', ($files = glob("*.*"))), SORT_ASC, $files);
						foreach($files as $filename)
						{
							echo "<li>".$filename."</li>";
						}
					*/
					//chdir($dir);

					while (($file = readdir($dh)) !== false) {
						if (is_file($dir . $file)) {
							$extention = strtolower(substr($file, strrpos($file, '.') + 1));
							if ($extention != 'pdf') {
								$output .= '
                                <div class="other-img" id="image-container-' . $i . '">
                                    <img src="' . base_url('attachments/shop_images/' . $_POST['folder'] . '/' . $file) . '" style="width:100px; height: 100px;">
                                    <a href="javascript:void(0);" onclick="removeSecondaryProductImage(\'' . $file . '\', \'' . $_POST['folder'] . '\', ' . $i . ')">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                </div>
                               ';
							}

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

}

<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Shareproduct extends ADMIN_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'Shareproduct_model'
        ));
    }

    public function shareproduct()
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addproduct', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editproduct', $adminid)) {
            redirect('admin');
        }
        $data = array();
        $head = array();
        $head['title'] = 'List-Shareproduct';
        $head['description'] = '!';
        $head['keywords'] = '';

        $this->load->view('_parts/header', $head);
        $this->load->view('shareproduct/list-shareproduct', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Add Shareproduct');
    }

    public function shareproduct_list()
    {
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addproduct', $adminid)) {
            redirect('admin');
        }
        if (!in_array('editproduct', $adminid)) {
            redirect('admin');
        }
        $list = $this->Shareproduct_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $datarow) {

            // $actionBtn = '<button class="btn btn-xs allocation_button" data-ar="'.$chek_a_r.'" data-id="' . $datarow->id . '" data-status="' . $id . '" data-table="user_app" data-wherefield="id" data-updatefield="alocation_agent_id" data-module="user_app">'.$str.'</button>';
            $no++;
            $row = array();
            $row[] = $datarow->id;
            $row[] = $datarow->title;
            $row[] = $datarow->price;
            $row[] = $datarow->old_price;
            // $row[]=$datarow->abbr; 
            // $row[]=$actionBtn;               
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Shareproduct_model->count_all(),
            "recordsFiltered" => $this->Shareproduct_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function loadOthersImages($folder='') {
        $images=array();      
		if (isset($folder) && $folder != null) {
			$dir = 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR;
			if (is_dir($dir)) {
				if ($dh = opendir($dir)) {
					$i = 0;
					while (($file = readdir($dh)) !== false) {
						if (is_file($dir . $file)) {
							$extention = strtolower(substr($file, strrpos($file, '.') + 1));
							if ($extention != 'pdf') {
                                $img=base_url('attachments/shop_images/' . $folder . '/' . $file);
                                array_push($images,$img);
							}

						}
						$i++;
					}
					closedir($dh);
				}
			}
		}	
	    return $images;		
	}

    public function add_shareproduct()
    {        
        if(!empty($_POST['id'])){
            $res=$this->Shareproduct_model->getProducts($_POST['id']);
            if(!empty($res)){
                foreach($res as $row){

                    $images=array();
                    $images=$this->loadOthersImages($row['folder']);                    
                    if (file_exists('attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $row['folder'] . DIRECTORY_SEPARATOR.$row['image']) || !empty($images)) {
                       
                        if (!file_exists("attachments/shareproduct/".$row['id'])) {
                            mkdir("attachments/shareproduct/".$row['id'], 0777);                        
                        }
                        // echo $row['image'];die;
                        // echo 'attachments/shop_images/'.$row['image'];die;
                        if (file_exists('attachments/shop_images/'.$row['image'])){                            
                            array_push($images,base_url('attachments/shop_images/'.$row['image']));    
                        }
                        if(!empty($images)){
                            $i=0;
                            foreach($images as $row_img){

                                $img1_path = $row_img;

                                list($width) = getimagesize($img1_path);

                                $img = imagecreate($width, 100);
                                $bgcolor = imagecolorallocate($img, 255, 255, 255);
                                $fontcolor = imagecolorallocate($img, 0, 0, 0);     

                                $font = 'assets/arial/arial.ttf';
                                imagettftext($img, 24, 0, 0, 40, $fontcolor, $font, "Name :".$row['title']);
                                imagettftext($img, 24, 0, 0, 80, $fontcolor, $font, "Price :".$row['price']);

                                $SAVE_AS_FILE = TRUE;
                                if ($SAVE_AS_FILE) {
                                    $save_path = "attachments/shareproduct/".$row['id']."/Sample_Output.png";
                                    imagepng($img, $save_path);
                                }
                        
                                $img2_path = "attachments/shareproduct/".$row['id']."/Sample_Output.png";
                        
                                list($img1_width, $img1_height) = getimagesize($img1_path);
                                list($img2_width, $img2_height) = getimagesize($img2_path);
                        
                                $merged_width = $img1_width > $img2_width ? $img1_width : $img2_width; //get highest width as result image width
                                $merged_height = $img1_height + $img2_height;
                        
                                $merged_image = imagecreatetruecolor($merged_width, $merged_height);
                        
                                imagealphablending($merged_image, false);
                                imagesavealpha($merged_image, true);
                        
                                $img1 = imagecreatefromjpeg($img1_path);
                                $img2 = imagecreatefrompng($img2_path);
                                // $color = imagecolorallocate($im, 0, 0, 0); // black
                                // $font = 'arial.ttf'; // path to font
                                // imagettftext($img1, 14, 0, 395, 85, $color, $font, $txt );
                        
                                imagecopy($merged_image, $img1, 0, 0, 0, 0, $img1_width, $img1_height);
                                //place at right side of $img1
                                imagecopy($merged_image, $img2, 0, $img1_height, 0, 0, $img2_width, $img2_height);
                        
                                //save file or output to broswer
                                $SAVE_AS_FILE = TRUE;
                                if ($SAVE_AS_FILE) {
                                    $save_path = "attachments/shareproduct/".$row['id']."/".$row['title'].'_'.$i.'.jpg';
                                    imagepng($merged_image, $save_path);
                                }
                                //release memory
                                imagedestroy($merged_image);   
                                $i=$i+1;                                
                            }

                        } 
                    }               
                }
            }                
        }
        redirect('admin/shareproduct');
    }
}

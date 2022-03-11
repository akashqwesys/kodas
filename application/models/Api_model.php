<?php
date_default_timezone_set('Asia/Kolkata');
class Api_model extends CI_Model {
	public function GetMemberFCMTokenFun() {
		$this->db->select('*');
		$this->db->from('user_app');
		$this->db->where('user_app.id', $_POST['UserId']);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			if (!empty($row['fcmtoken']) && $row['fcmtoken'] != '') {
				$return['Data'] = $row['fcmtoken'];
				$return['Message'] = 'Data Get Successfully!';
				$return['IsSuccess'] = true;
			} else {
				$return['Data'] = 0;
				$return['Message'] = 'Token not Found';
				$return['IsSuccess'] = false;
			}
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'User not Found';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	public function GetLoginDetails() {
		$MobileNo = $_REQUEST['MobileNo'];
		$FCMToken = $_REQUEST['FCMToken'];
		$data = array();
		$this->db->select('*');
		$this->db->from('user_app');
		$this->db->where('user_app.mobilenumber', $MobileNo);
		$this->db->where('user_app.isverified', 'true');
		$this->db->limit(1);
		$query = $this->db->get();
		$i = 0;
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$ImageUrl = !empty($row['profileimg']) ? base_url('attachments/userprofile_images/' . $row['profileimg']) : '';
			$data[$i]['Id'] = $row['id'];
			$data[$i]['Name'] = $row['name'];
			$data[$i]['Mobile'] = $row['mobilenumber'];
			$data[$i]['Email'] = $row['emailid'];
			$data[$i]['Address'] = $row['address'];
			$data[$i]['Image'] = $ImageUrl;
			$data[$i]['Compnay'] = $row['businessname'];
			$data[$i]['TranportName'] = $row['tranportname'];
			$data[$i]['PreviewCount'] = $row['pviewcount'];
			$data[$i]['PremiumUser'] = $row['premiumuser'];
			if ($_REQUEST['MobileNo'] != '9375186540') {
				if ($row['fcmtoken'] == $_REQUEST['FCMToken']) {
					$data[$i]['FCMToken'] = $row['fcmtoken'];
					$data[$i]['IsVerified'] = $row['isverified'];
				} else {
					$dataup['IsVerified'] = 'true';
					$this->db->where('mobilenumber', $row['mobilenumber']);
					$this->db->update('user_app', $dataup);
					$data[$i]['FCMToken'] = $_REQUEST['FCMToken'];
					$data[$i]['IsVerified'] = "false";
				}
			} else {
				$data[$i]['FCMToken'] = $row['fcmtoken'];
				$data[$i]['IsVerified'] = "true";
			}

			if (isset($_REQUEST['DeviceId']) && $row['deviceid'] != $_REQUEST['DeviceId']) {
				$this->db->where('mobilenumber', $row['mobilenumber']);
				$this->db->set('deviceid', $_REQUEST['DeviceId']);
				$this->db->set('devicecount', 'devicecount+1', FALSE);
				$this->db->update('user_app');
			}
			$i++;
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Message'] = 'Data Get Not Successfully!';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	public function AddSignupfun() {
		$MobileNo = $_REQUEST['MobileNo'];
		$data = array();
		$this->db->select('*');
		$this->db->from('user_app');
		$this->db->where('user_app.mobilenumber', $MobileNo);
		$this->db->limit(1);
		$query = $this->db->get();
		$i = 0;
		$string = '';
		if ($query->num_rows() == 0) {
			$data['name'] = !empty($_REQUEST['Name']) ? $_REQUEST['Name'] : '';
			$data['businessname'] = !empty($_REQUEST['BusinessName']) ? $_REQUEST['BusinessName'] : '';
			$data['address'] = !empty($_REQUEST['Address']) ? $_REQUEST['Address'] : '';
			$data['mobilenumber'] = !empty($_REQUEST['MobileNo']) ? $_REQUEST['MobileNo'] : '';
			$data['emailid'] = !empty($_REQUEST['EmailId']) ? $_REQUEST['EmailId'] : '';
			$data['gstin'] = !empty($_REQUEST['GSTNo']) ? $_REQUEST['GSTNo'] : '';
			$data['isverified'] = 0;
			$this->db->insert('user_app', $data);
			$fcmtoken = $this->getadminfcmtoken();
			notifications('New Customer Sign Up ' . $_REQUEST['Name'], ' ', $fcmtoken);
			$string = 1;
		}
		if (!empty($string) && $string != '' && $string == 1) {
			$return['Data'] = 1;
			$return['Message'] = 'Data Insert Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'You have already registered';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	public function GetSendOtpFun() {
		$MobileNo = !empty($_REQUEST['MobileNo']) ? $_REQUEST['MobileNo'] : '';
		$OtpCode = !empty($_REQUEST['Code']) ? $_REQUEST['Code'] : '';
		$signature = !empty($_REQUEST['signature']) ? $_REQUEST['signature'] : '';
		if ($MobileNo != '' && $OtpCode != '') {
			

			// sendsms($_POST['username'], $six_digit_random_number);
			// $res=sendsms($MobileNo,$OtpCode,$signature);
			// $msg = "Welcome%20to%20Ramrasiya%20Mobile%20Application.%20Your%20verification%20code%20is%20$OtpCode.";
			// $msg = "Welcome to 20Ramrasiya%20Mobile%20Application.%20Your%20verification%20code%20is%20$OtpCode%0A$signature%20.";
			// $msg = urlencode($msg);
			// $message = urlencode($message);

			$msgdisplay=sendsms($MobileNo,$OtpCode,$signature);
			
			// $url = "http://sms.premware.in:6005/api/v2/SendSMS?ApiKey=FbKnpOIgZfU541fff6mxudtf5tiCMEz/L5dEUKNJ6YI=&ClientId=26e94c2d-96f0-417e-8ddf-fa563e95e5c7&SenderId=RASIYA&Message=$msg&MobileNumbers=$MobileNo&Is_Flash=False";
			// $ch = curl_init();
			// $timeout = 20;
			// curl_setopt($ch, CURLOPT_URL, $url);
			// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			// curl_setopt($ch, CURLOPT_HEADER, false);
			// curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			// $data = curl_exec($ch);
			// // print_r($data);die;
			// curl_close($ch);
			// $msgdisplay = json_decode($data);

			// print_r($msgdisplay);die;
			if (!empty($msgdisplay)) {
				//echo "cURL Error #:" . $err;
				$return['Data'] = "1";
				$return['Message'] = 'Data Get Successfully!';
				$return['IsSuccess'] = true;
			} else {
				//echo $response;
				$return['Data'] = "0";
				$return['Message'] = 'Sms Not received!';
				$return['IsSuccess'] = true;
			}

		} else {
			$return['Data'] = "0";
			$return['Message'] = 'Data Get Not Successfully!';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	function GetOtpVerificationFun() {
		$data = array();
		$UserId = $_REQUEST['UserId'];
		$FCMToken = $_REQUEST['FCMToken'];
		if ($UserId != '') {
			$dataup['fcmtoken'] = $FCMToken;
			$dataup['isverified'] = 'true';
			$this->db->where('id', $UserId);
			$this->db->update('user_app', $dataup);
			$return['Data'] = "1";
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = "0";
			$return['Message'] = 'Data Get Not Successfully!';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	function HomeSliderFun() {
		$where = "thekey = 'prelaunchimg'";
		$this->db->where($where);
		$query = $this->db->get('value_store');
		$resultprel = $query->row_array();
		$prelaunchimg = ($resultprel['value'] != '') ? base_url('attachments/site_logo/' . $resultprel['value']) : '';
		$data = array();
		if (!empty($_REQUEST['UserId'])) {
			$this->db->where('user_app.id', $_REQUEST['UserId']);
			$query = $this->db->select('*')->get('user_app');
			if ($query->num_rows() > 0) {
				$result = $query->row_array();
				$data[0]['premiumuser'] = $result['premiumuser'];
				$data[0]['prelaunchimg'] = $prelaunchimg;
			} else {
				$data[0]['premiumuser'] = '';
			}
			$this->db->order_by('app_slider.position', 'ASC');
			$this->db->where('app_slider.slider_type', 'Application');
			$query = $this->db->select('*')->get('app_slider');
			$result = $query->result_array();
			$i = 0;
			$slider = array();
			foreach ($result as $key => $value) {
				$slider[$i]['Id'] = $value['productid'];
				$slider[$i]['Image'] = !empty($value['imagename']) ? base_url('attachments/slider_img/' . $value['imagename']) : '';
				$slider[$i]['VideoUrl'] = $value['youtubeurl'];
				$i++;
			}
			$data[0]['Slider'] = $slider;
		} else {
			$this->db->order_by('app_slider.position', 'ASC');
			$this->db->where('app_slider.slider_type', 'Application');
			$query = $this->db->select('*')->get('app_slider');
			$result = $query->result_array();
			$i = 0;
			$slider = array();
			foreach ($result as $key => $value) {
				$slider[$i]['Id'] = $value['productid'];
				$slider[$i]['Image'] = !empty($value['imagename']) ? base_url('attachments/slider_img/' . $value['imagename']) : '';
				$slider[$i]['VideoUrl'] = $value['youtubeurl'];
				$i++;
			}
			$data[0]['premiumuser'] = '';
			$data[0]['prelaunchimg'] = '';
			$data[0]['Slider'] = $slider;
		}
		if ($data != '') {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = "0";
			$return['Message'] = 'Data Get Not Successfully!';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	function Catlistfun() {
		$data = array();
		// if (!empty($_REQUEST['UserId'])) {
		$this->db->where('shop_categories.visibility', 1);
		$this->db->join('shop_categories_translations', 'shop_categories_translations.for_id = shop_categories.id', 'left');
		$this->db->order_by('shop_categories.position', 'ASC');
		$query = $this->db->select('shop_categories.id,shop_categories.position,shop_categories.catimg,shop_categories_translations.name,')->get('shop_categories');
		$result = $query->result_array();
		$i = 0;
		$data = array();
		foreach ($result as $key => $value) {
			$data[$i]['Id'] = $value['id'];
			$data[$i]['Name'] = $value['name'];
			$data[$i]['Image'] = !empty($value['catimg']) ? base_url('attachments/cat_images/' . $value['catimg']) : '';
			$i++;
		}
		// }
		if ($data != '') {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = "0";
			$return['Message'] = 'Data Get Not Successfully!';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	public function getProducts($lang,$product_type='') {
		// print_r($_REQUEST);
		$sort = '';
		$user=array();
		if(isset($_REQUEST['UserId'])){
			$user=$this->db->get_where('user_app', array('id' => $_REQUEST['UserId']))->row();			
		}	

		if(!empty($product_type)){
			$this->db->like('productoffertype',$product_type);
		}

		if (isset($_REQUEST['sort']) && !empty($_REQUEST['sort'])) {
			$sort = $_REQUEST['sort'];

			// $gettype = $this->getcustomeridbypricetype($_REQUEST['UserId']);
			// if (!empty($gettype)) {
				if($sort=='price_low_to_high'){
					$this->db->order_by('products.price1', 'ASC');		
				}
				if($sort=='price_high_to_low'){
					$this->db->order_by('products.price1', 'DESC');
				}
				if($sort=='latest'){
					$this->db->order_by('products.id', 'DESC');
				}
				if($sort=='oldest'){
					$this->db->order_by('products.id', 'ASC');
				}
				if($sort=='best_offer'){
					$this->db->order_by('products.id', 'ASC');
				}					
				// $this->db->order_by('products.' . strtolower($gettype), $_REQUEST['sort']);
			// } else {
				// if($sort=='price_low_to_high'){
				// 	$this->db->order_by('products.price1', 'ASC');		
				// }
				// if($sort=='price_high_to_low'){
				// 	$this->db->order_by('products.price1', 'DESC');
				// }
				// if($sort=='latest'){
				// 	$this->db->order_by('products.id', 'DESC');
				// }
				// if($sort=='oldest'){
				// 	$this->db->order_by('products.id', 'ASC');
				// }
				// if($sort=='best_offer'){
				// 	$this->db->order_by('products.id', 'ASC');
				// }	
			// }

		} else {
			$this->db->order_by('products.id', 'DESC');
		}

		// if (!empty($gettype)) {
		// 	$myshortprice = 'products.' . strtolower($gettype) . ' as ShortPrice';
		// } else {
		// 	$myshortprice = 'products_translations.price as ShortPrice';
		// }

		if (isset($_REQUEST['Page'])) {
			$offset = 10 * ($_REQUEST['Page'] - 1);
			$this->db->limit(10, $offset);
		} else {
			$this->db->limit(10, 0);
		}

		if (isset($_REQUEST['Catid']) && $_REQUEST['Catid'] != 0 && $_REQUEST['Catid'] != '') {
			if (isset($_REQUEST['Attribute']) && $_REQUEST['Attribute'] != '') {
				$attributearray = explode(",", $_REQUEST['Attribute']);
				$this->db->distinct('products.id');
				$this->db->join('product_attribute1', 'product_attribute1.refProduct_id = productcat.productid', 'left');
				$this->db->where_in('product_attribute1.refattributes_id', $attributearray);
			}
			$this->db->join('products', 'products.id = productcat.productid', 'left');
			$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
			$this->db->where('productcat.catid', $_REQUEST['Catid']);
			$this->db->where('products.visibility', 1);
			$query = $this->db->select('products_translations.description,products.designNo,price1 as box_guest_price,price2 as box_retailer_price,price3 as box_wholesaller_price,theli_price1 as theli_guest_price,theli_price2 as theli_retailer_price,theli_price3 as theli_wholesaller_price,products.id as Id, products.image as product_image, products.folder as imgfolder, products.videoid, products.product_pcs as Pcs, products_translations.title,products_translations.theli_title, products_translations.price, products_translations.old_price, ')->get('productcat');
		} else {
			$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
			$query = $this->db->select('products_translations.description,products.designNo,price1 as box_guest_price,price2 as box_retailer_price,price3 as box_wholesaller_price,theli_price1 as theli_guest_price,theli_price2 as theli_retailer_price,theli_price3 as theli_wholesaller_price,products.id as Id, products.image as product_image, products.folder as imgfolder, products.videoid, products.product_pcs as Pcs, products_translations.title,products_translations.theli_title, products_translations.price, products_translations.old_price, ')->get('products');
		}
		$result = $query->result_array();
		$data = array();
		$i = 0;

		foreach ($result as $key => $value) {

			$image_link = array();
			// $i = 0;
			$singalimg = $value['product_image'];
			if (isset($singalimg) && $singalimg != '') {
				$nid = 1;
				$image_link[0]['Id'] = strval($value['Id'] . $nid);
				$image_link[0]['Image'] = !empty($singalimg) ? base_url('attachments/shop_images/' . $singalimg) : '';
				$a = 1;
			} else {
				$a = 0;
			}
			$multiimg = $value['imgfolder'];
			$multiimgarray = $this->productmultiimg($multiimg);
			foreach ($multiimgarray as $key => $value1) {
				$image_link[$a]['Id'] = strval($value['Id'] . ($a + 1));
				$image_link[$a]['Image'] = $value1;
				$a++;
			}
			// $pricebyuser = '';
			// if (!empty($_REQUEST['UserId']) && isset($_REQUEST['UserId'])) {
			// 	$pricebyuser = $this->getcustomerpricebytype($_REQUEST['UserId'], $value['Id']);
			// }
			// if (!empty($pricebyuser)) {
			// 	// $Mrp = $this->IND_money_format($pricebyuser);
			// 	$PcsMrp = $this->IND_money_format($pricebyuser * $value['Pcs']);
			// } else {
			// 	// $Mrp = $this->IND_money_format($value['price']);
			// 	$PcsMrp = $this->IND_money_format($value['price'] * $value['Pcs']);
			// }

			$data[$i]['Id'] = $value['Id'];
			$data[$i]['ItemName'] = $value['title'];
			$data[$i]['Theli_ItemName'] = $value['theli_title'];
			$data[$i]['description'] = $value['description'];
			
			// $data[$i]['Mrp'] = $Mrp;
			// $data[$i]['PcsMrp'] = $PcsMrp;
			$data[$i]['box_guest_price'] = $this->IND_money_format($value['box_guest_price']);
			$data[$i]['box_retailer_price'] = $this->IND_money_format($value['box_retailer_price']);
			$data[$i]['box_wholesaller_price'] = $this->IND_money_format($value['box_wholesaller_price']);

			$data[$i]['theli_guest_price'] = $this->IND_money_format($value['theli_guest_price']);
			$data[$i]['theli_retailer_price'] = $this->IND_money_format($value['theli_retailer_price']);
			$data[$i]['theli_wholesaller_price'] = $this->IND_money_format($value['theli_wholesaller_price']);
			// $data[$i]['FilterMrp'] = $value['ShortPrice'];
			$data[$i]['Pcs'] = $value['Pcs'];
			$data[$i]['VideoUrl'] = !empty($value['videoid']) ? $value['videoid'] : '';
			$data[$i]['Image'] = $image_link;
			if(!empty($user)){
				if($user->guest==1){
					$data[$i]['mainprice']=	$this->IND_money_format($value['box_guest_price']);
					$data[$i]['mainprice2']=$this->IND_money_format($value['theli_guest_price']);
				}
				if($user->retailer==1){
					$data[$i]['mainprice']=	$this->IND_money_format($value['box_retailer_price']);
					$data[$i]['mainprice2']=$this->IND_money_format($value['theli_retailer_price']);
				}
				if($user->wholesaller==1){
					$data[$i]['mainprice']=	$this->IND_money_format($value['box_wholesaller_price']);
					$data[$i]['mainprice2']=$this->IND_money_format($value['theli_wholesaller_price']);
				}
			}	

			$i++;
		}
		// $price = array();
		// foreach ($data as $key => $row) {
		// 	$price[$key] = $row['FilterMrp'];
		// }
		if ($sort == 'asc') {
			array_multisort($price, SORT_ASC, $data);
		} elseif ($sort == 'desc') {
			array_multisort($price, SORT_DESC, $data);
		}

		if (!empty($data) && $data != '') {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['data'] = $data;
			$return['Message'] = 'Data Get Not Successfully.';
			$return['IsSuccess'] = false;
		}
		return $return;
		//return $query->result_array();
	}

	private function getcustomtypeshowproduct($userid) {
		$price = '';
		if ($userid != 0 && $userid != '' && !empty($userid)) {
			$row = $this->db->get_where('user_app', array('id' => $userid))->row();
			if ($row->premiumuser == 1) {
				$price = 'registorcustomer';
			} elseif ($row->guestuser == 1) {
				$price = 'guestuser';
			} else {
				$price = 'registorcustomer';
			}
		}
		return $price;
	}

	public function AttributeListFun() {
		$this->db->join('shop_attribute_translations', 'shop_attribute_translations.for_id = shop_attribute.id', 'left');
		$this->db->where('shop_attribute.sub_for', '0');
		$this->db->order_by("shop_attribute.position", "ASC");
		$query = $this->db->select('shop_attribute.id as Id, shop_attribute_translations.name, shop_attribute.position')->get('shop_attribute');
		//echo $this->db->last_query();
		$result = $query->result_array();
		$data = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$subatt = $this->SubAttributeListFun($value['Id']);
			$data[$i]['Id'] = $value['Id'];
			$data[$i]['Name'] = $value['name'];
			$data[$i]['SubAtt'] = $subatt;
			$i++;
		}
		if (!empty($data) && $data != '') {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['data'] = $data;
			$return['Message'] = 'Data Get Not Successfully.';
			$return['IsSuccess'] = false;
		}
		return $return;
		//return $query->result_array();
	}

	public function SubAttributeListFun($id) {
		$this->db->join('shop_attribute_translations', 'shop_attribute_translations.for_id = shop_attribute.id', 'left');
		$this->db->where('shop_attribute.sub_for', $id);
		$this->db->order_by("shop_attribute.position", "ASC");
		$query = $this->db->select('shop_attribute.id as Id, shop_attribute_translations.name, shop_attribute.position')->get('shop_attribute');
		//echo $this->db->last_query();
		$result = $query->result_array();
		$data = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$subatt = $this->SubAttributeListFun($value['Id']);
			$data[$i]['Id'] = $value['Id'];
			$data[$i]['Name'] = $value['name'];
			$i++;
		}
		return $data;
	}

	public function GlobalgetProducts() {
		$data = array();
		if (!empty($_GET['Kyeword'])) {
			$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
			$this->db->like('products.productviewtype', 'registorcustomer');
			$keyword = $_GET['Kyeword'];
			$likewhere = "(products_translations.title LIKE '%$keyword%'  OR products_translations.description LIKE '%$keyword%'  OR products_translations.basic_description LIKE '%$keyword%')";
			$this->db->where($likewhere);
			$this->db->order_by("products.id", "desc");
			if (isset($_REQUEST['Page'])) {
				$offset = 10 * ($_REQUEST['Page'] - 1);
				$this->db->limit(10, $offset);
			}
			$query = $this->db->select('products.id as Id, products.image as product_image, products.folder as imgfolder , products.product_pcs as Pcs, products_translations.title, products_translations.description, products_translations.basic_description, products_translations.price, products_translations.old_price,products.productviewtype')->get('products');
			$result = $query->result_array();
			$i = 0;
			foreach ($result as $key => $value) {
				$image_link = array();
				$singalimg = $value['product_image'];
				if (isset($singalimg) && $singalimg != '') {
					$nid = 1;
					$image_link[0]['Id'] = strval($value['Id'] . $nid);
					$image_link[0]['Image'] = !empty($singalimg) ? base_url('attachments/shop_images/' . $singalimg) : '';
					$a = 1;
				} else {
					$a = 0;
				}
				$multiimg = $value['imgfolder'];
				$multiimgarray = $this->productmultiimg($multiimg);
				foreach ($multiimgarray as $key => $value1) {
					$image_link[$a]['Id'] = strval($value['Id'] . ($a + 1));
					$image_link[$a]['Image'] = $value1;
					$a++;
				}
				$pricebyuser = '';
				if (!empty($_REQUEST['UserId']) && isset($_REQUEST['UserId'])) {
					$pricebyuser = $this->getcustomerpricebytype($_REQUEST['UserId'], $value['Id']);
				}
				if (!empty($pricebyuser)) {
					$Mrp = $this->IND_money_format($pricebyuser);
					$PcsMrp = $this->IND_money_format($pricebyuser * $value['Pcs']);
				} else {
					$Mrp = $this->IND_money_format($value['price']);
					$PcsMrp = $this->IND_money_format($value['price'] * $value['Pcs']);
				}
				$data[$i]['Id'] = $value['Id'];
				$data[$i]['ItemName'] = $value['title'];
				$data[$i]['Mrp'] = $Mrp;
				$data[$i]['PcsMrp'] = $PcsMrp;
				$data[$i]['Pcs'] = $value['Pcs'];
				$data[$i]['Image'] = $image_link;
				$i++;
			}
		}
		if (!empty($data) && $data != '') {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['data'] = $data;
			$return['Message'] = 'Data Get Not Successfully.';
			$return['IsSuccess'] = false;
		}
		return $return;
		//return $query->result_array();
	}

	public function recentviewProductsfun() {
		$this->db->join('products', 'products.id = userrecentview.productid', 'left');
		$this->db->join('products_translations', 'products_translations.for_id = userrecentview.productid', 'left');
		$this->db->where('userrecentview.userid', $_REQUEST['UserId']);
		$this->db->where('products.id IS NOT NULL');
		$this->db->order_by("userrecentview.id", "desc");
		$query = $this->db->select('products.id as Id, products.image as product_image, products.folder as imgfolder, products.product_pcs as Pcs, products_translations.title, products_translations.price, products_translations.old_price')->get('userrecentview');
		$result = $query->result_array();
		/*echo $this->db->last_query();exit;*/
		$data = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$Mrp = $this->IND_money_format($value['price']);
			$PcsMrp = $this->IND_money_format($value['price'] * $value['Pcs']);
			$productsingalimg = '';
			$productsingalimg = $this->productmultiimg($value['imgfolder'], 1);
			$data[$i]['Id'] = $value['Id'];
			$data[$i]['ItemName'] = $value['title'];
			$data[$i]['Mrp'] = $Mrp;
			$data[$i]['PcsMrp'] = $PcsMrp;
			$data[$i]['Pcs'] = $value['Pcs'];
			$data[$i]['Image'] = !empty($value['product_image']) ? base_url('attachments/shop_images/' . $value['product_image']) : $productsingalimg;
			$i++;
		}
		if (!empty($data) && $data != '') {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['data'] = $data;
			$return['Message'] = 'Data Get Not Successfully.';
			$return['IsSuccess'] = false;
		}
		return $return;
		//return $query->result_array();
	}

	public function getProductsbyid($id) {
		if (isset($_REQUEST['UserId']) && $_REQUEST['UserId'] != '0' && $_REQUEST['UserId'] != null && $_REQUEST['UserId'] != '') {
			$this->db->insert('userviewproduct', array(
				'productid' => $_REQUEST['ItemId'],
				'userid' => $_REQUEST['UserId'],
			));

		} else {
			$this->db->where('id', $_REQUEST['ItemId']);
			$this->db->set('view_count', 'view_count+1', FALSE);
			$this->db->update('products');
		}
		$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		$this->db->join('user_app', 'user_app.id = ' . $_REQUEST['UserId'], 'left');
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->join('packagingtype', 'packagingtype.packagingtype_id = products.refPackagingtype_id', 'left');
		// $this->db->join('productcat', 'productcat.productid = products.id', 'left');	
		// $this->db->join('shop_categories_translations', 'shop_categories_translations.for_id = productcat.catid', 'left');		
		$this->db->where('products.id', $id);
		$this->db->limit(1);
		$query = $this->db->select('price1 as box_guest_price,price2 as box_retailer_price,price3 as box_wholesaller_price,theli_price1 as theli_guest_price,theli_price2 as theli_retailer_price,theli_price3 as theli_wholesaller_price,user_app.pviewcount,products.id as Id,products.videoid as VideoId, products_translations.title,products_translations.theli_title, products.image as product_image, products.folder as imgfolder, products.product_type as Type, products.product_pcs as Pcs, products.min_qty as MinQty, products.quantity as product_quantity_available, products_translations.description, products_translations.price, products_translations.old_price, products_translations.basic_description,packagingtype.title as packing_title,packagingtype.pcs as required_packing_pcs,packagingtype.packagingtype_id,products.designNo,price1 as box_guest_price,price2 as box_retailer_price,price3 as box_wholesaller_price,theli_price1 as theli_guest_price,theli_price2 as theli_retailer_price,theli_price3 as theli_wholesaller_price')->get('products');
		$result = $query->result_array();

		$data = array();
		$image_link = array();
		$i = 0;
		$singalimg = $result[0]['product_image'];
		$multiimgarray=array();
		
		if (isset($singalimg) && $singalimg != '') {
			$singalimg = $result[0]['product_image'];
			$imgnameextension = str_replace(base_url('attachments/shop_images/'), "", $singalimg);
			$without_extension = substr($imgnameextension, 0, strrpos($imgnameextension, "."));
			$this->db->where('likeproductimg.userid', $_REQUEST['UserId']);
			$this->db->where('likeproductimg.imgname', $without_extension);
			$querylikedi = $this->db->select('likestatus')->get('likeproductimg')->row();
			$likestatus = '';
			if (isset($querylikedi->likestatus)) {$likestatus = $querylikedi->likestatus;} else { $likestatus = '';}
			$nid = 1;
			$image_link[0]['Id'] = strval($_REQUEST['ItemId'] . $nid);
			$image_link[0]['Image'] = !empty($singalimg) ? base_url('attachments/shop_images/' . $singalimg) : '';
			$image_link[0]['ImageName'] = $without_extension;
			$image_link[0]['LikeStatus'] = $likestatus;
			$a = 1;

			$multiimg = $result[0]['imgfolder'];
			$multiimgarray = $this->productmultiimg($multiimg);
			$pdfurl = $this->productmultiimg($multiimg, 0, 'pdfurl');
		} else {
			$a = 0;
		}
		
		foreach ($multiimgarray as $key => $value) {
			$imgnameextension = str_replace(base_url('attachments/shop_images/' . $multiimg . '/'), "", $value);
			$without_extension = substr($imgnameextension, 0, strrpos($imgnameextension, "."));
			$this->db->where('likeproductimg.userid', $_REQUEST['UserId']);
			$this->db->where('likeproductimg.imgname', $without_extension);
			$querylikedi = $this->db->select('likestatus')->get('likeproductimg')->row();
			$likestatus = '';
			if (isset($querylikedi->likestatus)) {$likestatus = $querylikedi->likestatus;} else { $likestatus = '';}
			$image_link[$a]['Id'] = strval($_REQUEST['ItemId'] . ($a + 1));
			$image_link[$a]['Image'] = $value;
			$image_link[$a]['ImageName'] = $without_extension;
			$image_link[$a]['LikeStatus'] = $likestatus;
			$a++;
		}

		$this->db->select('likestatus')->get('likeproductimg')->row();

		$this->db->join('attributes_group', 'attributes_group.attributesgroup_id  = product_attribute1.refAttributesgroup_id', 'left');
		$this->db->join('attributes', 'attributes.attributes_id  = product_attribute1.refattributes_id', 'left');
		$this->db->where('product_attribute1.refProduct_id', $_REQUEST['ItemId']);

		$queryatt = $this->db->select('product_attribute1.*,attributes_group.title as ag_title,attributes.title as at_title')->get('product_attribute1');
		$resultatt = $queryatt->result_array();
		// print_r($resultatt);die;
		// $Attribute = array();
		// foreach ($resultatt as $key => $value) {
		// 	$Attribute[$key]['Text'] = $this->attributename($value['keyid']);
		// 	$Attribute[$key]['Value'] = $this->attributename($value['valueid']);
		// }

		foreach ($result as $key => $value) {

			$this->db->select('*');
			$this->db->from('cartdetails');
			$this->db->where('cartdetails.userid', $_REQUEST['UserId']);
			$this->db->where('cartdetails.itemid', $_REQUEST['ItemId']);
			$this->db->limit(1);
			$query = $this->db->get();


			// $this->db->join('productcat', 'productcat.productid = '.$id, 'left');	
			$this->db->join('shop_categories_translations', 'shop_categories_translations.for_id = productcat.catid', 'left');
			$this->db->where('productcat.productid', $id);			
			$query = $this->db->select('shop_categories_translations.name')->get('productcat');
			$categories = $query->result_array();	
			$cat_array=array();
			if(!empty($categories)){
				foreach($categories as $c_row){
					array_push($cat_array,$c_row['name']);
				}
			}		

			$isincart = "";
			if ($query->num_rows() > 0) {$isincart = "1";}
			// $pricebyuser = $this->getcustomerpricebytype($_REQUEST['UserId'], $_REQUEST['ItemId']);
			// if (!empty($pricebyuser)) {
			// 	$Mrp = $this->IND_money_format($pricebyuser);
			// 	$PcsMrp = $this->IND_money_format($pricebyuser * $value['Pcs']);
			// } else {
			// 	$Mrp = $this->IND_money_format($value['price']);
			// 	$PcsMrp = $this->IND_money_format($value['price'] * $value['Pcs']);
			// }


			$user = array();
			if (!empty($_REQUEST['UserId']) && isset($_REQUEST['UserId'])) {
				$user = $this->db->get_where('user_app', array('id' => $_REQUEST['UserId']))->row();				
			}

			$data[$i]['box_guest_price'] = $this->IND_money_format($value['box_guest_price']);
			$data[$i]['box_retailer_price'] = $this->IND_money_format($value['box_retailer_price']);
			$data[$i]['box_wholesaller_price'] = $this->IND_money_format($value['box_wholesaller_price']);

			$data[$i]['theli_guest_price'] = $this->IND_money_format($value['theli_guest_price']);
			$data[$i]['theli_retailer_price'] = $this->IND_money_format($value['theli_retailer_price']);
			$data[$i]['theli_wholesaller_price'] = $this->IND_money_format($value['theli_wholesaller_price']);
			// $data[$i]['FilterMrp'] = $value['ShortPrice'];
			$data[$i]['Pcs'] = $value['Pcs'];
			$data[$i]['VideoUrl'] = !empty($value['videoid']) ? $value['videoid'] : '';
			$data[$i]['Image'] = $image_link;
			if(!empty($user)){
				if($user->guest==1){
					$data[$i]['mainprice']=	$this->IND_money_format($value['box_guest_price']);
					$data[$i]['mainprice2']=$this->IND_money_format($value['theli_guest_price']);
										
					$data[$i]['PcsMrp'] = $this->IND_money_format($value['box_guest_price'] * $value['Pcs']);
					$data[$i]['PcsMrp_theli'] = $this->IND_money_format($value['theli_guest_price'] * $value['Pcs']);
				}
				if($user->retailer==1){
					$data[$i]['mainprice']=	$this->IND_money_format($value['box_retailer_price']);
					$data[$i]['mainprice2']=$this->IND_money_format($value['theli_retailer_price']);

					$data[$i]['PcsMrp'] = $this->IND_money_format($value['box_retailer_price'] * $value['Pcs']);
					$data[$i]['PcsMrp_theli'] = $this->IND_money_format($value['theli_retailer_price'] * $value['Pcs']);
				}
				if($user->wholesaller==1){
					$data[$i]['mainprice']=	$this->IND_money_format($value['box_wholesaller_price']);
					$data[$i]['mainprice2']=$this->IND_money_format($value['theli_wholesaller_price']);

					$data[$i]['PcsMrp'] = $this->IND_money_format($value['box_wholesaller_price'] * $value['Pcs']);
					$data[$i]['PcsMrp_theli'] = $this->IND_money_format($value['theli_wholesaller_price'] * $value['Pcs']);
				}
			}	

			$data[$i]['Id'] = $value['Id'];
			$data[$i]['category'] = $cat_array;
			$data[$i]['ItemName'] = $value['title'];
			$data[$i]['ItemName_theli'] = $value['theli_title'];			
			$data[$i]['Description'] = $value['description'];
			$data[$i]['Type'] = $value['Type'];
			$data[$i]['Mrp'] = $data[$i]['mainprice'];
			$data[$i]['PcsMrp'] = $data[$i]['PcsMrp'];

			$data[$i]['Mrp_theli'] = $data[$i]['mainprice2'];
			$data[$i]['PcsMrp_theli'] = $data[$i]['PcsMrp_theli'];

			$data[$i]['packagingtype_id'] = $value['packagingtype_id'];			
			$data[$i]['required_packing_pcs'] = $value['required_packing_pcs'];
			$data[$i]['packing_title'] = $value['packing_title'];			
			$data[$i]['Pcs'] = $value['Pcs'];
			$data[$i]['MinQty'] = $value['MinQty'];
			$data[$i]['IsCart'] = $isincart;
			$data[$i]['PreviewCount'] = $value['pviewcount'];
			$data[$i]['PdfUrl'] = !empty($pdfurl) ? $pdfurl[0] : '';
			$data[$i]['VideoUrl'] = !empty($value['VideoId']) ? $value['VideoId'] : '';
			$data[$i]['Images'] = $image_link;
			$data[$i]['Attribute'] = $resultatt;
			$i++;
		}
		if (!empty($data) && $data != '') {
			$this->addrecentviewuser($_REQUEST['UserId'], $id);
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['data'] = $data;
			$return['Message'] = 'Data Get Not Successfully.';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function attributename($id) {
		$query = $this->db->query('SELECT name FROM shop_attribute_translations WHERE id = ' . $id);
		$result = $query->row();
		if (isset($result->name)) {
			return $result->name;
		} else {
			return '';
		}
	}

	public function AddToCart() {		
		$string = '';
		$this->db->select('*');
		$this->db->from('cartdetails');
		$this->db->where('cartdetails.userid', $_POST['UserId']);
		$this->db->where('cartdetails.itemid', $_POST['ItemId']);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row_array();

			if (isset($_FILES['AudioFile'])) {
				$audiodelete = $_SERVER['DOCUMENT_ROOT'] . '/attachments/audiofile/' . $row['audiofile'];
				@unlink($audiodelete);
				$new_name = time() . '_' . $_FILES['AudioFile']['name'];
				$path = $_SERVER['DOCUMENT_ROOT'] . '/attachments/audiofile/' . $new_name;
				move_uploaded_file($_FILES['AudioFile']['tmp_name'], $path);
				$audiofile = $new_name;
			} else {
				$audiofile = $row['audiofile'];
			}
			$data['qty'] = $row['qty'] + $_POST['Qty'];
			$data['ProductType'] = $_POST['ProductType'];
			$data['comment'] = !empty($_POST['Comment']) ? $_POST['Comment'] : $row['comment'];
			$data['hindicomment'] = !empty($_POST['HindiComment']) ? $_POST['HindiComment'] : $row['hindicomment'];
			$data['audiofile'] = $audiofile;
			$this->db->where('userid', $_POST['UserId']);
			$this->db->where('itemid', $_POST['ItemId']);
			$this->db->update('cartdetails', $data);
			$string = 1;
		} else {
			$audiofile = '';
			if (isset($_FILES['AudioFile'])) {
				$new_name = time() . '_' . $_FILES['AudioFile']['name'];
				$path = $_SERVER['DOCUMENT_ROOT'] . '/attachments/audiofile/' . $new_name;
				move_uploaded_file($_FILES['AudioFile']['tmp_name'], $path);
				$audiofile = $new_name;
			}
			$data = array(
				'userid' => $_POST['UserId'],
				'itemid' => $_POST['ItemId'],
				'qty' => $_POST['Qty'],
				'ProductType' => $_POST['ProductType'],
				'comment' => $_POST['Comment'],
				'hindicomment' => $_POST['HindiComment'],
				'audiofile' => $audiofile,
			);
			$this->db->insert('cartdetails', $data);
			$string = 1;
		}
		if (!empty($string) && $string != '') {
			$return['Data'] = 1;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item already in cart';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function GetMyCart() {
		$query_cartlimit = $this->db->where("thekey = 'cartlimitset'")->get('value_store')->row_array();
		$query_cartgst = $this->db->where("thekey = 'addgst'")->get('value_store')->row_array();

		$this->db->join('products', 'products.id = cartdetails.itemid', 'left');
		$this->db->join('packagingtype', 'packagingtype.packagingtype_id = products.refPackagingtype_id', 'left');
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->where('cartdetails.userid', $_REQUEST['UserId']);
		$this->db->where('cartdetails.user_type', 'user');
		$query = $this->db->select('products.id as ItemId, cartdetails.id as CartId, cartdetails.qty as Qty, cartdetails.comment as Comment, cartdetails.audiofile as AudioFile, cartdetails.hindicomment as HindiComment,cartdetails.ProductType,products.image as product_image, products.folder as imgfolder, products.product_pcs as Pcs, products.min_qty as MinQty, products_translations.description, products_translations.title,products_translations.theli_title,products.price1 as box_guest_price,products.price2 as box_retailer_price,products.price3 as box_wholesaller_price,products.theli_price1 as theli_guest_price,products.theli_price2 as theli_retailer_price,products.theli_price3 as theli_wholesaller_price,packagingtype.title as packing_title,packagingtype.pcs as required_packing_pcs,packagingtype.packagingtype_id')->get('cartdetails');
		$result = $query->result_array();
		$data = array();
		$count = array();
		$item = array();
		$carttotal = 0;
		$pcstotal = 0;
		$i = 0;
		foreach ($result as $key => $value) {
			$pricebyuser = '';
			if (!empty($_REQUEST['UserId']) && isset($_REQUEST['UserId'])) {
				$pricebyuser = $this->db->get_where('user_app', array('id' => $_REQUEST['UserId']))->row();				
			}
		
			if (!empty($pricebyuser)) {
				if($value['ProductType']=='box'){
					if($pricebyuser->guest==1){
						$PcsMrp_reg = $value['box_guest_price'] * $value['Pcs'];
						$Mrp = $this->IND_money_format($value['box_guest_price']);
						$PcsMrp = $this->IND_money_format($value['box_guest_price'] * $value['Pcs']);
						$carttotal = $carttotal + ($value['box_guest_price'] * $value['Pcs']) * $value['Qty'];
						$pcstotal = $pcstotal + ($value['Pcs']) * $value['Qty'];
					}
					if($pricebyuser->retailer==1){
						$PcsMrp_reg = $value['box_retailer_price'] * $value['Pcs'];
						$Mrp = $this->IND_money_format($value['box_retailer_price']);
						$PcsMrp = $this->IND_money_format($value['box_retailer_price'] * $value['Pcs']);
						$carttotal = $carttotal + ($value['box_retailer_price'] * $value['Pcs']) * $value['Qty'];
						$pcstotal = $pcstotal + ($value['Pcs']) * $value['Qty'];
					}
					if($pricebyuser->wholesaller==1){
						$PcsMrp_reg = $value['box_wholesaller_price'] * $value['Pcs'];
						$Mrp = $this->IND_money_format($value['box_wholesaller_price']);
						$PcsMrp = $this->IND_money_format($value['box_wholesaller_price'] * $value['Pcs']);
						$carttotal = $carttotal + ($value['box_wholesaller_price'] * $value['Pcs']) * $value['Qty'];
						$pcstotal = $pcstotal + ($value['Pcs']) * $value['Qty'];
					}	
				}
				if($value['ProductType']=='theli'){
					if($pricebyuser->guest==1){
						$PcsMrp_reg = $value['theli_guest_price'] * $value['Pcs'];
						$Mrp = $this->IND_money_format($value['theli_guest_price']);
						$PcsMrp = $this->IND_money_format($value['theli_guest_price'] * $value['Pcs']);
						$carttotal = $carttotal + ($value['theli_guest_price'] * $value['Pcs']) * $value['Qty'];
						$pcstotal = $pcstotal + ($value['Pcs']) * $value['Qty'];
					}
					if($pricebyuser->retailer==1){
						$PcsMrp_reg = $value['theli_retailer_price'] * $value['Pcs'];
						$Mrp = $this->IND_money_format($value['theli_retailer_price']);
						$PcsMrp = $this->IND_money_format($value['theli_retailer_price'] * $value['Pcs']);
						$carttotal = $carttotal + ($value['theli_retailer_price'] * $value['Pcs']) * $value['Qty'];
						$pcstotal = $pcstotal + ($value['Pcs']) * $value['Qty'];
					}
					if($pricebyuser->wholesaller==1){
						$PcsMrp_reg = $value['theli_wholesaller_price'] * $value['Pcs'];
						$Mrp = $this->IND_money_format($value['theli_wholesaller_price']);
						$PcsMrp = $this->IND_money_format($value['theli_wholesaller_price'] * $value['Pcs']);
						$carttotal = $carttotal + ($value['theli_wholesaller_price'] * $value['Pcs']) * $value['Qty'];
						$pcstotal = $pcstotal + ($value['Pcs']) * $value['Qty'];
					}	
				}
				// box_retailer_price		
				// theli_wholesaller_price					
			}
			// echo $Mrp;die;
			// $Mrp = $this->IND_money_format($value['price']);
			// $PcsMrp = $this->IND_money_format($value['price'] * $value['Pcs']);
			$productsingalimg = '';
			$productsingalimg = $this->productmultiimg($value['imgfolder'], 1);

			$data[$i]['ItemId'] = $value['ItemId'];
			$data[$i]['CartId'] = $value['CartId'];
			$data[$i]['Qty'] = $value['Qty'];
			// $data[$i]['price'] = $value['price'];
			$data[$i]['ItemName'] = $value['title'];
			// $data[$i]['Type'] = $value['Type'];
			$data[$i]['Mrp'] = $Mrp;
			$data[$i]['ProductType'] = $value['ProductType'];
			$data[$i]['packagingtype_id'] = $value['packagingtype_id'];		
			$data[$i]['required_packing_pcs'] = $value['required_packing_pcs'];
			$data[$i]['packing_title'] = $value['packing_title'];	
			$data[$i]['PcsMrp'] = $PcsMrp;
			$data[$i]['PcsMrp_reg'] = $PcsMrp_reg;
			$data[$i]['Pcs'] = $value['Pcs'];
			$data[$i]['MinQty'] = $value['MinQty'];
			$data[$i]['Description'] = $value['description'];
			$data[$i]['Comment'] = $value['Comment'];
			$data[$i]['HindiComment'] = $value['HindiComment'];
			$data[$i]['AudioFile'] = !empty($value['AudioFile']) ? base_url('attachments/audiofile/' . $value['AudioFile']) : '';
			$data[$i]['Image'] = !empty($value['product_image']) ? base_url('attachments/shop_images/' . $value['product_image']) : $productsingalimg;
			$i++;
		}
		$this->db->where('id', $_REQUEST['UserId']);
		$query = $this->db->select('coupan,credit')->get('user_app');
		$rowresult = $query->row();
		$totalcartmax = $query_cartlimit['value'];
		$cartgst = $query_cartgst['value'];
		$item[0]['Total'] = $carttotal;
		$item[0]['Coupan'] = $rowresult->coupan;
		$item[0]['Credit'] = $rowresult->credit;
		$item[0]['MinCart'] = !empty($totalcartmax) ? $totalcartmax : 0;
		$item[0]['GST'] = !empty($cartgst) ? $cartgst : 0;
		$item[0]['GSTAmount'] = !empty($cartgst) ? round($carttotal * $cartgst / 100) : 0;
		$item[0]['TotalwithGST'] = !empty($cartgst) ? $carttotal + round($carttotal * $cartgst / 100) : 0;
		$item[0]['Pcstotal'] = !empty($pcstotal) ? $pcstotal : 0;
		// $item[0]['CartTotal'] = $count;
		$item[0]['CartItem'] = array();
		// $item[0]['CartItem']['cartdata'] = array();

		$packing_typet = $this->db->where("status = '1'")->get('packagingtype')->result_array();
		$cart_thely_limit = $this->db->where("thekey = 'cartlimitset'")->get('value_store')->row_array();
		// print_r($packing_typet);die;
		if(!empty($packing_typet)){
			foreach($packing_typet as $p_row){
				$box=array();
				$box['cartdata']=array();
				$total=0;
				$package_qty = 0;
				foreach($data as $c_row){

				if($c_row['ProductType']=='box'){
						if($p_row['packagingtype_id']==$c_row['packagingtype_id']){						
							$total=$total+($c_row['PcsMrp_reg']*$c_row['Qty']);
							array_push($box['cartdata'],$c_row);
							$package_qty += $c_row['Qty'] * $c_row['Pcs'];							
						}
					}					
				}
				if(!empty($box['cartdata'])){

						// 84
						//84*1.5=126
						//200
					// echo $package_qty;die;
					$x=1;
					for($i=1;$i<10;$i+=0.5) {
						if(($x % 2 == 0) && ($p_row['pcs'] * $i > $package_qty)) {																				
							$box['Require_Qty']=0;
							break;
						}

						if(($x % 2 == 1) && ($p_row['pcs'] * $i > $package_qty)) {							
							$box['Require_Qty']=($p_row['pcs'] * $i - $package_qty);
							break;
						}

						if(($p_row['pcs'] * $i) == $package_qty) {
							$box['Require_Qty']=0;
							break;
						}
						$x++;
					}														
					$box['Package_type']='box';
					$box['Package_total']=$total;				
					array_push($item[0]['CartItem'],$box);
				}
			}			
		}
		$box=array();
		$box['cartdata']=array();
		$package_qty=0;
		$total=0;
		foreach($data as $c_row){					
			if($c_row['ProductType']=='theli'){										
				$total=$total+($c_row['PcsMrp_reg']*$c_row['Qty']);
				$package_qty += $c_row['Qty']* $c_row['Pcs'];
				array_push($box['cartdata'],$c_row);					
			}					
		}
		if(!empty($box['cartdata'])){
			if($package_qty >= $cart_thely_limit['value']){
				$box['Require_Qty']=0;
			}else{
				$box['Require_Qty']=$cart_thely_limit['value']-	$package_qty;	
			}
			// $box['Require_Qty']=$cart_thely_limit['value'];
			$box['Package_type']='theli';
			$box['Package_total']=$total;				
			array_push($item[0]['CartItem'],$box);
		}
				
		$item[0]['address']=$this->GetUserAddressfun();

		// print_r($item[0]['CartItem']);die;
		if (!empty($item) && $item != '') {
			$return['Data'] = $item;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['data'] = $data;
			$return['Message'] = 'Data Get Not Successfully.';
			$return['IsSuccess'] = false;
		}
		return $return;
		//return $query->result_array();
	}

	public function UpdateCartItemfun() {
		$string = '';
		$this->db->select('*');
		$this->db->from('cartdetails');
		$this->db->where('cartdetails.id', $_REQUEST['Id']);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$data['qty'] = !empty($_REQUEST['Qty']) ? $_REQUEST['Qty'] : $row['qty'];
			$this->db->where('id', $_REQUEST['Id']);
			$this->db->update('cartdetails', $data);
			$string = 1;
		} else {
			$string = '';
		}
		if (!empty($string) && $string != '') {
			$return['Data'] = 1;
			$return['Message'] = 'Item Successfully Updated!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Could Not Find This Item';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function RemoveCartItemfun() {
		$query = $this->db->query("Select * from cartdetails where(id='" . $_POST['Id'] . "')");
		$row = $query->row();
		if (isset($row->id) == $_POST['Id']) {
			$this->db->delete("cartdetails", array("id" => $this->input->post("Id")));
			$return['Data'] = 1;
			$return['Message'] = 'Item Successfully Removed!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item not Found';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function GetCartCountfun() {
		$UserId = $_REQUEST['UserId'];
		$query = $this->db->query('SELECT * FROM cartdetails where user_type="user" AND userid = ' . $_REQUEST['UserId']);
		if ($query->num_rows() > 0) {
			$count = $query->num_rows();
			$return['Data'] = $count;
			$return['Message'] = 'Item Successfully Updated!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item not Found';
			$return['IsSuccess'] = true;
		}
		return $return;
	}

	public function UpdateMemberInfofun() {
		$string = '';
		$this->db->select('*');
		$this->db->from('user_app');
		$this->db->where('user_app.id', $_REQUEST['UserId']);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row_array();

			$data['name'] = !empty($_REQUEST['Name']) ? $_REQUEST['Name'] : $row['name'];
			$data['emailid'] = !empty($_REQUEST['Email']) ? $_REQUEST['Email'] : $row['emailid'];
			$data['address'] = !empty($_REQUEST['Address']) ? $_REQUEST['Address'] : $row['address'];
			$data['businessname'] = !empty($_REQUEST['CompanyName']) ? $_REQUEST['CompanyName'] : $row['CompanyName'];
			$this->db->where('id', $_REQUEST['UserId']);
			$this->db->update('user_app', $data);
			$string = 1;
		} else {
			$string = '';
		}
		if (!empty($string) && $string != '') {
			$return['Data'] = 1;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Could Not Find This User';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function UpdateMemberPhotofun() {
		$string = '';
		$this->db->select('*');
		$this->db->from('user_app');
		$this->db->where('user_app.id', $_REQUEST['UserId']);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			if (!empty($_FILES['Photo']['name'])) {
				if (isset($row['profileimg']) && $row['profileimg'] != '') {
					$audiodelete = $_SERVER['DOCUMENT_ROOT'] . '/attachments/userprofile_images/' . $row['profileimg'];
					if (file_exists($audiodelete)) {
						unlink($audiodelete);
					}
				}
				$profilephoto = $this->singalfileupload('Photo', 'userprofile_images');
				$photourl = !empty($profilephoto) ? base_url('attachments/userprofile_images/' . $profilephoto) : '';
			} else {
				$profilephoto = $row['profileimg'];
				$photourl = !empty($profilephoto) ? base_url('attachments/userprofile_images/' . $profilephoto) : '';
			}
			$data['profileimg'] = $profilephoto;
			$this->db->where('id', $_REQUEST['UserId']);
			$this->db->update('user_app', $data);
			$string = 1;
		} else {
			$string = '';
		}
		if (!empty($string) && $string != '') {
			$return['Data'] = $photourl;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Could Not Find This User';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function AddPhotoOrderfun() {
		$string = '';
		$this->db->select('*');
		$this->db->from('user_app');
		$this->db->where('user_app.id', $_REQUEST['UserId']);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$userid = $_REQUEST['UserId'];
			$title = $row['name'] . ' ' . date('j F, Y');
			$description = $_REQUEST['Description'];
			$hindicomment = $_REQUEST['HindiComment'];
			$address = $_REQUEST['Address'];
			// $transportname = $_REQUEST['TransportName'];
			// $shiptoid = $_REQUEST['ShipId'];
			// $billtoid = $_REQUEST['BillId'];
			$orderstatus = 'pending';

			if (!empty($_FILES['Image']['name'])) {
				$orderphoto = $this->singalfileupload('Image', 'photoorder_images');
			}
			if (!empty($_FILES['AudioFile']['name'])) {
				$new_name = time() . '_' . $_FILES['AudioFile']['name'];
				$path = $_SERVER['DOCUMENT_ROOT'] . '/attachments/audiofile/' . $new_name;
				move_uploaded_file($_FILES['AudioFile']['tmp_name'], $path);
				$orderaudio = $new_name;
			}
			$Addressship = $this->GetUserAddressfun($_REQUEST['ShipId'], null);
			$Addressbill = $this->GetUserAddressfun(null, $_REQUEST['BillId']);
			$data['title'] = !empty($title) ? $title : '';
			$data['description'] = !empty($description) ? $description : '';
			$data['hindicomment'] = !empty($hindicomment) ? $hindicomment : '';
			$data['address'] = !empty($address) ? $address : '';
			// $data['transportname'] = !empty($transportname) ? $transportname : '';
			$data['orderphoto'] = !empty($orderphoto) ? $orderphoto : '';
			$data['orderaudio'] = !empty($orderaudio) ? $orderaudio : '';
			$data['userid'] = !empty($userid) ? $userid : '';
			$data['shiptoid'] = !empty($Addressship) ? serialize($Addressship) : '';
			$data['billtoid'] = !empty($Addressbill) ? serialize($Addressbill) : '';
			$data['orderstatus'] = !empty($orderstatus) ? $orderstatus : '';
			$data['datetime'] = time();
			$this->db->insert('photoordercreate', $data);
			$lastId = $this->db->insert_id();
			$fcmtoken = $this->getadminfcmtoken();
			notifications('New Photoorder Created ' . $data['title'], 'Order ID #' . $lastId . ' ', $fcmtoken);
			$string = 1;
		} else {
			$string = '';
		}
		if (!empty($string) && $string != '') {
			$return['Data'] = 1;
			$return['Message'] = 'Order Successfully Created';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Could Not Find This User';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function GetCancelOrderfun() {
		$order_id = $_REQUEST['OrderId'];

		if (!empty($order_id) && $order_id != '') {
			$data['processed'] = "2";
			$this->db->where('id', $_REQUEST['OrderId']);
			$this->db->update('orders', $data);
			$return['Data'] = 1;
			$return['Message'] = 'Order Successfully Cancelled!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item not Found';
			$return['IsSuccess'] = false;
		}

		return $return;
	}

	public function GetContactUs($lang) {
		$where = "thekey = 'footerContactAddr' OR thekey = 'footerContactStoname' OR thekey = 'footerContactPhone' OR thekey = 'footerContactwPhone' OR thekey = 'footerContactwAddress' OR thekey = 'footerContactwWeblink' OR thekey = 'footerContactEmail' OR thekey = 'footerContactAccNo' OR thekey = 'footerContactIFSCode' OR thekey = 'footerContactHoldname' OR thekey = 'footerContactGSTno'";
		$this->db->where($where);
		$query = $this->db->get('value_store');
		$result = $query->result_array();
		$data = array();
		foreach ($result as $key => $value) {
			$key = $value['apivalue'];
			$data[0][$key] = ($value['value'] != '') ? $value['value'] : '';
		}
		$return['Data'] = $data;
		$return['Message'] = 'Data Get Successfully!';
		$return['IsSuccess'] = true;
		return $return;
	}

	public function Prelaunchbannerfun() {
		$where = "thekey = 'prelaunchimg'";
		$this->db->where($where);
		$query = $this->db->get('value_store');
		$result = $query->result_array();
		$data = array();
		foreach ($result as $key => $value) {
			$key = $value['thekey'];
			$data[0][$key] = ($value['value'] != '') ? base_url('attachments/site_logo/' . $value['value']) : '';
		}
		$return['Data'] = $data;
		$return['Message'] = 'Data Get Successfully!';
		$return['IsSuccess'] = true;
		return $return;
	}

	public function Getvideolistfun() {
		$newdata = array();
		//print_r($_REQUEST);
		$sort = '';
		$getusertypepro = '';
		if (isset($_REQUEST['UserId']) && !empty($_REQUEST['UserId'])) {
			$getusertypepro = $this->getcustomtypeshowproduct($_REQUEST['UserId']);
		}
		if (isset($_REQUEST['sort'])) {
			$sort = $_REQUEST['sort'];
			$this->db->order_by('products_translations.price', $_REQUEST['sort']);
		} else {
			$this->db->order_by('products.id', 'DESC');
		}

		// if ($_REQUEST['Type'] != 'All') {
		// 	$this->db->where('products.product_type', $_REQUEST['Type']);
		// }

		// $this->db->where_in('products.productviewtype', 'registorcustomer');
		if (isset($_REQUEST['UserId']) && !empty($_REQUEST['UserId'])) {
			$this->db->like('products.productviewtype', $getusertypepro);
		} else {
			$this->db->like('products.productviewtype', 'guestuser');
		}

		$this->db->where('products.videoid !=', '');

// 		SELECT `products`.`id` as `Id`, `products`.`image` as `product_image`, `products`.`folder` as `imgfolder`, `products`.`product_pcs` as `Pcs`, `products_translations`.`title`, `products_translations`.`price`, `products_translations`.`old_price`
		// FROM `productcat`
		// LEFT JOIN `product_attribute` ON `product_attribute`.`productid` = `productcat`.`productid`
		// LEFT JOIN `products` ON `products`.`id` = `productcat`.`productid`
		// LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
		// WHERE `productcat`.`catid` = '4' AND `product_attribute`.`valueid` IN('')
		// AND `products`.`visibility` = 1
		// ORDER BY `products`.`id` DESC
		//  LIMIT 10
		if (isset($_REQUEST['Catid']) && $_REQUEST['Catid'] != 0 && $_REQUEST['Catid'] != '') {
			if (isset($_REQUEST['Attribute']) && $_REQUEST['Attribute'] != '') {
				$attributearray = explode(",", $_REQUEST['Attribute']);
				$this->db->distinct('products.id');
				$this->db->join('product_attribute', 'product_attribute.productid = productcat.productid', 'left');
				$this->db->where_in('product_attribute.valueid', $attributearray);
			}
			$this->db->join('products', 'products.id = productcat.productid', 'left');
			$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
			$this->db->where('productcat.catid', $_REQUEST['Catid']);
			$this->db->where('products.visibility', 1);
			$query = $this->db->select('products.id as Id, products.image as product_image, products.folder as imgfolder, products.videoid, products.product_pcs as Pcs, products_translations.title, products_translations.price, products_translations.old_price')->get('productcat');
		} else {
			$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
			$query = $this->db->select('products.id as Id, products.image as product_image, products.folder as imgfolder, products.videoid, products.product_pcs as Pcs, products_translations.title, products_translations.price, products_translations.old_price')->get('products');
		}
		//echo $this->db->last_query();exit;
		$result = $query->result_array();
		$data = array();
		$i = 0;

		foreach ($result as $key => $value) {

			$image_link = array();
			// $i = 0;
			$singalimg = $value['product_image'];
			if (isset($singalimg) && $singalimg != '') {
				$nid = 1;
				$image_link[0]['Id'] = strval($value['Id'] . $nid);
				$image_link[0]['Image'] = !empty($singalimg) ? base_url('attachments/shop_images/' . $singalimg) : '';
				$a = 1;
			} else {
				$a = 0;
			}
			$multiimg = $value['imgfolder'];
			$multiimgarray = $this->productmultiimg($multiimg);
			foreach ($multiimgarray as $key => $value1) {
				$image_link[$a]['Id'] = strval($value['Id'] . ($a + 1));
				$image_link[$a]['Image'] = $value1;
				$a++;
			}

			$this->db->select('*');
			$this->db->from('cartdetails');
			$this->db->where('cartdetails.userid', $_REQUEST['UserId']);
			$this->db->where('cartdetails.itemid', $value['Id']);
			$this->db->where('cartdetails.user_type', 'user');
			$this->db->limit(1);
			$query = $this->db->get();
			$isincart = "";
			if ($query->num_rows() > 0) {$isincart = "1";}
			$Mrp = $this->IND_money_format($value['price']);
			$PcsMrp = $this->IND_money_format($value['price'] * $value['Pcs']);
			//print_r($image_link);
			$data[$i]['Id'] = $value['Id'];
			$data[$i]['Type'] = 'Product';
			$data[$i]['ItemName'] = $value['title'];
			$data[$i]['Mrp'] = $Mrp;
			$data[$i]['PcsMrp'] = $PcsMrp;
			$data[$i]['FilterMrp'] = $value['price'];
			$data[$i]['Pcs'] = $value['Pcs'];
			$data[$i]['VideoUrl'] = !empty($value['videoid']) ? $value['videoid'] : '';
			$data[$i]['Image'] = $image_link;
			$data[$i]['IsCart'] = $isincart;
			$i++;
		}

		$price = array();
		foreach ($data as $key => $row) {
			$price[$key] = $row['FilterMrp'];
		}
		if ($sort == 'asc') {
			array_multisort($price, SORT_ASC, $data);
		} elseif ($sort == 'desc') {
			array_multisort($price, SORT_DESC, $data);
		}

		/*****************************************************************************************************/
		$this->db->where('pre_products.videoid !=', '');
		$this->db->join('pre_products_translations', 'pre_products_translations.for_id = pre_products.id', 'left');
		$query = $this->db->select('pre_products.id as Id, pre_products.videoid as VideoID, pre_products_translations.title, pre_products.image as product_image, pre_products.folder as imgfolder, pre_products.product_type as Type, pre_products.product_pcs as Pcs, pre_products.min_qty as MinQty, pre_products.quantity as product_quantity_available, pre_products_translations.description, pre_products_translations.price, pre_products_translations.old_price, pre_products_translations.basic_description')->get('pre_products');
		//echo $this->db->last_query();
		$result = $query->result_array();
		$datapre = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$this->db->select('*');
			$this->db->from('likepreproduct');
			$this->db->where('likepreproduct.userid', $_REQUEST['UserId']);
			$this->db->where('likepreproduct.productid', $value['Id']);
			$query = $this->db->get();
			$isincart = "";
			if ($query->num_rows() > 0) {
				$ret = $query->row();
				$isincart = $ret->likestatus;}
			$image_link = array();
			// $singalimg = $result[0]['product_image'];
			$image_link[0]['Image'] = !empty($value['product_image']) ? base_url('attachments/shop_images/' . $value['product_image']) : '';
			$multiimg = $value['imgfolder'];
			$multiimgarray = $this->productmultiimg($multiimg);

			$a = 1;
			foreach ($multiimgarray as $key => $values) {
				$image_link[$a]['Image'] = $values;
				$a++;
			}
			$Mrp = $this->IND_money_format($value['price']);
			$PcsMrp = $this->IND_money_format($value['price'] * $value['Pcs']);
			$datapre[$i]['Id'] = $value['Id'];
			$datapre[$i]['Type'] = 'PreProduct';
			$datapre[$i]['ItemName'] = $value['title'];
			$datapre[$i]['Mrp'] = $Mrp;
			$datapre[$i]['PcsMrp'] = $PcsMrp;
			$datapre[$i]['Pcs'] = $value['Pcs'];
			$datapre[$i]['VideoUrl'] = !empty($value['VideoID']) ? $value['VideoID'] : '';
			$datapre[$i]['Status'] = $isincart;
			$datapre[$i]['Image'] = $image_link;
			$i++;
		}
		/*****************************************************************************************************/
		$newdata = array_merge($data, $datapre);
		if (!empty($newdata) && $newdata != '') {
			$return['Data'] = $newdata;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['data'] = $newdata;
			$return['Message'] = 'Data Get Not Successfully.';
			$return['IsSuccess'] = false;
		}
		return $return;
		//return $query->result_array();
	}

	public function MsgCountfun($lang) {
		if (isset($_REQUEST['UserID'])) {
			$this->db->where('wpn_chatmessenger.read_status', 0);
			$this->db->where('wpn_chatmessenger.usertype', 'admin');
			$this->db->where('wpn_chatmessenger.receiver_id', $_REQUEST['UserID']);
			$query = $this->db->select('COUNT(*) as usercount')->get('wpn_chatmessenger');
			$row = $query->row_array();

			$this->db->where('notificationdata.read_status', 0);
			$this->db->where('notificationdata.userid', $_REQUEST['UserID']);
			$query = $this->db->select('COUNT(*) as noticount')->get('notificationdata');
			$rownoti = $query->row_array();
			$data = array();
			$data[0]['Chatcount'] = $row['usercount'];
			$data[0]['Noticount'] = $rownoti['noticount'];

			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Data Not Get Successfully!';
			$return['IsSuccess'] = false;
		}

		return $return;
	}
	public function Adminunreadfun() {
		if (isset($_REQUEST['UserId'])) {
			$this->db->where('sender_id', $_REQUEST['UserId']);
			$this->db->update('wpn_chatmessenger', array('read_status' => 1));
			$return['Data'] = 1;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Data Not Get Successfully!';
			$return['IsSuccess'] = false;
		}

		return $return;
	}
	public function ReadCountfun() {
		if (isset($_REQUEST['UserID']) && isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'Readnotification') {
			$this->db->where('userid', $_REQUEST['UserID']);
			$this->db->set('read_status', 1);
			$this->db->update('notificationdata');
			$return['Data'] = 1;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} elseif (isset($_REQUEST['UserID']) && isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'Readmessage') {
			$this->db->where('wpn_chatmessenger.usertype', 'admin');
			$this->db->where('wpn_chatmessenger.receiver_id', $_REQUEST['UserID']);
			$this->db->set('read_status', 1);
			$this->db->update('wpn_chatmessenger');
			$return['Data'] = 1;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Data Not Get Successfully!';
			$return['IsSuccess'] = false;
		}

		return $return;
	}

	public function GetAboutUsFun() {

		$query = $this->db->get('aboutpage');
		$result = $query->result_array();
		$data = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$data[$i]['Title'] = ($value['title'] != '') ? $value['title'] : '';
			$data[$i]['Description'] = ($value['description'] != '') ? $value['description'] : '';
			$i++;
		}
		$return['Data'] = $data;
		$return['Message'] = 'Data Get Successfully!';
		$return['IsSuccess'] = true;
		return $return;
	}

	public function AddAddressFun() {
		$string = '';
		if (isset($_REQUEST['UserId']) && $_REQUEST['UserId'] != '' && $_REQUEST['AddressType'] != 'Both') {
			$data['userid'] = !empty($_REQUEST['UserId']) ? $_REQUEST['UserId'] : '';
			$data['addresstype'] = !empty($_REQUEST['AddressType']) ? $_REQUEST['AddressType'] : '';
			$data['companyname'] = !empty($_REQUEST['CompanyName']) ? $_REQUEST['CompanyName'] : '';
			$data['address'] = !empty($_REQUEST['Address']) ? $_REQUEST['Address'] : '';
			$data['gstnumber'] = !empty($_REQUEST['GSTnumber']) ? $_REQUEST['GSTnumber'] : '';
			$data['dateandtime'] = time();
			$this->db->insert('useraddress', $data);
			$string = 1;
		} elseif (isset($_REQUEST['UserId']) && $_REQUEST['UserId'] != '' && $_REQUEST['AddressType'] == 'Both') {
			$data['userid'] = !empty($_REQUEST['UserId']) ? $_REQUEST['UserId'] : '';
			$data['addresstype'] = 'Shipping';
			$data['companyname'] = !empty($_REQUEST['CompanyName']) ? $_REQUEST['CompanyName'] : '';
			$data['address'] = !empty($_REQUEST['Address']) ? $_REQUEST['Address'] : '';
			$data['gstnumber'] = !empty($_REQUEST['GSTnumber']) ? $_REQUEST['GSTnumber'] : '';
			$data['dateandtime'] = time();
			$this->db->insert('useraddress', $data);

			$data['userid'] = !empty($_REQUEST['UserId']) ? $_REQUEST['UserId'] : '';
			$data['addresstype'] = 'Billing';
			$data['companyname'] = !empty($_REQUEST['CompanyName']) ? $_REQUEST['CompanyName'] : '';
			$data['address'] = !empty($_REQUEST['Address']) ? $_REQUEST['Address'] : '';
			$data['gstnumber'] = !empty($_REQUEST['GSTnumber']) ? $_REQUEST['GSTnumber'] : '';
			$data['dateandtime'] = time();
			$this->db->insert('useraddress', $data);
			$string = 1;
		}
		if (!empty($string) && $string != '') {
			$return['Data'] = 1;
			$return['Message'] = 'Data Insert Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Data Not Insert Successfully!';
			$return['IsSuccess'] = false;
		}
		return $return;

	}

	public function GetUserAddressfun($shipid = null, $billid = null) {
		$this->db->where('addresstype', 'Billing');
		if ($billid != null) {
			$this->db->where('id', $billid);
		} else {
			$this->db->where('userid', $_REQUEST['UserId']);
		}
		$query = $this->db->get('useraddress');
		$result = $query->result_array();
		$databill = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$databill[$i]['Id'] = ($value['id'] != '') ? $value['id'] : '';
			$databill[$i]['Companyname'] = ($value['companyname'] != '') ? $value['companyname'] : '';
			$databill[$i]['Address'] = ($value['address'] != '') ? $value['address'] : '';
			$databill[$i]['Gstnumber'] = ($value['gstnumber'] != '') ? $value['gstnumber'] : '';
			$i++;
		}
		$this->db->where('addresstype', 'Shipping');
		if ($shipid != null) {
			$this->db->where('id', $shipid);
		} else {
			$this->db->where('userid', $_REQUEST['UserId']);
		}
		$query = $this->db->get('useraddress');
		$result = $query->result_array();
		$datashipp = array();
		$j = 0;
		foreach ($result as $key => $value) {
			$datashipp[$j]['Id'] = ($value['id'] != '') ? $value['id'] : '';
			$datashipp[$j]['Companyname'] = ($value['companyname'] != '') ? $value['companyname'] : '';
			$datashipp[$j]['Address'] = ($value['address'] != '') ? $value['address'] : '';
			$datashipp[$j]['Gstnumber'] = ($value['gstnumber'] != '') ? $value['gstnumber'] : '';
			$j++;
		}
		$data = array();
		$data['Billing'] = $databill;
		$data['Shipping'] = $datashipp;
		if ($billid != null) {
			return $databill;
		} elseif ($shipid != null) {
			return $datashipp;
		} else {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
			return $return;
		}
	}
	public function UpdateUserAddressfun() {
		$string = '';
		$this->db->select('*');
		$this->db->from('useraddress');
		$this->db->where('useraddress.id', $_REQUEST['Id']);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$dataup['addresstype'] = !empty($_REQUEST['AddressType']) ? $_REQUEST['AddressType'] : $row['addresstype'];
			$dataup['companyname'] = !empty($_REQUEST['CompanyName']) ? $_REQUEST['CompanyName'] : $row['companyname'];
			$dataup['address'] = !empty($_REQUEST['Address']) ? $_REQUEST['Address'] : $row['address'];
			$dataup['gstnumber'] = !empty($_REQUEST['GSTnumber']) ? $_REQUEST['GSTnumber'] : $row['gstnumber'];
			$this->db->where('id', $_REQUEST['Id']);
			$this->db->update('useraddress', $dataup);
			$string = 1;
		} else {
			$string = '';
		}
		if (!empty($string) && $string != '') {
			$return['Data'] = 1;
			$return['Message'] = 'Item Successfully Updated!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Could Not Find This Item';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	public function RemoveUserAddressfun() {
		$query = $this->db->query("Select * from useraddress where(id='" . $_POST['Id'] . "')");
		$row = $query->row();
		if (isset($row->id) == $_POST['Id']) {
			$this->db->delete("useraddress", array("id" => $this->input->post("Id")));
			$return['Data'] = 1;
			$return['Message'] = 'Item Successfully Removed!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item not Found';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function CheckOutfun() {
		
		// print_r($_REQUEST);die;
		$query_cartgst = $this->db->where("thekey = 'addgst'")->get('value_store')->row_array();
		$cartgst = $query_cartgst['value'];
		$q = $this->db->query('SELECT MAX(order_id) as order_id FROM orders');
		$rr = $q->row_array();
		if ($rr['order_id'] == 0) {
			$rr['order_id'] = 1233;
		}
		$post['order_id'] = $rr['order_id'] + 1;
		$this->db->where('cartdetails.userid', $_REQUEST['UserId']);
		$this->db->where('cartdetails.user_type', $_REQUEST['user_type']);	
		$query = $this->db->select('*')->get('cartdetails');
		
		// print_r($query);die;

		if ($query->num_rows() > 0) {
					
			$result = $query->result_array();			
			$post['date'] = time();
			$finalprice=0;
			$products_to_order = [];
			if (!empty($result)) {
				foreach ($result as $key => $value) {
					$totalqty[] = $value['qty'];
					$product = $this->getOneProductForSerialize($value['itemid'], $_REQUEST['UserId'],$value['ProductType']);
					$finalprice=$finalprice+(($value['qty'])*($product['price']));
					$products_to_order[] = [						
						'itemid' => $value['itemid'],
						'qty' => $value['qty'],
						'ProductType' => $value['ProductType'],
						'comment' => $value['comment'],
						'hindicomment' => $value['hindicomment'],
						'audiofile' => $value['audiofile'],
						'updatetime' => $value['updatetime']
					];
				}			
			}
			
			$this->db->insert_batch('order_products', $products_to_order); 
			// echo '<pre>';print_r($products_to_order);die;
			$this->db->select('*');
			$this->db->from('user_app');
			$this->db->where('user_app.id', $_REQUEST['UserId']);
			$this->db->limit(1);
			$query = $this->db->get();
			$userrow = $query->row_array();

			$post['name'] = $userrow['name'];
			$post['mobilenumber'] = $userrow['mobilenumber'];
			$post['emailid'] = $userrow['emailid'];
			$post['address'] = !empty($_REQUEST['Address']) ? $_REQUEST['Address'] : $userrow['address'];
			// $post['notes'] = !empty($_REQUEST['TransportName']) ? $_REQUEST['TransportName'] : '';
			$post['user_id'] = $_REQUEST['UserId'];
			$post['products'] = '';
			$post['finaltotal'] = $finalprice;
			$post['totalqty'] = array_sum($totalqty);
			$post['gst'] = !empty($cartgst) ? $cartgst : 0;
			// $post['gstamount'] = !empty($cartgst) ? round($post['finaltotal'] * $cartgst / 100) : 0;
			$post['gstamount'] = !empty($_REQUEST['GSTamount']) ? $_REQUEST['GSTamount'] : 0;
			$post['gstwithamount'] = !empty($cartgst) ? $post['finaltotal'] + round($post['finaltotal'] * $cartgst / 100) : 0;
			$post['description'] = !empty($_REQUEST['Description']) ? $_REQUEST['Description'] : '';
			$post['payment_type'] = !empty($_REQUEST['PaymentMode']) ? $_REQUEST['PaymentMode'] : '';
			$post['transactionid'] = !empty($_REQUEST['TransactionID']) ? $_REQUEST['TransactionID'] : '';
			$post['discountamount'] = !empty($_REQUEST['Discountprice']) ? $_REQUEST['Discountprice'] : '';
			$post['coupancode'] = !empty($_REQUEST['CoupanCode']) ? $_REQUEST['CoupanCode'] : '';
			$post['referrer'] = '';
			if (!empty($_FILES['AudioFile']['name'])) {
				$new_name = time() . '_' . $_FILES['AudioFile']['name'];
				$path = $_SERVER['DOCUMENT_ROOT'] . '/attachments/audiofile/' . $new_name;
				move_uploaded_file($_FILES['AudioFile']['tmp_name'], $path);
				$orderaudio = $new_name;
			}
			if (!$this->db->insert('orders', array(
				'order_id' => $post['order_id'],
				'products' => $post['products'],
				'date' => $post['date'],
				'referrer' => $post['referrer'],
				'payment_type' => $post['payment_type'],
				'transactionid' => $post['transactionid'],
				'discountamount' => $post['discountamount'],
				'coupancode' => $post['coupancode'],
				'totalqty' => $post['totalqty'],
				'finaltotal' => $post['finaltotal'],
				'gst' => $post['gst'],
				'gstamount' => $post['gstamount'],
				'gstwithamount' => $post['gstwithamount'],
				'processed' => 'Pending',
				'user_id' => $post['user_id'],
				'orderaudio' => !empty($orderaudio) ? $orderaudio : '',
				'description' => $post['description'],
			))) {
				log_message('error', print_r($this->db->error(), true));
			}

			$lastId = $this->db->insert_id();
			
			$Addressship = $this->GetUserAddressfun($_REQUEST['ShipId'], null);
			$Addressbill = $this->GetUserAddressfun(null, $_REQUEST['BillId']);
			if (!$this->db->insert('orders_clients', array(
				'for_id' => $lastId,
				'first_name' => $post['name'],
				'email' => $post['emailid'],
				'phone' => $post['mobilenumber'],
				'address' => $post['address'],
				'shiptoid' => !empty($Addressship) ? serialize($Addressship) : '',
				'billtoid' => !empty($Addressbill) ? serialize($Addressbill) : '',
				// 'notes' => $post['notes'],
			))) {
				log_message('error', print_r($this->db->error(), true));
			}

			// print_r($lastId);die;
			// $this->db->last_query();
			$fcmtoken = $this->getadminfcmtoken();
			$title = 'New Order Placed Order ID #' . $lastId;
			$content = 'Customer Name : ' . $post['name'] . ', Date: ' . date('d-m-Y') . ' and Payment Mode:' . $post['payment_type'];
			notifications($title, $content, $fcmtoken);
			$this->db->delete("cartdetails", array("userid" => $_REQUEST['UserId'],"user_type" => $_REQUEST['user_type']));
			$return['Data'] = 1;
			$return['Message'] = 'Order completed successfully';
			$return['IsSuccess'] = true;

		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item not Found';
			$return['IsSuccess'] = false;
		}

		return $return;
	}
	public function GetOrderByTypefun() {
		$Status = '';
		if (isset($_REQUEST['Status']) && $_REQUEST['Status'] == 'Pending') {
			$Status = 0;
		}
		if (isset($_REQUEST['Status']) && $_REQUEST['Status'] == 'Delivered') {
			$Status = 1;
		}

		$this->db->select('orders.*, orders_clients.first_name,'
			. ' orders_clients.last_name, orders_clients.email, orders_clients.phone, '
			. 'orders_clients.address, orders_clients.city, orders_clients.post_code,'
			. ' orders_clients.notes');
		$this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner');
		$this->db->where('orders.user_id', $_REQUEST['UserId']);

		$result = $this->db->get('orders');
		$row = $result->result_array();
		$data = [];
		$i = 0;
		foreach ($row as $key => $value) {
			$orderid = $value['id'];
			$data[$i]['Id'] = $orderid;
			$data[$i]['Address'] = $value['address'];
			$data[$i]['PaymentType'] = $value['payment_type'];
			$data[$i]['TransactionId'] = $value['transactionid'];
			$data[$i]['DiscountAmount'] = $this->IND_money_format($value['discountamount']);
			$data[$i]['GSTAmount'] = $this->IND_money_format($value['gstamount']);
			$data[$i]['UserId'] = $value['user_id'];
			$data[$i]['Status'] = $_REQUEST['Status'];
			$data[$i]['Date'] = date('d.M.Y', $value['date']);
			$data[$i]['NewDate'] = date('d-m-Y', $value['date']);

			$products = unserialize(html_entity_decode($value['products']));
			$j = 0;
			$finalprice = 0;
			foreach ($products as $key => $value) {
				$productinfo = $value['product_info'];
				$productprice = ($value['product_quantity'] * $productinfo['product_pcs']) * $productinfo['price'];
				$finalprice = $finalprice + $productprice;
				$Items_List[$j]['OrderId'] = $orderid;
				$Items_List[$j]['ItemId'] = $productinfo['id'];
				$Items_List[$j]['ItemName'] = $productinfo['title'];
				$Items_List[$j]['Qty'] = $productinfo['price'];
				$Items_List[$j]['Pcs'] = $productinfo['price'];
				$Items_List[$j]['TotalQty'] = $value['product_quantity'];
				$Items_List[$j]['Mrp'] = $productinfo['price'];
				$Items_List[$j]['SubTotal'] = $value['product_quantity'] * $productinfo['price'];
				$Items_List[$j]['Image'] = !empty($productinfo['image']) ? base_url('attachments/shop_images/' . $productinfo['image']) : '';
				$Items_List[$j]['Comment'] = $value['product_comment'];
				$Items_List[$j]['AudioFile'] = !empty($value['product_audiofile']) ? base_url('attachments/audiofile/' . $value['product_audiofile']) : '';
				$j++;
			}
			$data[$i]['ItemsList'] = $Items_List;
			$data[$i]['Total'] = $finalprice;
			$i++;
		}
		if (!empty($data) && isset($data)) {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item not Found';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function GetOrderByTypeNewfun() {

		if (isset($_REQUEST['Status']) && $_REQUEST['Status'] == 'Order') {
			$this->db->select('orders.*, orders_clients.first_name,orders_clients.shiptoid,orders_clients.billtoid,'
				. ' orders_clients.last_name, orders_clients.email, orders_clients.phone, '
				. 'orders_clients.address, orders_clients.city, orders_clients.post_code,'
				. ' orders_clients.notes');
			$this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner');
			$this->db->where('orders.user_id', $_REQUEST['UserId']);
			$this->db->order_by("orders.id", "desc");
			$result = $this->db->get('orders');
			// echo $this->db->last_query();
			//exit;
			$row = $result->result_array();
			$data = [];
			$i = 0;
			foreach ($row as $key => $value) {
				$Addressship = unserialize(html_entity_decode($value['shiptoid']));
				$Addressbill = unserialize(html_entity_decode($value['billtoid']));
				$orderid = $value['id'];
				$statust = '';
				$data[$i]['Id'] = $orderid;
				$data[$i]['Address'] = $value['address'];
				// $data[$i]['TransportName'] = $value['notes'];
				$data[$i]['UserId'] = $value['user_id'];
				$data[$i]['Status'] = $value['processed'];
				$data[$i]['Description'] = $value['description'];
				$data[$i]['PaymentType'] = $value['payment_type'];
				$data[$i]['TransactionId'] = $value['transactionid'];
				$data[$i]['DiscountAmount'] = $this->IND_money_format($value['discountamount']);
				$data[$i]['GSTAmount'] = $this->IND_money_format($value['gstamount']);
				$data[$i]['AudioFile'] = !empty($value['orderaudio']) ? base_url('attachments/audiofile/' . $value['orderaudio']) : '';
				$data[$i]['Addressship'] = $Addressship;
				$data[$i]['Addressbill'] = $Addressbill;
				$data[$i]['Date'] = date('d.M.Y', $value['date']);
				$data[$i]['NewDate'] = date('d-m-Y', $value['date']);
				$discountamount = $value['discountamount'];
				$gstamount = $value['gstamount'];

				$productsdec = unserialize(html_entity_decode($value['products']));
				$j = 0;
				$finalprice = 0;
				$Items_List = [];
				foreach ($productsdec as $key => $value) {

					$productsingalimg = '';
					$productinfo = $value['product_info'];
					$productsingalimg = $this->productmultiimg($productinfo['folder'], 1);
					$productprice = ($value['product_quantity'] * $productinfo['product_pcs']) * $productinfo['price'];
					$Mrp = $this->IND_money_format($productinfo['price']);
					$finalprice = $finalprice + $productprice;
					/*$subtotal = $value['product_quantity'] * $productinfo['price'];*/
					$Items_List[$j]['OrderId'] = $orderid;
					$Items_List[$j]['ItemId'] = $productinfo['id'];
					$Items_List[$j]['ItemName'] = $productinfo['title'];
					/*$Items_List[$j]['Qty'] = $productinfo['price'];*/
					$Items_List[$j]['Pcs'] = $productinfo['product_pcs'];
					$Items_List[$j]['TotalQty'] = $value['product_quantity'];
					$Items_List[$j]['Mrp'] = $Mrp;
					/*$Items_List[$j]['SubTotal'] = "$subtotal";*/
					$Items_List[$j]['Image'] = !empty($productinfo['image']) ? base_url('attachments/shop_images/' . $productinfo['image']) : $productsingalimg;
					$Items_List[$j]['Comment'] = $value['product_comment'];
					$Items_List[$j]['AudioFile'] = !empty($value['product_audiofile']) ? base_url('attachments/audiofile/' . $value['product_audiofile']) : '';
					$j++;
				}
				$withdiscount = $this->IND_money_format(($finalprice - $discountamount) + $gstamount);
				$withoutdiscount = $this->IND_money_format($finalprice + $gstamount);
				$Mrp = $this->IND_money_format($finalprice);
				$data[$i]['ItemsList'] = $Items_List;
				$data[$i]['Total'] = "$Mrp";
				$data[$i]['WithDiscount'] = "$withdiscount";
				$data[$i]['WithoutDiscount'] = "$withoutdiscount";
				$i++;
			}
		}
		if (isset($_REQUEST['Status']) && $_REQUEST['Status'] == 'PhotoOrder') {
			$this->db->select('photoordercreate.*');
			$this->db->where('photoordercreate.userid', $_REQUEST['UserId']);
			$this->db->order_by("photoordercreate.id", "desc");
			$result = $this->db->get('photoordercreate');
			//echo $this->db->last_query(); exit;
			$row = $result->result_array();
			$data = [];
			$i = 0;
			foreach ($row as $key => $value) {
				// $Addressship = $this->GetUserAddressfun($value['shiptoid'], null);
				// $Addressbill = $this->GetUserAddressfun(null, $value['billtoid']);

				$Addressship = unserialize(html_entity_decode($value['shiptoid']));
				$Addressbill = unserialize(html_entity_decode($value['billtoid']));
				$orderdate = date("d-m-Y", $value['datetime']);
				$data[$i]['OrderId'] = $value['id'];
				$data[$i]['UserId'] = $value['userid'];
				$data[$i]['Address'] = $value['address'];
				// $data[$i]['TransportName'] = $value['transportname'];
				$data[$i]['Description'] = $value['description'];
				$data[$i]['Status'] = $value['orderstatus'];
				$data[$i]['Date'] = $orderdate;
				$data[$i]['Addressship'] = !empty($Addressship) ? $Addressship : array();
				$data[$i]['Addressbill'] = !empty($Addressbill) ? $Addressbill : array();
				$Items_List = [];
				$Items_List[0]['OrderId'] = $value['id'];
				$Items_List[0]['Image'] = !empty($value['orderphoto']) ? base_url('attachments/photoorder_images/' . $value['orderphoto']) : '';
				$Items_List[0]['Comment'] = $value['description'];
				$Items_List[0]['AudioFile'] = !empty($value['orderaudio']) ? base_url('attachments/audiofile/' . $value['orderaudio']) : '';
				$data[$i]['ItemsList'] = $Items_List;
				$i++;
			}
		}

		if (!empty($data) && isset($data)) {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item not Found';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	public function sendorderdetailsfun() {

		if (isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'order' && isset($_REQUEST['Orderid']) && $_REQUEST['Orderid'] != '') {
			
			$this->db->select('orders.*, orders_clients.first_name,orders_clients.shiptoid,orders_clients.billtoid,'
				. ' orders_clients.last_name, orders_clients.email, orders_clients.phone, '
				. 'orders_clients.address, orders_clients.city, orders_clients.post_code,'
				. ' orders_clients.notes');

			$this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner');
			$this->db->where('orders.id', $_REQUEST['Orderid']);
			$this->db->order_by("orders.id", "desc");
			$result = $this->db->get('orders');
			// echo $this->db->last_query();
			//exit;
			$row = $result->result_array();
			$data = [];
			$i = 0;
			foreach ($row as $key => $value) {
				$Addressship = unserialize(html_entity_decode($value['shiptoid']));
				$Addressbill = unserialize(html_entity_decode($value['billtoid']));
				$orderid = $value['id'];
				$statust = '';
				$data[$i]['Id'] = $orderid;
				$data[$i]['Address'] = $value['address'];
				// $data[$i]['TransportName'] = $value['notes'];
				$data[$i]['UserId'] = $value['user_id'];
				$data[$i]['Status'] = $value['processed'];
				$data[$i]['Description'] = $value['description'];
				$data[$i]['PaymentType'] = $value['payment_type'];
				$data[$i]['TransactionId'] = $value['transactionid'];
				$data[$i]['DiscountAmount'] = $this->IND_money_format($value['discountamount']);
				$data[$i]['GSTAmount'] = $this->IND_money_format($value['gstamount']);
				$data[$i]['AudioFile'] = !empty($value['orderaudio']) ? base_url('attachments/audiofile/' . $value['orderaudio']) : '';
				$data[$i]['Addressship'] = $Addressship;
				$data[$i]['Addressbill'] = $Addressbill;
				$data[$i]['Date'] = date('d.M.Y', $value['date']);
				$data[$i]['NewDate'] = date('d-m-Y', $value['date']);
				$discountamount = $value['discountamount'];
				$gstamount = $value['gstamount'];

				$productsdec = unserialize(html_entity_decode($value['products']));
				$j = 0;
				$finalprice = 0;
				$Items_List = [];
				foreach ($productsdec as $key => $value) {

					$productsingalimg = '';
					$productinfo = $value['product_info'];
					
					$this->db->where('id',$productinfo['id']);							
					$result = $this->db->get('products');			
					$row = $result->row_array();
					
					$productsingalimg = $this->productmultiimg($productinfo['folder'], 1);
					// $productprice = $value['product_quantity'] * $productinfo['price'];
					$productprice = ($value['product_quantity'] * $productinfo['product_pcs']) * $productinfo['price'];
					$Mrp = $this->IND_money_format($productinfo['price']);
					$finalprice = $finalprice + $productprice;
					/*$subtotal = $value['product_quantity'] * $productinfo['price'];*/
					$Items_List[$j]['OrderId'] = $orderid;
					$Items_List[$j]['ItemId'] = $productinfo['id'];
					$Items_List[$j]['ItemName'] = $productinfo['title'];
					/*$Items_List[$j]['Qty'] = $productinfo['price'];*/
					$Items_List[$j]['Pcs'] = $productinfo['product_pcs'];
					$Items_List[$j]['TotalQty'] = $value['product_quantity'];
					$Items_List[$j]['Mrp'] = $Mrp;
					/*$Items_List[$j]['SubTotal'] = "$subtotal";*/
					$Items_List[$j]['Image'] = !empty($productinfo['image']) ? base_url('attachments/shop_images/' . $productinfo['image']) : $productsingalimg;
					$Items_List[$j]['Comment'] = $value['product_comment'];
					$Items_List[$j]['AudioFile'] = !empty($value['product_audiofile']) ? base_url('attachments/audiofile/' . $value['product_audiofile']) : '';
					$Items_List[$j]['refPackagingtype_id']=$row['refPackagingtype_id'];
					// array_push($Items_List[$j],$Items_List[$row['refPackagingtype_id']]);
					$j++;
				}


				// print_r($Items_List);die;
				$item_box_array = [];

				$packing_typet = $this->db->where("status = '1'")->get('packagingtype')->result_array();
				// print_r($packing_typet);die;
				if(!empty($packing_typet)){
					$i=0;
					foreach($packing_typet as $p_row){
						$item_box_array[$i] = [];						
						$box=array();
						$total=0;
						foreach($Items_List as $c_row){
							// print_r($c_row);die;
							if($p_row['packagingtype_id']==$c_row['refPackagingtype_id']){
								$total=$total+($c_row['Pcs']*$c_row['TotalQty']*$c_row['Mrp']);
								array_push($box,$c_row);
							}
						}
						if(!empty($box)){
							$box['Package_total']=$total;				
							array_push($item_box_array[$i],$box);
						}
						$i=$i+1;						
					}
				}


				$withdiscount = $this->IND_money_format(($finalprice - $discountamount) + $gstamount);
				$withoutdiscount = $this->IND_money_format($finalprice + $gstamount);
				$Mrp = $this->IND_money_format($finalprice);
				$data[$i]['ItemsList'] = $item_box_array;
				$data[$i]['Total'] = "$Mrp";
				$data[$i]['WithDiscount'] = "$withdiscount";
				$data[$i]['WithoutDiscount'] = "$withoutdiscount";
				$i++;
			}
		}
		if (isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'photo' && isset($_REQUEST['Orderid']) && $_REQUEST['Orderid'] != '') {
			$this->db->select('photoordercreate.*');
			$this->db->where('photoordercreate.id', $_REQUEST['Orderid']);
			$this->db->order_by("photoordercreate.id", "desc");
			$result = $this->db->get('photoordercreate');
			//echo $this->db->last_query(); exit;
			$row = $result->result_array();
			$data = [];
			$i = 0;
			foreach ($row as $key => $value) {
				// $Addressship = $this->GetUserAddressfun($value['shiptoid'], null);
				// $Addressbill = $this->GetUserAddressfun(null, $value['billtoid']);

				$Addressship = unserialize(html_entity_decode($value['shiptoid']));
				$Addressbill = unserialize(html_entity_decode($value['billtoid']));
				$orderdate = date("d-m-Y", $value['datetime']);
				$data[$i]['OrderId'] = $value['id'];
				$data[$i]['UserId'] = $value['userid'];
				$data[$i]['Address'] = $value['address'];
				// $data[$i]['TransportName'] = $value['transportname'];
				$data[$i]['Description'] = $value['description'];
				$data[$i]['Status'] = $value['orderstatus'];
				$data[$i]['Date'] = $orderdate;
				$data[$i]['Addressship'] = !empty($Addressship) ? $Addressship : array();
				$data[$i]['Addressbill'] = !empty($Addressbill) ? $Addressbill : array();
				$Items_List = [];
				$Items_List[0]['OrderId'] = $value['id'];
				$Items_List[0]['Image'] = !empty($value['orderphoto']) ? base_url('attachments/photoorder_images/' . $value['orderphoto']) : '';
				$Items_List[0]['Comment'] = $value['description'];
				$Items_List[0]['AudioFile'] = !empty($value['orderaudio']) ? base_url('attachments/audiofile/' . $value['orderaudio']) : '';
				$data[$i]['ItemsList'] = $Items_List;
				$i++;
			}
		}

		if (!empty($data) && isset($data)) {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item not Found';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	public function GetAllOrderByTypeNewfun() {

		if (isset($_REQUEST['OrderType']) && $_REQUEST['OrderType'] == 'Order') {
			$this->db->select('orders.*, user_app.name as username, user_app.mobilenumber as Mobilenumber, user_app.businessname as businessname, orders_clients.first_name,'
				. ' orders_clients.last_name, orders_clients.email, orders_clients.phone,orders_clients.shiptoid,orders_clients.billtoid,'
				. 'orders_clients.address, orders_clients.city, orders_clients.post_code,'
				. ' orders_clients.notes');
			$this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner');
			$this->db->join('user_app', 'user_app.id = orders.user_id', 'inner');
			if (isset($_REQUEST['Status']) && $_REQUEST['Status'] != '') {
				$this->db->where('orders.processed', $_REQUEST['Status']);
			}
			if (isset($_REQUEST['OrderId']) && $_REQUEST['OrderId'] != '') {
				$this->db->where('orders.id', $_REQUEST['OrderId']);
			}
			$this->db->order_by("orders.id", "desc");
			$result = $this->db->get('orders');
			$row = $result->result_array();
			$data = [];
			$i = 0;
			foreach ($row as $key => $value) {
				$Addressship = unserialize(html_entity_decode($value['shiptoid']));
				$Addressbill = unserialize(html_entity_decode($value['billtoid']));
				$bussname = '';
				if (isset($value['businessname']) && $value['businessname'] != '') {$bussname = '(' . $value['businessname'] . ')';}
				$orderid = $value['id'];
				$statust = '';
				$data[$i]['OrderId'] = $orderid;
				$data[$i]['Address'] = $value['address'];
				$data[$i]['TransportName'] = $value['notes'];
				$data[$i]['PaymentType'] = $value['payment_type'];
				$data[$i]['TransactionId'] = $value['transactionid'];
				$data[$i]['DiscountAmount'] = $this->IND_money_format($value['discountamount']);
				$data[$i]['GSTAmount'] = $this->IND_money_format($value['gstamount']);
				$data[$i]['UserId'] = $value['user_id'];
				$data[$i]['Username'] = $value['username'] . ' ' . $bussname;
				$data[$i]['MobileNo'] = $value['Mobilenumber'];
				$data[$i]['Status'] = $value['processed'];
				$data[$i]['Addressship'] = !empty($Addressship) ? $Addressship : array();
				$data[$i]['Addressbill'] = !empty($Addressbill) ? $Addressbill : array();
				$data[$i]['Date'] = date('d.M.Y', $value['date']);
				$data[$i]['NewDate'] = date('d-m-Y', $value['date']);
				$discountamount = $value['discountamount'];
				$gstamount = $value['gstamount'];

				$productsdec = unserialize(html_entity_decode($value['products']));
				$j = 0;
				$finalprice = 0;
				$Items_List = [];
				foreach ($productsdec as $key => $value) {
					$productsingalimg = '';
					$productinfo = $value['product_info'];
					//print_r($productinfo);
					$productsingalimg = $this->productmultiimg($productinfo['folder'], 1);
					$productprice = ($value['product_quantity'] * $productinfo['product_pcs']) * $productinfo['price'];
					$finalprice = $finalprice + $productprice;
					/*$subtotal = $value['product_quantity'] * $productinfo['price'];*/
					$Items_List[$j]['OrderId'] = $orderid;
					$Items_List[$j]['ItemId'] = $productinfo['id'];
					$Items_List[$j]['ItemName'] = $productinfo['title'];
					/*$Items_List[$j]['Qty'] = $productinfo['price'];*/
					$Items_List[$j]['Pcs'] = $productinfo['product_pcs'];
					$Items_List[$j]['TotalQty'] = $value['product_quantity'];
					$Items_List[$j]['Mrp'] = $productinfo['price'];
					/*$Items_List[$j]['SubTotal'] = "$subtotal";*/
					$Items_List[$j]['Image'] = !empty($productinfo['image']) ? base_url('attachments/shop_images/' . $productinfo['image']) : $productsingalimg;
					$Items_List[$j]['Comment'] = $value['product_comment'];
					$Items_List[$j]['AudioFile'] = !empty($value['product_audiofile']) ? base_url('attachments/audiofile/' . $value['product_audiofile']) : '';
					$j++;
				}
				// $data[$i]['ItemsList'] = $Items_List;
				// $data[$i]['Total'] = "$finalprice";
				$withdiscount = $this->IND_money_format(($finalprice - $discountamount) + $gstamount);
				$withoutdiscount = $this->IND_money_format($finalprice + $gstamount);
				$Mrp = $this->IND_money_format($finalprice);
				$data[$i]['ItemsList'] = $Items_List;
				$data[$i]['Total'] = "$Mrp";
				$data[$i]['WithDiscount'] = "$withdiscount";
				$data[$i]['WithoutDiscount'] = "$withoutdiscount";
				$i++;
			}
		}
		if (isset($_REQUEST['OrderType']) && $_REQUEST['OrderType'] == 'PhotoOrder') {
			$this->db->select('photoordercreate.*, user_app.name as username, user_app.address as useraddress, user_app.mobilenumber as Mobilenumber, user_app.businessname as businessname');
			// $this->db->where('photoordercreate.userid', $_REQUEST['UserId']);
			$this->db->join('user_app', 'user_app.id = photoordercreate.userid', 'inner');
			if (isset($_REQUEST['Status']) && $_REQUEST['Status'] != '') {
				$this->db->where('photoordercreate.orderstatus', $_REQUEST['Status']);
			}
			if (isset($_REQUEST['OrderId']) && $_REQUEST['OrderId'] != '') {
				$this->db->where('photoordercreate.id', $_REQUEST['OrderId']);
			}
			$this->db->order_by("photoordercreate.id", "desc");
			$result = $this->db->get('photoordercreate');
			//echo $this->db->last_query(); exit;
			$row = $result->result_array();
			$data = [];
			$i = 0;
			foreach ($row as $key => $value) {
				$Addressship = unserialize(html_entity_decode($value['shiptoid']));
				$Addressbill = unserialize(html_entity_decode($value['billtoid']));
				$bussname = '';
				if (isset($value['businessname']) && $value['businessname'] != '') {$bussname = '(' . $value['businessname'] . ')';}
				$orderdate = date("d-m-Y", $value['datetime']);
				$data[$i]['OrderId'] = $value['id'];
				$data[$i]['UserId'] = $value['userid'];
				$data[$i]['Username'] = $value['username'] . ' ' . $bussname;
				$data[$i]['MobileNo'] = $value['Mobilenumber'];
				$data[$i]['Address'] = $value['useraddress'];
				$data[$i]['TransportName'] = $value['transportname'];
				$data[$i]['Status'] = $value['orderstatus'];
				$data[$i]['Date'] = $orderdate;
				$data[$i]['Addressship'] = !empty($Addressship) ? $Addressship : array();
				$data[$i]['Addressbill'] = !empty($Addressbill) ? $Addressbill : array();
				$Items_List = [];
				$Items_List[0]['OrderId'] = $value['id'];
				$Items_List[0]['Image'] = !empty($value['orderphoto']) ? base_url('attachments/photoorder_images/' . $value['orderphoto']) : '';
				$Items_List[0]['Comment'] = $value['description'];
				$Items_List[0]['AudioFile'] = !empty($value['orderaudio']) ? base_url('attachments/audiofile/' . $value['orderaudio']) : '';
				$data[$i]['ItemsList'] = $Items_List;
				$i++;
			}
		}

		if (!empty($data) && isset($data)) {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item not Found';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	public function GetAllOrderBySearchNewfun() {

		if (isset($_REQUEST['OrderType']) && $_REQUEST['OrderType'] == 'Order' && isset($_REQUEST['Kyeword'])) {
			$this->db->select('orders.*, user_app.name as username, user_app.mobilenumber as Mobilenumber, user_app.businessname as businessname, orders_clients.first_name,'
				. ' orders_clients.last_name, orders_clients.email, orders_clients.phone,orders_clients.shiptoid,orders_clients.billtoid,'
				. 'orders_clients.address, orders_clients.city, orders_clients.post_code,'
				. ' orders_clients.notes');
			$this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner');
			$this->db->join('user_app', 'user_app.id = orders.user_id', 'inner');
			$this->db->like('orders_clients.first_name', $_GET['Kyeword']);
			$this->db->or_like('orders_clients.phone', $_GET['Kyeword']);
			$this->db->or_like('orders.processed', $_GET['Kyeword']);
			$this->db->or_like('orders.id', $_GET['Kyeword']);
			$this->db->or_like('user_app.name', $_GET['Kyeword']);
			$this->db->or_like('user_app.mobilenumber', $_GET['Kyeword']);
			$this->db->order_by("orders.id", "desc");
			$result = $this->db->get('orders');
			$row = $result->result_array();
			$data = [];
			$i = 0;
			foreach ($row as $key => $value) {
				$Addressship = unserialize(html_entity_decode($value['shiptoid']));
				$Addressbill = unserialize(html_entity_decode($value['billtoid']));
				$bussname = '';
				if (isset($value['businessname']) && $value['businessname'] != '') {$bussname = '(' . $value['businessname'] . ')';}
				$orderid = $value['id'];
				$statust = '';
				$data[$i]['OrderId'] = $orderid;
				$data[$i]['Address'] = $value['address'];
				$data[$i]['TransportName'] = $value['notes'];
				$data[$i]['PaymentType'] = $value['payment_type'];
				$data[$i]['TransactionId'] = $value['transactionid'];
				$data[$i]['DiscountAmount'] = $this->IND_money_format($value['discountamount']);
				$data[$i]['GSTAmount'] = $this->IND_money_format($value['gstamount']);
				$data[$i]['UserId'] = $value['user_id'];
				$data[$i]['Username'] = $value['username'] . ' ' . $bussname;
				$data[$i]['MobileNo'] = $value['Mobilenumber'];
				$data[$i]['Status'] = $value['processed'];
				$data[$i]['Addressship'] = !empty($Addressship) ? $Addressship : array();
				$data[$i]['Addressbill'] = !empty($Addressbill) ? $Addressbill : array();
				$data[$i]['Date'] = date('d.M.Y', $value['date']);
				$data[$i]['NewDate'] = date('d-m-Y', $value['date']);
				$discountamount = $value['discountamount'];
				$gstamount = $value['gstamount'];

				$productsdec = unserialize(html_entity_decode($value['products']));
				$j = 0;
				$finalprice = 0;
				$Items_List = [];
				foreach ($productsdec as $key => $value) {
					$productsingalimg = '';
					$productinfo = $value['product_info'];
					//print_r($productinfo);
					$productsingalimg = $this->productmultiimg($productinfo['folder'], 1);
					$productprice = ($value['product_quantity'] * $productinfo['product_pcs']) * $productinfo['price'];
					$finalprice = $finalprice + $productprice;
					/*$subtotal = $value['product_quantity'] * $productinfo['price'];*/
					$Items_List[$j]['OrderId'] = $orderid;
					$Items_List[$j]['ItemId'] = $productinfo['id'];
					$Items_List[$j]['ItemName'] = $productinfo['title'];
					/*$Items_List[$j]['Qty'] = $productinfo['price'];*/
					$Items_List[$j]['Pcs'] = $productinfo['product_pcs'];
					$Items_List[$j]['TotalQty'] = $value['product_quantity'];
					$Items_List[$j]['Mrp'] = $productinfo['price'];
					/*$Items_List[$j]['SubTotal'] = "$subtotal";*/
					$Items_List[$j]['Image'] = !empty($productinfo['image']) ? base_url('attachments/shop_images/' . $productinfo['image']) : $productsingalimg;
					$Items_List[$j]['Comment'] = $value['product_comment'];
					$Items_List[$j]['AudioFile'] = !empty($value['product_audiofile']) ? base_url('attachments/audiofile/' . $value['product_audiofile']) : '';
					$j++;
				}
				// $data[$i]['ItemsList'] = $Items_List;
				// $data[$i]['Total'] = "$finalprice";
				$withdiscount = $this->IND_money_format(($finalprice - $discountamount) + $gstamount);
				$withoutdiscount = $this->IND_money_format($finalprice + $gstamount);
				$Mrp = $this->IND_money_format($finalprice);
				$data[$i]['ItemsList'] = $Items_List;
				$data[$i]['Total'] = "$Mrp";
				$data[$i]['WithDiscount'] = "$withdiscount";
				$data[$i]['WithoutDiscount'] = "$withoutdiscount";
				$i++;
			}
		}
		if (isset($_REQUEST['OrderType']) && $_REQUEST['OrderType'] == 'PhotoOrder' && isset($_REQUEST['Kyeword'])) {
			$this->db->select('photoordercreate.*, user_app.name as username, user_app.mobilenumber as Mobilenumber, user_app.businessname as businessname');
			// $this->db->where('photoordercreate.userid', $_REQUEST['UserId']);
			$this->db->join('user_app', 'user_app.id = photoordercreate.userid', 'inner');
			$this->db->like('photoordercreate.title', $_GET['Kyeword']);
			$this->db->or_like('photoordercreate.description', $_GET['Kyeword']);
			$this->db->or_like('photoordercreate.orderstatus', $_GET['Kyeword']);
			$this->db->or_like('user_app.name', $_GET['Kyeword']);
			$this->db->or_like('user_app.mobilenumber', $_GET['Kyeword']);
			$this->db->order_by("photoordercreate.id", "desc");
			$result = $this->db->get('photoordercreate');
			//echo $this->db->last_query(); exit;
			$row = $result->result_array();
			$data = [];
			$i = 0;
			foreach ($row as $key => $value) {
				$Addressship = unserialize(html_entity_decode($value['shiptoid']));
				$Addressbill = unserialize(html_entity_decode($value['billtoid']));
				$bussname = '';
				if (isset($value['businessname']) && $value['businessname'] != '') {$bussname = '(' . $value['businessname'] . ')';}
				$orderdate = date("d-m-Y", $value['datetime']);
				$data[$i]['OrderId'] = $value['id'];
				$data[$i]['UserId'] = $value['userid'];
				$data[$i]['Username'] = $value['username'] . ' ' . $bussname;
				$data[$i]['MobileNo'] = $value['Mobilenumber'];
				$data[$i]['Address'] = $value['address'];
				$data[$i]['TransportName'] = $value['transportname'];
				$data[$i]['Status'] = $value['orderstatus'];
				$data[$i]['Date'] = $orderdate;
				$data[$i]['Addressship'] = !empty($Addressship) ? $Addressship : array();
				$data[$i]['Addressbill'] = !empty($Addressbill) ? $Addressbill : array();
				$Items_List = [];
				$Items_List[0]['OrderId'] = $value['id'];
				$Items_List[0]['Image'] = !empty($value['orderphoto']) ? base_url('attachments/photoorder_images/' . $value['orderphoto']) : '';
				$Items_List[0]['Comment'] = $value['description'];
				$Items_List[0]['AudioFile'] = !empty($value['orderaudio']) ? base_url('attachments/audiofile/' . $value['orderaudio']) : '';
				$data[$i]['ItemsList'] = $Items_List;
				$i++;
			}
		}

		if (!empty($data) && isset($data)) {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item not Found';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	public function Updateorderstatusfun() {
		if (isset($_REQUEST['OrderId']) && isset($_REQUEST['Status']) && isset($_REQUEST['AdminId']) && $_REQUEST['Type'] == 'Order') {
			$id = $_REQUEST['OrderId'];
			$to_status = $_REQUEST['Status'];
			$this->db->join('user_app', 'user_app.id = orders.user_id', 'left');
			$this->db->where('orders.id', $id);
			$this->db->select('orders.user_id, orders.processed,user_app.fcmtoken');
			$result1 = $this->db->get('orders');
			$res = $result1->row_array();
			//notifications('Order Status is changed to ' . $to_status, 'Your Order ID : #' . $id, $res['fcmtoken']);
			$notidata['title'] = 'Order Status is changed to ' . $to_status;
			$notidata['description'] = 'Your Order ID : #' . $id;
			$notidata['orderid'] = $id;
			$notidata['userid'] = $res['user_id'];
			$notidata['ordertype'] = 'Normal Order';
			$notidata['dateandtime'] = time();
			$result_check = $this->db->insert('notificationdata', $notidata);
			$result = true;
			if ($res['processed'] != $to_status) {
				$adminid = $_REQUEST['AdminId'];
				$data['sender_id'] = $adminid;
				$data['receiver_id'] = $res['user_id'];
				$data['order_id'] = $id;
				$data['message'] = 'Order is shifted to ' . $to_status;
				$data['usertype'] = 'admin';
				$data['type'] = 'Normal Order';
				$data['time'] = time();
				$result_check = $this->db->insert('order_chatmessenger', $data);

				$this->db->where('id', $id);
				$result = $this->db->update('orders', array('processed' => $to_status));
			}
			if ($result == true) {
				$return['Data'] = 1;
				$return['Message'] = 'Data Get Successfully!';
				$return['IsSuccess'] = true;
			} else {
				$return['data'] = 0;
				$return['Message'] = 'Data Get Not Successfully.';
				$return['IsSuccess'] = false;
			}
		}

		if (isset($_REQUEST['OrderId']) && isset($_REQUEST['Status']) && isset($_REQUEST['AdminId']) && $_REQUEST['Type'] == 'PhotoOrder') {
			$id = $_REQUEST['OrderId'];
			$to_status = $_REQUEST['Status'];
			$this->db->join('user_app', 'user_app.id = photoordercreate.userid', 'left');
			$this->db->where('photoordercreate.id', $id);
			$this->db->select('photoordercreate.id,photoordercreate.userid,photoordercreate.orderstatus,user_app.fcmtoken');
			$result1 = $this->db->get('photoordercreate');
			$res = $result1->row_array();
			notifications('Order Status is changed to ' . $to_status, 'Your Order ID : #' . $id, $res['fcmtoken']);
			$notidata['title'] = 'Order Status is changed to ' . $to_status;
			$notidata['description'] = 'Your Order ID : #' . $id;
			$notidata['orderid'] = $id;
			$notidata['userid'] = $res['userid'];
			$notidata['ordertype'] = 'Direct Order';
			$notidata['dateandtime'] = time();
			$result_check = $this->db->insert('notificationdata', $notidata);
			$result = true;
			if ($res['orderstatus'] != $to_status) {
				$adminid = $_REQUEST['AdminId'];
				$data['sender_id'] = $adminid;
				$data['receiver_id'] = $res['userid'];
				$data['order_id'] = $id;
				$data['message'] = 'Order is shifted to ' . $to_status;
				$data['usertype'] = 'admin';
				$data['type'] = 'Direct Order';
				$data['time'] = time();
				$result_check = $this->db->insert('order_chatmessenger', $data);

				$this->db->where('id', $id);
				$result = $this->db->update('photoordercreate', array('orderstatus' => $to_status));
			}
			if ($result == true) {
				$return['Data'] = 1;
				$return['Message'] = 'Data Get Successfully!';
				$return['IsSuccess'] = true;
			} else {
				$return['data'] = 0;
				$return['Message'] = 'Data Get Not Successfully.';
				$return['IsSuccess'] = false;
			}
		}
		return $return;
	}
	public function Orderstatuslistfun() {
		$query = $this->db->select('*')->get('orderstatuslist');
		//echo $this->db->last_query();
		$result = $query->result_array();
		$data = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$data[$i]['Id'] = $value['id'];
			$data[$i]['Name'] = $value['name'];
			$i++;
		}
		if (!empty($data) && $data != '') {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['data'] = $data;
			$return['Message'] = 'Data Get Not Successfully.';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	public function sendordersmsgfunc() {
		$result_check = '';
		if (isset($_REQUEST['OrderId']) && isset($_REQUEST['AdminId']) && isset($_REQUEST['UserId']) && $_REQUEST['Type'] == 'Order') {
			$adminid = $_REQUEST['AdminId'];
			$data['sender_id'] = $adminid;
			$data['receiver_id'] = !empty($_REQUEST['UserId']) ? $_REQUEST['UserId'] : '';
			$data['order_id'] = !empty($_REQUEST['OrderId']) ? $_REQUEST['OrderId'] : '';
			$data['message'] = !empty($_REQUEST['Message']) ? $_REQUEST['Message'] : '';
			$data['usertype'] = 'admin';
			$data['type'] = 'Normal Order';
			$data['time'] = time();
			$result_check = $this->db->insert('order_chatmessenger', $data);
		}
		if (isset($_REQUEST['OrderId']) && isset($_REQUEST['AdminId']) && isset($_REQUEST['UserId']) && $_REQUEST['Type'] == 'PhotoOrder') {
			$adminid = $_REQUEST['AdminId'];
			$data['sender_id'] = $adminid;
			$data['receiver_id'] = !empty($_REQUEST['UserId']) ? $_REQUEST['UserId'] : '';
			$data['order_id'] = !empty($_REQUEST['OrderId']) ? $_REQUEST['OrderId'] : '';
			$data['message'] = !empty($_REQUEST['Message']) ? $_REQUEST['Message'] : '';
			$data['usertype'] = 'admin';
			$data['type'] = 'Direct Order';
			$data['time'] = time();
			$result_check = $this->db->insert('order_chatmessenger', $data);
		}
		if ($result_check == 1) {
			$return['Data'] = 1;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['data'] = 0;
			$return['Message'] = 'Data Get Not Successfully.';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	private function getOneProductForSerialize($id, $userid,$productType='') {
		
			$row = $this->db->get_where('user_app', array('id' => $userid))->row();
			if (($row->guest == 1) && ($productType=='box')) {
				$price = 'products.price1 as price';
			} elseif (($row->retailer == 1) && ($productType=='box')) {
				$price = 'products.price2 as price';
			} elseif (($row->wholesaller == 1) && ($productType=='box')) {
				$price = 'products.price3 as price';
			}
			elseif (($row->guest == 1) && ($productType=='theli')) {
				$price = 'products.theli_price1 as price';
			}
			elseif (($row->retailer == 1) && ($productType=='theli')) {
				$price = 'products.theli_price2 as price';
			}
			elseif (($row->wholesaller == 1) && ($productType=='theli')) {
				$price = 'products.theli_price3 as price';
			}
			else {
				$price = 'products.price1 as price';
			}
			$this->db->select('products.id,products.product_pcs,' . $price);
			$this->db->where('products.id', $id);			
			$query = $this->db->get('products');			
			if ($query->num_rows() > 0) {
				return $query->row_array();
			} else {
				return false;
			}
	}

	public function getpreProducts() {
		$this->db->join('pre_products_translations', 'pre_products_translations.for_id = pre_products.id', 'left');
		if (isset($_REQUEST['Page'])) {
			$offset = 10 * ($_REQUEST['Page'] - 1);
			$this->db->limit(10, $offset);
		}
		$query = $this->db->select('pre_products.id as Id, pre_products.image as product_image, pre_products.folder as imgfolder, pre_products.product_pcs as Pcs, pre_products_translations.title, pre_products_translations.price, pre_products_translations.old_price')->get('pre_products');
		//echo $this->db->last_query();
		$result = $query->result_array();
		$data = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$image_link = array();
			// $singalimg = $result[0]['product_image'];
			$image_link[0]['Image'] = !empty($value['product_image']) ? base_url('attachments/shop_images/' . $value['product_image']) : '';
			$multiimg = $value['imgfolder'];
			$multiimgarray = $this->productmultiimg($multiimg);

			$a = 1;
			foreach ($multiimgarray as $key => $values) {
				$image_link[$a]['Image'] = $values;
				$a++;
			}
			$Mrp = $this->IND_money_format($value['price']);
			$PcsMrp = $this->IND_money_format($value['price'] * $value['Pcs']);
			$data[$i]['Id'] = $value['Id'];
			$data[$i]['ItemName'] = $value['title'];
			$data[$i]['Mrp'] = $Mrp;
			$data[$i]['PcsMrp'] = $PcsMrp;
			$data[$i]['Pcs'] = $value['Pcs'];
			$data[$i]['Image'] = $image_link;
			$i++;
		}
		if (!empty($data) && $data != '') {
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['data'] = $data;
			$return['Message'] = 'Data Get Not Successfully.';
			$return['IsSuccess'] = false;
		}
		return $return;
		//return $query->result_array();
	}

	public function getpreProductsbyid($id) {
		$this->db->where('id', $_REQUEST['ItemId']);
		$this->db->set('view_count', 'view_count+1', FALSE);
		$this->db->update('pre_products');

		$this->db->join('pre_products_translations', 'pre_products_translations.for_id = pre_products.id', 'left');
		$this->db->where('pre_products.id', $id);
		$this->db->limit(1);
		$query = $this->db->select('pre_products.id as Id, pre_products.videoid as VideoID, pre_products_translations.title, pre_products.image as product_image, pre_products.folder as imgfolder, pre_products.product_type as Type, pre_products.product_pcs as Pcs, pre_products.min_qty as MinQty, pre_products.quantity as product_quantity_available, pre_products_translations.description, pre_products_translations.price, pre_products_translations.old_price, pre_products_translations.basic_description')->get('pre_products');
		$result = $query->result_array();

		$data = array();
		$image_link = array();
		$i = 0;
		$singalimg = $result[0]['product_image'];
		$without_extensionmain = substr($singalimg, 0, strrpos($singalimg, "."));
		$this->db->where('likepreproductimg.userid', $_REQUEST['UserId']);
		$this->db->where('likepreproductimg.imgname', $without_extensionmain);
		$queryliked = $this->db->select('likestatus')->get('likepreproductimg')->row();
		if (isset($queryliked->likestatus)) {$likestatus = $queryliked->likestatus;} else { $likestatus = '';}
		$image_link[0]['Image'] = !empty($singalimg) ? base_url('attachments/shop_images/' . $singalimg) : '';
		$image_link[0]['ImageName'] = $without_extensionmain;
		$image_link[0]['LikeStatus'] = $likestatus;
		$multiimg = $result[0]['imgfolder'];
		$multiimgarray = $this->productmultiimg($multiimg);

		$a = 1;
		foreach ($multiimgarray as $key => $value) {
			// print_r(explode("/", $value));
			$imgnameextension = str_replace(base_url('attachments/shop_images/' . $multiimg . '/'), "", $value);
			$without_extension = substr($imgnameextension, 0, strrpos($imgnameextension, "."));
			$this->db->where('likepreproductimg.userid', $_REQUEST['UserId']);
			$this->db->where('likepreproductimg.imgname', $without_extension);
			$querylikedi = $this->db->select('likestatus')->get('likepreproductimg')->row();
			if (isset($querylikedi->likestatus)) {$likestatus = $querylikedi->likestatus;} else { $likestatus = '';}
			$image_link[$a]['Image'] = $value;
			$image_link[$a]['ImageName'] = $without_extension;
			$image_link[$a]['LikeStatus'] = $likestatus;
			$a++;
		}

		//$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		//$this->db->join('shop_attribute_translations', 'shop_attribute_translations.for_id = product_attribute.productid', 'left');

		$this->db->where('product_attribute.preproductid', $_REQUEST['ItemId']);
		$queryatt = $this->db->select('product_attribute.*')->get('product_attribute');
		$resultatt = $queryatt->result_array();
		$Attribute = array();
		foreach ($resultatt as $key => $value) {
			$Attribute[$key]['Text'] = $this->attributename($value['keyid']);
			$Attribute[$key]['Value'] = $this->attributename($value['valueid']);
		}
		// echo '<pre>';
		// print_r($Attribute);
		foreach ($result as $key => $value) {

			$this->db->select('*');
			$this->db->from('likepreproduct');
			$this->db->where('likepreproduct.userid', $_REQUEST['UserId']);
			$this->db->where('likepreproduct.productid', $_REQUEST['ItemId']);
			$query = $this->db->get();
			$isincart = "";
			if ($query->num_rows() > 0) {
				$ret = $query->row();
				$isincart = $ret->likestatus;}
			$Mrp = $this->IND_money_format($value['price']);
			$PcsMrp = $this->IND_money_format($value['price'] * $value['Pcs']);
			$data[$i]['Id'] = $value['Id'];
			$data[$i]['ItemName'] = $value['title'];
			$data[$i]['Description'] = $value['description'];
			$data[$i]['Type'] = $value['Type'];
			$data[$i]['Mrp'] = $Mrp;
			$data[$i]['PcsMrp'] = $PcsMrp;
			$data[$i]['Pcs'] = $value['Pcs'];
			$data[$i]['MinQty'] = $value['MinQty'];
			$data[$i]['VideoID'] = $value['VideoID'];
			$data[$i]['Status'] = $isincart;
			$data[$i]['Images'] = $image_link;
			$data[$i]['Attribute'] = $Attribute;
			$i++;
		}
		if (!empty($data) && $data != '') {
			//$this->addrecentviewuser($_REQUEST['UserId'],$id);
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['data'] = $data;
			$return['Message'] = 'Data Get Not Successfully.';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function likepreproductadd() {
		$string = '';
		if (isset($_REQUEST['UserId']) && isset($_REQUEST['ItemId']) && isset($_REQUEST['Status'])) {
			$data = array(
				'userid' => $_REQUEST['UserId'],
				'productid' => $_REQUEST['ItemId'],
				'likestatus' => $_REQUEST['Status'],
			);
			$this->db->insert('likepreproduct', $data);
			$string = 1;
		}
		if (!empty($string) && $string != '') {
			$return['Data'] = 1;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item Not Found';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function likepreproductimgadd() {
		$string = '';
		if (isset($_REQUEST['UserId']) && isset($_REQUEST['ImgName']) && isset($_REQUEST['Status'])) {
			$this->db->where('likepreproductimg.imgname', $_REQUEST['ImgName']);
			$this->db->where('likepreproductimg.userid', $_REQUEST['UserId']);
			$querylikedi = $this->db->select('*')->get('likepreproductimg')->num_rows();

			if ($querylikedi > 0) {
				$this->db->where('likepreproductimg.imgname', $_REQUEST['ImgName']);
				$this->db->where('likepreproductimg.userid', $_REQUEST['UserId']);
				$this->db->update('likepreproductimg', array('likestatus' => $_REQUEST['Status']));
				$string = 1;
			} else {
				$data = array(
					'userid' => $_REQUEST['UserId'],
					'imgname' => $_REQUEST['ImgName'],
					'likestatus' => $_REQUEST['Status'],
				);
				$this->db->insert('likepreproductimg', $data);
				$string = 1;
			}
		}
		if (!empty($string) && $string != '') {
			$return['Data'] = 1;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item Not Found';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function LikeProductImgsadd() {
		$string = '';
		if (isset($_REQUEST['UserId']) && isset($_REQUEST['ImgName']) && isset($_REQUEST['Status'])) {
			$this->db->where('likeproductimg.imgname', $_REQUEST['ImgName']);
			$this->db->where('likeproductimg.userid', $_REQUEST['UserId']);
			$querylikedi = $this->db->select('*')->get('likeproductimg')->num_rows();
			if ($querylikedi > 0) {
				$this->db->where('likeproductimg.imgname', $_REQUEST['ImgName']);
				$this->db->where('likeproductimg.userid', $_REQUEST['UserId']);
				$this->db->update('likeproductimg', array('likestatus' => $_REQUEST['Status']));
				$string = 1;
			} else {
				$data = array(
					'userid' => $_REQUEST['UserId'],
					'imgname' => $_REQUEST['ImgName'],
					'likestatus' => $_REQUEST['Status'],
				);
				$this->db->insert('likeproductimg', $data);
				$string = 1;
			}
		}
		if (!empty($string) && $string != '') {
			$return['Data'] = 1;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item Not Found';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function MessangerListFun() {
		$data = array();
		if (isset($_REQUEST['UserId']) && $_REQUEST['UserId'] != '') {
			$this->db->where('receiver_id', $_REQUEST['UserId']);
			$this->db->where('wpn_chatmessenger.usertype ', 'admin');
			$this->db->update('wpn_chatmessenger', array('read_status' => 1));
			$where = '(sender_id="' . $_REQUEST['UserId'] . '" or receiver_id = "' . $_REQUEST['UserId'] . '")';
			$this->db->where($where);
			$query = $this->db->select('*')->get('wpn_chatmessenger');
			$this->db->last_query();
			$result = $query->result_array();
			$data = array();
			$i = 0;
			foreach ($result as $key => $value) {
				$data[$i]['Id'] = $value['id'];
				$data[$i]['SenderId'] = $value['sender_id'];
				$data[$i]['ReceiverId'] = $value['receiver_id'];
				$data[$i]['Usertype'] = $value['usertype'];
				$data[$i]['Message'] = isset($value['message']) ? $value['message'] : '';
				$data[$i]['AudioFile'] = !empty($value['audiofile']) ? base_url('attachments/audiofile/' . $value['audiofile']) : '';
				$i++;
			}
		}

		if ($data) {

			$return['Data'] = $data;

			$return['Message'] = 'Message Sent Successfully!';

			$return['IsSuccess'] = true;

		} else {

			$return['Data'] = 0;

			$return['Message'] = 'Message Not Successfully Sent';

			$return['IsSuccess'] = false;

		}

		return $return;

	}

	public function SendMessageFun() {
		$audiofile = '';
		if (isset($_FILES['Audiofile'])) {
			$new_name = time() . '_' . $_FILES['Audiofile']['name'];
			$path = $_SERVER['DOCUMENT_ROOT'] . '/attachments/audiofile/' . $new_name;
			move_uploaded_file($_FILES['Audiofile']['tmp_name'], $path);
			$audiofile = $new_name;
		}
		$data['sender_id'] = !empty($_POST['UserId']) ? $_POST['UserId'] : '';
		$data['receiver_id'] = 1;
		$data['message'] = !empty($_POST['Message']) ? $_POST['Message'] : '';
		$data['audiofile'] = !empty($audiofile) ? $audiofile : '';
		$data['userid'] = !empty($_POST['UserId']) ? $_POST['UserId'] : '';
		$data['timeanddate'] = time();
		$result_check = $this->db->insert('wpn_chatmessenger', $data);

		if (isset($audiofile) && $audiofile != '') {$data = base_url('attachments/audiofile/' . $audiofile);} else { $data = 1;}

		if ($result_check) {

			$return['Data'] = $data;

			$return['Message'] = 'Message Sent Successfully!';

			$return['IsSuccess'] = true;

		} else {

			$return['Data'] = 0;

			$return['Message'] = 'Message Not Successfully Sent';

			$return['IsSuccess'] = false;

		}

		return $return;

	}

	public function OrderMessangerListFun() {
		$where = '(sender_id="' . $_REQUEST['UserId'] . '" or receiver_id = "' . $_REQUEST['UserId'] . '") AND order_id = "' . $_REQUEST['OrderId'] . '" AND type = "' . $_REQUEST['type'] . '"';
		$this->db->where($where);
		$query = $this->db->select('*')->get('order_chatmessenger');
		$this->db->last_query();
		$result = $query->result_array();
		$data = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$namemsg = '';
			if ($value['usertype'] == 'admin') {
				$test = $this->db->select('*')->where('id', $value['sender_id'])->get('users')->row();
				$namemsg = $test->username . ' (admin)';
			}
			$data[$i]['Id'] = $value['id'];
			$data[$i]['SenderId'] = $value['sender_id'];
			$data[$i]['ReceiverId'] = $value['receiver_id'];
			$data[$i]['Usertype'] = $value['usertype'];
			$data[$i]['Name'] = $namemsg;
			$data[$i]['Message'] = isset($value['message']) ? $value['message'] : '';
			$i++;
		}
		if ($data) {
			$return['Data'] = $data;
			$return['Message'] = 'Message Found Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = $data;
			$return['Message'] = 'Message Not Found';
			$return['IsSuccess'] = true;
		}
		return $return;

	}

	public function OrderSendMessageFun() {

		$data['sender_id'] = !empty($_POST['UserId']) ? $_POST['UserId'] : '';
		$data['receiver_id'] = 1;
		$data['order_id'] = !empty($_POST['OrderId']) ? $_POST['OrderId'] : '';
		$data['message'] = !empty($_POST['Message']) ? $_POST['Message'] : '';
		$data['type'] = !empty($_POST['type']) ? $_POST['type'] : '';
		$data['time'] = time();
		$result_check = $this->db->insert('order_chatmessenger', $data);
		if ($result_check) {
			$return['Data'] = 1;
			$return['Message'] = 'Message Sent Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Message Not Successfully Sent';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	/*public function MessangerListFun() {
			$where = '(sender_id="' . $_REQUEST['UserId'] . '" or receiver_id = "' . $_REQUEST['UserId'] . '")';
			$this->db->where($where);
			$query = $this->db->select('*')->get('wpn_chatmessenger');
			$this->db->last_query();
			$result = $query->result_array();
			$data = array();
			$i = 0;
			foreach ($result as $key => $value) {
				$data[$i]['Id'] = $value['id'];
				$data[$i]['SenderId'] = $value['sender_id'];
				$data[$i]['ReceiverId'] = $value['receiver_id'];
				$data[$i]['Message'] = isset($value['message']) ? $value['message'] : '';
				$data[$i]['AudioFile'] = !empty($value['audiofile']) ? base_url('attachments/audiofile/' . $value['audiofile']) : '';
				$i++;
			}

			if ($data) {

				$return['Data'] = $data;

				$return['Message'] = 'Message Sent Successfully!';

				$return['IsSuccess'] = true;

			} else {

				$return['Data'] = 0;

				$return['Message'] = 'Message Not Successfully Sent';

				$return['IsSuccess'] = false;

			}

			return $return;

		}

		public function SendMessageFun() {
			$audiofile = '';
			if (isset($_FILES['Audiofile'])) {
				$new_name = time() . '_' . $_FILES['Audiofile']['name'];
				$path = $_SERVER['DOCUMENT_ROOT'] . '/attachments/audiofile/' . $new_name;
				move_uploaded_file($_FILES['Audiofile']['tmp_name'], $path);
				$audiofile = $new_name;
			}
			$data['sender_id'] = !empty($_POST['UserId']) ? $_POST['UserId'] : '';
			$data['receiver_id'] = 1;
			$data['message'] = !empty($_POST['Message']) ? $_POST['Message'] : '';
			$data['audiofile'] = !empty($audiofile) ? $audiofile : '';
			$data['userid'] = !empty($_POST['UserId']) ? $_POST['UserId'] : '';
			$data['timeanddate'] = time();
			$result_check = $this->db->insert('wpn_chatmessenger', $data);

			if (isset($audiofile) && $audiofile != '') {$data = base_url('attachments/audiofile/' . $audiofile);} else { $data = 1;}

			if ($result_check) {

				$return['Data'] = $data;

				$return['Message'] = 'Message Sent Successfully!';

				$return['IsSuccess'] = true;

			} else {

				$return['Data'] = 0;

				$return['Message'] = 'Message Not Successfully Sent';

				$return['IsSuccess'] = false;

			}

			return $return;

		}

		public function OrderMessangerListFun() {
			$where = '(sender_id="' . $_REQUEST['UserId'] . '" or receiver_id = "' . $_REQUEST['UserId'] . '") AND order_id = "' . $_REQUEST['OrderId'] . '" AND type = "' . $_REQUEST['type'] . '"';
			$this->db->where($where);
			$query = $this->db->select('*')->get('order_chatmessenger');
			$this->db->last_query();
			$result = $query->result_array();
			$data = array();
			$i = 0;
			foreach ($result as $key => $value) {
				$data[$i]['Id'] = $value['id'];
				$data[$i]['SenderId'] = $value['sender_id'];
				$data[$i]['ReceiverId'] = $value['receiver_id'];
				$data[$i]['Message'] = isset($value['message']) ? $value['message'] : '';
				$i++;
			}
			if ($data) {
				$return['Data'] = $data;
				$return['Message'] = 'Message Sent Successfully!';
				$return['IsSuccess'] = true;
			} else {
				$return['Data'] = 0;
				$return['Message'] = 'Message Not Successfully Sent';
				$return['IsSuccess'] = false;
			}
			return $return;

		}

		public function OrderSendMessageFun() {

			$data['sender_id'] = !empty($_POST['UserId']) ? $_POST['UserId'] : '';
			$data['receiver_id'] = 1;
			$data['order_id'] = !empty($_POST['OrderId']) ? $_POST['OrderId'] : '';
			$data['message'] = !empty($_POST['Message']) ? $_POST['Message'] : '';
			$data['type'] = !empty($_POST['type']) ? $_POST['type'] : '';
			$data['time'] = time();
			$result_check = $this->db->insert('order_chatmessenger', $data);
			if ($result_check) {
				$return['Data'] = 1;
				$return['Message'] = 'Message Sent Successfully!';
				$return['IsSuccess'] = true;
			} else {
				$return['Data'] = 0;
				$return['Message'] = 'Message Not Successfully Sent';
				$return['IsSuccess'] = false;
			}
			return $return;
	*/
	public function Dashboardcountfun() {
		$data = [];
		$date = date_create(date('d-m-Y'));
		date_sub($date, date_interval_create_from_date_string("0 Day"));
		$time2start = strtotime(date_format($date, "Y-m-d"));
		$this->db->where('orders.date >', $time2start);
		$query = $this->db->select('SUM(orders.finaltotal) AS todaysales')->get('orders');
		$this->db->last_query();
		$row = $query->row_array();
		$data[0]['todaysales'] = $row['todaysales'];

		list($start_date, $end_date) = $this->x_week_range(date('Y-m-d'));
		$start_date = strtotime($start_date);
		$end_date = strtotime($end_date);
		//date_sub($date,date_interval_create_from_date_string("1 WEEK"));
		//$time2start = strtotime(date_format($date,"Y-m-d"));
		//$this->db->where('orders.date >', $time2start);
		$this->db->where('date BETWEEN "' . $start_date . '" and "' . $end_date . '"');
		$query = $this->db->select('SUM(orders.finaltotal) AS weeksales')->get('orders');
		$this->db->last_query();
		$row = $query->row_array();
		$data[0]['weeksales'] = $row['weeksales'];
		$this->db->group_by('user_id');
		$query = $this->db->select('COUNT(*) as usercount')->get('orders');
		$this->db->last_query();
		$num = $query->num_rows();
		$data[0]['topcustomer'] = $num;

		$this->db->group_by('userid');
		$where = '(orders.order_id IS NULL OR orders.order_id = "")';
		$this->db->where($where);
		$this->db->join('orders', 'orders.user_id = user_app.id', 'left');
		$query = $this->db->select('user_app.id as userid, orders.order_id')->get('user_app');
		$this->db->last_query();
		$num = $query->num_rows();
		$data[0]['bottomcustomer'] = $num;

		if ($data) {
			$return['Data'] = $data;
			$return['Message'] = 'Message Sent Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Message Not Successfully Sent';
			$return['IsSuccess'] = false;
		}
		return $return;

	}

	public function x_week_range($date) {
		$ts = strtotime($date);
		$start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
		return array(date('Y-m-d', $start),
			date('Y-m-d', strtotime('next saturday', $start)));
	}

	/*public function Topcustomerfun() {
		if (isset($_REQUEST['Page'])) {
			$offset = 10 * ($_REQUEST['Page'] - 1);
			$this->db->limit(10, $offset);
		} else {
			$this->db->limit(10, 0);
		}
		$this->db->order_by('finaltotal', 'DESC');
		$this->db->group_by('user_id');
		$this->db->join('user_app', 'user_app.id = orders.user_id', 'left');
		$query = $this->db->select('SUM(finaltotal) as finaltotal ,user_id as usercount ,name')->get('orders');
		$result = $query->result_array();
		$data = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$data[$i]['Finaltotal'] = $value['finaltotal'];
			$data[$i]['Name'] = $value['name'];
			$i++;
		}
		if ($data) {
			$return['Data'] = $data;
			$return['Message'] = 'Result Sent Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Result Not Successfully Sent';
			$return['IsSuccess'] = false;
		}
		return $return;

	}*/

	public function Topcustomerfun() {
		if (isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'Topcustomer') {
			if (isset($_REQUEST['Page'])) {
				$offset = 7 * ($_REQUEST['Page'] - 1);
				$this->db->limit(7, $offset);
			}
			//  else {
			// 	$this->db->limit(7, 0);
			// }
			$this->db->order_by('finaltotal', 'DESC');
			$this->db->group_by('user_id');
			$this->db->join('user_app', 'user_app.id = orders.user_id', 'left');
			$query = $this->db->select("(SELECT COUNT(*) FROM wpn_chatmessenger WHERE wpn_chatmessenger.read_status=0 AND wpn_chatmessenger.usertype != 'admin' AND wpn_chatmessenger.sender_id=user_app.id) AS readstatus,SUM(finaltotal) as finaltotal ,user_id as usercount ,name,`user_app`.`isverified`,`user_app`.`businessname`")->get('orders');
			$result = $query->result_array();
			// echo $this->db->last_query();

			$data = array();
			$i = 0;
			foreach ($result as $key => $value) {
				//print_r($value);
				$Mrp = $this->IND_money_format($value['finaltotal']);
				$data[$i]['Id'] = $value['usercount'];
				$data[$i]['Name'] = $value['name'] . ' ' . $value['businessname'];
				$data[$i]['Status'] = $value['isverified'];
				$data[$i]['Count'] = $Mrp;
				$data[$i]['UnreadCount'] = $value['readstatus'];
				$i++;
			}
			if ($data) {
				$return['Data'] = $data;
				$return['Message'] = 'Result Sent Successfully!';
				$return['IsSuccess'] = true;
			} else {
				$return['Data'] = 0;
				$return['Message'] = 'Result Not Successfully Sent';
				$return['IsSuccess'] = false;
			}
			return $return;
		} elseif (isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'Bottomcustomer') {
			if (isset($_REQUEST['Page'])) {
				$offset = 7 * ($_REQUEST['Page'] - 1);
				$this->db->limit(7, $offset);
			}
			$this->db->group_by('userid');
			$where = '(orders.order_id IS NULL OR orders.order_id = "")';
			$this->db->where($where);
			$this->db->join('orders', 'orders.user_id = user_app.id', 'left');
			$query = $this->db->select("(SELECT COUNT(*) FROM wpn_chatmessenger WHERE wpn_chatmessenger.read_status=0 AND wpn_chatmessenger.usertype != 'admin' AND wpn_chatmessenger.sender_id=user_app.id) AS readstatus, user_app.id as userid, orders.order_id, `user_app`.`name`,`user_app`.`isverified`, `user_app`.`businessname`")->get('user_app');
			$this->db->last_query();
			$result = $query->result_array();

			$data = array();
			$i = 0;
			foreach ($result as $key => $value) {
				$data[$i]['Id'] = $value['userid'];
				$data[$i]['Name'] = $value['name'] . ' ' . $value['businessname'];
				$data[$i]['Status'] = $value['isverified'];
				$data[$i]['UnreadCount'] = $value['readstatus'];
				$i++;
			}
			if ($data) {
				$return['Data'] = $data;
				$return['Message'] = 'Result Sent Successfully!';
				$return['IsSuccess'] = true;
			} else {
				$return['Data'] = 0;
				$return['Message'] = 'Result Not Successfully Sent';
				$return['IsSuccess'] = false;
			}
			return $return;
		} elseif (isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'Changedevice') {
			if (isset($_REQUEST['Page'])) {
				$offset = 7 * ($_REQUEST['Page'] - 1);
				$this->db->limit(7, $offset);
			}
			$this->db->order_by('user_app.devicecount', 'DESC');
			$query = $this->db->select("(SELECT COUNT(*) FROM wpn_chatmessenger WHERE wpn_chatmessenger.read_status=0 AND wpn_chatmessenger.usertype != 'admin' AND wpn_chatmessenger.sender_id=user_app.id) AS readstatus, user_app.id as userid,`user_app`.`name`,`user_app`.`isverified`, `user_app`.`devicecount`,`user_app`.`businessname`")->get('user_app');
			$this->db->last_query();
			$result = $query->result_array();

			$data = array();
			$i = 0;
			foreach ($result as $key => $value) {
				$data[$i]['Id'] = $value['userid'];
				$data[$i]['Name'] = $value['name'] . ' ' . $value['businessname'];
				$data[$i]['Count'] = $value['devicecount'];
				$data[$i]['Status'] = $value['isverified'];
				$data[$i]['UnreadCount'] = $value['readstatus'];
				$i++;
			}
			if ($data) {
				$return['Data'] = $data;
				$return['Message'] = 'Result Sent Successfully!';
				$return['IsSuccess'] = true;
			} else {
				$return['Data'] = 0;
				$return['Message'] = 'Result Not Successfully Sent';
				$return['IsSuccess'] = false;
			}
			return $return;
		} elseif (isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'All') {
			if (isset($_REQUEST['Page'])) {
				$offset = 7 * ($_REQUEST['Page'] - 1);
				$this->db->limit(7, $offset);
			}
			$this->db->order_by('user_app.id', 'DESC');
			$this->db->where('`user_app`.`isverified` !=', '0');
			$query = $this->db->select("(SELECT COUNT(*) FROM wpn_chatmessenger WHERE wpn_chatmessenger.read_status=0 AND wpn_chatmessenger.usertype != 'admin' AND wpn_chatmessenger.sender_id=user_app.id) AS readstatus, user_app.id as userid,`user_app`.`name`,`user_app`.`isverified`, `user_app`.`devicecount`,`user_app`.`businessname`")->get('user_app');
			// echo $this->db->last_query();
			$result = $query->result_array();

			$data = array();
			$i = 0;
			foreach ($result as $key => $value) {
				$data[$i]['Id'] = $value['userid'];
				$data[$i]['Name'] = $value['name'] . ' ' . $value['businessname'];
				$data[$i]['Status'] = $value['isverified'];
				$data[$i]['UnreadCount'] = $value['readstatus'];
				$i++;
			}
			if ($data) {
				$return['Data'] = $data;
				$return['Message'] = 'Result Sent Successfully!';
				$return['IsSuccess'] = true;
			} else {
				$return['Data'] = 0;
				$return['Message'] = 'Result Not Successfully Sent';
				$return['IsSuccess'] = false;
			}
			return $return;
		} elseif (isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'Active') {
			if (isset($_REQUEST['Page'])) {
				$offset = 7 * ($_REQUEST['Page'] - 1);
				$this->db->limit(7, $offset);
			}
			$this->db->where('`user_app`.`isverified`', 'true');
			$this->db->order_by('user_app.id', 'DESC');
			$query = $this->db->select("(SELECT COUNT(*) FROM wpn_chatmessenger WHERE wpn_chatmessenger.read_status=0 AND wpn_chatmessenger.usertype != 'admin' AND wpn_chatmessenger.sender_id=user_app.id) AS readstatus, user_app.id as userid,`user_app`.`name`,`user_app`.`isverified`, `user_app`.`devicecount`,`user_app`.`businessname`")->get('user_app');
			// echo $this->db->last_query();
			$result = $query->result_array();

			$data = array();
			$i = 0;
			foreach ($result as $key => $value) {
				$data[$i]['Id'] = $value['userid'];
				$data[$i]['Name'] = $value['name'] . ' ' . $value['businessname'];
				$data[$i]['Status'] = $value['isverified'];
				$data[$i]['UnreadCount'] = $value['readstatus'];
				$i++;
			}
			if ($data) {
				$return['Data'] = $data;
				$return['Message'] = 'Result Sent Successfully!';
				$return['IsSuccess'] = true;
			} else {
				$return['Data'] = 0;
				$return['Message'] = 'Result Not Successfully Sent';
				$return['IsSuccess'] = false;
			}
			return $return;
		} elseif (isset($_REQUEST['Type']) && $_REQUEST['Type'] == 'Deactive') {
			if (isset($_REQUEST['Page'])) {
				$offset = 7 * ($_REQUEST['Page'] - 1);
				$this->db->limit(7, $offset);
			}
			$this->db->where('`user_app`.`isverified`', 'false');
			$this->db->order_by('user_app.id', 'DESC');
			$query = $this->db->select("(SELECT COUNT(*) FROM wpn_chatmessenger WHERE wpn_chatmessenger.read_status=0 AND wpn_chatmessenger.usertype != 'admin' AND wpn_chatmessenger.sender_id=user_app.id) AS readstatus, user_app.id as userid,`user_app`.`name`,`user_app`.`isverified`, `user_app`.`devicecount`,`user_app`.`businessname`")->get('user_app');
			// echo $this->db->last_query();
			$result = $query->result_array();

			$data = array();
			$i = 0;
			foreach ($result as $key => $value) {
				$data[$i]['Id'] = $value['userid'];
				$data[$i]['Name'] = $value['name'] . ' ' . $value['businessname'];
				$data[$i]['Status'] = $value['isverified'];
				$data[$i]['UnreadCount'] = $value['readstatus'];
				$i++;
			}
			if ($data) {
				$return['Data'] = $data;
				$return['Message'] = 'Result Sent Successfully!';
				$return['IsSuccess'] = true;
			} else {
				$return['Data'] = 0;
				$return['Message'] = 'Result Not Successfully Sent';
				$return['IsSuccess'] = false;
			}
			return $return;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Result Not Successfully Sent';
			$return['IsSuccess'] = false;
		}
	}

	public function CustomerPendinglistfun() {
		if (isset($_REQUEST['Page'])) {
			$offset = 15 * ($_REQUEST['Page'] - 1);
			$this->db->limit(15, $offset);
		} else {
			$this->db->limit(15, 0);
		}
		$this->db->where('isverified', '0');
		$query = $this->db->select('*')->get('user_app');
		$result = $query->result_array();
		$data = array();
		$i = 0;
		foreach ($result as $key => $value) {
			//print_r($value);
			$data[$i]['Id'] = $value['id'];
			$data[$i]['Name'] = $value['name'] . ' ' . $value['businessname'];
			$data[$i]['MobileNo'] = $value['mobilenumber'];
			$data[$i]['EmailId'] = $value['emailid'];
			$data[$i]['Address'] = $value['address'];
			$data[$i]['BusinessName'] = $value['businessname'];
			$data[$i]['GSTNo'] = $value['gstin'];
			$data[$i]['Image'] = !empty($value['profileimg']) ? base_url('attachments/userprofile_images/' . $value['profileimg']) : '';
			$data[$i]['IsSelected'] = false;
			$i++;
		}
		if ($data) {
			$return['Data'] = $data;
			$return['Message'] = 'Result Sent Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = $data;
			$return['Message'] = 'Result Not Successfully Sent';
			$return['IsSuccess'] = true;
		}
		return $return;
	}
	public function CustomerPendingApprovalFun() {
		$data = '';
		if (isset($_REQUEST['UserId']) && !empty($_REQUEST['UserId'])) {
			foreach ($_REQUEST['UserId'] as $value) {
				if ($value['PremiumUser'] == 'true') {$premiumuser = 1;} else { $premiumuser = 0;}
				if ($value['Coupon'] == 'true') {$coupan = 1;} else { $coupan = 0;}
				if ($value['Credit'] == 'true') {$credit = 1;} else { $credit = 0;}
				if ($value['GuestUser'] == 'true') {$GuestUser = 1;} else { $GuestUser = 0;}
				if ($value['Status'] == 'true') {
					$Status = 'true';
					$this->sendactiveusersms($value['UserId']);
				} else {
					$Status = 'false';
					$dataup1['smsflg'] = '0';
					$this->db->where('id', $value['UserId']);
					$this->db->update('user_app', $dataup1);
				}
				$dataup['isverified'] = $Status;
				$dataup['premiumuser'] = $premiumuser;
				$dataup['credit'] = $credit;
				$dataup['coupan'] = $coupan;
				$dataup['approvedby'] = $_REQUEST['AdminId'];
				$dataup['userprice'] = $value['Price'];
				$dataup['guestuser'] = $GuestUser;
				$this->db->where('id', $value['UserId']);
				$this->db->update('user_app', $dataup);
			}
			$data = 1;
		}
		if (isset($data) && $data != '') {
			$return['Data'] = $data;
			$return['Message'] = 'Update Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Update Not Successfully';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function SenduserMessageFun() {
		$audiofile = '';
		if (isset($_FILES['Audiofile'])) {
			$new_name = time() . '_' . $_FILES['Audiofile']['name'];
			$path = $_SERVER['DOCUMENT_ROOT'] . '/attachments/audiofile/' . $new_name;
			move_uploaded_file($_FILES['Audiofile']['tmp_name'], $path);
			$audiofile = $new_name;
		}
		$data['sender_id'] = !empty($_POST['AdminId']) ? $_POST['AdminId'] : '';
		$data['receiver_id'] = !empty($_POST['UserId']) ? $_POST['UserId'] : '';
		$data['message'] = !empty($_POST['Message']) ? $_POST['Message'] : '';
		$data['audiofile'] = !empty($audiofile) ? $audiofile : '';
		$data['usertype'] = 'admin';

		if (isset($_POST['AdminId']) && isset($_POST['UserId']) && isset($_POST['Message'])) {
			$result_check = $this->db->insert('wpn_chatmessenger', $data);

			if (isset($audiofile) && $audiofile != '') {$data = base_url('attachments/audiofile/' . $audiofile);} else { $data = 1;}

			$return['Data'] = $data;

			$return['Message'] = 'Message Sent Successfully!';

			$return['IsSuccess'] = true;

		} else {

			$return['Data'] = 0;

			$return['Message'] = 'Message Not Successfully Sent';

			$return['IsSuccess'] = false;

		}

		return $return;

	}
	public function Bottomcustomerfun() {
		if (isset($_REQUEST['Page'])) {
			$offset = 10 * ($_REQUEST['Page'] - 1);
			$this->db->limit(10, $offset);
		} else {
			$this->db->limit(10, 0);
		}
		$this->db->group_by('userid');
		$where = '(orders.order_id IS NULL OR orders.order_id = "")';
		$this->db->where($where);
		$this->db->join('orders', 'orders.user_id = user_app.id', 'left');
		$query = $this->db->select('user_app.id as userid, orders.order_id, `user_app`.`name`')->get('user_app');
		$this->db->last_query();

		$result = $query->result_array();
		$data = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$data[$i]['Name'] = $value['name'];
			$i++;
		}
		if ($data) {
			$return['Data'] = $data;
			$return['Message'] = 'Result Sent Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Result Not Successfully Sent';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function Notificationdatafun() {
		$this->db->limit(10, 0);
		$this->db->order_by('id', 'DESC');
		$this->db->where('userid', $_REQUEST['UserId']);
		$query = $this->db->select('*')->get('notificationdata');
		$this->db->last_query();
		$result = $query->result_array();
		$data = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$orderdata = $this->GetOrderBynotificationfun($value['ordertype'], $_REQUEST['UserId'], $value['orderid']);
			$data[$i]['Title'] = $value['title'];
			$data[$i]['Message'] = $value['description'];
			$data[$i]['Productid'] = $value['productid'];
			$data[$i]['Orderid'] = $value['orderid'];
			$data[$i]['Type'] = $value['ordertype'];
			$data[$i]['Date'] = date('d-m-Y', $value['dateandtime']);
			$data[$i]['Data'] = $orderdata;
			$i++;
		}
		if ($data) {
			$return['Data'] = $data;
			$return['Message'] = 'Result Sent Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Result Not Successfully Sent';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function AdminLoginDetails() {
		$data = array();
		$arr = array(
			'mobilenumber' => !empty($_REQUEST['Mobilenumber']) ? $_REQUEST['Mobilenumber'] : '',
			'password' => !empty($_REQUEST['Password']) ? md5($_REQUEST['Password']) : '',
		);
		$this->db->where($arr);
		$result = $this->db->get('users');
		// echo $this->db->last_query();
		$resultArray = $result->row_array();
		$i = 0;
		if ($result->num_rows() > 0) {
			if (!empty($_REQUEST['FCMToken'])) {
				$dataup['fcmtoken'] = $_REQUEST['FCMToken'];
				$this->db->where('users.id', $resultArray['id']);
				$this->db->update('users', $dataup);
			}
			$data[$i]['Id'] = $resultArray['id'];
			$data[$i]['Name'] = $resultArray['username'];
			$i++;
			$return['Data'] = $data;
			$return['Message'] = 'Data Get Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Data Get Not Successfully!';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function GetOrderBynotificationfun($ordertype, $userid, $orderid) {

		if (isset($ordertype) && $ordertype == 'Normal Order') {
			$this->db->select('orders.*, orders_clients.first_name,orders_clients.shiptoid,orders_clients.billtoid,'
				. ' orders_clients.last_name, orders_clients.email, orders_clients.phone, '
				. 'orders_clients.address, orders_clients.city, orders_clients.post_code,'
				. ' orders_clients.notes');
			$this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner');
			$this->db->where('orders.id', $orderid);
			$this->db->where('orders.user_id', $userid);
			$this->db->order_by("orders.id", "desc");
			$result = $this->db->get('orders');
			$row = $result->result_array();
			$data = [];
			$i = 0;
			foreach ($row as $key => $value) {
				$Addressship = unserialize(html_entity_decode($value['shiptoid']));
				$Addressbill = unserialize(html_entity_decode($value['billtoid']));
				$orderid = $value['id'];
				$statust = '';
				$data[$i]['Id'] = $orderid;
				$data[$i]['Address'] = $value['address'];
				// $data[$i]['TransportName'] = $value['notes'];
				$data[$i]['UserId'] = $value['user_id'];
				$data[$i]['Status'] = $value['processed'];
				$data[$i]['Description'] = $value['description'];
				$data[$i]['PaymentType'] = $value['payment_type'];
				$data[$i]['TransactionId'] = $value['transactionid'];
				$data[$i]['DiscountAmount'] = $this->IND_money_format($value['discountamount']);
				$data[$i]['GSTAmount'] = $this->IND_money_format($value['gstamount']);
				$data[$i]['AudioFile'] = !empty($value['orderaudio']) ? base_url('attachments/audiofile/' . $value['orderaudio']) : '';
				$data[$i]['Addressship'] = $Addressship;
				$data[$i]['Addressbill'] = $Addressbill;
				$data[$i]['Date'] = date('d.M.Y', $value['date']);
				$data[$i]['NewDate'] = date('d-m-Y', $value['date']);
				$discountamount = $value['discountamount'];

				$productsdec = unserialize(html_entity_decode($value['products']));
				$j = 0;
				$finalprice = 0;
				$Items_List = [];
				foreach ($productsdec as $key => $value) {

					$productsingalimg = '';
					$productinfo = $value['product_info'];
					$productsingalimg = $this->productmultiimg($productinfo['folder'], 1);
					$productprice = ($value['product_quantity'] * $productinfo['product_pcs']) * $productinfo['price'];
					$Mrp = $this->IND_money_format($productinfo['price']);
					$finalprice = $finalprice + $productprice;
					/*$subtotal = $value['product_quantity'] * $productinfo['price'];*/
					$Items_List[$j]['OrderId'] = $orderid;
					$Items_List[$j]['ItemId'] = $productinfo['id'];
					$Items_List[$j]['ItemName'] = $productinfo['title'];
					/*$Items_List[$j]['Qty'] = $productinfo['price'];*/
					$Items_List[$j]['Pcs'] = $productinfo['product_pcs'];
					$Items_List[$j]['TotalQty'] = $value['product_quantity'];
					$Items_List[$j]['Mrp'] = $Mrp;
					/*$Items_List[$j]['SubTotal'] = "$subtotal";*/
					$Items_List[$j]['Image'] = !empty($productinfo['image']) ? base_url('attachments/shop_images/' . $productinfo['image']) : $productsingalimg;
					$Items_List[$j]['Comment'] = $value['product_comment'];
					$Items_List[$j]['AudioFile'] = !empty($value['product_audiofile']) ? base_url('attachments/audiofile/' . $value['product_audiofile']) : '';
					$j++;
				}
				$withdiscount = $this->IND_money_format($finalprice - $discountamount);
				$withoutdiscount = $this->IND_money_format($finalprice);
				$Mrp = $this->IND_money_format($finalprice);
				$data[$i]['ItemsList'] = $Items_List;
				$data[$i]['Total'] = "$Mrp";
				$data[$i]['WithDiscount'] = "$withdiscount";
				$data[$i]['WithoutDiscount'] = "$withoutdiscount";
				$i++;
			}
		}
		if (isset($ordertype) && $ordertype == 'Direct Order') {
			$this->db->select('photoordercreate.*');
			$this->db->where('photoordercreate.userid', $userid);
			$this->db->where('photoordercreate.id', $orderid);
			$this->db->order_by("photoordercreate.id", "desc");
			$result = $this->db->get('photoordercreate');
			//echo $this->db->last_query(); exit;
			$row = $result->result_array();
			$data = [];
			$i = 0;
			foreach ($row as $key => $value) {
				$Addressship = unserialize(html_entity_decode($value['shiptoid']));
				$Addressbill = unserialize(html_entity_decode($value['billtoid']));
				$orderdate = date("d-m-Y", $value['datetime']);
				$data[$i]['OrderId'] = $value['id'];
				$data[$i]['UserId'] = $value['userid'];
				$data[$i]['Address'] = $value['address'];
				// $data[$i]['TransportName'] = $value['transportname'];
				// $data[$i]['Status'] = $value['orderstatus'];
				// $data[$i]['Date'] = $orderdate;
				$data[$i]['Description'] = $value['description'];
				$data[$i]['Status'] = $value['orderstatus'];
				$data[$i]['Date'] = $orderdate;
				$data[$i]['Addressship'] = !empty($Addressship) ? $Addressship : array();
				$data[$i]['Addressbill'] = !empty($Addressbill) ? $Addressbill : array();
				$Items_List = [];
				$Items_List[0]['OrderId'] = $value['id'];
				$Items_List[0]['Image'] = !empty($value['orderphoto']) ? base_url('attachments/photoorder_images/' . $value['orderphoto']) : '';
				$Items_List[0]['Comment'] = $value['description'];
				$Items_List[0]['AudioFile'] = !empty($value['orderaudio']) ? base_url('attachments/audiofile/' . $value['orderaudio']) : '';
				$data[$i]['ItemsList'] = $Items_List;
				$i++;
			}
		}

		if (!empty($data) && isset($data)) {
			return $data;
		} else {
			return $data = [];
		}

	}

	public function Changedevicelistfun() {
		if (isset($_REQUEST['Page'])) {
			$offset = 10 * ($_REQUEST['Page'] - 1);
			$this->db->limit(10, $offset);
		} else {
			$this->db->limit(10, 0);
		}
		$this->db->order_by('user_app.devicecount', 'DESC');
		$query = $this->db->select('user_app.id as userid,`user_app`.`name`,`user_app`.`devicecount`,`user_app`.`businessname`')->get('user_app');
		$this->db->last_query();

		$result = $query->result_array();
		$data = array();
		$i = 0;
		foreach ($result as $key => $value) {
			$data[$i]['Name'] = $value['name'] . ' ' . $value['businessname'];
			$data[$i]['DeviceCount'] = $value['devicecount'];
			$i++;
		}
		if ($data) {
			$return['Data'] = $data;
			$return['Message'] = 'Result Sent Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Result Not Successfully Sent';
			$return['IsSuccess'] = false;
		}
		return $return;
	}
	public function CheckCouponfun() {
		$time2start = strtotime(date("Y-m-d"));
		$this->db->where('enddate >=', $time2start);
		$this->db->where('code', $_REQUEST['CouponCode']);
		$this->db->where('isactive', '1');
		$query = $this->db->select('*')->get('coupan');
		$data = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			$data[0]['DiscountType'] = $result['discounttype'];
			$data[0]['Value'] = $result['discount'];
		}
		if ($data) {
			$return['Data'] = $data;
			$return['Message'] = 'Result Sent Successfully!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Result Not Successfully Sent';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function getProductByCategory($id="",$sort='',$filter=[],$lang="") {


		if($sort=='price_low_to_high'){
			$this->db->order_by('products_translations.price', 'ASC');		
		}
		if($sort=='price_high_to_low'){
			$this->db->order_by('products_translations.price', 'DESC');
		}
		if($sort=='latest'){
			$this->db->order_by('products.id', 'DESC');
		}
		if($sort=='oldest'){
			$this->db->order_by('products.id', 'ASC');
		}
		if($sort=='best_offer'){
			$this->db->order_by('products.id', 'ASC');
		}		
		if(!empty($filter)){
			$this->db->join('product_attribute1', 'product_attribute1.refProduct_id = productcat.productid');
			$this->db->where_in('product_attribute1.refattributes_id',$filter);					
		}

		$this->db->join('products', 'products.id = productcat.productid', 'left');
		// $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->where('products_translations.abbr', $lang);
		$this->db->where('productcat.catid', $id);		
		$this->db->limit(10);
		$query = $this->db->select('products.id as product_id, products.image as product_image, products.time as product_time_created, products.time_update as product_time_updated, products.visibility as product_visibility, products.shop_categorie as product_category, products.quantity as product_quantity_available, products.procurement as product_procurement, products.url as product_url, products.virtual_products, products.brand_id as product_brand_id, products.position as product_position , products_translations.title, products_translations.description, products_translations.price, products_translations.old_price, products_translations.basic_description')->get('productcat');
		return $query->result_array();
	}

	public function getAttributeGroup() {
		$this->db->where('status',1);		
		$query = $this->db->get('attributes_group');
		return $query->result_array();
	}
	public function getAttributes() {
		$this->db->where('status',1);		
		$query = $this->db->get('attributes');
		return $query->result_array();
	}

	public function getProduct($lang, $id) {
		$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		$this->db->where('products_translations.abbr', $lang);
		$this->db->where('products.id', $id);
		$this->db->limit(1);
		$query = $this->db->select('vendors.name as vendor_name, vendors.id as vendor_id, products.id as product_id, products.image as product_image, products.time as product_time_created, products.time_update as product_time_updated, products.visibility as product_visibility, products.shop_categorie as product_category, products.quantity as product_quantity_available, products.procurement as product_procurement, products.url as product_url, products.virtual_products, products.brand_id as product_brand_id, products.position as product_position , products_translations.title, products_translations.description, products_translations.price, products_translations.old_price, products_translations.basic_description')->get('products');
		return $query->row_array();
	}

	public function setProduct($post) {
		if (!isset($post['brand_id'])) {
			$post['brand_id'] = null;
		}
		if (!isset($post['virtual_products'])) {
			$post['virtual_products'] = null;
		}
		$this->db->trans_begin();
		$i = 0;
		foreach ($_POST['translations'] as $translation) {
			if ($translation == MY_DEFAULT_LANGUAGE_ABBR) {
				$myTranslationNum = $i;
			}
			$i++;
		}
		if (!$this->db->insert('products', array(
			'image' => $post['image'],
			'shop_categorie' => $post['shop_categorie'],
			'quantity' => $post['quantity'],
			'in_slider' => $post['in_slider'],
			'position' => $post['position'],
			'virtual_products' => $post['virtual_products'],
			'folder' => time(),
			'brand_id' => $post['brand_id'],
			'time' => time(),
		))) {
			log_message('error', print_r($this->db->error(), true));
		}
		$id = $this->db->insert_id();

		$this->db->where('id', $id);
		if (!$this->db->update('products', array(
			'url' => except_letters($_POST['title'][$myTranslationNum]) . '_' . $id,
		))) {
			log_message('error', print_r($this->db->error(), true));
		}
		$this->setProductTranslation($post, $id);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		} else {
			$this->db->trans_commit();
			return true;
		}
	}

	private function setProductTranslation($post, $id) {
		$i = 0;
		$current_trans = $this->getTranslations($id);
		foreach ($post['translations'] as $abbr) {
			$arr = array();
			$emergency_insert = false;
			if (!isset($current_trans[$abbr])) {
				$emergency_insert = true;
			}
			$post['title'][$i] = str_replace('"', "'", $post['title'][$i]);
			$post['price'][$i] = str_replace(' ', '', $post['price'][$i]);
			$post['price'][$i] = str_replace(',', '', $post['price'][$i]);
			$arr = array(
				'title' => $post['title'][$i],
				'basic_description' => $post['basic_description'][$i],
				'description' => $post['description'][$i],
				'price' => $post['price'][$i],
				'old_price' => $post['old_price'][$i],
				'abbr' => $abbr,
				'for_id' => $id,
			);

			if (!$this->db->insert('products_translations', $arr)) {
				log_message('error', print_r($this->db->error(), true));
			}
			$i++;
		}
	}

	private function getTranslations($id) {
		$this->db->where('for_id', $id);
		$query = $this->db->get('products_translations');
		$arr = array();
		foreach ($query->result() as $row) {
			$arr[$row->abbr]['title'] = $row->title;
			$arr[$row->abbr]['basic_description'] = $row->basic_description;
			$arr[$row->abbr]['description'] = $row->description;
			$arr[$row->abbr]['price'] = $row->price;
			$arr[$row->abbr]['old_price'] = $row->old_price;
		}
		return $arr;
	}

	public function deleteProduct($id) {
		$this->db->trans_begin();
		$this->db->where('for_id', $id);
		if (!$this->db->delete('products_translations')) {
			log_message('error', print_r($this->db->error(), true));
		}

		$this->db->where('id', $id);
		if (!$this->db->delete('products')) {
			log_message('error', print_r($this->db->error(), true));
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
		} else {
			$this->db->trans_commit();
		}
	}

	public function productmultiimg($multiimg, $pos = 0, $pdfget = 0) {

		/*if($pos == 1){
				$output = array();
				if (isset($multiimg) && $multiimg != null) {
					$dir = 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $multiimg . DIRECTORY_SEPARATOR;
					if (is_dir($dir)) {
						if ($dh = opendir($dir)) {
							$a = 0;
							$filenames = array();
							while (($file = readdir($dh)) !== false) {
								if (is_file($dir . $file)) {
									$extention = strtolower(substr($file, strrpos($file, '.') + 1));
									if($extention != 'pdf'){
										$filenames[] = base_url('attachments/shop_images/' . $multiimg . '/' . $file);
									}
								}
								$a++;
							}
							closedir($dh);
							sort($filenames);
							$output = $filenames[0];
						}
					}
				}
				return $output;

			}else{

		*/

		// $without_extension = substr($file, 0, strrpos($file, "."));

		$output = array();
		if (isset($multiimg) && $multiimg != null) {
			$dir = 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $multiimg . DIRECTORY_SEPARATOR;
			if (is_dir($dir)) {
				if ($dh = opendir($dir)) {
					$a = 0;
					while (($file = readdir($dh)) !== false) {
						if (is_file($dir . $file)) {
							$extention = strtolower(substr($file, strrpos($file, '.') + 1));
							if ($extention != 'pdf' && $pdfget === 0) {
								$output[] = base_url('attachments/shop_images/' . $multiimg . '/' . $file);
							}
							if ($extention === 'pdf' && $pdfget === 'pdfurl') {
								$output[] = base_url('attachments/shop_images/' . $multiimg . '/' . $file);
							}
						}
						$a++;
					}
					closedir($dh);
					sort($output);
				}
			}
		}
		return $output;
	}

	public function addrecentviewuser($userid, $productid) {

		$this->db->select('*');
		$this->db->from('userrecentview');
		$this->db->where('userrecentview.userid', $userid);
		$this->db->where('userrecentview.productid', $productid);
		$this->db->limit(1);
		$query = $this->db->get();
		if ($query->num_rows() == 0) {
			$this->db->select('*');
			$this->db->from('userrecentview');
			$this->db->where('userrecentview.userid', $userid);
			$this->db->limit(10);
			$query = $this->db->get();
			if ($query->num_rows() >= 10) {
				$ret = $query->row();
				$firstid = $ret->id;
				$this->db->delete("userrecentview", array("id" => $firstid));
				$data['userid'] = !empty($userid) ? $userid : '';
				$data['productid'] = !empty($productid) ? $productid : '';
				$this->db->insert('userrecentview', $data);
			} else {
				$data['userid'] = !empty($userid) ? $userid : '';
				$data['productid'] = !empty($productid) ? $productid : '';
				$this->db->insert('userrecentview', $data);
			}

		}
	}

	public function singalfileupload($filename, $foldername) {
		if (!empty($_FILES[$filename]['name'])) {
			$config['upload_path'] = $_SERVER['DOCUMENT_ROOT'] . '/attachments/' . $foldername . '/';
			$config['allowed_types'] = '*';
			$new_name = time() . '_' . $_FILES[$filename]['name'];
			$config['file_name'] = $new_name;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if ($this->upload->do_upload($filename)) {
				$uploadData = $this->upload->data();
				return $audiofilename = $uploadData['file_name'];
			} else {
				return $audiofilename = '';
			}
		} else {
			return $audiofilename = '';
		}

	}
	// public function IND_money_format($amount) {
	// 	setlocale(LC_MONETARY, 'en_IN');
	// 	$amount = @money_format('%!i', $amount);
	// 	return $amount;
	// }

	/*public function IND_money_format($number) {
		$fmt = new \NumberFormatter($locale = 'en_IN', NumberFormatter::DECIMAL);
		return $fmt->format($number);
		$decimal = (string) ($number - floor($number));
			$money = floor($number);
			$length = strlen($money);
			$delimiter = '';
			$money = strrev($money);

			for ($i = 0; $i < $length; $i++) {
				if (($i == 3 || ($i > 3 && ($i - 1) % 2 == 0)) && $i != $length) {
					$delimiter .= ',';
				}
				$delimiter .= $money[$i];
			}

			$result = strrev($delimiter);
			$decimal = preg_replace("/0\./i", ".", $decimal);
			$decimal = substr($decimal, 0, 3);

			if ($decimal != '0') {
				$result = $result . $decimal;
			}

	}*/

	public function IND_money_format($amount) {

		$amount = round($amount, 2);

		$amountArray = explode('.', $amount);
		if (count($amountArray) == 1) {
			$int = $amountArray[0];
			$des = 00;
		} else {
			$int = $amountArray[0];
			$des = $amountArray[1];
		}
		if (strlen($des) == 1) {
			$des = $des . "0";
		}
		if ($int >= 0) {
			$int = $this->numFormatIndia($int);
			$themoney = $int . "." . $des;
		} else {
			$int = abs($int);
			$int = $this->numFormatIndia($int);
			$themoney = "-" . $int . "." . $des;
		}
		return $themoney;
	}

	public function numFormatIndia($num) {
		$explrestunits = "";
		if (strlen($num) > 3) {
			$lastthree = substr($num, strlen($num) - 3, strlen($num));
			$restunits = substr($num, 0, strlen($num) - 3); // extracts the last three digits
			$restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
			$expunit = str_split($restunits, 2);
			for ($i = 0; $i < sizeof($expunit); $i++) {
				// creates each of the 2's group and adds a comma to the end
				if ($i == 0) {
					$explrestunits .= (int) $expunit[$i] . ","; // if is first value , convert into integer
				} else {
					$explrestunits .= $expunit[$i] . ",";
				}
			}
			$thecash = $explrestunits . $lastthree;
		} else {
			$thecash = $num;
		}
		return $thecash; // writes the final format where $currency is the currency symbol.
	}
	private function getadminfcmtoken() {
		$this->db->select('*');
		$this->db->where('fcmtoken !=', '');
		$result = $this->db->get('users');
		$this->db->last_query();
		$row = $result->result_array();
		$fcmtoken = array();
		foreach ($row as $rows) {
			$fcmtoken[] = $rows['fcmtoken'];
		}
		return $fcmtoken;
	}
	private function getcustomerpricebytype($userid, $itemid) {
		$price = '';
		if ($userid != 0 && $userid != '' && !empty($userid)) {
			$row = $this->db->get_where('user_app', array('id' => $userid))->row()->userprice;
			if ($row == 'Price1') {
				$price = $this->db->get_where('products', array('id' => $itemid))->row()->price1;
			} elseif ($row == 'Price2') {
				$price = $this->db->get_where('products', array('id' => $itemid))->row()->price2;
			} elseif ($row == 'Price3') {
				$price = $this->db->get_where('products', array('id' => $itemid))->row()->price3;
			} elseif ($row == 'Price4') {
				$price = $this->db->get_where('products', array('id' => $itemid))->row()->price4;
			} else {
				$price = '';
			}
		}
		return $price;
	}
	private function getcustomeridbypricetype($userid) {
		$row = '';
		if (isset($userid) && $userid != 0) {
			$row = $this->db->get_where('user_app', array('id' => $userid))->row()->userprice;
		}
		return $row;
	}
	public function unreadcustomerfun() {
		$data = array();
		$this->db->where('user_app.read_status ', '0');
		$colorscount = $this->db->count_all_results('user_app');
		$data[0]['UnreadCustomer'] = $colorscount;
		if ($data) {
			$return['Data'] = $data;
			$return['Message'] = 'Result Sent Successfully!';
			$return['IsSuccess'] = true;
		}
		return $return;
	}

	public function readcustomerfun() {
		$this->db->where('read_status', '0');
		$this->db->update('user_app', array('read_status' => 1));
		$return['Data'] = 1;
		$return['Message'] = 'Data Get Successfully!';
		$return['IsSuccess'] = true;
		return $return;
	}

	public function UndoLikeProductImg() {
		$query = $this->db->query("Select * from likeproductimg where(imgname='" . $_POST['ImgName'] . "' AND userid='" . $_POST['UserId'] . "')");
		$row = $query->row();
		if (isset($row->userid) == $_POST['UserId'] && isset($row->imgname) == $_POST['ImgName']) {
			$this->db->delete("likeproductimg", array("id" => $row->id));
			$return['Data'] = 1;
			$return['Message'] = 'Item Successfully Removed!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item not Found';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	public function UndoLikePreProductImg() {

		$query = $this->db->query("Select * from likepreproductimg where(imgname='" . $_POST['ImgName'] . "' AND userid='" . $_POST['UserId'] . "')");
		$row = $query->row();
		if (isset($row->userid) == $_POST['UserId'] && isset($row->imgname) == $_POST['ImgName']) {
			$this->db->delete("likepreproductimg", array("id" => $row->id));
			$return['Data'] = 1;
			$return['Message'] = 'Item Successfully Removed!';
			$return['IsSuccess'] = true;
		} else {
			$return['Data'] = 0;
			$return['Message'] = 'Item not Found';
			$return['IsSuccess'] = false;
		}
		return $return;
	}

	private function sendactiveusersms($userid = 0) {
		if ($userid != 0 && $userid != '') {
			$this->db->select('*');
			$this->db->where('id', $userid);
			$this->db->where('smsflg', '0');
			$result = $this->db->get('user_app');
			$row = $result->row();
			if (!empty($row)) {
				$CustomerName = str_replace(' ', '%20', $row->name);
				$MobileNo = $row->mobilenumber;
				$msg = "Dear%20$CustomerName%20,%20your%20account%20has%20been%20approved.%20You%20can%20login%20and%20use%20the%20Ramrasiya%20Mobile%20Application.";
				// $message = urlencode($msg);
				// $message = urlencode($message);
				$url = "http://sms.premware.in:6005/api/v2/SendSMS?ApiKey=FbKnpOIgZfU541fff6mxudtf5tiCMEz/L5dEUKNJ6YI=&ClientId=26e94c2d-96f0-417e-8ddf-fa563e95e5c7&SenderId=RASIYA&Message=$msg&MobileNumbers=$MobileNo&Is_Unicode=False&Is_Flash=False";
				$ch = curl_init();
				$timeout = 5;
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, false);
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$data = curl_exec($ch);
				curl_close($ch);
				$dataup['smsflg'] = '1';
				$this->db->where('id', $userid);
				$this->db->update('user_app', $dataup);
			}
		}
	}

}
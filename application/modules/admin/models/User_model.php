<?php
class User_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function deleteProduct($id) {
		$this->db->trans_begin();
		$this->db->where('id', $id);
		if (!$this->db->delete('user_app')) {
			log_message('error', print_r($this->db->error(), true));
		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
		}
	}

	public function productsCount($search_title = null, $orderby = null, $category = null) {
		if ($search_title != null) {
			$search_title = trim($this->db->escape_like_str($search_title));
			$this->db->where("(user_app.name LIKE '%$search_title%' OR user_app.mobilenumber LIKE '%$search_title%' OR user_app.emailid LIKE '%$search_title%' OR user_app.compnay LIKE '%$search_title%')");
		}
		if (isset($orderby) && $orderby !== null && $orderby != '') {
			$this->db->where('user_app.isverified', $orderby);
			// $ord = explode('=', $orderby);
			// if (isset($ord[0]) && isset($ord[1])) {
			// 	$this->db->order_by('user_app.' . $ord[0], $ord[1]);
			// }
		}
		// if ($category != null) {
		// 	$this->db->where('shop_categorie', $category);
		// }
		return $this->db->count_all_results('user_app');
	}

	public function getProducts($limit, $page, $search_title = null, $orderby = null, $category = null, $vendor = null) {
		if ($search_title != null) {
			$search_title = trim($this->db->escape_like_str($search_title));
			$this->db->where("(user_app.name LIKE '%$search_title%' OR user_app.mobilenumber LIKE '%$search_title%' OR user_app.emailid LIKE '%$search_title%' OR user_app.compnay LIKE '%$search_title%')");
			// $this->db->or_where("(user_app.mobilenumber LIKE '%$search_title%')");
			// $this->db->or_where("(user_app.emailid LIKE '%$search_title%')");
		}
		if (isset($orderby) && $orderby !== null && $orderby != '') {
			$this->db->where('user_app.isverified', $orderby);
			// $ord = explode('=', $orderby);
			// if (isset($ord[0]) && isset($ord[1])) {
			// 	$this->db->order_by('user_app.' . $ord[0], $ord[1]);
			// }
		}
		$this->db->order_by('isverified', 'ASC');
		$query = $this->db->select('id,name,mobilenumber,emailid,compnay,businessname,approvedby,contactid,isverified')->get('user_app', $limit, $page);
		// echo $this->db->last_query();
		return $query->result();
	}

	public function numShopProducts() {
		return $this->db->count_all_results('user_app');
	}

	public function changestatususer($post) {
		if (isset($post['selectuserstatus']) && isset($post['usercheck']) && is_array($post['usercheck'])) {
			$this->db->where_in('user_app.id', $post['usercheck']);
			$this->db->update('user_app', array('isverified' => $post['selectuserstatus']));
		}
	}

	public function getOneProduct($id) {
		$this->db->select('user_app.*');
		$this->db->where('user_app.id', $id);
		$query = $this->db->get('user_app');
		if ($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return false;
		}
	}	

	
	public function productStatusChange($id, $to_status) {
		$this->db->where('id', $id);
		$result = $this->db->update('user_app', array('visibility' => $to_status));
		return $result;
	}

	public function setProduct($post, $id = 0) {
		
		$post['guest'] = 0;
		$post['retailer'] = 0;
		$post['wholesaller'] = 0;
		
		// echo $post['alocation_agent_id'];die;

		if (isset($post['user_group'])) {
			if($post['user_group']=='guest'){
				$post['guest'] = 1;
			}
			if($post['user_group']=='retailer'){
				$post['retailer'] = 1;
			}
			if($post['user_group']=='wholesaller'){
				$post['wholesaller'] = 1;
			}
		}		
		if (!isset($post['credit'])) {
			$post['credit'] = 0;
		}
		if (!isset($post['coupan'])) {
			$post['coupan'] = 0;
		}
		if (!isset($post['coupan'])) {
			$post['coupan'] = 0;
		}
		if ($id != 0 && $id != '' && $post['isverified'] == 'true') {
			$this->sendactiveusersms($id);
		}
		if ($id != 0 && $id != '' && $post['isverified'] == 'false') {
			$dataup['smsflg'] = '0';
			$this->db->where('id', $id);
			$this->db->update('user_app', $dataup);
		}
		$this->db->trans_begin();
		$is_update = false;
		if ($id > 0) {
			$is_update = true;
			if (!$this->db->where('id', $id)->update('user_app', array(
				'name' => $post['name'],
				'mobilenumber' => $post['mobilenumber'],
				'emailid' => $post['emailid'],
				'address' => $post['address'],
				'contactid' => $post['contactid'],
				'pviewcount' => $post['pviewcount'],
				'isverified' => $post['isverified'],
				'userprice' => $post['userprice'],
				'alocation_agent_id' => $post['alocation_agent_id'],
				'guest' => $post['guest'],
				'retailer' => $post['retailer'],
				'wholesaller' => $post['wholesaller'],					
				'businessname' => $post['businessname'],
				'jobtitle' => $post['jobtitle'],
				'credit' => $post['credit'],
				'coupan' => $post['coupan'],
				'user_group' => $post['user_group'],
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			$firmnamelist = '';
			if (isset($_POST['firmname'])) {
				$firmnamelist = array_filter($_POST['firmname']);
			}

			if (!empty($firmnamelist)) {
				$this->db->where('userid', $id);
				if (!$this->db->delete('user_firmlist')) {
					log_message('error', print_r($this->db->error(), true));
				}
				foreach ($firmnamelist as $key => $value) {

					if (!$this->db->insert('user_firmlist', array(
						'userid' => $id,
						'firmname' => $value,
					))) {
						log_message('error', print_r($this->db->error(), true));
					}
				}
			}

		} else {
			/*
				                             * Lets get what is default tranlsation number
				                             * in titles and convert it to url
				                             * We want our plaform public ulrs to be in default
				                             * language that we use
			*/

		
			

			if (!$this->db->insert('user_app', array(
				'name' => $post['name'],
				'mobilenumber' => $post['mobilenumber'],
				'emailid' => $post['emailid'],
				'address' => $post['address'],
				'contactid' => $post['contactid'],
				'pviewcount' => $post['pviewcount'],
				'isverified' => 'true',
				'userprice' => $post['userprice'],
				'alocation_agent_id' => $post['alocation_agent_id'],
				// 'premiumuser' => $post['premiumuser'],
				// 'reguleruser' => $post['reguleruser'],
				'guest' => $post['guest'],
				'retailer' => $post['retailer'],
				'wholesaller' => $post['wholesaller'],	
				'businessname' => $post['businessname'],
				'jobtitle' => $post['jobtitle'],
				'credit' => $post['credit'],
				'coupan' => $post['coupan'],
				'user_group' => $post['user_group'],
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			$id = $this->db->insert_id();
			if (isset($_POST['firmname'])) {
				$firmnamelist = array_filter($_POST['firmname']);
				if (!empty($firmnamelist)) {
					foreach ($firmnamelist as $key => $value) {
						if (!$this->db->insert('user_firmlist', array(
							'userid' => $id,
							'firmname' => $value,
						))) {
							log_message('error', print_r($this->db->error(), true));
						}
					}
				}
			}
		}
		$this->setProductTranslation($post, $id, $is_update);
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
		}
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
	private function setProductTranslation($post, $id, $is_update) {
		$i = 0;
		$current_trans = $this->getTranslations($id);
		if (isset($post['translations'])) {
			foreach ($post['translations'] as $abbr) {
				$arr = array();
				$emergency_insert = false;
				if (!isset($current_trans[$abbr])) {
					$emergency_insert = true;
				}
				$post['title'][$i] = str_replace('"', "'", $post['title'][$i]);
				$post['price'][$i] = str_replace(' ', '', $post['price'][$i]);
				$post['price'][$i] = str_replace(',', '.', $post['price'][$i]);
				$post['price'][$i] = preg_replace("/[^0-9,.]/", "", $post['price'][$i]);
				$post['old_price'][$i] = str_replace(' ', '', $post['old_price'][$i]);
				$post['old_price'][$i] = str_replace(',', '.', $post['old_price'][$i]);
				$post['old_price'][$i] = preg_replace("/[^0-9,.]/", "", $post['old_price'][$i]);
				$arr = array(
					'title' => $post['title'][$i],
					'basic_description' => $post['basic_description'][$i],
					'description' => $post['description'][$i],
					'price' => $post['price'][$i],
					'old_price' => $post['old_price'][$i],
					'abbr' => $abbr,
					'for_id' => $id,
				);
				if ($is_update === true && $emergency_insert === false) {
					$abbr = $arr['abbr'];
					unset($arr['for_id'], $arr['abbr'], $arr['url']);
					if (!$this->db->where('abbr', $abbr)->where('for_id', $id)->update('products_translations', $arr)) {
						log_message('error', print_r($this->db->error(), true));
					}
				} else {
					if (!$this->db->insert('products_translations', $arr)) {
						log_message('error', print_r($this->db->error(), true));
					}
				}
				$i++;
			}
		}
	}
	public function setUserAddress($post, $id = 0) {
		$this->db->trans_begin();
		$is_update = false;
		if ($id > 0) {

			if (!$this->db->where('id', $id)->update('useraddress', array(
				'addresstype' => $post['addresstype'],
				'companyname' => $post['companyname'],
				'address' => $post['address'],
				'gstnumber' => $post['gstnumber'],
				'dateandtime' => time(),
			))) {
				log_message('error', print_r($this->db->error(), true));
			}

		} else {
			if ($post['addresstype'] == 'Both') {
				$data = array(
					'userid' => $post['userid'],
					'addresstype' => 'Billing',
					'companyname' => $post['companyname'],
					'address' => $post['address'],
					'gstnumber' => $post['gstnumber'],
					'dateandtime' => time(),
				);
				if (!$this->db->insert('useraddress', $data)) {
					log_message('error', print_r($this->db->error(), true));
				}
				$data = array(
					'userid' => $post['userid'],
					'addresstype' => 'Shipping',
					'companyname' => $post['companyname'],
					'address' => $post['address'],
					'gstnumber' => $post['gstnumber'],
					'dateandtime' => time(),
				);
				if (!$this->db->insert('useraddress', $data)) {
					log_message('error', print_r($this->db->error(), true));
				}
			} else {
				$data = array(
					'userid' => $post['userid'],
					'addresstype' => $post['addresstype'],
					'companyname' => $post['companyname'],
					'address' => $post['address'],
					'gstnumber' => $post['gstnumber'],
					'dateandtime' => time(),
				);
				if (!$this->db->insert('useraddress', $data)) {
					log_message('error', print_r($this->db->error(), true));
				}
			}

		}
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			show_error(lang('database_error'));
		} else {
			$this->db->trans_commit();
		}

		/* exit;

			        $this->db->trans_begin();
					$data = array(
						'catimg' => $post['image'],
			            'websiteimg' => $post['webimage'],
						'position' => $post['position'],
						'dateandtime' => time()
					);
			        if (!$this->db->insert('shop_categories', $data )) {
			            log_message('error', print_r($this->db->error(), true));
			        }
			        $id = $this->db->insert_id();

			        $i = 0;
			        foreach ($post['translations'] as $abbr) {
			            $arr = array();
			            $arr['abbr'] = $abbr;
			            $arr['name'] = $post['categorie_name'][$i];
			            $arr['for_id'] = $id;
			            if (!$this->db->insert('shop_categories_translations', $arr)) {
			                log_message('error', print_r($this->db->error(), true));
			            }
			            $i++;
			        }
			        if ($this->db->trans_status() === FALSE) {
			            $this->db->trans_rollback();
			            show_error(lang('database_error'));
			        } else {
			            $this->db->trans_commit();
		*/
	}
	public function getuseraddress($id) {
		$this->db->where('userid', $id);
		$query = $this->db->get('useraddress');
		$arr = array();
		$i = 0;
		foreach ($query->result() as $row) {
			$arr[$i]['id'] = $row->id;
			$arr[$i]['userid'] = $row->userid;
			$arr[$i]['addresstype'] = $row->addresstype;
			$arr[$i]['companyname'] = $row->companyname;
			$arr[$i]['address'] = $row->address;
			$arr[$i]['gstnumber'] = $row->gstnumber;
			$i++;
		}
		return $arr;
	}

	public function getTranslations($id) {
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

	// public function getAgentId($name) {
	// 	$this->db->where('name', $name);
	// 	$query = $this->db->get('agent');
	// 	return $query->row_array();		
	// }

	public function getAgentId($name)
    {
        // $this->db->where('name=', $name);
        $query = $this->db->get('agent');
        return $query->row_array();
    }

	public function chatcomment($userid) {

		$this->db->where('sender_id', $userid);
		$this->db->update('wpn_chatmessenger', array('read_status' => 1));

		$this->db->where('userid', $userid);
		//$this->db->orWhere('receiver_id',$userid);
		$this->db->where("(sender_id=" . $userid . " OR receiver_id=" . $userid . ")", NULL, FALSE);
		$query = $this->db->select('*')->get('wpn_chatmessenger');
		// echo $this->db->last_query();exit;
		return $result = $query->result_array();
	}

	public function sendordersmsg($id) {
		$adminid = $this->session->userdata('logged_id');
		$data['sender_id'] = $adminid;
		$data['receiver_id'] = !empty($this->input->post("receiver_id")) ? $this->input->post("receiver_id") : '';
		$data['message'] = !empty($this->input->post("commentmsg")) ? $this->input->post("commentmsg") : '';
		$data['usertype'] = 'admin';
		$data['userid'] = !empty($this->input->post("receiver_id")) ? $this->input->post("receiver_id") : '';
		$data['timeanddate'] = time();
		$result_check = $this->db->insert('wpn_chatmessenger', $data);
	}


	public function approve_status($params)
    {
        $table = $params['table'];
        $table_update_field = $params['updatefield'];
        $table_where_field = $params['wherefield'];
        $status = $params['status'];
        $table_id = $params['table_id'];

		// print_r($params);die;
        $query_res = $this->db->query("UPDATE $table SET $table_update_field = '$status' WHERE $table_where_field=$table_id");
        if ($query_res) {
            return true;
        }
    }

}

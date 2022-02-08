<?php
class Report_model extends CI_Model {

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
		if ($page == 'top') {
			$this->db->order_by('finaltotal', 'DESC');
			$this->db->group_by('user_id');
			$this->db->join('user_app', 'user_app.id = orders.user_id', 'left');
			$this->db->where('finaltotal !=', 0);
			$query = $this->db->select('SUM(finaltotal) as finaltotal ,user_id as usercount ,name ,businessname')->get('orders');
			return $query->result();
		} elseif ($page == 'bottom') {
			$this->db->group_by('userid');
			$where = '(orders.order_id IS NULL OR orders.order_id = "")';
			$this->db->where($where);
			$this->db->join('orders', 'orders.user_id = user_app.id', 'left');
			$query = $this->db->select('user_app.id as userid, orders.order_id, `user_app`.`name`,businessname')->get('user_app');
			return $query->result();
		} else {

		}

	}
	public function changedevice($limit, $page, $search_title = null, $orderby = null, $category = null, $vendor = null) {
		if ($page == 'changedevice') {
			$this->db->order_by('user_app.devicecount', 'DESC');
			$query = $this->db->select('user_app.id as userid,`user_app`.`name`,`user_app`.`devicecount`')->get('user_app');
			return $query->result();
		} else {

		}

	}

	public function numShopProducts() {
		return $this->db->count_all_results('user_app');
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
		if (!isset($post['premiumuser'])) {
			$post['premiumuser'] = 0;
		}
		if (!isset($post['credit'])) {
			$post['credit'] = 0;
		}
		if (!isset($post['coupan'])) {
			$post['coupan'] = 0;
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
				'premiumuser' => $post['premiumuser'],
				'businessname' => $post['businessname'],
				'jobtitle' => $post['jobtitle'],
				'credit' => $post['credit'],
				'coupan' => $post['coupan'],
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
				'premiumuser' => $post['premiumuser'],
				'businessname' => $post['businessname'],
				'jobtitle' => $post['jobtitle'],
				'credit' => $post['credit'],
				'coupan' => $post['coupan'],
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

	public function getuseraddress($id) {
		$this->db->where('userid', $id);
		$query = $this->db->get('useraddress');
		$arr = array();
		$i = 0;
		foreach ($query->result() as $row) {
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

	public function chatcomment($userid) {

		$this->db->where('sender_id', $userid);
		$this->db->update('wpn_chatmessenger', array('read_status' => 1));

		$this->db->where('userid', $userid);
		$this->db->join('user_app', 'user_app.id = wpn_chatmessenger.sender_id', 'left');
		//$this->db->orWhere('receiver_id',$userid);
		$this->db->order_by('wpn_chatmessenger.id', 'desc');
		$this->db->where("(sender_id=" . $userid . " OR receiver_id=" . $userid . ")", NULL, FALSE);
		$query = $this->db->select('wpn_chatmessenger.*,user_app.name')->get('wpn_chatmessenger');
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

}

<?php

class Directordersdetails_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function ordersCount($onlyNew = false) {
		if ($onlyNew == true) {
			$this->db->where('viewed', 0);
		}
		return $this->db->count_all_results('orders');
	}

	public function orders($order_id, $limit, $page, $order_by) {
		$this->db->where('photoordercreate.id', $order_id);
		$this->db->update('photoordercreate', array('viewed' => 1));
		if ($order_by != null) {
			//$this->db->order_by($order_by, 'DESC');
		} else {
			//$this->db->order_by('id', 'DESC');
		}

		$this->db->join('user_app', 'user_app.id = photoordercreate.userid', 'left');
		$this->db->select('photoordercreate.*,user_app.name,user_app.mobilenumber,user_app.emailid,user_app.businessname');
		$this->db->where('photoordercreate.id', $order_id);
		$result = $this->db->get('photoordercreate');

		return $result->row();

	}

	public function ordercomment($order_id) {
		$this->db->where('order_id', $order_id);
		$this->db->where('type', 'Direct Order');
		$query = $this->db->select('*')->get('order_chatmessenger');
		return $result = $query->result_array();
	}

	public function changeOrderStatus($id, $to_status) {

		//echo notifications('test','message','123456');
		//SELECT `user_app`.`fcmtoken`,`photoordercreate`.`id`,`userid`, `orderstatus` FROM `photoordercreate` LEFT JOIN `user_app` ON `user_app`.`id` = `photoordercreate`.`userid` WHERE `photoordercreate`.`id` = '17'
		$this->db->join('user_app', 'user_app.id = photoordercreate.userid', 'left');
		$this->db->where('photoordercreate.id', $id);
		$this->db->select('photoordercreate.id,photoordercreate.userid,photoordercreate.orderstatus,user_app.fcmtoken');
		$result1 = $this->db->get('photoordercreate');
		$res = $result1->row_array();
		notifications('Order Status is changed to ' . $to_status, 'Your Order ID : #' . $id, $res['fcmtoken'], '', '', $id, 'photo');
		$notidata['title'] = 'Order Status is changed to ' . $to_status;
		$notidata['description'] = 'Your Order ID : #' . $id;
		$notidata['orderid'] = $id;
		$notidata['userid'] = $res['userid'];
		$notidata['ordertype'] = 'Direct Order';
		$notidata['dateandtime'] = time();
		$result_check = $this->db->insert('notificationdata', $notidata);
		$result = true;
		if ($res['orderstatus'] != $to_status) {

			$adminid = $this->session->userdata('logged_id');
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
		return $result;
	}

	private function manageQuantitiesAndProcurement($id, $to_status, $current) {
		if (($to_status == 0 || $to_status == 2) && $current == 1) {
			$operator = '+';
			$operator_pro = '-';
		}
		if ($to_status == 1) {
			$operator = '-';
			$operator_pro = '+';
		}
		$this->db->select('products');
		$this->db->where('id', $id);
		$result = $this->db->get('orders');
		$arr = $result->row_array();
		$products = unserialize($arr['products']);
		foreach ($products as $product) {
			if (isset($operator)) {
				if (!$this->db->query('UPDATE products SET quantity=quantity' . $operator . $product['product_quantity'] . ' WHERE id = ' . $product['product_info']['id'])) {
					log_message('error', print_r($this->db->error(), true));
					show_error(lang('database_error'));
				}
			}
			if (isset($operator_pro)) {
				if (!$this->db->query('UPDATE products SET procurement=procurement' . $operator_pro . $product['product_quantity'] . ' WHERE id = ' . $product['product_info']['id'])) {
					log_message('error', print_r($this->db->error(), true));
					show_error(lang('database_error'));
				}
			}
		}
	}

	public function setBankAccountSettings($post) {
		$query = $this->db->query('SELECT id FROM bank_accounts');
		if ($query->num_rows() == 0) {
			$id = 1;
		} else {
			$result = $query->row_array();
			$id = $result['id'];
		}
		$post['id'] = $id;
		if (!$this->db->replace('bank_accounts', $post)) {
			log_message('error', print_r($this->db->error(), true));
			show_error(lang('database_error'));
		}
	}

	public function getBankAccountSettings() {
		$result = $this->db->query("SELECT * FROM bank_accounts LIMIT 1");
		return $result->row_array();
	}

	public function sendordersmsg($id) {
		$adminid = $this->session->userdata('logged_id');
		$data['sender_id'] = $adminid;
		$data['receiver_id'] = !empty($this->input->post("receiver_id")) ? $this->input->post("receiver_id") : '';
		$data['order_id'] = !empty($id) ? $id : '';
		$data['message'] = !empty($this->input->post("ordercommentmsg")) ? $this->input->post("ordercommentmsg") : '';
		$data['usertype'] = 'admin';
		$data['type'] = 'Direct Order';
		$data['time'] = time();
		$result_check = $this->db->insert('order_chatmessenger', $data);
	}

}

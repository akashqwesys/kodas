<?php

class Home_admin_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function loginCheck($values) {
		$arr = array(
			'username' => $values['username'],
			'password' => md5($values['password']),
		);
		$this->db->where('usertype !=', 'mobileuser');
		$this->db->where($arr);
		$result = $this->db->get('users');
		$resultArray = $result->row_array();
		if ($result->num_rows() > 0) {
			$this->db->where('id', $resultArray['id']);
			$this->db->update('users', array('last_login' => time()));
		}
		return $resultArray;
	}

	/*
		     * Some statistics methods for home page of
		     * administration
		     * START
	*/

	public function countLowQuantityProducts() {
		$this->db->where('quantity <=', 5);
		return $this->db->count_all_results('products');
	}


	public function countactiveCustomers() {
		$this->db->where('isverified =','true');					
		return $this->db->count_all_results('user_app');
	}

	public function countTopCustomers() {

		$result = $this->db->query("SELECT order_id,user_id , COUNT(id) AS NoofOrders,
		rank() over(order by NoofOrders) AS ranking
		FROM orders
		GROUP BY user_id
		ORDER BY NoofOrders DESC");	
		echo '<pre>';print_r($result->result_array());die;

		// $this->db->where('isverified =','false');					
		// return $this->db->count_all_results('user_app');
	}


	public function countInActiveCustomers() {
		$this->db->where('isverified =','false');					
		return $this->db->count_all_results('user_app');
	}


	public function countPendingDirectOrder() {					
		$this->db->where_in('orderstatus',array('Pending'));
		return $this->db->count_all_results('photoordercreate');
	}
	public function countCancelledDirectOrder() {					
		$this->db->where_in('orderstatus',array('Cancelled'));
		return $this->db->count_all_results('photoordercreate');
	}


	public function countPendingOrder() {					
		$this->db->where_in('processed',array('Pending'));
		return $this->db->count_all_results('orders');
	}
	public function countCancelledOrder() {					
		$this->db->where_in('processed',array('Cancelled'));
		return $this->db->count_all_results('orders');
	}
	
	public function countTodaysOrder() {
		$this->db->where('date >=', strtotime(date('m/d/Y')));			
		$this->db->where_in('processed',array('Accepted by kodas','Shipped'));
		return $this->db->count_all_results('orders');
	}
	public function countTodaysDirectOrder() {
		$this->db->where('datetime >=', strtotime(date('m/d/Y')));			
		$this->db->where_in('orderstatus',array('Accepted by kodas','Shipped'));
		return $this->db->count_all_results('photoordercreate');
	}

	public function countWeeklyOrder() {		
		$result = $this->db->query("select count(id) as cnt from orders where week((FROM_UNIXTIME(date)))=week(now()) AND (processed='Accepted by kodas') OR (processed='Shipped')");	
		return $result->row_array();		
	}
	public function countWeeklyDirectOrder() {		
		$result = $this->db->query("select count(id) as cnt from photoordercreate where week((FROM_UNIXTIME(datetime)))=week(now()) AND (orderstatus='Accepted by kodas') OR (orderstatus='Shipped')");	
		return $result->row_array();		
	}


	public function countMonthlyOrder() {		
		$result = $this->db->query("select count(id) as cnt from orders where MONTH((FROM_UNIXTIME(date)))=MONTH(now()) AND (processed='Accepted by kodas') OR (processed='Shipped')");	
		return $result->row_array();		
	}
	public function countMonthlyDirectOrder() {		
		$result = $this->db->query("select count(id) as cnt from photoordercreate where MONTH((FROM_UNIXTIME(datetime)))=MONTH(now()) AND (orderstatus='Accepted by kodas') OR (orderstatus='Shipped')");	
		return $result->row_array();		
	}
	
	public function countTodaysSales() {
		$this->db->select_sum('gstwithamount');
		$this->db->where('date >=', strtotime(date('m/d/Y')));
		$this->db->where_in('processed',array('Accepted by kodas','Shipped'));
		return $this->db->get('orders')->row_array();
	}

	public function countWeeklySales() {			
		$result = $this->db->query("select sum(gstwithamount) as total from orders where week((FROM_UNIXTIME(date)))=week(now()) AND (processed='Accepted by kodas') OR (processed='Shipped')");
		return $result->row_array();	
	}
	public function countMonthlySales() {		
		$result = $this->db->query("select sum(gstwithamount) as total from orders where MONTH((FROM_UNIXTIME(date)))=MONTH(now()) AND (processed='Accepted by kodas') OR (processed='Shipped')");
		return $result->row_array();		
	}


	public function lastSubscribedEmailsCount() {
		$yesterday = strtotime('-1 day', time());
		$this->db->where('time > ', $yesterday);
		return $this->db->count_all_results('subscribed');
	}

	public function getMostSoldProducts($limit = 10) {
		$this->db->select('url, procurement');
		$this->db->order_by('procurement', 'desc');
		$this->db->where('procurement >', 0);
		$this->db->limit($limit);
		$queryResult = $this->db->get('products');
		return $queryResult->result_array();
	}

	public function getReferralOrders() {

		$this->db->select('count(id) as num, clean_referrer as referrer');
		$this->db->group_by('clean_referrer');
		$queryResult = $this->db->get('orders');
		return $queryResult->result_array();
	}

	public function getOrdersByPaymentType($limit = 10) {
		$this->db->select('count(id) as num, payment_type');
		$this->db->group_by('payment_type');
		$this->db->limit($limit);
		$queryResult = $this->db->get('orders');
		return $queryResult->result_array();
	}

	public function getOrdersByMonth() {
		$result = $this->db->query("SELECT YEAR(FROM_UNIXTIME(date)) as year, MONTH(FROM_UNIXTIME(date)) as month, COUNT(id) as num FROM orders GROUP BY YEAR(FROM_UNIXTIME(date)), MONTH(FROM_UNIXTIME(date))");
		$result = $result->result_array();
		$orders = array();
		$years = array();
		foreach ($result as $res) {
			if (!isset($orders[$res['year']])) {
				for ($i = 1; $i <= 12; $i++) {
					$orders[$res['year']][$i] = 0;
				}
			}
			$years[] = $res['year'];
			$orders[$res['year']][$res['month']] = $res['num'];
		}
		return array(
			'years' => array_unique($years),
			'orders' => $orders,
		);
	}

	/*
		     * Some statistics methods for home page of
		     * administration
		     * END
	*/

	public function setValueStore($key, $value) {
		$this->db->where('thekey', $key);
		$query = $this->db->get('value_store');
		if ($query->num_rows() > 0) {
			$this->db->where('thekey', $key);
			if (!$this->db->update('value_store', array('value' => $value))) {
				log_message('error', print_r($this->db->error(), true));
				show_error(lang('database_error'));
			}
		} else {
			if (!$this->db->insert('value_store', array('value' => $value, 'thekey' => $key))) {
				log_message('error', print_r($this->db->error(), true));
				show_error(lang('database_error'));
			}
		}
	}

	public function changePass($new_pass, $username) {
		$this->db->where('username', $username);
		$result = $this->db->update('users', array('password' => md5($new_pass)));
		return $result;
	}

	public function getValueStore($key) {
		$query = $this->db->query("SELECT value FROM value_store WHERE thekey = ? LIMIT 1", [$key]);
		$value = $query->row_array();
		if (!$value) {
			return null;
		}
		return $value['value'];
	}

	public function newOrdersCheck() {
		$result = $this->db->query("SELECT count(id) as num FROM `orders` WHERE viewed = 0");
		$row = $result->row_array();
		return $row['num'];
	}

	public function setCookieLaw($post) {
		$query = $this->db->query('SELECT id FROM cookie_law');
		if ($query->num_rows() == 0) {
			$update = false;
		} else {
			$result = $query->row_array();
			$update = $result['id'];
		}

		if ($update === false) {
			$this->db->trans_begin();
			if (!$this->db->insert('cookie_law', array(
				'link' => $post['link'],
				'theme' => $post['theme'],
				'visibility' => $post['visibility'],
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			$for_id = $this->db->insert_id();
			$i = 0;
			foreach ($post['translations'] as $translate) {
				if (!$this->db->insert('cookie_law_translations', array(
					'message' => htmlspecialchars($post['message'][$i]),
					'button_text' => htmlspecialchars($post['button_text'][$i]),
					'learn_more' => htmlspecialchars($post['learn_more'][$i]),
					'abbr' => $translate,
					'for_id' => $for_id,
				))) {
					log_message('error', print_r($this->db->error(), true));
				}
				$i++;
			}
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				show_error(lang('database_error'));
			} else {
				$this->db->trans_commit();
			}
		} else {
			$this->db->trans_begin();
			$this->db->where('id', $update);
			if (!$this->db->update('cookie_law', array(
				'link' => $post['link'],
				'theme' => $post['theme'],
				'visibility' => $post['visibility'],
			))) {
				log_message('error', print_r($this->db->error(), true));
			}
			$i = 0;
			foreach ($post['translations'] as $translate) {
				$this->db->where('for_id', $update);
				$this->db->where('abbr', $translate);
				if (!$this->db->update('cookie_law_translations', array(
					'message' => htmlspecialchars($post['message'][$i]),
					'button_text' => htmlspecialchars($post['button_text'][$i]),
					'learn_more' => htmlspecialchars($post['learn_more'][$i]),
				))) {
					log_message('error', print_r($this->db->error(), true));
				}
				$i++;
			}
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				show_error(lang('database_error'));
			} else {
				$this->db->trans_commit();
			}
		}
	}

	public function getCookieLaw() {
		$arr = array('cookieInfo' => null, 'cookieTranslate' => null);
		$query = $this->db->query('SELECT * FROM cookie_law');
		if ($query->num_rows() > 0) {
			$arr['cookieInfo'] = $query->row_array();
			$query = $this->db->query('SELECT * FROM cookie_law_translations');
			$arrTrans = $query->result_array();
			foreach ($arrTrans as $trans) {
				$arr['cookieTranslate'][$trans['abbr']] = array(
					'message' => $trans['message'],
					'button_text' => $trans['button_text'],
					'learn_more' => $trans['learn_more'],
				);
			}
		}
		return $arr;
	}

}

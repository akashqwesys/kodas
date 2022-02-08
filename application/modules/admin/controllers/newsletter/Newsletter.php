<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Newsletter extends ADMIN_Controller {
	private $num_rows = 10;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Newsletter_model'));
	}

	public function index($page = 0) {
		$this->login_check();
		$adminid = $this->session->userdata('logged_roledata');
		if (!in_array('addcustomer', $adminid) || !in_array('editcustomer', $adminid) || !in_array('delcustomer', $adminid)) {redirect('admin');}
		$data = array();
		$head = array();
		$head['title'] = 'Administration - View Newsletter';
		$head['description'] = '!';
		$head['keywords'] = '';

		if (isset($_GET['delete'])) {
			$this->Newsletter_model->deleteNewsletter($_GET['delete']);
			$this->session->set_flashdata('result_delete', 'Newsletter is deleted!');
			$this->saveHistory('Delete newsletter id - ' . $_GET['delete']);
			redirect('admin/newsletter');
		}

		unset($_SESSION['filter']);
		$rowscount = $this->Newsletter_model->newslettersCount();
		$data['newsletterlist'] = $this->Newsletter_model->getNewsletters($this->num_rows, $page);
		$data['links_pagination'] = pagination('admin/newsletter', $rowscount, $this->num_rows, 3);

		$this->saveHistory('Go to Newsletter');
		$this->load->view('_parts/header', $head);
		$this->load->view('newsletter/newsletter', $data);
		$this->load->view('_parts/footer');
	}

}

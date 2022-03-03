<?php if (!defined('BASEPATH')) {exit('No direct script access allowed');}

class Newsletter extends ADMIN_Controller {
	private $num_rows = 10;

	public function __construct() {
		parent::__construct();
		$this->load->model(array('Newsletter_model','Newsletterdt_model'));
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

	public function newsletter_list() {       
        $this->login_check();
        $adminid = $this->session->userdata('logged_roledata');
        if (!in_array('addcustomer', $adminid) || !in_array('editcustomer', $adminid) || !in_array('delcustomer', $adminid)) {redirect('admin');}
        $list = $this->Newsletterdt_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $datarow) {    
                                  
            $delete_url=base_url('admin/newsletter?delete='). $datarow->id;           
            $actionBtn = '<a href="'.$delete_url.'" class="btn btn-xs btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></a>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $datarow->email;        
            $row[] = $datarow->dateadded;                         
            $row[]=$actionBtn;               
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Newsletterdt_model->count_all(),
            "recordsFiltered" => $this->Newsletterdt_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}

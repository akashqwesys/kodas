<?php

/*
 * @Author:    Kiril Kirkov
 *  Gitgub:    https://github.com/kirilkirkov
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Orders_model', 'History_model'));
    }

    public function index()
    {
        $this->login_check();
        $data = array();
        $head = array();
        $head['title'] = 'Administration - Home';
        $head['description'] = '';
        $head['keywords'] = '';

        $data['activeCustomers'] = $this->Home_admin_model->countactiveCustomers();
        $data['inActiveCustomers'] = $this->Home_admin_model->countInActiveCustomers();

        $data['topCustomers'] = $this->Home_admin_model->countTopCustomers();
        $data['bottomCustomers'] = $this->Home_admin_model->countBottomCustomers();

        $data['todaysOrder'] = $this->Home_admin_model->countTodaysOrder();
        $data['weeklyOrder'] = $this->Home_admin_model->countWeeklyOrder();
        $data['monthlyOrder'] = $this->Home_admin_model->countMonthlyOrder();


        $data['todaysDirectOrder'] = $this->Home_admin_model->countTodaysDirectOrder();
        $data['weeklyDirectOrder'] = $this->Home_admin_model->countWeeklyDirectOrder();
        $data['monthlyDirectOrder'] = $this->Home_admin_model->countMonthlyDirectOrder();

        $data['todaysSales'] = $this->Home_admin_model->countTodaysSales();
        $data['weeklySales'] = $this->Home_admin_model->countWeeklySales();
        $data['monthlySales'] = $this->Home_admin_model->countMonthlySales();


        $data['listPendingOrder'] = $this->Home_admin_model->listPendingOrder();
        $data['pendingOrder'] = $this->Home_admin_model->countPendingOrder();

        $data['listCancelledOrder'] = $this->Home_admin_model->listCancelledOrder();
        $data['cancelledOrder'] = $this->Home_admin_model->countCancelledOrder();


        
        $data['listPendingDirectOrder'] = $this->Home_admin_model->listPendingDirectOrder();
        $data['pendingDirectOrder'] = $this->Home_admin_model->countPendingDirectOrder();

        $data['listCancelledDirectOrder'] = $this->Home_admin_model->listCancelledDirectOrder();
        $data['cancelledDirectOrder'] = $this->Home_admin_model->countCancelledDirectOrder();

        //$data['newOrdersCount'] = $this->Orders_model->ordersCount(true);
        $data['lowQuantity'] = $this->Home_admin_model->countLowQuantityProducts();
        $data['lastSubscribed'] = $this->Home_admin_model->lastSubscribedEmailsCount();
        $data['activity'] = $this->History_model->getHistory(10, 0);
        $data['mostSold'] = $this->Home_admin_model->getMostSoldProducts();
        $data['byReferral'] = $this->Home_admin_model->getReferralOrders();
        $data['ordersByPaymentType'] = $this->Home_admin_model->getOrdersByPaymentType();
        $data['ordersByMonth'] = $this->Home_admin_model->getOrdersByMonth();
        $this->load->view('_parts/header', $head);
        $this->load->view('home/home', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
    }

    /*
     * Called from ajax
     */

    public function changePass()
    {
        $this->login_check();
        $result = $this->Home_admin_model->changePass($_POST['new_pass'], $this->username);
        if ($result == true) {
            echo 1;
        } else {
            echo 0;
        }
        $this->saveHistory('Password change for user: ' . $this->username);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin');
    }

}

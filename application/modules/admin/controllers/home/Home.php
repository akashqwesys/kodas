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



        $monthToMonthOrders = $this->Home_admin_model->monthToMonthOrders();
        $mTmOrdersMonth=array();
        $mTmOrdersValue=array();              
        if(!empty($monthToMonthOrders)){
            foreach($monthToMonthOrders as $m_row){
                $mTmOrdersMonth[]=  $m_row['MonthName'];
                $mTmOrdersValue[]=  $m_row['cnt'];                                  
            }
        } 
        $data['mTmOrdersMonthStr']=implode('","',$mTmOrdersMonth);
        $data['mTmOrdersValue']=implode(',',$mTmOrdersValue);       


        $monthToMonthActiveCustomer = $this->Home_admin_model->monthToMonthActiveCustomer();
        $mTmActiveCustomerMonth=array();
        $mTmActiveCustomerValue=array();              
        if(!empty($monthToMonthActiveCustomer)){
            foreach($monthToMonthActiveCustomer as $m_row){
                $mTmActiveCustomerMonth[]=  $m_row['MonthName'];
                $mTmActiveCustomerValue[]=  $m_row['cnt'];                                  
            }
        } 
        $data['mTmActiveCustomerMonthStr']=implode('","',$mTmActiveCustomerMonth);
        $data['mTmActiveCustomerValue']=implode(',',$mTmActiveCustomerValue); 
        
        $semiArray=array();
        $monthToMonthViewVsOrders = $this->Home_admin_model->monthToMonthViewVsOrders();
        if(!empty($monthToMonthOrders) && !empty($monthToMonthViewVsOrders)){
            foreach($monthToMonthOrders as $m_row){
                $voArray=array();                
                foreach($monthToMonthViewVsOrders as $vo_row){
                    if($m_row['MonthNo']==$vo_row['MonthNo']){
                        $voArray['orders']= $m_row['cnt'];
                        $voArray['views']= $vo_row['cnt'];
                        $voArray['MonthName']= $vo_row['MonthName'];
                        $voArray['MonthNo']= $vo_row['MonthNo'];
                        $voArray['YearNo']= $vo_row['YearNo'];
                    }
                }
                if(empty($voArray)){
                    $voArray['orders']= $m_row['cnt'];
                    $voArray['views']= 0;
                    $voArray['MonthName']= $m_row['MonthName'];
                    $voArray['MonthNo']= $m_row['MonthNo'];
                    $voArray['YearNo']= $m_row['YearNo'];
                }
                $semiArray[]=$voArray;                                 
            }    
        }


        $semiArray2=array();      
        if(!empty($monthToMonthViewVsOrders) && !empty($monthToMonthViewVsOrders)){
            foreach($monthToMonthViewVsOrders as $m_row){
                $voArray=array();
                foreach($semiArray as $vo_row){
                    if($m_row['MonthNo']==$vo_row['MonthNo']){
                        $voArray['orders']= $vo_row['orders'];
                        $voArray['views']= $m_row['cnt'];
                        $voArray['MonthName']= $vo_row['MonthName'];
                        $voArray['MonthNo']= $vo_row['MonthNo'];
                        $voArray['YearNo']= $vo_row['YearNo'];
                    }
                }
                if(empty($voArray)){
                    $voArray['orders']= 0;
                    $voArray['views']= $m_row['cnt'];
                    $voArray['MonthName']= $m_row['MonthName'];
                    $voArray['MonthNo']= $m_row['MonthNo'];
                    $voArray['YearNo']= $m_row['YearNo'];    
                }                
                $semiArray2[]=$voArray;                                 
            }    
        }
        $myArray = array_merge($semiArray, $semiArray2);  
        usort($myArray, function($a, $b) {
            return $a['MonthNo'] <=> $b['MonthNo'];
        });        
        $temp_array = [];
        foreach ($myArray as &$v) {
            if (!isset($temp_array[$v['MonthNo']]))
            $temp_array[$v['MonthNo']] =& $v;
        }
        $myArray = array_values($temp_array);    
        usort($myArray, function($a, $b) {
            return $a['YearNo'] <=> $b['YearNo'];
        });
        
        // echo '<pre>';print_r($myArray);die;
        $voOrders=array();
        $voViews=array(); 
        $voMonth=array();             
        if(!empty($myArray)){
            foreach($myArray as $m_row){
                $voOrders[]= $m_row['orders'];
                $voViews[]=  $m_row['views'];
                $voMonth[]=  $m_row['MonthName'];                                
            }
        } 
        $data['voOrders']=implode(',',$voOrders);
        $data['voViews']=implode(',',$voViews); 
        $data['voMonth']=implode('","',$voMonth);



        


        $semiArray=array();
        $monthToMonthRegisterUser = $this->Home_admin_model->monthToMonthRegisterUser();
        if(!empty($monthToMonthOrders) && !empty($monthToMonthRegisterUser)){
            foreach($monthToMonthOrders as $m_row){
                $voArray=array();                
                foreach($monthToMonthRegisterUser as $vo_row){
                    if($m_row['MonthNo']==$vo_row['MonthNo']){
                        $voArray['orders']= $m_row['cnt'];
                        $voArray['user']= $vo_row['cnt'];
                        $voArray['MonthName']= $vo_row['MonthName'];
                        $voArray['MonthNo']= $vo_row['MonthNo'];
                        $voArray['YearNo']= $vo_row['YearNo'];
                    }
                }
                if(empty($voArray)){
                    $voArray['orders']= $m_row['cnt'];
                    $voArray['user']= 0;
                    $voArray['MonthName']= $m_row['MonthName'];
                    $voArray['MonthNo']= $m_row['MonthNo'];
                    $voArray['YearNo']= $m_row['YearNo'];
                }
                $semiArray[]=$voArray;                                 
            }    
        }


        $semiArray2=array();      
        if(!empty($monthToMonthRegisterUser) && !empty($monthToMonthRegisterUser)){
            foreach($monthToMonthRegisterUser as $m_row){
                $voArray=array();
                foreach($semiArray as $vo_row){
                    if($m_row['MonthNo']==$vo_row['MonthNo']){
                        $voArray['orders']= $vo_row['orders'];
                        $voArray['user']= $m_row['cnt'];
                        $voArray['MonthName']= $vo_row['MonthName'];
                        $voArray['MonthNo']= $vo_row['MonthNo'];
                        $voArray['YearNo']= $vo_row['YearNo'];
                    }
                }
                if(empty($voArray)){
                    $voArray['orders']= 0;
                    $voArray['user']= $m_row['cnt'];
                    $voArray['MonthName']= $m_row['MonthName'];
                    $voArray['MonthNo']= $m_row['MonthNo'];
                    $voArray['YearNo']= $m_row['YearNo'];    
                }                
                $semiArray2[]=$voArray;                                 
            }    
        }
        $myArray = array_merge($semiArray, $semiArray2);  
        usort($myArray, function($a, $b) {
            return $a['MonthNo'] <=> $b['MonthNo'];
        });        
        $temp_array = [];
        foreach ($myArray as &$v) {
            if (!isset($temp_array[$v['MonthNo']]))
            $temp_array[$v['MonthNo']] =& $v;
        }
        $myArray = array_values($temp_array);    
        usort($myArray, function($a, $b) {
            return $a['YearNo'] <=> $b['YearNo'];
        });
        
        // echo '<pre>';print_r($myArray);die;
        $coOrders=array();
        $coUser=array(); 
        $coMonth=array();             
        if(!empty($myArray)){
            foreach($myArray as $m_row){
                $coOrders[]= $m_row['orders'];
                $coUser[]=  $m_row['user'];
                $coMonth[]=  $m_row['MonthName'];                                
            }
        } 
        $data['coOrders']=implode(',',$coOrders);
        $data['coUser']=implode(',',$coUser); 
        $data['coMonth']=implode('","',$coMonth);


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

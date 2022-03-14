<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Apilist extends REST_Controller {

	private $allowed_img_types;

	function __construct() {
		parent::__construct();
		$this->methods['all_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['one_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['set_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['productDel_delete']['limit'] = 50; // 50 requests per hour per user/key
		$this->load->model(array('Api_model', 'admin/Products_model'));
		$this->allowed_img_types = $this->config->item('allowed_img_types');
	}

	/*
		     * Get All Products
	*/

	public function GetContact_get($lang) {
		//echo 'test1'; exit;
		$products = $this->Api_model->GetContactUs($lang);

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($products) {
			// Set the response and exit
			$this->response($products, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No products were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get Msg Count
	*/

	public function MsgCount_get($lang) {
		//echo 'test1'; exit;
		$products = $this->Api_model->MsgCountfun($lang);

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($products) {
			// Set the response and exit
			$this->response($products, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No products were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get Msg Count
	*/

	public function Readcountmsg_get() {
		$products = $this->Api_model->ReadCountfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($products) {
			// Set the response and exit
			$this->response($products, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No products were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get Msg Count
	*/

	public function Adminunread_get() {
		$products = $this->Api_model->Adminunreadfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($products) {
			// Set the response and exit
			$this->response($products, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No products were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get All Products
	*/

	public function CheckCoupon_get($lang) {
		//echo 'test1'; exit;
		$products = $this->Api_model->CheckCouponfun($lang);

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($products) {
			// Set the response and exit
			$this->response($products, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No products were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get Pre Launch
	*/
	public function Prelaunchbanner_get() {
		//echo 'test1'; exit;
		$products = $this->Api_model->Prelaunchbannerfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($products) {
			// Set the response and exit
			$this->response($products, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No products were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		* Get Get Video List
	*/

	public function getvideolist_get() {
		//echo 'test1'; exit;
		$products = $this->Api_model->Getvideolistfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($products) {
			// Set the response and exit
			$this->response($products, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No products were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		* Get GetAboutUsFun
	*/

	public function GetAboutUs_get($lang) {
		//echo 'test1'; exit;
		$products = $this->Api_model->GetAboutUsFun($lang);

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($products) {
			// Set the response and exit
			$this->response($products, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No products were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	public function AdminLoginDetails_get() {
		//echo 'test1'; exit;
		$products = $this->Api_model->AdminLoginDetails();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($products) {
			// Set the response and exit
			$this->response($products, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No products were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Add Signup
	*/
	public function AddSignup_post() {

		$product = $this->Api_model->AddSignupfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One GetAllOrderBySearchNewfun
	*/

	public function GetAllOrderBySearchNew_get() {

		$product = $this->Api_model->GetAllOrderBySearchNewfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One GetAllOrderByType
	*/

	public function GetAllOrderByTypeNew_get() {

		$product = $this->Api_model->GetAllOrderByTypeNewfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Change Order Status
	*/

	public function Changeorderstatus_post() {
		$product = $this->Api_model->Updateorderstatusfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Send Order Message
	*/

	public function Sendordermessage_post() {
		$product = $this->Api_model->sendordersmsgfunc();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Status List
	*/

	public function GetStatuslist_get() {

		$product = $this->Api_model->Orderstatuslistfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get AddAddress
	*/
	public function AddAddress_post() {

		$product = $this->Api_model->AddAddressFun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One UpdateUserAddress
	*/

	public function UpdateUserAddress_post() {

		$product = $this->Api_model->UpdateUserAddressfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One RemoveUserAddress
	*/

	public function RemoveUserAddress_post() {

		$product = $this->Api_model->RemoveUserAddressfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

/*
 * Get One RemoveUserAddress
 */

	public function GetUserAddress_get() {

		$product = $this->Api_model->GetUserAddressfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Product
	*/

	public function Productsbyid_get() {

		$product = $this->Api_model->getProductsbyid($_GET['ItemId']);

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Pre Product List
	*/

	public function Preproductslist_get() {

		$product = $this->Api_model->getpreProducts();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}


	public function productslistByCat_get() {

// 		$filter=array();
// $filter['moq']=array('abc','def','efg');
// $filter['type']=array('a','b','c');
// $filter['blouse']=array('b_1','b_2','b_3');
// $filter['category']=array('a','b','c','abc','def');
		// $filter=json_encode($filter);
		$response=array();
		$catid=$_REQUEST['catid'];
		$sort=$_REQUEST['sort'];
		$filter=json_decode($_REQUEST['filter']);	
		// print_r($filter);die;	
		$response['product'] = $this->Api_model->getProductByCategory($catid,$sort,$filter,'en');

		$response['sort']=array();
		$response['sort'][0]['title']='Price Low to High';
		$response['sort'][0]['value']='price_low_to_high';

		$response['sort'][1]['title']='Price High to Low';
		$response['sort'][1]['value']='price_high_to_low';

		$response['sort'][2]['title']='Latest';
		$response['sort'][2]['value']='latest';

		$response['sort'][3]['title']='Oldest';
		$response['sort'][3]['value']='oldest';

		$response['sort'][3]['title']='Best Offer';
		$response['sort'][3]['value']='best_offer';

		$response['filter']=array();
		$ag_res=$this->Api_model->getAttributeGroup();
		$at_res=$this->Api_model->getAttributes();
		if(!empty($ag_res)){
			foreach($ag_res as $ag_row){
				$ag_row['list']	=array();			
				foreach($at_res as $atr_row){
					if($ag_row['attributesgroup_id']==$atr_row['refAttributes_group_id']){
						array_push($ag_row['list'],$atr_row);
					}							
				}
				array_push($response['filter'],$ag_row);	
			}
		}
		// print_r($response['filter']);die;
		// Check if the products data store contains products (in case the database result returns NULL)
		if ($response['product']) {
			// Set the response and exit
			$this->response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Pre Product Details
	*/

	public function GlobalSearch_get() {

		$product = $this->Api_model->GlobalgetProducts();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get Global Search Product
	*/

	public function Preproductsbyid_get() {

		$product = $this->Api_model->getpreProductsbyid($_GET['ItemId']);

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Pre Product Details
	*/

	public function LikePreProduct_get() {

		$product = $this->Api_model->likepreproductadd();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Pre Product Details
	*/

	public function LikePreProductImg_post() {

		$product = $this->Api_model->likepreproductimgadd();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	public function UndoLikeProductImg_post() {

		$product = $this->Api_model->UndoLikeProductImg();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	public function UndoLikePreProductImg_post() {

		$product = $this->Api_model->UndoLikePreProductImg();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Pre Product Details
	*/

	public function LikeProductImgs_post() {

		$product = $this->Api_model->LikeProductImgsadd();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One GetLoginData
	*/

	public function GetLoginData_get() {

		$product = $this->Api_model->GetLoginDetails();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One GetLoginData
	*/

	public function Singalorderdata_get() {

		$product = $this->Api_model->sendorderdetailsfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One SendOtp
	*/

	public function SendOtp_post() {		
		$product = $this->Api_model->GetSendOtpFun();
		// sendsms($mobileno,$six_digit_random_number);

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One SendOtp
	*/

	public function OtpVerification_get() {

		$product = $this->Api_model->GetOtpVerificationFun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Home Slider Images
	*/

	public function HomeSlider_get() {
		$product = $this->Api_model->HomeSliderFun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One AddToCart
	*/

	public function AddToCart_post() {
		$product = $this->Api_model->AddToCart();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	public function GetMemberFCMToken_post() {
		$product = $this->Api_model->GetMemberFCMTokenFun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}


	public function Home_get($lang) {

		$response=array();
		$response['slider'] = $this->Api_model->HomeSliderFun();
		$response['catlist'] = $this->Api_model->Catlistfun();

		$response['trending_product'] = $this->Api_model->getProducts($lang,'trending');
		$response['latest_product'] = $this->Api_model->getProducts($lang,'latest');
		$response['recommended_product'] = $this->Api_model->getProducts($lang,'recommended');
		// Check if the products data store contains products (in case the database result returns NULL)
		if (!empty($response)) {
			// Set the response and exit
			$this->response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Catlist
	*/
	public function Catlist_get() {

		$product = $this->Api_model->Catlistfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One GetMyCart
	*/

	public function GetMyCart_get() {
		
		$product = $this->Api_model->GetMyCart();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One RemoveCartItem
	*/

	public function RemoveCartItem_post() {

		$product = $this->Api_model->RemoveCartItemfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One UpdateCartItem
	*/

	public function UpdateCartItem_post() {

		$product = $this->Api_model->UpdateCartItemfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One CheckOut
	*/

	public function CheckOut_post() {

		$product = $this->Api_model->CheckOutfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One GetCartCount
	*/

	public function GetCartCount_post() {

		$product = $this->Api_model->GetCartCountfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One UpdateMemberInfo
	*/

	public function UpdateMemberInfo_get() {

		$product = $this->Api_model->UpdateMemberInfofun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One UpdateMemberPhoto
	*/

	public function UpdateMemberPhoto_post() {

		$product = $this->Api_model->UpdateMemberPhotofun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One AddPhotoOrder
	*/

	public function AddPhotoOrder_post() {

		$product = $this->Api_model->AddPhotoOrderfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One GetOrderByType
	*/


	public function MyOrderList_get() {
		$product = $this->Api_model->MyOrderListfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}	
	}

	public function GetOrderByType_get() {

		$product = $this->Api_model->GetOrderByTypefun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One GetOrderByType
	*/

	public function GetOrderByTypeNew_get() {

		$product = $this->Api_model->GetOrderByTypeNewfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Dashboardcount
	*/

	public function Dashboardcount_get() {

		$product = $this->Api_model->Dashboardcountfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Send User Message
	*/

	public function Sendusermessage_post() {

		$product = $this->Api_model->SenduserMessageFun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Topcustomer
	*/

	public function Topcustomer_get() {

		$product = $this->Api_model->Topcustomerfun();
		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Bottomcustomer
	*/

	public function Bottomcustomer_get() {

		$product = $this->Api_model->Bottomcustomerfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One Change Device ID List
	*/

	public function Changedevicelist_get() {

		$product = $this->Api_model->Changedevicelistfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One RecentView
	*/

	public function RecentView_get() {

		$product = $this->Api_model->recentviewProductsfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One RecentView
	*/

	public function GetCancelOrder_post() {

		$product = $this->Api_model->GetCancelOrderfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One MessageList
	*/

	public function MessageList_get() {

		$product = $this->Api_model->MessangerListFun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One SendMessage
	*/

	public function SendMessage_post() {

		$product = $this->Api_model->SendMessageFun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One OrderMessageList
	*/

	public function OrderMessageList_get() {
		$product = $this->Api_model->OrderMessangerListFun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One SendMessage
	*/

	public function OrderSendMessage_post() {
		$product = $this->Api_model->OrderSendMessageFun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}
	/*
		     * Get One SendMessage
	*/

	public function CustomerPendingApproval_post() {
		$product = $this->Api_model->CustomerPendingApprovalFun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}
	/*
		     * Get One AttributeList
	*/

	public function AttributeList_get() {

		$product = $this->Api_model->AttributeListFun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One AttributeList
	*/

	public function NotificationList_get() {

		$product = $this->Api_model->Notificationdatafun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Get One AttributeList
	*/

	public function CustomerPendinglist_get() {

		$product = $this->Api_model->CustomerPendinglistfun();

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	public function one_get($lang, $id) {
		
		$product = $this->Api_model->getProduct($lang, $id);

		// Check if the products data store contains products (in case the database result returns NULL)
		if ($product) {
			// Set the response and exit
			$this->response($product, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	public function unreadcustomer_get() {
		$unreadcustomer = $this->Api_model->unreadcustomerfun();
		// Check if the products data store contains products (in case the database result returns NULL)
		if ($unreadcustomer) {
			// Set the response and exit
			$this->response($unreadcustomer, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	public function readcustomer_get() {
		$readcustomer = $this->Api_model->readcustomerfun();
		// Check if the products data store contains products (in case the database result returns NULL)
		if ($readcustomer) {
			// Set the response and exit
			$this->response($readcustomer, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		} else {
			// Set the response and exit
			$this->response([
				'status' => FALSE,
				'message' => 'No product were found',
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	/*
		     * Set Product
	*/

	public function set_post() {
		echo 'test3';exit;
		$errors = [];
		$_POST['image'] = $this->uploadImage();
		if (!isset($_POST['translations']) || empty($_POST['translations'])) {
			$errors[] = 'No translations array or empty';
		}
		if (!isset($_POST['title']) || empty($_POST['title'])) {
			$errors[] = 'No title array or empty';
		}
		if (!isset($_POST['basic_description']) || empty($_POST['basic_description'])) {
			$errors[] = 'No basic_description array or empty';
		}
		if (!isset($_POST['description']) || empty($_POST['description'])) {
			$errors[] = 'No description array or empty';
		}
		if (!isset($_POST['price']) || empty($_POST['price'])) {
			$errors[] = 'No price array or empty';
		}
		if (!isset($_POST['old_price']) || empty($_POST['old_price'])) {
			$errors[] = 'No old_price array or empty';
		}
		if (!isset($_POST['shop_categorie'])) {
			$errors[] = 'shop_categorie not found';
		}
		if (!isset($_POST['quantity'])) {
			$errors[] = 'quantity not found';
		}
		if (!isset($_POST['in_slider'])) {
			$errors[] = 'in_slider not found';
		}
		if (!isset($_POST['position'])) {
			$errors[] = 'position not found';
		}
		if (!empty($errors)) {
			$error = implode(", ", $errors);
			$message = [
				'message' => $error,
			];
		} else {
			$this->Api_model->setProduct($_POST);
			$message = [
				'message' => 'Added a resource',
			];
		}
		$this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
	}

	private function uploadImage() {
		$config['upload_path'] = './attachments/shop_images/';
		$config['allowed_types'] = $this->allowed_img_types;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('userfile')) {
			log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
		}
		$img = $this->upload->data();
		return $img['file_name'];
	}

	public function productDel_delete($id) {
		$id = (int) $id;
		// Validate the id.
		if ($id <= 0) {
			// Set the response and exit
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
		}
		$this->Api_model->deleteProduct($id);
		$message = [
			'id' => $id,
			'message' => 'Deleted the resource',
		];
		$this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
	}

}

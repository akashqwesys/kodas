<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'home';

// Load default conrtoller when have only currency from multilanguage
$route['^(\w{2})$'] = $route['default_controller'];

//Checkout
$route['(\w{2})?/?checkout/successcash'] = 'checkout/successPaymentCashOnD';
$route['(\w{2})?/?checkout/successbank'] = 'checkout/successPaymentBank';
$route['(\w{2})?/?checkout/paypalpayment'] = 'checkout/paypalPayment';
$route['(\w{2})?/?checkout/order-error'] = 'checkout/orderError';

// Ajax called. Functions for managing shopping cart
$route['(\w{2})?/?manageShoppingCart'] = 'home/manageShoppingCart';
$route['(\w{2})?/?clearShoppingCart'] = 'home/clearShoppingCart';
$route['(\w{2})?/?discountCodeChecker'] = 'home/discountCodeChecker';

// home page pagination
#$route[rawurlencode('home') . '/(:num)'] = "home/index/$1";
// load javascript language file
$route['loadlanguage/(:any)'] = 'Loader/jsFile/$1';
// load default-gradient css
$route['cssloader/(:any)'] = 'Loader/cssStyle';

// Template Routes
$route['template/imgs/(:any)'] = 'Loader/templateCssImage/$1';
$route['templatecss/imgs/(:any)'] = 'Loader/templateCssImage/$1';
$route['templatecss/(:any)'] = 'Loader/templateCss/$1';
$route['templatejs/(:any)'] = 'Loader/templateJs/$1';

// Products urls style
// $route['(:any)_(:num)'] = "home/viewProduct/$2";
// $route['(\w{2})/(:any)_(:num)'] = "home/viewProduct/$3";
// $route['shop-product_(:num)'] = "home/viewProduct/$3";

// blog urls style and pagination
$route['blog/(:num)'] = 'blog/index/$1';
$route['blog/(:any)_(:num)'] = 'blog/viewPost/$2';
$route['(\w{2})/blog/(:any)_(:num)'] = 'blog/viewPost/$3';

// Shopping cart page
$route['shopping-cart'] = 'ShoppingCartPage';
$route['(\w{2})/shopping-cart'] = 'ShoppingCartPage';

// Shop page (greenlabel template)
$route['shop'] = 'home/shop';
$route['(\w{2})/shop'] = 'home/shop';
//pages

// $route['pages/(:any)'] = 'home/aboutus';

$route['aboutus'] = 'home/aboutus';
$route['refundpolicy'] = 'home/refund';
$route['privacypolicy'] = 'home/privacy';
$route['termandservices'] = 'home/term';
$route['privacypolicymobile'] = 'home/privacymobile';
$route['termandservicesmobile'] = 'home/termmobile';
$route['refundpolicymobile'] = 'home/refundmobile';

$route['contactus'] = 'home/contactus';
$route['catalog'] = 'home/catalog';
$route['catalogdetail'] = 'home/catalogdetail';
$route['web'] = 'home/redirectwebsite';
$route['savemail'] = 'home/savemail';

// Textual Pages links
$route['page/(:any)'] = 'page/index/$1';
$route['(\w{2})/page/(:any)'] = 'page/index/$2';

// Login Public Users Page
$route['login'] = 'Users/login';
$route['(\w{2})/login'] = 'Users/login';

// Register Public Users Page
$route['register'] = 'Users/register';
$route['(\w{2})/register'] = 'Users/register';

// Users Profiles Public Users Page
$route['myaccount'] = 'Users/myaccount';
$route['myaccount/(:num)'] = 'Users/myaccount/$1';
$route['(\w{2})/myaccount'] = 'Users/myaccount';
$route['(\w{2})/myaccount/(:num)'] = 'Users/myaccount/$2';

// Logout Profiles Public Users Page
$route['logout'] = 'Users/logout';
$route['(\w{2})/logout'] = 'Users/logout';

$route['sitemap.xml'] = 'home/sitemap';

// Confirm link
$route['confirm/(:any)'] = 'home/confirmLink/$1';

/*
 * Vendor Controllers Routes
 */
$route['vendor/login'] = 'vendor/auth/login';
$route['(\w{2})/vendor/login'] = 'vendor/auth/login';
$route['vendor/register'] = 'vendor/auth/register';
$route['(\w{2})/vendor/register'] = 'vendor/auth/register';
$route['vendor/forgotten-password'] = 'vendor/auth/forgotten';
$route['(\w{2})/vendor/forgotten-password'] = 'vendor/auth/forgotten';
$route['vendor/me'] = 'vendor/VendorProfile';
$route['(\w{2})/vendor/me'] = 'vendor/VendorProfile';
$route['vendor/logout'] = 'vendor/VendorProfile/logout';
$route['(\w{2})/vendor/logout'] = 'vendor/VendorProfile/logout';
$route['vendor/products'] = 'vendor/Products';
$route['(\w{2})/vendor/products'] = 'vendor/Products';
$route['vendor/products/(:num)'] = 'vendor/Products/index/$1';
$route['(\w{2})/vendor/products/(:num)'] = 'vendor/Products/index/$2';
$route['vendor/add/product'] = 'vendor/AddProduct';
$route['(\w{2})/vendor/add/product'] = 'vendor/AddProduct';
$route['vendor/edit/product/(:num)'] = 'vendor/AddProduct/index/$1';
$route['(\w{2})/vendor/edit/product/(:num)'] = 'vendor/AddProduct/index/$1';
$route['vendor/orders'] = 'vendor/Orders';
$route['(\w{2})/vendor/orders'] = 'vendor/Orders';
$route['vendor/uploadOthersImages'] =
	'vendor/AddProduct/do_upload_others_images';
$route['vendor/loadOthersImages'] = 'vendor/AddProduct/loadOthersImages';
$route['vendor/removeSecondaryImage'] =
	'vendor/AddProduct/removeSecondaryImage';
$route['vendor/delete/product/(:num)'] = 'vendor/products/deleteProduct/$1';
$route['(\w{2})/vendor/delete/product/(:num)'] =
	'vendor/products/deleteProduct/$1';
$route['vendor/view/(:any)'] = 'Vendor/index/0/$1';
$route['(\w{2})/vendor/view/(:any)'] = 'Vendor/index/0/$2';
$route['vendor/view/(:any)/(:num)'] = 'Vendor/index/$2/$1';
$route['(\w{2})/vendor/view/(:any)/(:num)'] = 'Vendor/index/$3/$2';
// $route['(:any)/(:any)_(:num)'] = "Vendor/viewProduct/$1/$3";
// $route['(\w{2})/(:any)/(:any)_(:num)'] = "Vendor/viewProduct/$2/$4";
$route['vendor/changeOrderStatus'] = 'vendor/orders/changeOrdersOrderStatus';

// Site Multilanguage
$route['^(\w{2})/(.*)$'] = '$2';

/*
 * Admin Controllers Routes
 */
$route['admin/get-user-by-status/(:any)'] = 'admin/user/listuser/get_user_by_status/$1';
$route['admin/get-order-by-status/(:any)'] = 'admin/ecommerce/orders/get_order_by_status/$1';
$route['admin/get-user-list'] = 'admin/user/listuser/user_list';
$route['admin/active-inactive-user'] = 'admin/user/listuser/approve_status';
//agent managements
$route['admin/listagent'] = 'admin/agent/agent';
$route['admin/get-agent-list'] = 'admin/agent/agent/agent_list';
$route['admin/addagent'] = 'admin/agent/agent/add_agent';
$route['admin/editagent/(:num)'] = 'admin/agent/agent/edit_agent/$1';

$route['admin/allocate-user/(:num)'] = 'admin/agent/agent/allocate_user/$1';
$route['admin/allocate-user-list/(:num)'] = 'admin/agent/agent/allocate_user_list/$1';
$route['admin/addallocation'] = 'admin/agent/agent/add_allocation';


$route['admin/shareproduct'] = 'admin/shareproduct/shareproduct/shareproduct';
$route['admin/shareproduct-list'] = 'admin/shareproduct/shareproduct/shareproduct_list';
$route['admin/addshareproduct'] = 'admin/shareproduct/shareproduct/add_shareproduct';


$route['admin/agent-history/(:num)'] = 'admin/agent/agent/agent_history/$1';
$route['admin/agent-history-list/(:num)'] = 'admin/agent/agent/agent_history_list/$1';

$route['admin/active-inactive-agent'] = 'admin/agent/agent/approve_status';
$route['admin/change-allocation-status'] = 'admin/agent/agent/customer_allocation_change';


$route['admin/customer-history/(:num)'] = 'admin/user/Userreport/customer_history/$1';
$route['admin/customer-history-list/(:num)'] = 'admin/user/Userreport/customer_history_list/$1';
$route['admin/active-inactive-customer'] = 'admin/user/Adduser/approve_status';



$route['admin/listattributes'] = 'admin/attributes/attributes';
$route['admin/get-attributes-list'] = 'admin/attributes/attributes/attributes_list';
$route['admin/addattributes'] = 'admin/attributes/attributes/add_attributes';
$route['admin/editattributes/(:num)'] = 'admin/attributes/attributes/edit_attributes/$1';
$route['admin/active-inactive-attributes'] = 'admin/attributes/attributes/approve_status';


$route['admin/listcategories'] = 'admin/categories/categories';
$route['admin/get-categories-list'] = 'admin/categories/categories/categories_list';
$route['admin/addcategories'] = 'admin/categories/categories/add_categories';
$route['admin/editcategories/(:num)'] = 'admin/categories/categories/edit_categories/$1';
$route['admin/active-inactive-categories'] = 'admin/categories/categories/approve_status';



$route['admin/removeimg'] = 'admin/ecommerce/Publish/removeimg';
$route['admin/removeaddress'] = 'admin/user/Adduser/removeaddress';

$route['admin/listattributesgroup'] = 'admin/attributesgroup/attributesgroup';
$route['admin/get-attributesgroup-list'] = 'admin/attributesgroup/attributesgroup/attributesgroup_list';
$route['admin/addattributesgroup'] = 'admin/attributesgroup/attributesgroup/add_attributesgroup';
$route['admin/editattributesgroup/(:num)'] = 'admin/attributesgroup/attributesgroup/edit_attributesgroup/$1';
$route['admin/active-inactive-attributesgroup'] = 'admin/attributesgroup/attributesgroup/approve_status';


$route['admin/get-orders-list'] = 'admin/ecommerce/orders/order_list';

$route['admin/listcoupan'] = 'admin/coupan/coupan';
$route['admin/get-coupan-list'] = 'admin/coupan/coupan/coupan_list';
$route['admin/addcoupan'] = 'admin/coupan/coupan/add_coupan';
$route['admin/editcoupan/(:num)'] = 'admin/coupan/coupan/edit_coupan/$1';
$route['admin/active-inactive-coupan'] = 'admin/coupan/coupan/approve_status';

$route['admin/listpackagingtype'] = 'admin/packagingtype/packagingtype';
$route['admin/get-packagingtype-list'] = 'admin/packagingtype/packagingtype/packagingtype_list';
$route['admin/addpackagingtype'] = 'admin/packagingtype/packagingtype/add_packagingtype';
$route['admin/editpackagingtype/(:num)'] = 'admin/packagingtype/packagingtype/edit_packagingtype/$1';
$route['admin/active-inactive-packagingtype'] = 'admin/packagingtype/packagingtype/approve_status';

$route['admin/active-inactive-products'] = 'admin/ecommerce/products/approve_status';

// HOME / LOGIN
$route['admin'] = 'admin/home/login';
// ECOMMERCE GROUP
$route['admin/publish'] = 'admin/ecommerce/publish';
$route['admin/publish/(:num)'] = 'admin/ecommerce/publish/index/$1';
$route['admin/removeSecondaryImage'] =
	'admin/ecommerce/publish/removeSecondaryImage';
$route['admin/products'] = 'admin/ecommerce/products';
$route['admin/products/(:num)'] = 'admin/ecommerce/products/index/$1';

$route['admin/get-product-list'] = 'admin/ecommerce/products/product_list';

$route['admin/stock/(:num)'] = 'admin/ecommerce/stock/index/$1';
$route['admin/get-stock-list'] = 'admin/ecommerce/stock/stock_list';

$route['admin/prepublish'] = 'admin/ecommerce/prepublish';
$route['admin/prepublish/(:num)'] = 'admin/ecommerce/prepublish/index/$1';
$route['admin/preproducts'] = 'admin/ecommerce/preproducts';
$route['admin/preproducts/(:num)'] = 'admin/ecommerce/preproducts/index/$1';
$route['admin/preremoveSecondaryImage'] =
	'admin/ecommerce/prepublish/preremoveSecondaryImage';

$route['admin/productStatusChange'] =
	'admin/ecommerce/products/productStatusChange';
$route['admin/shopcategories'] = 'admin/ecommerce/ShopCategories';
$route['admin/shopattribute'] = 'admin/ecommerce/ShopAttribute';
$route['admin/shopcategories/(:num)'] =
	'admin/ecommerce/ShopCategories/index/$1';
$route['admin/shopattribute/(:num)'] = 'admin/ecommerce/ShopAttribute/index/$1';
$route['admin/editshopcategorie'] =
	'admin/ecommerce/ShopCategories/editShopCategorie';
$route['admin/editshopattribute'] =
	'admin/ecommerce/ShopAttribute/editShopAttribute';
$route['admin/orders'] = 'admin/ecommerce/orders';
$route['admin/directorders'] = 'admin/ecommerce/directorders';
$route['admin/orders/(:num)'] = 'admin/ecommerce/orders/index/$1';
$route['admin/directorders/(:num)'] = 'admin/ecommerce/directorders/index/$1';
$route['admin/ordersdetails'] = 'admin/ecommerce/orders';
$route['admin/ordersdetails/(:num)'] = 'admin/ecommerce/ordersdetails/order/$1';
$route['admin/directordersdetails'] = 'admin/ecommerce/directorders';
$route['admin/directordersdetails/(:num)'] =
	'admin/ecommerce/directordersdetails/directorder/$1';
$route['admin/changeOrdersOrderStatus'] =
	'admin/ecommerce/ordersdetails/changeOrdersOrderStatus';

$route['admin/changeOrdersOrderStatusImport']  = 'admin/ecommerce/ordersdetails/changeOrdersOrderStatusImport';

$route['admin/changedirectOrderStatus'] =
	'admin/ecommerce/directordersdetails/changedirectOrderStatus';
$route['admin/brands'] = 'admin/ecommerce/brands';
$route['admin/changePosition'] =
	'admin/ecommerce/ShopCategories/changePosition';
$route['admin/changePositionAttr'] =
	'admin/ecommerce/ShopAttribute/changePositionAttr';
$route['admin/discounts'] = 'admin/ecommerce/discounts';
$route['admin/discounts/(:num)'] = 'admin/ecommerce/discounts/index/$1';
// BLOG GROUP
$route['admin/blogpublish'] = 'admin/blog/BlogPublish';
$route['admin/blogpublish/(:num)'] = 'admin/blog/BlogPublish/index/$1';
$route['admin/blog'] = 'admin/blog/blog';
$route['admin/blog/(:num)'] = 'admin/blog/blog/index/$1';
// USER GROUP
$route['admin/adduser'] = 'admin/user/adduser';
$route['admin/adduser/(:num)'] = 'admin/user/adduser/index/$1';
$route['admin/viewchat/(:num)'] = 'admin/user/viewchat/index/$1';
$route['admin/chatfunction'] = 'admin/user/viewchat/chatfunction';
$route['admin/chatsendfunction'] = 'admin/user/viewchat/chatsendfunction';
$route['admin/listuser'] = 'admin/user/listuser';
$route['admin/listuser/(:num)'] = 'admin/user/listuser/index/$1';
$route['admin/chatlist'] = 'admin/user/chatlist';
$route['admin/chatlist/(:num)'] = 'admin/user/chatlist/index/$1';
$route['admin/userreport'] = 'admin/user/Userreport';
$route['admin/userreport/(:any)'] = 'admin/user/Userreport/index/$1';
$route['admin/likedislike/(:num)'] = 'admin/user/likedislike/index/$1';
$route['admin/likedislikeproimg/(:num)'] = 'admin/ecommerce/likedislikeproimg/index/$1';
$route['admin/likedislikepreproimg/(:num)'] = 'admin/ecommerce/likedislikepreproimg/index/$1';
$route['admin/viewproduct/(:num)'] = 'admin/user/viewproduct/index/$1';
$route['admin/listuserStatusChange'] =
	'admin/user/listuser/listuserStatusChange';

$route['admin/addbulkuser'] = 'admin/user/adduser/addbulkuser';
$route['admin/addbulkagent'] = 'admin/agent/agent/addbulkagent';


$route['admin/newsletter'] = 'admin/newsletter/newsletter';
$route['admin/newsletter/(:num)'] = 'admin/newsletter/newsletter/index/$1';
$route['admin/get-newsletter-list'] = 'admin/newsletter/newsletter/newsletter_list';


$route['admin/viewchatagent/(:num)'] = 'admin/agent/viewchat/index/$1';
$route['admin/chatfunctionagent'] = 'admin/agent/viewchat/chatfunction';
$route['admin/chatsendfunctionagent'] = 'admin/agent/viewchat/chatsendfunction';
$route['admin/chatlistagent'] = 'admin/agent/chatlist';
$route['admin/chatlistagent/(:num)'] = 'admin/agent/chatlist/index/$1';



// About
$route['admin/addabout'] = 'admin/about/addabout';
$route['admin/addabout/(:num)'] = 'admin/about/addabout/index/$1';
$route['admin/listabout'] = 'admin/about/listabout';
$route['admin/listabout/(:num)'] = 'admin/about/listabout/index/$1';

// Mobile User
$route['admin/addmobileuser'] = "admin/mobileuser/addmobileuser";
$route['admin/addmobileuser/(:num)'] = "admin/mobileuser/addmobileuser/index/$1";
$route['admin/addmobileuser/add'] = "admin/mobileuser/addmobileuser/add";
$route['admin/addmobileuser/add/(:num)'] = "admin/mobileuser/addmobileuser/add/$1";

// Term
$route['admin/addterm'] = 'admin/term/addterm';
$route['admin/addterm/(:num)'] = 'admin/term/addterm/index/$1';
$route['admin/listterm'] = 'admin/term/listterm';
$route['admin/listterm/(:num)'] = 'admin/term/listterm/index/$1';

// Privacy
$route['admin/addprivacy'] = 'admin/privacy/addprivacy';
$route['admin/addprivacy/(:num)'] = 'admin/privacy/addprivacy/index/$1';
$route['admin/listprivacy'] = 'admin/privacy/listprivacy';
$route['admin/listprivacy/(:num)'] = 'admin/privacy/listprivacy/index/$1';

// Refund Policy
$route['admin/addrefund'] = 'admin/refund/addrefund';
$route['admin/addrefund/(:num)'] = 'admin/refund/addrefund/index/$1';
$route['admin/listrefund'] = 'admin/refund/listrefund';
$route['admin/listrefund/(:num)'] = 'admin/refund/listrefund/index/$1';

// Coupan
// $route['admin/addcoupan'] = 'admin/coupan/addcoupan';
// $route['admin/addcoupan/(:num)'] = 'admin/coupan/addcoupan/index/$1';
// $route['admin/addcoupan/add'] = 'admin/coupan/addcoupan/add';
// $route['admin/addcoupan/add/(:num)'] = 'admin/coupan/addcoupan/add/$1';

// SETTINGS GROUP
$route['admin/settings'] = 'admin/settings/settings';
$route['admin/styling'] = 'admin/settings/styling';
$route['admin/templates'] = 'admin/settings/templates';
$route['admin/titles'] = 'admin/settings/titles';
$route['admin/pages'] = 'admin/settings/pages';
$route['admin/emails'] = 'admin/settings/emails';
$route['admin/emails/(:num)'] = 'admin/settings/emails/index/$1';
$route['admin/history'] = 'admin/settings/history';
$route['admin/history/(:num)'] = 'admin/settings/history/index/$1';
$route['admin/listslider'] = 'admin/settings/listslider';
$route['admin/listslider/(:num)'] = 'admin/settings/listslider/index/$1';
// ADVANCED SETTINGS
$route['admin/languages'] = 'admin/advanced_settings/languages';
$route['admin/filemanager'] = 'admin/advanced_settings/filemanager';
$route['admin/adminusers'] = 'admin/advanced_settings/adminusers';
// TEXTUAL PAGES
$route['admin/pageedit/(:any)'] =
	'admin/textual_pages/TextualPages/pageEdit/$1';
$route['admin/changePageStatus'] =
	'admin/textual_pages/TextualPages/changePageStatus';
// LOGOUT
$route['admin/logout'] = 'admin/home/home/logout';
// Admin pass change ajax
$route['admin/changePass'] = 'admin/home/home/changePass';
$route['admin/uploadOthersImages'] =
	'admin/ecommerce/publish/do_upload_others_images';
$route['admin/loadOthersImages'] = 'admin/ecommerce/publish/loadOthersImages';

$route['admin/uploadOthersPdf'] =
	'admin/ecommerce/publish/do_upload_others_pdf';

$route['admin/uploadOthersImages'] =
	'admin/ecommerce/prepublish/do_upload_others_images';
$route['admin/loadOthersImages'] =
	'admin/ecommerce/prepublish/loadOthersImages';


	$route['admin/add-order'] =
	'admin/ecommerce/orders/addOrder';
	$route['admin/load-address'] =
	'admin/ecommerce/orders/load_address';

	$route['admin/add-stock/(:num)'] =
	'admin/ecommerce/products/addStock/$1';

// $route['admin/uploadOthersPdf1'] = "admin/ecommerce/prepublish/do_upload_others_pdf";

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
 */



$route['api/agent/dashboard'] = 'Api/Apilist/DashboardAgent';
$route['api/agent/customerList'] = 'Api/Apilist/customerList';
$route['api/agent/customerDetails'] = 'Api/Apilist/customerDetails';

$route['api/Home'] = 'Api/Apilist/Home/$1';
$route['api/GetProductListByType'] = 'Api/Products/all/$1';
$route['api/product/(\w{2})/(:num)/get'] = 'Api/Products/one/$1/$2';
$route['api/product/set'] = 'Api/Products/set';
$route['api/product/(\w{2})/delete'] = 'Api/Products/productDel/$1';

// New API Start
$route['api/GetProductDetailByProductId'] = 'Api/Apilist/Productsbyid/';
// New API Start GetMemberFCMToken
$route['api/GetMemberFCMToken'] = 'Api/Apilist/GetMemberFCMToken/';
// New API Start GetLoginData
$route['api/GetLoginData'] = 'Api/Apilist/GetLoginData/';
// New API Start GetLoginData
$route['api/Signup'] = 'Api/Apilist/AddSignup/';
// New API Start SendOtp
$route['api/SendOtp'] = 'Api/Apilist/SendOtp/';
// New API Start OtpVerification
$route['api/OtpVerification'] = 'Api/Apilist/OtpVerification/';
// New API Start AddToCart
$route['api/AddToCart'] = 'Api/Apilist/AddToCart/';
// New API Start GetMyCart
$route['api/GetMyCart'] = 'Api/Apilist/GetMyCart/';
// New API Start UpdateCartItem
$route['api/UpdateCartItem'] = 'Api/Apilist/UpdateCartItem/';
// New API Start RemoveCartItem
$route['api/RemoveCartItem'] = 'Api/Apilist/RemoveCartItem/';
// New API Start GetCartCount
$route['api/GetCartCount'] = 'Api/Apilist/GetCartCount/';
// New API Start CheckOut
$route['api/CheckOut'] = 'Api/Apilist/CheckOut/';
// New API Start UpdateMemberInfo
$route['api/UpdateMemberInfo'] = 'Api/Apilist/UpdateMemberInfo/';
// New API Start UpdateMemberPhoto
$route['api/UpdateMemberPhoto'] = 'Api/Apilist/UpdateMemberPhoto/';
// New API Start AddPhotoOrder
$route['api/AddPhotoOrder'] = 'Api/Apilist/AddPhotoOrder/';
// New API Start MessageList
$route['api/MessageList'] = 'Api/Apilist/MessageList/';
// New API Start SendMessage
$route['api/SendMessage'] = 'Api/Apilist/SendMessage/';
// New API Start GetOrderByType

$route['api/MyOrderList'] = 'Api/Apilist/MyOrderList/';
$route['api/SingleOrderDetails'] = 'Api/Apilist/SingleOrderDetails/';


$route['api/Singalorderdata'] = 'Api/Apilist/Singalorderdata/';

$route['api/GetOrderByType'] = 'Api/Apilist/GetOrderByType/';
// New API Start GetOrderByTypeNew
$route['api/GetOrderByTypeNew'] = 'Api/Apilist/GetOrderByTypeNew/';
// New API Start RecentView
$route['api/RecentView'] = 'Api/Apilist/RecentView/';
// New API Start GetLoginData
$route['api/GetContactUs'] = 'Api/Apilist/GetContact/';
// New API Start GetAboutUs
$route['api/GetAboutUs'] = 'Api/Apilist/GetAboutUs/';
// New API Start GetCancelOrder
$route['api/GetCancelOrder'] = 'Api/Apilist/GetCancelOrder/';
// New API Start PreProductList
$route['api/PreproductList'] = 'Api/Apilist/Preproductslist/';
// New API Start PreProduct Details
$route['api/PreproductDetails'] = 'Api/Apilist/Preproductsbyid/';
// New API Like Product
$route['api/LikeProduct'] = 'Api/Apilist/LikePreProduct/';
// New API Like Product IMG
$route['api/LikeProductImg'] = 'Api/Apilist/LikePreProductImg/';
// New API Like Product IMG
$route['api/UndoProductImgLike'] = 'Api/Apilist/UndoLikeProductImg/';
// New API Like Product IMG
$route['api/LikeProductImgs'] = 'Api/Apilist/LikeProductImgs/';
// New API Like Product IMG
$route['api/UndoPreProductImgLike'] = 'Api/Apilist/UndoLikePreProductImg/';
// New API Start MessageList
$route['api/OrderMessageList'] = 'Api/Apilist/OrderMessageList/';
// New API Start SendMessage
$route['api/OrderSendMessage'] = 'Api/Apilist/OrderSendMessage/';
// New API Start GlobalSearch
$route['api/GlobalSearch'] = 'Api/Apilist/GlobalSearch/';
// New API Start Home Slider
$route['api/HomeSlider'] = 'Api/Apilist/HomeSlider/';
// New API Start Attribut List
$route['api/AttributeList'] = 'Api/Apilist/AttributeList/';
// New API Dashboard Count
$route['api/Dashboardcount'] = 'Api/Apilist/Dashboardcount/';

$route['api/AgentOrderList'] = 'Api/Apilist/AgentOrderList/';
$route['api/AgentDirectOrderList'] = 'Api/Apilist/AgentDirectOrderList/';
// New API Dashboard List
// $route['api/Topcustomerlist'] = 'Api/Apilist/Topcustomer/';
// New API Dashboard List
// $route['api/Bottomcustomerlist'] = 'Api/Apilist/Bottomcustomer/';
// New API Changedevice List
// $route['api/Changedevicelist'] = 'Api/Apilist/Changedevicelist/';
// New API Changedevice List
$route['api/Customerlist'] = 'Api/Apilist/Topcustomer/';
// New API Changedevice List
$route['api/CustomerPendinglist'] = 'Api/Apilist/CustomerPendinglist/';
// New API Changedevice List
$route['api/CustomerPendingApproval'] = 'Api/Apilist/CustomerPendingApproval/';
// New API Changedevice List
$route['api/Notificationlist'] = 'Api/Apilist/NotificationList/';
// Adminlogin
$route['api/Adminlogin'] = 'Api/Apilist/AdminLoginDetails/';
// New API Add Address
$route['api/AddAddress'] = 'Api/Apilist/AddAddress/';
// New API CatList
$route['api/CatList'] = 'Api/Apilist/Catlist/';
// New API UpdateUserAddress
$route['api/UpdateUserAddress'] = 'Api/Apilist/UpdateUserAddress/';
// New API RemoveUserAddress
$route['api/RemoveUserAddress'] = 'Api/Apilist/RemoveUserAddress/';
// New API Start GetUserAddress
$route['api/GetUserAddress'] = 'Api/Apilist/GetUserAddress/';
// All Order List
$route['api/Allorderlist'] = 'Api/Apilist/GetAllOrderByTypeNew/';
// Change Order Status
$route['api/Changeorderstatus'] = 'Api/Apilist/Changeorderstatus/';
// All Status List
$route['api/GetStatuslist'] = 'Api/Apilist/GetStatuslist/';
// All Status List
$route['api/Sendordermessage'] = 'Api/Apilist/Sendordermessage/';
// Order Search
$route['api/orderSearch'] = 'Api/Apilist/GetAllOrderBySearchNew/';
// Order Order By User
$route['api/Allorderbystatus'] = 'Api/Apilist/orderbyuserSearch/';
// New Get User Message
$route['api/Getusermessage'] = 'Api/Apilist/Getuserbymessage/';
// New Send User Message
$route['api/Sendusermessage'] = 'Api/Apilist/Sendusermessage/';
// New Send User Message
$route['api/CheckCoupon'] = 'Api/Apilist/CheckCoupon/';
// New API Singalorderdata
$route['api/Singalorderdata'] = 'Api/Apilist/Singalorderdata/';
// New API Singalorderdata
$route['api/Totalcount'] = 'Api/Apilist/MsgCount/';
// New API Singalorderdata
$route['api/Readmessage'] = 'Api/Apilist/Readcountmsg/';
// New API Admin UnreadMsg
$route['api/Adminunread'] = 'Api/Apilist/Adminunread/';
// New API Pre-launch banner
$route['api/Prelaunch'] = 'Api/Apilist/Prelaunchbanner/';
// New API Pre-launch banner
$route['api/VideoList'] = 'Api/Apilist/getvideolist/';
// New API Unread Customer
$route['api/UnreadCustomer'] = 'Api/Apilist/unreadcustomer/';
// New API Unread Customer
$route['api/ReadCustomer'] = 'Api/Apilist/readcustomer/';
// New API End

$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

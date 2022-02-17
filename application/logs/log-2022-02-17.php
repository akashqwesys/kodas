<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-02-17 09:58:06 --> Severity: Warning --> Undefined array key "ItemId" C:\xampp8\htdocs\kodas\application\controllers\Api\Apilist.php 415
ERROR - 2022-02-17 09:58:06 --> Severity: Warning --> Undefined array key "ItemId" C:\xampp8\htdocs\kodas\application\models\Api_model.php 578
ERROR - 2022-02-17 09:58:06 --> Severity: Warning --> Undefined array key "UserId" C:\xampp8\htdocs\kodas\application\models\Api_model.php 583
ERROR - 2022-02-17 09:58:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'JOIN `products_translations` ON `products_translations`.`for_id` = `products`...' at line 5 - Invalid query: SELECT `user_app`.`pviewcount`, `products`.`id` as `Id`, `products`.`videoid` as `VideoId`, `products_translations`.`title`, `products`.`image` as `product_image`, `products`.`folder` as `imgfolder`, `products`.`product_type` as `Type`, `products`.`product_pcs` as `Pcs`, `products`.`min_qty` as `MinQty`, `products`.`quantity` as `product_quantity_available`, `products_translations`.`description`, `products_translations`.`price`, `products_translations`.`old_price`, `products_translations`.`basic_description`
FROM `products`
LEFT JOIN `vendors` ON `vendors`.`id` = `products`.`vendor_id`
LEFT JOIN `user_app` ON `user_app`.`id` = 
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `products`.`id` IS NULL
 LIMIT 1
ERROR - 2022-02-17 09:58:06 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\xampp8\htdocs\kodas\application\models\Api_model.php 588
ERROR - 2022-02-17 09:58:16 --> Severity: Warning --> Undefined array key "UserId" C:\xampp8\htdocs\kodas\application\models\Api_model.php 583
ERROR - 2022-02-17 09:58:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'JOIN `products_translations` ON `products_translations`.`for_id` = `products`...' at line 5 - Invalid query: SELECT `user_app`.`pviewcount`, `products`.`id` as `Id`, `products`.`videoid` as `VideoId`, `products_translations`.`title`, `products`.`image` as `product_image`, `products`.`folder` as `imgfolder`, `products`.`product_type` as `Type`, `products`.`product_pcs` as `Pcs`, `products`.`min_qty` as `MinQty`, `products`.`quantity` as `product_quantity_available`, `products_translations`.`description`, `products_translations`.`price`, `products_translations`.`old_price`, `products_translations`.`basic_description`
FROM `products`
LEFT JOIN `vendors` ON `vendors`.`id` = `products`.`vendor_id`
LEFT JOIN `user_app` ON `user_app`.`id` = 
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `products`.`id` = '1'
 LIMIT 1
ERROR - 2022-02-17 09:58:16 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\xampp8\htdocs\kodas\application\models\Api_model.php 588
ERROR - 2022-02-17 09:58:25 --> Severity: Warning --> Undefined array key 0 C:\xampp8\htdocs\kodas\application\models\Api_model.php 593
ERROR - 2022-02-17 09:58:25 --> Severity: Warning --> Trying to access array offset on value of type null C:\xampp8\htdocs\kodas\application\models\Api_model.php 593
ERROR - 2022-02-17 09:58:25 --> Severity: Warning --> Undefined array key 0 C:\xampp8\htdocs\kodas\application\models\Api_model.php 612
ERROR - 2022-02-17 09:58:25 --> Severity: Warning --> Trying to access array offset on value of type null C:\xampp8\htdocs\kodas\application\models\Api_model.php 612
ERROR - 2022-02-17 09:58:25 --> Severity: Warning --> Undefined variable $value C:\xampp8\htdocs\kodas\application\models\Api_model.php 631
ERROR - 2022-02-17 09:58:25 --> Severity: Warning --> Undefined variable $value C:\xampp8\htdocs\kodas\application\models\Api_model.php 637
ERROR - 2022-02-17 09:58:25 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp8\htdocs\kodas\system\core\Exceptions.php:271) C:\xampp8\htdocs\kodas\system\core\Common.php 570
ERROR - 2022-02-17 09:58:57 --> Severity: Warning --> Undefined array key 0 C:\xampp8\htdocs\kodas\application\models\Api_model.php 593
ERROR - 2022-02-17 09:58:57 --> Severity: Warning --> Trying to access array offset on value of type null C:\xampp8\htdocs\kodas\application\models\Api_model.php 593
ERROR - 2022-02-17 09:58:57 --> Severity: Warning --> Undefined array key 0 C:\xampp8\htdocs\kodas\application\models\Api_model.php 612
ERROR - 2022-02-17 09:58:57 --> Severity: Warning --> Trying to access array offset on value of type null C:\xampp8\htdocs\kodas\application\models\Api_model.php 612
ERROR - 2022-02-17 09:58:57 --> Severity: Warning --> Undefined variable $value C:\xampp8\htdocs\kodas\application\models\Api_model.php 631
ERROR - 2022-02-17 09:58:57 --> Severity: Warning --> Undefined variable $value C:\xampp8\htdocs\kodas\application\models\Api_model.php 637
ERROR - 2022-02-17 09:58:57 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at C:\xampp8\htdocs\kodas\system\core\Exceptions.php:271) C:\xampp8\htdocs\kodas\system\core\Common.php 570
ERROR - 2022-02-17 09:59:13 --> Severity: Warning --> Undefined variable $value C:\xampp8\htdocs\kodas\application\models\Api_model.php 631
ERROR - 2022-02-17 09:59:13 --> Severity: Warning --> Undefined variable $value C:\xampp8\htdocs\kodas\application\models\Api_model.php 637
ERROR - 2022-02-17 09:59:19 --> Severity: Warning --> Undefined variable $value C:\xampp8\htdocs\kodas\application\models\Api_model.php 631
ERROR - 2022-02-17 09:59:19 --> Severity: Warning --> Undefined variable $value C:\xampp8\htdocs\kodas\application\models\Api_model.php 637
ERROR - 2022-02-17 10:00:51 --> Severity: error --> Exception: Too few arguments to function Apilist::one_get(), 0 passed in C:\xampp8\htdocs\kodas\application\libraries\REST_Controller.php on line 793 and exactly 2 expected C:\xampp8\htdocs\kodas\application\controllers\Api\Apilist.php 1330
ERROR - 2022-02-17 10:05:33 --> Severity: Warning --> Undefined variable $value C:\xampp8\htdocs\kodas\application\models\Api_model.php 631
ERROR - 2022-02-17 10:05:33 --> Severity: Warning --> Undefined variable $value C:\xampp8\htdocs\kodas\application\models\Api_model.php 637
ERROR - 2022-02-17 11:58:38 --> Severity: Warning --> Undefined array key "keyid" C:\xampp8\htdocs\kodas\application\models\Api_model.php 650
ERROR - 2022-02-17 11:58:38 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 1 - Invalid query: SELECT name FROM shop_attribute_translations WHERE id = 
ERROR - 2022-02-17 11:58:38 --> Severity: error --> Exception: Call to a member function row() on bool C:\xampp8\htdocs\kodas\application\models\Api_model.php 704
ERROR - 2022-02-17 11:59:56 --> Image Upload Error: <p>You did not select a file to upload.</p>

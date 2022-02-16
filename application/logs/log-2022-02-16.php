<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-02-16 15:25:26 --> Severity: error --> Exception: Too few arguments to function Api_model::getProductByCategory(), 0 passed in C:\xampp8\htdocs\kodas\application\controllers\Api\Apilist.php on line 454 and exactly 2 expected C:\xampp8\htdocs\kodas\application\models\Api_model.php 3546
ERROR - 2022-02-16 15:26:01 --> Severity: error --> Exception: Too few arguments to function Api_model::getProductByCategory(), 0 passed in C:\xampp8\htdocs\kodas\application\controllers\Api\Apilist.php on line 454 and exactly 2 expected C:\xampp8\htdocs\kodas\application\models\Api_model.php 3546
ERROR - 2022-02-16 15:27:20 --> Severity: Warning --> Undefined array key "catid" C:\xampp8\htdocs\kodas\application\controllers\Api\Apilist.php 453
ERROR - 2022-02-16 15:52:29 --> Query error: Unknown column 'vendors.name' in 'field list' - Invalid query: SELECT `vendors`.`name` as `vendor_name`, `vendors`.`id` as `vendor_id`, `products`.`id` as `product_id`, `products`.`image` as `product_image`, `products`.`time` as `product_time_created`, `products`.`time_update` as `product_time_updated`, `products`.`visibility` as `product_visibility`, `products`.`shop_categorie` as `product_category`, `products`.`quantity` as `product_quantity_available`, `products`.`procurement` as `product_procurement`, `products`.`url` as `product_url`, `products`.`virtual_products`, `products`.`brand_id` as `product_brand_id`, `products`.`position` as `product_position`, `products_translations`.`title`, `products_translations`.`description`, `products_translations`.`price`, `products_translations`.`old_price`, `products_translations`.`basic_description`
FROM `productcat`
LEFT JOIN `products` ON `products`.`id` = `productcat`.`productid`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `products_translations`.`abbr` = 'en'
AND `productcat`.`catid` = '1'
 LIMIT 1
ERROR - 2022-02-16 15:52:29 --> Severity: error --> Exception: Call to a member function row_array() on bool C:\xampp8\htdocs\kodas\application\models\Api_model.php 3555
ERROR - 2022-02-16 16:35:59 --> Severity: Warning --> Undefined array key "refPackagingtype_id" C:\xampp8\htdocs\kodas\application\modules\admin\views\ecommerce\publish.php 236
ERROR - 2022-02-16 17:48:12 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `products`.`id` as `product_id`, `products`.`image` as `product_image`, `products`.`time` as `product_time_created`, `products`.`time_update` as `product_time_updated`, `products`.`visibility` as `product_visibility`, `products`.`shop_categorie` as `product_category`, `products`.`quantity` as `product_quantity_available`, `products`.`procurement` as `product_procurement`, `products`.`url` as `product_url`, `products`.`virtual_products`, `products`.`brand_id` as `product_brand_id`, `products`.`position` as `product_position`, `products_translations`.`title`, `products_translations`.`description`, `products_translations`.`price`, `products_translations`.`old_price`, `products_translations`.`basic_description`
FROM `productcat`
LEFT JOIN `product_attribute1` ON `product_attribute1`.`refProduct_id` = `products`.`id`
LEFT JOIN `products` ON `products`.`id` = `productcat`.`productid`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN(1, 2, 3)
AND `products_translations`.`abbr` = 'en'
AND `productcat`.`catid` = '1'
ORDER BY `products`.`id` ASC
 LIMIT 10
ERROR - 2022-02-16 17:48:12 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\xampp8\htdocs\kodas\application\models\Api_model.php 3578
ERROR - 2022-02-16 17:49:02 --> Query error: Unknown column 'products.id' in 'on clause' - Invalid query: SELECT `products`.`id` as `product_id`, `products`.`image` as `product_image`, `products`.`time` as `product_time_created`, `products`.`time_update` as `product_time_updated`, `products`.`visibility` as `product_visibility`, `products`.`shop_categorie` as `product_category`, `products`.`quantity` as `product_quantity_available`, `products`.`procurement` as `product_procurement`, `products`.`url` as `product_url`, `products`.`virtual_products`, `products`.`brand_id` as `product_brand_id`, `products`.`position` as `product_position`, `products_translations`.`title`, `products_translations`.`description`, `products_translations`.`price`, `products_translations`.`old_price`, `products_translations`.`basic_description`
FROM `productcat`
LEFT JOIN `product_attribute1` ON `product_attribute1`.`refProduct_id` = `products`.`id`
LEFT JOIN `products` ON `products`.`id` = `productcat`.`productid`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `product_attribute1`.`refattributes_id` IN(1, 2, 3)
AND `products_translations`.`abbr` = 'en'
AND `productcat`.`catid` = '1'
ORDER BY `products`.`id` ASC
 LIMIT 10
ERROR - 2022-02-16 17:49:02 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\xampp8\htdocs\kodas\application\models\Api_model.php 3577
ERROR - 2022-02-16 17:50:03 --> Query error: Unknown column 'products.id' in 'on clause' - Invalid query: SELECT `products`.`id` as `product_id`, `products`.`image` as `product_image`, `products`.`time` as `product_time_created`, `products`.`time_update` as `product_time_updated`, `products`.`visibility` as `product_visibility`, `products`.`shop_categorie` as `product_category`, `products`.`quantity` as `product_quantity_available`, `products`.`procurement` as `product_procurement`, `products`.`url` as `product_url`, `products`.`virtual_products`, `products`.`brand_id` as `product_brand_id`, `products`.`position` as `product_position`, `products_translations`.`title`, `products_translations`.`description`, `products_translations`.`price`, `products_translations`.`old_price`, `products_translations`.`basic_description`
FROM `productcat`
LEFT JOIN `product_attribute1` ON `product_attribute1`.`refProduct_id` = `products`.`id`
LEFT JOIN `products` ON `products`.`id` = `productcat`.`productid`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `product_attribute1`.`refattributes_id` IN('20', '15', '22', '46', '86')
AND `products_translations`.`abbr` = 'en'
AND `productcat`.`catid` = '1'
ORDER BY `products`.`id` ASC
 LIMIT 10
ERROR - 2022-02-16 17:50:03 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\xampp8\htdocs\kodas\application\models\Api_model.php 3577
ERROR - 2022-02-16 17:51:28 --> Query error: Unknown column 'products.id' in 'on clause' - Invalid query: SELECT `products`.`id` as `product_id`, `products`.`image` as `product_image`, `products`.`time` as `product_time_created`, `products`.`time_update` as `product_time_updated`, `products`.`visibility` as `product_visibility`, `products`.`shop_categorie` as `product_category`, `products`.`quantity` as `product_quantity_available`, `products`.`procurement` as `product_procurement`, `products`.`url` as `product_url`, `products`.`virtual_products`, `products`.`brand_id` as `product_brand_id`, `products`.`position` as `product_position`, `products_translations`.`title`, `products_translations`.`description`, `products_translations`.`price`, `products_translations`.`old_price`, `products_translations`.`basic_description`
FROM `productcat`
JOIN `product_attribute1` ON `product_attribute1`.`refProduct_id` = `products`.`id`
LEFT JOIN `products` ON `products`.`id` = `productcat`.`productid`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `product_attribute1`.`refattributes_id` IN('20', '15', '22', '46', '86')
AND `products_translations`.`abbr` = 'en'
AND `productcat`.`catid` = '1'
ORDER BY `products`.`id` ASC
 LIMIT 10
ERROR - 2022-02-16 17:51:28 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\xampp8\htdocs\kodas\application\models\Api_model.php 3576
ERROR - 2022-02-16 17:52:09 --> Query error: Unknown column 'products.id' in 'on clause' - Invalid query: SELECT `products`.`id` as `product_id`, `products`.`image` as `product_image`, `products`.`time` as `product_time_created`, `products`.`time_update` as `product_time_updated`, `products`.`visibility` as `product_visibility`, `products`.`shop_categorie` as `product_category`, `products`.`quantity` as `product_quantity_available`, `products`.`procurement` as `product_procurement`, `products`.`url` as `product_url`, `products`.`virtual_products`, `products`.`brand_id` as `product_brand_id`, `products`.`position` as `product_position`, `products_translations`.`title`, `products_translations`.`description`, `products_translations`.`price`, `products_translations`.`old_price`, `products_translations`.`basic_description`
FROM `productcat`
JOIN `product_attribute1` ON `product_attribute1`.`refProduct_id` = `products`.`id`
LEFT JOIN `products` ON `products`.`id` = `productcat`.`productid`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `products_translations`.`abbr` = 'en'
AND `productcat`.`catid` = '1'
AND `product_attribute1`.`refattributes_id` IN('20', '15', '22', '46', '86')
ORDER BY `products`.`id` ASC
 LIMIT 10
ERROR - 2022-02-16 17:52:09 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\xampp8\htdocs\kodas\application\models\Api_model.php 3576
ERROR - 2022-02-16 18:06:27 --> Severity: error --> Exception: array_push(): Argument #1 ($array) must be of type array, null given C:\xampp8\htdocs\kodas\application\controllers\Api\Apilist.php 474

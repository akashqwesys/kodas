<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-02-15 00:23:59 --> 404 Page Not Found: /index
ERROR - 2021-02-15 00:45:22 --> 404 Page Not Found: /index
ERROR - 2021-02-15 05:21:54 --> 404 Page Not Found: /index
ERROR - 2021-02-15 05:56:18 --> 404 Page Not Found: /index
ERROR - 2021-02-15 05:56:42 --> 404 Page Not Found: /index
ERROR - 2021-02-15 05:56:43 --> 404 Page Not Found: /index
ERROR - 2021-02-15 07:27:34 --> 404 Page Not Found: /index
ERROR - 2021-02-15 10:53:20 --> 404 Page Not Found: /index
ERROR - 2021-02-15 10:53:20 --> 404 Page Not Found: /index
ERROR - 2021-02-15 13:10:54 --> 404 Page Not Found: /index
ERROR - 2021-02-15 14:01:25 --> 404 Page Not Found: /index
ERROR - 2021-02-15 14:01:26 --> 404 Page Not Found: /index
ERROR - 2021-02-15 14:27:39 --> 404 Page Not Found: /index
ERROR - 2021-02-15 15:21:57 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `orders`.*, `user_app`.`businessname`, `orders_clients`.`first_name`, `orders_clients`.`last_name`, `orders_clients`.`email`, `orders_clients`.`phone`, `orders_clients`.`address`, `orders_clients`.`city`, `orders_clients`.`post_code`, `orders_clients`.`notes`, `discount_codes`.`type` as `discount_type`, `discount_codes`.`amount` as `discount_amount`
FROM `orders`
INNER JOIN `orders_clients` ON `orders_clients`.`for_id` = `orders`.`id`
LEFT JOIN `discount_codes` ON `discount_codes`.`code` = `orders`.`discount_code`
LEFT JOIN `user_app` ON `user_app`.`id` = `orders`.`user_id`
WHERE `id` = '50'
ORDER BY `id` DESC
 LIMIT 10
ERROR - 2021-02-15 15:22:04 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `orders`.*, `user_app`.`businessname`, `orders_clients`.`first_name`, `orders_clients`.`last_name`, `orders_clients`.`email`, `orders_clients`.`phone`, `orders_clients`.`address`, `orders_clients`.`city`, `orders_clients`.`post_code`, `orders_clients`.`notes`, `discount_codes`.`type` as `discount_type`, `discount_codes`.`amount` as `discount_amount`
FROM `orders`
INNER JOIN `orders_clients` ON `orders_clients`.`for_id` = `orders`.`id`
LEFT JOIN `discount_codes` ON `discount_codes`.`code` = `orders`.`discount_code`
LEFT JOIN `user_app` ON `user_app`.`id` = `orders`.`user_id`
WHERE `id` = '50'
ORDER BY `id` DESC
 LIMIT 10
ERROR - 2021-02-15 15:22:15 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `orders`.*, `user_app`.`businessname`, `orders_clients`.`first_name`, `orders_clients`.`last_name`, `orders_clients`.`email`, `orders_clients`.`phone`, `orders_clients`.`address`, `orders_clients`.`city`, `orders_clients`.`post_code`, `orders_clients`.`notes`, `discount_codes`.`type` as `discount_type`, `discount_codes`.`amount` as `discount_amount`
FROM `orders`
INNER JOIN `orders_clients` ON `orders_clients`.`for_id` = `orders`.`id`
LEFT JOIN `discount_codes` ON `discount_codes`.`code` = `orders`.`discount_code`
LEFT JOIN `user_app` ON `user_app`.`id` = `orders`.`user_id`
WHERE `id` = '41'
ORDER BY `id` DESC
 LIMIT 10
ERROR - 2021-02-15 15:22:24 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `orders`.*, `user_app`.`businessname`, `orders_clients`.`first_name`, `orders_clients`.`last_name`, `orders_clients`.`email`, `orders_clients`.`phone`, `orders_clients`.`address`, `orders_clients`.`city`, `orders_clients`.`post_code`, `orders_clients`.`notes`, `discount_codes`.`type` as `discount_type`, `discount_codes`.`amount` as `discount_amount`
FROM `orders`
INNER JOIN `orders_clients` ON `orders_clients`.`for_id` = `orders`.`id`
LEFT JOIN `discount_codes` ON `discount_codes`.`code` = `orders`.`discount_code`
LEFT JOIN `user_app` ON `user_app`.`id` = `orders`.`user_id`
WHERE `id` = '40'
ORDER BY `id` DESC
 LIMIT 10
ERROR - 2021-02-15 15:23:27 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `orders`.*, `user_app`.`businessname`, `orders_clients`.`first_name`, `orders_clients`.`last_name`, `orders_clients`.`email`, `orders_clients`.`phone`, `orders_clients`.`address`, `orders_clients`.`city`, `orders_clients`.`post_code`, `orders_clients`.`notes`, `discount_codes`.`type` as `discount_type`, `discount_codes`.`amount` as `discount_amount`
FROM `orders`
INNER JOIN `orders_clients` ON `orders_clients`.`for_id` = `orders`.`id`
LEFT JOIN `discount_codes` ON `discount_codes`.`code` = `orders`.`discount_code`
LEFT JOIN `user_app` ON `user_app`.`id` = `orders`.`user_id`
WHERE `date` >= 1606761000
AND `date` <= 1614537000
AND `id` = '50'
ORDER BY `id` DESC
 LIMIT 10
ERROR - 2021-02-15 15:25:19 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/customers/public_html/ramrasiya.com/application/modules/admin/models/Admin_users_model.php:24) /home/customers/public_html/ramrasiya.com/system/helpers/url_helper.php 564
ERROR - 2021-02-15 15:25:29 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/customers/public_html/ramrasiya.com/application/modules/admin/models/Admin_users_model.php:24) /home/customers/public_html/ramrasiya.com/system/helpers/url_helper.php 564
ERROR - 2021-02-15 15:27:13 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/customers/public_html/ramrasiya.com/application/modules/admin/models/Admin_users_model.php:24) /home/customers/public_html/ramrasiya.com/system/helpers/url_helper.php 564
ERROR - 2021-02-15 15:27:48 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/customers/public_html/ramrasiya.com/application/modules/admin/models/Admin_users_model.php:24) /home/customers/public_html/ramrasiya.com/system/helpers/url_helper.php 564
ERROR - 2021-02-15 15:31:56 --> Image Upload Error: <p>You did not select a file to upload.</p>
ERROR - 2021-02-15 15:32:40 --> Image Upload Error: <p>You did not select a file to upload.</p>
ERROR - 2021-02-15 15:35:01 --> Image Upload Error: <p>You did not select a file to upload.</p>
ERROR - 2021-02-15 15:36:57 --> Image Upload Error: <p>You did not select a file to upload.</p>
ERROR - 2021-02-15 15:45:48 --> Image Upload Error: <p>You did not select a file to upload.</p>
ERROR - 2021-02-15 16:34:16 --> 404 Page Not Found: /index
ERROR - 2021-02-15 17:18:12 --> Severity: Notice --> Undefined variable: return /home/customers/public_html/ramrasiya.com/application/models/Api_model.php 2018
ERROR - 2021-02-15 17:18:12 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/customers/public_html/ramrasiya.com/system/core/Exceptions.php:271) /home/customers/public_html/ramrasiya.com/system/core/Common.php 570
ERROR - 2021-02-15 17:22:34 --> 404 Page Not Found: /index
ERROR - 2021-02-15 17:27:22 --> 404 Page Not Found: /index
ERROR - 2021-02-15 17:57:26 --> 404 Page Not Found: /index
ERROR - 2021-02-15 19:51:27 --> 404 Page Not Found: /index
ERROR - 2021-02-15 20:00:26 --> 404 Page Not Found: /index
ERROR - 2021-02-15 21:24:20 --> 404 Page Not Found: /index
ERROR - 2021-02-15 22:05:42 --> 404 Page Not Found: /index

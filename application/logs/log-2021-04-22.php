<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-04-22 00:52:22 --> 404 Page Not Found: /index
ERROR - 2021-04-22 03:02:33 --> 404 Page Not Found: /index
ERROR - 2021-04-22 05:16:46 --> 404 Page Not Found: /index
ERROR - 2021-04-22 06:46:56 --> 404 Page Not Found: /index
ERROR - 2021-04-22 07:30:36 --> 404 Page Not Found: /index
ERROR - 2021-04-22 07:51:44 --> 404 Page Not Found: /index
ERROR - 2021-04-22 08:10:23 --> Severity: Notice --> Trying to get property 'image' of non-object /data/customers/public_html/ramrasiya.com/application/controllers/Home.php 219
ERROR - 2021-04-22 08:10:23 --> Severity: Notice --> Trying to get property 'imgfolder' of non-object /data/customers/public_html/ramrasiya.com/application/controllers/Home.php 228
ERROR - 2021-04-22 08:10:23 --> Severity: Notice --> Trying to get property 'title' of non-object /data/customers/public_html/ramrasiya.com/application/views/web/catalogdetail.php 17
ERROR - 2021-04-22 08:10:23 --> Severity: Notice --> Trying to get property 'description' of non-object /data/customers/public_html/ramrasiya.com/application/views/web/catalogdetail.php 60
ERROR - 2021-04-22 08:46:50 --> 404 Page Not Found: /index
ERROR - 2021-04-22 08:56:06 --> 404 Page Not Found: /index
ERROR - 2021-04-22 08:56:06 --> 404 Page Not Found: /index
ERROR - 2021-04-22 08:57:39 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /data/customers/public_html/ramrasiya.com/application/models/Api_model.php:266) /data/customers/public_html/ramrasiya.com/system/core/Common.php 570
ERROR - 2021-04-22 09:30:33 --> Query error: Unknown column 'products_translations.price3' in 'order clause' - Invalid query: SELECT `products`.`id` as `Id`, `products`.`image` as `product_image`, `products`.`folder` as `imgfolder`, `products`.`videoid`, `products`.`product_pcs` as `Pcs`, `products_translations`.`title`, `products_translations`.`price`, `products_translations`.`old_price`
FROM `productcat`
LEFT JOIN `products` ON `products`.`id` = `productcat`.`productid`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `products`.`productviewtype` LIKE '%registorcustomer%' ESCAPE '!'
AND `productcat`.`catid` = '1'
AND `products`.`visibility` = 1
ORDER BY `products_translations`.`price3` DESC
 LIMIT 10
ERROR - 2021-04-22 09:32:30 --> 404 Page Not Found: /index
ERROR - 2021-04-22 09:38:13 --> Query error: Unknown column 'products.price3' in 'order clause' - Invalid query: SELECT *
FROM `user_app`
WHERE `id` = '36'
ORDER BY `products`.`price3` DESC
ERROR - 2021-04-22 09:39:08 --> Query error: Unknown column 'products.price3' in 'order clause' - Invalid query: SELECT *
FROM `user_app`
WHERE `id` = '36'
ORDER BY `products`.`price3` DESC
ERROR - 2021-04-22 09:41:10 --> Query error: Unknown column 'products_translations.old_price products.price3' in 'field list' - Invalid query: SELECT `products`.`id` as `Id`, `products`.`image` as `product_image`, `products`.`folder` as `imgfolder`, `products`.`videoid`, `products`.`product_pcs` as `Pcs`, `products_translations`.`title`, `products_translations`.`price`, `products_translations`.`old_price products`.`price3` as `ShortPrice`
FROM `productcat`
LEFT JOIN `products` ON `products`.`id` = `productcat`.`productid`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `products`.`productviewtype` LIKE '%registorcustomer%' ESCAPE '!'
AND `productcat`.`catid` = '1'
AND `products`.`visibility` = 1
ORDER BY `products`.`price3` DESC
 LIMIT 10
ERROR - 2021-04-22 09:41:27 --> Query error: Unknown column 'products_translations.old_price products.price3' in 'field list' - Invalid query: SELECT `products`.`id` as `Id`, `products`.`image` as `product_image`, `products`.`folder` as `imgfolder`, `products`.`videoid`, `products`.`product_pcs` as `Pcs`, `products_translations`.`title`, `products_translations`.`price`, `products_translations`.`old_price products`.`price3` as `ShortPrice`
FROM `productcat`
LEFT JOIN `products` ON `products`.`id` = `productcat`.`productid`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `,products`.`productviewtype` LIKE '%registorcustomer%' ESCAPE '!'
AND `productcat`.`catid` = '1'
AND `products`.`visibility` = 1
ORDER BY `products`.`price3` DESC
 LIMIT 10
ERROR - 2021-04-22 09:41:47 --> Query error: Unknown column 'products_translations.old_price products.price3' in 'field list' - Invalid query: SELECT `products`.`id` as `Id`, `products`.`image` as `product_image`, `products`.`folder` as `imgfolder`, `products`.`videoid`, `products`.`product_pcs` as `Pcs`, `products_translations`.`title`, `products_translations`.`price`, `products_translations`.`old_price products`.`price3` as `ShortPrice`
FROM `productcat`
LEFT JOIN `products` ON `products`.`id` = `productcat`.`productid`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `,products`.`productviewtype` LIKE '%registorcustomer%' ESCAPE '!'
AND `productcat`.`catid` = '1'
AND `products`.`visibility` = 1
ORDER BY `products`.`price3` DESC
 LIMIT 10
ERROR - 2021-04-22 10:02:19 --> 404 Page Not Found: /index
ERROR - 2021-04-22 10:23:39 --> 404 Page Not Found: /index
ERROR - 2021-04-22 10:23:40 --> 404 Page Not Found: /index
ERROR - 2021-04-22 11:34:36 --> 404 Page Not Found: /index
ERROR - 2021-04-22 11:56:18 --> 404 Page Not Found: /index
ERROR - 2021-04-22 11:56:31 --> Image Upload Error: <p>You did not select a file to upload.</p>
ERROR - 2021-04-22 11:57:08 --> Image Upload Error: <p>You did not select a file to upload.</p>
ERROR - 2021-04-22 11:57:21 --> Image Upload Error: <p>You did not select a file to upload.</p>
ERROR - 2021-04-22 11:57:39 --> 404 Page Not Found: /index
ERROR - 2021-04-22 12:08:55 --> 404 Page Not Found: /index
ERROR - 2021-04-22 12:23:22 --> Image Upload Error: <p>You did not select a file to upload.</p>
ERROR - 2021-04-22 14:18:34 --> 404 Page Not Found: /index
ERROR - 2021-04-22 14:30:54 --> 404 Page Not Found: /index
ERROR - 2021-04-22 14:30:54 --> 404 Page Not Found: /index
ERROR - 2021-04-22 14:49:17 --> 404 Page Not Found: /index
ERROR - 2021-04-22 15:25:18 --> 404 Page Not Found: /index
ERROR - 2021-04-22 15:25:18 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:01:16 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:01:17 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:01:20 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:01:44 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:01:45 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:01:47 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:01:49 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:01:50 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:01:51 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:02:41 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:02:42 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:02:46 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:03:09 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:03:13 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:03:15 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:03:17 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:03:19 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:03:23 --> 404 Page Not Found: /index
ERROR - 2021-04-22 17:39:37 --> Severity: Notice --> Undefined offset: 0 /data/customers/public_html/ramrasiya.com/application/models/Api_model.php 2392
ERROR - 2021-04-22 17:39:37 --> Severity: Notice --> Trying to access array offset on value of type null /data/customers/public_html/ramrasiya.com/application/models/Api_model.php 2392
ERROR - 2021-04-22 17:39:37 --> Severity: Notice --> Undefined offset: 0 /data/customers/public_html/ramrasiya.com/application/models/Api_model.php 2400
ERROR - 2021-04-22 17:39:37 --> Severity: Notice --> Trying to access array offset on value of type null /data/customers/public_html/ramrasiya.com/application/models/Api_model.php 2400
ERROR - 2021-04-22 17:39:37 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /data/customers/public_html/ramrasiya.com/system/core/Exceptions.php:271) /data/customers/public_html/ramrasiya.com/system/core/Common.php 570
ERROR - 2021-04-22 17:53:35 --> Query error: Unknown column 'likepreproductimg.userid' in 'where clause' - Invalid query: SELECT `likestatus`
FROM `likeproductimg`
WHERE `likepreproductimg`.`userid` = '36'
AND `likepreproductimg`.`imgname` = '1619004207-1'
ERROR - 2021-04-22 18:03:26 --> 404 Page Not Found: /index
ERROR - 2021-04-22 18:03:26 --> 404 Page Not Found: /index
ERROR - 2021-04-22 20:22:07 --> 404 Page Not Found: /index
ERROR - 2021-04-22 22:02:25 --> 404 Page Not Found: /index
ERROR - 2021-04-22 22:36:53 --> 404 Page Not Found: /index
ERROR - 2021-04-22 22:36:54 --> 404 Page Not Found: /index
ERROR - 2021-04-22 22:50:50 --> 404 Page Not Found: /index
ERROR - 2021-04-22 22:50:53 --> 404 Page Not Found: /index

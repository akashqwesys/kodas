<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2022-02-04 08:38:28 --> Severity: error --> Exception: Call to undefined method CI_DB_mysqli_driver::where_id() C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 77
ERROR - 2022-02-04 08:41:39 --> Severity: error --> Exception: syntax error, unexpected variable "$query" C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 79
ERROR - 2022-02-04 08:45:09 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM `products`
INNER JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105', '116')
ERROR - 2022-02-04 08:45:09 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 80
ERROR - 2022-02-04 08:46:11 --> Query error: Not unique table/alias: 'products' - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM (`products`, `products`)
INNER JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105', '116')
ERROR - 2022-02-04 08:46:11 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:46:14 --> Query error: Not unique table/alias: 'products' - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM (`products`, `products`)
INNER JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105', '116')
ERROR - 2022-02-04 08:46:14 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:46:23 --> Query error: Not unique table/alias: 'products' - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM `products`, `products`
WHERE `id` IN('108', '105', '116')
ERROR - 2022-02-04 08:46:23 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:46:31 --> Query error: Unknown column 'products_translations.title' in 'field list' - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM `products`
WHERE `id` IN('108', '105', '116')
ERROR - 2022-02-04 08:46:31 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:47:22 --> Query error: Not unique table/alias: 'products' - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM (`products`, `products`)
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105', '116')
ERROR - 2022-02-04 08:47:22 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:48:01 --> Query error: Not unique table/alias: 'products' - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM (`products`, `products`)
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105', '116')
ERROR - 2022-02-04 08:48:01 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:48:05 --> Query error: Not unique table/alias: 'products' - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM (`products`, `products`)
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105')
ERROR - 2022-02-04 08:48:05 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:48:31 --> Query error: Not unique table/alias: 'products' - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM (`products`, `products`)
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105')
ERROR - 2022-02-04 08:48:31 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:50:02 --> Query error: Not unique table/alias: 'products' - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM (`products`, `products`)
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105')
ERROR - 2022-02-04 08:50:02 --> Severity: error --> Exception: Call to a member function result() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:51:05 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `products`.`image`, `products`.`id`
FROM `products`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105')
ERROR - 2022-02-04 08:51:05 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:52:31 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `products`.`image`, `products`.`id`
FROM `products`
INNER JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105')
ERROR - 2022-02-04 08:52:31 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:53:18 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM `products`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105')
ERROR - 2022-02-04 08:53:18 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:53:33 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM `products`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105')
ERROR - 2022-02-04 08:53:33 --> Severity: error --> Exception: Call to a member function result_array() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:53:56 --> Query error: Column 'id' in where clause is ambiguous - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM `products`
LEFT JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105')
ERROR - 2022-02-04 08:54:50 --> Query error: Not unique table/alias: 'products' - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM (`products`, `products`)
INNER JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `id` IN('108', '105')
ERROR - 2022-02-04 08:54:50 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 08:58:09 --> Query error: Not unique table/alias: 'products' - Invalid query: SELECT `products`.`image`, `products`.`id`, `products_translations`.`title`
FROM (`products`, `products`)
INNER JOIN `products_translations` ON `products_translations`.`for_id` = `products`.`id`
WHERE `products`.`id` IN('108', '105')
ERROR - 2022-02-04 08:58:09 --> Severity: error --> Exception: Call to a member function num_rows() on bool C:\xampp8\htdocs\kodas\application\modules\admin\models\Shareproduct_model.php 81
ERROR - 2022-02-04 09:13:19 --> Severity: Warning --> mkdir(): No such file or directory C:\xampp8\htdocs\kodas\application\modules\admin\controllers\shareproduct\Shareproduct.php 86
ERROR - 2022-02-04 09:13:19 --> Severity: Warning --> imagepng(attachments/shareproduct/60/Sample_Output.png): Failed to open stream: No such file or directory C:\xampp8\htdocs\kodas\application\modules\admin\controllers\shareproduct\Shareproduct.php 100
ERROR - 2022-02-04 09:13:19 --> 404 Page Not Found: /index
ERROR - 2022-02-04 09:13:19 --> Severity: Warning --> getimagesize(http://localhost/kodas/attachments/shop_images/1604064744-0.jpg): Failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
 C:\xampp8\htdocs\kodas\application\modules\admin\controllers\shareproduct\Shareproduct.php 105
ERROR - 2022-02-04 09:13:19 --> Severity: Warning --> getimagesize(attachments/shareproduct/60/Sample_Output.png): Failed to open stream: No such file or directory C:\xampp8\htdocs\kodas\application\modules\admin\controllers\shareproduct\Shareproduct.php 106
ERROR - 2022-02-04 09:13:19 --> Severity: error --> Exception: imagecreatetruecolor(): Argument #1 ($width) must be greater than 0 C:\xampp8\htdocs\kodas\application\modules\admin\controllers\shareproduct\Shareproduct.php 111
ERROR - 2022-02-04 09:13:57 --> 404 Page Not Found: /index
ERROR - 2022-02-04 09:13:57 --> Severity: Warning --> getimagesize(http://localhost/kodas/attachments/shop_images/1604064744-0.jpg): Failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
 C:\xampp8\htdocs\kodas\application\modules\admin\controllers\shareproduct\Shareproduct.php 105
ERROR - 2022-02-04 09:13:57 --> 404 Page Not Found: /index
ERROR - 2022-02-04 09:13:57 --> Severity: Warning --> imagecreatefrompng(http://localhost/kodas/attachments/shop_images/1604064744-0.jpg): Failed to open stream: HTTP request failed! HTTP/1.1 404 Not Found
 C:\xampp8\htdocs\kodas\application\modules\admin\controllers\shareproduct\Shareproduct.php 116
ERROR - 2022-02-04 09:13:57 --> Severity: error --> Exception: imagecopy(): Argument #2 ($src_image) must be of type GdImage, bool given C:\xampp8\htdocs\kodas\application\modules\admin\controllers\shareproduct\Shareproduct.php 119

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?= !empty($page_name)
            ? 'Kodas - ' . ucwords($page_name)
            : Kodas ?></title>
        <meta name="author" content="premware service india LLP" />
        <meta name="description" content="">
        <meta name="Keywords" content="">
        <link rel="shortcut icon" href="" type="image/x-icon" />
        <!-- CSS -->
    </head>
    <body>
<?php  ?>
		<?php if (!empty($webview) != true) { ?>
        <?php include 'layout/header.php'; ?>
        <?php include 'layout/menu.php'; ?>
		<?php } ?>
        <?php include 'web/' . $page_name . '.php'; ?>
		<?php if (!empty($webview) != true) { ?>
        <?php include 'layout/footer.php'; ?>
		<?php } ?>
    </body>
</html>

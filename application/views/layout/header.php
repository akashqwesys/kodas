<!DOCTYPE html>
<?php
$query = $this->db->get('value_store');
$result = $query->result_array();
$data = array();
foreach ($result as $key => $value) {
	$key = $value['thekey'];
	$data[$key] = ($value['value'] != '') ? $value['value'] : '';
}

$sitelogo = $data['footercopyright'];

?>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ramrasiya</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicons -->
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="apple-touch-icon" href="">

    <!-- ************************* CSS Files ************************* -->

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>webassets/css/vendor.css">

    <!-- style css <-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>webassets/css/main.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>webassets/css/popup.css">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>webassets/css/styleslider.css">
<script>
    $(document).ready(function(){
        $("#myModal").modal('show');
    });
</script>
</head>

<body>
<?php include 'popup.php';?>
    <!-- Preloader Start -->
    <div class="zakas-preloader active">
        <div class="zakas-preloader-inner h-100 d-flex align-items-center justify-content-center">
            <div class="zakas-child zakas-bounce1"></div>
            <div class="zakas-child zakas-bounce2"></div>
            <div class="zakas-child zuka-bounce3"></div>
        </div>
    </div>

    <!-- Preloader End -->

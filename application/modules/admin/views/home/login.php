<?php $sitelogo = '';
$query = $this->db->get('value_store');
$result = $query->result_array();
$data1 = [];
foreach ($result as $key => $value) {
    $key = $value['thekey'];
    $data1[$key] = $value['value'] != '' ? $value['value'] : '';
}
$sitelogo = $data1['sitelogo'];
?>
<style>
    body {
        background-image:url('/assets/imgs/surtikaapad_banner.jpg');
        background-position: bottom  right;
        background-repeat: no-repeat;
        background-color:#548fd0;
		background-size:100% 100%;
    }
    .avatar {background-image:url('/assets/imgs/login-cover.png')}
    .avatarnew img{width:100%;}
    .avatarnew img {width: 75%; padding: 10px;}
</style>
<div class="container">
    <div class="login-container">
        <div id="output">
            <?php if ($this->session->flashdata('err_login')) { ?>
                <div class="alert alert-danger"><?= $this->session->flashdata(
                    'err_login'
                ) ?></div>
                <?php } ?></div>
        <!-- <div class="avatarnew"><img src="<?= base_url() ?>assets/imgs/rangrasiyalogo.png" alt=""></div> -->
        <div class="avatarnew"><img src="<?= base_url(
            'attachments/site_logo/' . $sitelogo
        ) ?>" alt=""></div>
        <div class="form-box">
            <form action="" method="POST">
                <input type="text" name="username" placeholder="username">
                <input type="password" name="password" placeholder="password">
                <button class="btn btn-info btn-block login" type="submit">Login</button>
            </form>
        </div>
    </div>
</div>

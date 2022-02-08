<!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Domine:400,700" rel="stylesheet"> -->

<!-- Required Css -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" />
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Domine:400,700" />
<div class="fancybox-container fancybox-is-open fancybox-can-drag" role="dialog" tabindex="-1" id="fancybox-container-1" style="transition-duration: 366ms;"><div class="fancybox-bg"></div><div class="fancybox-inner"><div class="fancybox-stage"><div class="fancybox-slide fancybox-slide--inline fancybox-slide--current fancybox-slide--complete"><div style="display: inline-block;" id="newsletter-popup" class="newsletter-popup">
<?php
$sitelogo = "";
$query = $this->db->get('value_store');
$result = $query->result_array();
$data = array();
foreach ($result as $key => $value) {
	$key = $value['thekey'];
	$data[$key] = ($value['value'] != '') ? $value['value'] : '';
}
$sitelogo = $data['sitelogo'];

?>
<div class="box">
    <div class="logo"><img src="<?=base_url('attachments/site_logo/' . $sitelogo)?>" alt="Ramrasiya" ></div>
    <h4>Subscribe to our Newsletter</h4>
    <form id="WelcomePopupForm" method="post">
        <div class="form row">
            <div class="col-md-9">
                <input class="form__input form__input--2" id="email" name="email" placeholder=" Email ID *" type="text" value="" style="border-color:crimson">
            </div>
             <div class="col-md-3">
                <input type="button" id="save" class="btn-submit" value="JOIN" style="padding: 13px 30px;" onclick="savemail()">
            </div>
    </div>
</form>
<!-- <div class="social">
<span>FOLLOW US</span>
<a href="https://twitter.com/LAXMIPATISAREE1" title="Twitter" target="_blank"></a>
<a href="http://www.pinterest.com/laxmipati/" title="pinterest" target="_blank"></a>
<a href="https://www.instagram.com/houseoflaxmipati/" title="instagram" target="_blank"></a>
<a href="https://www.facebook.com/HouseofLaxmipati" title="facebook" target="_blank"></a>
</div> -->
</div>
<button data-fancybox-close="" class="fancybox-close-small" id="close" title="Close"></button></div></div></div><div class="fancybox-caption-wrap"><div class="fancybox-caption"></div></div></div></div>
<script>
    // $(document).ready(function(){
        function savemail(){
        console.log("save clicked");
         if($('#email').val() != "" && $('#email').val() != undefined){
            if (/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test($('#email').val())){
                $.ajax({
                    type:'POST',
                    url:'<?=base_url() . '/savemail';?>',
                    data:$('#WelcomePopupForm').serialize(),
                    success:function(success){
                         if(success){
                            alert(success);
                            $('#fancybox-container-1').hide();
                        }else{
                            alert("Something Went Wrong.....");
                        }
                    }
                });
            }else{
                alert("Invalid email please try again with valid email.");
                $('#email').focus();
            }
        }else{
            alert("Enter email and try again.");
            $('#email').focus();
        }
    }

      // $("#save").click(function(){

    //   });
    // });
</script>
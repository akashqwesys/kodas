</div>
</div>
</div>
</div>
<?php if ($this->session->userdata('logged_in')) {?>

<?php }?>
</div>
<!-- Modal Calculator -->
<div class="modal fade" id="modalCalculator" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Calculator</h4>
            </div>
            <div class="modal-body" id="calculator">
                <div class="hero-unit" id="calculator-wrapper">
                    <div class="row">
                        <div class="col-sm-8">
                            <div id="calculator-screen" class="form-control"></div>
                        </div>
                        <div class="col-sm-1">
                            <div class="visible-xs">
                                =
                            </div>
                            <div class="hidden-xs">
                                =
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div id="calculator-result"  class="form-control">0</div>
                        </div>
                    </div>
                </div>
                <div class="well">
                    <div id="calc-board">
                        <div class="row">
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="SIN" data-key="115">sin</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="COS" data-key="99">cos</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="MOD" data-key="109">md</a>
                            <a href="javascript:void(0);" class="btn btn-danger" data-method="reset" data-key="8">C</a>
                        </div>
                        <div class="row">
                            <a href="javascript:void(0);" class="btn btn-default" data-key="55">7</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="56">8</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="57">9</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="BRO" data-key="40">(</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="BRC" data-key="41">)</a>
                        </div>
                        <div class="row">
                            <a href="javascript:void(0);" class="btn btn-default" data-key="52">4</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="53">5</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="54">6</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="MIN" data-key="45">-</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="SUM" data-key="43">+</a>
                        </div>
                        <div class="row">
                            <a href="javascript:void(0);" class="btn btn-default" data-key="49">1</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="50">2</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="51">3</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="DIV" data-key="47">/</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="MULT" data-key="42">*</a>
                        </div>
                        <div class="row">
                            <a href="javascript:void(0);" class="btn btn-default" data-key="46">.</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-key="48">0</a>
                            <a href="javascript:void(0);" class="btn btn-default" data-constant="PROC" data-key="37">%</a>
                            <a href="javascript:void(0);" class="btn btn-primary" data-method="calculate" data-key="61">=</a>
                        </div>
                    </div>
                </div>
                <div class="well">
                    <legend>History</legend>
                    <div id="calc-panel">
                        <div id="calc-history">
                            <ol id="calc-history-list"></ol>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?=base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js')?>"></script>

<script  src="<?= base_url('assets/central') ?>/datatable/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?= base_url('assets/central') ?>/datatable/dataTables.responsive.min.js" type="text/javascript" ></script>
<script  src="<?= base_url('assets/central') ?>/bootstrap/bootstrapValidator.min.js" type="text/javascript"></script>
<script  src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js" type="text/javascript"></script>
<!-- <script  src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js" type="text/javascript"></script> -->


<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?=base_url('assets/js/bootbox.min.js')?>"></script>
<script src="<?=base_url('assets/js/zxcvbn.js')?>"></script>
<script src="<?=base_url('assets/js/zxcvbn_bootstrap3.js')?>"></script>
<script src="<?=base_url('assets/js/pGenerator.jquery.js')?>"></script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<script>
    var urls = {
        changePass: '<?=base_url('admin/changePass')?>',
        editShopCategorie: '<?=base_url('admin/editshopcategorie')?>',
		editShopAttribute: '<?=base_url('admin/editshopattribute')?>',
        changeTextualPageStatus: '<?=base_url('admin/changePageStatus')?>',
        removeSecondaryImage: '<?=base_url('admin/removeSecondaryImage')?>',
		preremoveSecondaryImage: '<?=base_url('admin/preremoveSecondaryImage')?>',
        productstatusChange: '<?=base_url('admin/productstatusChange')?>',
        productsOrderBy: '<?=base_url('admin/products?orderby=')?>',
        productStatusChange: '<?=base_url('admin/productStatusChange')?>',
        changeOrdersOrderStatus: '<?=base_url('admin/changeOrdersOrderStatus')?>',
		changedirectOrderStatus: '<?=base_url('admin/changedirectOrderStatus')?>',
        ordersOrderBy: '<?=base_url('admin/orders?order_by=')?>',
        uploadOthersImages: '<?=base_url('admin/uploadOthersImages')?>',
        loadOthersImages: '<?=base_url('admin/loadOthersImages')?>',
		uploadOthersPdf: '<?=base_url('admin/uploadOthersPdf')?>',
        loadOthersPdf: '<?=base_url('admin/loadOthersPdf')?>',
        editPositionCategorie: '<?=base_url('admin/changePosition')?>',
		editPositionAttribute: '<?=base_url('admin/changePositionAttr')?>',
        chatfunction: '<?=base_url('admin/chatfunction')?>',
        chatsendfunction: '<?=base_url('admin/chatsendfunction')?>',
        chatfunctionagent: '<?=base_url('admin/chatfunctionagent')?>',
        chatsendfunctionagent: '<?=base_url('admin/chatsendfunctionagent')?>'
    };
</script>
<script src="<?=base_url('assets/js/mine_admin.js')?>"></script>

<?php $this->load->view('agent/agent_js'); ?>
<?php $this->load->view('user/user_js'); ?>
<?php $this->load->view('user/userlist_js'); ?>
<?php $this->load->view('attributes/attributes_js'); ?>
<?php $this->load->view('categories/categories_js'); ?>
<?php $this->load->view('ecommerce/productss_js'); ?>
<?php $this->load->view('attributesgroup/attributesgroup_js'); ?>
<?php $this->load->view('packagingtype/packagingtype_js'); ?>
<?php $this->load->view('shareproduct/shareproduct_js'); ?>
<?php $this->load->view('newsletter/subscriber_js'); ?>
<?php $this->load->view('coupan/coupan_js'); ?>
<?php $this->load->view('ecommerce/orderlist_js'); ?>
<?php $this->load->view('ecommerce/stock_js'); ?>
<?php $this->load->view('home/dashboard'); ?>
<?php if($title=='Add-Order'){ ?>
<script>
 $(document).ready(function () {

    $('#addBlock').on('click', function () {                   
        var cloneData=$(".block1" ).clone();
        cloneData.find('.col-md-4').remove();
        $(".current_1").removeClass('current');
        cloneData.find('.lbl_append').after('<div class="col-sm-10 col-md-4 current current_1"></div>');                               
        $( ".block" ).last().after(cloneData);        
        // $('.current').appendTo(productSelect);   
        // $('.current').find('.product_select').selectpicker('refresh');  
        // cloneData.appendTo('#product_field');
        // $('.product_select').selectpicker('refresh');  
        
        
        $( ".block" ).removeClass("block1");
        $( ".block" ).first().addClass('block1');
        $( ".block_img_div" ).css("display","block"); 
        $( ".block1 .block_img_div" ).css("display","none");
        
        $('.current').append($(".mainpicker" ).clone().css("display","block"));
        // $('.current').append('<select class="product_select form-control show-tick show-menu-arrow" data-live-search="true" name="ItemId[]" required><?php foreach ($conn_products as $conn_product) { ?><option value="<?=$conn_product['p_id']?>"><?php echo $conn_product['title']; ?></option><?php } ?></select>');   
        $('.current').find('.mainpicker').selectpicker();
        $( ".current_1 .mainpicker" ).removeClass("mainpicker");
    });
    
    $(document).on('click', ".block_img", function () {           
        $(this).closest('.block').remove();
    });

    $('#UserId').on('change', function () {
        var userid = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/load-address') ?>",
            data: {'userid': userid},
            success: function (res) {
                var data = jQuery.parseJSON(res);                
                $("#ShipId").empty();
                $("#BillId").empty();                         
                $.each(data.shipping, function (index, value) {                            
                    $("#ShipId").append(new Option(value.companyname+'-'+value.address, value.id));
                });
                $.each(data.billing, function (index, value) {
                    $("#BillId").append(new Option(value.companyname+'-'+value.address, value.id));
                });
            }
        });
        });
    });
</script>
<?php } ?>
<!-- 
<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyDnzyFGwNS2YlbeD0wdFCL1OVycC5zd51I",
    authDomain: "kodaslive-9beb6.firebaseapp.com",
    projectId: "kodaslive-9beb6",
    storageBucket: "kodaslive-9beb6.appspot.com",
    messagingSenderId: "600945585323",
    appId: "1:600945585323:web:c71d104222c0b98f7adbee",
    measurementId: "G-19H096V4JT"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script> -->

<input type="hidden" id="token" name="token">
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
<script>
    var firebaseConfig = {
        apiKey: "AIzaSyDnzyFGwNS2YlbeD0wdFCL1OVycC5zd51I",
        authDomain: "kodaslive-9beb6.firebaseapp.com",
        projectId: "kodaslive-9beb6",
        storageBucket: "kodaslive-9beb6.appspot.com",
        messagingSenderId: "600945585323",
        appId: "1:600945585323:web:c71d104222c0b98f7adbee",
        measurementId: "G-19H096V4JT"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging=firebase.messaging();

    function IntitalizeFireBaseMessaging() {
        messaging
            .requestPermission()
            .then(function () {
                console.log("Notification Permission");
                return messaging.getToken();
            })
            .then(function (token) {
                console.log("Token : "+token);
                document.getElementById("token").innerHTML=token;
            })
            .catch(function (reason) {
                console.log(reason);
            });
    }

    messaging.onMessage(function (payload) {
        console.log(payload);
        const notificationOption={
            body:payload.notification.body,
            icon:payload.notification.icon
        };

        if(Notification.permission==="granted"){
            var notification=new Notification(payload.notification.title,notificationOption);

            notification.onclick=function (ev) {
                ev.preventDefault();
                window.open(payload.notification.click_action,'_blank');
                notification.close();
            }
        }

    });
    messaging.onTokenRefresh(function () {
        messaging.getToken()
            .then(function (newtoken) {
                console.log("New Token : "+ newtoken);
            })
            .catch(function (reason) {
                console.log(reason);
				//alert(reason);
            })
    })
    IntitalizeFireBaseMessaging();
</script>
</body>
</html>
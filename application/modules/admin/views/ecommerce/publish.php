<style>

.close-icon {
  position: absolute;
  right: -8rem;
  margin-top: -10rem;
  color: red;
  font-size: 18px;
 }

.inner {
  position: relative;
  /* background: #ccc; */
  height: 40px;
  width: 100%;
  margin: 5px;
}
.close-icon:hover{
  cursor: pointer;
}
.outer {
  height: 90px;
  width: 100px;
}
</style>
<script src="<?=base_url('assets/ckeditor/ckeditor.js')?>"></script>

<h1><img src="<?=base_url('assets/imgs/shop-cart-add-icon.png')?>" class="header-img" style="margin-top:-3px;"> Add product</h1>
<hr>
<?php
$timeNow = time();
if (validation_errors()) {
	?>
<hr>
<div class="alert alert-danger">
  <?=validation_errors()?>
</div>
<hr>
<?php
}
if ($this->session->flashdata('result_publish')) {
	?>
<hr>
<div class="alert alert-success">
  <?=$this->session->flashdata('result_publish')?>
</div>
<hr>
<?php
}
?>
<form method="POST" action="" enctype="multipart/form-data">
  <input type="hidden" value="<?=isset($_POST['folder']) ? $_POST['folder'] : $timeNow?>" name="folder">
  <?php /*?><div class="form-group available-translations">
<b>Languages</b>
<?php foreach ($languages as $language) { ?>
<button type="button" data-locale-change="<?= $language->abbr ?>" class="btn btn-default locale-change text-uppercase <?= $language->abbr == MY_DEFAULT_LANGUAGE_ABBR ? 'active' : '' ?>">
<img src="<?= base_url('attachments/lang_flags/' . $language->flag) ?>" alt="">
<?= $language->abbr ?>
</button>
<?php } ?>
</div><?php */?>
  <?php
$i = 0;
foreach ($languages as $language) {
	?>
  <div class="locale-container locale-container-<?=$language->abbr?>" <?=$language->abbr == MY_DEFAULT_LANGUAGE_ABBR ? 'style="display:block;"' : ''?>>
    <input type="hidden" name="translations[]" value="<?=$language->abbr?>">
    <div class="form-group">
      <label>Design No </label>
      <input type="text" name="designNo" value="<?=@$_POST['designNo']?>" class="form-control" required>
    </div>
    <div class="row">
      <div class="col-md-6">
        <h3>Box</h3>
        <div class="form-group">
          <label>Title </label>
          <input type="text" name="title[]" value="<?=$trans_load != null && isset($trans_load[$language->abbr]['title']) ? $trans_load[$language->abbr]['title'] : ''?>" class="form-control">
        </div> 
        <?php /*?><div class="form-group"> <a href="javascript:void(0);" class="btn btn-default showSliderDescrption" data-descr="<?= $i ?>">Show Slider Description <span class="glyphicon glyphicon-circle-arrow-down"></span></a> </div><?php */?>
    <div class="theSliderDescrption" id="theSliderDescrption-<?=$i?>" <?=isset($_POST['in_slider']) && $_POST['in_slider'] == 1 ? 'style="display:block;"' : ''?>>
      <div class="form-group">
        <label for="basic_description<?=$i?>">Slider Description </label>
        <textarea name="basic_description[]" id="basic_description<?=$i?>" rows="50" class="form-control"><?=$trans_load != null && isset($trans_load[$language->abbr]['basic_description']) ? $trans_load[$language->abbr]['basic_description'] : ''?>
</textarea>
        <script>
                        CKEDITOR.replace('basic_description<?=$i?>');
                        CKEDITOR.config.entities = false;
                    </script>
      </div>
    </div>
        <div class="row">
          <div class="form-group for-shop col-sm-4 col-md-4 col-lg-4">
            <label>Guest Price</label>
            <input type="text" name="price1" placeholder="without currency at the end" value="<?=@$_POST['price1']?>" class="form-control">
          </div>
          <div class="form-group for-shop col-sm-4 col-md-4 col-lg-4">
            <label>Retailer Price</label>
            <input type="text" name="price2" placeholder="without currency at the end" value="<?=@$_POST['price2']?>" class="form-control">
          </div>
          <div class="form-group for-shop col-sm-4 col-md-4 col-lg-4">
            <label>Wholesaller Price</label>
            <input type="text" name="price3" placeholder="without currency at the end" value="<?=@$_POST['price3']?>" class="form-control">
          </div>
        </div>
        <div class="form-group for-shop">
          <label>Packing type</label>
          <select class="selectpicker" name="refPackagingtype_id">
          <option value="">Select Type</option>
          <?php
            $query = $this->db->get('packagingtype');
            $result =$query->result_array();    
            foreach ($result as $key => $value) {
          ?>
            <option <?php if(isset($_POST['refPackagingtype_id']))
            {
              if($_POST['refPackagingtype_id'] == $value['packagingtype_id'])
              {echo 'selected';}
            }?> value="<?=$value['packagingtype_id']?>"><?php echo $value['title'].'-'.$value['pcs']?>
            </option>
            <?php }?>
          </select>
        </div>
      </div>

      <div class="col-md-6">  
        <h3>Thely</h3>
        <div class="form-group">
          <label>Title </label>
          <input type="text" name="theli_title[]" value="<?=$trans_load != null && isset($trans_load[$language->abbr]['theli_title']) ? $trans_load[$language->abbr]['theli_title'] : ''?>" class="form-control">
        </div>  
        <div class="row">
          <div class="form-group for-shop col-sm-4 col-md-4 col-lg-4">
            <label>Guest Price</label>
            <input type="text" name="theli_price1" placeholder="without currency at the end" value="<?=@$_POST['theli_price1']?>" class="form-control">
          </div>
          <div class="form-group for-shop col-sm-4 col-md-4 col-lg-4">
            <label>Retailer Price</label>
            <input type="text" name="theli_price2" placeholder="without currency at the end" value="<?=@$_POST['theli_price2']?>" class="form-control">
          </div>
          <div class="form-group for-shop col-sm-4 col-md-4 col-lg-4">
            <label>Wholesaller Price</label>
            <input type="text" name="theli_price3" placeholder="without currency at the end" value="<?=@$_POST['theli_price3']?>" class="form-control">
          </div>
        </div>
      </div>
    </div>
<br>
    <div class="form-group">
      <label for="description<?=$i?>">Description </label>
      <textarea name="description[]" id="description<?=$i?>" rows="50" class="form-control"><?=$trans_load != null && isset($trans_load[$language->abbr]['description']) ? $trans_load[$language->abbr]['description'] : ''?>
      </textarea>
      <script>
                    CKEDITOR.replace('description<?=$i?>');
                    CKEDITOR.config.entities = false;
                </script>
    </div>
    
    <div class="form-group for-shop">
      <?php /*?><label>Old Price </label><?php */?>
      <input type="hidden" name="old_price[]" placeholder="without currency at the end" value="<?=$trans_load != null && isset($trans_load[$language->abbr]['old_price']) ? $trans_load[$language->abbr]['old_price'] : ''?>" class="form-control">
    </div>
  </div>
  <?php
$i++;
}
?>
  <div class="form-group bordered-group">
    <?php
if (isset($_POST['image']) && $_POST['image'] != null) {
	$image = 'attachments/shop_images/' . $_POST['image'];
	if (!file_exists($image)) {
		$image = 'attachments/no-image.png';
	}
	?>
    <p>Current image:</p>
    <div> <img src="<?=base_url($image)?>" class="img-responsive img-thumbnail" style="max-width:300px; margin-bottom: 5px;"> </div>
    <input type="hidden" name="old_image" value="<?=$_POST['image']?>">
    <?php if (isset($_GET['to_lang'])) {?>
    <input type="hidden" name="image" value="<?=$_POST['image']?>">
    <?php
}
}
?>
    <label for="userfile">Cover Image</label>
    <input type="file" id="userfile" name="userfile">
  </div>

  <div class="form-group bordered-group">
    <div class="others-images-container">
      <?=$loadpdfimages?> 
    </div>
    <?php /*?><a href="javascript:void(0);" data-toggle="modal" data-target="#modalMoreImages" class="btn btn-default">Upload more images</a><?php */?>
    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalMorePdf" class="btn btn-default">Upload PDF File</a> 
  </div>


<?php
  $this->db->where('refProduct_id', $id);                    
  $query = $this->db->get('product_image');
  $otherImgs =$query->result_array();
?>

  <div class="form-group bordered-group">
    <div class="row">
      <?php
        if(!empty($otherImgs)){
          foreach($otherImgs as $img_row){
            ?>
          <div class="outer col-md-2" id=<?php echo 'img_'.$img_row['product_image_id']; ?>>
            <ion-card class="inner" *ngFor="let i of images">
              <img src="<?php echo base_url('attachments/uploads/thumb'); ?>/<?php echo $img_row['img_name']; ?>"/>
              <span class="close-icon delete-image" data-id="<?php echo $img_row['product_image_id']; ?>">X</span>
            </ion-card>
          </div>
            <?php
          }
        }
      ?>
  </div>

<script>

$(document).on('click', '.delete-image', function (e) {
     e.preventDefault();
    var imgId = $(this).data('id');
    // alert(imgId);
    var this_ = $(this);
    this_.attr('disabled', 'disabled');
  $.ajax({
        type: 'POST',
        url: '<?php echo site_url('admin/removeimg'); ?>',
        data: {'imgId': imgId},
        success: function (res) {
            this_.removeAttr('disabled');
            var data = $.parseJSON(res);
            if (data.suceess == 'success') {
                $("#img_" + imgId).remove();
            }
        }
  });
});
</script>

  <br><br>  
    <?php /*?><a href="javascript:void(0);" data-toggle="modal" data-target="#modalMoreImages" class="btn btn-default">Upload more images</a><?php */?>
    <input type="file" name="products_others_image[]" id="products_others_image" accept="iamge/*" multiple>
    <!-- <a href="javascript:void(0);" data-toggle="modal" data-target="#modalMorePdf" class="btn btn-default">Upload PDF File</a>  -->
    </div>
  <div class="form-group for-shop" style="display:none;">
    <label>Shop Categories</label>
    <select class="selectpicker form-control show-tick show-menu-arrow" name="shop_categorie">
      <?php foreach ($shop_categories as $key_cat => $shop_categorie) {
	?>
      <option <?=isset($_POST['shop_categorie']) && $_POST['shop_categorie'] == $key_cat ? 'selected=""' : ''?> value="<?=$key_cat?>">
      <?php
foreach ($shop_categorie['info'] as $nameAbbr) {
		if ($nameAbbr['abbr'] == $this->config->item('language_abbr')) {
			echo $nameAbbr['name'];
		}
	}
	?>
      </option>
      <?php }?>
    </select>
  </div>

  
  <!-- <div class="form-group for-shop" style="display: inline-block;">
    <label>Attribute</label>
    <div class="col-sm-12 col-md-12 col-lg-12 ">
      <table border="1">
        <?php
$query = $this->db->query('SELECT translations_first.*, (SELECT name FROM shop_attribute_translations WHERE for_id = sub_for AND abbr = translations_first.abbr) as sub_is, shop_attribute.position FROM shop_attribute_translations as translations_first INNER JOIN shop_attribute ON shop_attribute.id = translations_first.for_id WHERE shop_attribute.sub_for = 0 ORDER BY position ASC');
$result = $query->result_array();
foreach ($result as $key => $value) {
	?>
        <tr>
          <th><?=$value['name'];?></th>
          <td><select class="selectpicker form-control show-tick show-menu-arrow" name="shop_attribute[<?=$value['id']?>][]">
              <option value="">Select Attribute Value</option>
              <?php
$query = $this->db->query('SELECT translations_first.*, (SELECT name FROM shop_attribute_translations WHERE for_id = sub_for AND abbr = translations_first.abbr) as sub_is, shop_attribute.position FROM shop_attribute_translations as translations_first INNER JOIN shop_attribute ON shop_attribute.id = translations_first.for_id WHERE shop_attribute.sub_for = ' . $value['id'] . ' ORDER BY position ASC');
	$result = $query->result_array();
	foreach ($result as $key => $values) {
		//if ($id == 0) {$id = '';}
		$query = $this->db->query('SELECT valueid FROM product_attribute WHERE productid = ' . $id . ' AND productid != 0 AND keyid = ' . $value['id']);
		$result = $query->row();
		?>
              <option <?php if (isset($result->valueid) && $result->valueid == $values['id']) {echo 'selected="selected"';}?> value="<?=$values['id']?>">
              <?=$values['name']?>
              </option>
              <?php }?>
            </select></td>
        </tr>
        <?php }
?>
      </table>
    </div>
  </div> -->


  <div class="form-group for-shop" style="display: inline-block;">
    <label>Attribute</label>
    <div class="col-sm-12 col-md-12 col-lg-12 ">
      <table border="1">
        <?php
$this->db->where('status', 1);
$query = $this->db->get('attributes_group');
$result =$query->result_array();
// $query = $this->db->query('SELECT * FROM attributes_group WHERE status=1"');
// $result = $query->result_array();
// echo '<pre>';print_r($result);die;

$this->db->where('refProduct_id', $id);                  
$query = $this->db->get('product_attribute1');
$this->db->order_by('sort_order','asc');   
$result_product =$query->result_array();

foreach ($result as $key => $value) {
	?>
        <tr>
          <th><?=$value['title'];?></th>
          <td>
          <div class="form-group for-shop">  
          <select class="selectpicker form-control show-tick show-menu-arrow" multiple name="refattributes_id[<?=$value['attributesgroup_id']?>][]">
              <!-- <option value="">Select Attributes</option> -->
              <?php
                    $this->db->where('status', 1);
                    $this->db->where('refAttributes_group_id', $value['attributesgroup_id']);
                    $query = $this->db->get('attributes');
                    $result_attributes =$query->result_array();
	            foreach ($result_attributes as $key => $values) {	
                    $select='';			                
                    foreach($result_product as $r_p_row){
                        if($r_p_row['refattributes_id']==$values['attributes_id']){
                          $select='selected="selected"';	
                        }  
                    }
		          ?>
              <option <?=$select?> value="<?= $values['attributes_id']; ?>">
              <?= $values['title']; ?>
              </option>
              <?php }?>
            </select>
                  </div></td>
        </tr>
        <?php }
?>
      </table>
    </div>
  </div>

 

  <?php
$productoffertype = [];
if (isset($_POST['productoffertype'])) {
	$productoffertype = explode(",", $_POST['productoffertype']);
}
?>
  <div class="form-group for-shop">
  <label>Offer type : </label>
      <div class="checkbox-inline"><label for="latest"><input <?php if (in_array("latest", $productoffertype)) {echo 'checked';}?> type="checkbox" name="productoffertype[]" value="latest" />Latest</label></div>
      <div class="checkbox-inline"><label for="trending"><input <?php if (in_array("trending", $productoffertype)) {echo 'checked';}?> type="checkbox" name="productoffertype[]" value="trending" />Trending</label></div>
      <div class="checkbox-inline"><label for="recommended"><input <?php if (in_array("recommended", $productoffertype)) {echo 'checked';}?> type="checkbox" name="productoffertype[]" value="recommended"/>Recommended</label></div>
  </div>


  <div class="form-group for-shop">
    <?php /*?><label>Quantity</label><?php */?>
    <input type="hidden" placeholder="number" name="quantity" value="<?=@$_POST['quantity']?>" class="form-control" id="quantity">
  </div>
  <?php if ($showBrands == 1) {?>
  <div class="form-group for-shop">
    <label>Brand</label>
    <select class="selectpicker" name="brand_id">
      <?php foreach ($brands as $brand) {?>
      <option <?=isset($_POST['brand_id']) && $_POST['brand_id'] == $brand['id'] ? 'selected' : ''?> value="<?=$brand['id']?>">
      <?=$brand['name']?>
      </option>
      <?php }?>
    </select>
  </div>
  <?php }if ($virtualProducts == 1) {?>
  <div class="form-group for-shop">
    <label>Virtual Products <a href="javascript:void(0);" data-toggle="modal" data-target="#virtualProductsHelp"><i class="fa fa-question-circle" aria-hidden="true"></i></a></label>
    <textarea class="form-control" name="virtual_products"><?=@$_POST['virtual_products']?>
</textarea>
  </div>
  <?php }?>
  <?php /*?><div class="form-group for-shop">
<label>In Slider</label>
<select class="selectpicker" name="in_slider">
<option value="1" <?= isset($_POST['in_slider']) && $_POST['in_slider'] == 1 ? 'selected' : '' ?>>Yes</option>
<option value="0" <?= isset($_POST['in_slider']) && $_POST['in_slider'] == 0 || !isset($_POST['in_slider']) ? 'selected' : '' ?>>No</option>
</select>
</div><?php */?>
<div class="form-group for-shop">
    <label>Categories</label>
    <select class="selectpicker form-control" data-live-search="true" id="multipleSelectcat" name="shop_categorie[]" multiple>
      <?php foreach ($shop_categories as $key_cat => $shop_categorie) {
	$selectcat = '';
	if (isset($_POST['multicat'])) {
		$selectcat = '';
		if (in_array($key_cat, $_POST['multicat'])) {
			$selectcat = 'selected="selected"';
		}
	}

	?>
      <option <?=$selectcat;?> value="<?=$key_cat?>">
      <?php
foreach ($shop_categorie['info'] as $nameAbbr) {
		if ($nameAbbr['abbr'] == $this->config->item('language_abbr')) {
			echo $nameAbbr['name'];
		}
	}
	?>
      </option>
      <?php }?>
    </select>
  </div>

  <div class="form-group for-shop">
    <label>Connected Products</label>
    <select class="selectpicker form-control show-tick show-menu-arrow" data-live-search="true" name="connectedProduct[]" multiple>
      <?php foreach ($conn_products as $conn_product) {
	$selectcat = '';
	if (isset($_POST['multiConnProduct'])) {
		$selectcat = '';
		if (in_array($conn_product['p_id'], $_POST['multiConnProduct'])) {
			$selectcat = 'selected="selected"';
		}
	}

	?>
      <option <?=$selectcat;?> value="<?=$conn_product['p_id']?>">
      <?php
      echo $conn_product['title'];
	?>
      </option>
      <?php }?>
    </select>
  </div>

  <!-- <div class="form-group for-shop">
    <label>Product Type</label>
    <select class="selectpicker form-control show-tick show-menu-arrow" name="product_type" required>
      <option value="">Select Product Type</option>
      <option value="parcel" <?=isset($_POST['product_type']) && $_POST['product_type'] == 'parcel' ? 'selected' : ''?>>Parcel</option>
      <option value="loose" <?=isset($_POST['product_type']) && $_POST['product_type'] == 'loose' ? 'selected' : ''?>>Loose</option>
    </select>
  </div> -->
  <div class="form-group for-shop">
    <label>Pcs</label>
    <input type="text" required placeholder="number" name="product_pcs" value="<?=@$_POST['product_pcs']?>" class="form-control" id="quantity">
  </div>
  <div class="form-group for-shop">
    <label>Youtube Video ID</label>
    <input type="text" placeholder="Youtube Video ID" pattern="[a-zA-Z0-9_-]{11}" name="videoid" value="<?=@$_POST['videoid']?>" class="form-control">
  </div>
  <div class="form-group for-shop">
    <label>Min Qty</label>
    <input type="text" required placeholder="number" name="min_qty" value="<?=@$_POST['min_qty']?>" class="form-control" id="quantity">
  </div>

<?php

// $this->db->where('itemid', $_POST['id']);  
// $order_product_stock = $this->db->get('order_products')->result_array();
  $this->db->select('qty');
  $this->db->where('refProduct_id', $_POST['id']);
  $result = $this->db->get('stock')->row_array();    
  $totalStock=0;
  if(!empty($result)){
    $totalStock=$result['qty'];
  }
?>
  <div class="form-group for-shop">
    <label>Opening stock</label>
    <input type="text" required placeholder="Stock" name="stock" <?php if(isset($_POST['id'])){echo 'readonly';} ?> value="<?=$totalStock?>" class="form-control" id="stock">
  </div>
<?php
$productviewtype = [];
if (isset($_POST['productviewtype'])) {
	$productviewtype = explode(",", $_POST['productviewtype']);
}
?>
  <!-- <div class="form-group for-shop">
      <div class="checkbox-inline"><label for="registorcustomer"><input <?php //if (in_array("registorcustomer", $productviewtype)) {echo 'checked';}?> id="registorcustomer" type="checkbox" name="productviewtype[]" value="registorcustomer" />Registor Customer</label></div>
      <div class="checkbox-inline"><label for="websiteuser"><input <?php //if (in_array("websiteuser", $productviewtype)) {echo 'checked';}?> id="websiteuser" type="checkbox" name="productviewtype[]" value="websiteuser" />Website User</label></div>
      <div class="checkbox-inline"><label for="guestuser"><input <?php //if (in_array("guestuser", $productviewtype)) {echo 'checked';}?> id="guestuser" type="checkbox" name="productviewtype[]" value="guestuser"/>Guest User</label></div>
  </div> -->

  <div class="form-group for-shop">
      <div class="checkbox-inline"><label for="guest"><input <?php if (in_array("guest", $productviewtype)) {echo 'checked';}?> id="guest" type="checkbox" name="productviewtype[]" value="guest" />Guest</label></div>
      <div class="checkbox-inline"><label for="retailer"><input <?php if (in_array("retailer", $productviewtype)) {echo 'checked';}?> id="retailer" type="checkbox" name="productviewtype[]" value="retailer" />Retailer</label></div>
      <div class="checkbox-inline"><label for="wholesaller"><input <?php if (in_array("wholesaller", $productviewtype)) {echo 'checked';}?> id="wholesaller" type="checkbox" name="productviewtype[]" value="wholesaller"/>Wholesaller</label></div>
  </div>


  <div class="form-group for-shop">
    <?php /*?><label>Position</label><?php */?>
    <input type="hidden" placeholder="Position number" name="position" value="<?=@$_POST['position']?>" class="form-control">
  </div>
  <button type="submit" name="submit" class="btn btn-lg btn-default btn-publish">Submit</button>
  <a href="<?=base_url('admin/products')?>" class="btn btn-lg btn-default">Cancel</a>
</form>
<!-- Modal Upload More Images -->
<div class="modal fade" id="modalMoreImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload more images</h4>
      </div>
      <div class="modal-body">
        <form id="uploadImagesForm">
          <input type="hidden" value="<?=isset($_POST['folder']) ? $_POST['folder'] : $timeNow?>" name="folder">
          <label for="others">Select images</label>
          <input type="file" name="others[]" id="others" multiple />
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default finish-upload"> <span class="finish-text">Finish</span> <img src="<?=base_url('assets/imgs/load.gif')?>" class="loadUploadOthers" alt=""> </button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Upload PDF To Images -->
<div class="modal fade" id="modalMorePdf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload PDF</h4>
      </div>
      <div class="modal-body">
        <form id="uploadPdfForm">
          <input type="hidden" value="<?=isset($_POST['folder']) ? $_POST['folder'] : $timeNow?>" name="folder">
          <label for="pdffile">Select PDF File</label>
          <input type="file" name="pdffile" id="pdffile" accept="application/pdf"/>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default finish-upload-pdf"> <span class="finish-text-pdf">Finish</span> <img src="<?=base_url('assets/imgs/load.gif')?>" class="loadUploadpdffile" alt=""> </button>
      </div>
    </div>
  </div>
</div>
<!-- virtualProductsHelp -->
<div class="modal fade" id="virtualProductsHelp" tabindex="-1" role="dialog" aria-labelledby="virtualProductsHelp">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">What are virtual products?</h4>
      </div>
      <div class="modal-body"> Sometimes we want to sell products that are for electronic use such as books. In the box below, you can enter links to products that can be downloaded after you confirm the order as "Processed" through the "Orders" tab, an email will be sent to the customer entered with the entire text entered in the "virtual products" field.
        We have left only the possibility to add links in this field because sometimes it is necessary that the electronic stuff you provide for downloading will be uploaded to other servers. If you want, you can add your files to "file manager" and take the links to them to add to the "virtual products" </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 10px;
}
</style>

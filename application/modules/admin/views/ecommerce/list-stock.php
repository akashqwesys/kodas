<?php
$this->db->select('qty');
$this->db->where('refProduct_id', $productid);
$result = $this->db->get('stock')->row_array();   
$openingStock=0;
  if(!empty($result)){
    $openingStock=$result['qty'];
  }
?>


<?php
$this->db->select('qty');
$this->db->where('itemid', $productid);
$result = $this->db->get('order_products')->row_array();   
$orderStock=0;
  if(!empty($result)){
    $orderStock=$result['qty'];
  }
?>


<?php

$this->db->select_sum('qty');
$this->db->where('itemid',$productid);
$result = $this->db->get('order_products')->row();  
$totalStockOrder=$result->qty;

$this->db->select_sum('qty');
$this->db->where('refProduct_id', $productid);
$result = $this->db->get('stock')->row();  
$totalStock1=$result->qty;

$finalstock=$totalStock1-$totalStockOrder;

?>


<div>
<h1>Stock History</h1>
<hr>
<div class="row">
  <div class="col-md-4">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Product Details</h3>
      </div>
      <table class="table">
        <tbody>
          <tr>
            <td><b>Box Title</b></td>
            <td>:</td>
            <td><?php echo $product['title']; ?></td>
          </tr>
          <tr>
            <td><b>Thely Title</b></td>
            <td>:</td>
            <td><?php echo $product['theli_title']; ?></td>
          </tr> 
          <tr>
            <td><b>Opening Stock</b></td>
            <td>:</td>
            <td><?php echo $openingStock; ?></td>
          </tr>
          <tr>
            <td><b>Another Stock</b></td>
            <td>:</td>
            <td><?php echo $totalStock1-$openingStock; ?></td>
          </tr>
          <tr>
            <td><b>Sale Qty</b></td>
            <td>:</td>
            <td><?php echo $orderStock; ?></td>
          </tr> 
          <tr>
            <td><b>Available Stock</b></td>
            <td>:</td>
            <td><?php echo $finalstock; ?></td>
          </tr> 
                           
        </tbody>
      </table>
    </div>
  </div>
</div>

<br>
<h1>Another Stock <a href="<?= base_url('admin/add-stock/').$productid; ?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;float:right"><b>+</b> Add Stock</a></h1>
<hr>
  <div class="row">
    <div class="col-xs-12">
      <div class="table-responsive">
        <table id="table" class="table dt-responsive nowrap">
          <thead>
            <tr>
              <th>No</th>
              <th>QTY</th>
              <th>Date</th>                                                       
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>
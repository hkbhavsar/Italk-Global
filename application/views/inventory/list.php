<?php if(Session::instance()->get('session_msg')!=''){?>
<div class="succes">
        <div class="succes_icon"><!-- --></div>
        <a href="#" class="close" title="Close this notification">x</a>
        <div class="desc">
            <span>Success!</span>
                <p><?php echo Session::instance()->get('session_msg');Session::instance()->delete('session_msg'); ?></p>
        </div>
</div>
<?php }?>
<h2>Inventory</h2>
<table cellspacing="0" cellpadding="0" border="0">
  <!-- Table -->
  <thead>
    <tr>
      <th><input type="checkbox" class="checkall" /></th>
      <th>Product Type</th>
      <th>Product Model</th>
      <th>Product Manufacture</th>
      <th>Vendor</th>
      <th>Cost</th>
      <th>Qty.</th>
      <th>Date Added</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $i=1;
    foreach($inventoryData as $inventory){
            $class = $i%2==0?'':'alt';
            if($inventory->product_type==1)
                $product_type = 'Phone';
            if($inventory->product_type==2)
                $product_type = 'Accesorries';
            if($inventory->product_type==3)
                $product_type = 'Other';
   ?>
    <tr class="<?php echo $class;?>">
      <td><input type="checkbox" /></td>
      <td><?php echo $product_type;?></td>
      <td><?php echo $inventory->model;?></td>
      <td><?php echo $inventory->manufacturer_id;?></td>
      <td><?php echo $inventory->first_name;?></td>
      <td><?php echo $inventory->product_coast;?></td>
      <td><?php echo $inventory->product_qty;?></td>
      <td><?php echo date('m-d-Y',strtotime($inventory->date_added));?></td>
      <td>
      &nbsp;&nbsp;<a href="#"><img src="<?php echo Kohana::$base_url; ?>assets/low_stock.png" alt="Low Stocks" title="Low Stocks"></a>
      &nbsp;&nbsp;<a href="#"><img src="<?php echo Kohana::$base_url; ?>assets/action_delete.png" alt="Edit" title="Delete Inventory"/></a>&nbsp;&nbsp;<!--<a href="#"><img src="<?php echo Kohana::$base_url; ?>assets/action_delete.png" alt="Delete"  title="Delete Customer"/></a>--></td>
    </tr>
    <?php $i++;}?>
  </tbody>
</table>
<?php echo $pagging_links;?>
</div>

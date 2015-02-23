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
<h2>Products</h2>
<table cellspacing="0" cellpadding="0" border="0">
  <!-- Table -->
  <thead>
    <tr>
      <th><input type="checkbox" class="checkall" /></th>
      <th>No</th>
      <th>SKU</th>
      <th>Product Model</th>
      <th>Manufacturer</th>
      <th>Cost</th>
      <th>Qty.</th>
      <th>Date Added</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
  		$i=1;
  		foreach($productData as $product){
			$class = $i%2==0?'':'alt';
			?>
    <tr class="<?php echo $class;?>">
      <td><input type="checkbox" /></td>
      <td><?php echo $i;?></td>
      <td><?php echo $product->sku;?></td>
      <td><?php echo $product->model;?></td>
      <td><?php echo $product->manufacturer;?></td>
      <td><?php echo $product->cost;?></td>
      <td><?php echo $product->lowest_qty;?></td>
      <td><?php echo date('m-d-Y',strtotime($product->date_added));?></td>
      <td><a href="#"><img src="<?php echo Kohana::$base_url; ?>assets/basket_put.png" alt="Add" title="Add Order" /></a>
      &nbsp;&nbsp;<a href="#"><img src="<?php echo Kohana::$base_url; ?>assets/low_stock.png" alt="Low Stocks" title="Low Stocks"></a>
      &nbsp;&nbsp;<a href="<?php echo Kohana::$base_url; ?>product/create/<?php echo $product->product_id;?>"><img src="<?php echo Kohana::$base_url; ?>assets/action_edit.png" alt="Edit" title="Edit Product"/></a>&nbsp;&nbsp;<!--<a href="#"><img src="<?php echo Kohana::$base_url; ?>assets/action_delete.png" alt="Delete"  title="Delete Customer"/></a>--></td>
    </tr>
    <?php $i++;}?>
  </tbody>
</table>
<?php echo $pagging_links;?>
</div>

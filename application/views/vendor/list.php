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
<h2>Vendors</h2>
<table cellspacing="0" cellpadding="0" border="0">
  <!-- Table -->
  <thead>
    <tr>
      <th><input type="checkbox" class="checkall" /></th>
      <th>No</th>
      <th>Vendor Name</th>
      <th>Email Address</th>
      <th>Work Phone</th>
      <th>Mobile Phone</th>
      <th>Date Added</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php
  		$i=1;
  		foreach($vendorData as $vendor){
			$class = $i%2==0?'':'alt';
			?>
    <tr class="<?php echo $class;?>">
      <td><input type="checkbox" /></td>
      <td><?php echo $i;?></td>
      <td><?php echo $vendor->first_name." ".$customer->last_name;?></td>
      <td><?php echo $vendor->vendor_email;?></td>
      <td><?php echo $vendor->work_phone;?></td>
      <td><?php echo $vendor->mobile_phone;?></td>
      <td><?php echo date('m-d-Y',strtotime($vendor->date_added));?></td>
      <td><a href="#"><img src="<?php echo Kohana::$base_url; ?>assets/basket_put.png" alt="Add" title="Add Qty." /></a>
      
      &nbsp;&nbsp;<a href="<?php echo Kohana::$base_url; ?>vendor/create/<?php echo $vendor->vendor_id;?>"><img src="<?php echo Kohana::$base_url; ?>assets/action_edit.png" alt="Edit" title="Edit Vendor"></a>&nbsp;&nbsp;<a href="#"><img src="<?php echo Kohana::$base_url; ?>assets/action_delete.png" alt="Delete"  title="Delete Vednor"/></a></td>
    </tr>
    <?php $i++;}?>
  </tbody>
</table>
<?php echo $pagging_links;?>
</div>

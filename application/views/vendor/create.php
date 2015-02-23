<?php
    if((count($results['msg_errors'])>0)):
?>

<div class="err">
  <div class="err_icon">
    <!-- -->
  </div>
  <a href="#" class="close" title="Close this notification">x</a>
  <div class="desc"> <span>Error!</span>
    <?php foreach($results['msg_errors'] as $erro_msg){?>
    <p><?php echo $erro_msg;?></p>
    <?php }?>
  </div>
</div>
<?php endif;?>
<?php
    if($results['msg_success']!=''):
?>
<div class="succes">
  <div class="succes_icon">
    <!-- -->
  </div>
  <a href="#" class="close" title="Close this notification">x</a>
  <div class="desc"> <span>Success!</span>
    <p><?php echo $results['msg_success'];?></p>
  </div>
</div>
<?php endif;?>
<script type="text/javascript">
$(document).ready(function() {
	$("#frm_create").validate();
});
</script>
<?php

	$first_name = $_POST['first_name']!=''?$_POST['first_name']:$edit_custdata['first_name'];
	$last_name = $_POST['last_name']!=''?$_POST['last_name']:$edit_custdata['last_name'];
	$work_phone = $_POST['work_phone']!=''?$_POST['work_phone']:$edit_custdata['work_phone'];
	$mobile_phone = $_POST['mobile_phone']!=''?$_POST['mobile_phone']:$edit_custdata['mobile_phone']; 
	$vendor_email = $_POST['vendor_email']!=''?$_POST['vendor_email']:$edit_custdata['vendor_email'];
	$vendor_notes = $_POST['vendor_notes']!=''?$_POST['vendor_notes']:$edit_custdata['vendor_notes'];
	$vendor_address = $_POST['vendor_address']!=''?$_POST['vendor_address']:$edit_custdata['vendor_address'];
?>
<form method="post" name="frm_create" id="frm_create">
  <!-- Form -->
  <!-- Fieldset -->
  <fieldset>
    <legend><?php echo $title;?></legend>
    <div class="input_field">
      <label for="sf">First Name: </label>
      <input class="mediumfield required" name="first_name" type="text" value="<?php echo $first_name;?>" />
      <span class="field_compulsory">*</span> </div>
    <div class="input_field">
      <label for="sf">Last Name: </label>
      <input class="mediumfield required" name="last_name" type="text" value="<?php echo $last_name;?>" />
      <span class="field_compulsory">*</span> </div>
     
     <div class="input_field">
       <label for="sf">Work Phone: </label>
        <input class="smallfield required" name="work_phone" type="text" value="<?php echo $work_phone;?>" />
      <span class="field_compulsory">*</span> </div>
      
    <div class="input_field">
       <label for ="che">Email Address: </label>
      <input class="mediumfield" name="vendor_email" type="text" value="<?php echo $vendor_email;?>" />
      <span class="field_compulsory">*</span> </div>
    
   <div class="input_field" style="width:34%">
        <label for ="che">Mobile Phone: </label>
        <input class="smallfield" name="mobile_phone" type="text" value="<?php echo $mobile_phone;?>" />
   </div>
   
   <div class="input_field">
      <label for ="che">Address: </label>
      <textarea rows="5" cols="50" name="vendor_address"><?php echo $vendor_address;?></textarea>
   </div>
   
   <div class="input_field">
      <label for ="che">Notes: </label>
      <textarea rows="10" cols="50" name="vendor_notes"><?php echo $vendor_notes;?></textarea>
   </div>
    <div class="input_field no_margin_bottom">
      <input class="submit" type="submit" value="Submit" />
      <input class="submit" type="reset" value="Reset" />
      <!--<a href="#" class="button">A button</a>-->
    </div>
  </fieldset>
  <!-- End of fieldset -->
</form>
<!-- /Form -->

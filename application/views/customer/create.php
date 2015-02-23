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
	$cust_compnay = $_POST['cust_company']!=''?$_POST['cust_company']:$edit_custdata['cust_company'];
	$first_name = $_POST['first_name']!=''?$_POST['first_name']:$edit_custdata['first_name'];
	$last_name = $_POST['last_name']!=''?$_POST['last_name']:$edit_custdata['last_name'];
	$cust_intial = $_POST['cust_intial']!=''?$_POST['cust_intial']:$edit_custdata['intial'];
	$work_phone = $_POST['cust_work_phone']!=''?$_POST['cust_work_phone']:$edit_custdata['work_phone'];
	$mobile_phone = $_POST['cust_mobile_phone']!=''?$_POST['cust_company']:$edit_custdata['mobile_phone'];
	$cust_taxid = $_POST['cust_taxid']!=''?$_POST['cust_taxid']:$edit_custdata['tax_id'];
	$cust_terms = $_POST['terms']!=''?$_POST['terms']:$edit_custdata['terms'];
	$cust_notes = $_POST['cust_notes']!=''?$_POST['cust_notes']:$edit_custdata['cust_notes'];
	$cust_fax = $_POST['cust_fax']!=''?$_POST['cust_fax']:$edit_custdata['fax'];
	$cust_email = $_POST['cust_email']!=''?$_POST['cust_email']:$edit_custdata['cust_email'];
	
	$cust_address = $_POST['cust_address']!=''?$_POST['cust_address']:$edit_address['address_1'];
	$cust_address2  = $_POST['cust_address2']!=''?$_POST['cust_address2']:$edit_address['address_2'];
	$cust_city  = $_POST['cust_city']!=''?$_POST['cust_city']:$edit_address['city'];
	$cust_state  = $_POST['cust_state']!=''?$_POST['cust_state']:$edit_address['state'];
	$cust_zip  = $_POST['cust_zip']!=''?$_POST['cust_zip']:$edit_address['zip'];
?>
<form method="post" name="frm_create" id="frm_create">
<input type="hidden" name="address_id" value="<?php echo $edit_address['address_id']?>"  />
  <!-- Form -->
  <!-- Fieldset -->
  <fieldset>
    <legend><?php echo $title;?></legend>
    <div class="input_field">
      <label for="sf">Company Name: </label>
      <input class="bigfield required" name="cust_company" type="text" value="<?php echo $cust_compnay;?>" />
      <span class="field_compulsory">*</span> </div>
    <div class="input_field">
      <label for="sf">First Name: </label>
      <input class="mediumfield required" name="first_name" type="text" value="<?php echo $first_name;?>" />
      <span class="field_compulsory">*</span> </div>
    <div class="input_field">
      <label for="sf">Last Name: </label>
      <input class="mediumfield required" name="last_name" type="text" value="<?php echo $last_name;?>" />
      <span class="field_compulsory">*</span> </div>
    <div class="input_field">
      <label for="mf">Intial: </label>
      <select name="cust_intial" class="dropdown">
        <option>Mr.</option>
        <option>Miss.</option>
      </select>
      <span class="field_compulsory">*</span> </div>
    <div style="width:100%;">
      <div class="input_field" style="width:40%">
        <label for="sf">Address: </label>
        <input class="mediumfield required" name="cust_address" type="text" value="<?php echo $cust_address;?>" />
        <span class="field_compulsory">*</span> </div>
      <div class="input_field" style="width:50%">
        <label for="sf">Address 2: </label>
        <input class="mediumfield" name="cust_address2" type="text" value="<?php echo $cust_address2;?>" />
      </div>
    </div>
    <div style="width:100%;">
      <div class="input_field" style="width:27%">
        <label for="sf">City: </label>
        <input class="smallfield" name="cust_city" type="text" value="<?php echo $cust_city;?>" />
      </div>
      <div class="input_field" style="width:39%">
        <label for="lf">State: </label>
        <select name="cust_state" class="dropdown">
          <option value="AK" <?php echo $cust_state=='AK'?'selected="selected"':'';?>>AK</option>
          <option value="AL" <?php echo $cust_state=='AL'?'selected="selected"':'';?>>AL</option>
          <option value="AR" <?php echo $cust_state=='AR'?'selected="selected"':'';?>>AR</option>
          <option value="AZ" <?php echo $cust_state=='AZ'?'selected="selected"':'';?>>AZ</option>
          <option value="CA" <?php echo $cust_state=='CA'?'selected="selected"':'';?>>CA</option>
          <option value="CO" <?php echo $cust_state=='CO'?'selected="selected"':'';?>>CO</option>
          <option value="CT" <?php echo $cust_state=='CT'?'selected="selected"':'';?>>CT</option>
          <option value="DC" <?php echo $cust_state=='DC'?'selected="selected"':'';?>>DC</option>
          <option value="DE" <?php echo $cust_state=='DE'?'selected="selected"':'';?>>DE</option>
          <option value="FL" <?php echo $cust_state=='FL'?'selected="selected"':'';?>>FL</option>
          <option value="GA" <?php echo $cust_state=='GA'?'selected="selected"':'';?>>GA</option>
          <option value="HI" <?php echo $cust_state=='HI'?'selected="selected"':'';?>>HI</option>
          <option value="IA" <?php echo $cust_state=='IA'?'selected="selected"':'';?>>IA</option>
          <option value="ID" <?php echo $cust_state=='ID'?'selected="selected"':'';?>>ID</option>
          <option value="IL" <?php echo $cust_state=='IL'?'selected="selected"':'';?>>IL</option>
          <option value="IN" <?php echo $cust_state=='IN'?'selected="selected"':'';?>>IN</option>
          <option value="KS" <?php echo $cust_state=='KS'?'selected="selected"':'';?>>KS</option>
          <option value="KY">KY</option>
          <option value="LA">LA</option>
          <option value="MA">MA</option>
          <option value="MD">MD</option>
          <option value="ME">ME</option>
          <option value="MI">MI</option>
          <option value="MN">MN</option>
          <option value="MO">MO</option>
          <option value="MS">MS</option>
          <option value="MT">MT</option>
          <option value="NC">NC</option>
          <option value="ND">ND</option>
          <option value="NE">NE</option>
          <option value="NH">NH</option>
          <option value="NJ">NJ</option>
          <option value="NM">NM</option>
          <option value="NV">NV</option>
          <option value="NY">NY</option>
          <option value="OH">OH</option>
          <option value="OK">OK</option>
          <option value="OR">OR</option>
          <option value="PA">PA</option>
          <option value="PR">PR</option>
          <option value="RI">RI</option>
          <option value="SC">SC</option>
          <option value="SD">SD</option>
          <option value="TN">TN</option>
          <option value="TX">TX</option>
          <option value="UT">UT</option>
          <option value="VA">VA</option>
          <option value="VT">VT</option>
          <option value="WA">WA</option>
          <option value="WI">WI</option>
          <option value="WV">WV</option>
          <option value="WY">WY</option>
        </select>
      </div>
      <div class="input_field" style="width:30%">
        <label for="sf">Zip/Postal Code: </label>
        <input class="smallfield" name="cust_zip" type="text" value="<?php echo $cust_zip;?>" />
      </div>
    </div>
    <div style="width:100%;">
      <div class="input_field" style="width:32%">
        <label for="sf">Work Phone: </label>
        <input class="smallfield required" name="cust_work_phone" type="text" value="<?php echo $work_phone;?>" />
        <span class="field_compulsory">*</span> </div>
      <div class="input_field" style="width:34%">
        <label for ="che">Mobile Phone: </label>
        <input class="smallfield" name="cust_mobile_phone" type="text" value="<?php echo $mobile_phone;?>" />
      </div>
      <div class="input_field" style="width:28%">
        <label for ="che">Fax: </label>
        <input class="smallfield" name="cust_fax" type="text" value="<?php echo $cust_fax;?>" />
      </div>
    </div>
    <div class="input_field">
      <label for ="che">Email Address: </label>
      <input class="mediumfield" name="cust_email" type="text" value="<?php echo $cust_email;?>" />
    </div>
    <div style="width:100%;">
      <div class="input_field" style="width:40%">
        <label for="sf">Tax ID: </label>
        <input class="mediumfield" name="cust_taxid" type="text" value="<?php echo $cust_taxid;?>" />
      </div>
      <div class="input_field" style="width:50%">
        <label for="sf">Terms - Net(0-365) Days: </label>
        <input class="mediumfield required" name="cust_terms" type="text" value="<?php echo $cust_terms;?>" />
        <span class="field_compulsory">*</span> </div>
    </div>
    <div class="input_field">
      <label for ="che">Memo: </label>
      <textarea rows="10" cols="50" name="cust_notes"><?php echo $cust_notes;?></textarea>
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

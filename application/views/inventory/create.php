 <script>  
   $(document).ready(function() {
        
    });
</script>
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
<?php
	$product_type = $_POST['product_type']!=''?$_POST['product_type']:$edit_productData['product_type'];
	$sku = $_POST['sku']!=''?$_POST['sku']:$edit_productData['sku'];
	$model = $_POST['model']!=''?$_POST['model']:$edit_productData['model'];
	$mfr = $_POST['mfr']!=''?$_POST['mfr']:$edit_productData['manufacturer'];
	$cost = $_POST['cost']!=''?$_POST['cost']:$edit_productData['cost'];
	$retail_price = $_POST['retail_price']!=''?$_POST['retail_price']:$edit_productData['retail_price'];
	$carrier = $_POST['carrier']!=''?$_POST['carrier']:$edit_productData['carrier'];
	$repair_price = $_POST['repair_price']!=''?$_POST['repair_price']:$edit_productData['repair_price'];
	$lowest_price = $_POST['lowest_price']!=''?$_POST['lowest_price']:$edit_productData['lowest_price'];
	$alt_barcode = $_POST['alt_barcode']!=''?$_POST['alt_barcode']:$edit_productData['alt_barcode'];
	$description = $_POST['description']!=''?$_POST['description']:$edit_productData['description'];
	$lowest_qty = $_POST['lowest_qty']!=''?$_POST['lowest_qty']:$edit_productData['lowest_qty'];
	$exception_price  = $_POST['exception_price']!=''?$_POST['exception_price']:$edit_productData['exception_price'];
	$states_tax  = $_POST['states_tax']!=''?$_POST['states_tax']:$edit_productData['states_tax'];	
?>
<form method="post" name="frm_create" id="frm_create">
  <input type="hidden" name="address_id" value="<?php echo $edit_address['address_id']?>"  />
  <!-- Form -->
  <!-- Fieldset -->
  <fieldset>
    <legend><?php echo $title;?></legend>
   <div class="input_field">
    <div style="width:100%;">
    <div style="width:300px" class="input_field">
        <label for="lf">Product Type&nbsp;:&nbsp; </label>
        <select class="dropdown" name="product_type" id="product_type">
          <option value="">--- Select ---</option>
          <option value="1" <?php echo $product_type==1?'selected="selected"':'';?>>Phone</option>
          <option value="2" <?php echo $product_type==2?'selected="selected"':'';?>>Accessories</option>
          <option value="3" <?php echo $product_type==3?'selected="selected"':'';?>>Others</option>
        </select>
      </div>
      <div style="width:300px" class="input_field">
        <label for="sf">Product&nbsp;:&nbsp;</label>
        <span id="prod_dropdown" name="prod_dropdown" style="width:34%">
            <select class="dropdown" name="product" id="product_type">
              <option value="">--- Select ---</option>
            </select>
       </span>     
      </div>
    </div>
    
    <div style="width:100%;">
	   
      <div style="width:300px;" class="input_field">
       <div id="div_manufacture">
            <label for="sf">Manufacturer&nbsp;:&nbsp; </label>
            <select class="dropdown" name="mfr" id="mfr"> 
            <option value="">--- Select ---</option>
            <option value="Apple" <?php echo $mfr=='Apple'?'selected="selected"':'';?>>Apple</option><option value="Credit" <?php echo $mfr=='Credit'?'selected="selected"':'';?>>Credit</option><option value="HTC"  <?php echo $mfr=='HTC'?'selected="selected"':'';?>>HTC</option><option value="Huawei"  <?php echo $mfr=='Huawei'?'selected="selected"':'';?>>Huawei</option><option value="LG"  <?php echo $mfr=='LG'?'selected="selected"':'';?>>LG</option><option value="Motorola"  <?php echo $mfr=='Motorola'?'selected="selected"':'';?>>Motorola</option><option value="Nokia"  <?php echo $mfr=='Nokia'?'selected="selected"':'';?>>Nokia</option><option value="OEM"  <?php echo $mfr=='OEM'?'selected="selected"':'';?>>OEM</option><option value="Palm"  <?php echo $mfr=='Palm'?'selected="selected"':'';?>>Palm</option><option value="Pantech"  <?php echo $mfr=='Pantech'?'selected="selected"':'';?>>Pantech</option><option value="RIM"  <?php echo $mfr=='RIM'?'selected="selected"':'';?>>RIM</option><option value="Samsung"  <?php echo $mfr=='Samsung'?'selected="selected"':'';?>>Samsung</option><option value="Sanyo"  <?php echo $mfr=='Sanyo'?'selected="selected"':'';?>>Sanyo</option><option value="Sidekick"  <?php echo $mfr=='Sidekick'?'selected="selected"':'';?>>Sidekick</option><option value="Sony Ericsson"  <?php echo $mfr=='Sony Ericsson'?'selected="selected"':'';?>>Sony Ericsson</option><option value="T-Mobile"  <?php echo $mfr=='T-Mobile'?'selected="selected"':'';?>>T-Mobile</option>	
        </select>
        </div>
      </div>
      <div style="width:300px" class="input_field" >
          <label for="sf">Vendor&nbsp;:&nbsp;</label>
           <select id="vendor" name="vendor" class="dropdown">
            <option value="">--- Select ---</option>
            <?php
                 foreach($vendorData as $vendor){
            ?>
                <option value="<?php echo $vendor->vendor_id;?>"><?php echo $vendor->first_name." ".$vendor->last_name;?></option>
            <?php }?>
            </select>
        
      </div>
     
    </div>
    
     <div style="width:100%;">
	  <div style="width:300px" class="input_field">
         <label for="sf">Cost&nbsp;:&nbsp;</label>
        <input type="text" value="<?php echo $cost;?>" name="cost" class="smallfield"/>
      </div>
	  <div style="width:300px" class="input_field">
           <label for="sf">Retail Price&nbsp;:&nbsp; </label>
         <input type="text" value="<?php echo $retail_price;?>" name="retail_price" class="smallfield"/> 
      </div>      
    </div>
    <div style="width:100%">
	<div style="width:300px" class="input_field">
       <label for="sf">Repair Deposit&nbsp;:&nbsp; </label>
        <input type="text" value="<?php echo $repair_price;?>" name="repair_price" class="smallfield"/>
      </div>
      <div style="width:300px" class="input_field">
        <label for="sf">Lowest Price&nbsp;:&nbsp;</label>
         <input type="text" value="<?php echo $lowest_price;?>" name="lowest_price" class="smallfield"/>
      </div>
	</div>
    <div style="width:100%;">
	<div style="width:300px" class="input_field">
         <label for="sf">Wireless Carrier&nbsp;:&nbsp; </label>
         <select class="dropdown" name="carrier">
          <option value="all_carriers">All Carriers</option>
        </select>
    </div>
      <div style="width:300px" class="input_field">
        <label for="sf">Exception Price&nbsp;:&nbsp;</label>
         <input type="text" value="<?php echo $exception_price;?>" name="exception_price" class="smallfield">
      </div>
      
    </div>
     <div style="width:100%;">
	 <div style="width:300px" class="input_field">
        <label for="sf">Alt. Bar Code&nbsp;:&nbsp;</label>
         <input type="text" value="<?php echo $alt_barcode;?>" name="alt_barcode" class="smallfield">
      </div>
	 <div style="width:300px" class="input_field">
        <label for="sf">Description&nbsp;:&nbsp;</label>
        <input type="text" value="<?php echo $description;?>" name="description" class="smallfield">
      </div>
    </div>
	<div style="width:100%">
	<div style="width:300px" class="input_field">
        <label for="sf">Lowest Qty.&nbsp;:&nbsp; </label>
         <input type="text" value="<?php echo $lowest_qty;?>" name="lowest_qty" class="smallfield">
      </div>
      <div style="width:300px;" class="input_field">
        <label for="sf">States taxed&nbsp;:&nbsp;</label>
          <select class="dropdown" name="states_tax" style="width:127px;">
          <option value="">--- Select ---</option><option value="AK" <?php echo $states_tax=='AK'?'selected="selected"':'';?>>AK</option><option value="AL">AL</option><option value="AR">AR</option><option value="AZ">AZ</option><option value="CA">CA</option><option value="CO">CO</option><option value="CT">CT</option><option value="DC">DC</option><option value="DE">DE</option><option value="FL">FL</option><option value="GA">GA</option><option value="HI">HI</option><option value="IA">IA</option><option value="ID" <?php echo $states_tax=='ID'?'selected="selected"':'';?>>ID</option><option value="IL">IL</option><option value="IN">IN</option><option value="KS">KS</option><option value="KY">KY</option><option value="LA">LA</option><option value="MA">MA</option><option value="MD">MD</option><option value="ME">ME</option><option value="MI">MI</option><option value="MN">MN</option><option value="MO">MO</option><option value="MS">MS</option><option value="MT">MT</option><option value="NC">NC</option><option value="ND">ND</option><option value="NE">NE</option><option value="NH">NH</option><option value="NJ">NJ</option><option value="NM">NM</option><option value="NV">NV</option><option value="NY">NY</option><option value="OH">OH</option><option value="OK">OK</option><option value="OR">OR</option><option value="PA">PA</option><option value="PR">PR</option><option value="RI">RI</option><option value="SC">SC</option><option value="SD">SD</option><option value="TN">TN</option><option value="TX">TX</option><option value="UT">UT</option><option value="VA">VA</option><option value="VT">VT</option><option value="WA">WA</option><option value="WI">WI</option><option value="WV">WV</option><option value="WY">WY</option>
        </select>
      </div>
	</div>
	<div style="width:100%">
	 <div style="width:300px;" class="input_field">
        <label for="sf">Total Qty&nbsp;:&nbsp;</label>
        <input type="text" value="<?php echo $lowest_qty;?>" name="tot_qty" id="tot_qty" class="smallfield"/>
      </div>
	  <div style="width:300px;" class="input_field">
       <label for="sf">Exception Price&nbsp;:&nbsp;</label>
        <input type="text" value="<?php echo $exception_price;?>" name="exception_price" class="smallfield"/>
     </div>
	</div>
     
     <div style="width:100%" class="input_field">
        <label for="sf">Enter Barcode&nbsp;:&nbsp;</label>
        <span style="padding:7px 5px 0 0;float: left;width:92px;">&nbsp; Scan Barcode </span><input type="radio" name="barcode" class="radio" value="auto" id="auto" /></span>
     &nbsp; <span style="padding:8px 5px 0 0;float:right;width:609px;">Add Barcode </span> <input type="radio" name="barcode" class="radio" id="manual" value="manual" style="float:right;position:relative;left:99px;"/>
      </div>
    </div>
    <div style="width:100%;display: none;" id="manual_div">
        <fieldset style="width:90%"><legend>Uplaod CSV File For Barcode</legend>
            <div class="input_field">
                <label for="sf">Upload File&nbsp;:&nbsp;</label>
                <input type="file" name="sf" style="background: none;"/>
            </div>
    </fieldset>
    </div>
    <div style="width:100%;display: none;" id="auto_div"> 
        <fieldset style="width:90%"><legend>Scan Barcode</legend>
            <div class="input_field" style="text-align: center;">
                <input type="text" value="" id="scan_brcode_textbox" name="sf" class="mediumfield" style="height:50px;width: 250px;"/>
            </div>
            <div style="width:100%;display: block;" id="barcode_print"> </div>
    </fieldset>
    
       
    </div>
    <div class="clear"></div>
    <div class="input_field no_margin_bottom">
      <input class="submit" type="submit" value="Submit" />
      <input class="submit" type="reset" value="Reset" />
      <!--<a href="#" class="button">A button</a>-->
    </div>
  </fieldset>
  <!-- End of fieldset -->
</form>
<!-- /Form -->

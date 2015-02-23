<div class="page-header">
  <?php if(isset($client_edit_data)){?>
            <h2>Edit Client</h2>
         <?php }else{?>
               <h2>Add Client</h2>

          <?php }?>&nbsp;
  <a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a><br/>
</div>
<section class="g_1">
	
  <!-- New widget -->
  <div class="powerwidget" id="widget2">
    <header>
        <?php if(isset($client_edit_data)){?>
            <h2>Edit Client</h2>
         <?php }else{?>
               <h2>Add Client</h2>

          <?php }?>
    </header>
<?php if($process_done==1 && !isset($client_edit_data)){?>
<div class="dialog-big-inline success">
    <span>x</span>
    <div>
     Client Added Successfully.    
    </div>                                                
</div>
 <?php }if($process_done==1 && isset($client_edit_data)){?>
<div class="dialog-big-inline success">
    <span>x</span>
    <div>
     Client Edited Successfully.    
    </div>                                                
</div>
<?php }if($process_dup==1){?>
      <div class="dialog-big-inline error">
    <span>x</span>
    <div>
     Oops , Client already added.    
    </div>                                                
</div>
 <?php }?>
      
    <div>
     <div class="inner-spacer">   
      <form method="post" id="form-validation-lead" autocomplete="off" enctype='multipart/form-data' content-type="multipart/form-data">
         <div class="g_1_4">
            <label for="af-present">Client Name: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                 <input type="text" name="txt_clientname" id="txt_clientname" value="<?php echo $client_edit_data->vUsername;?>" data-validation-type="present">
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <div class="g_1_4">
            <label for="af-present">Function Name: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                 <input type="text" name="txt_functionname" id="txt_functionname" value="<?php echo $client_edit_data->function_name;?>" data-validation-type="present">
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
           <div class="g_1_4">
            <label for="af-present">Max Price: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                 <input type="text" name="txt_maxprice" id="txt_maxprice" value="<?php echo $client_edit_data->max_price;?>" data-validation-type="present">
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <div class="g_1_4">
            <label for="af-present">Min Price: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                 <input type="text" name="txt_minprice" id="txt_minprice" value="<?php echo $client_edit_data->min_price;?>" data-validation-type="present">
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          
          <div class="g_1_4">
            <label for="af-present">Client Type: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_4">
             <select id="select_client_type" name="select_client_type" >
              <option value="auto" <?php echo $client_edit_data->clienttype=='auto'?'selected="seleced"':'' ?>>Auto</option>
             <option value="newcar" <?php echo $client_edit_data->clienttype=='car'?'selected="seleced"':'' ?>>New Car</option>
              <option value="payday" <?php echo $client_edit_data->clienttype=='payday'?'selected="seleced"':'' ?>>Payday</option>
              <option value="newcar" <?php echo $client_edit_data->clienttype=='car'?'selected="seleced"':'' ?>>New Car</option>
              <option value="insurance" <?php echo $client_edit_data->clienttype=='insurance'?'selected="seleced"':'' ?>>Auto Insurance</option>
              <option value="credit_repair" <?php echo $client_edit_data->clienttype=='insurance'?'selected="seleced"':'' ?>>Credit Repair</option>
           
             </select>    </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          
          <div class="g_1_4">
            <label for="af-present">Status: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_4">
                 <select id="select_status" name="select_status" >
             	
              <option value="Active" <?php echo $client_edit_data->eStatus=='Active'?'selected="seleced"':'' ?>>Active</option>
              <option value="InActive" <?php echo $client_edit_data->eStatus=='InActive'?'selected="seleced"':'' ?>>Inactive</option>
            </select>    </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          
         <div class="submit-cancel-button">
            <input type="submit" class="button-text"  value="Submit" name="submit_btn" id="submit_btn" />
            <span>or</span> <a href="<?php echo Kohana::$base_url; ?>dashboard">Cancel</a> </div>
          <div class="spacer-15">
            <!-- spacer 15px -->
          </div>
      </form>
     </div>
    </div>
  </div>
  <!-- End .powerwidget -->
</section>

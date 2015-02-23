<div class="page-header">
  <h2>Add Model</h2>&nbsp;
  <a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a><br/>
</div>
<section class="g_1">
	
  <!-- New widget -->
  <div class="powerwidget" id="widget2">
    <header>
      <h2>Add Model</h2>
    </header>
<?php if($process_done==1 && $edit_done!=1){?>
<div class="dialog-big-inline success">
    <span>x</span>
    <div>
     Model Added Successfully.    
    </div>                                                
</div>
<?php }if($edit_done==1){?>
      <div class="dialog-big-inline success">
    <span>x</span>
    <div>
     Model Edited Successfully.    
    </div>                                                
</div>
<?php }if($process_dup==1){?>
      <div class="dialog-big-inline error">
    <span>x</span>
    <div>
     Oops , Model already added.    
    </div>                                                
</div>
 <?php } ?>
      
    <div>
     <div class="inner-spacer">   
      <form method="post" id="form-validation-lead" autocomplete="off" enctype='multipart/form-data' content-type="multipart/form-data">
        <div class="g_1_4">
            <label for="af-present">Make Name: *<?php echo $model_edit_data->make_id;?></label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                  <select id="make_name" name="make_name" data-validation-type="present">
                      <option value="">--- Select ---</option>
                      <?php
                      foreach($make_data as $key=>$value){
                      ?>
                      <option value="<?php echo $value->make_id?>" <?php echo ($value->make_id==$model_edit_data->make_id?'selected="selected"':''); ?>><?php echo $value->make_name?></option>
                      <?php }?>
                      
                  </select>
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <div class="g_1_4">
            <label for="af-present">Model Name: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                 <input type="text" name="txt_model" id="txt_model" value="<?php echo $model_edit_data->model_name;?>" data-validation-type="present">
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          
         <div class="submit-cancel-button">
            <input type="submit" class="button-text"  value="Submit" name="submit_btn" id="submit_btn" />
            <span>or</span> <a href="<?php echo Kohana::$base_url; ?>model/view">Cancel</a> </div>
          <div class="spacer-15">
            <!-- spacer 15px -->
          </div>
      </form>
     </div>
    </div>
  </div>
  <!-- End .powerwidget -->
</section>

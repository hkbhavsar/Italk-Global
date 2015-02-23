<div class="page-header">
  <h2>Add Trim</h2>&nbsp;
  <a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a><br/>
</div>
<section class="g_1">
	
  <!-- New widget -->
  <div class="powerwidget" id="widget2">
    <header>
      <h2>Add Trim</h2>
    </header>
<?php if($process_done==1 && $edit_done!=1){?>
<div class="dialog-big-inline success">
    <span>x</span>
    <div>
     Trim Added Successfully.    
    </div>                                                
</div>
<?php }if($edit_done==1){?>
      <div class="dialog-big-inline success">
    <span>x</span>
    <div>
     Trim Edited Successfully.    
    </div>                                                
</div>
<?php }if($process_dup==1){?>
      <div class="dialog-big-inline error">
    <span>x</span>
    <div>
     Oops , Trim already added.    
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
                      <option value="<?php echo $value->make_id?>" <?php echo ($value->make_id==$trim_edit_data->make_id?'selected="selected"':''); ?>><?php echo $value->make_name?></option>
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
                <select id="model_name" name="model_name" data-validation-type="present">
                      <option value="">--- Select ---</option>
                      <?php
                      foreach($model_data as $key=>$value){
                      ?>
                      <option value="<?php echo $value->model_id?>" <?php echo ($value->model_id==$trim_edit_data->model_id?'selected="selected"':''); ?>><?php echo $value->model_name?></option>
                      <?php }?>
                      
                  </select>  </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <div class="g_1_4">
            <label for="af-present">Trim Name: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                 <input type="text" name="txt_trim" id="txt_trim" value="<?php echo $trim_edit_data->trim_name;?>" data-validation-type="present">
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          
         <div class="submit-cancel-button">
            <input type="submit" class="button-text"  value="Submit" name="submit_btn" id="submit_btn" />
            <span>or</span> <a href="<?php echo Kohana::$base_url; ?>trim/view">Cancel</a> </div>
          <div class="spacer-15">
            <!-- spacer 15px -->
          </div>
      </form>
     </div>
    </div>
  </div>
  <!-- End .powerwidget -->
</section>

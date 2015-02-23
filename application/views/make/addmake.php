<div class="page-header">
  <h2>Add Make</h2>&nbsp;
  <a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a><br/>
</div>
<section class="g_1">
	
  <!-- New widget -->
  <div class="powerwidget" id="widget2">
    <header>
      <h2>Add Make</h2>
    </header>
<?php if($process_done==1 && $edit_done!=1){?>
<div class="dialog-big-inline success">
    <span>x</span>
    <div>
     Make Added Successfully.    
    </div>                                                
</div>
<?php }if($edit_done==1){?>
      <div class="dialog-big-inline success">
    <span>x</span>
    <div>
     Make Edited Successfully.    
    </div>                                                
</div>
<?php }if($process_dup==1){?>
      <div class="dialog-big-inline error">
    <span>x</span>
    <div>
     Oops , Make already added.    
    </div>                                                
</div>
 <?php }?>
      
    <div>
     <div class="inner-spacer">   
      <form method="post" id="form-validation-lead" autocomplete="off" enctype='multipart/form-data' content-type="multipart/form-data">
         <div class="g_1_4">
            <label for="af-present">Make Name: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                 <input type="text" name="txt_make" id="txt_make" value="<?php echo $make_edit_data->make_name;?>" data-validation-type="present">
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          
         <div class="submit-cancel-button">
            <input type="submit" class="button-text"  value="Submit" name="submit_btn" id="submit_btn" />
            <span>or</span> <a href="<?php echo Kohana::$base_url; ?>make/view">Cancel</a> </div>
          <div class="spacer-15">
            <!-- spacer 15px -->
          </div>
      </form>
     </div>
    </div>
  </div>
  <!-- End .powerwidget -->
</section>

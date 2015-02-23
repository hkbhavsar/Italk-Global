<div class="page-header">
  <?php if(isset($client_edit_data)){?>
            <h2>Edit User</h2>
         <?php }else{?>
               <h2>Add User</h2>

          <?php }?>&nbsp;
  <a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a><br/>
</div>
<section class="g_1">
	
  <!-- New widget -->
  <div class="powerwidget" id="widget2">
    <header>
        <?php if(isset($client_edit_data)){?>
            <h2>Edit User</h2>
         <?php }else{?>
               <h2>Add User</h2>

          <?php }?>
    </header>
<?php if($process_done==1 && !isset($user_edit_data)){?>
<div class="dialog-big-inline success">
    <span>x</span>
    <div>
     User Added Successfully.    
    </div>                                                
</div>
 <?php }if($process_done==1 && isset($user_edit_data)){?>
<div class="dialog-big-inline success">
    <span>x</span>
    <div>
     User Edited Successfully.    
    </div>                                                
</div>
<?php }if($user_dup==1){?>
      <div class="dialog-big-inline error">
    <span>x</span>
    <div>
     Oops , Username already existed.    
    </div>                                                
</div>
 <?php }?>
      
    <div>
     <div class="inner-spacer">   
      <form method="post" id="form-validation-lead" autocomplete="off" enctype='multipart/form-data' content-type="multipart/form-data">
         <div class="g_1_4">
          <label for="af-present">First Name: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                 <input type="text" name="txt_firstname" id="txt_firstname" value="<?php echo $user_edit_data->first_name;?>" data-validation-type="present">
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <div class="g_1_4">
          <label for="af-present">Last Name: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                 <input type="text" name="txt_lastname" id="txt_lastname" value="<?php echo $user_edit_data->last_name;?>" data-validation-type="present">
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <div class="g_1_4">
          <label for="af-present">User/ Agent Name: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                 <input type="text" name="txt_username" id="txt_username" value="<?php echo $user_edit_data->username;?>" data-validation-type="present">
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <div class="g_1_4">
            <label for="af-present">Password: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                 <input type="password" name="txt_password" id="txt_password" value="<?php echo $client_edit_data->function_name;?>" data-validation-type="present">
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
		  
		  <div class="g_1_4">
            <label for="af-present">User/ Agent Photo: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                <input type="file" name="file_browse" id="file_browse" data-validation-type="present"/>
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
        
           <div class="g_1_4">
            <label for="af-present">Type: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                  <select id="type_user" name="type_user">
                      <option value="1" <?php echo $user_edit_data->role_id=='1'?'selected="selected"':'';?>>Admin</option>
                      <option value="2" <?php echo $user_edit_data->role_id=='2'?'selected="selected"':'';?>>Agent</option>
                      <option value="3" <?php echo $user_edit_data->role_id=='2'?'selected="selected"':'';?>>QC</option>
               
                  </select>
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <div class="submit-cancel-button">
            <input type="submit" class="button-text"  value="Submit" name="submit_btn" id="submit_btn" />
            <span>or</span> <a href="<?php echo Kohana::$base_url; ?>user/view">Cancel</a> </div>
          <div class="spacer-15">
            <!-- spacer 15px -->
          </div>
      </form>
     </div>
    </div>
  </div>
  <!-- End .powerwidget -->
</section>

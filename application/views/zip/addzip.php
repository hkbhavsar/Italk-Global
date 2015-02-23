<div class="page-header">
  <h2>Add Zip</h2>&nbsp;
  <a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a><br/>
</div>
<section class="g_1">
	
  <!-- New widget -->
  <div class="powerwidget" id="widget2">
    <header>
      <h2>Add Zip, City , State</h2>
    </header>
<?php if($process_done==1){?>
<div class="dialog-big-inline success">
    <span>x</span>
    <div>
     Zip Added Successfully.    
    </div>                                                
</div>
<?php }if($process_dup==1){?>
      <div class="dialog-big-inline error">
    <span>x</span>
    <div>
     Oops , zip already added.    
    </div>                                                
</div>
 <?php }?>
      
    <div>
     <div class="inner-spacer">   
      <form method="post" id="form-validation-lead" autocomplete="off" enctype='multipart/form-data' content-type="multipart/form-data">
         <div class="g_1_4">
            <label for="af-present">Zip Code: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
                 <input type="text" name="txt_zip" id="txt_zip" value="" data-validation-type="present">
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          
           <div class="g_1_4">
            <label for="af-present">State: </label>
          </div>
          <div class="g_3_4_last">
            <div class="g_1_2">	
              <select name="state" data-validation-type="present">
                <option value="">-- select option --</option>
                <?php foreach( $state_array as $key=>$v)
                    {
                            echo '<option value="'.$key.'" '.$selected.'>'.$v .'</option>';					

                }?>			
                 
                </select>            
             </div>
          </div>
           <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
           <div class="g_1_4">
            <label for="af-present">City: </label>
          </div>
           <div class="g_3_4_last">
            <div class="g_1_2">
              
		<input type="text" name="txt_city" id="txt_city" value="" data-validation-type="present">
               
             </div>
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
<script>
function submitfrmdelete(id)
{
    var istrue = confirm('Do you want to delete this?');
    if(istrue == true){
       $("#sbt_frm").val('1');
       $("#action_frm").val('delete_'+id);
       $("#search_form").submit();   
    }
   else
       return false;
}

function submitfrmdelete_all(id)
{
   //alert($("input:checkbox:checked"));
   var istrue = confirm('Are you sure you want to delete?');
    if(istrue == true)
    {

       $checkedCheckboxes = $("input:checkbox[name=ch[]]:checked");
       var selectedValues="";
        $checkedCheckboxes.each(function () {
             if($(this).val()!='on')
                selectedValues +=  $(this).val() +",";
        });
         $("#delete_all_msg").val('deleted');
         $("#delete_all").val(selectedValues);
    }
   else
        return false;
   /*$("#sbt_frm").val('1');
   $("#action_frm").val('delete_'+id);
   $('form').attr('action', 'baz')
   $("#tbl_leads_submit").submit();  */   
}

</script>
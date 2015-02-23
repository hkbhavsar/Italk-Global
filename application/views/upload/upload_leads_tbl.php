<?php 
if($process_done==1){?>
<div class="dialog-big-inline warning">
    <span>x</span>
    <div>
        Total Leads : <?php echo $total_leads;?> <br>
        
        Duplicate Leads : <?php echo $duplicate;?><br> 
            
       <? //***********************Write File for the Ping *************/
                
                    $myFile_ping_response = "ping_post_request/ping_leadbid".$lead_data->lead_auto_id.".txt";
                    $fh = fopen($myFile_ping_response, 'w') or die("can't open file");
                    $file_string = "Ping URL::>".$url_1."\n\n";
                    $file_string.= "Ping Data::>".$ping_data."\n\n";
                    $file_string.= "Ping Response::>".$res_1."\n\n";
                    fwrite($fh, $file_string);
                    fclose($fh);
                
                //************************End Write File for ping ************/
          ?>
            <?php //echo $dup_phone;?><br>
        
        Uploaded Leads : <?php echo $lead_uploaded;?>
        
        <?php //echo $total_leads;?>
     </div>                                                
</div>
<br/>
<div class="doc-intro">
        <strong>Duplicate Phone :</strong><?php echo $dup_phone;?><br>
     <span onclick="$('.doc-intro').slideUp(400);" style="cursor: pointer;position: absolute;right: 23px;">x</span>
</div>
<?php }?>
<div class="page-header">
  <h2>Upload Leads By Admin</h2>&nbsp;
  <a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a><br/>
</div>
<section class="g_1">
	
  <!-- New widget -->
  <div class="powerwidget" id="widget2">
    <header>
      <h2>Upload Leads By Admin</h2>
    </header>
    <div>
     <div class="inner-spacer">   
      <form method="post" id="form-validation-lead" autocomplete="off" enctype='multipart/form-data' content-type="multipart/form-data">
         <div class="g_1_4">
            <label for="af-present">Campaign Type: *</label>
          </div>
          <div class="g_3_4_last">
              <div class="g_1_2">
            <select name="search_campaign" id="search-searchin" data-validation-type="present">
              <option value="auto_sale" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='auto_sale'?'selected=selected':''; ?>>Auto</option>
              <option value="newcar" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='newcar'?'selected=selected':''; ?>>New Car</option>
              <option value="new_payday" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='new_payday'?'selected=selected':''; ?>>New Payday</option>
              <option value="payday" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='payday'?'selected=selected':''; ?>>Payday</option>
             
              <!--<option value="creditline" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='creditline'?'selected=selected':''; ?>>Creditline</option>
              <option value="home_security" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='home_security'?'selected=selected':''; ?>>Home Security</option>
              <option value="insurance" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='insurance'?'selected=selected':''; ?>>Insurance</option>
              <option value="credit_repair" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='credit_repair'?'selected=selected':''; ?>>Credit Repair</option>
              -->
              </select>
              </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          
           <div class="g_1_4">
            <label for="af-present">Call Center: </label>
          </div>
          <div class="g_3_4_last">
            <div class="g_1_2">
              <select name="search_callcenter" data-validation-type="present">
                <option value="">-- select option --</option>
                  <?php for($i=0;$i<count($callcenterData);$i++){?>
                    <option value="<?php echo $callcenterData[$i]->id;?>" <?php echo isset($_POST['search_callcenter']) && $_POST['search_callcenter']==$callcenterData[$i]->id?'selected=selected':''; ?> ><?php echo ucfirst($callcenterData[$i]->name);?></option>
                 <?php }?>
                </select>            
             </div>
          </div>
           <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
           <div class="g_1_4">
            <label for="af-present">Browse the File: </label>
          </div>
           <div class="g_3_4_last">
            <div class="g_1_2">
               <input type="file" name="file_browse" id="file_browse" data-validation-type="present"/>       
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
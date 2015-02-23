<div class="page-header">
  <h2>View Client</h2>&nbsp;&nbsp;&nbsp;
   <a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a>
</div>
<section class="g_1">
  <!-- New widget -->
  <div class="powerwidget" id="widget2">
    <header>
      <h2>Client List</h2>
    </header>
    <?php if($process_done==1){?>
<div class="dialog error">
    <p><img alt="" src="<?php echo Kohana::$base_url; ?>images/icons/dialogs/warning-16.png">Client Deleted Successfully</p>
    <span>x</span>
</div>
<?php }?>
    <div>
      <form class="e-checkbox-section"  id="tbl_callcenter_submit" name="tbl_callcenter_submit" method="post">
      <input type="hidden" name="selectedclient" id="selectedclient" />
      <input type="hidden" name="action_frm" id="action_frm" />
      <input type="hidden" name="multi_process_data" id="multi_process_data" />
        <table class="basic-table" id="tableexample1">
          <thead>
            <tr>
              <th scope="col" class="tb-checkbox"><input type="checkbox" name="" class="e-checkbox-trigger"/></th>
              <th width="5%"><?php echo "Delete";?></th>
              <th width="5%"><?php echo "Edit";?></th>
              <th scope="col">&nbsp;Client Name</th>
              <th scope="col">&nbsp;Client Type</th>
              <th scope="col">&nbsp;Function Name</th>
              <th scope="col">&nbsp;Status</th>
              
            </tr>
          </thead>
          <tbody>
            <!-- new row -->
            <?php if(count($client_data)>0){  foreach($client_data as $key=>$value){$i=1; $l = 2;?>
             <tr>
              <td width="1%"><input type="checkbox" name="ch[]" value="<?php echo $value->iClient_id;?>" <?php echo $checked;?>/></td>
              <td width="5%">&nbsp;&nbsp;&nbsp;<img src="<?php echo Kohana::$base_url; ?>images/delete.png" alt="delete" onclick="submitfrmdelete(<?php echo $value->iClient_id;?>);"></td>
              <td width="5%">&nbsp;&nbsp;&nbsp;<a href="<?php echo Kohana::$base_url; ?>client/add/<?php echo $value->iClient_id;?>"><img src="<?php echo Kohana::$base_url; ?>images/edit.gif" alt="Edit"></a></td>
              <td><a href="<?php echo Kohana::$base_url; ?>submitlead/viewedit/<?php echo $value->iClient_id;?>" rel="1020-600" title="Lead <?php echo $value->iClient_id;?>" class="bumpbox"><?php echo $value->vUsername;?></a></td>
               <td><?php echo $value->clienttype;?></td>
              <td><?php echo $value->function_name;?></td>
              <td><?php echo $value->eStatus;?></td>
              
            </tr>
            <?php $i++;}}else{?>
             <tr>
              <td colspan="9" style="text-align:center;">No any records found</td>
            </tr>
            <?php }?>
          </tbody>
        </table>
      </form>
    </div>
  </div>
  <!-- End .powerwidget -->
</section>
<script>
function submitfrmdelete(id)
{
    var istrue = confirm('Do you want to delete this?');
    if(istrue == true){
       //$("#sbt_frm").val('1');
       $("#action_frm").val('delete_'+id);
       $("#tbl_callcenter_submit").submit();   
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
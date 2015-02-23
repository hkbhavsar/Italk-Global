<div class="page-header">
  <h2>View Call Center</h2>&nbsp;&nbsp;&nbsp;
   <a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a>
</div>
<section class="g_1">
  <!-- New widget -->
  <div class="powerwidget" id="widget2">
    <header>
      <h2>Call Center List</h2>
    </header>
    <?php if($process_done==1){?>
<div class="dialog error">
    <p><img alt="" src="<?php echo Kohana::$base_url; ?>images/icons/dialogs/warning-16.png">Call Center Deleted Successfully</p>
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
                 <th width="5%"><?php echo "Delete";?></th>
              <th width="5%"><?php echo "Edit";?></th>
              <th scope="col">&nbsp;Call Center Name</th>
              
            </tr>
          </thead>
          <tbody>
            <!-- new row -->
            <?php if(count($call_center_data)>0){  foreach($call_center_data as $key=>$value){$i=1; $l = 2;?>
             <tr>
               <td width="5%">&nbsp;&nbsp;&nbsp;<img src="<?php echo Kohana::$base_url; ?>images/delete.png" alt="delete" onclick="submitfrmdelete(<?php echo $value->id;?>);"></td>
              <td width="5%">&nbsp;&nbsp;&nbsp;<a href="<?php echo Kohana::$base_url; ?>callcenter/add/<?php echo $value->id;?>"><img src="<?php echo Kohana::$base_url; ?>images/edit.gif" alt="edit"></a></td>
              <td><a href="<?php echo Kohana::$base_url; ?>submitlead/viewedit/<?php echo $value->id;?>" rel="1020-600" title="Lead <?php echo $value->id;?>" class="bumpbox"><?php echo $value->name;?></a></td>
              
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
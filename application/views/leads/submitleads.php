<script type="text/javascript">
    <!--
    var TSort_Data = new Array ('tableexample1');
    var TSort_NColumns = 1;
    //var TSort_Icons = new Array (' (Ascending)', ' (Descending)');
    tsRegister();
    // -->
</script> 
<?php $user_role = Auth::instance()->get_user()->role_id;
          $in_report_menu = basename($_SERVER['REQUEST_URI']);
 ?>
 
<div id="powerwidgetspanel" class="powerwidgetspanel">
  <div class="powerwidgetspanel-widget" data-widget-id="widget1">
    <input type="checkbox"/>
    <label>Search</label>
  </div>
   <div class="powerwidgetspanel-widget" data-widget-id="widget3">
    <input type="checkbox"/>
     <h2>Multiple Assignment</h2>
  </div>
  <div class="powerwidgetspanel-widget" data-widget-id="widget2">
    <input type="checkbox"/>
     <h2>Leads List</h2>
  </div>
</div>
<div class="page-header">
  <h2><?php if($user_role==3 || $in_report_menu=='report'){ echo "List Leads";} else{ echo "Assign Lead";}?>

 </h2>
  <p>&nbsp;</p>
  <!--<a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a>-->
</div>
<section class="g_1">
    
    
        <?php if($user_role==3 || $in_report_menu=='report'){include("search_qc.php");}else{include("search.php");include("multiple.php");}?>
        <?php //include("multiple.php"); ?>
    
  <!-- New widget -->
  <div class="powerwidget" id="widget2">
    <header>
        <h2>Leads List (<?php echo count($leadsData);?>)</h2>
    </header>
    <div>
      <form class="e-checkbox-section" action="<?php echo Kohana::$base_url; ?>submitlead/processlead" id="tbl_leads_submit" name="tbl_leads_submit" method="post" target="_blank">
      <input type="hidden" name="selectedclient" id="selectedclient" />
      <input type="hidden" name="selectedclient_text" id="selectedclient_text" />
      <input type="hidden" name="multi_process_data" id="multi_process_data" />
	  <input type="hidden" name="sleep_time_data" id="sleep_time_data" />
      <input type="hidden" name="lead_type" id="lead_type" value="<?php echo $lead_type;?>" />
     <?php if($user_role!=3 && $in_report_menu!='report'){?> <input type="button" style="float:right;" class="button-text"  value="Delete Selected" name="deleted_select" id="deleted_select" onclick="submitfrmdelete_all();" /> <?php } echo '<strong>&nbsp;&nbsp;Total Leads Search : </strong>'.count($leadsData);?>
       
        <table class="basic-table" id="tableexample1">
          <thead>
            <tr>
              <?php if($user_role!=3 ){?><th scope="col" class="tb-checkbox"><input type="checkbox" name="" class="e-checkbox-trigger"/></th>
              <th><?php echo "Delete";?></th><?php }?>
              <th><?php echo "Edit";?></th>
              <th><a onclick="tsDraw(0,'tableexample1'); return false" href="">LeadID</a><span id="TS_0_tableexample1"></span></th>
              <th scope="col"><a onclick="tsDraw(1,'tableexample1'); return false" href="">Agent Name</a><span id="TS_1_tableexample1"></span></th>
               <th scope="col"><a onclick="tsDraw(2,'tableexample1'); return false" href="">Name</a><span id="TS_2_tableexample1"></span></th>
               <th scope="col"><a onclick="tsDraw(3,'tableexample1'); return false" href="">Lead Type</a><span id="TS_3_tableexample1"></span></th>
              <th scope="col"><a onclick="tsDraw(4,'tableexample1'); return false" href="">State</a><span id="TS_4_tableexample1"></span></th>
              <th scope="col"><a onclick="tsDraw(8,'tableexample1'); return false" href="">M.Income</a><span id="TS_8_tableexample1"></span></th>
              <th scope="col"><a onclick="tsDraw(9,'tableexample1'); return false" href="">Phone</a><span id="TS_9_tableexample1"></span></th>
              <th scope="col"><a onclick="tsDraw(15,'tableexample1'); return false" href="">Email</a><span id="TS_15_tableexample1"></span></th>
              <th scope="col">Comment</th>
              <th scope="col"><a onclick="tsDraw(10,'tableexample1'); return false" href="">Status</a></th>
            </tr>
          </thead>
          <tbody>
            <!-- new row -->
            <?php if(count($leadsData)>0){ $i=1; $l = 2;?>
            <?php foreach($leadsData as $key=>$value){ 
				$select_record = $_POST['search_selectrecord'];
              if($_POST['search_lead_start']!='' && $_POST['search_lead_end']!='')
              {
                  if(($_POST['search_lead_start']<=$value->$id) && ($value->$id<=$_POST['search_lead_end']))
                  {
         
                      $checked = "checked='checked'";
                  }
                  else
                  {
                     $checked = ""; 
                  }
                  
              }
              else{
				if($select_record=='first')
				{
					$minus = $_POST['search_checked_value'];
					$checked = $i<=$minus?"checked='checked'":'';
				}
				if($select_record=='last')
				{
					$minus = 50-$_POST['search_checked_value'];
				    $checked = $i>$minus?"checked='checked'":'';
				}
				if($_POST['search_checked']=='yes')
				{
					$checked = "checked='checked'";
				}
                                
                     }         
            ?>
            <tr>
             <?php if($user_role!=3){?> <td width="1%"><input type="checkbox" name="ch[]" value="<?php echo $value->$id;?>" <?php echo $checked;?>/></td>
              <td>&nbsp;&nbsp;&nbsp;<img  src="<?php echo Kohana::$base_url; ?>images/delete.png" alt="delete" onclick="submitfrmdelete(<?php echo $value->$id;?>,'<?php echo $lead_type;?>');"></td><?php }?>
              <td><a href="<?php echo Kohana::$base_url; ?>submitlead/viewedit/<?php echo $value->$id;?>&<?php echo $lead_type;?>" rel="1020-600" title="Lead <?php echo $value->$id;?>" class="bumpbox"><img  src="<?php echo Kohana::$base_url; ?>images/edit.gif" alt="edit"></a></td>
              <td><a href="<?php echo Kohana::$base_url; ?>submitlead/viewedit/<?php echo $value->$id;?>&<?php echo $lead_type;?>" rel="1020-600" title="Lead <?php echo $value->$id;?>" class="bumpbox"><?php echo $value->$id;?></a></td>
              <th scope="col"><?php echo $value->first_name;?></th>
              <td><?php echo $value->fname." ".$value->lname;?></td>
              <td><?php echo $lead_type;?></td>
              <td><?php echo $value->state;?></td>
              <td><?php echo ($lead_type=='NewPayday' || $lead_type=='payday' || $lead_type=='New Car'?'N/A':$value->monthly_income);?></td>
              <td><?php echo $value->phone;?></td>
              <td><?php echo Helper_Utils::split_on($value->email,10);?></td>
              <td><?php echo Helper_Utils::split_on($value->comment,10);?></td>
              <td><?php    
                $objLeads = ORM::factory('leads');
                echo $objLeads->getLeadStatus($value->$id,$lead_type);?>
              </td>
            </tr>
            <?php $i++;}}else{?>
             <tr>
              <td colspan="13" style="text-align:center;">No any records found</td>
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
function submitfrmdelete(id,lead_type)
{
    var istrue = confirm('Do you want to delete this?');
    if(istrue == true){
       $("#sbt_frm").val('1');
       $("#action_frm").val('delete_'+id+'_'+lead_type);
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
		 $("#search_form").submit(); 
    }
   else
        return false;
   /*$("#sbt_frm").val('1');
   $("#action_frm").val('delete_'+id);
   $('form').attr('action', 'baz')
   $("#tbl_leads_submit").submit();  */   
}

</script>
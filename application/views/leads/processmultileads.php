<div class="page-header">
  <h2>Submit Leads Start with <?php echo $_POST['multi_process_data'];?> 
  <img alt="" src="<?php echo Kohana::$base_url; ?>images/loaders/type3/dark/32.gif" id="process_lead_main"></h2>
  <a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a><br>
</div>

<?php 
        if($_POST['ch'])
	$selected_leads = implode(',',$_POST['ch']);
        $selected_client = $_POST['multi_process_data'];
        $lead_type = $_POST['lead_type'];
		 $sleeptime = $_POST['sleep_time_data'];
       
?>
<script>
var i=0;
/*function ajaxCall() {
	var selected_id = '<?php echo $selected_leads?>';
        var selected_client = '<?php echo $selected_client?>';
         var lead_type = '<?php echo $lead_type;?>';
		  var sleeptime = '<?php echo $sleeptime;?>';
	var array = selected_id.split(',');
        var base_url =$("#base_url").val(); 
    $.ajax({
        type: "POST",
        url: base_url+'processlead/multiple', 
        data: ({pid:array[i],selectedclient:selected_client,lead_type:lead_type,sleeptime:sleeptime}),
        success: function(data) { 
			$("#tableexample1").append(data);
			    setTimeout(function() {
					i = i+1;
					//alert(i+'<'+array.length);
					if(i<array.length)
						ajaxCall(i);
                                        else
                                           {
                                                $("#process_load").hide();
                                                $("#process_lead_main").hide();
                                                
                                           }
                                        
                }, 1000);
        },
        error: function() {
            setTimeout(ajaxCall, 1000);
        }
    }); 
}*/
function ajaxCall() {
	var selected_id = '<?php echo $selected_leads?>';
        var selected_client = '<?php echo $selected_client?>';
        var lead_type = '<?php echo $lead_type;?>';
        var sleeptime = '<?php echo $sleeptime;?>';
	var array = selected_id.split(',');
        
        var base_url =$("#base_url").val(); 
    $.ajax({
        type: "POST",
        url: base_url+'processlead/multiple', 
        data: ({pid:selected_id,selectedclient:selected_client,lead_type:lead_type,sleeptime:sleeptime}),
        success: function(data) { 
                         $("#process_load").hide();
                         $("#process_lead_main").hide();
						$("#tableexample1").append(data);		    
        },
        error: function() {
            setTimeout(ajaxCall, 1000);
        }
    }); 
}
$(ajaxCall);
</script>

<section class="g_1">

	<!-- New widget --> 
	
<!-- New widget -->
  <div class="powerwidget" id="widget2">
    <header>
      <h2>Leads List</h2>
    </header>
    <div>
     <?php if($_POST['ch']){?>
      <form class="e-checkbox-section" action="<?php echo Kohana::$base_url; ?>submitlead/processlead" id="tbl_leads_submit" name="tbl_leads_submit" method="post" target="_blank">
      <input type="hidden" name="selectedclient" id="selectedclient" />
	  <input type="hidden" name="selectedclient_text" id="selectedclient_text" />
        <table class="basic-table" id="tableexample1">
          <thead>
            <tr>
              <th scope="col" class="tb-checkbox">Lead ID.</th>
			  <th scope="col">Lead Name</th>
               <th scope="col">Lead Type</th>
               <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">SSN</th>
              <th scope="col">Ping Request / Response</th>
              <th scope="col">Post Request / Response</th>
              <th scope="col">Price</th>
            </tr>
          </thead>
          <tbody>
            <div id="rowappend">
            <tr></tr>
            <div id="process_load"><img src="<?php echo Kohana::$base_url; ?>images/loaders/type2/dark/32.gif"></div>
           </div>
            
          </tbody>
        </table>
      </form>
       <?php } else { ?>
        <table class="basic-table" >
          <thead>
            <tr>
                <td style="text-align: center;">
                     No Lead Selected..!!
                </td>
            </tr>
        </table>
       
        <?php }?>
    </div>
  </div>
  <!-- End .powerwidget -->
</section>

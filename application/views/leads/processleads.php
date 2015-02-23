<div id="powerwidgetspanel" class="powerwidgetspanel">
  <div class="powerwidgetspanel-widget" data-widget-id="widget1">
    <input type="checkbox"/>
    <label>Search</label>
  </div>
  <div class="powerwidgetspanel-widget" data-widget-id="widget2">
    <input type="checkbox"/>
     <h2>Leads List</h2>
  </div>
  <div class="powerwidgetspanel-widget" data-widget-id="widget8">
    <input type="checkbox"/>
     <h2>Ajax with auto refresh</h2>
  </div>
</div>
<div class="page-header">
  <h2>Submit Leads Start with <?php echo $_POST['selectedclient_text'];?> 
  <img alt="" src="<?php echo Kohana::$base_url; ?>images/loaders/type3/dark/32.gif" id="process_lead_main"></h2>
  <p>Easy to Submit Leads from here.</p>
  <a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a>
</div>

<?php 
	$selected_leads = implode(',',$_POST['ch']);
        $lead_type = $_POST['lead_type'];
        $selected_client = $_POST['selectedclient'];
?>
<script>
var i=0;
function ajaxCall() {
	var selected_id = '<?php echo $selected_leads;?>';
        var lead_type = '<?php echo $lead_type;?>';
        var selected_client = '<?php echo $selected_client;?>';
	var array = selected_id.split(',');
        var bas_url = $('#base_url').val();
    $.ajax({
        type: "POST",
        url: bas_url+'processlead/', 
        data: ({pid:array[i],lead_type:lead_type,selected_client:selected_client}),
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
}
$(ajaxCall);

/*$.ajax({
                 type: 'POST',
                 url: base_url+'index.php/inventory/scan_barcode_operation',
                 data: {barcode_num: barcode_num},
                 success: function(data) {			
                     $("#barcode_print").append(data);
                     $("#barcode_print").append("<br>");
                     $("#barcode_print").append("<input type='hidden' value='"+data+"' name='barcode_number[]'>");
                     $("#scan_brcode_textbox").val("");
                     scan_cnt++;
                 }
        });*/

</script>

<section class="g_1">

	<!-- New widget --> 
	
<!-- New widget -->
  <div class="powerwidget" id="widget2">
    <header>
      <h2>Leads List</h2>
    </header>
    <div>
      <form class="e-checkbox-section" action="<?php echo Kohana::$base_url; ?>submitlead/processlead" id="tbl_leads_submit" name="tbl_leads_submit" method="post" target="_blank">
      <input type="hidden" name="selectedclient" id="selectedclient" />
	  <input type="hidden" name="selectedclient_text" id="selectedclient_text" />
        <table class="basic-table" id="tableexample1">
          <thead>
            <tr>
              <th scope="col" class="tb-checkbox">Lead ID.</th>
               <th scope="col">Lead Type</th>
               <th scope="col">Email</th>
              <th scope="col">Phone</th>
              <th scope="col">SSN</th>
              <th scope="col">Ping Request/Response</th>
              <th scope="col">Post Request</th>
              <th scope="col">Post Response</th>
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
    </div>
  </div>
  <!-- End .powerwidget -->
</section>

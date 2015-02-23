<?php if($_POST['action_frm']!=''){?>
<div class="dialog error">
    <p><img alt="" src="<?php echo Kohana::$base_url; ?>images/icons/dialogs/warning-16.png">Lead Deleted Successfully</p>
    <span>x</span>
</div>
<?php }?>

<?php if($_POST['delete_all_msg']!=''){?>
<div class="dialog error">
    <p><img alt="" src="<?php echo Kohana::$base_url; ?>images/icons/dialogs/warning-16.png">Lead Deleted Successfully</p>
    <span>x</span>
</div>
<?php }?>


<div class="powerwidget" id="widget1">
    <header>
      <h2>Search</h2>
    </header>
    <div>
      <div class="inner-spacer">
        <form method="post" action="" id="search_form" autocomplete="off">
        	<div class="g_1_4">
            <label for="af-present">Campaign Type: *</label>
          </div>
          <div class="g_3_4_last">
            <select name="search_campaign" id="search-searchin">
              <option value="auto_sale" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='auto_sale'?'selected=selected':''; ?>>Auto</option>
              <option value="newcar" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='newcar'?'selected=selected':''; ?>>New Car</option>
              <option value="new_payday" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='new_payday'?'selected=selected':''; ?>>New Payday</option>
              <option value="payday" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='payday'?'selected=selected':''; ?>>Payday</option>
              <!--<option value="insurance" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='insurance'?'selected=selected':''; ?>>Auto Insurance</option>
              <option value="credit_repair" <?php echo isset($_POST['search_campaign']) && $_POST['search_campaign']=='credit_repair'?'selected=selected':''; ?>>Credit Repair</option>-->
            </select>
          </div>
           <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          
          <div class="g_1_4">
            <label for="af-present">Start Date: </label>
          </div>
          <div class="g_3_4_last">
            <div class="g_1_3">
            <input type="text" name="search_startdate" value="<?php echo $_POST['search_startdate'];?>"  id="datepicker-default_end" class="datepicker" />
            </div>
            <div class="g_1_4" style="width:13.5%">
            &nbsp;&nbsp;&nbsp;<label for="af-present">End Date: </label>
          </div>
            <div class="g_1_4">
           <input type="text" name="search_enddate" value="<?php echo $_POST['search_enddate'];?>"  id="datepicker-default" class="datepicker" />
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
          
           <!--<div class="g_1_4">
            <label for="af-present">Assigned Client: </label>
          </div>
          <div class="g_3_4_last">
            <div class="g_1_2">
              <select name="search_agent" data-validation-type="present">
                <option value="">-- select option --</option>
                  <?php for($i=0;$i<count($agentData);$i++){?>
                    <option value="a"><?php echo ucfirst($agentData[$i]->first_name);?></option>
                 <?php }?>
            </select>   
            </div>
          </div>
           <div class="spacer-20">

          </div>-->
          <div class="g_1_4">
            <label for="af-present">Search in: *</label>
          </div>
          <div class="g_3_4_last">
            <select name="search_searchin" id="search-searchin">
              <option value="">--- Select ---</option>
              <option value="fname" <?php echo isset($_POST['search_searchin']) && $_POST['search_searchin']=='fname'?'selected=selected':''; ?>>Name</option>
              <option value="phone" <?php echo isset($_POST['search_searchin']) && $_POST['search_searchin']=='phone'?'selected=selected':''; ?>>Phone</option>
              <option value="ssn" <?php echo isset($_POST['search_searchin']) && $_POST['search_searchin']=='ssn'?'selected=selected':''; ?>>SSN</option>
              <option value="email" <?php echo isset($_POST['search_searchin']) && $_POST['search_searchin']=='email'?'selected=selected':''; ?>>Email</option>
            </select>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <div class="g_1_4">
            <label for="s-field-1">Keyword(s):</label>
          </div>
          <div class="g_3_4_last">
            <input type="text" name="search_keyword" id="s-field-1" value="<?php echo $_POST['search_keyword'];?>"/>
          </div>
            <div class="spacer-20">
            <!-- spacer 5px -->
          </div>
          <!--<div class="g_1_4">
            <label for="s-field-1">Sleep Time:</label>
          </div>
          <div class="g_1_7">
            <input type="text" name="sleep_time" id="s-field-1" value="<?php echo $_POST['sleep_time'];?>"/>
          </div>-->
          
         
          <!--<div class="g_3_4_last">
            <div class="g_1">
              <input type="radio" checked="checked" name="search-radio" value="yes" id="s-field-2"/>
              <label class="font-normal" for="s-field-2">To search in: Name</label>
            </div>
            <div class="g_1">
              <input type="radio" name="search-radio" value="no" id="s-field-3"/>
              <label class="font-normal" for="s-field-3">To search in: Phone</label>
            </div>
             <div class="g_1">
              <input type="radio" name="search-radio" value="no" id="s-field-4"/>
              <label class="font-normal" for="s-field-3">To search in: Email</label>
            </div>
             <div class="g_1">
              <input type="radio" name="search-radio" value="no" id="s-field-5"/>
              <label class="font-normal" for="s-field-3">To search in: SSN</label>
            </div>
            <!--<div class="g_1">
              <input type="radio" name="search-radio" value="no" id="s-field-4"/>
              <label class="font-normal" for="s-field-4">In order to search type more than 3 characters.</label>
            </div>
          </div>-->
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <hr/>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          
          <div class="g_1_4">
           <label for="af-present">Show no of lead:</label>
          </div>
          <div class="g_3_4_last">
            <div class="g_1_4">
                <input type="text" value="<?php echo $_POST['search_show'];?>" name="search_show">
          
           
           </div>
           <!--<div class="g_1_4" style="width:13.5%">
            &nbsp;&nbsp;&nbsp;<label for="af-present">checked: </label>
          </div>
            <div class="g_1_4">
                <select name="search_checked" id="search_checked">
                  <option value="no" <?php echo isset($_POST['search_checked']) && $_POST['search_checked']=='no'?'selected=selected':''; ?>>No</option>
                  <option value="yes" <?php echo isset($_POST['search_checked']) && $_POST['search_checked']=='yes'?'selected=selected':''; ?>>Yes</option>
                  </select>
            </div>-->
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <div class="g_1_4">
            <label for="af-present">Select Records: </label>
          </div>
         <div class="g_3_4_last">
          <div class="g_1_4">
            <select name="search_selectrecord" id="search_selectrecord">
              <option value="">-- Select --</option>	
              <option value="first" <?php echo isset($_POST['search_selectrecord']) && $_POST['search_selectrecord']=='first'?'selected=selected':''; ?>>First</option>
              <option value="last" <?php echo isset($_POST['search_selectrecord']) && $_POST['search_selectrecord']=='last'?'selected=selected':''; ?>>Last</option>
            </select>
          </div>
          <div class="g_1_4" style="width:13.5%">
            &nbsp;&nbsp;&nbsp;<label for="af-present">checked: </label>
          </div>
            <div class="g_1_4">
				<input type="text" value="<?php echo $_POST['search_checked_value'];?>" name="search_checked_value">
            </div>
        </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>

          <div class="g_1_4">
            <label for="af-present">Enter Lead Range: </label>
          </div>
         <div class="g_3_4_last">
           <section class="g_1_7">
               <div><input type="text" value="<?php echo $_POST['search_lead_start'];?>" name="search_lead_start">
       </div>
           </section>
           <section class="g_1_7">
               <div><input type="text" value="<?php echo $_POST['search_lead_end'];?>" name="search_lead_end">
       </div>
           </section>
         </div>
          
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
		
          <div class="g_1_4">
            <label for="af-present">Lead Status: </label>
          </div>
         <div class="g_1_4">
            <select name="search_lead_status" id="search_lead_status">
              <option value="">-- Select --</option>	
              <option value="Success" <?php echo isset($_POST['search_lead_status']) && $_POST['search_lead_status']=='Success'?'selected=selected':''; ?>>Success</option>
              <option value="Fail" <?php echo isset($_POST['search_lead_status']) && $_POST['search_lead_status']=='Fail'?'selected=selected':''; ?>>Reject</option>
            </select>
          </div> 
		  <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
         <!-- <hr/>
          <div class="spacer-20">
           
          </div>
          <div class="g_1_4">
            <label>Category:</label>
          </div>
          <div class="g_3_4_last">
            <div class="search-checkbox-wrap">
              <input type="checkbox" value="" id="s-field-15"/>
              <label for="s-field-15">Concept</label>
            </div>
            <div class="search-checkbox-wrap">
              <input type="checkbox" value="" id="s-field-16"/>
              <label for="s-field-16">HTML5</label>
            </div>
            <div class="search-checkbox-wrap">
              <input type="checkbox" value="" id="s-field-17"/>
              <label for="s-field-17">CSS3</label>
            </div>
            <div class="search-checkbox-wrap">
              <input type="checkbox" value="" id="s-field-18"/>
              <label for="s-field-18">Projects</label>
            </div>
            <div class="search-checkbox-wrap">
              <input type="checkbox" value="" id="s-field-19"/>
              <label for="s-field-19">Websites</label>
            </div>
            <div class="search-checkbox-wrap">
              <input type="checkbox" value="" id="s-field-20"/>
              <label for="s-field-20">Templates</label>
            </div>
            <div class="search-checkbox-wrap">
              <input type="checkbox" value="" id="s-field-21"/>
              <label for="s-field-21">Admin skin</label>
            </div>
            <div class="search-checkbox-wrap">
              <input type="checkbox" value="" id="s-field-22"/>
              <label for="s-field-22">Responsive</label>
            </div>
            <div class="search-checkbox-wrap">
              <input type="checkbox" value="" id="s-field-23"/>
              <label for="s-field-23">Mobile</label>
            </div>
            <div class="search-checkbox-wrap">
              <input type="checkbox" value="" id="s-field-24"/>
              <label for="s-field-24">Blackberry</label>
            </div>
            <div class="search-checkbox-wrap">
              <input type="checkbox" value="" id="s-field-25"/>
              <label for="s-field-25">Apple</label>
            </div>
          </div>
          <div class="spacer-15">
           
          </div>
          <hr/>
          <div class="spacer-20">
           
          </div>
          <div class="g_1_4">
            <label for="af-present">Show results:</label>
          </div>
          <div class="g_3_4_last">
            <select name="" class="multiple"  multiple="multiple">
              <option value="">Administor</option>
              <option value="">John doe</option>
              <option value="">Amenda Sleigert</option>
              <option value="">Jessica Tribble</option>
              <option value="">Jim Johnson</option>
              <option value="">Jessica Alban</option>
              <option value="">Jimmy Dokkes</option>
              <option value="">JWendy Chau</option>
            </select>
            <span class="field-helper"> You can select multiple values.</span> </div>
          <div class="spacer-20">

          </div>
          <div class="g_1_4">
            <label for="af-present">Show results:</label>
          </div>
          <div class="g_3_4_last">
            <div class="search-checkbox-wrap">
              <input type="radio" name="search-radio-2" value="no" id="s-field-31" checked="checked"/>
              <label class="font-normal" for="s-field-31">As Post</label>
            </div>
            <div class="search-checkbox-wrap">
              <input type="radio" name="search-radio-2" value="no" id="s-field-32"/>
              <label class="font-normal" for="s-field-32">As list</label>
            </div>
          </div>
          <div class="spacer-15">
           
          </div>-->
          <hr/>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <input type="hidden" id="sbt_frm" name="sbt_frm">
          <input type="hidden" id="action_frm" name="action_frm">
          <input type="hidden" id="delete_all" name="delete_all">
          <input type="hidden" id="delete_all_msg" name="delete_all_msg">
          <input type="hidden" name="lead_type" id="lead_type" value="<?php echo $lead_type;?>" />
          
          <div class="submit-cancel-button">
            <input type="submit" class="button-text"  value="Search now" name="search_btn" id="search_btn" />
            <span>or</span> <a href="index.html">Cancel</a> </div>
          <div class="spacer-15">
            <!-- spacer 15px -->
          </div>
           </form>
        <div id="advanced-search-results">
            
        <form class="e-checkbox-section" id="tbl_leads_submit_export" name="tbl_leads_submit_export" method="post" target="_blank">
            <input type="submit" value="Export Leads" name="export_lead" id="export_lead"/>
			<input type="hidden" value="<?php echo $_POST['search_enddate'];?>" name="search_enddate" id="search_campaign"/>
			<input type="hidden" value="<?php echo $_POST['search_startdate'];?>" name="search_startdate" id="search_campaign"/>
            <input type="hidden" value="<?php echo $_POST['search_campaign'];?>" name="search_campaign" id="search_campaign"/>
            <input type="hidden" value="<?php echo $_POST['search_show'];?>" name="search_show" id="search_show"/> 
        </form>
        </div>
      </div>
    </div>
  </div>
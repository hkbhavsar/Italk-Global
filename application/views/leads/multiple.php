<div class="powerwidget" id="widget3">
    <header>
      <h2>Assign Leads</h2>
    </header>
    <div>
      <div class="inner-spacer">
        <form method="post" action="" name ="search_form12" id="search_form12" autocomplete="off">
       
          
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          
          <div>
              <?php //print_r($clientData);?>
              <table border="1" width="100%">
                                <tr>
                                    <td style="width: 33%;text-align: center;">
                                         <div class="g_3_2_last">
                                        <SELECT NAME="list1" MULTIPLE SIZE=10 onDblClick="opt.transferRight()">
                                         
                                              <?php for($i=0;$i<count($clientData);$i++){?>
                                            <OPTION VALUE="<?php echo $clientData[$i]->function_name;?>"><?php echo ucfirst($clientData[$i]->vUsername);?></OPTION>
                                            <?php }?>
                                            
                                        </SELECT>
                                                
                                               	
                                            </div>           
                                        </div> 
                                    </td>
                                    <td style="width: 33%;text-align: center; padding:0px 122px;">
                                        <div class="g_3_2_last">
                                        <INPUT TYPE="button" NAME="right" VALUE="&gt;&gt;" ONCLICK="opt.transferRight()"><BR><BR>
                                        <INPUT TYPE="button" NAME="right" VALUE="All &gt;&gt;" ONCLICK="opt.transferAllRight()"><BR><BR>
                                        <INPUT TYPE="button" NAME="left" VALUE="&lt;&lt;" ONCLICK="opt.transferLeft()"><BR><BR>
                                        <INPUT TYPE="button" NAME="left" VALUE="All &lt;&lt;" ONCLICK="opt.transferAllLeft()">
                                        </div>
                                    </td>
                                    <td style="width: 33%;text-align: center;">
                                         <div class="g_3_2_last">
                                                <select name="list2"  multiple="multiple" onDblClick="opt.transferLeft()">
                                                                                                          
                                                </select>
                                             <div class="spacer-20">
                                                <!-- spacer 20px -->
                                              </div>
                                                 <div class="g_1_4">
            <label for="s-field-1">Sleep Time:</label>
          </div>
          <div class="g_1_7">
            <input type="text" name="sleep_time" id="sleep_time" value="<?php echo $_POST['sleep_time'];?>"/>
          </div>	
                                            </div>           
                                        </div> 
                                    </td>
                                </tr>
                            </table>
              
          </div>
           
            <INPUT TYPE="hidden" NAME="removedLeft" VALUE="" SIZE=70>
            <INPUT TYPE="hidden" NAME="removedRight" VALUE="" SIZE=70>
            <INPUT TYPE="hidden" NAME="addedLeft" VALUE="" SIZE=70>
            <INPUT TYPE="hidden" NAME="addedRight" VALUE="" SIZE=70>
            <INPUT TYPE="hidden" NAME="newLeft" VALUE="" SIZE=70>
            <INPUT TYPE="hidden" NAME="newRight" id="newRight" VALUE="" SIZE=70>      
         
        
          
         <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
     
          <hr/>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
          <input type="hidden" id="sbt_frm" name="sbt_frm">
          <input type="hidden" id="action_frm" name="action_frm">
          <input type="hidden" id="delete_all" name="delete_all">
           <input type="hidden" id="delete_all_msg" name="delete_all_msg">
          
          <div class="submit-cancel-button">
            <input type="button" class="button-text"  value="Assign Now" name="multi_assign_btn" id="multi_assign_btn" onclick="multi_process()" />
           
          <div class="spacer-15">
            <!-- spacer 15px -->
          </div>
        </form>
        <div id="advanced-search-results"></div>
      </div>
    </div>
  </div>
  <SCRIPT LANGUAGE="JavaScript">
            var opt = new OptionTransfer("list1","list2");
            opt.setAutoSort(false);
            opt.setDelimiter(",");
            //opt.setStaticOptionRegex("^(Bill|Bob|Matt)$");
            opt.saveRemovedLeftOptions("removedLeft");
            opt.saveRemovedRightOptions("removedRight");
            opt.saveAddedLeftOptions("addedLeft");
            opt.saveAddedRightOptions("addedRight");
            opt.saveNewLeftOptions("newLeft");
            opt.saveNewRightOptions("newRight");
            
            function multi_process()
            {
                var base_url =$("#base_url").val(); 
                var newright = $("#newRight").val();
				var sleep_time = $("#sleep_time").val();
                $("#multi_process_data").val(newright);
				$("#sleep_time_data").val(sleep_time);
                $("#tbl_leads_submit").attr("action",base_url+"submitlead/processmultileads");
                $("#tbl_leads_submit").submit();
                
            }
            
        </SCRIPT>
  </div>
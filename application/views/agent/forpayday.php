<script>
    function myFunction()
    {
        var x=document.getElementById("loan_amount").value;
	
        var install_12 = document.getElementById("install_12");
        var install_24 = document.getElementById("install_24");
        var install_36 = document.getElementById("install_36");
	
        var intrest_12 = document.getElementById("intrest_12");
        var intrest_24 = document.getElementById("intrest_24");
        var intrest_36 = document.getElementById("intrest_36");
	
        var advance_balance = document.getElementById("advance_balance");

        var install_12_process = (x/12).toFixed(2);
        var install_24_process = (x/24).toFixed(2);
        var install_36_process = (x/36).toFixed(2);
	
        install_12.value = install_12_process;
        install_24.value = install_24_process;
        install_36.value = install_36_process;
	
        if(x>=1000 && x<=5000)
        {
            intrest_12.value='2%';
            intrest_24.value='4%';
            intrest_36.value='5%';
        }
        else if(x>=5100 && x<=7000)
        {
            intrest_12.value='3%';
            intrest_24.value='6%';
            intrest_36.value='7%';
        }
        else if(x>=7100 && x<=10000)
        {
            intrest_12.value='3%';
            intrest_24.value='5%';
            intrest_36.value='8%';
        }
        else
        {
            intrest_12.value='';
            intrest_24.value='';
            intrest_36.value='';
        }
	
        if(x>=1000 && x<=2000)
        {
            advance_balance.value='150';
			
        }
        else if(x>=2000 && x<=4000)
        {
            advance_balance.value='200';
			
        }
        else if(x>=4000 && x<=8000)
        {
            advance_balance.value='300';
        }
        else if(x>=8000 && x<=10000)
        {
            advance_balance.value='400';
        }
        else
        {
            advance_balance.value='';
        }
		
	
    }
</script>
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
    <h2>New Payday</h2>
    <!--<a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a>--><br>
</div>
<section class="g_1">

    <?php if ($process_done == '1') { ?>
        <div class="dialog error">
            <p><img alt="" src="<?php echo Kohana::$base_url; ?>images/icons/dialogs/warning-16.png">Lead Added Successfully</p>
            <span>x</span>
        </div>
    <?php } ?>
    <?php if ($lead_edit==1) { ?>
        <div class="dialog error">
            <p><img alt="" src="<?php echo Kohana::$base_url; ?>images/icons/dialogs/warning-16.png">Lead Edited Successfully</p>
            <span>x</span>
        </div>
    <?php } ?>
    <div class="powerwidget" id="widget1">
        <header>
            <h2>Search</h2>
        </header>
        <div>
            <div class="inner-spacer">
                <form method="post"  id="form-validation-lead" autocomplete="off">
				<div  id="phone_dup"   style="color: #EF1919;font-weight: bold;"></div>
                    <div class="g_1_4">
                        <label for="af-present">Phone: *</label>
                    </div>
                    <div class="g_1_3">
                        <input type="text" name="phone" value="<?php echo $edit_newpayday->phone; ?>"  id="phone" data-validation-type="present" />
                    </div>
                    <section class="g_1_9">
                        <div><input type="button" id="search_phone_btn" name="search_phone_btn" value="Search Phone" class="button-text">
                        </div>
                    </section>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>

                    <div class="g_1_4">
                        <label for="af-present">First Name: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_3" id="fname_div">
                            <input type="text" name="fname" value="<?php echo $edit_newpayday->fname; ?>"  id="fname" data-validation-type="present" />
                        </div>
                        <div class="g_1_4" style="width:13.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Last Name: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="lname" value="<?php echo $edit_newpayday->lname; ?>"  id="lname" data-validation-type="present" />
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>

                    <div class="g_1_4">
                        <label for="af-present">Email: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_2">
                            <input type="text" name="email" value="<?php echo $edit_newpayday->email; ?>"  id="email" data-validation-type="present" />          
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>


                    <div class="g_1_4">
                        <label for="af-present">Address: *</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_2">
                            <input type="text" name="address" value="<?php echo $edit_newpayday->address; ?>"  id="address" data-validation-type="present" /> 
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="g_1_4">
                        <label for="s-field-1">City:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" name="city" value="<?php echo $edit_newpayday->city;?>"  id="city" data-validation-type="present" /> 
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">State: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" name="state" value="<?php echo $edit_newpayday->state;; ?>"  id="state" data-validation-type="present" />
                        </div>
                        <div class="g_1_4" style="width:13.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Zip: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="zip" value="<?php echo $edit_newpayday->zip; ?>"  id="zip" data-validation-type="present" maxlength="5"  data-validation-minimum="5" data-validation-maximum="6" data-validation-label="not more and less then 5 hardik digit" />
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>

                    <div class="g_1_4">
                        <label for="af-present">SSN: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" name="ssn" value="<?php echo $edit_newpayday->ssn; ?>"  id="ssn" data-validation-type="present" maxlength="9"  data-validation-minimum="9" data-validation-maximum="10" data-validation-label="not more and less then 9 digit" />
                        </div>
                        <div class="g_1_4" style="width:13.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">UIN: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="uin" value="<?php echo $edit_newpayday->uin; ?>"  id="uin" data-validation-type="present" />
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>

                    <div class="g_1_4">
                        <label for="af-present">Date of Birth: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" id="datepicker-default" class="datepicker" value="<?php if(isset($edit_newpayday->dob)){echo date("m/d/Y",strtotime($edit_newpayday->dob));}?>" name="dob">
                        </div>
                        <div class="g_1_4" style="width:14.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Loan Amount: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="loan_amount" value="<?php echo $edit_newpayday->loan_amount; ?>"  id="loan_amount" data-validation-type="present" onkeyup="myFunction();" />
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>

                    
                    <div class="g_1_4">
                        <label for="af-present">Loan Transfered: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <select data-validation-type="present" name="loan_transfered" style="display: none;">
                                <option value="">-select option-</option>
                                <option value="bank" <?php echo $edit_newpayday->loan_transfered=='bank'?'selected="selected"':''?>>Bank</option>
                                <option value="cheque" <?php echo $edit_newpayday->loan_transfered=='cheque'?'selected="selected"':''?>>Cheque</option>
                                <option value="other" <?php echo $edit_newpayday->loan_transfered=='other'?'selected="selected"':''?>>Other</option>

                            </select>
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>




                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <hr/>
                    <div class="g_1_4">
                        <label for="af-present"></label>
                    </div>
                    <div class="g_3_4_last">
                        <section class="g_1_7">
                            <div>12 Months</div>
                        </section>
                        <section class="g_1_7">
                            <div>24 Months</div>
                        </section>
                        <section class="g_1_7">
                            <div>36 Months</div>
                        </section>
                    </div>

                    <div class="spacer-10">
                        <!-- spacer 20px -->
                    </div>

                    <div class="g_1_4">
                        <label for="af-present">Installments: </label>
                    </div>
                    <div class="g_3_4_last">
                        <section class="g_1_7">
                            <div><input type="text" value="<?php echo $edit_newpayday->installments_month_12; ?>" name="install_12" id="install_12">
                            </div>
                        </section>
                        <section class="g_1_7">
                            <div><input type="text" value="<?php echo $edit_newpayday->installments_month_24; ?>" name="install_24" id="install_24">
                            </div>
                        </section>
                        <section class="g_1_7">
                            <div><input type="text" value="<?php echo $edit_newpayday->installments_month_36; ?>" name="install_36" id="install_36">
                            </div>
                        </section>
                    </div>

                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>

                    <div class="g_1_4">
                        <label for="af-present">Int.Rate: </label>
                    </div>
                    <div class="g_3_4_last">
                        <section class="g_1_7">
                            <div><input type="text" value="<?php echo $edit_newpayday->interest_rate_12; ?>" name="intrest_12" id="intrest_12">
                            </div>
                        </section>
                        <section class="g_1_7">
                            <div><input type="text" value="<?php echo $edit_newpayday->interest_rate_24 ?>" name="intrest_24" id="intrest_24">
                            </div>
                        </section>
                        <section class="g_1_7">
                            <div><input type="text" value="<?php echo $edit_newpayday->interest_rate_36?>" name="intrest_36" id="intrest_36">
                            </div>
                        </section>
                    </div>

                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>

                    <div class="g_1_4">
                        <label for="af-present">Advance Balance: </label>
                    </div>
                    <div class="g_3_4_last">

                        <section class="g_1_5">
                            <div><input type="text" value="<?php echo $edit_newpayday->advance_balance;?>" name="advance_balance" id="advance_balance">
                            </div>
                        </section>
                    </div>

                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>

                    <hr/>

                    <div class="g_1_4">
                        <label for="af-present">Follow Up Date: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" id="datepicker-default_lead_reminder" class="datepicker" value="<?php if(isset($edit_newpayday->lead_reminder)){echo date("m/d/Y",strtotime($edit_newpayday->lead_reminder));}?>" name="followupdate">
                        </div>
                        <div class="spacer-20">
                            <!-- spacer 20px -->
                        </div>
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Comment: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_2">
                            <textarea cols="15" rows="5" name="comment" id="comment"><?php echo $edit_newpayday->comment;?></textarea>
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                        
                        <input type="hidden" id="sbt_frm" name="sbt_frm">
                        <input type="hidden" id="action_frm" name="action_frm">
                        <input type="hidden" id="delete_all" name="delete_all">
                        <input type="hidden" id="delete_all_msg" name="delete_all_msg">
                        <input type="hidden" name="lead_type" id="lead_type" value="<?php echo $lead_type; ?>" />

                        <div class="submit-cancel-button">
                            <input type="submit" class="button-text"  value="Submit" name="submit" id="submit" />
                            <span>or</span> <a href="<?php echo Kohana::$base_url; ?>dashboard">Cancel</a> </div>
                        <div class="spacer-15">
                            <!-- spacer 15px -->
                        </div>
                </form>
                <div id="advanced-search-results"></div>
            </div>
        </div>
    </div>



    <!-- New widget -->

    <!-- End .powerwidget -->
</section>
<script>
    var bas_url = $('#base_url').val();
    $('#search_phone_btn').click(function () {   
        $.ajax({
            type: "POST",
            url: bas_url+'/processlead/searchphoneforpayday', 
            data: ({phonenumber: $('#phone').val() }),
            success: function(data) {
                var obj = $.parseJSON(data);
				$('#phone_dup').html(obj);
                $('#fname').val(obj.fname);
                $('#lname').val(obj.lname);
                $('#address').val(obj.address);
                $('#email').val(obj.email);
                $('#city').val(obj.city);
                $('#state').val(obj.state);
                $('#zip').val(obj.zip);
                $('#ssn').val(obj.ssn);
                $('#uin').val(obj.uin);
                $('#datepicker-default').val(obj.dob);
            }
       
        }); 
       }); 
      
    $('#zip').change(function () {
        var bas_url = $('#base_url').val();
        $.ajax({
            type: "POST",
            url: bas_url+'/processlead/searchzip', 
            data: ({zipcode: $('#zip').val() }),
            success: function(data) {
                var obj = $.parseJSON(data);
                $('#state').val(obj.state);
                $('#city').val(obj.city);
               
            }
       
        }); 
      }); 
    

</script>
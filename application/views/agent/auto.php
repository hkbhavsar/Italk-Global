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
    <h2>Auto</h2>
    <!--<a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a>--><br>
</div>
<section class="g_1">

    <?php if ($process_done == '1' && $lead_edit!=1) { ?>
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
                        <label for="s-field-1">Zip:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" name="zip" value="<?php echo $edit_newpayday->zip;?>"  id="zip" data-validation-type="present" maxlength="5" data-validation-type="present" data-validation-minimum="5" data-validation-maximum="5" data-validation-label="not more and less then 5 digit" /> 
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
                            &nbsp;&nbsp;&nbsp;<label for="af-present">City: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="city" value="<?php echo $edit_newpayday->city; ?>"  id="city" data-validation-type="present" />
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                   
                    <hr/>
                    
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="g_1_4">
                        <label for="s-field-1">Monthly Income:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" name="monthly_income" value="<?php echo $edit_newpayday->zip;?>"  id="monthly_income" data-validation-type="present" /> 
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Rent / Own: </label>
                    </div>
                    <div class="g_1_7">
                        <select style="width:145px;" data-validation-type="present" name="rent" id="rent" class="field">
               	<option value="">Select</option>
				<option value="rent">Rent</option><option value="own">Own</option></select>
       
                        
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Years of Residence.: </label>
                    </div>
                    <div class="g_3_4_last">
                        <section class="g_1_7" style="width:4%;">
                            <div>Years  </div>
                        </section>
                        <section class="g_1_7">
                            <div>
                                <select style="width:60px" class="a1_form" data-validation-type="present" name="resi_year">
                        <option value="">Select</option>
                        <option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>                      </select>
                            </div>
                        </section>
                        <section class="g_1_7" style="width:5%;">
                            <div>Months </div>
                        </section>
                        <section class="g_1_7" >
                            <div>
                              <select style="width:60px" data-validation-type="present" class="a1_form" name="resi_month">
                        <option value="">Select</option>
                        <option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option>                      </select>  
                            </div>
                        </section>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                     
                    <div class="g_1_4">
                        <label for="s-field-1">Rent/Mortgage :</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" name="rent_mortgage" value="<?php echo $edit_newpayday->zip;?>"  id="rent_mortgage" data-validation-type="present" /> 
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Bankruptcy : </label>
                    </div>
                    <div class="g_1_7">
                         <select style="width:145px;" data-validation-type="present" name="bankruptcy" id="bankruptcy" class="field">
               	<option value="">Select</option>
				<option value="yes">Yes</option><option value="no">No</option></select>
      
                      
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Date of Birth: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" data-validation-type="present" id="datepicker-default" class="datepicker" value="<?php echo $edit_newpayday->dob;?>" name="dob">
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                    <hr/>
                    <div class="g_1_4">
                        <label for="af-present">Employer: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_2">
                           <input type="text" data-validation-type="present" id="employer"  value="<?php echo $edit_newpayday->dob;?>" name="employer">
                       </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                     <div class="g_1_4">
                        <label for="af-present">Job Title: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_2">
                           <input type="text" name="job_title" value="<?php echo $edit_newpayday->loan_amount; ?>"  id="job_title" data-validation-type="present" />
                         </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                    <!--<div class="g_1_4">
                        <label for="af-present">Employer: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" id="employer" class="datepicker" value="<?php echo $edit_newpayday->dob;?>" name="employer">
                        </div>
                        <div class="g_1_4" style="width:14.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Job Title: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="job_title" value="<?php echo $edit_newpayday->loan_amount; ?>"  id="job_title" data-validation-type="present" />
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px 
                    </div>-->

                    
                    <div class="g_1_4">
                        <label for="af-present">Work number: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                             <input type="text" data-validation-type="present" name="work_number" value="<?php echo $edit_newpayday->loan_amount; ?>"  id="work_number" maxlength="10"  data-validation-minimum="10" data-validation-maximum="11" data-validation-label="not more and less then 10 digit" />
                    
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                    <div class="g_1_4">
                        <label for="af-present">How long have you been with this company?: </label>
                    </div>
                    <div class="g_3_4_last">
                        <section class="g_1_7" style="width:4%;">
                            <div>Years  </div>
                        </section>
                        <section class="g_1_7">
                            <div>
                                <select style="width:60px" class="a1_form" name="company_year" data-validation-type="present">
                        <option value="">Select</option>
                        <option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>                      </select>
                            </div>
                        </section>
                        <section class="g_1_7" style="width:5%;">
                            <div>Months </div>
                        </section>
                        <section class="g_1_7" >
                            <div>
                              <select style="width:60px" class="a1_form" name="company_month" data-validation-type="present">
                        <option value="">Select</option>
                        <option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option>                      </select>  
                            </div>
                        </section>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>

                    <hr/>
                    

                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                    <div class="g_1_4">
                        <label for="af-present">Co-signer? : </label>
                    </div>
                    <div class="g_1_7">
                        <select style="width:145px;" data-validation-type="present" name="cosigner" id="cosigner" class="field">
               	<option value="">Select</option>
				<option value="yes">Yes</option><option value="no">No</option></select>
      
                       
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                     <div class="g_1_4">
                        <label for="af-present">Loan Amount: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                             <input type="text" name="loan_amount" value="<?php echo $edit_newpayday->loan_amount; ?>"  id="loan_amount" data-validation-type="present" />
                    
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
                             <input type="text" name="ssn" value="<?php echo $edit_newpayday->loan_amount; ?>"  id="ssn" data-validation-type="present" maxlength="9" data-validation-type="present" data-validation-minimum="9" data-validation-maximum="10" data-validation-label="not more and less then 9 digit" />
                    
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                    <div class="g_1_4">
                        <label for="af-present">Credit check?: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                             <input type="checkbox" name="credit_chk"   id="credit_chk" data-validation-type="present" />
                    
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Down Payment: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                             <input type="text" name="down_payment" value="<?php echo $edit_newpayday->loan_amount; ?>"  id="down_payment" data-validation-type="present" />
                    
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Credit Score?: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_3">
                             <select style="width:145px;" data-validation-type="present" class="normal_font" name="credit_rating">
		<option value="">Select Credit Rating</option>
		<option value="Poor">Poor</option>
		<option value="Good">Good</option>
		<option value="Fair">Fair</option>
		<option value="Excellent">Excellent</option>
		</select>
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div> 
                    <div class="g_1_4">
                        <label for="af-present">Best Time To Contact You : </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_3">
                            <select style="width:145px;" data-validation-type="present" name="best_time_contact" id="best_time_contact" class="field">
               	<option value="">Select</option>
				<option value="Any Time">Any Time</option><option value="Morning">Morning</option><option value="Afternoon">Afternoon</option><option value="Evening">Evening</option><option value="Business Hours">Business Hours</option><option value="Weekends">Weekends</option></select>
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div> 
                    <div class="g_1_4">
                        <label for="af-present">IP Address: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                             <input type="text" name="ip_address" value="<?php echo $edit_newpayday->loan_amount; ?>"  id="ip_address" data-validation-type="present" />
                    
                        </div>
                    </div>
                    
                    <div class="spacer-10">
                        <!-- spacer 20px -->
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
            url: bas_url+'processlead/searchphoneforlead', 
            data: ({phonenumber: $('#phone').val(),lead_type:'auto'}),
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
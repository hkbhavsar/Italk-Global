<div id="powerwidgetspanel" class="powerwidgetspanel">
    <div class="powerwidgetspanel-widget" data-widget-id="widget1">
        <input type="checkbox"/>
        <label>Search</label>
    </div>
   
</div>
<div class="page-header">
    <h2>Payday</h2>
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
                            <input type="text" name="zip" value="<?php echo $edit_newpayday->zip; ?>"  id="zip" data-validation-type="present" maxlength="5"  data-validation-minimum="5" data-validation-maximum="6" data-validation-label="not more and less then 5 digit" />
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
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Gender: </label>
                        </div>
                        <div class="g_1_4">
                           <select data-validation-type="present" name="gender">
                                <option value="">-select option-</option>
                                <option value="male" <?php echo $edit_newpayday->loan_transfered=='male'?'selected="selected"':''?>>Male</option>
                                <option value="female" <?php echo $edit_newpayday->loan_transfered=='female'?'selected="selected"':''?>>Female</option>
                           </select>
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                   
                    <hr/>
                    
                      <div class="g_1_4">
                        <label for="af-present">Gross Monthly Income: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                             <input type="text" name="monthly_income" value="<?php echo $edit_newpayday->monthly_income;?>"  id="monthly_income" data-validation-type="present" /> 
                        </div>
                        <div class="g_1_4" style="width:13.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Income type: </label>
                        </div>
                        <div class="g_1_4">
                           <select data-validation-type="present" name="income_type">
                                <option value="">-select option-</option>
                                <option value="employment" <?php echo $edit_newpayday->loan_transfered=='male'?'selected="selected"':''?>>Employment</option>
                                <option value="benefits" <?php echo $edit_newpayday->loan_transfered=='female'?'selected="selected"':''?>>Benefits</option>
                           </select>
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                    <div class="g_1_4">
                        <label for="af-present">Income frequency: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                             <select data-validation-type="present" name="income_frequency">
                                <option value="">-select option-</option>
                                <option value="Weekly" <?php echo $edit_newpayday->loan_transfered=='male'?'selected="selected"':''?>>Weekly</option>
                                <option value="Bi_weekly" <?php echo $edit_newpayday->loan_transfered=='female'?'selected="selected"':''?>>BI WEEKLY</option>
                                <option value="Monthly" <?php echo $edit_newpayday->loan_transfered=='male'?'selected="selected"':''?>>Monthly</option>
                                <option value="Twice_monthly" <?php echo $edit_newpayday->loan_transfered=='female'?'selected="selected"':''?>>Twice Monthly</option>
                          
                             </select>    </div>
                        <div class="g_1_4" style="width:13.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Employer: </label>
                        </div>
                        <div class="g_1_4">
                           <input type="text" name="employer" value=""  id="employer" data-validation-type="present" /> 
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                     <div class="g_1_4">
                        <label for="af-present">Employer phone: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                              <input type="text" name="employer_phone" value=""  id="employer_phone" data-validation-type="present" maxlength="10"  data-validation-minimum="10" data-validation-maximum="11" data-validation-label="not more and less then 10 digit" /> 
                         </div>
                       
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">How long have you been with this company? : </label>
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
                     <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Pay date 1: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" id="datepicker-paydate1" class="datepicker" value="" name="paydate_1" data-validation-type="present">
                        </div>
                        <div class="g_1_4" style="width:14.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Pay date 2: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" id="datepicker-paydate2" class="datepicker" value="" name="paydate_2" data-validation-type="present">
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
                            <input type="text" id="datepicker-default" data-validation-type="present" class="datepicker" value="<?php echo $edit_newpayday->dob;?>" name="dob">
                        </div>
                        <div class="g_1_4" style="width:14.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Rent/Own: </label>
                        </div>
                        <div class="g_1_4">
                        <select style="width:60px" class="a1_form" name="rent_own" id="rent_own" data-validation-type="present">
                        <option value="">Select</option>
                        <option value="rent">Rent</option><option value="own">Own</option>
                        </select>
                             </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Year of Resident? : </label>
                    </div>
                    <div class="g_3_4_last">
                        <section class="g_1_7" style="width:4%;">
                            <div>Years  </div>
                        </section>
                        <section class="g_1_7">
                            <div>
                                <select style="width:60px" class="a1_form" name="resi_year" id="resi_year" data-validation-type="present">
                        <option value="">Select</option>
                        <option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>                      </select>
                            </div>
                        </section>
                        <section class="g_1_7" style="width:5%;">
                            <div>Months </div>
                        </section>
                        <section class="g_1_7" >
                            <div>
                              <select style="width:60px" class="a1_form" name="resi_month" id="resi_month" data-validation-type="present">
                        <option value="">Select</option>
                        <option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option>                      </select>  
                            </div>
                        </section>
                    </div>
                    
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                     
                   
                    <div class="g_1_4">
                        <label for="s-field-1">Military:</label>
                    </div>
                    <div class="g_3_4_last">
                      <div class="g_1_4">
                        <select style="width:60px" class="a1_form" name="military" id="military" data-validation-type="present">
                        <option value="">Select</option>
                        <option value="yes">Yes</option><option value="no">No</option>
                        </select>    
                       </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <hr>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Reference 1 Name: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" name="ref_1" value=""  id="ref_1" data-validation-type="present" />
                        </div>
                        <div class="g_1_4" style="width:17.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Reference 1 phone: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="ref_1_phone" value=""  id="ref_1_phone" data-validation-type="present" maxlength="10"  data-validation-minimum="10" data-validation-maximum="11" data-validation-label="not more and less then 10 digit" />
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                     <div class="g_1_4">
                        <label for="s-field-1">Reference 1 relationship</label>
                    </div>
                    <div class="g_3_4_last">
                      <div class="g_1_4">
                        <input type="text" name="ref_1_relation" value=""  id="ref_1_relation" data-validation-type="present" />  
                       </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Reference 2 Name: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" name="ref_2" value=""  id="ref_2" data-validation-type="present" />
                        </div>
                        <div class="g_1_4" style="width:17.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Reference 2 phone: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="ref_2_phone" value=""  id="ref_2_phone" data-validation-type="present" maxlength="10"  data-validation-minimum="10" data-validation-maximum="11" data-validation-label="not more and less then 10 digit" />
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="g_1_4">
                        <label for="s-field-1">Reference 2 relationship</label>
                    </div>
                    <div class="g_3_4_last">
                      <div class="g_1_4">
                        <input type="text" name="ref_2_relation" value=""  id="ref_2_relation" data-validation-type="present" />  
                       </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <hr>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Loan Amount: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                           <input type="text" name="loan_amount" value=""  id="loan_amount" data-validation-type="present" />
                        </div>                       
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Bank name: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                           <input type="text" name="bank_name" value=""  id="bank_name" data-validation-type="present"  />
                        </div>
                        <div class="g_1_4" style="width:14.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Bank phone: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="bank_phone" value=""  id="bank_phone" data-validation-type="present" maxlength="10"  data-validation-minimum="10" data-validation-maximum="11" data-validation-label="not more and less then 10 digit" />
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">How long have you been with this bank?: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                           <select style="width:60px" class="a1_form"  name="bank_year" id="bank_year" data-validation-type="present">
                              <option value="">Select</option>
                              <option value="00">00</option><option value="01">01</option><option value="02">02</option><option value="03">03</option><option value="04">04</option><option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">10+</option>                            </select>  </div>                       
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                     <div class="g_1_4">
                        <label for="af-present">Bank account#: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                           <input type="text" name="bank_acc" value=""  id="bank_acc" data-validation-type="present"  />
                        </div>
                        <div class="g_1_4" style="width:18.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Bank account type: </label>
                        </div>
                        <div class="g_1_4">
                           <select style="width:170px;" data-validation-type="present" name="bank_account_type" id="bank_account_type">
                            <option value="">Select account Type</option>
                            <option value="Checking">Checking</option>
                            <option value="Saving">Saving</option>

                            </select>   
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                     <div class="g_1_4">
                        <label for="af-present">Income direct deposit: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                           <select style="width:170px;" data-validation-type="present" id="salary_direct_deposit" name="salary_direct_deposit">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>

                            </select>          </div>                       
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                     <div class="g_1_4">
                        <label for="af-present">Bank routing#: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                           <input type="text" name="bank_routing" value=""  id="bank_routing" data-validation-type="present"  />
                        </div>
                        <div class="g_1_4" style="width:18.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Driving License ID #: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="driving_license" value=""  id="driving_license" data-validation-type="present"  />
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                     <div class="g_1_4">
                        <label for="af-present">Driving License Issue State: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                           <select id="state_issue_id" name="state_issue_id" data-validation-type="present" style="width:140px">
                                  <option value="">Select State</option>
                                  <option value="Alaska">Alaska</option><option value="Alabama">Alabama</option><option value="Arkansas">Arkansas</option><option value="Arizona">Arizona</option><option value="California">California</option><option value="Colorado">Colorado</option><option value="Connecticut">Connecticut</option><option value="District Of Columbia">District Of Columbia</option><option value="Delaware">Delaware</option><option value="Florida">Florida</option><option value="Georgia">Georgia</option><option value="Hawaii">Hawaii</option><option value="Iowa">Iowa</option><option value="Idaho">Idaho</option><option value="Illinois">Illinois</option><option value="Indiana">Indiana</option><option value="Kansas">Kansas</option><option value="Kentucky">Kentucky</option><option value="Louisiana">Louisiana</option><option value="Massachusetts">Massachusetts</option><option value="Maryland">Maryland</option><option value="Maine">Maine</option><option value="Michigan">Michigan</option><option value="Minnesota">Minnesota</option><option value="Missouri">Missouri</option><option value="Mississippi">Mississippi</option><option value="Montana">Montana</option><option value="North Carolina">North Carolina</option><option value="North Dakota">North Dakota</option><option value="Nebraska">Nebraska</option><option value="New Hampshire">New Hampshire</option><option value="New Jersey">New Jersey</option><option value="New Mexico">New Mexico</option><option value="Nevada">Nevada</option><option value="New York">New York</option><option value="Ohio">Ohio</option><option value="Oklahoma">Oklahoma</option><option value="Oregon">Oregon</option><option value="Pennsylvania">Pennsylvania</option><option value="Rhode Island">Rhode Island</option><option value="South Carolina">South Carolina</option><option value="South Dakota">South Dakota</option><option value="Tennessee">Tennessee</option><option value="Texas">Texas</option><option value="Utah">Utah</option><option value="Virginia">Virginia</option><option value="Vermont">Vermont</option><option value="Washington">Washington</option><option value="Wisconsin">Wisconsin</option><option value="West Virginia">West Virginia</option><option value="Wyoming">Wyoming</option>						
                           </select> </div>
                        <div class="g_1_4" style="width:22.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Best Time To Contact You: </label>
                        </div>
                        <div class="g_1_4">
                            <select style="width:145px;" name="best_time_contact" id="best_time_contact" data-validation-type="present">
                            <option value="">Select</option>
                            <option value="Any Time">Any Time</option><option value="Morning">Morning</option><option value="Afternoon">Afternoon</option><option value="Evening">Evening</option><option value="Business Hours">Business Hours</option><option value="Weekends">Weekends</option></select>  </div>
                        </div>
                    <div class="spacer-20">
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
            url: bas_url+'/processlead/searchphoneforlead', 
            data: ({phonenumber: $('#phone').val() }),
            success: function(data) {
                var obj = $.parseJSON(data);
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
<div id="powerwidgetspanel" class="powerwidgetspanel">
    <div class="powerwidgetspanel-widget" data-widget-id="widget1">
        <input type="checkbox"/>
        <label>Auto Insurance</label>
    </div>
</div>
<div class="page-header">
    <h2>Auto Insurance</h2>
    <!--<a href="javascript:void(0);" class="page-helper empty-local-storage">Clear storage</a>--><br>
</div>
<section class="g_1">

    <?php if ($process_done == '1' && $lead_edit != 1) { ?>
        <div class="dialog error">
            <p><img alt="" src="<?php echo Kohana::$base_url; ?>images/icons/dialogs/warning-16.png">Lead Added Successfully</p>
            <span>x</span>
        </div>
    <?php } ?>
    <?php if ($lead_edit == 1) { ?>
        <div class="dialog error">
            <p><img alt="" src="<?php echo Kohana::$base_url; ?>images/icons/dialogs/warning-16.png">Lead Edited Successfully</p>
            <span>x</span>
        </div>
    <?php } ?>
    <div class="powerwidget" id="widget1">
        <header>
            <h2>Auto Insurance</h2>
        </header>
        <div>
            <div class="inner-spacer">
                <form method="post"  id="form-validation-lead" autocomplete="off">
                    <div  id="phone_dup"   style="color: #EF1919;font-weight: bold;"></div>
                    <div class="g_1_4">
                        <label for="af-present">Phone: *</label>
                    </div>
                    <div class="g_1_3">
                        <input type="text" name="phone" value="<?php echo $edit_newpayday->phone; ?>"  id="phone" data-validation-type="present" maxlength="10" data-validation-minimum="10" data-validation-maximum="11" data-validation-label="not more and less then 10 digit" />
                    </div>
                    <section class="g_1_9">
                        <div><input type="button" id="search_phone_btn" name="search_phone_btn" value="Search Phone" class="button-text">
                        </div>
                    </section>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">First name: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_3" id="fname_div">
                        <input type="text" name="fname" value=""  id="fname" data-validation-type="present"    /> 
                       </div>
                        <div class="g_1_4" style="width:13.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Last name: </label>
                        </div>
                        <div class="g_1_4">
                           <input type="text" name="lname" value=""  id="lname" data-validation-type="present"    /> 
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="g_1_4">
                        <label for="s-field-1">Address:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_3_4">
                          <input type="text" name="address" value=""  id="address" data-validation-type="present"    /> 
                           </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                     <div class="g_1_4">
                        <label for="af-present">ZipCode: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_3" id="fname_div">
                        <input type="text" name="zip" value=""  id="zip" data-validation-type="present"    /> 
                       </div>
                        <div class="g_1_4" style="width:13.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">E-mail: </label>
                        </div>
                        <div class="g_1_4">
                           <input type="text" name="email" value=""  id="email" data-validation-type="present" />
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Are you a homeowner?: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                           <select data-validation-type="present" name="applicantResidence">
                                <option value="">-please select-</option>
                               <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>    </div>
                        <div class="g_1_4" style="width:30.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Please, estimate your credit score: </label>
                        </div>
                        <div class="g_1_4">
                          <select data-validation-type="present" name="applicantCredit">
                               <option value="Poor">Poor</option>
                                <option value="Fair">Average</option>
                                <option value="Good">Good</option>
                                <option value="Excellent">Excellent</option>
                            </select>   </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                     
                    
                    <hr/>
                     <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Year: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_3" id="fname_div">
                        <select id="year" name="year" data-validation-type="present">
                               
                                <option value="">-please select-</option>
                                 <?php for($i=2013;$i>=1981;$i--){?>
                                
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }?>
                                                  
                            </select> 
                       </div>
                        <div class="g_1_4" style="width:13.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Make: </label>
                        </div>
                        <div class="g_1_4">
                          <select id="makename" name="makename" data-validation-type="present" onchange="find_model(this.options[selectedIndex].value);" make="make">
                                <option value="">-please select-</option>
                                 <?php foreach($makeData as $key=>$value){?>
                                <option value="<?php echo $value->make_id;?>"><?php echo $value->make_name;?></option>
                                <?php }?>
                                                  
                            </select>  
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                    <div class="g_1_4">
                        <label for="af-present">Model: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_3" id="fname_div">
                        <div id="model_select">
                            <select id="model_name" name="model_name" data-validation-type="present" model="model">
                                <option value="">-please select-</option>
                            </select>
                            </div>
                       </div>
                        <div class="g_1_4" style="width:13.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Trim: </label>
                        </div>
                        <div class="g_1_4">
                          <div id="trim_select">
                                <select id="trim_name" name="trim_name" data-validation-type="present" trim="trim">
                                    <option value="">-please select-</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                   
                    
                    <div class="g_1_4">
                        <label for="s-field-1">Is this vehicle owned or leased?:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <select id="vehicleOwnership" name="vehicleOwnership" data-validation-type="present">
                                <option value="">-please select-</option>
                                <option value="Owned">Owned</option>
                                <option value="Leased">Leased</option>
                             </select>     
                       </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    
                     <div class="g_1_4">
                        <label for="s-field-1">What is the primary use of this vehicle?:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <select id="vehicleUse" name="vehicleUse" data-validation-type="present" make="make">
                                <option value="">-please select-</option>
                                <option value="Commute Work">Commute Work</option>
                                <option value="Commute School">Commute School</option>
                                <option value="Commute Varies">Commute Varies</option>
                                <option value="Pleasure">Pleasure</option>
                                <option value="Business">Business</option>
                             </select>     
                       </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    
                    <div class="g_1_4">
                        <label for="s-field-1">If this vehicle is used for commuting or business, what is an average one-way mileage?:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <select id="vehicleOneWayMileage" name="vehicleOneWayMileage" data-validation-type="present">
                                <option value="">-please select-</option>
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="9">9</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="51">51</option>
                             </select>     
                       </div>
                    </div>
                    <div class="spacer-50">
                        <!-- spacer 5px -->
                    </div>
                     <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                   
                    <div class="g_1_4">
                        <label for="s-field-1">Approximate annual mileage:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <select id="vehicleAnnualMileage" name="vehicleAnnualMileage" data-validation-type="present"  make="make">
                                <option value="">-please select-</option>
                                <option value="5000">5000</option><option value="7500">7500</option><option value="10000">10000</option><option value="12500">12500</option><option value="15000">15000</option><option value="18000">18000</option><option value="25000">25000</option><option value="50000">50000</option><option value="50001">50001</option>
                             </select>     
                       </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    
                    <div class="g_1_4">
                        <label for="s-field-1">Where is this vehicle being kept at night?:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <select id="vehicleGarage" name="vehicleGarage" data-validation-type="present" make="make">
                               <option value="">-please select-</option><option value="No Cover">No Cover</option><option value="Car Port">Car Port</option><option value="Full Garage">Full Garage</option><option value="On Street">On Street</option>       </select>     
                       </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                     <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    
                    <div class="g_1_4">
                        <label for="s-field-1">Please, select your desired comprehensive deductible:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <select id="vehicleComprehensive" name="vehicleComprehensive" data-validation-type="present" make="make">
                               <option value="">-please select-</option><option value="No Cover">No Cover</option><option value="Car Port">Car Port</option><option value="Full Garage">Full Garage</option><option value="On Street">On Street</option></select>
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                     <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <br/>
                    <strong>Driver Information</strong>
                    <hr/><br/>
                    <div class="g_1_4">
                        <label for="af-present">Gender: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_3" id="fname_div">
                            <select data-validation-type="present" name="gender">
                                <option value="">-select option-</option>
                                <option value="male" <?php echo $edit_newpayday->loan_transfered=='male'?'selected="selected"':''?>>Male</option>
                                <option value="female" <?php echo $edit_newpayday->loan_transfered=='female'?'selected="selected"':''?>>Female</option>
                           </select> </div>
                        <div class="g_1_4" style="width:13.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Marital Status: </label>
                        </div>
                        <div class="g_1_4">
                           <select data-validation-type="present" name="driverMaritalStatus">
                               <option value="">-please select-</option><option value="Single">Single</option><option value="Married">Married</option><option value="Separated">Separated</option><option value="Divorced">Divorced</option><option value="Widowed">Widowed</option><option value="Domestic Partner">Domestic Partner</option>     </select>      </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                    <div class="g_1_4">
                        <label for="af-present">Date of Birth: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <input type="text" id="datepicker-default" class="datepicker" data-validation-type="present" value="<?php if(isset($edit_newpayday->dob)){echo date("m-d-Y",strtotime($edit_newpayday->dob));}?>" name="dob">
                        </div>
                       
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                    <div class="g_1_4">
                        <label for="af-present">In which state are you currently licensed?: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_3" id="fname_div">
                            <select data-validation-type="present" name="driverLicenseState">
                                <option value="">Select State</option><option value="AL">AL</option><option value="AK">AK</option><option value="AZ">AZ</option><option value="AR">AR</option><option value="CA">CA</option><option value="CO">CO</option><option value="CT">CT</option><option value="DE">DE</option><option value="FL">FL</option><option value="GA">GA</option><option value="HI">HI</option><option value="ID">ID</option><option value="IL">IL</option><option value="IN">IN</option><option value="IA">IA</option><option value="KS">KS</option><option value="KY">KY</option><option value="LA">LA</option><option value="ME">ME</option><option value="MD">MD</option><option value="MA">MA</option><option value="MI">MI</option><option value="MN">MN</option><option value="MS">MS</option><option value="MO">MO</option><option value="MT">MT</option><option value="NE">NE</option><option value="NV">NV</option><option value="NH">NH</option><option value="NJ">NJ</option><option value="NM">NM</option><option value="NY">NY</option><option value="NC">NC</option><option value="ND">ND</option><option value="OH">OH</option><option value="OK">OK</option><option value="OR">OR</option><option value="PA">PA</option><option value="RI">RI</option><option value="SC">SC</option><option value="SD">SD</option><option value="TN">TN</option><option value="TX">TX</option><option value="UT">UT</option><option value="VT">VT</option><option value="VA">VA</option><option value="WA">WA</option><option value="DC">DC</option><option value="WV">WV</option><option value="WI">WI</option><option value="WY">WY</option>
                                
                            </select>
                        </div>
                       
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>

                    <div class="g_1_4">
                        <label for="af-present">What is your driver's license status?: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_2">
                            <select data-validation-type="present" name="driverLicenseStatus">
                                <option value="">-please select-</option><option value="Active">Active</option><option value="Suspended">Suspended</option><option value="Probation">Probation</option><option value="Restricted">Restricted</option><option value="Learner">Learner</option><option value="Temporary">Temporary</option><option value="International">International</option>
                            </select> </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                   


                    <div class="g_1_4">
                        <label for="af-present">What is your highest education level?</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_2">
                            <select data-validation-type="present" name="driverEducation">
                                 <option value="">-please select-</option><option value="Less than High School">Less than High School</option><option value="Some or No High School">Some or No High School</option><option value="High School Diploma">High School Diploma</option><option value="Some College">Some College</option><option value="Associate Degree">Associate Degree</option><option value="Bachelors Degree">Bachelors Degree</option><option value="Masters Degree">Masters Degree</option><option value="Doctorate Degree">Doctorate Degree</option><option value="Other">Other</option>
                            </select> </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                    <div class="g_1_4">
                        <label for="af-present">What is your occupation?</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_2">
                            <select data-validation-type="present" name="driverOccupation">
                                 <option value="">-please select-</option><option value="Accounts Pay/Rec.">Accounts Pay/Rec.</option><option value="Actor">Actor</option><option value="Administration/Management">Administration/Management</option><option value="Appraiser">Appraiser</option><option value="Architect">Architect</option><option value="Artist">Artist</option><option value="Assembler">Assembler</option><option value="Auditor">Auditor</option><option value="Baker">Baker</option><option value="Bank Teller">Bank Teller</option><option value="Banker">Banker</option><option value="Bartender">Bartender</option><option value="Broker">Broker</option><option value="Cashier">Cashier</option><option value="Casino Worker">Casino Worker</option><option value="CEO">CEO</option><option value="Certified Public Accountant">Certified Public Accountant</option><option value="Chemist">Chemist</option><option value="Child Care">Child Care</option><option value="City Worker">City Worker</option><option value="Claims Adjuster">Claims Adjuster</option><option value="Clergy">Clergy</option><option value="Clerical/Technical">Clerical/Technical</option><option value="College Professor">College Professor</option><option value="Computer Tech.">Computer Tech.</option><option value="Construction">Construction</option><option value="Contractor">Contractor</option><option value="Counselor">Counselor</option><option value="Craftsman/Skilled Worker">Craftsman/Skilled Worker</option><option value="CSR">CSR</option><option value="Custodian">Custodian</option><option value="Dancer">Dancer</option><option value="Decorator">Decorator</option><option value="Delivery Driver">Delivery Driver</option><option value="Dentist">Dentist</option><option value="Director">Director</option><option value="Disabled">Disabled</option><option value="Drivers">Drivers</option><option value="Electrician">Electrician</option><option value="Engineer-Aeronautical">Engineer-Aeronautical</option><option value="Engineer-Aerospace">Engineer-Aerospace</option><option value="Engineer-Chemical">Engineer-Chemical</option><option value="Engineer-Civil">Engineer-Civil</option><option value="Engineer-Electrical">Engineer-Electrical</option><option value="Engineer-Gas">Engineer-Gas</option><option value="Engineer-Geophysical">Engineer-Geophysical</option><option value="Engineer-Mechanical">Engineer-Mechanical</option><option value="Engineer-Nuclear">Engineer-Nuclear</option><option value="Engineer-Other">Engineer-Other</option><option value="Engineer-Petroleum">Engineer-Petroleum</option><option value="Engineer-Structural">Engineer-Structural</option><option value="Entertainer">Entertainer</option><option value="Farmer">Farmer</option><option value="Fire Fighter">Fire Fighter</option><option value="Flight Attend.">Flight Attend.</option><option value="Food Service">Food Service</option><option value="Health Care">Health Care</option><option value="Installer">Installer</option><option value="Instructor">Instructor</option><option value="Journalist">Journalist</option><option value="Journeyman">Journeyman</option><option value="Lab Tech.">Lab Tech.</option><option value="Laborer/Unskilled Worker">Laborer/Unskilled Worker</option><option value="Lawyer">Lawyer</option><option value="Machine Operator">Machine Operator</option><option value="Machinist">Machinist</option><option value="Maintenance">Maintenance</option><option value="Manufacturer">Manufacturer</option><option value="Marketing">Marketing</option><option value="Mechanic">Mechanic</option><option value="Modeling">Model</option><option value="Nanny">Nanny</option><option value="Nurse/CNA">Nurse/CNA</option><option value="Other">Other</option><option value="Painter">Painter</option><option value="Para-Legal">Para-Legal</option><option value="Paramedic">Paramedic</option><option value="Personal Trainer">Personal Trainer</option><option value="Photographer">Photographer</option><option value="Physician">Physician</option><option value="Pilot">Pilot</option><option value="Plumber">Plumber</option><option value="Police Officer">Police Officer</option><option value="Postal Worker">Postal Worker</option><option value="Preacher">Preacher</option><option value="Pro Athlete">Pro Athlete</option><option value="Production">Production</option><option value="Prof-College Degree">Prof-College Degree</option><option value="Prof-Specialty Degree">Prof-Specialty Degree</option><option value="Programmer">Programmer</option><option value="Real Estate">Real Estate</option><option value="Receptionist">Receptionist</option><option value="Reservation Agent">Reservation Agent</option><option value="Restaurant Manager">Restaurant Manager</option><option value="Retail">Retail</option><option value="Roofer">Roofer</option><option value="Sales">Sales</option><option value="Scientist">Scientist</option><option value="Secretary">Secretary</option><option value="Security">Security</option><option value="Social Worker">Social Worker</option><option value="Stocker">Stocker</option><option value="Store Owner">Store Owner</option><option value="Stylist">Stylist</option><option value="Supervisor">Supervisor</option><option value="Teacher">Teacher</option><option value="Teacher - with Credentials">Teacher - with Credentials</option><option value="Technical/Supervisory">Technical/Supervisory</option><option value="Travel Agent">Travel Agent</option><option value="Truck Driver">Truck Driver</option><option value="Vet.">Vet.</option><option value="Waitress">Waitress</option><option value="Welder">Welder</option><option value="Government">Government</option><option value="Housewife/Househusband">Housewife/Househusband</option><option value="Retired">Retired</option><option value="Stud. Not Living w/Parents">Stud. Not Living w/Parents</option><option value="Unemployed">Unemployed</option><option value="Military E1 - E4">Military E1 - E4</option><option value="Military E5 - E7">Military E5 - E7</option><option value="Military Officer">Military Officer</option><option value="Military Other">Military Other</option><option value="Unknown">Unknown</option><option value="Self Employed">Self Employed</option><option value="Student Living w/Parents">Student Living w/Parents</option>
                            </select> </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    <br/>
                    <strong>Coverage</strong>
                    <hr/><br/>
                    <div class="g_1_4">
                        <label for="s-field-1">Desired Coverage:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <select data-validation-type="present" name="applicantRequestedCoverage">
                                <option value="">-please select-</option> option value="Premium">Premium Coverage</option><option  value="Standard">Standard Coverage</option><option value="Preferred">Preferred Coverage</option><option value="State_Min">State Minimum Coverage</option>
                            </select>
                           
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                     <div class="g_1_4">
                        <label for="s-field-1">Are you currently insured, or have been insured during past 30 days on any policy, for any vehicle?:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <select data-validation-type="present" name="applicantCurrentlyInsured" onchange="showhidediv(this.options[selectedIndex].value);" model="model">
                                 <option value="">-please select-</option>
                                 <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                           
                        </div>
                    </div>
                    <div class="spacer-50">
                        <!-- spacer 5px -->
                    </div>
                     <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                     
                    <div id="show_hide_div" style="display: none;">
                            <div class="g_1_4">
                               <label for="s-field-1">What is your current or most recent insurance company?</label>
                           </div>
                           <div class="g_3_4_last">
                               <div class="g_1_4">
                                   <select id="current_insurance_company" name="current_insurance_company" model="model">
                                        <option value="">-please select-</option>
                                        <option value="(Not Listed)">(Not Listed)</option><option value="21st Century Insurance">21st Century Insurance</option><option value="AAA">AAA</option><option value="Access Insurance">Access Insurance</option><option value="AETNA">AETNA</option><option value="AFLAC">AFLAC</option><option value="AIG / American General">AIG / American General</option><option value="AIU Insurance">AIU Insurance</option><option value="All Risk">All Risk</option><option value="Allianz">Allianz</option><option value="Allied">Allied</option><option value="Allstate">Allstate</option><option value="American Alliance Insurance">American Alliance Insurance</option><option value="American Automobile Insurance">American Automobile Insurance</option><option value="American Casualty">American Casualty</option><option value="American Deposit Insurance">American Deposit Insurance</option><option value="American Direct Business Insurance">American Direct Business Insurance</option><option value="American Empire Insurance">American Empire Insurance</option><option value="American Family">American Family</option><option value="American Financial">American Financial</option><option value="American Home Assurance">American Home Assurance</option><option value="American Insurance">American Insurance</option><option value="American International Insurance">American International Insurance</option><option value="American Manufacturers">American Manufacturers</option><option value="American Mayflower Insurance">American Mayflower Insurance</option><option value="American Motorists Insurance">American Motorists Insurance</option><option value="American National">American National</option><option value="American Premier Insurance">American Premier Insurance</option><option value="American Protection Insurance">American Protection Insurance</option><option value="American Reliable">American Reliable</option><option value="American Republic">American Republic</option><option value="American Savers Plan">American Savers Plan</option><option value="American Service Insurance">American Service Insurance</option><option value="American Skyline Insurance">American Skyline Insurance</option><option value="American Spirit Insurance">American Spirit Insurance</option><option value="American Standard Insurance">American Standard Insurance</option><option value="Ameriprise">Ameriprise</option><option value="Amica">Amica</option><option value="Anthem">Anthem</option><option value="Arbella">Arbella</option><option value="Armed Forces Insurance">Armed Forces Insurance</option><option value="Associated Indemnity">Associated Indemnity</option><option value="Assurant">Assurant</option><option value="Atlanta Casualty">Atlanta Casualty</option><option value="Atlantic Indemnity">Atlantic Indemnity</option><option value="Auto Club Insurance Company">Auto Club Insurance Company</option><option value="Auto Owners">Auto Owners</option><option value="Banner Life">Banner Life</option><option value="Blue Cross / Blue Shield">Blue Cross / Blue Shield</option><option value="Cal Farm Insurance">Cal Farm Insurance</option><option value="California State Automobile Association">California State Automobile Association</option><option value="Chubb">Chubb</option><option value="Cigna">Cigna</option><option value="Citizens">Citizens</option><option value="Clarendon American Insurance">Clarendon American Insurance</option><option value="Clarendon National Insurance">Clarendon National Insurance</option><option value="CNA">CNA</option><option value="Colonial Insurance">Colonial Insurance</option><option value="Commonwealth">Commonwealth</option><option value="Continental Casualty">Continental Casualty</option><option value="Continental Divide Insurance">Continental Divide Insurance</option><option value="Continental Insurance">Continental Insurance</option><option value="Cotton States">Cotton States</option><option value="Country Insurance">Country Insurance</option><option value="Dairyland Insurance">Dairyland Insurance</option><option value="Electric">Electric</option><option value="Equitable Life &amp; Casualty Insurance Company ">Equitable Life &amp; Casualty Insurance Company </option><option value="Erie">Erie</option><option value="Esurance">Esurance</option><option value="Farm Bureau/Farm Family/Rural">Farm Bureau/Farm Family/Rural</option><option value="Farmers">Farmers</option><option value="Farmers Union">Farmers Union</option><option value="Fidelity Insurance Company">Fidelity Insurance Company</option><option value="Fidelity National">Fidelity National</option><option value="Firemans Fund">Firemans Fund</option><option value="Foremost">Foremost</option><option value="Garden State Life Insurance Company">Garden State Life Insurance Company</option><option value="GEICO">GEICO</option><option value="Globe Life">Globe Life</option><option value="GMAC">GMAC</option><option value="Golden Rule">Golden Rule</option><option value="Government Employees Insurance">Government Employees Insurance</option><option value="Grange">Grange</option><option value="Great American">Great American</option><option value="Great West">Great West</option><option value="Guaranty National Insurance">Guaranty National Insurance</option><option value="Guardian">Guardian</option><option value="Guideone">Guideone</option><option value="Hanover">Hanover</option><option value="Hartford AARP">Hartford AARP</option><option value="Health Net">Health Net</option><option value="Health Plus of America">Health Plus of America</option><option value="HealthMarkets">HealthMarkets</option><option value="HealthShare America">HealthShare America</option><option value="Horace Mann Insurance">Horace Mann Insurance</option><option value="Humana">Humana</option><option value="IDS">IDS</option><option value="IFA Auto Insurance">IFA Auto Insurance</option><option value="IGF Insurance">IGF Insurance</option><option value="Infinity Insurance">Infinity Insurance</option><option value="Infinity National Insurance">Infinity National Insurance</option><option value="Infinity Select Insurance">Infinity Select Insurance</option><option value="Integon">Integon</option><option value="John Hancock">John Hancock</option><option value="Kaiser Permanente">Kaiser Permanente</option><option value="Kemper">Kemper</option><option value="Landmark American Insurance">Landmark American Insurance</option><option value="Leader National Insurance">Leader National Insurance</option><option value="Leader Preferred Insurance">Leader Preferred Insurance</option><option value="Leader Specialty Insurance">Leader Specialty Insurance</option><option value="Liberty Insurance Corp">Liberty Insurance Corp</option><option value="Liberty Mutual">Liberty Mutual</option><option value="Liberty National">Liberty National</option><option value="Liberty Northwest Insurance">Liberty Northwest Insurance</option><option value="Lincoln Benefit Life">Lincoln Benefit Life</option><option value="Lumbermens Mutual">Lumbermens Mutual</option><option value="Market American">Market American</option><option value="Maryland Casualty">Maryland Casualty</option><option value="Mass Mutual">Mass Mutual</option><option value="Mega / Midwest">Mega / Midwest</option><option value="Mercury">Mercury</option><option value="Metropolitan">Metropolitan</option><option value="Mid Century Insurance">Mid Century Insurance</option><option value="Mid-Continent Casualty">Mid-Continent Casualty</option><option value="Middlesex Insurance">Middlesex Insurance</option><option value="Midland National Life">Midland National Life</option><option value="Miller Mutual">Miller Mutual</option><option value="Modern Woodmen of America">Modern Woodmen of America</option><option value="Mutual of New York">Mutual of New York</option><option value="Mutual Of Omaha">Mutual Of Omaha</option><option value="National Ben Franklin Insurance">National Ben Franklin Insurance</option><option value="National Casualty">National Casualty</option><option value="National Continental Insurance">National Continental Insurance</option><option value="National Fire Insurance">National Fire Insurance</option><option value="National Health Insurance">National Health Insurance</option><option value="National Indemnity">National Indemnity</option><option value="National Union Fire Insurance">National Union Fire Insurance</option><option value="Nationwide">Nationwide</option><option value="New York Life">New York Life</option><option value="Northwestern Mutual Life">Northwestern Mutual Life</option><option value="Northwestern Pacific Indemnity">Northwestern Pacific Indemnity</option><option value="Omni Insurance">Omni Insurance</option><option value="Orion Insurance">Orion Insurance</option><option value="Pacific Insurance">Pacific Insurance</option><option value="Pafco General Insurance">Pafco General Insurance</option><option value="Patriot General Insurance">Patriot General Insurance</option><option value="Peak Property and Casualty Insurance">Peak Property and Casualty Insurance</option><option value="PEMCO">PEMCO</option><option value="Penn Mutual">Penn Mutual</option><option value="Pennsylvania life">Pennsylvania life</option><option value="Premier">Premier</option><option value="Principal Financial">Principal Financial</option><option value="Progressive">Progressive</option><option value="Protective Life">Protective Life</option><option value="Prudential">Prudential</option><option value="RBC Liberty">RBC Liberty</option><option value="Reliance Insurance">Reliance Insurance</option><option value="Republic Indemnity">Republic Indemnity</option><option value="Response">Response</option><option value="SAFECO">SAFECO</option><option value="Safeway Insurance">Safeway Insurance</option><option value="SBLI">SBLI</option><option value="Security Insurance">Security Insurance</option><option value="Sentinel Insurance">Sentinel Insurance</option><option value="Sentry">Sentry</option><option value="Shelter">Shelter</option><option value="St. Paul">St. Paul</option><option value="Standard Fire Insurance Company">Standard Fire Insurance Company</option><option value="State and County Mutual Fire Insurance">State and County Mutual Fire Insurance</option><option value="State Auto">State Auto</option><option value="State Farm">State Farm</option><option value="State National Insurance">State National Insurance</option><option value="Superior American Insurance">Superior American Insurance</option><option value="Superior Guaranty Insurance">Superior Guaranty Insurance</option><option value="Superior Insurance">Superior Insurance</option><option value="The Ahbe Group">The Ahbe Group</option><option value="The Hartford">The Hartford</option><option value="TICO Insurance">TICO Insurance</option><option value="TIG Countrywide Insurance">TIG Countrywide Insurance</option><option value="Travelers">Travelers</option><option value="Tri-State Consumer Insurance">Tri-State Consumer Insurance</option><option value="Twin City Fire Insurance">Twin City Fire Insurance</option><option value="UniCare">UniCare</option><option value="United American/Farm and Ranch">United American/Farm and Ranch</option><option value="United Pacific Insurance">United Pacific Insurance</option><option value="United Security">United Security</option><option value="United Services Automobile Association">United Services Automobile Association</option><option value="Unitrin Direct">Unitrin Direct</option><option value="Universal Underwriters Insurance">Universal Underwriters Insurance</option><option value="US Financial">US Financial</option><option value="US Health Group">US Health Group</option><option value="USAA">USAA</option><option value="USF and G">USF and G</option><option value="Viking Insurance">Viking Insurance</option><option value="Windsor Insurance">Windsor Insurance</option><option value="Woodlands Financial Group">Woodlands Financial Group</option><option value="Zurich North America">Zurich North America</option> 
                                   </select>

                               </div>
                           </div>
                            <div class="spacer-20">
                               <!-- spacer 5px -->
                           </div>
                            <div class="g_1_4">
                               <label for="s-field-1">What is your current coverage?</label>
                           </div>
                           <div class="g_3_4_last">
                               <div class="g_1_4">
                                   <select  name="current_coverage" id="current_coverage" model="model">
                                        <option value="">-please select-</option>
                                        <option value="Superior">Superior Coverage</option><option value="Standard">Standard Coverage</option><option value="Basic">Basic Coverage</option><option value="Minimum">State Minimum Coverage</option>  
                                   </select>

                               </div>
                           </div>   
                             <div class="spacer-20">
                                <!-- spacer 5px -->
                            </div>
                            <div class="g_1_4">
                                  <label for="s-field-1">When does your policy expire</label>
                              </div>
                              <div class="g_3_4_last">
                                  <div class="g_1_4">
                                      <input type="text" id="datepicker-policyexpire" class="datepicker"  value="<?php if(isset($edit_newpayday->dob)){echo date("m-d-Y",strtotime($edit_newpayday->policy_expire_date));}?>" name="policy_expire_date">
                                 </div>
                              </div>   
                            <div class="spacer-20">
                                <!-- spacer 5px -->
                            </div>
                         <div class="g_1_4">
                                  <label for="s-field-1">How long have you been continuously insured? (any company, any policy)</label>
                              </div>
                              <div class="g_3_4_last">
                                  <div class="g_1_4">
                                       <input type="text" id="datepicker-longinsured" class="datepicker"  value="<?php if(isset($edit_newpayday->dob)){echo date("m-d-Y",strtotime($edit_newpayday->policy_expire_date));}?>" name="how_long_insured">
                                
                                  </div>
                              </div>   
                    </div>
                    
                    <div class="spacer-50">
                        <!-- spacer 5px -->
                    </div>
                     <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                     <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                     <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <hr/>
                     <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="g_1_4">
                        <label for="af-present">Ip Address: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                              <input type="text" name="ip_address" value=""  id="ip_address" data-validation-type="present" />
                        </div>
                       
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                     <div class="g_1_4">
                        <label for="af-present">Comment: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_3">
                            <textarea cols="15" rows="5" name="comment" id="comment"><?php echo $edit_newpayday->comment; ?></textarea>
                        </div>
                    </div>
                     <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    
                    
                    <hr/>

                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>
                    

                    <div class="spacer-10">
                        <!-- spacer 20px -->
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
            data: ({phonenumber: $('#phone').val(),lead_type:'insurance'}),
            success: function(data) {
                var obj = $.parseJSON(data);
                $('#phone_dup').html(obj);
                $('#fname').val(obj.fname);
                $('#lname').val(obj.lname);
                $('#address').val(obj.address);
                $('#email').val(obj.email);
                $('#zip').val(obj.zip);
                $('#datepicker-default').val(obj.birthday);
            }
       
        }); 
      }); 
      
   function find_model(val)
   {
         $.ajax({
            type: "POST",
            url: bas_url+'make/searchformodel', 
            data: ({makeid: val }),
            success: function(data) {
                $("#model_select").html(data);
            }
       
        }); 
   }
   
   function find_trim(model_id,make_id)
   {
         $.ajax({
            type: "POST",
            url: bas_url+'trim/searchtrim', 
            data: ({model_id: model_id,make_id: make_id }),
            success: function(data) {
                $("#trim_select").html(data);
            }
       
        }); 
   }
   
   function showhidediv(value)
   {
         $("#show_hide_div").toggle(1000);
         
         if(value=='yes')
             {
                $('#current_insurance_company').attr('data-validation-type', 'present');
                $('#current_coverage').attr('data-validation-type', 'present');
                $('#datepicker-policyexpire').attr('data-validation-type', 'present');
                $('#datepicker-longinsured').attr('data-validation-type', 'present');
                
             }
         else
             {
                  $('#current_insurance_company').attr('data-validation-type', '');
                  $('#current_coverage').attr('data-validation-type', '');
                  $('#datepicker-policyexpire').attr('data-validation-type', '');
                $('#datepicker-longinsured').attr('data-validation-type', '');
             }
    }
  
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
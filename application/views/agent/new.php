<div id="powerwidgetspanel" class="powerwidgetspanel">
    <div class="powerwidgetspanel-widget" data-widget-id="widget1">
        <input type="checkbox"/>
        <label>New</label>
    </div>
</div>
<div class="page-header">
    <h2>New</h2>
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
            <h2>New</h2>
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
                            <input type="text" name="zip" value="<?php echo $edit_newpayday->zip; ?>"  id="zip" data-validation-type="present" maxlength="5" data-validation-type="present" data-validation-minimum="5" data-validation-maximum="5" data-validation-label="not more and less then 5 digit" /> 
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
                            <input type="text" name="state" value="<?php echo $edit_newpayday->state;
    ; ?>"  id="state" data-validation-type="present" />
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
                        <label for="s-field-1">Make:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <select id="makename" name="makename" data-validation-type="present" onchange="find_model(this.options[selectedIndex].value);" make="make">
                                <option value="">-please select-</option>
                                 <?php foreach($makeData as $key=>$value){?>
                                <option value="<?php echo $value->make_id;?>"><?php echo $value->make_name;?></option>
                                <?php }?>
                                                  
                            </select>     </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="g_1_4">
                        <label for="s-field-1">Model:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <div id="model_select">
                            <select id="model_name" name="model_name" data-validation-type="present" model="model">
                                <option value="">-please select-</option>
                            </select>
                            </div>
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="g_1_4">
                        <label for="s-field-1">Trim:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <div id="trim_select">
                                <select id="trim_name" name="trim_name" data-validation-type="present" trim="trim">
                                    <option value="">-please select-</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
                    </div>
                    <div class="g_1_4">
                        <label for="s-field-1">Best time to call:</label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_4">
                            <select style="width:145px;" name="best_time_contact" id="best_time_contact" class="field" data-validation-type="present">
                                <option value="">Select</option>
                                <option value="Any Time">Any Time</option><option value="Morning">Morning</option><option value="Afternoon">Afternoon</option><option value="Evening">Evening</option><option value="Business Hours">Business Hours</option><option value="Weekends">Weekends</option></select>
                        </div>
                    </div>
                    <div class="spacer-20">
                        <!-- spacer 5px -->
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
                        <div class="g_1_3">
                            <textarea cols="15" rows="5" name="comment" id="comment"><?php echo $edit_newpayday->comment; ?></textarea>
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
            data: ({phonenumber: $('#phone').val(),lead_type:'new'}),
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
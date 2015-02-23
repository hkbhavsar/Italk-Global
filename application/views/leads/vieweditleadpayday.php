<?php if ($updated == 1) { ?>
    <div class="dialog warning">
        <p>Lead Updated Successfully</p>
        <span>x</span>
    </div>
<?php } ?>
<section class="g_1">            
    <div> 
        <div class="inner-spacer">  
          <form method="post"  id="form-validation-lead" autocomplete="off">
                    <div class="g_1_4">
                        <label for="af-present">Phone: *</label>
                    </div>
                    <div class="g_1_3">
                        <input type="text" name="phone" value="<?php echo $leadsData->phone; ?>"  id="phone" data-validation-type="present" />
                    </div>
                    
                    <div class="spacer-20">
                        <!-- spacer 20px -->
                    </div>

                    <div class="g_1_4">
                        <label for="af-present">First Name: </label>
                    </div>
                    <div class="g_3_4_last">
                        <div class="g_1_3" id="fname_div">
                            <input type="text" name="fname" value="<?php echo $leadsData->fname; ?>"  id="fname" data-validation-type="present" />
                        </div>
                        <div class="g_1_4" style="width:15.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Last Name: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="lname" value="<?php echo $leadsData->lname; ?>"  id="lname" data-validation-type="present" />
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
                            <input type="text" name="email" value="<?php echo $leadsData->email; ?>"  id="email" data-validation-type="present" />          
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
                            <input type="text" name="address" value="<?php echo $leadsData->address; ?>"  id="address" data-validation-type="present" /> 
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
                            <input type="text" name="city" value="<?php echo $leadsData->city;?>"  id="city" data-validation-type="present" /> 
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
                            <input type="text" name="state" value="<?php echo $leadsData->state;; ?>"  id="state" data-validation-type="present" />
                        </div>
                        <div class="g_1_4" style="width:13.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Zip: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="zip" value="<?php echo $leadsData->zip; ?>"  id="zip" data-validation-type="present" />
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
                            <input type="text" name="ssn" value="<?php echo $leadsData->ssn; ?>"  id="ssn" data-validation-type="present" />
                        </div>
                        <div class="g_1_4" style="width:13.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">UIN: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="uin" value="<?php echo $leadsData->uin; ?>"  id="uin" data-validation-type="present" />
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
                            <input type="text" id="datepicker-default"  value="<?php echo date('m-d-Y',strtotime($leadsData->dob));?>" name="dob">
                        </div>
                        <div class="g_1_4" style="width:17.5%">
                            &nbsp;&nbsp;&nbsp;<label for="af-present">Loan Amount: </label>
                        </div>
                        <div class="g_1_4">
                            <input type="text" name="loan_amount" value="<?php echo $leadsData->loan_amount; ?>"  id="loan_amount" data-validation-type="present" onkeyup="myFunction();" />
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
                            <select data-validation-type="present" name="loan_transfered">
                                <option value="">-select option-</option>
                                <option value="bank" <?php echo $leadsData->loan_transfered=='bank'?'selected="selected"':''?>>Bank</option>
                                <option value="cheque" <?php echo $leadsData->loan_transfered=='cheque'?'selected="selected"':''?>>Cheque</option>
                                <option value="other" <?php echo $leadsData->loan_transfered=='other'?'selected="selected"':''?>>Other</option>

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
                            <div><input type="text" value="<?php echo $leadsData->installments_month_12; ?>" name="install_12" id="install_12">
                            </div>
                        </section>
                        <section class="g_1_7">
                            <div><input type="text" value="<?php echo $leadsData->installments_month_24; ?>" name="install_24" id="install_24">
                            </div>
                        </section>
                        <section class="g_1_7">
                            <div><input type="text" value="<?php echo $leadsData->installments_month_36; ?>" name="install_36" id="install_36">
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
                            <div><input type="text" value="<?php echo $leadsData->interest_rate_12; ?>" name="intrest_12" id="intrest_12">
                            </div>
                        </section>
                        <section class="g_1_7">
                            <div><input type="text" value="<?php echo $leadsData->interest_rate_24 ?>" name="intrest_24" id="intrest_24">
                            </div>
                        </section>
                        <section class="g_1_7">
                            <div><input type="text" value="<?php echo $leadsData->interest_rate_36?>" name="intrest_36" id="intrest_36">
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
                            <div><input type="text" value="<?php echo $leadsData->advance_balance;?>" name="advance_balance" id="advance_balance">
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
                            <input type="text" id="datepicker-default_lead_reminder" class="datepicker" value="<?php echo date('m-d-Y',strtotime($leadsData->lead_reminder));?>" name="followupdate">
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
                            <textarea cols="15" rows="5" name="comment" id="comment"><?php echo $leadsData->comment;?></textarea>
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
                            <input type="submit" class="button-text"  value="Submit" name="edit_btn" id="edit_btn" />
                            </div>
                        <div class="spacer-15">
                            <!-- spacer 15px -->
                        </div>
                </form>
        </div>
    </div>
    <!-- End .powerwidget -->
</section>
<script>
    function submitfrmdelete(id)
    {
        $("#sbt_frm").val('1');
        $("#action_frm").val('delete_'+id);
        $("#search_form").submit();     
    }

    function submitfrmdelete_all(id)
    {
        //alert($("input:checkbox:checked"));
   
        $checkedCheckboxes = $("input:checkbox[name=ch[]]:checked");
   
        var selectedValues="";
        $checkedCheckboxes.each(function () {
            if($(this).val()!='on')
                selectedValues +=  $(this).val() +",";
        });
        $("#delete_all_msg").val('deleted');
        $("#delete_all").val(selectedValues);
        /*$("#sbt_frm").val('1');
   $("#action_frm").val('delete_'+id);
   $('form').attr('action', 'baz')
   $("#tbl_leads_submit").submit();  */   
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
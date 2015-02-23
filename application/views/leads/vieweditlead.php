<?php if($updated==1){?>
   <div class="dialog warning">
    <p>Lead Updated Successfully</p>
    <span>x</span>
   </div>
    <?php }?>
<section class="g_1">            
    <div> 
        <div class="inner-spacer">  
            <form  method="post">
              <input type="hidden" name="lead_type" value="<?php echo $lead_type;?>"> 
               <input type="hidden" name="lead_id" value="<?php echo $lead_id;?>"> 
             
                <fieldset>
                    <legend contenteditable="true">View / Edit the Lead</legend>
                    
                    <div class="g_1_4" style="width:0px">
                        <label for="af-present">Phone:</label> 
                    </div>
                    <div class="g_3_4_last">
                        <input type="text" id="af-present" name="txt_phone" value="<?php echo $leadsData->phone; ?>" data-validation-type="present" />
                    </div>
                     <div class="spacer-20"> <!-- spacer 20px --></div>
         <div class="g_1_4">
            <label for="af-present">First Name: </label>
          </div>
          <div>
            <div class="g_1_4">
            <input type="text" name="txt_fname" value="<?php echo $leadsData->fname; ?>"   />
            </div>
            <div class="g_1_4" style="width:11.5%">
            &nbsp;&nbsp;&nbsp;<label for="af-present">Last Name: </label>
          </div>
            <div class="g_1_4">
           <input type="text" name="txt_lname" value="<?php echo $leadsData->lname;?>" />
            </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>
           
            <div class="g_1_4" style="width:0px">
                <label for="af-present">Email:</label> 
            </div>
            <div class="g_3_4_last">
                <input type="text" id="af-present" name="txt_email" value="<?php echo $leadsData->email;?>" data-validation-type="present" />
            </div>
             <div class="spacer-20"> <!-- spacer 20px --></div>   
             
           <div class="g_1_4" style="width:0px">
                <label for="af-present">Address:</label> 
            </div>
            <div class="g_3_4_last">
                <textarea cols="5" rows="5" name="txt_address"><?php echo $leadsData->address;?></textarea>
            </div>
             <div class="spacer-20"> <!-- spacer 20px --></div>   
                    
          <div class="g_1_4">
            <label for="af-present">City: </label>
          </div>
          <div>
            <div class="g_1_4">
            <input type="text" id="city" name="txt_city" value="<?php  echo $leadsData->city;?>"   />
            </div>
            <div class="g_1_4" style="width:8.5%">
            &nbsp;&nbsp;&nbsp;<label for="af-present">State: </label>
          </div>
            <div class="g_1_4">
           <select name="state" class="field"   id="state" style="width:145px;">
		<option value="">Select State</option>
		  <?php 
                   $states_array=array("AL"=>"Alabama" , "AK"=>"Alaska" , "AZ"=>"Arizona" , "AR"=>"Arkansas" , "CA"=>"California" , "CO"=>"Colorado" , "CT"=>"Connecticut" , "DE"=>"Delaware" , "FL"=>"Florida" , "GA"=>"Georgia" , "HI"=>"Hawaii" , "ID"=>"Idaho" , "IL"=>"Illinois" , "IN"=>"Indiana" , "IA"=>"Iowa" , "KS"=>"Kansas" , "KY"=>"Kentucky" , "LA"=>"Louisiana" , "ME"=>"Maine" , "MD"=>"Maryland" , "MA"=>"Massachusetts" , "MI"=>"Michigan" , "MN"=>"Minnesota" , "MS"=>"Mississippi" , "MO"=>"Missouri" , "MT"=>"Montana" , "NE"=>"Nebraska" , "NV"=>"Nevada" , "NH"=>"New Hampshire" , "NJ"=>"New Jersey" , "NM"=>"New Mexico" , "NY"=>"New York" , "NC"=>"North Carolina" , "ND"=>"North Dakota" , "OH"=>"Ohio" , "OK"=>"Oklahoma" , "OR"=>"Oregon" , "PA"=>"Pennsylvania" , "PR"=>"Puerto Rico" , "RI"=>"Rhode Island" , "SC"=>"South Carolina" , "SD"=>"South Dakota" , "TN"=>"Tennessee" , "TX"=>"Texas" , "UT"=>"Utah" , "VT"=>"Vermont" , "VA"=>"Virginia" , "WA"=>"Washington" , "DC"=>"Washington D.C." , "WV"=>"West Virginia" , "WI"=>"Wisconsin" , "WY"=>"Wyoming" );

                   foreach($states_array as $keys=>$values){
                            $selected = '';
                            if($keys == $leadsData->state)	
                                    $selected = 'selected';
                            echo '<option value="'.$keys.'" '.$selected.'>'.$keys.'</option>';
                          } 
                                    ?>
		</select>
           
            </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>  
             
           <div class="g_1_4">
            <label for="af-present">Zip: </label>
          </div>
          <div>
            <div class="g_1_4">
            <input type="text" name="txt_zip" id="zip" value="<?php echo $leadsData->zip;?>"   />
            </div>
            <div class="g_1_4" style="width:8.5%">
            &nbsp;&nbsp;&nbsp;<label for="af-present">DOB: </label>
          </div>
            <div class="g_1_4">
           <input type="text" id="datepicker-default" name="dob" value="<?php echo $leadsData->birth_date;?>" />
            </div>
          </div>
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div>    
           
          <div class="g_1_4" style="width:0px">
                <label for="af-present">Rent/Own:</label> 
            </div>
            <div class="g_3_4_last">
               <section class="g_2_7">
                <select name="rent_own" class="field" style="width:145px;">
		<option value="rent" <?php if($leadsData->rent_own == 'rent') echo 'selected';?>>Rent</option>
		<option value="own" <?php if($leadsData->rent_own == 'own') echo 'selected';?>>Own</option>
		</select>
                </section>
            </div>
            
          <div class="spacer-20">
            <!-- spacer 20px -->
          </div> 
            
           <div class="g_1_3" style="width:0px">
                <label for="af-present">Yrs. Residency:</label> 
            </div>
            <?php
            
                list($emp_year,$emp_month,$emp_day) = explode('-',$leadsData->month_with_company);
				list($year_resi,$month_resi,$day_resi) = explode('-',$leadsData->year_residence);
		//list($next_pay_year,$next_pay_month,$next_pay_day) = explode('-',$leadsData->next_pay);
		//list($last_pay_year,$last_pay_month,$last_pay_day) = explode('-',$leadsData->last_pay);
				//echo "Hardik-->".$year_resi;exit;
            ?>    
             
            <div class="g_3_4_last">
                 <section class="g_2_7">
                                <div >
                                    <select name="year_resi" class="field"   style="width:45px">
		  <?php	
	$year_array=array("00"=>"00","01"=>"01","02"=>"02","03"=>"03","04"=>"04","05"=>"05","06"=>"06","07"=>"07","08"=>"08","09"=>"09","10"=>"10","11"=>"11","12"=>"12","13"=>"13","14"=>"14","15"=>"15","16"=>"16","17"=>"17","18"=>"18","19"=>"19","20"=>"20");	
						foreach( $year_array as $keys => $values){
								$selected = '';
								
								if($keys == $year_resi)	
									$selected = 'selected';
							echo '<option value="'.$keys.'" '.$selected.'>'.$values .'</option>';
						}						
					?>
		</select> Year
                                </div>          
                            </section> 
                 <section class="g_2_7">
                                <div >
                                    <select name="month_resi" class="field"   style="width:45px">
			<?php	//$month=array("00"=>"01","01"=>"02","02"=>"03","03"=>"04","04"=>"05","05"=>"06","06"=>"07","07"=>"08","08"=>"09","09"=>"10","10"=>"11","11"=>"12");
	$month_array=array("00"=>"00","01"=>"01","02"=>"02","03"=>"03","04"=>"04","05"=>"05","06"=>"06","07"=>"07","08"=>"08","09"=>"09","10"=>"10","11"=>"11","12"=>"12");
	//$month=array("01"=>"January","02"=>"Febuary","03"=>"March","04"=>"April","05"=>"May","06"=>"June","07"=>"July","08"=>"August","09"=>"September","10"=>"October","11"=>"November","12"=>"December");
							foreach( $month_array as $keys => $values){
								$selected = '';
								if($keys == $month_resi)	
									$selected = 'selected';
								echo '<option value="'.$keys.'" '.$selected.'>'.$values .'</option>';					
							}
					?>
		  </select> Months
                                </div>          
                            </section> 
                
            </div>
             <div class="spacer-20"> <!-- spacer 20px --></div>
             
          <div class="g_1_4">
            <label for="af-present">Home Pay: </label>
          </div>
          <div>
            <div class="g_1_4">
            <input type="text" name="txt_homepay" value="<?php echo $leadsData->home_pay;?>"   />
            </div>
            <div class="g_1_4" style="width:12.5%">
            &nbsp;&nbsp;&nbsp;<label for="af-present">Employer: </label>
          </div>
            <div class="g_1_4">
           <input type="text" name="txt_employer" value="<?php echo $leadsData->employer;?>" />
            </div>
          </div>
          <div class="spacer-20"><!-- spacer 20px --></div> 
          
          <div class="g_1_4">
            <label for="af-present">Occupation : </label>
          </div>
          <div>
            <div class="g_1_4">
            <input type="text" name="txt_occupation" value="<?php echo $leadsData->job_title;?>"   />
            </div>
            <div class="g_1_4" style="width:13.5%">
            &nbsp;&nbsp;&nbsp;<label for="af-present">Work Phone: </label>
          </div>
            <div class="g_1_4">
           <input type="text" name="txt_workphone" value="<?php echo $leadsData->work_number;?>" />
            </div>
          </div>
          <div class="spacer-20"><!-- spacer 20px --></div>

          <div class="g_1_3" style="width:0px">
                <label for="af-present">Yrs. Employment:</label> 
            </div>
            <div class="g_3_4_last">
                <section class="g_2_7">
                                <div >
                                    <select name="year_resi" class="field"   style="width:45px">
		  <?php	
	$year_array=array("00"=>"00","01"=>"01","02"=>"02","03"=>"03","04"=>"04","05"=>"05","06"=>"06","07"=>"07","08"=>"08","09"=>"09","10"=>"10","11"=>"11","12"=>"12","13"=>"13","14"=>"14","15"=>"15","16"=>"16","17"=>"17","18"=>"18","19"=>"19","20"=>"20");	
						foreach( $year_array as $keys => $values){
								$selected = '';
								
								if($keys == $emp_year)	
									$selected = 'selected';
							echo '<option value="'.$keys.'" '.$selected.'>'.$values .'</option>';
						}						
					?>
		</select> Year
                                </div>          
                            </section> 
                 <section class="g_2_7">
                                <div >
                                    <select name="month_resi" class="field"   style="width:45px">
			<?php	//$month=array("00"=>"01","01"=>"02","02"=>"03","03"=>"04","04"=>"05","05"=>"06","06"=>"07","07"=>"08","08"=>"09","09"=>"10","10"=>"11","11"=>"12");
	$month_array=array("00"=>"00","01"=>"01","02"=>"02","03"=>"03","04"=>"04","05"=>"05","06"=>"06","07"=>"07","08"=>"08","09"=>"09","10"=>"10","11"=>"11","12"=>"12");
	//$month=array("01"=>"January","02"=>"Febuary","03"=>"March","04"=>"April","05"=>"May","06"=>"June","07"=>"July","08"=>"August","09"=>"September","10"=>"October","11"=>"November","12"=>"December");
							foreach( $month_array as $keys => $values){
								$selected = '';
								if($keys == $emp_month)	
									$selected = 'selected';
								echo '<option value="'.$keys.'" '.$selected.'>'.$values .'</option>';					
							}
					?>
		  </select> Months
                                </div>          
                            </section> 
            </div>
             <div class="spacer-20"> <!-- spacer 20px --></div>
        <div class="g_1_4">
            <label for="af-present"> Monthly Income : </label>
          </div>
          <div>
            <div class="g_1_4">
            <input type="text" name="txt_monthlyincome" value="<?php echo $leadsData->monthly_income;?>"   />
            </div>
            <div class="g_1_4" style="width:13.5%">
            &nbsp;&nbsp;&nbsp;<label for="af-present">Co Signer : </label>
          </div>
            <div class="g_1_4">
           <select name="co_sign" class="field" style="width:145px;">
		<option value="">Select Co Sign</option>
		<option value="no" <?php if($leadsData->cosigner == 'no') echo 'selected';?>>No</option>
		<option value="yes" <?php if($leadsData->cosigner == 'yes') echo 'selected';?>>Yes</option>
		</select>
            </div>
          </div>
          <div class="spacer-20"><!-- spacer 20px --></div> 
          
           <div class="g_1_3" style="width:0px">
                <label for="af-present">Bankruptcy:</label> 
            </div>
            <div class="g_3_4_last">
                <section class="g_2_7">
                <select name="bankrupt" class="field" style="width:145px;">
		<option value="no" <?php if($leadsData->bankruptcy == 'no') echo 'selected';?>>No</option>
		<option value="yes" <?php if($leadsData->bankruptcy == 'yes') echo 'selected';?>>Yes</option>
		</select>
                </section>
            </div>
             <div class="spacer-20"> <!-- spacer 20px --></div>
            
          <div class="g_1_4">
            <label for="af-present"> SSN  : </label>
          </div>
          <div>
            <div class="g_1_4">
            <input type="text" name="txt_ssn" value="<?php echo $leadsData->ssn;?>"   />
            </div>
            <div class="g_1_4" style="width:13.5%">
            &nbsp;&nbsp;&nbsp;<label for="af-present">Loan Amount  : </label>
          </div>
            <div class="g_1_4">
           <input type="text" name="loan_amount" value="<?php echo $leadsData->loan_amount;?>" />
            </div>
          </div>
          <div class="spacer-20"><!-- spacer 20px --></div> 
          
          <div class="g_1_4">
            <label for="af-present"> Down Payment  : </label>
          </div>
          <div>
            <div class="g_1_4">
            <input type="text" name="down_pay" value="<?php //echo $leadsData->down_pay;?>"   />
            </div>
            <div class="g_1_4" style="width:13.5%">
            &nbsp;&nbsp;&nbsp;<label for="af-present">Credit Rating  : </label>
          </div>
            <div class="g_1_4">
                <section class="g_5_7">
            <select name="credit_rating" class="field">
		<option value="">Select Credit Rating</option>
		<option value="Poor" <?php if($leadsData->credit_score == 'Poor') echo 'selected';?>>Poor</option>
		<option value="Good" <?php if($leadsData->credit_score == 'Good') echo 'selected';?>>Good</option>
		<option value="Fair" <?php if($leadsData->credit_score == 'Fair') echo 'selected';?>>Fair</option>
		<option value="Excellent" <?php if($leadsData->credit_score == 'Excellent') echo 'selected';?>>Excellent</option>
		</select>
                </section>
            </div>
          </div>
          <div class="spacer-20"><!-- spacer 20px --></div> 
          
          <div class="g_1_3" style="width:0px">
                <label for="af-present">Comment:</label> 
            </div>
            <div class="g_3_4_last">
                <textarea cols="10" rows="10" name="comment"><?php echo $leadsData->comment;?></textarea>
            </div>
             <div class="spacer-20"> <!-- spacer 20px --></div>
          
          <div class="g_1_3" style="width:0px">
                <label for="af-present">Comment Admin:</label> 
            </div>
            <div class="g_3_4_last">
                <textarea cols="10" rows="10" name="comment_admin"><?php echo $leadsData->comment_admin;?></textarea>
            </div>
             <div class="spacer-20"> <!-- spacer 20px --></div>
        
        <div class="g_1_3" style="width:0px">
                <label for="af-present">Status:</label> 
            </div>
            <div class="g_3_4_last">
                <select style="width:145px;" class="field" name="status_lead">
			<option value="">Select Status</option>
					<option value="Approved">Approved</option><option value="Reject">Reject</option><option value="No Placement">No Placement</option><option value="Internal Reject">Inernal Reject</option>		
                </select>
            </div>
             <div class="spacer-20"> <!-- spacer 20px --></div>
          
          <div class="submit-cancel-button">
            <input type="submit" id="search_btn" name="edit_btn" value="Update" class="button-text">
            </div>
         
                    </tbody>
                </table>
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
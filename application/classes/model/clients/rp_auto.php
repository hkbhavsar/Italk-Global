<?php
	$objLeads_submit = ORM::factory('leadsubmit');
      $ping_url = 'https://leads.bi-coastalmedia.com/api.php';//DynamicPricePing
      $post_url = 'https://leads.bi-coastalmedia.com/api.php';
      $header = array('Content-Type: application/x-www-form-urlencoded') ;//'Content-Type: application/x-www-form-urlencoded'; 
      $zip = urlencode($lead_data->zip);
      $income = urlencode($lead_data->monthly_income);
      $ssn = str_pad($lead_data->ssn, 9 , 0,STR_PAD_LEFT);
      $lead_type_id = 5;
      $IsTest = 'false';
      
      $SubId ='9999';
      $loan_type = 'Dealer Purchase';
      $address = $lead_data->address;
      $email = $lead_data->email;
      $first_name = urlencode($lead_data->fname);
      $last_name = urlencode($lead_data->lname);
      $home_phone=urlencode($lead_data->phone);
      $ip_address=urlencode($lead_data->ip_address);
      $privacy_accept='true';
      $last_name = urlencode($lead_data->lname);
      $work_phone=urlencode($lead_data->work_number);
      $bankruptcy = (urlencode($lead_data->bankruptcy)=='' ||urlencode($lead_data->bankruptcy)=='no')?'false':'true';
      $dob = date('m/d/Y',strtotime($lead_data->birth_date));
      $employer_month = urlencode($lead_data->month_with_company);
      $employer_name = $lead_data->employer;
      $employer_year = urlencode($lead_data->year_with_company)==''?1:$lead_data->year_with_company;
      $job_title = $lead_data->job_title;
      $ResidenceCost=urlencode($lead_data->home_pay);
      $ResidenceMonths=urlencode($lead_data->month_residence)==''?1:$lead_data->month_residence;
      $ResidenceType=urlencode($lead_data->rent_own);
      $ResidenceYears=urlencode($lead_data->year_residence);
      $monthly_income = urlencode($lead_data->monthly_income);
      $HousePayment = urlencode($lead_data->rent_payment);
      $city = $lead_data->city;
      $state = $lead_data->state;
      $mobile = urlencode($lead_data->mobile);
      $cosigner = (urlencode($lead_data->cosigner)=='' ||urlencode($lead_data->cosigner)=='no')?'false':'true';
      $TrackingID='';
      $SubID1='';
      $SubID2='';
      $SubID3='';
      $domain = 'www.domain.com';
      $ResidenceYears_temp = explode("-",$ResidenceYears);
      $employer_month_temp = explode("-",$employer_month);
      if(current($ResidenceYears_temp)==0)
          $ResidenceYears_value=1;
      else
          $ResidenceYears_value = current($ResidenceYears_temp);
        $PingID='';
	  $key = 'ulr890I7tFnAwFbXR2wotfNkwBYBRlt.tlsHw.crRfqPw.Of95tKv.Oz4Mii';
	 $zip='99999';
	 $ssn='999999999';
	  $ping_data = 'Key='.$key.'&API_Action=pingPostLead&Mode=ping&TYPE=67&SRC=abmkt_afd&State='.$state.'&Zip='.$zip.'&SSN='.$ssn.'&Monthly_Income='.$monthly_income.'&Test_Lead=1&Return_Best_Price=1';
      //$ping_data = 'Username='.$username.'&Passphrase='.$passcode.'&Zip='.$zip.'&SSN='.$ssn.'&MonthlyIncome='.$monthly_income;
      $ping_res = $this->curlposting($ping_url, $ping_data, $header);
        $myFile_post = "ping_post_request/ping_rp_auto".$lead_data->lead_auto_id.".txt";
        $fh_post = fopen($myFile_post, 'w') or die("can't open file");
        $file_string_post = "Ping URL::>".$ping_url."\n\n";
        $file_string_post.= "Ping Data::>".$ping_data."\n\n";
        $file_string_post.= "Ping Result::>".$ping_res."\n\n";                           
        fwrite($fh_post, $file_string_post);
        fclose($fh_post);
        $return_ping = 0;
        $objLeads_submit->ping_response ='Success';
        preg_match('/<status>(.*)<\/status>/' , $ping_res , $ping_status);
        preg_match('/<lead_id>(.*)<\/lead_id>/' , $ping_res , $lead_id);
        preg_match('/<price>(.*)<\/price>/' , $ping_res , $price);
         //print_r($ping_res); echo "<br>=====================<br>";
                //print_r($ping_status[1]);
     if($ping_status[1]=='Matched')
     { 
                //echo "in POST";
        //$post_data='providerId='.$provider_id.'&providerData=&guid='.$ResponseID[1].'&firstName='.$first_name.'&lastName='.$last_name.'&address='.$address.'&city='.$city.'&state='.$state.'&zipCode='.$zip.'&homePhone='.$home_phone.'&workPhone='.$work_phone.'&workPhoneExt=&mobilePhone='.$home_phone.'&email='.$email.'&make=Dodge&model=RAM 1500&trim=SLT&interiorColor=black&exteriorColor=Pearl Blue&timeframe=One Week&financing=Cash&contactTime=Any';
		
		$post_data = 'Key='.$key.'&API_Action=pingPostLead&Mode=post&Lead_ID='.$lead_id[1].'&TYPE=67&IP_Address='.$ip_address.'&Landing_Page=landing&First_Name='.$first_name.'&Last_Name='.$last_name.'&Address='.$address.'&City='.$city.'&Email='.$email.'&Phone='.$home_phone.'&Alternate_Phone='.$home_phone.'&CoSigner=Yes&DOB='.$dob.'&Months_At_Residence='.$ResidenceMonths.'&Years_At_Residence='.$ResidenceYears_value.'&Monthly_Mortgage_Or_Rent='.$ResidenceCost.'&Rent_Or_Own='.ucfirst($ResidenceType).'&Bankruptcy=No&Employer='.$employer_name.'&Occupation='.$job_title.'&State='.$state.'&Zip='.$zip.'&SSN='.$ssn.'&Monthly_Income='.$monthly_income.'&Credit_Check_Authorized=Yes&Years_Employed='.$employer_year.'&Months_Employed='.current($employer_month_temp);
		
		//$post_data='providerID='.$provider_id.'&guid='.$ResponseID[1].'&firstName='.$first_name.'&lastName='.$last_name.'&address='.$address.'&address2=&city='.$city.'&state='.$state.'&zipCode='.$zip.'&homePhone='.$home_phone.'&workPhone='.$work_phone.'&workPhoneExt=&mobilePhone='.$mobile.'&email='.$email.'&birthDate='.$dob.'&ssn='.$ssn.'&gender=&grossMonthlyIncome='.$monthly_income.'&residence='.ucfirst($ResidenceType).'&yearsAtResidence='.$ResidenceYears_value.'&monthsAtResidence='.$ResidenceMonths.'&residenceMonthlyPayment='.$ResidenceCost.'&employer='.$employer_name.'&employerPhone='.$work_phone.'&jobTitle='.$job_title.'&yearsAtEmployer='.$employer_year.'&monthsAtEmployer='.current($employer_month_temp).'&ipAddress='.$ip_address.'&cosignerAvailable=false&bankruptcy=false&creditAuthorization=true&forwardApplicationAuthorization=true&privacyAccept=true';
		
        $post_res = $this->curlposting($post_url, $post_data, $header); 
            preg_match('/<status>(.*)<\/status>/' , $post_res , $status_post);
            preg_match('/<Error>(.*)<\/Error>/' , $post_res , $error);
                        //print_r($post_res); echo "<br>=====================<br>";
                        //print_r($status_post);
            $myFile_post = "ping_post_request/post_rp_auto".$lead_data->lead_auto_id.".txt";
            $fh_post = fopen($myFile_post, 'w') or die("can't open file");
            $file_string_post = "Post URL::>".$post_url."\n\n";
            $file_string_post.= "Post Data::>".$post_data."\n\n";
            $file_string_post.= "Post Result::>".$post_res."\n\n";                           
            fwrite($fh_post, $file_string_post);
            fclose($fh_post);
            if($status_post[1] == 'Matched'){	
                $post_response = 'DM_Auto (RAN)-Accepted Price:' .$price[1];
                $return_post = false;
                $objLeads_submit->post_response ='Success';
                $objLeads_submit->ping_response ='Success';
                $objLeads_submit->price = $price[1];
            }else{
                    $post_response = 'DM_Auto (RAN)-Rejected';
                    $return_post = true;//Call the other function
                    $objLeads_submit->post_response ='Fail';
                    $objLeads_submit->ping_response ='Success';
                    $objLeads_submit->price = 0;
                    $leadassign = 1;
            }
     }
    else // Lead Rejected
      {
          $ping_response ='DM_Auto (RAN) Ping Rejected';
          $comment_admin = ', DM_Auto (RAN))-Rejected';
          $post_response = 'N/A';
          $post_request = '-';
          $leadassign = 1;
          $return_ping = true;//Call the other function
          $objLeads_submit->ping_response ='Fail';
          $objLeads_submit->post_response ='Fail';
      }
        $objLeads_submit->lead_id =$lead_data->lead_auto_id;
        $objLeads_submit->client_id =29;
        $objLeads_submit->lead_types ='Auto';
        $objLeads_submit->c_date=$lead_data->c_date;
        $objLeads_submit->save();
    if($multiple!=1)
         {
            echo '<tr>
                  <td width="1%"><a href="#">'.$lead_data->lead_auto_id.'</a></td>
                  <td>Auto</td>
                  <td>'.$email_address.'</td>
                  <td>'.$home_phone.'</td>
                  <td>'.$ssn.'</td>
                  <td>'.$ping_response.' <a class="tag red" href="'.Kohana::$base_url.$myFile_ping_response.'" target="_blank">View</a></td>
                  <td>'.$post_request.' '.$post_response.'</td>
                  <td>'.$price[1].'</td>
                </tr>';
         }
         else
         {
            $return_array['ping_response'] =  $return_ping;
            $return_array['post_response'] = $return_post;
            $return_array['price'] = $price[1];
            return $return_array;
         }
       exit;
?>
<?php

      //echo "<pre>";
      //print_r($lead_data);
      
    $objLeads_submit = ORM::factory('leadsubmit');
    $url_1 = 'http://dev.automotivefinancingsolutions.com/ping.aspx'; //test
    $url_2 = 'http://dev.automotivefinancingsolutions.com/post.aspx'; //test

    //$url_1 = 'http://prod.automotivefinancingsolutions.com/ping.aspx'; //live
    //$url_2 = 'http://prod.automotivefinancingsolutions.com/post.aspx'; //live
    //$home_address_zip = "99999";
    //$ssn = "999999999";
    $price = 'PPPPPP';
    $ssn = str_pad($lead_data->ssn, 9 , 0,STR_PAD_LEFT);
    $home_address_zip = $lead_data->zip;
    $monthly_income = $lead_data->monthly_income;
    $first_name = $lead_data->fname;
    $last_name = $lead_data->lname;
    $email_address = $lead_data->email;
    $res_address1 = $lead_data->address;
    $res_city = $lead_data->city;
    $res_state = $lead_data->state;
    $home_phone = $lead_data->phone;
    $work_phone = $lead_data->work_number;	
    $mobile_phone =$lead_data->mobile;
    list($birth_year , $birth_month , $birth_day) = explode("-",$lead_data->birth_date);

    $monthsAtResidence = (int)$lead_data->month_residence;
    $yearsAtResidence = (int) $lead_data->year_residence;
    $residence_status = strtolower($lead_data->rent_own);
    $yearsAtEmployer = (int) substr($lead_data->month_with_company,0 , 2);
    $monthsAtEmployer = (int) substr($lead_data->month_with_company,3 , 2);
    $employer_name = $lead_data->employer;
    $job_title = $lead_data->job_title;
    //$monthly_payment = $lead_data->home_pay;
    $bankruptcy = 'False';
    if($lead_data->cosigner == 'yes')
            $cosigner = 'True';
    elseif($lead_data->cosigner == 'no')
            $cosigner = 'False';
    $opt_in = '1';
    $ip_address = $lead_data->ip_address;
    $date_of_birth = $lead_data->birth_date;
    $dob = date('m/d/Y',strtotime($date_of_birth));
    $time_of_contact = $lead_data->time_to_contact;
    $loan_type = 'loan';
    $vendor_id = '168';
    $leadtype_id = '13';
    $ping_data = '<?xml version="1.0" encoding="UTF-8" ?> 
					 <DocumentElement>
					 <LeadMinimal>
    				 <SSN>'.$ssn.'</SSN>
    				 <ZIP>'.$home_address_zip.'</ZIP>
    				 <GMI>'.$monthly_income.'</GMI>
   					 <VendorId>'.$vendor_id.'</VendorId>
    				 <LeadTypeId>'.$leadtype_id.'</LeadTypeId>
  					 </LeadMinimal>
					 </DocumentElement>';
					 
    $post_data = '<?xml version="1.0" encoding="UTF-8" ?> 
					<DocumentElement>
					<Lead>
			        <L_LEADID>RRRRRRR</L_LEADID>
				    <SSN>'.$ssn.'</SSN>
				    <ZIP>'.$home_address_zip.'</ZIP>
				    <GMI>'.$monthly_income.'</GMI>
				    <VendorId>'.$vendor_id.'</VendorId>
				    <LeadTypeId>'.$leadtype_id.'</LeadTypeId>
				    <address>'.$res_address1.'</address>
				    <authorizeCreditCheck>True</authorizeCreditCheck>
				    <bankruptcy7Years>'.$bankruptcy.'</bankruptcy7Years>
					<city>'.$res_city.'</city>
				    <cosignerAvailable>True</cosignerAvailable>
				    <dob>'.$dob.'</dob>
				    <email>'.$email_address.'</email>
				    <empMonths>'.$monthsAtEmployer.'</empMonths>
				    <empName>'.$employer_name.'</empName>
				    <empYears>'.$yearsAtEmployer.'</empYears>
				    <firstName>'.$first_name.'</firstName>
				    <homePhone>'.$home_phone.'</homePhone>
				    <jobTitle>'.$job_title.'</jobTitle>
				    <lastName>'.$last_name.'</lastName>
				    <monthlyHousingPayment>'.$monthly_payment.'</monthlyHousingPayment>
				    <rentown>True</rentown>
				    <resMonths>'.$monthsAtResidence.'</resMonths>
				    <resYears>'.$yearsAtResidence.'</resYears>
				    <state>'.$res_state.'</state>
				    <workPhone>'.$work_phone.'</workPhone>
				    <cellPhone>'.$work_phone.'</cellPhone>
				    <IP_Address>'.$ip_address.'</IP_Address>
				    <byear>'.$birth_year.'</byear>
				    <bmonth>'.$birth_month.'</bmonth>
				    <bday>'.$birth_day.'</bday>
				    <forward_application>True</forward_application>
				    <agreed>True</agreed>
				    <carMake></carMake>
				    <carModel></carModel>
				    <contactTime>'.$time_of_contact.'</contactTime>
				    <otherIncome></otherIncome>
				    <loanAmount></loanAmount>
				    <FICO>700</FICO>
				    <EmailOptIn>True</EmailOptIn>
				    <ResidenceDate></ResidenceDate>
				    <EmployerStartDate></EmployerStartDate>
				    <sub_vendor_Id></sub_vendor_Id>
					</Lead>
					</DocumentElement>';			 

			$header = array();
			$header[] = "Content-Type: text/xml"; 
			$header[] .= "Content-Length: ".strlen($ping_data);
                        
    $res_1 = $this->curlposting($url_1, $ping_data, $header);                    
    $myFile_ping_response = "ping_post_request/ping_afsauto".$lead_data->lead_auto_id.".txt";
    $fh = fopen($myFile_ping_response, 'w') or die("can't open file");
    $file_string = "Ping URL::>".$url_1."\n\n";
    $file_string.= "Ping Data::>".$ping_data."\n\n";
    $file_string.= "Ping Response::>".$res_1."\n\n";
    fwrite($fh, $file_string);
    fclose($fh);
    
    preg_match('/<Status>(.*)<\/Status>/' , $res_1 , $status_1);
    preg_match('/<Price>(.*)<\/Price>/' , $res_1 , $price);
    preg_match('/<MAXTIME>(.*)<\/MAXTIME>/' , $res_1 , $maxtime);
    preg_match('/<L_LEADID>(.*)<\/L_LEADID>/' , $res_1 , $leadid);
    preg_match('/<Message>(.*)<\/Message>/' , $res_1 , $message );
    
    if($status_1[1] == 'Accepted') // Ping Response Success
	{
                $post_data = str_replace('RRRRRRR' ,$leadid[1], $post_data);
                $header1 = array();
                $header1[] = "Content-Type: text/xml"; 
                $header1[] .= "Content-Length: ".strlen($post_data);
                $res_2 = $this->curlposting($url_2, $post_data, $header1);
                preg_match('/<Status>(.*)<\/Status>/' , $res_2 , $status_2);
                preg_match('/<L_LEADID>(.*)<\/L_LEADID>/' , $res_2 , $leadid2);
                preg_match('/<Message>(.*)<\/Message>/' , $res_2 , $message2);
                
                $myFile_post = "ping_post_request/post_afsauto".$lead_data->lead_auto_id.".txt";
                $fh_post = fopen($myFile_post, 'w') or die("can't open file");
                $file_string_post = "Post URL::>".$url_2."\n\n";
                $file_string_post.= "Post Data::>".$post_data."\n\n";
                $file_string_post.= "Post Result::>".$res_2."\n\n";                           
                fwrite($fh_post, $file_string_post);
                fclose($fh_post);
                
                $ping_response ='Accepted with Price:'.$price[1];
		$post_request = '<a href="'.Kohana::$base_url.$myFile_post.'" target="_blank">View Request</a>';
                $return_ping = 0;
                $objLeads_submit->ping_response ='Success';

                if($status_2[1] == 'Accepted'){		
                        $post_response = 'AFS Auto-Accepted Price:' . $price[1];
                        $objLeads_submit->post_response ='Success';
                        $objLeads_submit->price = $price[1];
                        

                }else{
                        $post_response = 'AFSAUTO-Rejected';
                        $return_post = true;//Call the other function
                        $objLeads_submit->post_response ='Fail';
                        $objLeads_submit->price = 0;
                        $leadassign = 1;
                }	
        }
        else // Lead Rejected
        {
            $ping_response ='Ping Rejected';
            $comment_admin = ', AFS Auto-Rejected';
            $post_response = 'N/A';
            $post_request = '-';
            $leadassign = 1;
            $return_ping = true;//Call the other function
            $objLeads_submit->ping_response ='Fail';
            $objLeads_submit->post_response ='Fail';
        }
        $objLeads_submit->lead_id =$lead_data->lead_auto_id;
        $objLeads_submit->client_id =1;
        $objLeads_submit->lead_types='Auto';
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
                  <td>'.$post_request.'</td>
                  <td>'.$post_response.'</td>
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

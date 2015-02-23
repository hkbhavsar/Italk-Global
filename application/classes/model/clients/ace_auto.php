<?php

      //echo "<pre>";
      //print_r($lead_data);
      
    $objLeads_submit = ORM::factory('leadsubmit');
    $url_1 = 'https://www.fundingway.com/ace/AutoFinancePing.php'; //test
    $url_2 = 'https://www.fundingway.com/ace/AutoFinancePost.php'; //test

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
    $AffiliateID = 'ap001481';
    $Password = 'cm1481';
	
	 $ping_data = '<?xml version="1.0" encoding="UTF-8" ?> 
					<AutoFinancePing>
						<AffiliateID>'.$AffiliateID.'</AffiliateID>
						<Password>'.$Password.'</Password>
						<ZipCode>'.$home_address_zip.'</ZipCode>
						<Country>USA</Country>
						<Tier>dynamic</Tier> 
						<SSN>'.$ssn.'</SSN>  
						<MonthlyIncome>'.$monthly_income.'</MonthlyIncome>
						<TestMode>true</TestMode>
					</AutoFinancePing>'; 
		
		$post_data = '<?xml version="1.0" encoding="UTF-8" ?> 
			<AutoFinanceLead> 
				<AffiliateID>'.$AffiliateID.'</AffiliateID> 
				<Password>'.$Password.'</Password> 
				<Tier>dynamic</Tier>
				<ReservationCode>RRRRRRR</ReservationCode> 
				<PassThrough>passthrough</PassThrough> 
				<LeadDate>'.date('Y-m-d h:i:s').'</LeadDate>
				<LeadID>6543210</LeadID>
				<FirstName>'.$first_name.'</FirstName> 
				<MiddleInitial>T</MiddleInitial>
				<LastName>'.$last_name.'</LastName> 
				<SSN>'.$ssn.'</SSN> 
				<BirthMonth>'.$birth_month.'</BirthMonth> 
				<BirthDay>'.$birth_day.'</BirthDay> 
				<BirthYear>'.$birth_year.'</BirthYear> 
				<HomePhone>'.$home_phone.'</HomePhone>
				<WorkPhone>'.$work_phone.'</WorkPhone>
				<CellPhone>'.$work_phone.'</CellPhone>
				<EmailAddress>'.$email_address.'</EmailAddress> 
				<BestContactMethod>Email</BestContactMethod> 
				<BestContactTime>Morning</BestContactTime>
				<YearsAtAddress>'.$yearsAtResidence.'</YearsAtAddress>
				<MonthsAtAddress>'.$monthsAtResidence.'</MonthsAtAddress>
				<StreetAddress>'.$res_address1.'</StreetAddress>
				<City>'.$res_city.'</City>
				<State>'.$res_state.'</State>
				<ZipCode>'.$home_address_zip.'</ZipCode>
				<Country>USA</Country>
				<ResidenceType>'.$res_state.'</ResidenceType> 
				<HousingPayment>'.$monthly_payment.'</HousingPayment>
				<EmploymentType>W2 Employee</EmploymentType>
				<YearsAtEmployer>'.$yearsAtEmployer.'</YearsAtEmployer>
				<MonthsAtEmployer>'.$monthsAtEmployer.'</MonthsAtEmployer>
				<Employer>'.$employer_name.'</Employer> 
				<Occupation>'.$job_title.'</Occupation> 
				<EmployerPhone>'.$work_phone.'</EmployerPhone>
				<MonthlyIncome>'.$monthly_income.'</MonthlyIncome>
				<HaveCheckingAccount>Y</HaveCheckingAccount>
				<HaveSavingsAccount>Y</HaveSavingsAccount>
				<DownPayment>2500</DownPayment>
				<Authorization>yes</Authorization>
				<OptOut>Y</OptOut>
				<IPAddress>'.$ip_address.'</IPAddress>
			</AutoFinanceLead>

		';			 
    		 

			$header = array();
			$header[] = "Content-Type: text/xml"; 
			$header[] .= "Content-Length: ".strlen($ping_data);
                        
    $res_1 = $this->curlposting($url_1, $ping_data, $header);                    
    $myFile_ping_response = "ping_post_request/ping_ace_auto".$lead_data->lead_auto_id.".txt";
    $fh = fopen($myFile_ping_response, 'w') or die("can't open file");
    $file_string = "Ping URL::>".$url_1."\n\n";
    $file_string.= "Ping Data::>".$ping_data."\n\n";
    $file_string.= "Ping Response::>".$res_1."\n\n";
    fwrite($fh, $file_string);
    fclose($fh);
    
    preg_match('/<Accept>(.*)<\/Accept>/' , $res_1 , $status_1);
    preg_match('/<Price>(.*)<\/Price>/' , $res_1 , $price);
    preg_match('/<ReservationCode>(.*)<\/ReservationCode>/' , $res_1 , $leadid);
    preg_match('/<Reason>(.*)<\/Reason>/' , $res_1 , $message );
    
    if($status_1[1] == 'yes') // Ping Response Success
	{
                $post_data = str_replace('RRRRRRR' ,$leadid[1], $post_data);
                $header1 = array();
                $header1[] = "Content-Type: text/xml"; 
                $header1[] .= "Content-Length: ".strlen($post_data);
                $res_2 = $this->curlposting($url_2, $post_data, $header1);
                preg_match('/<Accept>(.*)<\/Accept>/' , $res_2 , $status_2);
                preg_match('/<ConfirmationCode>(.*)<\/ConfirmationCode>/' , $res_2 , $leadid2);
                preg_match('/<Reason>(.*)<\/Reason>/' , $res_2 , $message2);
                
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

                if($status_2[1] == 'Accept'){		
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

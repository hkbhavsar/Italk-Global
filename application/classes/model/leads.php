<?php
class Model_Leads extends ORM{
  protected $_table_name  = 'tbl_leads'; 
  protected $_primary_key = 'id';      // default: id
  public $errors = '';
  
  function processLead($id,$lead_type,$selected_client)
  {
        
                if($lead_type=='Auto')
                { 
                    $objLeads = ORM::factory('leadauto');
                    $field_name= 'lead_auto_id';
                }
                if($lead_type=='payday')
                { 
                    $objLeads = ORM::factory('paydaylead');
                    $field_name= 'newpayday_id';
                }
                else
                    $objLeads = ORM::factory('leads');
		$leadsData = $objLeads->select()->where($field_name,'=',$id)->find_all()->as_array();
		$this->$selected_client($leadsData[0],0);
		//$page_links_pagging_customer = $pagination_customer->render();
	exit;
  }
  
  function process_Multi_Client_Lead($id,$selected_client,$lead_type)
  {
			$lead_array = explode(",",$id);
            if($lead_type=='Auto')
                { 
                    
                    $objLeads = ORM::factory('leadauto');
                    $field_name= 'lead_auto_id';
                }
            else if($lead_type=='payday')
                { 
                    $objLeads = ORM::factory('payday');
                    $field_name= 'payday_id';
                } 
                else
                {
                   $objLeads = ORM::factory('leads');
                }
		
               // Start for the Lead assignment logic for more than 450
					
					if(count($lead_array)>=450)
					{
						$lead_assign_count = 450;
						$loop_for_lead = count($lead_array)/$lead_assign_count;
						
					}
					else
					{
						$loop_for_lead = 1;
						$lead_assign_count = count($lead_array);
					}
					$leadstart =0;
				
				// End for the Lead assignment logic for more than 450
                
				for($h=0;$h<$loop_for_lead;$h++)
                {
					for($k=$leadstart;$k<$leadstart+$lead_assign_count;$k++)
					{
                  $leadsData = $objLeads->select()->where($field_name,'=',$lead_array[$k])->find_all()->as_array();
				  $selected_client_array = explode(',', $selected_client);
					$result = TRUE;
					$lead_data = $leadsData[0];
					for($i=0;$i<count($selected_client_array);$i++)
					{  
						$print_result ='';
						$post_result='';
						$objClient = ORM::factory('client');
						$check_client = $objClient->select(DB::expr('count(tbl_client.iClient_id) as client_cnt'));
						$check_client = $objClient->join('tbl_lead_submit','left')->on('tbl_lead_submit.client_id', '=','tbl_client.iClient_id');
						$check_client = $objClient->where('tbl_client.function_name','=',$selected_client_array[$i]);
						$check_client = $objClient->where('tbl_lead_submit.lead_id','=',$lead_data->$field_name);
						$check_client = $objClient->find_all()->as_array();
						if($check_client[0]->client_cnt<=0)
						{
							if($result) //that means call the next fucntion and this client is fail
							{
								$result_array = $this->$selected_client_array[$i]($lead_data,$multiple=1,$field_name);
								if($_POST['sleeptime']!='')
									{sleep($_POST['sleeptime']);}
								$myFile_ping_data = "ping_post_request/ping_".$selected_client_array[$i].$lead_data->$field_name.".txt";
								$myFile_post_data = "ping_post_request/post_".$selected_client_array[$i].$lead_data->$field_name.".txt";
							  
							  if($result_array['ping_response']==1 || $result_array['post_response']==1)//that means call the next fucntion and this client is fail
									{
										
										//$result_view = 'Fail';
										$result=true;
										if($result_array['ping_response']==0)
										{
											  // Ping Sucess
										   $result_view_ping ='<a class="tag blue" href="'.Kohana::$base_url.$myFile_ping_data.'" target="_blank">'.$selected_client_array[$i].' Success</a>';
										   $result_view_post ='<a class="tag red" href="'.Kohana::$base_url.$myFile_post_data.'" target="_blank">'.$selected_client_array[$i].' Fail</a>';
										}
										else
										{
											$result_view_ping ='<a class="tag red" href="'.Kohana::$base_url.$myFile_ping_data.'" target="_blank">'.$selected_client_array[$i].' Fail</a>';
											$result_view_post ='N/A';
										}
									}
								else
									{
										 //$result_view = 'Success';
										 $result=false;
										 $result_view_ping ='<a class="tag blue" href="'.Kohana::$base_url.$myFile_ping_data.'" target="_blank">'.$selected_client_array[$i].' Success</a>';
										 $result_view_post ='<a class="tag blue" href="'.Kohana::$base_url.$myFile_post_data.'" target="_blank">'.$selected_client_array[$i].' Success</a>';
							 
									}
								$print_result.= $result_view_ping;
								$post_result.= $result_view_post;
							}
							
							if($result_array['price']==''){ $price="N/A";} else{ $price=$result_array['price'];}
							  echo '<tr>
							  <td width="1%"><a href="#">'.$lead_data->$field_name.'</a></td>
							  <td >'.$lead_data->fname.' '.$lead_data->lname.'</td>
							  <td>'.$lead_type.'</td>
							  <td>'.$lead_data->email.'</td>
							  <td>'.$lead_data->phone.'</td>
							  <td>'.$lead_data->ssn.'</td>
							  <td>'.$print_result.'</td>
							  <td>'.$post_result.'</td>
							  <td> $ '.$price.'</td>
							</tr>';
						}
						else
						{
						 echo '<tr>
                                <td width="1%"><a href="#">'.$lead_data->$field_name.'</a></td>
                                <td >'.$lead_data->fname.' '.$lead_data->lname.'</td>
                                <td>'.$lead_type.'</td>
                                <td>'.$lead_data->email.'</td>
                                <td>'.$lead_data->phone.'</td>
                                <td>'.$lead_data->ssn.'</td>
                                <td>Lead already assigned to '.$selected_client_array[$i].'</td>
                                <td>Lead already assigned to '.$selected_client_array[$i].'</td>
                                <td>N/A</td>
                              </tr>';
						}
		//$page_links_pagging_customer = $pagination_customer->render();
						
					}
			
			}
				  $leadstart += $lead_assign_count; 
				}
	exit;
  }
  function dealer_matrix($lead_data,$multiple)  {	  return include("clients/delear_metrix.php");      exit;  }    function rp_auto($lead_data,$multiple)  {	  return include("clients/rp_auto.php");      exit;  }    function auto_loan_locator($lead_data,$multiple)  {	  return include("clients/auto_loan_locator.php");      exit;  }    function quality_lead_usa($lead_data,$multiple)  {	return include("clients/quality_lead_usa.php");    exit;  }  function maple_lead($lead_data,$multiple)  {	return include("clients/maple_lead.php");    exit;  }    function truzon($lead_data,$multiple)  {	return include("clients/truzon.php");    exit;  }    function aim_delear($lead_data,$multiple)  {	return include("clients/aim_delear.php");    exit;  }     function WFM_AUTO($lead_data,$multiple)  {	return include("clients/wfm_auto.php");    exit;  }  
    function leadbid($lead_data,$multiple)
  {
      $objLeads_submit = ORM::factory('leadsubmit');
            	$url_1 = 'https://www.leadbidinc.com/ping/'; //live	
		$url_2 = 'https://www.leadbidinc.com/lead/submit'; //live
		
		$username = urlencode("italk_global");
		$password = urlencode("2IbkoAcTO9GpgIp2SL8v");
		$lead_type = urlencode("consumer_auto");
		$ssn = str_pad($lead_data->ssn, 9 , 0,STR_PAD_LEFT);

		$home_address_zip = urlencode($lead_data->zip);
		$monthly_income = urlencode($lead_data->monthly_income);
		$price = urlencode("5.00");
		$first_name = urlencode($lead_data->fname);
		$last_name = urlencode($lead_data->lname);
		$gender = '';
		list($birth_year , $birth_month , $birth_day) = explode("-",$lead_data->birth_date);
		$date_of_birth = urlencode($birth_year.'-'.$birth_month.'-'.$birth_day);	
		
		if($lead_data->bankruptcy == "yes"){
			$bankruptcy = urlencode("1");
		}
		elseif($lead_data->bankruptcy == "no"){
			$bankruptcy = urlencode("0");
		}
		
		if($lead_data->cosigner == 'yes')
			$cosigner = urlencode('1');
		elseif($lead_data->cosigner == 'no')
			$cosigner = urlencode('0');
			
		$home_phone = urlencode($lead_data->phone);		
		$email_address = urlencode($lead_data->email);
		$employer_name = urlencode(str_replace("&", "", $lead_data->employer)); 
		$employer_phone = urlencode($lead_data->work_number);
		$years_at_emp = urlencode((int) substr($lead_data->month_with_company , 0 , 2));//employmentYears
		$months_at_emp = urlencode((int) substr($lead_data->month_with_company , 3 , 2));//employmentMonths
		$job_title = urlencode($lead_data->job_title);
		
		$res_address = urlencode($lead_data->address);//
		$res_city = urlencode($lead_data->city);
		//$res_city = urlencode("Hauppauge");
		$res_state = urlencode($lead_data->state);
		//$res_state = urlencode('NY');
						
		$residence_status = urlencode($lead_data->rent_own);
		$years_at_res = urlencode((int) substr($lead_data->year_residence , 0 , 2));
		$months_at_res = urlencode((int) substr($lead_data->year_residence , 3 , 2));
		$monthly_res_cost = urlencode($lead_data->home_pay);//
		
		$credit_check_ok = urlencode('1');
		$forward_app_ok = urlencode('0');
		$special_offers_ok = urlencode('0');
		
		
		$ip_address = urlencode($lead_data->ip_address);
		
		if($ip_address == '' || $ip_address == 0)
			$generation_method = urlencode('phone');
		else
			$generation_method = urlencode('web');
		
		$pricetier = array(0=>'7.50', 1=>'6.50', 2=>'5.50', 3=>'4.50', 4=>'3.50', 5=>'1.50');
		for($pi=0; $pi<6; $pi++)
		{
                    $epricetier = urlencode($pricetier[$pi]);		
                    $ping_data = 'username='.$username.
                                             '&password='.$password.
                                             '&lead_type='.$lead_type.
                                             '&ssn='.$ssn.
                                             '&monthly_income='.$monthly_income.
                                             '&home_address_zip='.$home_address_zip.
                                             '&price='.$epricetier;
		    $post_data = 'username='.$username.
					  '&password='.$password.
					  '&lead_type='.$lead_type.
					  '&ssn='.$ssn.
					  '&salutation=&first_name='.$first_name.
					  '&middle_initial=&last_name='.$last_name.
					  '&suffix=&gender='.$gender.
						'&date_of_birth='.$date_of_birth.
						'&bankruptcy='.$bankruptcy.
						'&cosigner='.$cosigner.
						'&monthly_income='.$monthly_income.
						'&other_income=&other_income_source=&home_phone='.$home_phone.
						'&mobile_phone='.$mobile_phone.
						'&email_address='.$email_address.
						'&employer_name='.$employer_name.'&employer_address=&employer_address_2=&employer_city=&employer_state=&employer_zip=&employer_zip_four=&employer_phone='.$employer_phone.
						'&employer_phone_ext=&years_at_emp='.$years_at_emp.
						'&months_at_emp='.$months_at_emp.
						'&job_title='.$job_title.
						'&res_address='.$res_address.
						'&res_address_2=&res_city='.$res_city.
						'&res_state='.$res_state.
						'&home_address_zip='.$home_address_zip.
						'&home_address_zip_four=&residence_status='.$residence_status.
						'&years_at_res='.$years_at_res.
						'&months_at_res='.$months_at_res.
						'&monthly_res_cost='.$monthly_res_cost.
						'&credit_check_ok='.$credit_check_ok.
						'&forward_app_ok='.$forward_app_ok.
						'&special_offers_ok='.$special_offers_ok.
						'&generation_method='.$generation_method.
						'&ip_address=&gen_campaign_id=&gen_lead_id=&price='.$epricetier;
		
		
		//print "<br>".$post_data;
		$header = array();
		$header[] = "Content-Type: application/x-www-form-urlencoded"; 
		$header[] .= "Content-Length: ".strlen($ping_data);
							
		//$res_1 = $this->curlposting($url_1, $ping_data, $header);
		
                //***********************Write File for the Ping *************/
                
                    $myFile_ping_response = "ping_post_request/ping_leadbid".$lead_data->lead_auto_id.".txt";
                    $fh = fopen($myFile_ping_response, 'w') or die("can't open file");
                    $file_string = "Ping URL::>".$url_1."\n\n";
                    $file_string.= "Ping Data::>".$ping_data."\n\n";
                    $file_string.= "Ping Response::>".$res_1."\n\n";
                    fwrite($fh, $file_string);
                    fclose($fh);
                
                //************************End Write File for ping ************/
                
		preg_match('/<status>(.*)<\/status>/' , $res_1 , $status_1);
		
		if($status_1[1] == 'success')
		{
                        $ping_response ='Ping Accepted';
			preg_match('/<have_buyer>(.*)<\/have_buyer>/' , $res_1 , $have_buyer_1);			
		}
		else
		{
			preg_match('/<errors>(.*)<\/errors>/' , $res_1 , $errors_1);
		}
				
		if($status_1[1] == 'success'){
                        $header1 = array();
                        $header1[] = "Content-Type: application/x-www-form-urlencoded"; 
                        $header1[] .= "Content-Length: ".strlen($post_data);
                        //$res_2 = $this->curlposting($url_2, $post_data, $header1);
                        preg_match('/<status>(.*)<\/status>/' , $res_2 , $status_2);
                        $return_ping = 0; // Lead Sucess
                        if($status_2[1] == 'success')
                        {
                            preg_match('/<confirmation_code>(.*)<\/confirmation_code>/', $res_2, $Result_2);

                            //***********************Write File for the Post *************/

                                $myFile_post = "ping_post_request/post_leadbid".$lead_data->lead_auto_id.".txt";
                                $fh_post = fopen($myFile_post, 'w') or die("can't open file");
                                $file_string_post = "Post URL::>".$url_2."\n\n";
                                $file_string_post.= "Post Data::>".$post_data."\n\n";
                                $file_string_post.= "Post Result::>".$res_2."\n\n";                           
                                fwrite($fh_post, $file_string_post);
                                fclose($fh_post);
                                $return_post = false;
                            //************************End Write File for Post ************/
                            $return = false;
                            break;
                        }
                        else
                        {
                            $return_post = true;//Call the other function
                            preg_match('/<errors>(.*)<\/errors>/', $res_2, $Result_2);
                        }
                }// End if lead sucess
                else{
                        $ping_response ='Ping Rejected';
                        //$comment_admin = ', AUTOBUYING-Rejected';
                        $post_response = 'N/A';
                        $post_request = '-';
                        $return_ping = true;//Call the other function
                        $return_post = true;
                }
             }//End For Loop
        
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
                  <td>12</td>
                </tr>';
         }
         else
         {
            $return_array['ping_response'] =  $return_ping;
            $return_array['post_response'] = $return_post;
            $return_array['price'] = $price[1];
            
            return $return_array;
             
         }
        
  }
  

  function absauto($lead_data,$multiple,$field_name)
  {
        $objLeads_submit = ORM::factory('leadsubmit');
		$url_1 = 'http://leadtrading.autobuyingsolutionsinc.com/AutomotiveFinance.asmx/DynamicPricePing';//DynamicPricePing
		$url_2 = 'http://leadtrading.autobuyingsolutionsinc.com/AutomotiveFinance.asmx/Post';
		
		$header = array();		
		$header[] = "Content-Type: application/x-www-form-urlencoded";	
		
		//print_r($lead_data->id);exit;
		
		$price = '';
		$providerId = '262';
		$postalCode = $lead_data->zip;
		$socialSecurityNumber = str_pad($lead_data->ssn, 9 , 0,STR_PAD_LEFT);
//		$socialSecurityNumber = '999999999';
		
		$grossMonthlyIncome = $lead_data->monthly_income;
	
		$providerData = '';
		$reservationCode = 'RRRRRRR';
		$prefix = '';
		$firstName = $lead_data->fname;
		$lastName = $lead_data->lname;
		$suffix = '';
		$emailAddress = $lead_data->email;
		$address = $lead_data->address;
		$address2 = '';
		$city = $lead_data->city;
		$province = $lead_data->state;
		$homePhone = $lead_data->phone;
		$workPhone = $lead_data->phone;
		$workPhoneExt = '';
		list($birth_year , $birth_month , $birth_day) = explode("-",$lead_data->birth_date);
		$date_of_birth = $birth_month . '/' . $birth_day . '/' . $birth_year;
		$birthDate = $date_of_birth;		
		$monthsAtResidence = (int) substr($lead_data->year_residence , 3 , 2);
		$yearsAtResidence = (int) substr($lead_data->year_residence , 0 , 2);
		$residenceType = ($lead_data->rent_own == 'own') ? "Own" : 'Rent';
		
		$residenceMonthlyPayment = $lead_data->home_pay;
		$employer = $lead_data->employer;
		$jobTitle = $lead_data->job_title;
		$monthsAtEmployer = (int) substr($lead_data->month_with_company , 3 , 2);//employmentMonths
		$yearsAtEmployer = (int) substr($lead_data->month_with_company , 0 , 2);//employmentYears
		$ipAddress = $lead_data->ip_address;
		$hasBankruptcy = ($lead_data->bankruptcy == 'yes') ? 'True' : 'False';
		$hasCosigner = ($lead_data->cosigner == 'yes') ? 'True' : 'False';
		$agreesToConditions = 'True';
		$authorizedCreditCheck = 'True';
		$notes = '';
		
		//$socialSecurityNumber = '999999999';
		//$postalCode = '99999';
		
		$ping_data =	'providerId='.$providerId
						.'&grossMonthlyIncome='.$grossMonthlyIncome
						.'&socialSecurityNumber='.$socialSecurityNumber
						.'&postalCode='.$postalCode;

		$post_data =	'providerId='.$providerId
						.'&providerData='.$providerData
						.'&reservationCode='.$reservationCode
						.'&prefix='.$prefix 
						.'&firstName='.$firstName 
						.'&lastName='.$lastName 
						.'&suffix='.$suffix 
						.'&emailAddress='.$emailAddress 
						.'&address='.$address 
						.'&address2='.$address2 
						.'&city='.$city 
						.'&province='.$province 
						.'&postalCode='.$postalCode 
						.'&homePhone='.$homePhone 
						.'&workPhone='.$workPhone 
						.'&workPhoneExt='.$workPhoneExt 
						.'&mobilePhone='.$mobilePhone 
						.'&socialSecurityNumber='.$socialSecurityNumber 
						.'&birthDate='.$birthDate 
						.'&monthsAtResidence='.$monthsAtResidence 
						.'&yearsAtResidence='.$yearsAtResidence 
						.'&residenceType='.$residenceType 
						.'&residenceMonthlyPayment='.$residenceMonthlyPayment 
						.'&employer='.$employer 
						.'&jobTitle='.$jobTitle 
						.'&monthsAtEmployer='.$monthsAtEmployer 
						.'&yearsAtEmployer='.$yearsAtEmployer 
						.'&grossMonthlyIncome='.$grossMonthlyIncome 
						.'&ipAddress='.$ipAddress 
						.'&hasBankruptcy='.$hasBankruptcy 
						.'&hasCosigner='.$hasCosigner 
						.'&agreesToConditions='.$agreesToConditions 
						.'&authorizedCreditCheck='.$authorizedCreditCheck 
						.'&notes='.$notes;
						
                
						$res_1 = $this->curlposting($url_1, $ping_data, $header, '60');
                                                
                                                $myFile_ping_response = "ping_post_request/ping_absauto".$lead_data->$field_name.".txt";
						$fh = fopen($myFile_ping_response, 'w') or die("can't open file");
						$file_string = "Ping URL::>".$url_1."\n\n";
						$file_string.= "Ping Data::>".$ping_data."\n\n";
                                                $file_string.= "Ping Response::>".$res_1."\n\n";
						fwrite($fh, $file_string);
						fclose($fh);
			
						preg_match('/<price>(.*)<\/price>/' , $res_1 , $price);
						preg_match('/<reservationCode>(.*)<\/reservationCode>/' , $res_1 , $reservationCode);
						preg_match('/<successful>(.*)<\/successful>/' , $res_1 , $successful_1);
                                                
					if($successful_1[1] == 'true')
					  {
						$ping_response ='Accepted with Price:'.$price;
						$post_request = '<a href="'.Kohana::$base_url.$myFile_post.'" target="_blank">View Request</a>';
						
						$post_data = str_replace('RRRRRRR' , $reservationCode[1], $post_data);
						$res_2 = $this->curlposting($url_2, $post_data, $header, '60');
						preg_match('/<successful>(.*)<\/successful>/' , $res_2 , $successful_2);
						preg_match('/<message>(.*)<\/message>/' , $res_2 , $message_2);
                                                
                                                $myFile_post = "ping_post_request/post_absauto".$lead_data->$field_name.".txt";
						$fh_post = fopen($myFile_post, 'w') or die("can't open file");
						$file_string_post = "Post URL::>".$url_2."\n\n";
						$file_string_post.= "Post Data::>".$post_data."\n\n";
                                                $file_string_post.= "Post Result::>".$res_2."\n\n";                           
						fwrite($fh_post, $file_string_post);
						fclose($fh_post);
						$return_ping = 0;
                                                $objLeads_submit->ping_response ='Success';
                                               
						if($successful_2[1] == 'true' || $message_2[1] == 'Accepted'){			
								$comment_admin = ', AUTOBUYING-Accepted Price:' . $price[1];
								$post_response = 'AUTOBUYING-Accepted Price:' . $price[1];
								$sql = "UPDATE cash_advance SET `comment_admin`=CONCAT(comment_admin,'$comment_admin') ,`clientleads`=if(clientleads='', '".$_GET['users_Id']."',CONCAT(clientleads,',','".$_GET['users_Id']."')) where id = '".$row_leads[$ij][id]."'";
								$res = mysql_query($sql);
                                                                $return_post = false;
                                                                $objLeads_submit->post_response ='Success';
                                                                $objLeads_submit->price = $price[1];
                                           	}else{
							$comment_admin = ', AUTOBUYING-Rejected';
							$post_response = 'AUTOBUYING-Rejected';
							$sql = "UPDATE cash_advance SET `comment_admin`=CONCAT(comment_admin,'$comment_admin') where ".$field_name." = '".$row_leads[$ij][id]."'";
							$res = mysql_query($sql);
                                                        $return_post = true;//Call the other function
                                                        $objLeads_submit->post_response ='Fail';
                                                        $objLeads_submit->price = 0;
                            			}	
						
					  }
					else
					  {
						$ping_response ='Ping Rejected';
						$comment_admin = ', AUTOBUYING-Rejected';
						$post_response = 'N/A';
                                                $post_request = '-';
						//$post_response = 'AUTOBUYING-Rejected';
						$sql = "UPDATE cash_advance SET `comment_admin`=CONCAT(comment_admin,'$comment_admin') where id = '".$row_leads[$ij][id]."'";
						$res = mysql_query($sql);
                                                $return_ping = true;//Call the other function
                                                $return_post = true;
                                                $objLeads_submit->ping_response ='Fail';
                                                $objLeads_submit->post_response ='Fail';
                                                
					  }
          $objLeads_submit->lead_id =$lead_data->lead_auto_id;
          $objLeads_submit->client_id =13;
          $objLeads_submit->lead_types='Auto';
		  $objLeads_submit->c_date=$lead_data->c_date;
          $objLeads_submit->save();
          
        
         if($multiple!=1)
         {
            echo '<tr>
                  <td width="1%"><a href="#">'.$lead_data->lead_auto_id.'</a></td>
                  <td>'.$lead_data->lead_types.'</td>
                  <td>'.$emailAddress.'</td>
                  <td>'.$homePhone.'</td>
                  <td>'.$socialSecurityNumber.'</td>
                  <td>'.$ping_response.' <a class="tag red" href="'.Kohana::$base_url.$myFile_ping_response.'" target="_blank">View</a></td>
                  <td>'.$post_request.'</td>
                  <td>'.$post_response.'</td>
                  <td>12</td>
                </tr>';
         }
         else
         {
            $return_array['ping_response'] =  $return_ping;
            $return_array['post_response'] = $return_post;
            $return_array['price'] = $price[1];
            
            return $return_array;
         }
						
  
  }
  
  function afsauto($lead_data,$multiple)
  {
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
        $objLeads_submit->client_id =23;
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
 }//End of the Function
  
  function lndauto($lead_data,$multiple)
  {
        $objLeads_submit = ORM::factory('leadsubmit');
        $url_1 = 'https://ping.wnog.com/admin/PingPost/ping'; 
        $url_2 = 'https://ping.wnog.com/admin/PingPost/post';
        $header = 'Content-Type: application/x-www-form-urlencoded';
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
        $cid = '1516';
        $ping_data = 'zip='.$home_address_zip
                    .'&subid='.$lead_data->lead_auto_id
                    .'&ssn='.$ssn
                    .'&monthly_income='.$monthly_income
                    .'&cid='.$cid;	

        $post_data =  'offerId=RRRRRRR'
                        .'&firstname='.trim($first_name)
                        .'&lastname='.$last_name 
                        .'&email='.$email_address 
                        .'&address1='.$res_address1 
                        .'&address2='.$res_address2 
                        .'&city='.$res_city
                        .'&home_phone1='.$home_phone1
                        .'&home_phone2='.$home_phone2
                        .'&home_phone3='.$home_phone3
                        .'&work_phone1='.$work_phone1
                        .'&work_phone2='.$work_phone2
                        .'&work_phone3='.$work_phone3
                        .'&mobile_phone1=&mobile_phone2=&mobile_phone3=&bday='.$birth_day
                        .'&bmonth='.$birth_month
                        .'&byear='.$birth_year
                        .'&ownrent='.$residence_status
                        .'&timeatresidence='.$yearsAtResidence 
                        .'&timeatjob='.$yearsAtEmployer
                        .'&employer='.$employer_name
                        .'&occupation='.$job_title
                        .'&monthlypayment='.$monthly_payment
                        .'&bankrupt='.$bankruptcy
                        .'&cosign='.$cosigner
                        .'&optin='.$opt_in
                        .'&ipaddress='.$ip_address
                        .'&timetocontact='.$time_of_contact
                        .'&loantype='.$loan_type
                        .'&timeatjobmonths='.$monthsAtEmployer
                        .'&timeatresidencemonths='.$monthsAtResidence;

        $res_1 = $this->curlposting($url_1, $ping_data, $header);
        preg_match('/<result>(.*)<\/result>/' , $res_1 , $successful_1);
        preg_match('/<offerId>(.*)<\/offerId>/' , $res_1 , $confirmation );
        preg_match('/<price>(.*)<\/price>/' , $res_1 , $price);

        $myFile_ping_response = "ping_post_request/ping_lndauto".$lead_data->lead_auto_id.".txt";
        $fh = fopen($myFile_ping_response, 'w') or die("can't open file");
        $file_string = "Ping URL::>".$url_1."\n\n";
        $file_string.= "Ping Data::>".$ping_data."\n\n";
        $file_string.= "Ping Response::>".$res_1."\n\n";
        fwrite($fh, $file_string);
        fclose($fh);

        if($successful_1[1] == 'true') // Ping Successfull
        {
            $post_data = str_replace('RRRRRRR' , $confirmation[1], $post_data);
            $res_2 = $this->curlposting($url_2, $post_data, $header);
            preg_match('/<result>(.*)<\/result>/' , $res_2 , $successful_2);
            preg_match('/<reason>(.*)<\/reason>/' , $res_2 , $message_2);
            preg_match('/<price>(.*)<\/price>/' , $res_2 , $price);

            $myFile_post = "ping_post_request/post_lndauto".$lead_data->lead_auto_id.".txt";
            $fh_post = fopen($myFile_post, 'w') or die("can't open file");
            $file_string_post = "Post URL::>".$url_2."\n\n";
            $file_string_post.= "Post Data::>".$post_data."\n\n";
            $file_string_post.= "Post Result::>".$res_2."\n\n";                           
            fwrite($fh_post, $file_string_post);
            fclose($fh_post);

            $ping_response ='Accepted with Price:'.$price;
            $post_request = '<a href="'.Kohana::$base_url.$myFile_post.'" target="_blank">View Request</a>';
            $return_ping = 0;
            $objLeads_submit->ping_response ='Success';

            if($successful_2[1] == 'true'){ // Post Sucess			
                    $post_response = 'L&D-Accepted Price:' . $price[1];
                    $objLeads_submit->post_response ='Success';
                    $objLeads_submit->price = $price[1];

            }else{
                    $post_response = 'L&D-Rejected';
                    $return_post = true;//Call the other function
                    $objLeads_submit->post_response ='Fail';
                    $objLeads_submit->price = 0;
                    $leadassign = 1;
            }	
        }
        else // Lead Rejected
        {
            $ping_response ='Ping Rejected';
            $comment_admin = ', L&D-Rejected';
            $post_response = 'N/A';
            $post_request = '-';
            $leadassign = 1;
            $return_ping = true;//Call the other function
            $objLeads_submit->ping_response ='Fail';
            $objLeads_submit->post_response ='Fail';
        }
        $objLeads_submit->lead_id =$lead_data->lead_auto_id;
        $objLeads_submit->client_id =25;
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

    }

  function jnm($lead_data,$multiple)
  {
        $url_1 = 'https://ping.jmadvertising.com/admin/PingPost/ping/'; //testing
        $url_2 = 'https://ping.jmadvertising.com/admin/PingPost/post/'; //testing
        $header = 'Content-Type: application/x-www-form-urlencoded';
        $price = 'PPPPPP';
        $cid = '999';

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

        $ping_data = '&zip='.$home_address_zip
                    .'&ssn='.$ssn
                    .'&monthly_income='.$monthly_income
                    .'&cid='.$cid
                    .'&subid=';
        $post_data =  'offerId=RRRRRRR'
                        .'&firstname='.trim($first_name)
                        .'&lastname='.$last_name 
                        .'&email='.$email_address 
                        .'&address1='.$res_address1 
                        .'&address2='.$res_address2 
                        .'&city='.$res_city
                        .'&home_phone1='.$home_phone1
                        .'&home_phone2='.$home_phone2
                        .'&home_phone3='.$home_phone3
                        .'&work_phone1='.$work_phone1
                        .'&work_phone2='.$work_phone2
                        .'&work_phone3='.$work_phone3
                        .'&mobile_phone1=&mobile_phone2=&mobile_phone3=&bday='.$birth_day
                        .'&bmonth='.$birth_month
                        .'&byear='.$birth_year
                        .'&ownrent='.$residence_status
                        .'&timeatresidence='.$yearsAtResidence 
                        .'&timeatjob='.$yearsAtEmployer
                        .'&employer='.$employer_name
                        .'&occupation='.$job_title
                        .'&monthlypayment='.$monthly_payment
                        .'&bankrupt ='.$bankruptcy
                        .'&cosign ='.$cosigner
                        .'&optin ='.$opt_in
                        .'&ipaddress='.$ip_address
                        .'&timetocontact='.$time_of_contact
                        .'&loantype='.$loan_type;

        $res_1 = $this->curlposting($url_1, $ping_data, $header);
        $myFile_ping_response = "ping_post_request/ping_jnmauto".$lead_data->lead_auto_id.".txt";
        $fh = fopen($myFile_ping_response, 'w') or die("can't open file");
        $file_string = "Ping URL::>".$url_1."\n\n";
        $file_string.= "Ping Data::>".$ping_data."\n\n";
        $file_string.= "Ping Response::>".$res_1."\n\n";
        fwrite($fh, $file_string);
        fclose($fh);

        preg_match('/<result>(.*)<\/result>/' , $res_1 , $successful_1);
        preg_match('/<offerId>(.*)<\/offerId>/' , $res_1 , $confirmation );
        preg_match('/<price>(.*)<\/price>/' , $res_1 , $price);

        if($successful_1[1] == 'true') // Ping Sucess
        {
            $post_data = str_replace('RRRRRRR' , $confirmation[1], $post_data);
            $res_2 = $this->curlposting($url_2, $post_data, $header);
            preg_match('/<result>(.*)<\/result>/' , $res_2 , $successful_2);
            preg_match('/<reason>(.*)<\/reason>/' , $res_2 , $message_2);
            preg_match('/<price>(.*)<\/price>/' , $res_2 , $price);

            $myFile_post = "ping_post_request/post_jnmauto".$lead_data->lead_auto_id.".txt";
            $fh_post = fopen($myFile_post, 'w') or die("can't open file");
            $file_string_post = "Post URL::>".$url_2."\n\n";
            $file_string_post.= "Post Data::>".$post_data."\n\n";
            $file_string_post.= "Post Result::>".$res_2."\n\n";                           
            fwrite($fh_post, $file_string_post);
            fclose($fh_post);

            $ping_response ='Accepted with Price:'.$price;
            $post_request = '<a href="'.Kohana::$base_url.$myFile_post.'" target="_blank">View Request</a>';
            $return_ping = 0;
            $objLeads_submit->ping_response ='Success';

            if($successful_2[1] == 'true') // Post Sucess
               {			
                     $post_response = 'J&M Auto-Accepted Price:' . $price[1];
                     $objLeads_submit->post_response ='Success';
                     $objLeads_submit->price = $price[1];

                }else // Post Fail
                {
                        $post_response = 'J&M Auto-Rejected';
                        $return_post = true;//Call the other function
                        $objLeads_submit->post_response ='Fail';
                        $objLeads_submit->price = 0;
                        $leadassign = 1;
                }	


        }
        else{ // Ping Fail
            $ping_response ='Ping Rejected';
            $comment_admin = ',J&M Auto-Rejected';
            $post_response = 'N/A';
            $post_request = '-';
            $leadassign = 1;
            $return_ping = true;//Call the other function
            $objLeads_submit->ping_response ='Fail';
            $objLeads_submit->post_response ='Fail';
        }
        $objLeads_submit->lead_id =$lead_data->lead_auto_id;
        $objLeads_submit->client_id =33;
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



    }
  
  function harborauto($lead_data,$multiple)
  {
      $objLeads_submit = ORM::factory('leadsubmit');
      $PingURL = 'https://leads.harborcredit.com/ping/ping.aspx';
      $PostURL = 'https://leads.harborcredit.com/post/post.aspx';	
      
      $TestMode = "0";												/* 0 IS A LIVE LEAD. 1 IS A TEST LEAD */
      $partnerName = "pp_vigatell";									/* REQUEST MR. AMIT FOR VALUE OF THIS VARIABLE */
      $userName = "vigatell";											/* REQUEST MR. AMIT FOR VALUE OF THIS VARIABLE */
      $password = "Victor_79";										/* REQUEST MR. AMIT FOR VALUE OF THIS VARIABLE */
      $validRefiLenders = NULL;										/* REQUEST MR. AMIT FOR VALUE OF THIS VARIABLE */
      $vehicleType = "Auto";											/* REQUEST MR. AMIT FOR VALUE OF THIS VARIABLE */
      $applicationType = "Single";									/* REQUEST MR. AMIT FOR VALUE OF THIS VARIABLE */
      $loanAmount = "10000";												/* REQUEST MR. AMIT FOR VALUE OF THIS VARIABLE */
      $loanTerm = "36";												/* REQUEST MR. AMIT FOR VALUE OF THIS VARIABLE */
      
      $LeadType = 'Finance Purchase';
	$FirstName = $lead_data->fname;
	$LastName = $lead_data->lname;
	$StreetAddress = $lead_data->address;
	$City = $lead_data->city;
	$State = $lead_data->state;
	$Zipcode = $lead_data->zip;
	$ssn = str_pad($lead_data->ssn, 9 , 0,STR_PAD_LEFT);
	$HomePhone =  $lead_data->phone;
	$WorkPhone = $lead_data->work_number;
	$PhoneContact = "1";											/* CAN BE DIFFERENT */
	$BestTimeContact =  $lead_data->time_to_contact;
	$EmailAddress = $lead_data->email;
	$EmailContact = "1";											/* CAN BE DIFFERENT */
	$Income = urlencode($lead_data->monthly_income);
	$DynamicPrice = "1";											/* CAN BE DIFFERENT */
	$monthlyPayment = $row_leads[$ij]['home_pay'];					/* CAN BE DIFFERENT */
	$clientIP = $lead_data->ip_address;
	$Bankruptcy =  $lead_data->bankruptcy;
	$JobTitle = $lead_data->job_title;
	$ResidenceType = $lead_data->rent_own;
	$ResidenceYears = (int) substr($lead_data->year_residence,0 ,2);
	$ResidenceMonths = (int) substr($lead_data->year_residence,3 ,2);
	$DOB = date("m-d-Y", strtotime($lead_data->birth_date));
	$EmployerName = $lead_data->employer;
	$EmployerYears = (int) substr($lead_data->month_with_company,0 , 2);
	$EmployerMonths = (int) substr($lead_data->month_with_company,3 , 2);
	$privacyAccept = "true";											/* CAN BE DIFFERENT */
	$creditScore = $lead_data->credit_score;				/* CAN BE DIFFERENT */
  
        $PingData = '<?xml version="1.0" encoding="utf-8"?>
				<Application>
					<test>' . $TestMode . '</test>
					<partnerName>' . $partnerName . '</partnerName>
					<userName>' . $userName . '</userName>
					<password>' . $password . '</password>
					<ssn>' . $ssn . '</ssn>
					<zipcode>' . $Zipcode . '</zipcode>
					<gmi>' . $Income . '</gmi>
					<dynamicPrice>' . $DynamicPrice . '</dynamicPrice>
				</Application>';	
	$Headers = array();
	$Headers[] = "Content-type: text/xml";
	$Headers[] .= "Content-Length: " . strlen($PingData);	
	$PingResult = $this->curlposting($PingURL , $PingData, $Headers);
        
        $myFile_ping_response = "ping_post_request/ping_harbourauto".$lead_data->lead_auto_id.".txt";
        $fh = fopen($myFile_ping_response, 'w') or die("can't open file");
        $file_string = "Ping URL::>".$PingURL."\n\n";
        $file_string.= "Ping Data::>".$PingData."\n\n";
        $file_string.= "Ping Response::>".$PingResult."\n\n";
        fwrite($fh, $file_string);
        fclose($fh);
        
        preg_match('/(<id>(.*)<\/id>)/', $PingResult, $PindResponseID);
	preg_match('/(<accepted>(.*)<\/accepted>)/', $PingResult, $PingAccepted);
	preg_match('/(<price>(.*)<\/price>)/', $PingResult, $Price);
	preg_match('/(<error_number>(.*)<\/error_number>)/', $PingResult, $ErrorNumber);
	preg_match('/(<error_message>(.*)<\/error_message>)/', $PingResult, $ErrorMessage);
        
        if($PingAccepted[2] == 1){
		$PostData = '<?xml version="1.0" encoding="utf-8"?>
                <Application>
                        <userName>' . $userName . '</userName>
                        <password>' . $password . '</password>
                        <id>' . $PindResponseID[2] . '</id>
                        <partnerName>' . $partnerName . '</partnerName>
                        <leadType>' . $LeadType . '</leadType>
                        <validRefiLenders>' . $validRefiLenders . '</validRefiLenders>
                        <vehicleType>' . $vehicleType . '</vehicleType>
                        <applicationType>' . $applicationType . '</applicationType>
                        <loanAmount>' . $loanAmount . '</loanAmount>
                        <loanTerm>' . $loanTerm . '</loanTerm>
                        <clientIP>' . $clientIP . '</clientIP>
                        <firstName>' . $FirstName . '</firstName>
                        <lastName>' . $LastName . '</lastName>
                        <addressLine1>' . $StreetAddress . '</addressLine1>
                        <city>' . $City . '</city>
                        <state>' . $State . '</state>
                        <zipCode>' . $Zipcode . '</zipCode>
                        <email>' . $EmailAddress . '</email>
                        <homePhone>' . $HomePhone . '</homePhone>
                        <workPhone>' . $WorkPhone . '</workPhone>
                        <SSN>' . $ssn . '</SSN>
                        <dateOfBirth>' . $DOB . '</dateOfBirth>
                        <residenceType>' . $ResidenceType . '</residenceType>
                        <monthlyPayment>' . $monthlyPayment . '</monthlyPayment>
                        <residenceYears>' . $ResidenceYears . '</residenceYears>
                        <residenceMonths>' . $ResidenceMonths . '</residenceMonths>
                        <grossMonthlyIncome>' . $Income . '</grossMonthlyIncome>
                        <employer>' . $EmployerName . '</employer>
                        <jobTitle>' . $JobTitle . '</jobTitle>
                        <employerPhone>' . $WorkPhone . '</employerPhone>
                        <employerYears>' . $EmployerYears . '</employerYears>
                        <employerMonths>' . $EmployerMonths . '</employerMonths>
                        <bankruptcy>' . $Bankruptcy . '</bankruptcy>
                        <privacyAccept>' . $privacyAccept . '</privacyAccept>
                        <creditScore>' . $creditScore . '</creditScore>
                </Application>';
		
		$Headers = array();
		$Headers[] = "Content-type: text/xml";
		$Headers[] .= "Content-Length: " . strlen($PostData);	
		$PostResult = $this->curlposting($PostURL , $PostData, $Headers);
		//unset($Headers);
		
		preg_match('/(<id>(.*)<\/id>)/', $PostResult, $PostResponseID);
		preg_match('/(<accepted>(.*)<\/accepted>)/', $PostResult, $PostAccepted);
		preg_match('/(<tier>(.*)<\/tier>)/', $PostResult, $Tier);
		preg_match('/(<error_number>(.*)<\/error_number>)/', $PostResult, $ErrorNumber);
		preg_match('/(<error_message>(.*)<\/error_message>)/', $PostResult, $ErrorMessage);
                
                $myFile_post = "ping_post_request/post_harborauto".$lead_data->lead_auto_id.".txt";
                $fh_post = fopen($myFile_post, 'w') or die("can't open file");
                $file_string_post = "Post URL::>".$PostURL."\n\n";
                $file_string_post.= "Post Data::>".$PostData."\n\n";
                $file_string_post.= "Post Result::>".$PostResult."\n\n";                           
                fwrite($fh_post, $file_string_post);
                fclose($fh_post);
                
                $ping_response ='Accepted with Price:'.$Price;
		$post_request = '<a href="'.Kohana::$base_url.$myFile_post.'" target="_blank">View Request</a>';
                $return_ping = 0;
                $objLeads_submit->ping_response ='Success';
                
                if($PostAccepted[2]==1){
			$post_response = 'Harbor Auto-Accepted Price:' .$Price;
                        $objLeads_submit->post_response ='Success';
                        $objLeads_submit->price = $price[1];
	
		}else{
			$post_response = 'Harbor-Rejected';
                        $return_post = true;//Call the other function
                        $objLeads_submit->post_response ='Fail';
                        $objLeads_submit->price = 0;
                        $leadassign = 1;
		}
                
        }
        else // Lead Rejected
        {
            $ping_response ='Ping Rejected';
            $comment_admin = ', Harbor Auto-Rejected';
            $post_response = 'N/A';
            $post_request = '-';
            $leadassign = 1;
            $return_ping = true;//Call the other function
            $objLeads_submit->ping_response ='Fail';
            $objLeads_submit->post_response ='Fail';
        }
        $objLeads_submit->lead_id =$lead_data->lead_auto_id;
        $objLeads_submit->client_id =34;
        $objLeads_submit->lead_types='Auto';
        $objLeads_submit->save();
        
        if($multiple!=1)
         {
            echo '<tr>
                  <td width="1%"><a href="#">'.$lead_data->lead_auto_id.'</a></td>
                  <td>Auto</td>
                  <td>'.$EmailAddress.'</td>
                  <td>'.$HomePhone.'</td>
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
            $return_array['price'] = $Price;
            return $return_array;
         }
      exit;
        
  }// End of fucntion
  
  function adaroo($lead_data,$multiple)
  {
      $objLeads_submit = ORM::factory('leadsubmit');
      $url_1 = 'http://prod.iceblu.com/ping.aspx'; 
      $url_2 = 'http://prod.iceblu.com/post.aspx'; 
      
    $first_name = $lead_data->fname;
    $last_name = $lead_data->lname;
    $email_address = $lead_data->email;
	$ssn = str_pad($lead_data->ssn, 9 , 0,STR_PAD_LEFT);
	$monthly_income = $lead_data->monthly_income;
	$home_address_zip = $lead_data->zip;
    $res_address1 = $lead_data->address;

    $res_address2 = urlencode("");
    $res_city = $lead_data->city;
    $res_state = $lead_data->state;
    $home_phone = $lead_data->phone;
    $work_phone = $lead_data->work_number;
    $home_phone1 = substr($lead_data->phone, 0, 3);
    $home_phone2 = substr($lead_data->phone, 3, 3);
    $home_phone3 = substr($lead_data->phone, 6);
    $work_phone1 = substr($lead_data->work_number, 0, 3);
    $work_phone2 = substr($lead_data->work_number, 3, 3);
    $work_phone3 = substr($lead_data->work_number, 6);

    $mobile_phone =$lead_data->mobile;

    list($birth_year , $birth_month , $birth_day) = explode("-",$lead_data->birth_date);

    $monthsAtResidence = (int) substr($lead_data->year_residence,3 ,2);
    $yearsAtResidence = (int) substr($lead_data->year_residence,0 ,2);

    $residence_status = strtolower($lead_data->rent_own);

    $yearsAtEmployer = (int) substr($lead_data->month_with_company,0 , 2);

    $employer_name = $lead_data->employer;
    $job_title = $lead_data->job_title;
    $monthly_payment = $lead_data->job_title;

    if($lead_data->bankruptcy == 'yes'){
            $bankruptcy = 'true';
    }
    elseif($lead_data->bankruptcy == 'no'){
            $bankruptcy = 'false';
    }

    if($lead_data->cosigner == 'yes')
            $cosigner = 'true';
    elseif($lead_data->cosigner == 'no')
            $cosigner = 'false';


    $opt_in = '1';
    $ip_address = $lead_data->ip_address;
    

    $date_of_birth =$lead_data->ip_address; 
    $dob = date('m/d/Y',strtotime($lead_data->birth_date));
    //echo $dob; exit;
    $time_of_contact = $lead_data->time_to_contact;
    $loan_type = 'loan';
    $vendor_id = '253';
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
                <cosignerAvailable>'.$cosigner.'</cosignerAvailable>
                <dob>'.$dob.'</dob>
                <email>'.$email_address.'</email>
                <empMonths>'.$monthsAtResidence.'</empMonths>
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
                <cellPhone>'.$mobile_phone.'</cellPhone>
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
                preg_match('/<Status>(.*)<\/Status>/' , $res_1 , $status_1);
		preg_match('/<Price>(.*)<\/Price>/' , $res_1 , $price);
		preg_match('/<MAXTIME>(.*)<\/MAXTIME>/' , $res_1 , $maxtime);
		preg_match('/<L_LEADID>(.*)<\/L_LEADID>/' , $res_1 , $leadid);
		preg_match('/<Message>(.*)<\/Message>/' , $res_1 , $message );
		
                $myFile_ping_response = "ping_post_request/ping_adaroo".$lead_data->lead_auto_id.".txt";
                $fh = fopen($myFile_ping_response, 'w') or die("can't open file");
                $file_string = "Ping URL::>".$url_1."\n\n";
                $file_string.= "Ping Data::>".$ping_data."\n\n";
                $file_string.= "Ping Response::>".$res_1."\n\n";
                fwrite($fh, $file_string);
                fclose($fh);
             
            if($status_1[1] == 'Accepted')
            {
                $post_data = str_replace('RRRRRRR' ,$leadid[1], $post_data);
                $ping_response ='Accepted with Price:'.$price;
                $post_request = '<a href="'.Kohana::$base_url.$myFile_post.'" target="_blank">View Request</a>';
                $header1 = array();
                $header1[] = "Content-Type: text/xml"; 
                $header1[] .= "Content-Length: ".strlen($post_data);
                
                $res_2 = $this->curlposting($url_2, $post_data, $header1);
		
                preg_match('/<Status>(.*)<\/Status>/' , $res_2 , $status_2);
                preg_match('/<L_LEADID>(.*)<\/L_LEADID>/' , $res_2 , $leadid2);
                preg_match('/<Message>(.*)<\/Message>/' , $res_2 , $message2);
                
                $myFile_post = "ping_post_request/post_adaroo".$lead_data->lead_auto_id.".txt";
                $fh_post = fopen($myFile_post, 'w') or die("can't open file");
                $file_string_post = "Post URL::>".$url_2."\n\n";
                $file_string_post.= "Post Data::>".$post_data."\n\n";
                $file_string_post.= "Post Result::>".$res_2."\n\n";                           
                fwrite($fh_post, $file_string_post);
                fclose($fh_post);
                $return_ping = 0;
                $objLeads_submit->ping_response ='Success';
                
                if($status_2[1] == 'Accepted'){	
                    $post_response = 'Adaroo Auto-Accepted Price:' .$price[1];
                    $return_post = false;
                    $objLeads_submit->post_response ='Success';
                    $objLeads_submit->price = $price[1];
	
                }else{
                        $post_response = 'Adaroo-Rejected';
                        $return_post = true;//Call the other function
                        $objLeads_submit->post_response ='Fail';
                        $objLeads_submit->price = 0;
                        $leadassign = 1;
                }
                 
            }
        else // Lead Rejected
        {
            $ping_response ='Adaroo Ping Rejected';
            $comment_admin = ', Adaroo Auto-Rejected';
            $post_response = 'N/A';
            $post_request = '-';
            $leadassign = 1;
            $return_ping = true;//Call the other function
            $objLeads_submit->ping_response ='Fail';
            $objLeads_submit->post_response ='Fail';
        }
        $objLeads_submit->lead_id =$lead_data->lead_auto_id;
        $objLeads_submit->client_id =35;
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
   }
 
  function dmn_auto($lead_data,$multiple)
  {
      $objLeads_submit = ORM::factory('leadsubmit');
      $ping_url = 'http://service.dmnleads.com/LeadEngine/Ping.ashx';//DynamicPricePing
      $post_url = 'http://service.dmnleads.com/LeadEngine/Post.ashx';
      $header = array('Content-Type: application/x-www-form-urlencoded') ;//'Content-Type: application/x-www-form-urlencoded'; 
      $zip = urlencode($lead_data->zip);
      $income = urlencode($lead_data->monthly_income);
      $ssn = str_pad($lead_data->ssn, 9 , 0,STR_PAD_LEFT);
      $lead_type_id = 5;
      $IsTest = 'false';
      $passcode = 'Ez8leAw37taYkmJ';
      $SubId ='9999';
      
      $loan_type = 'Dealer Purchase';
      $address = urlencode($lead_data->address);
      $email = urlencode($lead_data->email);
      $first_name = urlencode($lead_data->fname);
      $home_phone=urlencode($lead_data->phone);
      $ip_address=urlencode($lead_data->ip_address);
      $privacy_accept='true';
      $last_name = urlencode($lead_data->lname);
      $work_phone=urlencode($lead_data->work_number);
      $bankruptcy = urlencode($lead_data->bankruptcy)==''?'false':urlencode($lead_data->bankruptcy);
      $dob = date('m/d/Y',strtotime($lead_data->birth_date));
      $employer_month = urlencode($lead_data->month_with_company);
      $employer_name = urlencode($lead_data->employer);
      $employer_year = urlencode($lead_data->year_with_company);
      $job_title = urlencode($lead_data->job_title);
      
      $ResidenceCost=urlencode($lead_data->home_pay);
      $ResidenceMonths=urlencode($lead_data->month_residence);
      $ResidenceType=urlencode($lead_data->rent_own);
      $ResidenceYears=urlencode($lead_data->year_residence);
      $PingID='';
      
      $ping_data = 'Zip='.$zip.'&Income='.$income.'&SSN='.$ssn.'&LeadTypeId=5&IsTest='.$IsTest.'&passcode='.$passcode.'&SubId='.$SubId;
      
        $ping_res = $this->curlposting($ping_url, $ping_data, $header);
     
        $myFile_post = "ping_post_request/dmn_auto_ping_".$lead_data->lead_auto_id.".txt";
        $fh_post = fopen($myFile_post, 'w') or die("can't open file");
        $file_string_post = "Ping URL::>".$ping_url."\n\n";
        $file_string_post.= "Ping Data::>".$ping_data."\n\n";
        $file_string_post.= "Ping Result::>".$ping_res."\n\n";                           
        fwrite($fh_post, $file_string_post);
        fclose($fh_post);
        $return_ping = 0;
        $objLeads_submit->ping_response ='Success';
        preg_match('/<Result>(.*)<\/Result>/' , $ping_res , $ping_status);
        preg_match('/<PingId>(.*)<\/PingId>/' , $ping_res , $ping_id);
        preg_match('/<Price>(.*)<\/Price>/' , $ping_res , $price);
     
	 //print_r($ping_res); echo "<br>=====================<br>";
		//print_r($ping_status[1]);
     
     if($ping_status[1]=='Success')
     { 
		//echo "in POST";
        $post_data='LoanType='.$loan_type.'&AddressLine1='.$address.'&Email='.$email.'&FirstName='.$first_name.'&HomePhone='.$home_phone.'&IPAddress='.$ip_address.'&PrivacyAccept='.$privacy_accept.'&LastName='.$last_name.'&WorkPhone='.$work_phone.'&Bankruptcy='.$bankruptcy.'&DOB='.$dob.'&EmployerMonths='.$employer_month.'&EmployerName='.$employer_name.'&EmployerYears='.$employer_year.'&JobTitle='.$job_title.'&ResidenceCost='.$ResidenceCost.'&ResidenceMonths='.$ResidenceMonths.'&ResidenceType='.$ResidenceType.'&ResidenceYears='.$ResidenceYears.'&PingID='.$ping_id[1].'&IsTest='.$IsTest;
        $post_res = $this->curlposting($post_url, $post_data, $header); 
        
            preg_match('/<Result>(.*)<\/Result>/' , $post_res , $status_post);
            preg_match('/<Error>(.*)<\/Error>/' , $post_res , $error);
            
			//print_r($post_res); echo "<br>=====================<br>";
			
			//print_r($status_post);
			
            $myFile_post = "ping_post_request/dmn_auto_post_".$lead_data->lead_auto_id.".txt";
            $fh_post = fopen($myFile_post, 'w') or die("can't open file");
            $file_string_post = "Post URL::>".$post_url."\n\n";
            $file_string_post.= "Post Data::>".$post_data."\n\n";
            $file_string_post.= "Post Result::>".$post_res."\n\n";                           
            fwrite($fh_post, $file_string_post);
            fclose($fh_post);
            if($status_post[1] != 'Fail'){	
                $post_response = 'DMN_Auto (VG)-Accepted Price:' .$price[1];
                $return_post = false;
                $objLeads_submit->post_response ='Success';
				$objLeads_submit->ping_response ='Success';
                $objLeads_submit->price = $price[1];

            }else{
                    $post_response = 'DMN_Auto (VG)-Rejected';
                    $return_post = true;//Call the other function
                    $objLeads_submit->post_response ='Fail';
					$objLeads_submit->ping_response ='Success';
                    $objLeads_submit->price = 0;
                    $leadassign = 1;
            }
     }
    else // Lead Rejected
      {
          $ping_response ='DMN_Auto (VG) Ping Rejected';
          $comment_admin = ', DMN_Auto (VG)-Rejected';
          $post_response = 'N/A';
          $post_request = '-';
          $leadassign = 1;
          $return_ping = true;//Call the other function
          $objLeads_submit->ping_response ='Fail';
          $objLeads_submit->post_response ='Fail';
      }
        $objLeads_submit->lead_id =$lead_data->lead_auto_id;
        $objLeads_submit->client_id =36;
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
  }    function VIGATEL_Payday($lead_data,$multiple)  {	$objLeads_submit = ORM::factory('leadsubmit');    $post_url = 'http://vigatel.leadcapsule.com/Leads/LeadPost.aspx';    $header = array('Content-Type: application/x-www-form-urlencoded') ;//'Content-Type: application/x-www-form-urlencoded'; 		 $CampaignId='BFDDF297D7D0CF47FF2A6A651849DB9B';	 $FirstName=$lead_data->fname;	 $LastName=$lead_data->lname;	 $Address1=$lead_data->address;	 $City=$lead_data->city;	 $State=$lead_data->state;	 $Zip=$lead_data->zip;	 $Phone=$lead_data->phone;	 $Email=$lead_data->email;	 $Social=$lead_data->ssn;	 $DateOfBirth=date('m/d/Y',strtotime($lead_data->dob));	 $AmountRequested=$lead_data->loan_amount;	 $DriversLicenseNumber=$lead_data->driving_license;	 $DriversLicenseState=$lead_data->state_issued_id;	 $Gender=$lead_data->gender;	 $IncomeType=$lead_data->income_type;	 $Employer=$lead_data->employer_name;	 $EmployerPhone=$lead_data->employer_phone;	 $JobTitle=$lead_data->job_title;	 $employer_year = $lead_data->employer_year;	 $date1=mktime(0, 0, 0, date("m"), date("d")+1, date("Y")-$employer_year);	 $DateHired = date('m/d/Y', $date1); 	 $MonthlyIncome=$lead_data->monthly_income;	 $PayFrequency=$lead_data->income_frequency;	 $PayDateOne=date('m/d/Y',strtotime($lead_data->pay_date1));	 $PayDateTwo=date('m/d/Y',strtotime($lead_data->pay_date2));	 $ActiveMilitary=$lead_data->military;	 $BankName=$lead_data->bank_name;	 $BankAccountOpenDate="";	 $BankAccountNumber=$lead_data->bank_account_number;	 $BankAccountType=$lead_data->bank_account_type;	 $BankRoutingNumber=str_pad($lead_data->bank_aba, 9 , 0,STR_PAD_LEFT);	 $DirectDepost=$lead_data->income_direct_deposit;	 $BankPhone=$lead_data->employer_phone;	 $Refereence1FirstName=$lead_data->reference_name1;	 $Refereence1LastName=$lead_data->reference_name1;	 $Refereence1HomePhone=$lead_data->reference_phone1;	 $Refereence1Address='';	 $Refereence1Address2='';	 $Refereence1Relationship=$lead_data->reference_relationship1;	 $HomeStatus=$lead_data->residence_type=='Own'?'O':'R';	 $HomeLength=$lead_data->residence_years;	 $BestTimeToCall=$lead_data->best_call_time;	 $LandingPage="www.web.com";	 $IPAddress=$lead_data->ip_address;	 $IsTest = 'false';	 	 $post_data = "CampaignId=".$CampaignId."&FirstName=".$FirstName."&LastName=".$LastName."&Address1=".$Address1."&City=".$City."&State=".$State."&Zip=".$Zip."&Phone=".$Phone."&Email=".$Email."&Social=".$Social."&DateOfBirth=".$DateOfBirth."&AmountRequested=".$AmountRequested."&DriversLicenseNumber=".$DriversLicenseNumber."&DriversLicenseState=".$DriversLicenseState."&Gender=".$Gender."&IncomeType=".$IncomeType."&Employer=".$Employer."&EmployerPhone=".$EmployerPhone."&JobTitle=".$JobTitle."&DateHired=".$DateHired."&MonthlyIncome=".$MonthlyIncome."&PayFrequency=".$PayFrequency."&PayDateOne=".$PayDateOne."&PayDateTwo=".$PayDateTwo."&ActiveMilitary=".$ActiveMilitary."&BankName=".$BankName."&BankAccountOpenDate=".$BankAccountOpenDate."&BankAccountNumber=".$BankAccountNumber."&BankAccountType=".$BankAccountType."&BankRoutingNumber=".$BankRoutingNumber."&DirectDepost=".$DirectDepost."&BankPhone=".$BankPhone."&Refereence1FirstName=".$Refereence1FirstName."&Refereence1LastName=".$Refereence1LastName."&Refereence1HomePhone=".$Refereence1HomePhone."&Refereence1Address=".$Refereence1Address."&Refereence1Address2=".$Refereence1Address2."&Refereence1Relationship=".$Refereence1Relationship."&HomeStatus=".$HomeStatus."&HomeLength=".$HomeLength."&BestTimeToCall=".$BestTimeToCall."&LandingPage=".$LandingPage."&IPAddress=".$IPAddress;	 $post_res = $this->curlposting($post_url, $post_data, $header); 	 	 	      preg_match('/<Price >(.*)<\/Price >/' , $post_res , $price);     preg_match('/<IsValid>(.*)<\/IsValid>/' , $post_res , $isvalid);            $myFile_post = "ping_post_request/post_VIGATEL_Payday".$lead_data->payday_id.".txt";            $fh_post = fopen($myFile_post, 'w') or die("can't open file");            $file_string_post = "Post URL::>".$post_url."\n\n";            $file_string_post.= "Post Data::>".$post_data."\n\n";            $file_string_post.= "Post Result::>".$post_res."\n\n";                                       fwrite($fh_post, $file_string_post);            fclose($fh_post);			//print_r($post_res);exit;            if($isvalid[1] == 'True'){					if($price[1]=='')					$price[1] = 1;                $post_response = 'VIGATEL_Payday:' .$price[1];                $return_post = false;                $objLeads_submit->post_response ='Success';				$objLeads_submit->ping_response ='Success';                $objLeads_submit->price = $price[1];            }else{                    $post_response = 'VIGATEL_Payday Rejected';                    $return_post = true;//Call the other function                    $objLeads_submit->post_response ='Fail';					$objLeads_submit->ping_response ='Success';                    $objLeads_submit->price = 0;                    $leadassign = 1;            }        $objLeads_submit->lead_id =$lead_data->payday_id;        $objLeads_submit->client_id =39;		$objLeads_submit->lead_types ='Payday';		$objLeads_submit->c_date=$lead_data->c_date;        $objLeads_submit->save();    if($multiple!=1)         {            echo '<tr>                  <td width="1%"><a href="#">'.$lead_data->payday_id.'</a></td>                  <td>Auto</td>                  <td>'.$email_address.'</td>                  <td>'.$home_phone.'</td>                  <td>'.$ssn.'</td>                  <td>'.$ping_response.' <a class="tag red" href="'.Kohana::$base_url.$myFile_ping_response.'" target="_blank">View</a></td>                  <td>'.$post_request.' '.$post_response.'</td>                  <td>'.$price[1].'</td>                </tr>';         }         else         {            $return_array['ping_response'] =  $return_ping;            $return_array['post_response'] = $return_post;            $return_array['price'] = $price[1];            return $return_array;         }       exit;  }  function VIGATEL_Payday_2($lead_data,$multiple)  {	$objLeads_submit = ORM::factory('leadsubmit');    $post_url = 'http://vigatel.leadcapsule.com/Leads/LeadPost.aspx';    $header = array('Content-Type: application/x-www-form-urlencoded') ;//'Content-Type: application/x-www-form-urlencoded'; 		 $CampaignId='81E556B3D097AB023E24FF8A6DBEE36A';	 $FirstName=$lead_data->fname;	 $LastName=$lead_data->lname;	 $Address1=$lead_data->address;	 $City=$lead_data->city;	 $State=$lead_data->state;	 $Zip=$lead_data->zip;	 $Phone=$lead_data->phone;	 $Email=$lead_data->email;	 $Social=$lead_data->ssn;	 $DateOfBirth=date('m/d/Y',strtotime($lead_data->dob));	 $AmountRequested=$lead_data->loan_amount;	 $DriversLicenseNumber=$lead_data->driving_license;	 $DriversLicenseState=$lead_data->state_issued_id;	 $Gender=$lead_data->gender;	 $IncomeType=$lead_data->income_type;	 $Employer=$lead_data->employer_name;	 $EmployerPhone=$lead_data->employer_phone;	 $JobTitle=$lead_data->job_title;	 $employer_year = $lead_data->employer_year;	 $date1=mktime(0, 0, 0, date("m"), date("d")+1, date("Y")-$employer_year);	 $DateHired = date('m/d/Y', $date1); 	 $MonthlyIncome=$lead_data->monthly_income;	 $PayFrequency=$lead_data->income_frequency;	 $PayDateOne=date('m/d/Y',strtotime($lead_data->pay_date1));	 $PayDateTwo=date('m/d/Y',strtotime($lead_data->pay_date2));	 $ActiveMilitary=$lead_data->military;	 $BankName=$lead_data->bank_name;	 $BankAccountOpenDate="";	 $BankAccountNumber=$lead_data->bank_account_number;	 $BankAccountType=$lead_data->bank_account_type;	 $BankRoutingNumber=str_pad($lead_data->bank_aba, 9 , 0,STR_PAD_LEFT);	 $DirectDepost=$lead_data->income_direct_deposit;	 $BankPhone=$lead_data->employer_phone;	 $Refereence1FirstName=$lead_data->reference_name1;	 $Refereence1LastName=$lead_data->reference_name1;	 $Refereence1HomePhone=$lead_data->reference_phone1;	 $Refereence1Address='';	 $Refereence1Address2='';	 $Refereence1Relationship=$lead_data->reference_relationship1;	 $HomeStatus=$lead_data->residence_type=='Own'?'O':'R';	 $HomeLength=$lead_data->residence_years;	 $BestTimeToCall=$lead_data->best_call_time;	 $LandingPage="www.web.com";	 $IPAddress=$lead_data->ip_address;	 $IsTest = 'false';	 	 $post_data = "CampaignId=".$CampaignId."&FirstName=".$FirstName."&LastName=".$LastName."&Address1=".$Address1."&City=".$City."&State=".$State."&Zip=".$Zip."&Phone=".$Phone."&Email=".$Email."&Social=".$Social."&DateOfBirth=".$DateOfBirth."&AmountRequested=".$AmountRequested."&DriversLicenseNumber=".$DriversLicenseNumber."&DriversLicenseState=".$DriversLicenseState."&Gender=".$Gender."&IncomeType=".$IncomeType."&Employer=".$Employer."&EmployerPhone=".$EmployerPhone."&JobTitle=".$JobTitle."&DateHired=".$DateHired."&MonthlyIncome=".$MonthlyIncome."&PayFrequency=".$PayFrequency."&PayDateOne=".$PayDateOne."&PayDateTwo=".$PayDateTwo."&ActiveMilitary=".$ActiveMilitary."&BankName=".$BankName."&BankAccountOpenDate=".$BankAccountOpenDate."&BankAccountNumber=".$BankAccountNumber."&BankAccountType=".$BankAccountType."&BankRoutingNumber=".$BankRoutingNumber."&DirectDepost=".$DirectDepost."&BankPhone=".$BankPhone."&Refereence1FirstName=".$Refereence1FirstName."&Refereence1LastName=".$Refereence1LastName."&Refereence1HomePhone=".$Refereence1HomePhone."&Refereence1Address=".$Refereence1Address."&Refereence1Address2=".$Refereence1Address2."&Refereence1Relationship=".$Refereence1Relationship."&HomeStatus=".$HomeStatus."&HomeLength=".$HomeLength."&BestTimeToCall=".$BestTimeToCall."&LandingPage=".$LandingPage."&IPAddress=".$IPAddress;	 $post_res = $this->curlposting($post_url, $post_data, $header); 	 	 	      preg_match('/<Price >(.*)<\/Price >/' , $post_res , $price);     preg_match('/<IsValid>(.*)<\/IsValid>/' , $post_res , $isvalid);            $myFile_post = "ping_post_request/post_VIGATEL_Payday_2".$lead_data->payday_id.".txt";            $fh_post = fopen($myFile_post, 'w') or die("can't open file");            $file_string_post = "Post URL::>".$post_url."\n\n";            $file_string_post.= "Post Data::>".$post_data."\n\n";            $file_string_post.= "Post Result::>".$post_res."\n\n";                                       fwrite($fh_post, $file_string_post);            fclose($fh_post);			//print_r($post_res);exit;            if($isvalid[1] == 'True'){					if($price[1]=='')					$price[1] = 2;                $post_response = 'VIGATEL_Payday:' .$price[1];                $return_post = false;                $objLeads_submit->post_response ='Success';				$objLeads_submit->ping_response ='Success';                $objLeads_submit->price = $price[1];            }else{                    $post_response = 'VIGATEL_Payday Rejected';                    $return_post = true;//Call the other function                    $objLeads_submit->post_response ='Fail';					$objLeads_submit->ping_response ='Success';                    $objLeads_submit->price = 0;                    $leadassign = 1;            }        $objLeads_submit->lead_id =$lead_data->payday_id;        $objLeads_submit->client_id =40;		$objLeads_submit->lead_types ='Payday';		$objLeads_submit->c_date=$lead_data->c_date;        $objLeads_submit->save();    if($multiple!=1)         {            echo '<tr>                  <td width="1%"><a href="#">'.$lead_data->payday_id.'</a></td>                  <td>Auto</td>                  <td>'.$email_address.'</td>                  <td>'.$home_phone.'</td>                  <td>'.$ssn.'</td>                  <td>'.$ping_response.' <a class="tag red" href="'.Kohana::$base_url.$myFile_ping_response.'" target="_blank">View</a></td>                  <td>'.$post_request.' '.$post_response.'</td>                  <td>'.$price[1].'</td>                </tr>';         }         else         {            $return_array['ping_response'] =  $return_ping;            $return_array['post_response'] = $return_post;            $return_array['price'] = $price[1];            return $return_array;         }       exit;  }  function VIGATEL_Payday_5($lead_data,$multiple)  {	$objLeads_submit = ORM::factory('leadsubmit');    $post_url = 'http://vigatel.leadcapsule.com/Leads/LeadPost.aspx';    $header = array('Content-Type: application/x-www-form-urlencoded') ;//'Content-Type: application/x-www-form-urlencoded'; 		 $CampaignId='A0D2734B9BB8E73C67584526DBAD4DC4';	 $FirstName=$lead_data->fname;	 $LastName=$lead_data->lname;	 $Address1=$lead_data->address;	 $City=$lead_data->city;	 $State=$lead_data->state;	 $Zip=$lead_data->zip;	 $Phone=$lead_data->phone;	 $Email=$lead_data->email;	 $Social=$lead_data->ssn;	 $DateOfBirth=date('m/d/Y',strtotime($lead_data->dob));	 $AmountRequested=$lead_data->loan_amount;	 $DriversLicenseNumber=$lead_data->driving_license;	 $DriversLicenseState=$lead_data->state_issued_id;	 $Gender=$lead_data->gender;	 $IncomeType=$lead_data->income_type;	 $Employer=$lead_data->employer_name;	 $EmployerPhone=$lead_data->employer_phone;	 $JobTitle=$lead_data->job_title;	 $employer_year = $lead_data->employer_year;	 $date1=mktime(0, 0, 0, date("m"), date("d")+1, date("Y")-$employer_year);	 $DateHired = date('m/d/Y', $date1); 	 $MonthlyIncome=$lead_data->monthly_income;	 $PayFrequency=$lead_data->income_frequency;	 $PayDateOne=date('m/d/Y',strtotime($lead_data->pay_date1));	 $PayDateTwo=date('m/d/Y',strtotime($lead_data->pay_date2));	 $ActiveMilitary=$lead_data->military;	 $BankName=$lead_data->bank_name;	 $BankAccountOpenDate="";	 $BankAccountNumber=$lead_data->bank_account_number;	 $BankAccountType=$lead_data->bank_account_type;	 $BankRoutingNumber=str_pad($lead_data->bank_aba, 9 , 0,STR_PAD_LEFT);	 $DirectDepost=$lead_data->income_direct_deposit;	 $BankPhone=$lead_data->employer_phone;	 $Refereence1FirstName=$lead_data->reference_name1;	 $Refereence1LastName=$lead_data->reference_name1;	 $Refereence1HomePhone=$lead_data->reference_phone1;	 $Refereence1Address='';	 $Refereence1Address2='';	 $Refereence1Relationship=$lead_data->reference_relationship1;	 $HomeStatus=$lead_data->residence_type=='Own'?'O':'R';	 $HomeLength=$lead_data->residence_years;	 $BestTimeToCall=$lead_data->best_call_time;	 $LandingPage="www.web.com";	 $IPAddress=$lead_data->ip_address;	 $IsTest = 'false';	 	 $post_data = "CampaignId=".$CampaignId."&FirstName=".$FirstName."&LastName=".$LastName."&Address1=".$Address1."&City=".$City."&State=".$State."&Zip=".$Zip."&Phone=".$Phone."&Email=".$Email."&Social=".$Social."&DateOfBirth=".$DateOfBirth."&AmountRequested=".$AmountRequested."&DriversLicenseNumber=".$DriversLicenseNumber."&DriversLicenseState=".$DriversLicenseState."&Gender=".$Gender."&IncomeType=".$IncomeType."&Employer=".$Employer."&EmployerPhone=".$EmployerPhone."&JobTitle=".$JobTitle."&DateHired=".$DateHired."&MonthlyIncome=".$MonthlyIncome."&PayFrequency=".$PayFrequency."&PayDateOne=".$PayDateOne."&PayDateTwo=".$PayDateTwo."&ActiveMilitary=".$ActiveMilitary."&BankName=".$BankName."&BankAccountOpenDate=".$BankAccountOpenDate."&BankAccountNumber=".$BankAccountNumber."&BankAccountType=".$BankAccountType."&BankRoutingNumber=".$BankRoutingNumber."&DirectDepost=".$DirectDepost."&BankPhone=".$BankPhone."&Refereence1FirstName=".$Refereence1FirstName."&Refereence1LastName=".$Refereence1LastName."&Refereence1HomePhone=".$Refereence1HomePhone."&Refereence1Address=".$Refereence1Address."&Refereence1Address2=".$Refereence1Address2."&Refereence1Relationship=".$Refereence1Relationship."&HomeStatus=".$HomeStatus."&HomeLength=".$HomeLength."&BestTimeToCall=".$BestTimeToCall."&LandingPage=".$LandingPage."&IPAddress=".$IPAddress;	 $post_res = $this->curlposting($post_url, $post_data, $header); 	 	 	      preg_match('/<Price >(.*)<\/Price >/' , $post_res , $price);     preg_match('/<IsValid>(.*)<\/IsValid>/' , $post_res , $isvalid);            $myFile_post = "ping_post_request/post_VIGATEL_Payday_5".$lead_data->payday_id.".txt";            $fh_post = fopen($myFile_post, 'w') or die("can't open file");            $file_string_post = "Post URL::>".$post_url."\n\n";            $file_string_post.= "Post Data::>".$post_data."\n\n";            $file_string_post.= "Post Result::>".$post_res."\n\n";                                       fwrite($fh_post, $file_string_post);            fclose($fh_post);			//print_r($post_res);exit;            if($isvalid[1] == 'True'){					if($price[1]=='')					$price[1] = 5;                $post_response = 'VIGATEL_Payday:' .$price[1];                $return_post = false;                $objLeads_submit->post_response ='Success';				$objLeads_submit->ping_response ='Success';                $objLeads_submit->price = $price[1];            }else{                    $post_response = 'VIGATEL_Payday Rejected';                    $return_post = true;//Call the other function                    $objLeads_submit->post_response ='Fail';					$objLeads_submit->ping_response ='Success';                    $objLeads_submit->price = 0;                    $leadassign = 1;            }        $objLeads_submit->lead_id =$lead_data->payday_id;        $objLeads_submit->client_id =41;		$objLeads_submit->lead_types ='Payday';		$objLeads_submit->c_date=$lead_data->c_date;        $objLeads_submit->save();    if($multiple!=1)         {            echo '<tr>                  <td width="1%"><a href="#">'.$lead_data->payday_id.'</a></td>                  <td>Auto</td>                  <td>'.$email_address.'</td>                  <td>'.$home_phone.'</td>                  <td>'.$ssn.'</td>                  <td>'.$ping_response.' <a class="tag red" href="'.Kohana::$base_url.$myFile_ping_response.'" target="_blank">View</a></td>                  <td>'.$post_request.' '.$post_response.'</td>                  <td>'.$price[1].'</td>                </tr>';         }         else         {            $return_array['ping_response'] =  $return_ping;            $return_array['post_response'] = $return_post;            $return_array['price'] = $price[1];            return $return_array;         }       exit;  }    function VIGATEL_Payday_10($lead_data,$multiple)  {	$objLeads_submit = ORM::factory('leadsubmit');    $post_url = 'http://vigatel.leadcapsule.com/Leads/LeadPost.aspx';    $header = array('Content-Type: application/x-www-form-urlencoded') ;//'Content-Type: application/x-www-form-urlencoded'; 		 $CampaignId='B81853F6637169CE2DF0447FE7C305E7';	 $FirstName=$lead_data->fname;	 $LastName=$lead_data->lname;	 $Address1=$lead_data->address;	 $City=$lead_data->city;	 $State=$lead_data->state;	 $Zip=$lead_data->zip;	 $Phone=$lead_data->phone;	 $Email=$lead_data->email;	 $Social=$lead_data->ssn;	 $DateOfBirth=date('m/d/Y',strtotime($lead_data->dob));	 $AmountRequested=$lead_data->loan_amount;	 $DriversLicenseNumber=$lead_data->driving_license;	 $DriversLicenseState=$lead_data->state_issued_id;	 $Gender=$lead_data->gender;	 $IncomeType=$lead_data->income_type;	 $Employer=$lead_data->employer_name;	 $EmployerPhone=$lead_data->employer_phone;	 $JobTitle=$lead_data->job_title;	 $employer_year = $lead_data->employer_year;	 $date1=mktime(0, 0, 0, date("m"), date("d")+1, date("Y")-$employer_year);	 $DateHired = date('m/d/Y', $date1); 	 $MonthlyIncome=$lead_data->monthly_income;	 $PayFrequency=$lead_data->income_frequency;	 $PayDateOne=date('m/d/Y',strtotime($lead_data->pay_date1));	 $PayDateTwo=date('m/d/Y',strtotime($lead_data->pay_date2));	 $ActiveMilitary=$lead_data->military;	 $BankName=$lead_data->bank_name;	 $BankAccountOpenDate="";	 $BankAccountNumber=$lead_data->bank_account_number;	 $BankAccountType=$lead_data->bank_account_type;	 $BankRoutingNumber=str_pad($lead_data->bank_aba, 9 , 0,STR_PAD_LEFT);	 $DirectDepost=$lead_data->income_direct_deposit;	 $BankPhone=$lead_data->employer_phone;	 $Refereence1FirstName=$lead_data->reference_name1;	 $Refereence1LastName=$lead_data->reference_name1;	 $Refereence1HomePhone=$lead_data->reference_phone1;	 $Refereence1Address='';	 $Refereence1Address2='';	 $Refereence1Relationship=$lead_data->reference_relationship1;	 $HomeStatus=$lead_data->residence_type=='Own'?'O':'R';	 $HomeLength=$lead_data->residence_years;	 $BestTimeToCall=$lead_data->best_call_time;	 $LandingPage="www.web.com";	 $IPAddress=$lead_data->ip_address;	 $IsTest = 'false';	 	 $post_data = "CampaignId=".$CampaignId."&FirstName=".$FirstName."&LastName=".$LastName."&Address1=".$Address1."&City=".$City."&State=".$State."&Zip=".$Zip."&Phone=".$Phone."&Email=".$Email."&Social=".$Social."&DateOfBirth=".$DateOfBirth."&AmountRequested=".$AmountRequested."&DriversLicenseNumber=".$DriversLicenseNumber."&DriversLicenseState=".$DriversLicenseState."&Gender=".$Gender."&IncomeType=".$IncomeType."&Employer=".$Employer."&EmployerPhone=".$EmployerPhone."&JobTitle=".$JobTitle."&DateHired=".$DateHired."&MonthlyIncome=".$MonthlyIncome."&PayFrequency=".$PayFrequency."&PayDateOne=".$PayDateOne."&PayDateTwo=".$PayDateTwo."&ActiveMilitary=".$ActiveMilitary."&BankName=".$BankName."&BankAccountOpenDate=".$BankAccountOpenDate."&BankAccountNumber=".$BankAccountNumber."&BankAccountType=".$BankAccountType."&BankRoutingNumber=".$BankRoutingNumber."&DirectDepost=".$DirectDepost."&BankPhone=".$BankPhone."&Refereence1FirstName=".$Refereence1FirstName."&Refereence1LastName=".$Refereence1LastName."&Refereence1HomePhone=".$Refereence1HomePhone."&Refereence1Address=".$Refereence1Address."&Refereence1Address2=".$Refereence1Address2."&Refereence1Relationship=".$Refereence1Relationship."&HomeStatus=".$HomeStatus."&HomeLength=".$HomeLength."&BestTimeToCall=".$BestTimeToCall."&LandingPage=".$LandingPage."&IPAddress=".$IPAddress;	 $post_res = $this->curlposting($post_url, $post_data, $header); 	 	 	      preg_match('/<Price >(.*)<\/Price >/' , $post_res , $price);     preg_match('/<IsValid>(.*)<\/IsValid>/' , $post_res , $isvalid);            $myFile_post = "ping_post_request/post_VIGATEL_Payday_10".$lead_data->payday_id.".txt";            $fh_post = fopen($myFile_post, 'w') or die("can't open file");            $file_string_post = "Post URL::>".$post_url."\n\n";            $file_string_post.= "Post Data::>".$post_data."\n\n";            $file_string_post.= "Post Result::>".$post_res."\n\n";                                       fwrite($fh_post, $file_string_post);            fclose($fh_post);			//print_r($post_res);exit;            if($isvalid[1] == 'True'){					if($price[1]=='')					$price[1] = 10;                $post_response = 'VIGATEL_Payday:' .$price[1];                $return_post = false;                $objLeads_submit->post_response ='Success';				$objLeads_submit->ping_response ='Success';                $objLeads_submit->price = $price[1];            }else{                    $post_response = 'VIGATEL_Payday Rejected';                    $return_post = true;//Call the other function                    $objLeads_submit->post_response ='Fail';					$objLeads_submit->ping_response ='Success';                    $objLeads_submit->price = 0;                    $leadassign = 1;            }        $objLeads_submit->lead_id =$lead_data->payday_id;        $objLeads_submit->client_id =42;		$objLeads_submit->lead_types ='Payday';		$objLeads_submit->c_date=$lead_data->c_date;        $objLeads_submit->save();    if($multiple!=1)         {            echo '<tr>                  <td width="1%"><a href="#">'.$lead_data->payday_id.'</a></td>                  <td>Auto</td>                  <td>'.$email_address.'</td>                  <td>'.$home_phone.'</td>                  <td>'.$ssn.'</td>                  <td>'.$ping_response.' <a class="tag red" href="'.Kohana::$base_url.$myFile_ping_response.'" target="_blank">View</a></td>                  <td>'.$post_request.' '.$post_response.'</td>                  <td>'.$price[1].'</td>                </tr>';         }         else         {            $return_array['ping_response'] =  $return_ping;            $return_array['post_response'] = $return_post;            $return_array['price'] = $price[1];            return $return_array;         }       exit;  }  function VIGATEL_Payday_20($lead_data,$multiple)  {	$objLeads_submit = ORM::factory('leadsubmit');    $post_url = 'http://vigatel.leadcapsule.com/Leads/LeadPost.aspx';    $header = array('Content-Type: application/x-www-form-urlencoded') ;//'Content-Type: application/x-www-form-urlencoded'; 		 $CampaignId='1C5B52DDB848E9B99E69DE8C25B301C2';	 $FirstName=$lead_data->fname;	 $LastName=$lead_data->lname;	 $Address1=$lead_data->address;	 $City=$lead_data->city;	 $State=$lead_data->state;	 $Zip=$lead_data->zip;	 $Phone=$lead_data->phone;	 $Email=$lead_data->email;	 $Social=$lead_data->ssn;	 $DateOfBirth=date('m/d/Y',strtotime($lead_data->dob));	 $AmountRequested=$lead_data->loan_amount;	 $DriversLicenseNumber=$lead_data->driving_license;	 $DriversLicenseState=$lead_data->state_issued_id;	 $Gender=$lead_data->gender;	 $IncomeType=$lead_data->income_type;	 $Employer=$lead_data->employer_name;	 $EmployerPhone=$lead_data->employer_phone;	 $JobTitle=$lead_data->job_title;	 $employer_year = $lead_data->employer_year;	 $date1=mktime(0, 0, 0, date("m"), date("d")+1, date("Y")-$employer_year);	 $DateHired = date('m/d/Y', $date1); 	 $MonthlyIncome=$lead_data->monthly_income;	 $PayFrequency=$lead_data->income_frequency;	 $PayDateOne=date('m/d/Y',strtotime($lead_data->pay_date1));	 $PayDateTwo=date('m/d/Y',strtotime($lead_data->pay_date2));	 $ActiveMilitary=$lead_data->military;	 $BankName=$lead_data->bank_name;	 $BankAccountOpenDate="";	 $BankAccountNumber=$lead_data->bank_account_number;	 $BankAccountType=$lead_data->bank_account_type;	 $BankRoutingNumber=str_pad($lead_data->bank_aba, 9 , 0,STR_PAD_LEFT);	 $DirectDepost=$lead_data->income_direct_deposit;	 $BankPhone=$lead_data->employer_phone;	 $Refereence1FirstName=$lead_data->reference_name1;	 $Refereence1LastName=$lead_data->reference_name1;	 $Refereence1HomePhone=$lead_data->reference_phone1;	 $Refereence1Address='';	 $Refereence1Address2='';	 $Refereence1Relationship=$lead_data->reference_relationship1;	 $HomeStatus=$lead_data->residence_type=='Own'?'O':'R';	 $HomeLength=$lead_data->residence_years;	 $BestTimeToCall=$lead_data->best_call_time;	 $LandingPage="www.web.com";	 $IPAddress=$lead_data->ip_address;	 $IsTest = 'false';	 	 $post_data = "CampaignId=".$CampaignId."&FirstName=".$FirstName."&LastName=".$LastName."&Address1=".$Address1."&City=".$City."&State=".$State."&Zip=".$Zip."&Phone=".$Phone."&Email=".$Email."&Social=".$Social."&DateOfBirth=".$DateOfBirth."&AmountRequested=".$AmountRequested."&DriversLicenseNumber=".$DriversLicenseNumber."&DriversLicenseState=".$DriversLicenseState."&Gender=".$Gender."&IncomeType=".$IncomeType."&Employer=".$Employer."&EmployerPhone=".$EmployerPhone."&JobTitle=".$JobTitle."&DateHired=".$DateHired."&MonthlyIncome=".$MonthlyIncome."&PayFrequency=".$PayFrequency."&PayDateOne=".$PayDateOne."&PayDateTwo=".$PayDateTwo."&ActiveMilitary=".$ActiveMilitary."&BankName=".$BankName."&BankAccountOpenDate=".$BankAccountOpenDate."&BankAccountNumber=".$BankAccountNumber."&BankAccountType=".$BankAccountType."&BankRoutingNumber=".$BankRoutingNumber."&DirectDepost=".$DirectDepost."&BankPhone=".$BankPhone."&Refereence1FirstName=".$Refereence1FirstName."&Refereence1LastName=".$Refereence1LastName."&Refereence1HomePhone=".$Refereence1HomePhone."&Refereence1Address=".$Refereence1Address."&Refereence1Address2=".$Refereence1Address2."&Refereence1Relationship=".$Refereence1Relationship."&HomeStatus=".$HomeStatus."&HomeLength=".$HomeLength."&BestTimeToCall=".$BestTimeToCall."&LandingPage=".$LandingPage."&IPAddress=".$IPAddress;	 $post_res = $this->curlposting($post_url, $post_data, $header); 	 	 	      preg_match('/<Price >(.*)<\/Price >/' , $post_res , $price);     preg_match('/<IsValid>(.*)<\/IsValid>/' , $post_res , $isvalid);            $myFile_post = "ping_post_request/post_VIGATEL_Payday_20".$lead_data->payday_id.".txt";            $fh_post = fopen($myFile_post, 'w') or die("can't open file");            $file_string_post = "Post URL::>".$post_url."\n\n";            $file_string_post.= "Post Data::>".$post_data."\n\n";            $file_string_post.= "Post Result::>".$post_res."\n\n";                                       fwrite($fh_post, $file_string_post);            fclose($fh_post);			//print_r($post_res);exit;            if($isvalid[1] == 'True'){					if($price[1]=='')					$price[1] = 20;                $post_response = 'VIGATEL_Payday:' .$price[1];                $return_post = false;                $objLeads_submit->post_response ='Success';				$objLeads_submit->ping_response ='Success';                $objLeads_submit->price = $price[1];            }else{                    $post_response = 'VIGATEL_Payday Rejected';                    $return_post = true;//Call the other function                    $objLeads_submit->post_response ='Fail';					$objLeads_submit->ping_response ='Success';                    $objLeads_submit->price = 0;                    $leadassign = 1;            }        $objLeads_submit->lead_id =$lead_data->payday_id;        $objLeads_submit->client_id =43;		$objLeads_submit->lead_types ='Payday';		$objLeads_submit->c_date=$lead_data->c_date;        $objLeads_submit->save();    if($multiple!=1)         {            echo '<tr>                  <td width="1%"><a href="#">'.$lead_data->payday_id.'</a></td>                  <td>Auto</td>                  <td>'.$email_address.'</td>                  <td>'.$home_phone.'</td>                  <td>'.$ssn.'</td>                  <td>'.$ping_response.' <a class="tag red" href="'.Kohana::$base_url.$myFile_ping_response.'" target="_blank">View</a></td>                  <td>'.$post_request.' '.$post_response.'</td>                  <td>'.$price[1].'</td>                </tr>';         }         else         {            $return_array['ping_response'] =  $return_ping;            $return_array['post_response'] = $return_post;            $return_array['price'] = $price[1];            return $return_array;         }       exit;  }function VIGATEL_Payday_50($lead_data,$multiple)  {	$objLeads_submit = ORM::factory('leadsubmit');    $post_url = 'http://vigatel.leadcapsule.com/Leads/LeadPost.aspx';    $header = array('Content-Type: application/x-www-form-urlencoded') ;//'Content-Type: application/x-www-form-urlencoded'; 		 $CampaignId='243C884CBC115CE89CCC5AB03AFBEB1F';	 $FirstName=$lead_data->fname;	 $LastName=$lead_data->lname;	 $Address1=$lead_data->address;	 $City=$lead_data->city;	 $State=$lead_data->state;	 $Zip=$lead_data->zip;	 $Phone=$lead_data->phone;	 $Email=$lead_data->email;	 $Social=$lead_data->ssn;	 $DateOfBirth=date('m/d/Y',strtotime($lead_data->dob));	 $AmountRequested=$lead_data->loan_amount;	 $DriversLicenseNumber=$lead_data->driving_license;	 $DriversLicenseState=$lead_data->state_issued_id;	 $Gender=$lead_data->gender;	 $IncomeType=$lead_data->income_type;	 $Employer=$lead_data->employer_name;	 $EmployerPhone=$lead_data->employer_phone;	 $JobTitle=$lead_data->job_title;	 $employer_year = $lead_data->employer_year;	 $date1=mktime(0, 0, 0, date("m"), date("d")+1, date("Y")-$employer_year);	 $DateHired = date('m/d/Y', $date1); 	 $MonthlyIncome=$lead_data->monthly_income;	 $PayFrequency=$lead_data->income_frequency;	 $PayDateOne=date('m/d/Y',strtotime($lead_data->pay_date1));	 $PayDateTwo=date('m/d/Y',strtotime($lead_data->pay_date2));	 $ActiveMilitary=$lead_data->military;	 $BankName=$lead_data->bank_name;	 $BankAccountOpenDate="";	 $BankAccountNumber=$lead_data->bank_account_number;	 $BankAccountType=$lead_data->bank_account_type;	 $BankRoutingNumber=str_pad($lead_data->bank_aba, 9 , 0,STR_PAD_LEFT);	 $DirectDepost=$lead_data->income_direct_deposit;	 $BankPhone=$lead_data->employer_phone;	 $Refereence1FirstName=$lead_data->reference_name1;	 $Refereence1LastName=$lead_data->reference_name1;	 $Refereence1HomePhone=$lead_data->reference_phone1;	 $Refereence1Address='';	 $Refereence1Address2='';	 $Refereence1Relationship=$lead_data->reference_relationship1;	 $HomeStatus=$lead_data->residence_type=='Own'?'O':'R';	 $HomeLength=$lead_data->residence_years;	 $BestTimeToCall=$lead_data->best_call_time;	 $LandingPage="www.web.com";	 $IPAddress=$lead_data->ip_address;	 $IsTest = 'false';	 	 $post_data = "CampaignId=".$CampaignId."&FirstName=".$FirstName."&LastName=".$LastName."&Address1=".$Address1."&City=".$City."&State=".$State."&Zip=".$Zip."&Phone=".$Phone."&Email=".$Email."&Social=".$Social."&DateOfBirth=".$DateOfBirth."&AmountRequested=".$AmountRequested."&DriversLicenseNumber=".$DriversLicenseNumber."&DriversLicenseState=".$DriversLicenseState."&Gender=".$Gender."&IncomeType=".$IncomeType."&Employer=".$Employer."&EmployerPhone=".$EmployerPhone."&JobTitle=".$JobTitle."&DateHired=".$DateHired."&MonthlyIncome=".$MonthlyIncome."&PayFrequency=".$PayFrequency."&PayDateOne=".$PayDateOne."&PayDateTwo=".$PayDateTwo."&ActiveMilitary=".$ActiveMilitary."&BankName=".$BankName."&BankAccountOpenDate=".$BankAccountOpenDate."&BankAccountNumber=".$BankAccountNumber."&BankAccountType=".$BankAccountType."&BankRoutingNumber=".$BankRoutingNumber."&DirectDepost=".$DirectDepost."&BankPhone=".$BankPhone."&Refereence1FirstName=".$Refereence1FirstName."&Refereence1LastName=".$Refereence1LastName."&Refereence1HomePhone=".$Refereence1HomePhone."&Refereence1Address=".$Refereence1Address."&Refereence1Address2=".$Refereence1Address2."&Refereence1Relationship=".$Refereence1Relationship."&HomeStatus=".$HomeStatus."&HomeLength=".$HomeLength."&BestTimeToCall=".$BestTimeToCall."&LandingPage=".$LandingPage."&IPAddress=".$IPAddress;	 $post_res = $this->curlposting($post_url, $post_data, $header); 	 	 	      preg_match('/<Price >(.*)<\/Price >/' , $post_res , $price);     preg_match('/<IsValid>(.*)<\/IsValid>/' , $post_res , $isvalid);            $myFile_post = "ping_post_request/post_VIGATEL_Payday_50".$lead_data->payday_id.".txt";            $fh_post = fopen($myFile_post, 'w') or die("can't open file");            $file_string_post = "Post URL::>".$post_url."\n\n";            $file_string_post.= "Post Data::>".$post_data."\n\n";            $file_string_post.= "Post Result::>".$post_res."\n\n";                                       fwrite($fh_post, $file_string_post);            fclose($fh_post);			//print_r($post_res);exit;            if($isvalid[1] == 'True'){					if($price[1]=='')					$price[1] = 50;                $post_response = 'VIGATEL_Payday:' .$price[1];                $return_post = false;                $objLeads_submit->post_response ='Success';				$objLeads_submit->ping_response ='Success';                $objLeads_submit->price = $price[1];            }else{                    $post_response = 'VIGATEL_Payday Rejected';                    $return_post = true;//Call the other function                    $objLeads_submit->post_response ='Fail';					$objLeads_submit->ping_response ='Success';                    $objLeads_submit->price = 0;                    $leadassign = 1;            }        $objLeads_submit->lead_id =$lead_data->payday_id;        $objLeads_submit->client_id =44;		$objLeads_submit->lead_types ='Payday';		$objLeads_submit->c_date=$lead_data->c_date;        $objLeads_submit->save();    if($multiple!=1)         {            echo '<tr>                  <td width="1%"><a href="#">'.$lead_data->payday_id.'</a></td>                  <td>Auto</td>                  <td>'.$email_address.'</td>                  <td>'.$home_phone.'</td>                  <td>'.$ssn.'</td>                  <td>'.$ping_response.' <a class="tag red" href="'.Kohana::$base_url.$myFile_ping_response.'" target="_blank">View</a></td>                  <td>'.$post_request.' '.$post_response.'</td>                  <td>'.$price[1].'</td>                </tr>';         }         else         {            $return_array['ping_response'] =  $return_ping;            $return_array['post_response'] = $return_post;            $return_array['price'] = $price[1];            return $return_array;         }       exit;  } function VIGATEL_Payday_70($lead_data,$multiple)  {	$objLeads_submit = ORM::factory('leadsubmit');    $post_url = 'http://vigatel.leadcapsule.com/Leads/LeadPost.aspx';    $header = array('Content-Type: application/x-www-form-urlencoded') ;//'Content-Type: application/x-www-form-urlencoded'; 		 $CampaignId='3F99054F9C6EB7AE27483AD5271A3033';	 $FirstName=$lead_data->fname;	 $LastName=$lead_data->lname;	 $Address1=$lead_data->address;	 $City=$lead_data->city;	 $State=$lead_data->state;	 $Zip=$lead_data->zip;	 $Phone=$lead_data->phone;	 $Email=$lead_data->email;	 $Social=$lead_data->ssn;	 $DateOfBirth=date('m/d/Y',strtotime($lead_data->dob));	 $AmountRequested=$lead_data->loan_amount;	 $DriversLicenseNumber=$lead_data->driving_license;	 $DriversLicenseState=$lead_data->state_issued_id;	 $Gender=$lead_data->gender;	 $IncomeType=$lead_data->income_type;	 $Employer=$lead_data->employer_name;	 $EmployerPhone=$lead_data->employer_phone;	 $JobTitle=$lead_data->job_title;	 $employer_year = $lead_data->employer_year;	 $date1=mktime(0, 0, 0, date("m"), date("d")+1, date("Y")-$employer_year);	 $DateHired = date('m/d/Y', $date1); 	 $MonthlyIncome=$lead_data->monthly_income;	 $PayFrequency=$lead_data->income_frequency;	 $PayDateOne=date('m/d/Y',strtotime($lead_data->pay_date1));	 $PayDateTwo=date('m/d/Y',strtotime($lead_data->pay_date2));	 $ActiveMilitary=$lead_data->military;	 $BankName=$lead_data->bank_name;	 $BankAccountOpenDate="";	 $BankAccountNumber=$lead_data->bank_account_number;	 $BankAccountType=$lead_data->bank_account_type;	 $BankRoutingNumber=str_pad($lead_data->bank_aba, 9 , 0,STR_PAD_LEFT);	 $DirectDepost=$lead_data->income_direct_deposit;	 $BankPhone=$lead_data->employer_phone;	 $Refereence1FirstName=$lead_data->reference_name1;	 $Refereence1LastName=$lead_data->reference_name1;	 $Refereence1HomePhone=$lead_data->reference_phone1;	 $Refereence1Address='';	 $Refereence1Address2='';	 $Refereence1Relationship=$lead_data->reference_relationship1;	 $HomeStatus=$lead_data->residence_type=='Own'?'O':'R';	 $HomeLength=$lead_data->residence_years;	 $BestTimeToCall=$lead_data->best_call_time;	 $LandingPage="www.web.com";	 $IPAddress=$lead_data->ip_address;	 $IsTest = 'false';	 	 $post_data = "CampaignId=".$CampaignId."&FirstName=".$FirstName."&LastName=".$LastName."&Address1=".$Address1."&City=".$City."&State=".$State."&Zip=".$Zip."&Phone=".$Phone."&Email=".$Email."&Social=".$Social."&DateOfBirth=".$DateOfBirth."&AmountRequested=".$AmountRequested."&DriversLicenseNumber=".$DriversLicenseNumber."&DriversLicenseState=".$DriversLicenseState."&Gender=".$Gender."&IncomeType=".$IncomeType."&Employer=".$Employer."&EmployerPhone=".$EmployerPhone."&JobTitle=".$JobTitle."&DateHired=".$DateHired."&MonthlyIncome=".$MonthlyIncome."&PayFrequency=".$PayFrequency."&PayDateOne=".$PayDateOne."&PayDateTwo=".$PayDateTwo."&ActiveMilitary=".$ActiveMilitary."&BankName=".$BankName."&BankAccountOpenDate=".$BankAccountOpenDate."&BankAccountNumber=".$BankAccountNumber."&BankAccountType=".$BankAccountType."&BankRoutingNumber=".$BankRoutingNumber."&DirectDepost=".$DirectDepost."&BankPhone=".$BankPhone."&Refereence1FirstName=".$Refereence1FirstName."&Refereence1LastName=".$Refereence1LastName."&Refereence1HomePhone=".$Refereence1HomePhone."&Refereence1Address=".$Refereence1Address."&Refereence1Address2=".$Refereence1Address2."&Refereence1Relationship=".$Refereence1Relationship."&HomeStatus=".$HomeStatus."&HomeLength=".$HomeLength."&BestTimeToCall=".$BestTimeToCall."&LandingPage=".$LandingPage."&IPAddress=".$IPAddress;	 $post_res = $this->curlposting($post_url, $post_data, $header); 	 	 	      preg_match('/<Price >(.*)<\/Price >/' , $post_res , $price);     preg_match('/<IsValid>(.*)<\/IsValid>/' , $post_res , $isvalid);            $myFile_post = "ping_post_request/post_VIGATEL_Payday_70".$lead_data->payday_id.".txt";            $fh_post = fopen($myFile_post, 'w') or die("can't open file");            $file_string_post = "Post URL::>".$post_url."\n\n";            $file_string_post.= "Post Data::>".$post_data."\n\n";            $file_string_post.= "Post Result::>".$post_res."\n\n";                                       fwrite($fh_post, $file_string_post);            fclose($fh_post);			//print_r($post_res);exit;            if($isvalid[1] == 'True'){					if($price[1]=='')					$price[1] = 70;                $post_response = 'VIGATEL_Payday:' .$price[1];                $return_post = false;                $objLeads_submit->post_response ='Success';				$objLeads_submit->ping_response ='Success';                $objLeads_submit->price = $price[1];            }else{                    $post_response = 'VIGATEL_Payday Rejected';                    $return_post = true;//Call the other function                    $objLeads_submit->post_response ='Fail';					$objLeads_submit->ping_response ='Success';                    $objLeads_submit->price = 0;                    $leadassign = 1;            }        $objLeads_submit->lead_id =$lead_data->payday_id;        $objLeads_submit->client_id =45;		$objLeads_submit->lead_types ='Payday';		$objLeads_submit->c_date=$lead_data->c_date;        $objLeads_submit->save();    if($multiple!=1)         {            echo '<tr>                  <td width="1%"><a href="#">'.$lead_data->payday_id.'</a></td>                  <td>Auto</td>                  <td>'.$email_address.'</td>                  <td>'.$home_phone.'</td>                  <td>'.$ssn.'</td>                  <td>'.$ping_response.' <a class="tag red" href="'.Kohana::$base_url.$myFile_ping_response.'" target="_blank">View</a></td>                  <td>'.$post_request.' '.$post_response.'</td>                  <td>'.$price[1].'</td>                </tr>';         }         else         {            $return_array['ping_response'] =  $return_ping;            $return_array['post_response'] = $return_post;            $return_array['price'] = $price[1];            return $return_array;         }       exit;  }  
  function curlposting($url1 , $result , $header , $sec = 60){
		$Curl_Session = curl_init($url1);
		curl_setopt ($Curl_Session, CURLOPT_POST, 1);
		curl_setopt ($Curl_Session, CURLOPT_POSTFIELDS, "$result");
		curl_setopt($Curl_Session, CURLOPT_SSL_VERIFYPEER, FALSE);   
		curl_setopt($Curl_Session, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($Curl_Session, CURLOPT_TIMEOUT, $sec);
		//curl_setopt ($Curl_Session, CURLOPT_FOLLOWLOCATION, 1);
		if($header != ''){
			curl_setopt($Curl_Session, CURLOPT_HEADER, 0);
			curl_setopt($Curl_Session, CURLOPT_HTTPHEADER, $header);		
		}	
		$res = curl_exec ($Curl_Session);
		curl_close ($Curl_Session);
		return $res;
	}
  

    /*********************
     * 
     * Function used to display the status of the Lead at listing page
     * 
     */
    function getLeadStatus($id,$lead_type)
    {
        $objLeads_submit = ORM::factory('leadsubmit');
        $resultset = $objLeads_submit->select('tbl_client.vUsername')->join('tbl_client','left')->on('tbl_lead_submit.client_id', '=','tbl_client.iClient_id')->where('lead_types','=',$lead_type)->where('lead_id',"=",$id)->find_all();
        foreach($resultset as $key=>$value){ 
		$client_name = '<strong>'.$value->vUsername.'</strong>';
        if($value->post_response=='Success')
                echo "<a class='tag blue' >".$client_name."-$".$value->price."</a>";
            else
                echo "<a class='tag red' >".$client_name."</a>";
        }
       // echo Database::instance()->last_query;
        //return $id;
    }
	function net_trangine_payday($lead_data,$multiple)  {      $objLeads_submit = ORM::factory('leadsubmit');      $post_url = 'http://www.friendspayday.com/i/postlead'; //live	            $pricetier = array(0=>array("username"=>"vigatel7p","password"=>"emayxv0i"),                          1=>array("username"=>"vigatel15p","password"=>"ep4o5lmx"),                          2=>array("username"=>"vigatel25p","password"=>"kbhqgroy"),                          3=>array("username"=>"vigatel45p","password"=>"bq9lj91"),                          4=>array("username"=>"vigatel65p","password"=>"oetpofn"),                          5=>array("username"=>"vigatel85p","password"=>"lzkufhcf"));						 	  $pricetier = array(0=>array("username"=>"vigatel7p","password"=>"emayxv0i"),                          1=>array("username"=>"vigatel85p","password"=>"lzkufhcf"));               $home_status = $lead_data->residence_type=='rent'?'2':'1';        $military = $lead_data->military =='yes'?'1':'0';        $account_type = $lead_data->bank_account_type=='Checking'?'C':'S';        $type_of_payroll = $lead_data->income_direct_deposit=='yes'?'D':'P';        $income_frequency =$lead_data->income_frequency;        if($income_frequency=='Bi_weekly')            $periodicity = 'B';        if($income_frequency=='Weekly')            $periodicity = 'W';        if($income_frequency=='Monthly')            $periodicity = 'M';        if($income_frequency=='Twice_monthly')            $periodicity = 'S';               for($pi=0; $pi<6; $pi++)        {           	                        $post_data = '<?xml version="1.0" ?>                        <EXTPOSTTRANSACTION>                        <STLTRANSACTIONINFO>                                <USERID>'.$pricetier[$pi]['username'].'</USERID>                                <PASSWORD>'.$pricetier[$pi]['password'].'</PASSWORD>                        </STLTRANSACTIONINFO>                        <EXTTRANSACTIONDATA>                                <CUSTOMER>                                <CUSTSSN>894569876</CUSTSSN>                                <CUSTFNAME>'.$lead_data->fname.'</CUSTFNAME>                                <CUSTMNAME></CUSTMNAME>                                <CUSTLNAME>'.$lead_data->lname.'</CUSTLNAME>                                <CUSTADD1>'.$lead_data->address.'</CUSTADD1>                                <CUSTADD2></CUSTADD2>                                <CUSTCITY>'.$lead_data->city.'</CUSTCITY>                                <CUSTSTATE>'.$lead_data->state.'</CUSTSTATE>                                <CUSTZIP>'.$lead_data->zip.'</CUSTZIP>                                <CUSTZIP4></CUSTZIP4>                                <CUSTHOMEPHONE>9564789658</CUSTHOMEPHONE>                                <CUSTMOBILEPHONE>'.$lead_data->mobile.'</CUSTMOBILEPHONE>                                <CUSTWORKPHONE>'.$lead_data->work_phone.'</CUSTWORKPHONE>                                <CUSTWORKPHONEEXT></CUSTWORKPHONEEXT>                                <CUSTEMAIL>'.$lead_data->email.'</CUSTEMAIL>                                <CUSTDOB>'.date('m/d/Y',strtotime($lead_data->dob)).'</CUSTDOB>                                <CUSTDLSTATE>'.$lead_data->state_issued_id.'</CUSTDLSTATE>                                <CUSTDLNO>'.$lead_data->driving_license.'</CUSTDLNO>                                <HOMESTATUS>'.$home_status.'</HOMESTATUS>                                <IP>'.$lead_data->ip_address.'</IP>                                <ISMILITARY>'.$military.'</ISMILITARY>                                </CUSTOMER>                                <REFERENCE>                                <REFFNAME>'.$lead_data->reference_name1.'</REFFNAME>                                <REFMNAME></REFMNAME>                                <REFLNAME>'.$lead_data->reference_name1.'</REFLNAME>                                <REFHOMEPHONE>'.$lead_data->reference_phone1.'</REFHOMEPHONE>                                <REFEMAIL></REFEMAIL>                                <REFRELATION>FRIEND'.$lead_data->reference_relationship1.'</REFRELATION>                                <REFACTIVEFLAG>P</REFACTIVEFLAG>                                </REFERENCE>                                <REFERENCE>                                <REFFNAME>'.$lead_data->reference_name2.'</REFFNAME>                                <REFMNAME></REFMNAME>                                <REFLNAME>'.$lead_data->reference_name2.'</REFLNAME>                                <REFHOMEPHONE>'.$lead_data->reference_phone2.'</REFHOMEPHONE>                                <REFEMAIL></REFEMAIL>                                <REFRELATION>'.$lead_data->reference_relationship2.'</REFRELATION>                                <REFACTIVEFLAG>1</REFACTIVEFLAG>                                </REFERENCE>                                <BANK>                                <CUSTABANO>'.$lead_data->bank_aba.'</CUSTABANO>                                <CUSTBANKNAME>'.$lead_data->bank_name.'</CUSTBANKNAME>                                <CUSTACCTNO>'.$lead_data->bank_account_number.'</CUSTACCTNO>                                <CUSTACCTTYPE>'.$account_type.'</CUSTACCTTYPE>                                <CUSTBANKPHONE>'.$lead_data->bank_phone.'</CUSTBANKPHONE>                                </BANK>                                <EMPLOYER>                                <TYPEOFINCOME>P</TYPEOFINCOME>                                <EMPNAME>'.$lead_data->employer_name.'</EMPNAME>                                <EMPADD1>4000 Main Street</EMPADD1>                                <EMPADD2></EMPADD2>                                <EMPCITY>Severn</EMPCITY>                                <EMPSTATE>MD</EMPSTATE>                                <EMPZIP></EMPZIP>                                <EMPZIP4></EMPZIP4>                                <EMPPHONE>'.$lead_data->employer_phone.'</EMPPHONE>                                <EMPPHONEEXT></EMPPHONEEXT>                                <AVGSALARY>750</AVGSALARY>                                <TYPEOFPAYROLL>'.$type_of_payroll.'</TYPEOFPAYROLL>                                <PERIODICITY>'.$periodicity.'</PERIODICITY>                                <NEXTPAYDATE>'.date('m/d/Y',strtotime($lead_data->pay_date1)).'</NEXTPAYDATE>                                <SECONDPAYDATE>'.date('m/d/Y',strtotime($lead_data->pay_date2)).'</SECONDPAYDATE>                                </EMPLOYER>                        </EXTTRANSACTIONDATA>                        </EXTPOSTTRANSACTION>';        print "<br>".$post_data;        $header = array();        $header[] = "Content-Type: text/xml";         $header[] .= "Content-Length: ".strlen($post_data);        $post_res = $this->curlposting($post_url, $post_data, $header);				print_r($post_res);						        //***********************Write File for the Ping *************/            $myFile_ping_response = "ping_post_request/net_trangine".$lead_data->payday_id.$pricetier[$pi]['username'].".txt";            $fh = fopen($myFile_ping_response, 'w') or die("can't open file");            $file_string = "Post URL::>".$post_url."\n\n";            $file_string.= "Post Data::>".$post_data."\n\n";            $file_string.= "Ping Response::>".$post_res."\n\n";            fwrite($fh, $file_string);            fclose($fh);        //************************End Write File for ping ************/        preg_match('/<responseCode>(.*)<\/responseCode>/' , $post_res , $post_status);        $findme   = 'accept';		$pos = strpos($post_res, $findme);				if ($pos !== false) {			echo "The string '$findme' was found in the string '$mystring'";			echo " and exists at position $pos";			$ping_response ='Ping Accepted';			preg_match('/<have_buyer>(.*)<\/have_buyer>/' , $res_1 , $have_buyer_1);			 $return_post = false;			 //************************End Write File for Post ************/			 $return = false;			 break;					} else {							echo "The string '$findme' was not found in the string '$mystring'";		}				echo "<br>============================<br>";            }//End For Loop		$objLeads_submit->lead_id = $lead_data->payday_id;        $objLeads_submit->client_id = 37;        $objLeads_submit->lead_types = 'Payday';        $objLeads_submit->c_date = $lead_data->c_date;        $objLeads_submit->save();         if($multiple!=1)         {            echo '<tr>                  <td width="1%"><a href="#">'.$lead_data->payday_id.'</a></td>                  <td>Payday</td>                  <td>'.$email_address.'</td>                  <td>'.$home_phone.'</td>                  <td>'.$ssn.'</td>                  <td>'.$ping_response.' <a class="tag red" href="'.Kohana::$base_url.$myFile_ping_response.'" target="_blank">View</a></td>                  <td>'.$post_request.'</td>                  <td>'.$post_response.'</td>                  <td>12</td>                </tr>';         }         else         {            $return_array['ping_response'] =  $return_ping;            $return_array['post_response'] = $return_post;            $return_array['price'] = $price[1];            return $return_array;         }  }      function sunshine_payday($lead_data,$multiple)  {      $objLeads_submit = ORM::factory('leadsubmit');      $post_url = 'https://secure.paydaylead4u.com/BusinessLayer/Partners/rpost.aspx'; //live	            $pricetier = array(0=>3484,                          1=>3483,                          2=>3482,                          3=>3481                      );       //echo "<pre>";       // print_r($pricetier);exit;              $home_status = $lead_data->residence_type=='rent'?'2':'1';        $military = $lead_data->military =='yes'?'1':'0';        $account_type = $lead_data->bank_account_type=='Checking'?'C':'S';        $type_of_payroll = $lead_data->income_direct_deposit=='yes'?'D':'P';        		list($birth_year , $birth_month , $birth_day) = explode("-",$lead_data->dob);		list($pay_date1_year , $pay_date1_month , $pay_date1_day) = explode("-",$lead_data->pay_date1);		list($pay_date2_year , $pay_date2_month , $pay_date2_day) = explode("-",$lead_data->pay_date2);        $objState = ORM::factory('state');        $stateData = $objState->where('state_name', '=', $lead_data->state_issued_id)->find_all()->as_array();               for($pi=0; $pi<4; $pi++)        {           $post_data = 'kbid=1002&activechecking=yes&firstname='.$lead_data->fname.'&lastname='.$lead_data->lname.'&address='.$lead_data->address.'&city='.$lead_data->city.'&state='.$lead_data->state.'&zip='.$lead_data->zip.'&email='.$lead_data->email.'&otheroffers=no&employerPhoneNumber='.$lead_data->employer_phone.'&bankabaRouting='.$lead_data->bank_aba.'&bankaccNumber='.$lead_data->bank_account_number.'&bankName='.$lead_data->bank_name.'&checkDeposit='.$lead_data->check_deposite.'&companyname='.$lead_data->employer_name.'currentlyemployed=yes&dob_day='.$birth_day.'&dob_month='.$birth_month.'&dob_year='.$birth_year.'&homephoneNumber='.$lead_data->phone.'&license='.$lead_data->driving_license.'&licensestate='.$stateData[0]->state_abbreviation.'&mainIncome=Job&mil_amd=0&payPeriod='.$lead_data->income_frequency.'&reference_name1='.$lead_data->reference_name1.'&reference_name2='.$lead_data->reference_name2.'&reference_phone1='.$lead_data->reference_phone1.'&reference_phone2='.$lead_data->reference_phone2.'&reference_relationship1='.$lead_data->reference_relationship1.'&reference_relationship2='.$lead_data->reference_relationship2.'&ssn='.$lead_data->ssn.'&takehomepay='.$lead_data->monthly_income.'&uscitizen=yes&paydate1_day='.$pay_date1_day.'&paydate1_month='.$pay_date1_month.'&paydate1_year='.$pay_date1_year.'&paydate2_day='.$pay_date2_day.'&paydate2_month='.$pay_date2_month.'&paydate2_year='.$pay_date2_year.'&rentown='.$lead_data->residence_type.'&months_at_address='.$lead_data->residence_months.'&years_at_address='.$lead_data->residence_years.'&jobtitle='.$lead_data->job_title.'&shifthours='.$lead_data->shift_hrs.'&datehired_day=01&datehired_month=01&datehired_year=2004&followredirect=false&HTTP_REFERER=cashadvanceresource.com&REMOTE_ADDR='.$lead_data->ip_address;        print "<br>".$post_data;        $header = array();        $header[] = "Content-Type: application/x-www-form-urlencoded";         $header[] .= "Content-Length: ".strlen($post_data);        $post_res = $this->curlposting($post_url, $post_data, $header);		 print "<br><br>".$post_res;		 echo "==================================";        //***********************Write File for the Ping *************/           					//***********************Write File for the Ping *************/            echo $myFile_ping_response = "ping_post_request/hardik_trangine".$lead_data->payday_id.".txt";            $fh = fopen($myFile_ping_response, 'w') or die("can't open file");            $file_string = "Post URL::>".$post_url."\n\n";            $file_string.= "Post Data::>".$post_data."\n\n";            $file_string.= "Ping Response::>".$post_res."\n\n";            fwrite($fh, $file_string);            fclose($fh);        //************************End Write File for ping ************/			        //************************End Write File for ping ************/         $findme   = 'accept';		$pos = strpos($post_res, $findme);				if ($pos !== false) {			echo "The string '$findme' was found in the string '$mystring'";			echo " and exists at position $pos";			$ping_response ='Ping Accepted';			preg_match('/<have_buyer>(.*)<\/have_buyer>/' , $res_1 , $have_buyer_1);			 $return_post = false;			 //************************End Write File for Post ************/			 $return = false;			 break;					} else {							echo "The string '$findme' was not found in the string '$mystring'";		}             }//End For Loop     		$myFile_post = "ping_post_request/aim_auto_ran_ping_" . $lead_data->payday_id . ".txt";		$fh_post = fopen($myFile_post, 'w') or die("can't open file");		$file_string_post = "Ping URL::>" . $ping_url . "\n\n";		$file_string_post.= "Ping Data::>" . $ping_data . "\n\n";		$file_string_post.= "Ping Result::>" . $ping_res . "\n\n";		fwrite($fh_post, $file_string_post);		fclose($fh_post);	 	 $objLeads_submit->lead_id =$lead_data->payday_id;	 $objLeads_submit->client_id =38;	 $objLeads_submit->lead_types ='Payday';	 $objLeads_submit->c_date=$lead_data->c_date;	// $objLeads_submit->save();	 	 if($multiple!=1)         {            echo '<tr>                  <td width="1%"><a href="#">'.$lead_data->payday_id.'</a></td>                  <td>Payday</td>                  <td>'.$email_address.'</td>                  <td>'.$home_phone.'</td>                  <td>'.$ssn.'</td>                  <td>'.$ping_response.' <a class="tag red" href="'.Kohana::$base_url.$myFile_ping_response.'" target="_blank">View</a></td>                  <td>'.$post_request.' '.$post_response.'</td>                  <td>'.$pricetier[$pi].'</td>                </tr>';         }         else         {            $return_array['ping_response'] =  $return_ping;            $return_array['post_response'] = $return_post;            $return_array['price'] = $price[1];            return $return_array;         }       exit;	 	 		   }    function vigatelLocal($lead_data,$multiple)  {	    	$objLeads_submit = ORM::factory('leadsubmit');		$client_id='386';    	$zip = urlencode($lead_data->zip); 		$lead_id = $lead_data->lead_auto_id;		$phone=urlencode($lead_data->phone);		$email = $lead_data->email;		//echo "---";	$c = new soapclient('http://vigatelllc.com/webservice/server.php?wsdl');	//print_r($c);	//var_dump($c);	$lead_result = $c->call('sendLead',array('zip' => $zip,'client_id' => $client_id,'lead_id' => $lead_id,'phone' => $phone,'email'=>$email));		//echo "---";	//print_r($lead_result);exit;			$lead_result_array = explode('~~',$lead_result);			$post_data = 'zip='.$zip.'&client_id='.$client_id.'&lead_id='.$lead_id.'&phone'.$phone.'email='.$email;     			$myFile_post = "ping_post_request/vigatelLocal_post_".$lead_data->lead_auto_id.".txt";		$fh_post = fopen($myFile_post, 'w') or die("can't open file");		$file_string_post = "Post URL::>http://vigatelllc.com/webservice/server.php?wsdl \n\n";		$file_string_post.= "Ping Data::>".$post_data."\n\n";		$file_string_post.= "Ping Result::>".$lead_result."\n\n";                           		fwrite($fh_post, $file_string_post);		fclose($fh_post);		$return_ping = 0;				$myFile_post = "ping_post_request/vigatelLocal_ping_".$lead_data->lead_auto_id.".txt";		$fh_post = fopen($myFile_post, 'w') or die("can't open file");		$file_string_post = "Post URL::>http://vigatelllc.com/webservice/server.php?wsdl \n\n";		$file_string_post.= "Ping Data::>".$post_data."\n\n";		$file_string_post.= "Ping Result::>".$lead_result."\n\n";                           		fwrite($fh_post, $file_string_post);		fclose($fh_post);		$return_ping = 0;		 		 			if($lead_result_array[0] == 'Success')		{					$post_response = 'HC_Auto (RAN)-Accepted Price:' .$price[1];				$return_post = false;				$objLeads_submit->post_response ='Success';				$objLeads_submit->ping_response ='Success';				$objLeads_submit->price = $lead_result_array[1];		}	else	{		   		$post_response = 'N/A';            		$post_request = '-';            		$leadassign = 1;            		$return_ping = true;//Call the other function            		$objLeads_submit->ping_response ='Fail';            		$objLeads_submit->post_response ='Fail';	 	}				//print_r($post_success);						        	$objLeads_submit->lead_id =$lead_data->lead_auto_id;        	$objLeads_submit->client_id =44;        	$objLeads_submit->lead_types ='Auto';        	$objLeads_submit->c_date=$lead_data->c_date;        	$objLeads_submit->save();    		if($multiple!=1)	{            		echo '<tr>                  				<td width="1%"><a href="#">'.$lead_data->lead_auto_id.'</a></td>                  				<td>Auto</td>                  				<td>'.$email_address.'</td>                  				<td>'.$home_phone.'</td>                  				<td>'.$ssn.'</td>                  				<td>'.$ping_response.' <a class="tag red" href="'.Kohana::$base_url.$myFile_ping_response.'" target="_blank">View</a></td>                  				<td>'.$post_request.' '.$post_response.'</td>                  				<td>'.$lead_result_array[1].'</td>                			</tr>';         	}         	else         		{            			$return_array['ping_response'] =  $return_ping;            			$return_array['post_response'] = $return_post;            			$return_array['price'] = $lead_result_array[1];            			return $return_array;         		}       	exit;	  }       }
<?php	$objLeads_submit = ORM::factory('leadsubmit');      $ping_url = 'https://dealermatrixtech.com/webservice/autowebservice.asmx/Ping';//DynamicPricePing      $post_url = 'https://dealermatrixtech.com/webservice/autowebservice.asmx/Post';      $header = array('Content-Type: application/x-www-form-urlencoded') ;//'Content-Type: application/x-www-form-urlencoded';       $zip = urlencode($lead_data->zip);      $income = urlencode($lead_data->monthly_income);      $ssn = str_pad($lead_data->ssn, 9 , 0,STR_PAD_LEFT);      $lead_type_id = 5;      $IsTest = 'false';      $username='RoyalAN';      $passcode = 'RAN!2013$';      $SubId ='9999';      $loan_type = 'Dealer Purchase';      $address = $lead_data->address;      $email = $lead_data->email;      $first_name = urlencode($lead_data->fname);      $last_name = urlencode($lead_data->lname);      $home_phone=urlencode($lead_data->phone);      $ip_address=urlencode($lead_data->ip_address);      $privacy_accept='true';      $last_name = urlencode($lead_data->lname);      $work_phone=urlencode($lead_data->work_number);      $bankruptcy = (urlencode($lead_data->bankruptcy)=='' ||urlencode($lead_data->bankruptcy)=='no')?'false':'true';      $dob = date('m/d/Y',strtotime($lead_data->birth_date));      $employer_month = urlencode($lead_data->month_with_company);      $employer_name = $lead_data->employer;      $employer_year = urlencode($lead_data->year_with_company)==''?1:$lead_data->year_with_company;      $job_title = $lead_data->job_title;      $ResidenceCost=urlencode($lead_data->home_pay);      $ResidenceMonths=urlencode($lead_data->month_residence)==''?1:$lead_data->month_residence;      $ResidenceType=urlencode($lead_data->rent_own);      $ResidenceYears=urlencode($lead_data->year_residence);      $monthly_income = urlencode($lead_data->monthly_income);      $HousePayment = urlencode($lead_data->rent_payment);      $city = $lead_data->city;      $state = $lead_data->state;      $mobile = urlencode($lead_data->mobile);      $cosigner = (urlencode($lead_data->cosigner)=='' ||urlencode($lead_data->cosigner)=='no')?'false':'true';      $TrackingID='';      $SubID1='';      $SubID2='';      $SubID3='';      $domain = 'www.domain.com';      $ResidenceYears_temp = explode("-",$ResidenceYears);      $employer_month_temp = explode("-",$employer_month);      if(current($ResidenceYears_temp)==0)          $ResidenceYears_value=1;      else          $ResidenceYears_value = current($ResidenceYears_temp);        $PingID='';      $ping_data = 'Username='.$username.'&Passphrase='.$passcode.'&Zip='.$zip.'&SSN='.$ssn.'&MonthlyIncome='.$monthly_income;      $ping_res = $this->curlposting($ping_url, $ping_data, $header);        $myFile_post = "ping_post_request/dmauto_ran_ping_".$lead_data->lead_auto_id.".txt";        $fh_post = fopen($myFile_post, 'w') or die("can't open file");        $file_string_post = "Ping URL::>".$ping_url."\n\n";        $file_string_post.= "Ping Data::>".$ping_data."\n\n";        $file_string_post.= "Ping Result::>".$ping_res."\n\n";                                   fwrite($fh_post, $file_string_post);        fclose($fh_post);        $return_ping = 0;        $objLeads_submit->ping_response ='Success';        preg_match('/<Result>(.*)<\/Result>/' , $ping_res , $ping_status);        preg_match('/<ResponseID>(.*)<\/ResponseID>/' , $ping_res , $ResponseID);        preg_match('/<Price>(.*)<\/Price>/' , $ping_res , $price);         //print_r($ping_res); echo "<br>=====================<br>";                //print_r($ping_status[1]);     if($ping_status[1]=='Approved')     {                 //echo "in POST";        $post_data='Username='.$username.'&Passphrase='.$passcode.'&ResponseID='.$ResponseID[1].'&FirstName='.$first_name.'&LastName='.$last_name.'&Email='.$email.'&SSN='.$ssn.'&DOB='.$dob.'&HousePayment='.$HousePayment.'&ResidenceType='.$ResidenceType.'&YearsAtResidence='.$ResidenceYears_value.'&MonthsAtResidence='.$ResidenceMonths.'&Address='.$address.'&City='.$city.'&State='.$state.'&Zip='.$zip.'&HomePhone='.$home_phone.'&Cellphone='.$mobile.'&Employer='.$employer_name.'&Occupation='.$job_title.'&YearsAtEmployer='.$employer_year.'&MonthsAtEmployer='.current($employer_month_temp).'&MonthlyIncome='.$monthly_income.'&WorkPhone='.$work_phone.'&CustomerIP='.$ip_address.'&Domain='.$domain.'&BankruptcyFiled='.$bankruptcy.'&AvailableCosigner='.$cosigner.'&TrackingID='.$TrackingID.'&SubID1='.$SubID1.'&SubID2='.$SubID2.'&SubID3='.$SubID3;         $post_res = $this->curlposting($post_url, $post_data, $header);             preg_match('/<Result>(.*)<\/Result>/' , $post_res , $status_post);            preg_match('/<Error>(.*)<\/Error>/' , $post_res , $error);                        //print_r($post_res); echo "<br>=====================<br>";                        //print_r($status_post);            $myFile_post = "ping_post_request/dmauto_ran_post_".$lead_data->lead_auto_id.".txt";            $fh_post = fopen($myFile_post, 'w') or die("can't open file");            $file_string_post = "Post URL::>".$post_url."\n\n";            $file_string_post.= "Post Data::>".$post_data."\n\n";            $file_string_post.= "Post Result::>".$post_res."\n\n";                                       fwrite($fh_post, $file_string_post);            fclose($fh_post);            if($status_post[1] == 'Approved'){	                $post_response = 'DM_Auto (RAN)-Accepted Price:' .$price[1];                $return_post = true;                $objLeads_submit->post_response ='Success';                $objLeads_submit->ping_response ='Success';                $objLeads_submit->price = $price[1];            }else{                    $post_response = 'DM_Auto (RAN)-Rejected';                    $return_post = false;//Call the other function                    $objLeads_submit->post_response ='Fail';                    $objLeads_submit->ping_response ='Success';                    $objLeads_submit->price = 0;                    $leadassign = 1;            }     }    else // Lead Rejected      {          $ping_response ='DM_Auto (RAN) Ping Rejected';          $comment_admin = ', DM_Auto (RAN))-Rejected';          $post_response = 'N/A';          $post_request = '-';          $leadassign = 1;          $return_ping = true;//Call the other function          $objLeads_submit->ping_response ='Fail';          $objLeads_submit->post_response ='Fail';      }        $objLeads_submit->lead_id =$lead_data->lead_auto_id;        $objLeads_submit->client_id =37;        $objLeads_submit->lead_types ='Auto';        $objLeads_submit->c_date=$lead_data->c_date;        $objLeads_submit->save();    if($multiple!=1)         {            echo '<tr>                  <td width="1%"><a href="#">'.$lead_data->lead_auto_id.'</a></td>                  <td>Auto</td>                  <td>'.$email_address.'</td>                  <td>'.$home_phone.'</td>                  <td>'.$ssn.'</td>                  <td>'.$ping_response.' <a class="tag red" href="'.Kohana::$base_url.$myFile_ping_response.'" target="_blank">View</a></td>                  <td>'.$post_request.' '.$post_response.'</td>                  <td>'.$price[1].'</td>                </tr>';         }         else         {            $return_array['ping_response'] =  $return_ping;            $return_array['post_response'] = $return_post;            $return_array['price'] = $price[1];            return $return_array;         }       exit;?>
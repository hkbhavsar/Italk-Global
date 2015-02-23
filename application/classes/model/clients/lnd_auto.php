<?php

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

?>
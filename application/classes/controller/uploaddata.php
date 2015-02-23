<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Uploaddata extends Controller_Layout {
      
  	public function before(){
             parent::before();
            
            $styles = array(
            'css/help_css/help.css' => 'screen'
            );

             $scripts = array(
             'js/help_js/jquery_002.js',
             'js/help_js/highlight.js',
            );
             $this->template->styles = array_merge($this->template->styles, $styles);
             $this->template->scripts = array_merge($this->template->scripts, $scripts);
	     $this->template->set_filename('layout/admin');
	}
	
  	public function __construct(Request $request)
	{
		if (Auth::instance()->logged_in('',$all_required=false) == 0) {
            
                 Request::current()->redirect('/auth/signin');
                }
		// Assign the request to the controller
    		parent::__construct($request);
	}
	public function action_index()
	{
		$objCallcenter = ORM::factory('callcenter');
		$objLeads = ORM::factory('leads');
		$callcenterData = $objCallcenter->find_all()->as_array();
              
               // echo "<pre>";
                /*print_r($_POST);
                print_r($_FILES);
                print_r($_REQUEST);*/
                
                $lead_types = $_POST['search_campaign'];
                $process_done = 0;
                $duplicate=0;
                $lead_uploaded = 0;
                $total_leads = 0;
          if ($_FILES['file_browse'][size] > 0) {

                    //get the csv file
                    $file = $_FILES['file_browse'][tmp_name];
                    $handle = fopen($file,"r");
           //loop through the csv file and insert into database
                   
            do {
                
                if ($data[0]) { 
                    if($lead_types=="auto_sale")
                    {
                        $objLeads = ORM::factory('leadauto');
                        $field_id = 'lead_auto_id';
                        $phone_no = $data[8];
                    }
                    else if($lead_types=="newcar")
                    {
                        $objLeads = ORM::factory('newcar');
                        $field_id = 'lead_new_id';
                        $phone_no = $data[7];
                    }
                    else if($lead_types=="new_payday")
                    {
                        $objLeads = ORM::factory('paydaylead');
                        $field_id = 'newpayday_id';
                        $phone_no = $data[10];
                    }
                     else if($lead_types=="payday")
                    {
                        $objLeads = ORM::factory('payday');
                        $field_id = 'payday_id';
                        $phone_no = $data[5];
                    }
                    else {
                        $objLeads = ORM::factory('leads');
                        $field_id = 'id';
                        
                    }
                    $zipcode = $data[5];
                    list($m,$d,$y) = explode('/',$data[1]);
                    $date2 = $y.'-'.$m.'-'.$d; 

                    list($m,$d,$y) = explode('/',$data[6]);
                    $birthday = $y.'-'.$m.'-'.$d; 
                  if($lead_types=="auto_sale" || $lead_types=="newcar" || $lead_types=="new_payday" || $lead_types=="payday")
                    {
                        $check_data = $objLeads->where('phone','=',addslashes($phone_no))->find_all();
                        //echo Database::instance()->last_query;exit;
                   
                   }
                   else
                   {
                        $check_data = $objLeads->where('lead_types','=',$lead_types)->where('phone','=',addslashes($phone_no))->find_all();
                   } 
                    //echo Database::instance()->last_query;
                    //print_r(count($check_data));
                    $total_leads = $total_leads+1;
                    
                     
                    
                   $call_center = $_POST['search_callcenter'];
                   $objzip = ORM::factory('zip');
                   $check_data_based_zip = $objzip->where('zipcode','=',$zipcode)->find_all();
                    //echo Database::instance()->last_query;
                   if($lead_types=="auto_sale")
                    {						//echo $date2;exit;
                        $zip = $data[5];
                        if(strlen($zip)<5)
                                $zip = '0'.$zip;
                        $year_of_resi = $data[15].'-00-00'; 
                        $months_of_emp = $data[12].'-00-00'; 
                        //$objLeads->lead_types = $lead_types;
                        $objLeads->callcenter = $call_center;
                        $objLeads->call_attended = $agentid;
                        $objLeads->agent_id = Auth::instance()->get_user()->id;
                        $objLeads->c_date = $date2;
                        $objLeads->fname = $data[2];
                        $objLeads->lname = $data[3];
                        $objLeads->address = $data[4];
                        $objLeads->city = $check_data_based_zip[0]->city;
                        $objLeads->state = $check_data_based_zip[0]->state;
                        $objLeads->zip = $zip;
                        $objLeads->birth_date = $birthday;
                        $objLeads->email = $lead_types=='new_car'?$data[6]:$data[7];
                        $objLeads->phone = $lead_types=='new_car'?$data[7]:$data[8];
                        $objLeads->work_number = $data[9];
                        $objLeads->employer = $data[10];
                        $objLeads->job_title = $data[11];
                        $objLeads->month_with_company = $months_of_emp;
                        $objLeads->monthly_income = $data[13];
                        $objLeads->rent_own = $data[14];
                        $objLeads->year_residence = $year_of_resi;
                        $objLeads->home_pay = $data[16];
                        $objLeads->ssn = $data[17];
                        $objLeads->bankruptcy = $data[18];
                        $objLeads->cosigner = $data[19];
                        $objLeads->loan_amount = $data[20];
                        $objLeads->credit_score = $data[21];
                        $objLeads->ip_address = $lead_types=='new_car'?$data[11]:$data[22];
                        $objLeads->time_to_contact = 'Any Time';
                       
                   }
                   if($lead_types=="newcar")
                    {
                        $objLeads->lead_types = $lead_types;
                        $objLeads->callcenter = $call_center;
                        $objLeads->c_date = $date2;
                        $objLeads->fname = $data[2];
                        $objLeads->lname = $data[3];
                        $objLeads->address = $data[4];
                        $objLeads->zip = $data[5];
                        $objLeads->email = $data[6];
                        $objLeads->city = $check_data_based_zip[0]->city;
                        $objLeads->state = $check_data_based_zip[0]->state;
                        $objLeads->phone = $data[7];
                        $objLeads->ip_address = $data[11];
                        $objLeads->make=$data[8];
                        $objLeads->model=$data[9];
                        $objLeads->trim=$data[10];
                        $objLeads->agent_id = Auth::instance()->get_user()->id;
                   }
                   
                    if($lead_types=="new_payday")
                    {
                        list($m,$d,$y) = explode('/',$data[8]);
                        $birthday = $y.'-'.$m.'-'.$d; 
                        $objLeads->lead_types = $lead_types;
                        $objLeads->callcenter = $call_center;
                        $objLeads->c_date = $date2;
                        $objLeads->fname = $data[2];
                        $objLeads->lname = $data[3];
                        $objLeads->address = $data[4];
                        $objLeads->zip = $data[5];
                        $objLeads->email = $data[9];
                        $objLeads->ssn = $data[6];
                        $objLeads->uin = $data[7];
                        $objLeads->dob = $birthday;
                        $objLeads->email = $data[9];
                        $objLeads->city = $check_data_based_zip[0]->city;
                        $objLeads->state = $check_data_based_zip[0]->state;
                        $objLeads->phone = $data[10];
                       
                        $objLeads->agent_id = Auth::instance()->get_user()->id;
                   }
                    if($lead_types=="payday")
                    {
						$zipcode = $data[26];
						 if(strlen($zipcode)<5)
                                $zip = '0'.$zip;
						$objzip = ORM::factory('zip');
						$check_data_based_zip = $objzip->where('zipcode','=',$zipcode)->find_all();
                        list($m,$d,$y) = explode('/',$data[35]);
                        $birthday = $y.'-'.$m.'-'.$d; 
                        $pay_date1 = $data[22]."/".$data[21]."/".$data[20];
                        $pay_date2 = $data[25]."/".$data[24]."/".$data[23];
                        $objLeads->lead_types = $lead_types;
                        $objLeads->callcenter = $call_center;
                        $objLeads->c_date = $date2;
                        $objLeads->fname = $data[2];
                        $objLeads->lname = $data[3];
                        $objLeads->gender = $data[4];
                        $objLeads->phone = $data[5];
                        $objLeads->mobile = $data[6];
                        $objLeads->work_phone = $data[7];
                        $objLeads->residence_years = $data[8];
                        $objLeads->residence_months = $data[9];
                        $objLeads->residence_type = $data[10];
                        $objLeads->ssn = $data[11];
                        $objLeads->driving_license = $data[12];
                        $objLeads->state_issued_id = $data[13];
                        $objLeads->military = $data[14];
                        $objLeads->loan_amount = $data[15];
                        $objLeads->income_type = $data[16];
                        $objLeads->monthly_income = $data[17];
                        $objLeads->income_frequency = $data[18];
                        $objLeads->income_direct_deposit = $data[19];
                        $objLeads->pay_date1 = $pay_date1;
                        $objLeads->pay_date2 = $pay_date2;
                        $objLeads->zip = $data[26];
                        $objLeads->address = $data[27];
                        $objLeads->city = $check_data_based_zip[0]->city;
                        $objLeads->state = $check_data_based_zip[0]->state;
                        $objLeads->employer_name = $data[30];
                        $objLeads->employer_year = $data[31];
                        $objLeads->employer_months = $data[32];
                        $objLeads->employer_phone = $data[33];
                        $objLeads->email = $data[34];
                        $objLeads->dob = $birthday;
                        $objLeads->ip_address = $data[36];
                        $objLeads->client_url  = $data[37];
                        $objLeads->bank_name  = $data[38];
                        $objLeads->bank_phone  = $data[39];
                        $objLeads->bank_years  = $data[40];
                        $objLeads->job_title   = $data[41];
                        $objLeads->bank_account_type   = $data[42];
                        $objLeads->bank_account_number   = $data[43];
                        $objLeads->bank_aba    = $data[44];
                        $objLeads->best_call_time    = $data[45];
                        $objLeads->reference_name1    = $data[46];
                        $objLeads->reference_phone1   = $data[47];
                        $objLeads->reference_relationship1    = $data[48];
                        $objLeads->reference_name2    = $data[49];
                        $objLeads->reference_phone2   = $data[50];
                        $objLeads->reference_relationship2  = $data[51];
                        $objLeads->agent_id = Auth::instance()->get_user()->id;
                   }
                   
                    if(count($check_data)>0)
                    {
                        $dup_phone = $dup_phone.','.$phone_no; 
                        $duplicate = $duplicate+1;
                    }
                    else
                    {
                        if($data[2]!='Fname')
                        {
                                $last_inserted_id = $objLeads->save();
                        }
                        $lead_uploaded = $lead_uploaded+1;
                    }
                    
                }
            } while ($data = fgetcsv($handle,1000,",","'"));
            
            $process_done = 1;
            
        } //exit;
       
		
                $this->template->title = "Upload Leads";
		$this->template->content = View::factory('upload/upload_leads_tbl')
                                    ->bind('callcenterData',$callcenterData)
                                    ->bind('total_leads',$total_leads)
                                    ->bind('duplicate',$duplicate)
                                    ->bind('process_done',$process_done)
                                    ->bind('dup_phone',$dup_phone)
                                    ->bind('lead_uploaded',$lead_uploaded);
                                    
	}
        
        public function action_uploadforagent()
	{
            $objCallcenter = ORM::factory('callcenter');
            
            $callcenterData = $objCallcenter->find_all()->as_array();
            
            
                $lead_types = $_POST['search_campaign'];
                $process_done = 0;
                $duplicate=0;
                $lead_uploaded = 0;
                $total_leads = 0;
                
          if ($_FILES['file_browse'][size] > 0) {

                    //get the csv file
                    $file = $_FILES['file_browse'][tmp_name];
                    $handle = fopen($file,"r");
                    
                   
                
               

           //loop through the csv file and insert into database
                   
             while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
               
                if ($data[0]) {
                    if($lead_types=='new_payday')
                        $objLeads = ORM::factory('newpaydayleadupload');
                    else 
                        $objLeads = ORM::factory('agentuploadlead');
                     
                    $phone_no = $lead_types=='newcar'?$data[7]:$data[8];
                    $zipcode = $data[5];
                    list($m,$d,$y) = explode('/',$data[1]);
                    $date2 = $y.'-'.$m.'-'.$d; 

                    list($m,$d,$y) = explode('/',$data[6]);
                    $birthday = $y.'-'.$m.'-'.$d; 
                    $check_data = $objLeads->where('lead_types','=',$lead_types)->where('phone','=',addslashes($phone_no))->find_all();
                    //echo Database::instance()->last_query;exit;
                    //print_r(count($check_data));
                    $total_leads = $total_leads+1;
                    
                     
                    
                    $call_center = $_POST['search_callcenter'];
                    if($call_center == '3')
                            $agentid = '66';
                    else if($call_center == '5')
                            $agentid = '68';
                    else if($call_center == '2')
                            $agentid = '69';
                    else if($call_center == '4')
                            $agentid = '70';
                    else if($call_center == '7')
                            $agentid = '71';
                    else if($call_center == '1')
                            $agentid = '72';
                $objzip = ORM::factory('zip');
                $check_data_based_zip = $objzip->where('zipcode','=',$zipcode)->find_all();
                
                if($lead_types=='new_payday')  
                  {
                    $objzip = ORM::factory('zip');
                      $phone = $data[10];
                     $check_data = $objLeads->where('lead_types','=',$lead_types)->where('phone','=',addslashes($phone))->find_all();
                        list($m,$d,$y) = explode('/',$data[1]);
                        $date2 = $y.'-'.$m.'-'.$d; 
                        $fname = $data[2];
                        $lname = $data[3];
                       $address = $data[4];
                        
                        $zip = $data[5];
                        $ssn = $data[6];
                        $uin = $data[7];
                        list($m,$d,$y) = explode('/',$data[8]);
                        $birthday = $y.'-'.$m.'-'.$d; 
                        $email = $data[9];
                    $check_data_based_zip = $objzip->where('zipcode','=',$zip)->find_all();
                    $objLeads->fname = $fname;
                    $objLeads->lname = $lname;
                    $objLeads->address = $address;
                    $objLeads->city = $check_data_based_zip[0]->city;
                    $objLeads->state = $check_data_based_zip[0]->state;
                    $objLeads->zip = $zip;
                    $objLeads->ssn = $ssn;
                    $objLeads->uin = $uin;
                    $objLeads->dob = $birthday;
                    $objLeads->email = $email;
                    $objLeads->phone = $phone;
                    $objLeads->c_date = $date2;
                  }
                  else if($lead_types=='newcar')
                  {
                        list($m,$d,$y) = explode('/',$data[1]);
                        $date2 = $y.'-'.$m.'-'.$d; 
                        $zip = $data[5];
                        $check_data_based_zip = $objzip->where('zipcode','=',$zip)->find_all();
                        $objLeads->fname = $data[2];
                        $objLeads->lname = $data[3];
                        $objLeads->address = $data[4];
                        $objLeads->city = $check_data_based_zip[0]->city;
                        $objLeads->state = $check_data_based_zip[0]->state;
                        $objLeads->zip = $zip;
                        $objLeads->email = $data[6];
                        $objLeads->phone = $data[7];
                        $objLeads->make = $data[8];
                        $objLeads->model = $data[9];
                        $objLeads->trim = $data[10];
                        $objLeads->IP_address  = $data[11];
                        $objLeads->c_date  = $date2;
                        $objLeads->lead_types= $lead_types;
                   }
                  else
                  {
                    $phone_no = $lead_types=='new_car'?$data[7]:$data[8];
                    $zipcode = $data[5];
                    list($m,$d,$y) = explode('/',$data[1]);
                    $date2 = $y.'-'.$m.'-'.$d; 

                    list($m,$d,$y) = explode('/',$data[6]);
                    $birthday = $y.'-'.$m.'-'.$d; 
                    $check_data = $objLeads->where('lead_types','=',$lead_types)->where('phone','=',addslashes($phone_no))->find_all();
                  
                     //echo Database::instance()->last_query;
                    $year_of_resi = $data[15].'-00-00'; 
                    $months_of_emp = $data[12].'-00-00'; 
                    $objLeads->lead_types = $lead_types;
                    $objLeads->callcenter = $call_center;
                    $objLeads->callattended = $agentid;
                    $objLeads->c_date = $date2;
                    $objLeads->fname = $data[2];
                    $objLeads->lname = $data[3];
                    $objLeads->address = $data[4];
                    $objLeads->city = $check_data_based_zip[0]->city;
                    $objLeads->state = $check_data_based_zip[0]->state;
                    $objLeads->zip = $data[5];
                    $objLeads->birthday = $birthday;
                    $objLeads->email = $lead_types=='new_car'?$data[6]:$data[7];
                    $objLeads->phone = $lead_types=='new_car'?$data[7]:$data[8];
                    $objLeads->emp_work_phone = $data[9];
                    $objLeads->employer = $data[10];
                    $objLeads->occupation = $data[11];
                    $objLeads->months_of_emp = $months_of_emp;
                    $objLeads->monthly_income = $data[13];
                    $objLeads->rent_own = $data[14];
                    $objLeads->year_of_resi = $year_of_resi;
                    $objLeads->home_pay = $data[16];
                    $objLeads->ssn = $data[17];
                    $objLeads->bankrupt = $data[18];
                    $objLeads->co_sign = $data[19];
                    $objLeads->loan_amount = $data[20];
                    $objLeads->credit_rating = $data[21];
                    $objLeads->IP_address = $lead_types=='new_car'?$data[11]:$data[22];
                    $objLeads->best_time_contact = 'Any Time';
                    $objLeads->make=$lead_types=='new_car'?$data[8]:'';
                    $objLeads->model=$lead_types=='new_car'?$data[9]:'';
                    $objLeads->trim=$lead_types=='new_car'?$data[10]:'';
							
                  }
                  
                    if(count($check_data)>0)
                    {
                        $duplicate = $duplicate+1;
                    }
                    else
                    {
                       
                        $last_inserted_id = $objLeads->save();
                        $lead_uploaded = $lead_uploaded+1;
                    }
                    
                }
            } ;
            
            $process_done = 1;
            
        } 
            
         
            $this->template->title = "Upload Leads For Agent";
	    $this->template->content = View::factory('upload/upload_leads_for_agent')
                                    ->bind('callcenterData',$callcenterData)
                                    ->bind('total_leads',$total_leads)
                                    ->bind('duplicate',$duplicate)
                                    ->bind('process_done',$process_done)
                                    ->bind('lead_uploaded',$lead_uploaded);
        }
    
        
         function getCSVValues($string, $separator=",")
    {
        $elements = explode($separator, $string);
        
        for ($i = 0; $i < count($elements); $i++) 
        {
            $nquotes = substr_count($elements[$i], '"');
            
            if ($nquotes %2 == 1)
            {
                for ($j = $i+1; $j < count($elements); $j++) 
                {
                    if (substr_count($elements[$j], '"') > 0) 
                    {
                        // Put the quoted string's pieces back together again
                        array_splice($elements, $i, $j-$i+1,
                        implode($separator, array_slice($elements, $i, $j-$i+1)));
                        break;
                    }
                }
            }
            
            if ($nquotes > 0) 
            {
                // Remove first and last quotes, then merge pairs of quotes
                $qstr =& $elements[$i];
                $qstr = substr_replace($qstr, '', strpos($qstr, '"'), 1);
                $qstr = substr_replace($qstr, '', strrpos($qstr, '"'), 1);
                $qstr = str_replace('""', '"', $qstr);
            }
        }
        
        return $elements;
    }
    
   

} // End Welcome

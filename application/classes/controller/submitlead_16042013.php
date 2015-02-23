<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Submitlead extends Controller_Layout {
      
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
                $this->request->redirect($this->request->uri(
                        array('action' => 'list')), 301);
	}
       
	public function action_list()
	{
           // print_r($_POST);exit;
            //echo $campaign;exit;
           $campaign =  $_POST['search_campaign'];
            //echo $campaign;exit;
            if($campaign=='auto_sale')
            {
		$objLeads = ORM::factory('leadauto');
                $lead_type = 'Auto';
                $id= 'lead_auto_id';
                 $tbl = 'tbl_lead_auto';
            }
            if($campaign=='new_payday')
            {
                $objLeads = ORM::factory('paydaylead');
                $lead_type = 'NewPayday';
                $id= 'newpayday_id';
                $tbl = 'tbl_lead_new_payday';
            }
            if($campaign=='payday')
            {
                $objLeads = ORM::factory('payday');
                $lead_type = 'payday';
                $id= 'payday_id';
                $tbl = 'tbl_lead_payday';
            }
            if($campaign=='newcar')
            {
                $objLeads = ORM::factory('newcar');
                $lead_type = 'New Car';
                $id= 'lead_new_id';
                $tbl = 'tbl_lead_newcar';
            }
		$objCallcenter = ORM::factory('callcenter');
		$objAgent = ORM::factory('agent');
		$objClient = ORM::factory('client',array("eStatus"=>"Active"));
                $objUser = ORM::factory('user');
                $userData = $objUser->find_all()->as_array();
		//$leadsData = $objLeads->find_all();
		
		$callcenterData = $objCallcenter->find_all()->as_array();
		$agentData = $objAgent->find_all()->as_array();
		$clientData = $objClient->where('eStatus','=','Active')->find_all()->as_array();
		//echo Database::instance()->last_query;exit;
                
                if($_POST['action_frm']!='')
                {
                    $action_array = explode('_',$_POST['action_frm']);
                    
                    if($action_array[0]=='delete')
                    {
                        if($action_array[2]=='Auto')
                           $objLeads_delete = ORM::factory('leadauto',$action_array[1]);
                        else if($action_array[2]=='NewPayday')
                            $objLeads_delete = ORM::factory('paydaylead',$action_array[1]);
						else if($action_array[2]=='payday')
                            $objLeads_delete = ORM::factory('payday',$action_array[1]);
                        else
                          $objLeads_delete = ORM::factory('leads',$action_array[1]);
                        
                        $objLeads_delete->delete();
                    }
                }
                if($_POST['delete_all']!='')
                {
                    $delete_ids = substr($_POST['delete_all'],0,-1);
                    if($_POST['lead_type']=='Auto')
                    {
                        $tbl = 'tbl_lead_auto';
                        $id= 'lead_auto_id';
                    }
                    if($_POST['lead_type']=='payday')
                    {
                        $tbl = 'tbl_lead_payday';
                        $id= 'newpayday_id';
                    }
                   DB::delete($tbl)->where($id, 'IN',DB::expr('('.$delete_ids.')'))->execute();
                }
		if((isset($_POST['search_btn']) && $_POST['search_btn']!='') || isset($_REQUEST['sbt_frm']) || isset($_REQUEST['deleted_select']) || isset($_REQUEST['export_lead']))
		{
                        
			$total_record_to_show = $_POST['search_show'];
                        if($total_record_to_show=='')
                               $total_record_to_show = 50;
			$campaign =  $_POST['search_campaign'];
			if($_POST['search_startdate']!='')
				$startdate =  date('Y-m-d',strtotime($_POST['search_startdate']))." 00:00:00";
			if($_POST['search_enddate']=='')
				$enddate = date('Y-m-d h:i:s');
			else
				$enddate =  date('Y-m-d',strtotime($_POST['search_enddate']))." 00:00:00";
				
			$callcenter =  $_POST['search_callcenter'];
			$agent =  $_POST['search_agent'];
			$searchin =  $_POST['search_searchin'];
			$want_checked =  $_POST['search_checked'];
			$no_of_selectrecord =  $_POST['search_selectrecord'];
			$search_keyword = $_POST['search_keyword'];
                        $search_lead_start = $_POST['search_lead_start'];
                        $search_lead_end = $_POST['search_lead_end'];
                       
			
					
			$pagination_customer = Pagination::factory(array(
						'total_items' => $total_record_to_show,
						'items_per_page' => $total_record_to_show,
					));
                                        //echo $tbl;exit;
					$leadsData = $objLeads->select('users.*');
                                        $leadsData = $objLeads->join('users','left')->on('users.id', '=' ,$tbl.'.agent_id');
                                      
					if($startdate!='')
						$leadsData = $objLeads->where('c_date','>=',$startdate);
					
					if($enddate!='')
						$leadsData = $objLeads->where('c_date','<=',$enddate);
					
					if($callcenter!='')
						$leadsData = $objLeads->where('callcenter','=',$callcenter);
					if($agent!='')
						$leadsData = $objLeads->where('agent_id','=',$agent);
					if($searchin!='' && $search_keyword!='' )
						$leadsData = $objLeads->where($searchin,'like','%'.$search_keyword.'%');
                                        if($search_lead_start!='' && $search_lead_end!='')
                                            $leadsData = $objLeads->where($id,'BETWEEN',DB::expr(''.$search_lead_start.' AND'.' '.$search_lead_end.''));
                                        
                                       
					
					
					$leadsData = $objLeads->limit($pagination_customer->items_per_page);
					$leadsData = $leadsData->offset($pagination_customer->offset);
					$leadsData = $leadsData->find_all();
					$leadsData = $leadsData->as_array();
					//echo Database::instance()->last_query;
                    $page_links_pagging_customer = $pagination_customer->render();
                                       
                                        if(isset($_REQUEST['export_lead']))
                                        {
                                            
                                            $export_training_detail_data = "Agent Name,Name, Lead Type, Monthly Income,Phone,Email,Comment  \n";
                                            foreach($leadsData as $key=>$value){ 
                                                //echo  $value->fname." ".$value->lname; echo "<br>";
                                                $export_training_detail_data .= $value->username;
                                                $export_training_detail_data .= ",".$value->fname." ".$value->lname;
                                                 $export_training_detail_data .=",".$lead_type;
                                                 $export_training_detail_data .=",".'';
                                                 $export_training_detail_data .=",".$value->phone;
                                                 $export_training_detail_data .= ",".$value->email;
                                                 $export_training_detail_data .= ",".$value->comment;
                                                 
                                               /* $export_training_detail_data .= ",".$training_data["vemma_id"];
                                                $export_training_detail_data .= ",".$training_data["useremail"];
                                                $export_training_detail_data .= ",".$training_data["prospect_name"];
                                                $export_training_detail_data .= ",".$training_data["email"];
                                                $export_training_detail_data .= ",".$training_data["date_time"];*/
                                               $export_training_detail_data .= "\n";
                                            }
                                             //$export_prospect_agreement_data .= ',,,'.$sum_qty_ordered.",".$sum_qty_dropped.",".$sum_order_amount;

                                            $dir = Kohana::config('setup.base_path').'/export_csv/';
                                            $createdfile = $lead_type.date('ymd_his').'.csv';
                                            $filename= $dir.'\\'.$createdfile;
                                            $path_parts = pathinfo($filename);
                                            header("Content-type: application/octet-stream");
                                            header("Content-Disposition: filename=\"" . $path_parts["basename"] . "\"");
                                            echo $export_training_detail_data;
                                            die();
                                                
                                        }
					
					//echo Database::instance()->last_query;
		}

        $this->template->title = "Submit Leads";
		$this->template->clientData = $clientData;
		$this->template->content = View::factory('leads/submitleads')
                                            ->bind('pagging_links',$page_links_pagging_customer)
                                            ->bind('callcenterData',$callcenterData)
                                            ->bind('agentData',$agentData)
                                            ->bind('clientData',$clientData)
                                            ->bind('lead_type', $lead_type)
                                            ->bind('userData', $userData)
                                            ->bind('id', $id)
                                            ->bind('leadsData',$leadsData);
	}

	public function action_processlead()
	{
		
		$this->template->title = "Submit Leads";
		$this->template->clientData = $clientData;
		$this->template->content = View::factory('leads/processleads')
									->bind('pagging_links',$page_links_pagging_customer)
									->bind('callcenterData',$callcenterData)
									->bind('agentData',$agentData)
									->bind('clientData',$clientData)
                                    ->bind('leadsData',$leadsData);
	}
        
        public function action_viewedit($query_data)
	{
            
	    $this->template->set_filename('layout/popup');
            $this->template->title = "View - Edit Leads";
            
            $array = explode("&",$query_data);
            $lead_id = $array[0];
            $lead_type = $array[1];
             
            if($lead_type=='Auto' || $_POST['lead_type']=='Auto')
            {
                if($lead_id=='')
                     $lead_id = $_POST['lead_id'];
					$LeadsData = ORM::factory('leadauto',$lead_id);
                $lead_type = 'Auto';
				$view_page = 'vieweditlead';
            }
            else if($lead_type=='NewPayday' || $_POST['lead_type']=='NewPayday')
            {
                if($lead_id=='')
                     $lead_id = $_POST['lead_id'];
		$LeadsData = ORM::factory('paydaylead',$lead_id);
                
                $lead_type = 'Payday';
                $view_page = 'vieweditleadpayday';
            }
            else if($lead_type=='payday' || $_POST['lead_type']=='payday')
            {
                if($lead_id=='')
                     $lead_id = $_POST['lead_id'];
		$LeadsData = ORM::factory('payday',$lead_id);
                
                $lead_type = 'Payday';
                $view_page = 'vieweditleadpayday';
            }
            else
               $view_page = 'vieweditlead';
            
            //print_r($LeadsData);exit;
            //$LeadsData = ORM::factory('leads',$id);
            //echo "<pre>";
            //print_r($_POST);
            if($_POST['edit_btn']!=''){
                if($_POST['lead_type']=='Payday')
                  {
                      
                      $this->viewedit_payday($_POST,$lead_id);
                      $updated = 1;
                      
                  }
                  else
                  {
                      $LeadsData->phone = $_POST['txt_phone'];
                        $LeadsData->fname = $_POST['txt_fname'];
                        $LeadsData->lname = $_POST['txt_lname'];
                        $LeadsData->email = $_POST['txt_email'];
                        $LeadsData->address = $_POST['txt_address'];
                        $LeadsData->city = $_POST['txt_city'];
                        $LeadsData->state = $_POST['state'];
                        $LeadsData->zip = $_POST['txt_zip'];
                        $LeadsData->birth_date  = $_POST['dob'];
                        $LeadsData->rent_own  = $_POST['rent_own'];
                        $LeadsData->employer  = $_POST['txt_employer'];
                        $LeadsData->job_title  = $_POST['txt_occupation'];
                        $LeadsData->work_number  = $_POST['txt_workphone'];
                        $LeadsData->ssn  = $_POST['txt_ssn'];
                        $LeadsData->bankruptcy  = $_POST['bankrupt'];
                        $LeadsData->loan_amount  = $_POST['loan_amount'];
                        $LeadsData->cosigner  = $_POST['co_sign'];
                        $LeadsData->monthly_income   = $_POST['txt_monthlyincome'];
                        $LeadsData->comment  = $_POST['comment'];
                        $LeadsData->comment_admin  = $_POST['comment_admin'];
                        $LeadsData->save();
                        $updated = 1;
                  }
                
            
             
           }
            else
            {
                $updated = 0;
            }
        
            $this->template->content = View::factory('leads/'.$view_page)
                                        ->bind('leadsData',$LeadsData)
                                        ->bind('lead_type',$lead_type)
                                        ->bind('lead_id',$lead_id)
                                        ->bind('updated',$updated);
	}
        
       public function viewedit_payday($postdata,$lead_id)
	{
	    $objLeads_Newpayday = ORM::factory('paydaylead',$lead_id);
            $objLeads_Newpayday->fname = $postdata['fname'];
            $objLeads_Newpayday->lname = $postdata['lname'];
            $objLeads_Newpayday->phone = $postdata['phone'];
            $objLeads_Newpayday->address = $postdata['address'];
            $objLeads_Newpayday->city = $postdata['city'];
            $objLeads_Newpayday->state = $postdata['state'];
            $objLeads_Newpayday->zip = $postdata['zip'];
            $objLeads_Newpayday->email = $postdata['email'];
            $objLeads_Newpayday->dob = date('Y-m-d',strtotime($postdata['dob']));
            $objLeads_Newpayday->ssn = $postdata['ssn'];
            $objLeads_Newpayday->uin = $postdata['uin'];
            $objLeads_Newpayday->comment = $postdata['comment'];
            $objLeads_Newpayday->agent_id = Auth::instance()->get_user()->id;
            $objLeads_Newpayday->loan_amount = $postdata['loan_amount'];
            $objLeads_Newpayday->interest_rate_12 = $postdata['intrest_12'];
            $objLeads_Newpayday->interest_rate_24 = $postdata['intrest_24'];
            $objLeads_Newpayday->interest_rate_36 = $postdata['intrest_36'];
            $objLeads_Newpayday->installments_month_12 = $postdata['install_12'];
            $objLeads_Newpayday->installments_month_24 = $postdata['install_24'];
            $objLeads_Newpayday->installments_month_36 = $postdata['install_36'];
            $objLeads_Newpayday->advance_balance  = $postdata['advance_balance'];
            $objLeads_Newpayday->lead_reminder = date('Y-m-d',strtotime($postdata['followupdate']));
            $objLeads_Newpayday->loan_transfered = $postdata['loan_transfered'];
            $objLeads_Newpayday->c_date = date('Y-m-d h:i:s');
            $objLeads_Newpayday->save();
            $_POST = '';
            $process_done = 1;
	} 
        
        public function action_processmultileads()
	{
		
		$this->template->title = "Submit Leads";
		$this->template->clientData = $clientData;
		$this->template->content = View::factory('leads/processmultileads')
                                            ->bind('pagging_links',$page_links_pagging_customer)
                                            ->bind('callcenterData',$callcenterData)
                                            ->bind('agentData',$agentData)
                                            ->bind('clientData',$clientData)
                                    ->bind('leadsData',$leadsData);
	}
        
        public function action_savelead()
	{
           
            $objCashadvance = ORM::factory('cashadvance');
            
            $lead_data = $objCashadvance->where('lead_types','=','auto_sale')->where('c_date','like','%2012%')->limit(20000)->find_all();
            
            
             $lead_data = DB::select('id','callcenter','fname','lname','email','phone','address','zip','state','city',
                        'monthly_income','rent_own','year_of_resi','year_of_resi','bankruptcyOffer',
                        'birthday','employer','job_title','emp_work_phone','months_of_emp','co_sign','loan_amount',
                        'ssn','down_pay','credit_rating','down_pay','best_time_contact','IP_address','comment','callattended'
                     )
                ->from('cash_advance')
                ->where('lead_types', '=', 'auto_sale')
                ->where('c_date','like','%2012%')
                ->execute();
            echo Database::instance()->last_query;
            
            foreach ($lead_data as $lead)
            {
                //print_r($lead);
                $objCashadvance = ORM::factory('leadauto');
                $objCashadvance->fname = $lead['fname'];
                $objCashadvance->lname = $lead['lname'];
                $objCashadvance->email = $lead['email'];
                $objCashadvance->phone = $lead['phone'];
                $objCashadvance->address = $lead['address'];
                $objCashadvance->zip = $lead['zip'];
                $objCashadvance->state = $lead['state'];
                $objCashadvance->city = $lead['city'];
                $objCashadvance->monthly_income = $lead['monthly_income'];
                $objCashadvance->rent_own = $lead['rent_own'];
                $objCashadvance->year_residence = $lead['year_of_resi'];
                $objCashadvance->month_residence = 0;
                $objCashadvance->rent_payment ='';
                $objCashadvance->bankruptcy = $lead['bankruptcyOffer'];
                $objCashadvance->birth_date = $lead['birthday'];
                $objCashadvance->employer = $lead['employer'];
                $objCashadvance->job_title = $lead['job_title'];
                $objCashadvance->work_number = $lead['emp_work_phone'];
                $objCashadvance->year_with_company = '';
                $objCashadvance->month_with_company = $lead['months_of_emp'];
                $objCashadvance->cosigner = $lead['co_sign'];
                $objCashadvance->loan_amount = $lead['loan_amount'];
                $objCashadvance->ssn = $lead['ssn'];
                $objCashadvance->credit_check = '';
                $objCashadvance->down_payment = '';
                $objCashadvance->credit_score =$lead['credit_rating'];
                $objCashadvance->time_to_contact = $lead['best_time_contact'];
                $objCashadvance->ip_address = $lead['IP_address'];
                $objCashadvance->comments = $lead['comment'];
                $objCashadvance->call_attended = $lead['callattended'];
                $objCashadvance->callcenter = $lead['callcenter'];
                $objCashadvance->save();
                echo $lead['id']."===> Inserted <br>";              
            }
            echo Database::instance()->last_query;exit;
		
		$this->template->title = "Submit Leads";
		$this->template->clientData = $clientData;
		$this->template->content = View::factory('leads/processmultileads')
                                            ->bind('pagging_links',$page_links_pagging_customer)
                                            ->bind('callcenterData',$callcenterData)
                                            ->bind('agentData',$agentData)
                                            ->bind('clientData',$clientData)
                                    ->bind('leadsData',$leadsData);
	}
        
        
} // End Welcome

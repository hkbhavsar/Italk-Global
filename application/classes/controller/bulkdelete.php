<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Bulkdelete extends Controller_Layout {

  	public function before(){
		 parent::before();
	     $this->template->set_filename('layout/admin');
	}

  	public function __construct(Request $request)
	{
            
            // Check Login or not
               if (Auth::instance()->logged_in('',$all_required=false) == 0) {
            
                 Request::current()->redirect('/auth/signin');
                }
            
		// Assign the request to the controller
    		parent::__construct($request);
	}

	
	public function action_delete()
	{
            $objCallcenter = ORM::factory('callcenter');
            $callcenter_data = $objCallcenter->find_all()->as_array();
            $search_campaign = $_POST['search_campaign'];
            $search_callcenter = $_POST['search_callcenter'];
			if(isset($_POST['search_startdate']))
				$search_startdate = date('Y-m-d',strtotime($_POST['search_startdate']));
			$search_enddate = date('Y-m-d',strtotime($_POST['search_enddate']));
             if($search_enddate=='')
                $search_enddate = date('Y-m-d');
             else
                 $search_enddate = date('Y-m-d',strtotime($_POST['search_enddate']));
            
           if($search_startdate!='')
           {
				
               if($search_campaign=='new_payday')
               {
                    $lead_type = 'NewPayday';
                    $id= 'tbl_newpayday_for_agent';
                    $tbl = 'tbl_newpayday_for_agent';
                    $total_rows = DB::delete($tbl)->where('c_date','>=',$search_startdate)->where('c_date','<=',$search_enddate)->execute();
                    //echo Database::instance()->last_query;
                    
               }
			   else if($search_campaign=='auto_sale')
               {
                    $lead_type = 'Auto';
                    $id= 'lead_auto_id';
                    $tbl = 'tbl_lead_auto';
                    $total_rows = DB::delete($tbl)->where('c_date','>=',$search_startdate)->where('c_date','<=',$search_enddate)->execute();
                    //echo Database::instance()->last_query;
                    
               }
			   else if($search_campaign=='payday')
               {
                    $lead_type = 'Payday';
                    $id= 'payday_id';
                    $tbl = 'tbl_lead_payday';
                    $total_rows = DB::delete($tbl)->where('c_date','>=',$search_startdate)->where('c_date','<=',$search_enddate)->execute();
                    //echo Database::instance()->last_query;
                    
               }
               else
               {
                   $tbl = 'tbl_agent_upload';
                   $total_rows = DB::delete($tbl)->where('c_date','>=',$search_startdate)->where('c_date','<=',$search_enddate)->where('lead_types','=',$search_campaign)->execute();
                   //echo Database::instance()->last_query;exit;
               }
           }
            
           
		$this->template->title = "Dashboard";
		$this->template->content = View::factory('bulkdelete/deleteall')
  			->set('total_rows', $total_rows)
                        ->set('callcenter_data',  $callcenter_data)
                         ->set('money_coming', $money_coming)
                        ->set('paydayleadsData_reminder', $paydayleadsData_reminder)
                        ->set('newest_members_lists', $newest_members_lists);
               
                        
	}
	
	
       
} // End Dashboard

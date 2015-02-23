<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Report extends Controller_Layout {

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

	
	public function action_leadsales()
	{
             
            $objLeadsubmit = ORM::factory(leadsubmit);
            $leadsData = $objLeadsubmit->select(DB::expr('sum(price) as sum_price'),'client_id','tbl_client.vUsername');
            $leadsData = $objLeadsubmit->join('tbl_client','left')->on('tbl_lead_submit.client_id', '=','tbl_client.iClient_id');
            $leadsData = $objLeadsubmit->where('post_response','=','Success');
            if(isset($_POST['search_startdate']) && isset($_POST['search_enddate']))
            {
                $search_start_date = date('Y-m-d',strtotime($_POST['search_startdate']));
                $search_end_date = date('Y-m-d',strtotime($_POST['search_enddate']));
                $leadsData = $objLeadsubmit->where('c_date','>=',$search_start_date);
                $leadsData = $objLeadsubmit->where('c_date','<=',$search_end_date);
            }
            $leadsData = $objLeadsubmit->group_by('client_id');
            $leadsData = $objLeadsubmit->find_all();
            //echo Database::instance()->last_query;
            /*print_r($leadsData);
            exit;*/
            
           
		$this->template->title = "Dashboard";
		$this->template->content = View::factory('report/leadsales')
  			->set('leadsData', $leadsData)
                        ->set('paydayleadsData',  $paydayleadsData)
                         ->set('money_coming', $money_coming)
                        ->set('paydayleadsData_reminder', $paydayleadsData_reminder)
                        ->set('newest_members_lists', $newest_members_lists);
               
                        
	}
	public function action_indexr()
	{
            
            $obj_dashboard = new Model_Dashboard();
            $logged_in_userid = Auth::instance()->get_user()->id;
  

		$this->template->title = "Dashboard";
		$this->template->content = View::factory('dashboard/index_real')
  			->set('dash_datas', $dash_datas)
                        ->set('money_coming', $money_coming)
                        ->set('newest_members_lists', $newest_members_lists);
                        
	}
       
} // End Dashboard

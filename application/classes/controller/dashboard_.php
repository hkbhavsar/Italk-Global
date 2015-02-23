<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Dashboard extends Controller_Layout {

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

	
	public function action_index()
	{
            $obj_dashboard = new Model_Dashboard();
            $logged_in_userid = Auth::instance()->get_user()->id;
            $new_prospectes =  DB::select('first_name','last_name','created_date')
                                ->from('prospects')
                                ->where('user_id','=',$logged_in_userid)
                                ->limit(10)
                                ->execute()
                                ->as_array();
            $get_user_role = DB::select('role_id')->from('roles_users')->where('user_id','=',$logged_in_userid)->execute()->as_array();
            Session::instance()->set('user_role_id',$get_user_role[0]['role_id']);
	
            $dash_datas = $obj_dashboard->get_dashboarddata($logged_in_userid);

            $newest_members_lists = $obj_dashboard->getAllNewestMembers();

             $prospects = ORM::factory('prospects');
             $money_coming = count($prospects->get_moneycoming());
             
            $styles = array(
	
		);
  
		$scripts = array(
        	);

		$this->template->title = "Dashboard";
		$this->template->styles = array_merge($this->template->styles, $styles);
		$this->template->scripts = array_merge($this->template->scripts,$scripts);
		$this->template->content = View::factory('dashboard/index')
  			->set('dash_datas', $dash_datas)
                        ->set('money_coming', $money_coming)
                        ->set('newest_members_lists', $newest_members_lists);
                        
	}
} // End Dashboard

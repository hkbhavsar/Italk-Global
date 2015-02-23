<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Client extends Controller_Layout {
      
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
                        array('action' => 'add')), 301);
                                    
	}
        
        public function action_add($id=NULL)
	{
            
            $objClient = ORM::factory('client');
            if($id!='')
            {
                $client_edit_data = $objClient->find($id);
                //echo Database::instance()->last_query;
            }
           
            if($_POST['txt_clientname']!='')
            { 
                $check_data = $objClient->where('vUsername','=',$_POST['txt_clientname'])->where('iClient_id','!=',$id)->find_all();
                $objClient->vUsername =$_POST['txt_clientname'];
                $objClient->function_name =$_POST['txt_functionname'];
                $objClient->max_price =$_POST['txt_maxprice'];
                $objClient->min_price =$_POST['txt_minprice'];
                $objClient->eStatus =$_POST['select_status'];
                $objClient->clienttype =$_POST['select_client_type'];
                
                if(count($check_data)>0)
                {
                    $process_dup = 1;
                }
                else {
                    $objClient->save();
                    $process_done = 1;
                    $process_dup = 0;
                }
            }
            $this->template->title = "Add Client";
	    $this->template->content = View::factory('client/addclient')
                                    ->bind('process_done',$process_done)
                                    ->bind('process_dup',$process_dup) 
                                    ->bind('client_edit_data',$client_edit_data)
                                    ->bind('lead_uploaded',$lead_uploaded);
        }
        
        public function action_viewclient()
	{
            
            $objClient = ORM::factory('client');
            $client_data = $objClient->find_all();
            
            if($_POST['action_frm']!='')
            {
                 $action_array = explode('_',$_POST['action_frm']);
                 $objClient_delete = ORM::factory('client',$action_array[1]);
                 $objClient_delete->delete();
                 //echo Database::instance()->last_query;exit;
                 $process_done = 1;
            }
            $client_data = $objClient->find_all();
            $this->template->title = "View CallCenter";
	    $this->template->content = View::factory('client/viewclient')
                                    ->bind('process_done',$process_done)
                                    ->bind('process_dup',$process_dup)    
                                    ->bind('client_data',$client_data);
        }
   
} // End Welcome

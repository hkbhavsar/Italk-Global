<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Callcenter extends Controller_Layout {
      
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
        
        public function action_add($id=false)
	{
            if(isset($id))
            { 
                $objCallcenter = ORM::factory('callcenter',$id);
                $callcenter_edit_data = $objCallcenter->find($id);
            } 
           else {
                $objCallcenter = ORM::factory('callcenter');
            }
            if($_POST['txt_callcenter']!='')
            { 
                if(isset($id))
                { 
                    $check_data = $objCallcenter->where('name','=',$_POST['txt_callcenter'])->where('id','!=',$id)->find_all();
                }
                else
                    $check_data = $objCallcenter->where('name','=',$_POST['txt_callcenter'])->find_all();
          
                    
                $objCallcenter->name =$_POST['txt_callcenter'];
                
                if(count($check_data)>0)
                {
                    $process_dup = 1;
                }
                else {
                    $objCallcenter->save();
                     if(isset($id)) 
                     $edit_done = 1;
                    $process_done = 1;
                    $process_dup = 0;
                }
            }
            $this->template->title = "Upload Leads For Agent";
	    $this->template->content = View::factory('callcenter/addcallcenter')
                                    ->bind('process_done',$process_done)
                                    ->bind('process_dup',$process_dup) 
                                    ->bind('edit_done', $edit_done)
                                    ->bind('callcenter_edit_data',$callcenter_edit_data)
                                    ->bind('lead_uploaded',$lead_uploaded);
        }
        
        public function action_viewcallcenter()
	{
            
            $objCallcenter = ORM::factory('callcenter');
            $call_center_data = $objCallcenter->find_all();
            
            if($_POST['action_frm']!='')
            {
                 $action_array = explode('_',$_POST['action_frm']);
                 
                 $objCallcenter_delete = ORM::factory('callcenter',$action_array[1]);
                 $objCallcenter_delete->delete();
                 //echo Database::instance()->last_query;exit;
                 $process_done = 1;
            }
            $call_center_data = $objCallcenter->find_all();
            $this->template->title = "View CallCenter";
	    $this->template->content = View::factory('callcenter/viewcallcenter')
                                    ->bind('process_done',$process_done)
                                    ->bind('process_dup',$process_dup)    
                                    ->bind('call_center_data',$call_center_data);
        }
   
} // End Welcome

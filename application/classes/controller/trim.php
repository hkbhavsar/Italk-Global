<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Trim extends Controller_Layout {
      
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
            $objtrim = ORM::factory('trim');
            $objmake = ORM::factory('make');
            $make_data = $objmake->find_all();
            $objmodel = ORM::factory('model');
            $model_data = $objmodel->find_all();
            if(isset($id))
            { 
               $objtrim = ORM::factory('trim',$id);
               $trim_edit_data = $objtrim->find($id);
               
            } 
           else {
                $objtrim = ORM::factory('trim');
            }
            if($_POST['txt_trim']!='')
            { 
                /*echo "<pre>";
                 print_r($_POST);exit;*/
                if(isset($id))
                { 
                    $check_data = $objtrim->where('trim_name','=',$_POST['txt_trim'])->where('model_id','=',$_POST['model_name'])->find_all();
                }
                else
                    $check_data = $objmodel->where('trim_name','=',$_POST['txt_trim'])->find_all();
          
                    
                $objtrim->make_id=$_POST['make_name'];
               
                $objtrim->model_id=$_POST['model_name'];
                
                $objtrim->trim_name=$_POST['txt_trim'];
                 
                
                if(count($check_data)>0)
                {
                    $process_dup = 1;
                }
                else {
                    
                    $objtrim->save();
                     if(isset($id)) 
                     $edit_done = 1;
                    $process_done = 1;
                    $process_dup = 0;
                }
            }
            
            $this->template->title = "Add Trim";
	    $this->template->content = View::factory('trim/addtrim')
                                    ->bind('process_done',$process_done)
                                    ->bind('process_dup',$process_dup) 
                                    ->bind('edit_done', $edit_done)
                                    ->bind('trim_edit_data',$trim_edit_data)
                                    ->bind('make_data',$make_data)
                                    ->bind('model_data',$model_data)
                                    ->bind('id',$id)
                                    ->bind('lead_uploaded',$lead_uploaded);
        }
        
        public function action_view()
	{
            $objtrim = ORM::factory('trim');
            $objmodel = ORM::factory('model');
            $trimData = $objtrim->select('tbl_make.make_name','tbl_model.model_name');
            $trimData = $objtrim->join('tbl_make')->on('tbl_make.make_id', '=' ,'tbl_trim.make_id');
            $trimData = $objtrim->join('tbl_model')->on('tbl_model.model_id', '=' ,'tbl_trim.model_id');
            
               
            if($_POST['action_frm']!='')
            {
                 $action_array = explode('_',$_POST['action_frm']);
                 
                 $objtrim_delete = ORM::factory('trim',$action_array[1]);
                 $objtrim_delete->delete();
                 //echo Database::instance()->last_query;exit;
                 $process_done = 1;
            }
            
            $pagination_trim = Pagination::factory(array(
                                               'total_items' => 7000,
                                               'items_per_page' => 500,
                                       ));                    
            $trimData = $objtrim->limit($pagination_trim->items_per_page);
	    $trimData = $objtrim->offset($pagination_trim->offset);
            $trimData = $objtrim->find_all();
            
          // echo Database::instance()->last_query;
           $page_links_pagging_trim = $pagination_trim->render();
            $this->template->title = "View Make";
	    $this->template->content = View::factory('trim/viewtrim')
                                    ->bind('process_done',$process_done)
                                    ->bind('page_links_pagging_trim',$page_links_pagging_trim)
                                    ->bind('process_dup',$process_dup)    
                                    ->bind('trimData',$trimData);
        }
        
        public function action_searchtrim()
        {
            //print_r($_POST);exit;
            $objtrim= ORM::factory('trim');
            $trim_data = $objtrim->where("make_id","=",$_POST['make_id'])->where("model_id","=",$_POST['model_id'])->find_all();
           //print_r($objmodel);
            echo '<select name="trim" id="trim"><option value="">--- Select ---</option>';
            foreach($trim_data as $key=>$value)
            {
                echo '<option value="'.$value->trim_id.'">'.$value->trim_name.'</option>';
            }
            echo '</select>';
            exit;
            
        }
   
} 

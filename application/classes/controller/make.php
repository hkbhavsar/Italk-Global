<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Make extends Controller_Layout {
      
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
                $objmake = ORM::factory('make',$id);
                $make_edit_data = $objmake->find($id);
            } 
           else {
                $objmake = ORM::factory('callcenter');
            }
            if($_POST['txt_make']!='')
            { 
                if(isset($id))
                { 
                    $check_data = $objmake->where('make_name','=',$_POST['txt_make'])->where('make_id','!=',$id)->find_all();
                }
                else
                    $check_data = $objmake->where('make_name','=',$_POST['txt_make'])->find_all();
          
                    
                $objmake->make_name =$_POST['txt_make'];
                
                if(count($check_data)>0)
                {
                    $process_dup = 1;
                }
                else {
                    $objmake->save();
                     if(isset($id)) 
                     $edit_done = 1;
                    $process_done = 1;
                    $process_dup = 0;
                }
            }
            $this->template->title = "Add Makes";
	    $this->template->content = View::factory('make/addmake')
                                    ->bind('process_done',$process_done)
                                    ->bind('process_dup',$process_dup) 
                                    ->bind('edit_done', $edit_done)
                                    ->bind('make_edit_data',$make_edit_data)
                                    ->bind('lead_uploaded',$lead_uploaded);
        }
        
        public function action_view()
	{
            $objmake = ORM::factory('make');
            if($_POST['action_frm']!='')
            {
                 $action_array = explode('_',$_POST['action_frm']);
                 
                 $objMake_delete = ORM::factory('make',$action_array[1]);
                 $objMake_delete->delete();
                 //echo Database::instance()->last_query;exit;
                 $process_done = 1;
            }
           $pagination_make = Pagination::factory(array(
                                               'total_items' => 75,
                                               'items_per_page' => 30,
                                       ));                    
            $make_data = $objmake->limit($pagination_make->items_per_page);
	    $make_data = $objmake->offset($pagination_make->offset);
            $make_data = $objmake->find_all();
            $page_links_pagging_make = $pagination_make->render();
            
            $this->template->title = "View Make";
	    $this->template->content = View::factory('make/viewmake')
                                    ->bind('process_done',$process_done)
                                     ->bind('page_links_pagging_make',$page_links_pagging_make)    
                                    ->bind('process_dup',$process_dup)    
                                    ->bind('makedata',$make_data);
        }
        
        public function action_searchformodel()
        {
           // print_r($_POST);exit;
            $objmodel= ORM::factory('model');
            $model_data = $objmodel->where("make_id","=",$_POST['makeid'])->find_all();
           //print_r($objmodel);
            echo '<select name="model" onchange="find_trim(this.options[selectedIndex].value,'.$_POST['makeid'].');"><option value="">--- Select ---</option>';
            foreach($model_data as $key=>$value)
            {
                echo '<option value="'.$value->model_id.'">'.$value->model_name.'</option>';
            }
            echo '</select>';
            exit;
            
        }
   
} ?>

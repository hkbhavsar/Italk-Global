<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Model extends Controller_Layout {
      
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
           
            $objmake = ORM::factory('make');
            $make_data = $objmake->find_all();
            if(isset($id))
            { 
                $objmodel = ORM::factory('model',$id);
                $model_edit_data = $objmodel->find($id);
               
            } 
           else {
                $objmodel = ORM::factory('model');
            }
            if($_POST['txt_model']!='')
            { 
                /*echo "<pre>";
                 print_r($_POST);exit;*/
                if(isset($id))
                { 
                    $check_data = $objmodel->where('model_name','=',$_POST['txt_model'])->where('make_id','=',$_POST['make_name'])->find_all();
                }
                else
                    $check_data = $objmodel->where('model_name','=',$_POST['txt_model'])->find_all();
          
                    
                $objmodel->make_id=$_POST['make_name'];
               
                $objmodel->model_name=$_POST['txt_model'];
                 
                
                if(count($check_data)>0)
                {
                    $process_dup = 1;
                }
                else {
                    
                    $objmodel->save();
                     if(isset($id)) 
                     $edit_done = 1;
                    $process_done = 1;
                    $process_dup = 0;
                }
            }
            
            $this->template->title = "Add Model";
	    $this->template->content = View::factory('model/addmodel')
                                    ->bind('process_done',$process_done)
                                    ->bind('process_dup',$process_dup) 
                                    ->bind('edit_done', $edit_done)
                                    ->bind('model_edit_data',$model_edit_data)
                                    ->bind('make_data',$make_data)
                                    ->bind('id',$id)
                                    ->bind('lead_uploaded',$lead_uploaded);
        }
        
        public function action_view()
	{
            $objmodel = ORM::factory('model');
            $modelData = $objmodel->select('tbl_make.make_name');
            $modelData = $objmodel->join('tbl_make')->on('tbl_make.make_id', '=' ,'tbl_model.make_id');
                                      
            if($_POST['action_frm']!='')
            {
                 $action_array = explode('_',$_POST['action_frm']);
                 
                 $objmodel_delete = ORM::factory('model',$action_array[1]);
                 $objmodel_delete->delete();
                 //echo Database::instance()->last_query;exit;
                 $process_done = 1;
            } 
            
            $pagination_model = Pagination::factory(array(
                                               'total_items' => 700,
                                               'items_per_page' => 50,
                                       ));                    
            $modelData = $objmodel->limit($pagination_model->items_per_page);
	    $modelData = $objmodel->offset($pagination_model->offset);
            $modelData = $objmodel->find_all();
            //echo Database::instance()->last_query;exit;
            $page_links_pagging_model = $pagination_model->render();
            $this->template->title = "View Make";
	    $this->template->content = View::factory('model/viewmodel')
                                    ->bind('process_done',$process_done)
                                    ->bind('process_dup',$process_dup)  
                                     ->bind('page_links_pagging_model',$page_links_pagging_model) 
                                    ->bind('modelData',$modelData);
        }
   
} // End Welcome

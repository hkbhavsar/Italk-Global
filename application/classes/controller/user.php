<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_User extends Controller_Layout {
      
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
		//echo "<pre>";
			
            if(isset($id))
                $objusers = ORM::factory('users');
            else
                $objusers = ORM::factory('users',$id);
            
            if($id!='')
            {
                $user_edit_data = $objusers->find($id);
                //echo Database::instance()->last_query;
            }
			
            if($_POST['txt_username']!='')
            { 
                if(!isset($id))
                $check_data = $objusers->where('username','=',$_POST['txt_username'])->find_all();
                $objusers->first_name =$_POST['txt_firstname'];
                $objusers->last_name =$_POST['txt_lastname'];
                $objusers->username =$_POST['txt_username'];
                $objusers->password = Auth::instance()->hash_password($_POST['txt_password']);
                $objusers->role_id =$_POST['type_user'];
				$objusers->user_photo = $_POST['txt_firstname']."_".date('his')."_".strtolower($_FILES["file_browse"]["name"]);
				
				if ((($_FILES["file_browse"]["type"] == "image/gif")
					|| ($_FILES["file_browse"]["type"] == "image/jpeg")
					|| ($_FILES["file_browse"]["type"] == "image/pjpeg")
					|| ($_FILES["file_browse"]["type"] == "image/png"))
					&& ($_FILES["file_browse"]["size"] < 400000))
					  {
						 if ($_FILES["file_browse"]["error"] > 0)
						  {
						   echo "Return Code: " . $_FILES["file_browse"]["error"] . "<br />";
						  }
						  
						  else
						   {
							  if (file_exists("user_photo/" . $_FILES["file_browse"]["name"]))
							   {
								 echo $_FILES["file_browse"]["name"] . " already exists. ";
								} 
							  else 
								 {
									 move_uploaded_file($_FILES["file_browse"]["tmp_name"],
									 "user_photo/".$_POST['txt_firstname']."_".date('his')."_".strtolower($_FILES["file_browse"]["name"]));
									 echo "Stored in: " . "user_photo/" . $_FILES["file_browse"]["name"];
									echo "<br /><br /><br />" . $full_image_url;
								 }
						   }
						  
					 }
				
              if(count($check_data)>0)
                {
                    $user_dup = 1;
                }
                else {
                    $user_inserted_id = $objusers->save();
                   if(!isset($id)) 
                   {
                        DB::insert('roles_users', array('user_id','role_id'))
                      ->values(array($user_inserted_id,$_POST['type_user']))
                      ->execute();
                   }
                   else
                   {
                        DB::update('roles_users')->set(array('role_id' => $_POST['type_user']))->where('id', '=', $id);
                        if(isset($id))
                        {
                            Request::current()->redirect('user/view/done');
                        } 
                   }
                    $process_done = 1;
                    $process_dup = 0;
                }
            }
           
        $this->template->title = "Add User";
	    $this->template->content = View::factory('user/adduser')
                                    ->bind('process_done',$process_done)
                                    ->bind('user_dup',$user_dup) 
                                    ->bind('user_edit_data',$user_edit_data)
                                    ->bind('lead_uploaded',$lead_uploaded);
        }
        
        public function action_view()
	{
            $objusers = ORM::factory('users');
            $user_data = $objusers->find_all();
            
            if($_POST['action_frm']!='')
            {
                 $action_array = explode('_',$_POST['action_frm']);
                 $objClient_delete = ORM::factory('user',$action_array[1]);
                 $objClient_delete->delete();
                 //echo Database::instance()->last_query;exit;
                 $process_done = 1;
            }
            $user_data = $objusers->find_all();
            $this->template->title = "View User";
	    $this->template->content = View::factory('user/viewuser')
                                    ->bind('process_done',$process_done)
                                    ->bind('process_dup',$process_dup) 
                                    //->bind('edit_sucess',basename($_SERVER['REQUEST_URI']))
                                    ->bind('user_data',$user_data);
        }
   
} // End Welcome

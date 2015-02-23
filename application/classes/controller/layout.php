<?php defined('SYSPATH') or die('No direct script access.');
  ini_set("display_errors", 1);
  class Controller_Layout extends Controller_Template 
  {
			
  	
      public $template = 'layout/template';

      
      // Controls access for the whole controller, if not set to FALSE we will only allow user roles specified
      // Can be set to a string or an array, for example 'login' or array('login', 'admin')
      // Note that in second(array) example, user must have both 'login' AND 'admin' roles set in database
      public $auth_required = FALSE;
 
      // Controls access for separate actions
      // 'adminpanel' => 'admin' will only allow users with the role admin to access action_adminpanel
      // 'moderatorpanel' => array('login', 'moderator') will only allow users with the roles login and moderator to access action_moderatorpanel
      public $secure_actions = FALSE;
      
      
      
      /**
       * The before() method is called before your controller action.
       * In our template controller we override this method so that we can
       * set up default values. These variables are then available to our
       * controllers if they need to be modified.
       */
      public function before()
      {
		parent::before();

		#Open session
        $this->session= Session::instance();

        #Check user auth and role
        $action_name = Request::instance()->action;
        
        //*******Put this in temporary
        	//$this->auth_required = false;
        //*******End of Temporary

        if (($this->auth_required !== FALSE && Auth::instance()->logged_in($this->auth_required) === FALSE)
                || (is_array($this->secure_actions) && array_key_exists($action_name, $this->secure_actions) && 
                Auth::instance()->logged_in($this->secure_actions[$action_name]) === FALSE))
		{
			if (Auth::instance()->logged_in()){
				Request::instance()->redirect('/auth/signout');
			}else{
				Request::instance()->redirect('auth/signin');
			}
		}
		
		if ($this->auto_render)
  	    {
  	    	$this->template->title   = 'Vemma Builder';
  	    	$this->template->content = '';
  			
  			$this->template->styles = array();
  			$this->template->scripts = array();
          			
          }
      }
  	
      /**
       * The after() method is called after your controller action.
       * In our template controller we override this method so that we can
       * make any last minute modifications to the template before anything
       * is rendered.
       */
      public function after()
      {
		if ($this->auto_render)
		{			
			$styles = array(
			);
  
			$scripts = array(
			);
		
		$this->template->styles = array_merge( $this->template->styles, $styles );
		$this->template->scripts = array_merge( $this->template->scripts, $scripts );
	}
	parent::after();
      }

  }

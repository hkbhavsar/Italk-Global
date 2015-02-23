<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Welcome extends Controller_Layout {

  	public $auth_required = array('login','admin');
  	
  	public function before(){
		 parent::before();
	     $this->template->set_filename('layout/welcome');
	}
	
  	public function __construct(Request $request)
	{
		// Assign the request to the controller
    		parent::__construct($request);
	}

	
	public function action_index()
	{
            
		
		$styles = array(
			'/css/admin/orange.css' => 'screen'
		);
  
		$scripts = array(
			'lib/js/jquery-1.6.min.js'
		);
		$this->template->styles = array_merge($this->template->styles, $styles);
		$this->template->scripts = array_merge($this->template->scripts,$scripts);
		$this->template->content = View::factory('welcome/index')
  			->set('message', "hello world")->set('title', "Vemma Builder")
                        ->bind('errors', $errors);
	}

} // End Welcome

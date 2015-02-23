<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Error extends Controller_Layout {

	
	public function before() {
		parent::before();
	
	}
	
	public function __construct(Request $request) {
		// Assign the request to the controller
		parent::__construct($request);
		
	}	
    public function action_404()
    {
		$styles = array(
            '/css/orange.css' => 'screen',
			'/css/style.css' => 'screen',
           
        );

		$this->template->title = '404 page';
		$this->template->styles = $styles;
        $this->template->status = 404;
        //$this->template->headers['HTTP/1.1'] = '404';
        //$this->template->content =  View::factory('dashboard/index');
		$this->template->content = View::factory('error/404index');
    }

    public function action_403()
    {
        $this->template->title = '403 page';
		$this->template->styles = $styles;
        $this->template->status = 403;
        //$this->template->headers['HTTP/1.1'] = '404';
        //$this->template->content =  View::factory('dashboard/index');
		$this->template->content = View::factory('error/403index');
    }

    public function action_500()
    {
        $this->template->title = '500 page';
		$this->template->styles = $styles;
        $this->template->status = 500;
        //$this->template->headers['HTTP/1.1'] = '404';
        //$this->template->content =  View::factory('dashboard/index');
		$this->template->content = View::factory('error/500index');
    }
} // End Error
?>
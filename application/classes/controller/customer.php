<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Customer extends Controller_Layout {
      
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
                        array('action' => 'list')), 301);
	}
    public function action_create($id=false)
	{
		if($_POST)
		{
			$objCustomer = ORM::factory('customer');
			$result = $objCustomer->createCustomer($_POST,$id);
		}
		if(isset($id) && $id!='')
		{
			$objCustomer = ORM::factory('customer',$id);
			$objAddress = ORM::factory('address',array("cust_id"=>$id,"primary_address"=>'Y'));
			$custData = $objCustomer->as_array(); 
			$custAddress = $objAddress->as_array();
			//echo Database::instance()->last_query;
			$title = "Edit Customer :: ".$custData['first_name']." ".$custData['last_name'];
		}
		else
		{
			$title = "Add Customer";
			$custData = '';
			$custAddress='';
		}
	
        $this->template->title = "Add Customer";
		$this->template->content = View::factory('customer/create')
											->bind('title',$title)
											->bind('edit_custdata',$custData)
											->bind('edit_address',$custAddress)
                                            ->bind('results',$result);
	}
	public function action_list()
	{
		$objCustomer = ORM::factory('customer');
		$custData = $objCustomer->find_all()->as_array();
				
		$pagination_customer = Pagination::factory(array(
                    'total_items' => count($custData),
                    'items_per_page' => 10,
                ));
		$custData = $objCustomer->limit($pagination_customer->items_per_page);
                $custData = $custData->offset($pagination_customer->offset);
                $custData = $custData->find_all();
                $custData = $custData->as_array();

        $page_links_pagging_customer = $pagination_customer->render();
		
        $this->template->title = "List Customer";
		$this->template->content = View::factory('customer/list')
									->bind('pagging_links',$page_links_pagging_customer)
                                    ->bind('custdata',$custData);
	}

} // End Welcome

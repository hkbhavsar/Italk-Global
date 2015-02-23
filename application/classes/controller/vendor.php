<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Vendor extends Controller_Layout {
      
  	public function before(){
		 parent::before();
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
			$objVendor = ORM::factory('vendor');
			$result = $objVendor->createVendor($_POST,$id);
		}
		if(isset($id) && $id!='')
		{
			$objVendor = ORM::factory('vendor',$id);
			$vendorData = $objVendor->as_array(); 
			//echo Database::instance()->last_query;
			$title = "Edit Vendor :: ".$vendorData['first_name']." ".$vendorData['last_name'];
		}
		else
		{
			$title = "Add Vendor";
			$custData = '';
			$custAddress='';
		}
	
        $this->template->title = "Add Vendor";
		$this->template->content = View::factory('vendor/create')
											->bind('title',$title)
											->bind('edit_custdata',$vendorData)
                                            ->bind('results',$result);
	}
	public function action_list()
	{
		$objVendor = ORM::factory('vendor');
		$vendorData = $objVendor->find_all()->as_array();

		$pagination_vendor = Pagination::factory(array(
                    'total_items' => count($vendorData),
                    'items_per_page' => 10,
                ));
		$vendorData = $objVendor->limit($pagination_vendor->items_per_page);
        $vendorData = $vendorData->offset($pagination_vendor->offset);
        $vendorData = $vendorData->find_all();
        $vendorData = $vendorData->as_array();

        $page_links_pagging_vendor = $pagination_vendor->render();

        $this->template->title = "List Vendors";
		$this->template->content = View::factory('vendor/list')
									->bind('pagging_links',$page_links_pagging_vendor)
                                    ->bind('vendorData',$vendorData);
	}

} // End Welcome

<?php  defined('SYSPATH') or die('No direct script access.');

  class Controller_Inventory extends Controller_Layout {
      
  	public function before(){
             parent::before();
             
             
             
            $scripts = array(
            'js/inventory.js',
            );
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
            //print_r($_POST);exit;
		if($_POST)
		{
			$objInventory = ORM::factory('inventory');
			$result = $objInventory->addInventory($_POST,$id);
		}
		if(isset($id) && $id!='')
		{
			$objProducts = ORM::factory('products',$id);
			$objAddress = ORM::factory('address',array("cust_id"=>$id,"primary_address"=>'Y'));
			$productData = $objProducts->as_array(); 
                        $vendorData = $objVendor->find_all()->as_array();
			//echo Database::instance()->last_query;
			$title = "Edit Product :: ".$productData['model'];
		}
		else
		{
			$title = "Add Inventory";
			$custData = '';
			$custAddress='';
		}
                $objVendor = ORM::factory('vendor');
                $vendorData = $objVendor->find_all()->as_array();
                $this->template->title = "Add Inventory";
		$this->template->content = View::factory('inventory/create')
                                            ->bind('title',$title)
                                            ->bind('edit_productData',$productData)
                                            ->bind('edit_address',$custAddress)
                                             ->bind('vendorData',$vendorData)
                                            ->bind('results',$result);
	}
	public function action_list()
	{
		$objProduct = ORM::factory('products');
                $objVendor = ORM::factory('vendor');
                $objInventory = ORM::factory('inventory');
		$productData = $objProduct->find_all()->as_array();
                $vendorData = $objVendor->find_all()->as_array();
                $inventoryData = $objInventory->find_all()->as_array();
                
		
		$pagination_inventory = Pagination::factory(array(
                    'total_items' => count($inventoryData),
                    'items_per_page' => 10,
                ));
                $inventoryData = $objInventory->select('tbl_products.*','tbl_vendor.*');
                $inventoryData = $inventoryData->join('tbl_products');
                $inventoryData = $inventoryData->on('tbl_products.product_id','=','tbl_inventory.product_id');
               
		$inventoryData = $inventoryData->join('tbl_vendor');
                $inventoryData = $inventoryData->on('tbl_vendor.vendor_id','=','tbl_inventory.vendor_id');
                $inventoryData = $inventoryData->order_by('tbl_products.product_type','asc');
                $inventoryData = $inventoryData->order_by('tbl_products.model','asc');
                $inventoryData = $objInventory->limit($pagination_inventory->items_per_page);
                $inventoryData = $inventoryData->offset($pagination_inventory->offset);
                $inventoryData = $inventoryData->find_all();
                $inventoryData = $inventoryData->as_array();
                
                $page_links_pagging_inventory = $pagination_inventory->render();
                
                $this->template->title = "List Inventory";
		$this->template->content = View::factory('inventory/list')
                                    ->bind('vendorData',$vendorData)
                                    ->bind('inventoryData',$inventoryData)
                                    ->bind('pagging_links',$page_links_pagging_inventory)
                                    ->bind('productData',$productData);
                
	}
        
        public function action_scan_barcode_operation()
	{
            print_r($_POST['barcode_num'])."<br>";exit;
        }

} // End Welcome

<?php  defined('SYSPATH') or die('No direct script access.');

  class Controller_Product extends Controller_Layout {
      
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
			$objProducts = ORM::factory('products');
			$result = $objProducts->addProduct($_POST,$id);
		}
		if(isset($id) && $id!='')
		{
			$objProducts = ORM::factory('products',$id);
			$objAddress = ORM::factory('address',array("cust_id"=>$id,"primary_address"=>'Y'));
			$productData = $objProducts->as_array(); 
			//echo Database::instance()->last_query;
			$title = "Edit Product :: ".$productData['model'];
		}
		else
		{
			$title = "Add Product";
			$custData = '';
			$custAddress='';
		}
	
        $this->template->title = "Add Customer";
		$this->template->content = View::factory('product/create')
                                            ->bind('title',$title)
                                            ->bind('edit_productData',$productData)
                                            ->bind('edit_address',$custAddress)
                                            ->bind('results',$result);
	}
	public function action_list()
	{
		$objProduct = ORM::factory('products');
		$productData = $objProduct->find_all()->as_array();
                
		$pagination_product = Pagination::factory(array(
                    'total_items' => count($productData),
                    'items_per_page' =>10,
                ));
		$productData = $objProduct->limit($pagination_product->items_per_page);
                $productData = $productData->offset($pagination_product->offset);
                $productData = $productData->find_all();
                $productData = $productData->as_array();

        $page_links_pagging_product = $pagination_product->render();
                
                $this->template->title = "List Products";
		$this->template->content = View::factory('product/list')
                                     ->bind('pagging_links',$page_links_pagging_product)
                                    ->bind('productData',$productData);
	}
        
        public function action_getProduct()
	{
                $this->auto_render=false;
		$objProduct = ORM::factory('products');
		$productData = $objProduct->where('product_type','=',$_POST['product_type'])->find_all();
                $this->template->content = View::factory('product/dropdown')
                                    ->bind('productData',$productData);
                 echo $this->template->content;
                exit;
	}

} // End Welcome

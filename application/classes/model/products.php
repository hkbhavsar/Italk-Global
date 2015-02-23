<?php
class Model_Products extends ORM{

  protected $_table_name  = 'tbl_products'; 
  protected $_primary_key = 'product_id';      // default: id
  public $errors = '';
  
  
   protected $_rules = array
	(
		'model'                    => array
		(
			'not_empty'		=> NULL,
		),
	);
 
	
	public function validate_create($postvalues) 
        {
            //// Initialise the validation library and setup some rules		
		$array = Validate::factory($postvalues)
                        ->rules('model', $this->_rules['model'])
                        ->filter('model', 'trim');
              
                #Add Model_Auth_User callbacks
                foreach($this->_callbacks as $field => $callbacks){
                    foreach($callbacks as $callback)
                    {
			$array->callback($field, array($this, $callback));
                    }
                }

		return $array;
	}
        
        function addProduct($postdata,$id)
        {
            $post = $this->validate_create($postdata);
			
			//print_r($postdata);exit;
			
            if($post->check())
            {
				
				$objProducts = ORM::factory('products',$id);
				$objProducts->product_type = $postdata['product_type'];
				$objProducts->sku = $postdata['sku'];
				$objProducts->model = $postdata['model'];
				$objProducts->manufacturer = $postdata['mfr'];
				$objProducts->cost = $postdata['cost'];
				$objProducts->retail_price = $postdata['retail_price'];
				$objProducts->carrier = $postdata['carrier'];
				$objProducts->repair_price = $postdata['repair_price'];
				$objProducts->lowest_price = $postdata['lowest_price'];
				$objProducts->alt_barcode = $postdata['alt_barcode'];
				$objProducts->lowest_qty = $postdata['lowest_qty'];
				$objProducts->states_tax = $postdata['states_tax'];
				$objProducts->exception_price = $postdata['exception_price'];
				$objProducts->description = $postdata['description'];
				$last_inserted_id = $objProducts->save();
				
				//print_r($postdata);exit;
				if($id!='')
				{
					$msg = "Product Updated Sucessfully";
					$address_id = $postdata['address_id'];
				}
				else
				{
					$msg = "Product Added Sucessfully";
					$primary = 'Y';
				}
				
				Session::instance()->set('session_msg',$msg);
				Request::current()->redirect('product/list');
            }
            else
            {
                 //$_POST = array_intersect_key( $post->as_array(), $_POST);
                 $msg_errors = $post->errors('product');
            }
                $reutn_data['msg_errors']= $msg_errors;
                $reutn_data['msg_success']= $msg_success;
                return $reutn_data;
            
        }
        
       /**
	 * Validates login information from an array, and optionally redirects
	 * after a successful login.
	 *
	 * @param   array    values to check
	 * @param   string   URI or URL to redirect to
	 * @return  boolean
	 */
	public function login(array & $array, $redirect = FALSE)
	{
                
		$fieldname = $this->unique_key($array['username']);
		$array = Validate::factory($array)
			->label('username', $this->_labels[$fieldname])
			->label('password', $this->_labels['password'])
			->filter(TRUE, 'trim')
			->rules('username', $this->_rules[$fieldname])
			->rules('password', $this->_rules['password']);
                
		// Get the remember login option
		$remember = isset($array['remember']);

		// Login starts out invalid
		$status = FALSE;

		if ($array->check())
		{
			// Attempt to load the user
			$this->where($fieldname, '=', $array['username'])->find();
			if ($this->loaded() AND Auth::instance()->login($this, $array['password'], $remember))
			{
				if (is_string($redirect))
				{
					// Redirect after a successful login
					Request::instance()->redirect($redirect);
				}
				// Login is successful
				$status = TRUE;
			}
			else
			{
                            $LoginErrors = array(
                                "success" => false,
                                "error" => "username or password is wrong..!!",
                                "fail" => true
                            );                          
                            echo $loginJSONerror = json_encode($LoginErrors);exit;
				
			}
		}
                
               $errors = $array->errors('signin');
               
              if (!empty($errors)) {
                           $LoginErrors = array(
                                "success" => false,"error" => $errors
                            );
                        echo $loginJSONerror = json_encode($LoginErrors);exit;
                    }
              else
              {
   		return $status;
              }
	}


}
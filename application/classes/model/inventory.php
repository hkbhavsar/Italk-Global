<?php
class Model_Inventory extends ORM{

  protected $_table_name  = 'tbl_inventory'; 
  protected $_primary_key = 'inventory_id';      // default: id
  public $errors = '';
  
  
   protected $_rules = array
	(
		'product_type'                    => array
		(
			'not_empty'		=> NULL,
		),
	);
 
	
	public function validate_create($postvalues) 
        {
            //// Initialise the validation library and setup some rules		
		$array = Validate::factory($postvalues)
                        ->rules('product_type', $this->_rules['product_type'])
                        ->filter('product_type', 'trim');
              
                #Add Model_Auth_User callbacks
                foreach($this->_callbacks as $field => $callbacks){
                    foreach($callbacks as $callback)
                    {
			$array->callback($field, array($this, $callback));
                    }
                }

		return $array;
	}
        
        function addInventory($postdata,$id)
        {
            $post = $this->validate_create($postdata);
            if($post->check())
            {
				
				$objInventory = ORM::factory('inventory',$id);
				$objInventory->product_type = $postdata['product_type'];
				$objInventory->product_id = $postdata['products'];
				$objInventory->manufacturer_id = $postdata['mfr'];
				$objInventory->vendor_id = $postdata['vendor'];
				$objInventory->product_qty = $postdata['tot_qty'];
				$objInventory->product_coast = $postdata['cost'];
				$objInventory->product_retail_price = $postdata['retail_price'];
				$objInventory->product_repair_price = $postdata['repair_price'];
				$objInventory->product_lowest_price = $postdata['lowest_price'];
				$objInventory->product_description = $postdata['description'];
				$objInventory->product_lowest_qty = $postdata['lowest_qty'];
				$objInventory->state_taxed = $postdata['states_tax'];
				$objInventory->product_exception_price = $postdata['exception_price'];
                                $objInventory->barcode_type = $postdata['barcode'];
				$last_inserted_id = $objInventory->save();
                                
                                //echo count($postdata['barcode_number']);
                                for($i=0;$i<count($postdata['barcode_number']);$i++)
                                {
                                    $objInventoryBarcode = ORM::factory('inventorybarcode');
                                    $objInventoryBarcode->inventory_id = $last_inserted_id;
                                    $objInventoryBarcode->barcode_no = $postdata['barcode_number'][$i];
                                    $objInventoryBarcode->save();
                                }
				//print_r($postdata);exit;
				if($id!='')
				{
					$msg = "Inventory Updated Sucessfully";
					$address_id = $postdata['address_id'];
				}
				else
				{
					$msg = "Inventory Added Sucessfully";
					$primary = 'Y';
				}
				
				Session::instance()->set('session_msg',$msg);
				Request::current()->redirect('inventory/list');
            }
            else
            {
                 //$_POST = array_intersect_key( $post->as_array(), $_POST);
                 $msg_errors = $post->errors('inventory');
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
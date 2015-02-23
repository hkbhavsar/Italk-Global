<?php
class Model_Customer extends ORM{

  protected $_table_name  = 'tbl_customer'; // default: accounts
  protected $_primary_key = 'cust_id';      // default: id
  public $errors = '';
  
  
        protected $_rules = array
	(
		'cust_email'                    => array
		(
			'not_empty'		=> NULL,
			'min_length'		=> array(4),
			'max_length'		=> array(127),
			'validate::email'	=> NULL,
		),
	);
 
	
	public function validate_create($postvalues) 
        {
            //// Initialise the validation library and setup some rules		
		$array = Validate::factory($postvalues)
                        ->rules('cust_email', $this->_rules['cust_email'])
                        ->filter('cust_email', 'trim');
              
                #Add Model_Auth_User callbacks
                foreach($this->_callbacks as $field => $callbacks){
                    foreach($callbacks as $callback)
                    {
			$array->callback($field, array($this, $callback));
                    }
                }

		return $array;
	}
        
        function createCustomer($postdata,$id)
        {
            $post = $this->validate_create($postdata);
			
			//print_r($postdata);exit;
			
            if($post->check())
            {
				
				$objCustomer = ORM::factory('customer',$id);
				$objCustomer->cust_company = $postdata['cust_company'];
				$objCustomer->first_name = $postdata['first_name'];
				$objCustomer->last_name = $postdata['last_name'];
				$objCustomer->cust_email = $postdata['cust_email'];
				$objCustomer->intial = $postdata['cust_intial'];
				$objCustomer->work_phone = $postdata['cust_work_phone'];
				$objCustomer->mobile_phone = $postdata['cust_mobile_phone'];
				$objCustomer->fax = $postdata['cust_fax'];
				$objCustomer->tax_id = $postdata['cust_taxid'];
				$objCustomer->terms = $postdata['cust_terms'];
				$objCustomer->cust_notes = $postdata['cust_notes'];
				$last_inserted_id = $objCustomer->save();
				
				//print_r($postdata);exit;
				if($id!='')
				{
					$msg = "Customer Updated Sucessfully";
					$address_id = $postdata['address_id'];
				}
				else
				{
					$msg = "Customer inserted Sucessfully";
					$primary = 'Y';
				}
				
				$objAddress = ORM::factory('address',$address_id);
				$objAddress->address_1 = $postdata['cust_address'];
				$objAddress->address_2 = $postdata['cust_address2'];
				$objAddress->city = $postdata['cust_city'];
				$objAddress->state = $postdata['cust_state'];
				$objAddress->zip = $postdata['cust_zip'];
				$objAddress->cust_id = $last_inserted_id;
				$objAddress->primary_address = 'Y';
				$objAddress->save();
				Session::instance()->set('session_msg',$msg);
				Request::current()->redirect('customer/list');
            }
            else
            {
                 //$_POST = array_intersect_key( $post->as_array(), $_POST);
                 $msg_errors = $post->errors('customer');
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
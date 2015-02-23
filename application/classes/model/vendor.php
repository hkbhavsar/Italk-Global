<?php
class Model_Vendor extends ORM{

  protected $_table_name  = 'tbl_vendor'; // default: accounts
  protected $_primary_key = 'vendor_id';      // default: id
  protected $_sorting = array('date_added' => 'DESC');
  public $errors = '';
  
  
        protected $_rules = array
	(
		'vendor_email'                    => array
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
                        ->rules('vendor_email', $this->_rules['vendor_email'])
                        ->filter('vendor_email', 'trim');
              
                #Add Model_Auth_User callbacks
                foreach($this->_callbacks as $field => $callbacks){
                    foreach($callbacks as $callback)
                    {
			$array->callback($field, array($this, $callback));
                    }
                }

		return $array;
	}
        
        function createVendor($postdata,$id)
        {
            $post = $this->validate_create($postdata);
			
			//print_r($postdata);exit;
			
            if($post->check())
            {
				$objVendor = ORM::factory('vendor',$id);
				$objVendor->first_name = $postdata['first_name'];
				$objVendor->last_name = $postdata['last_name'];
				$objVendor->vendor_email = $postdata['vendor_email'];
				$objVendor->work_phone = $postdata['work_phone'];
				$objVendor->mobile_phone = $postdata['mobile_phone'];
				$objVendor->vendor_notes = $postdata['vendor_notes'];
				$objVendor->vendor_address = $postdata['vendor_address'];
				$last_inserted_id = $objVendor->save();
				
				//print_r($postdata);exit;
				if($id!='')
				{
					$msg = "Vendor Updated Sucessfully";
					$address_id = $postdata['address_id'];
				}
				else
				{
					$msg = "Vendor inserted Sucessfully";
					$primary = 'Y';
				}
				
				Session::instance()->set('session_msg',$msg);
				Request::current()->redirect('vendor/list');
            }
            else
            {
                 //$_POST = array_intersect_key( $post->as_array(), $_POST);
                 $msg_errors = $post->errors('vendor');
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
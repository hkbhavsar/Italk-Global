<?php defined('SYSPATH') OR die('No Direct Script Access');

class Helper_Utils{
	
	 /**
     * 
     * Convert current cycle data
     * 
     * @return: string date
     * 
     */

	public static function currentcycle()
    {
            $today = strtolower(date('D'));
       		switch ($today){
       			case('sun'):
       				$days = "-3 days";
       				break;
       			case('mon'):
       				$days = "-4 days";
       				break;
       			case('tue'):
       				$days = "-5 days";
       				break;
       			case('wed'):
       				$days = "-6 days";
       				break;
       			case('thu'):
       				$days = "-0 days";
       				break;
       			case('fri'):
       				$days = "-1 days";
       				break;
       			case('sat'):
       				$days = "-2 days";
       				break;      				
       		}
            return $date = date('Y-m-d 00:00:00', strtotime($days));
    }
    
    public static function email_placeholders(){
    	$place_holders = array(
       			'variables',
	       		'money_coming_count',
				'prospect_count',
				'subject',
				'user_email',
				'user_fname',
				'user_lname',
				'user_phone1',
				'user_address1',
				'user_address2',
				'user_city',
				'user_state',
				'user_zip',
				'user_country',
				'prospect_email',
				'prospect_fname',
				'prospect_lname',
				'prospect_phone1',
				'prospect_address1',
				'prospect_address2',
				'prospect_city',
				'prospect_state',
				'prospect_zip',
				'prospect_country',
       			'from_email',
	    		'order_detail',
	    	    'vemma_order_id',
	       		'order_autoship',
	       		'order_tax',
	       		'order_shipping',
    			'login_name',
    			'password'
       		);
       		return $place_holders;
    }
    /* Paggingation dropdown functionality */
    function page_dropdown($current_page,$currenttab,$url='')
    {
        $page_array  = array(5,10,15,20);
        $dropdown ='<select name="pagedropdown" onchange="itemsperpage(this.value,\''.Kohana::$base_url.'\',\''.$currenttab.'\',\''.$url.'\')";>';
        foreach($page_array as $pagevalue)
        {
            $dropdown .='<option value="'.$pagevalue.'"'.($current_page==$pagevalue?"selected":'').'>'.$pagevalue.'</option>';
        }
        /*$dropdown .='<option value="5">5</option>';
        $dropdown .='<option value="10">10</option>';
        $dropdown .='<option value="15">15</option>';
        $dropdown .='<option value="20">20</option>';*/
        $dropdown .='</select>';
        return $dropdown;
    }
    public static function defaultitemperpage()
    {
        return 15;
    }
	
	public static function split_on($string, $num) 
	{
			$length = strlen($string);
			$output.= substr($string, 0, $num);
			$output.= '<br>'.substr($string, $num, $length );
			return $output;
	}
	
}
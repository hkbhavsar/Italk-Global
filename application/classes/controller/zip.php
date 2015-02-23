<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Zip extends Controller_Layout {
      
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
                        array('action' => 'add')), 301);
                                    
	}
        
        public function action_add()
	{
            $objCallcenter = ORM::factory('callcenter');
            
            $callcenterData = $objCallcenter->find_all()->as_array();
            
            if($_POST['txt_zip']!='')
            {
                $objZip = ORM::factory('zip');
                $check_data = $objZip->where('zipcode','=',$_POST['txt_zip'])->find_all();
                   
                
                $objZip->zipcode =$_POST['txt_zip'];
                $objZip->city = $_POST['txt_city'];
                $objZip->state =$_POST['state'];
                if(count($check_data)>0)
                {
                    $process_dup = 1;
                }
                else {
                    $objZip->save();
                    $process_done = 1;
                    $process_dup = 0;
                }
            }
            $state_array=array("AK"=>"Alaska","AL"=>"Alabama","AR"=>"Arkansas","AZ"=>"Arizona","CA"=>"California","CO"=>"Colorado","CT"=>"Connecticut","DC"=>"District Of Columbia","DE"=>"Delaware","FL"=>"Florida","GA"=>"Georgia","HI"=>"Hawaii","IA"=>"Iowa","ID"=>"Idaho","IL"=>"Illinois","IN"=>"Indiana","KS"=>"Kansas","KY"=>"Kentucky","LA"=>"Louisiana","MA"=>"Massachusetts","MD"=>"Maryland","ME"=>"Maine","MI"=>"Michigan","MN"=>"Minnesota","MO"=>"Missouri","MS"=>"Mississippi","MT"=>"Montana","NC"=>"North Carolina","ND"=>"North Dakota","NE"=>"Nebraska","NH"=>"New Hampshire","NJ"=>"New Jersey","NM"=>"New Mexico","NV"=>"Nevada","NY"=>"New York","OH"=>"Ohio","OK"=>"Oklahoma","OR"=>"Oregon","PA"=>"Pennsylvania","RI"=>"Rhode Island","SC"=>"South Carolina","SD"=>"South Dakota","TN"=>"Tennessee","TX"=>"Texas","UT"=>"Utah","VA"=>"Virginia","VT"=>"Vermont","WA"=>"Washington","WI"=>"Wisconsin","WV"=>"West Virginia","WY"=>"Wyoming"); 
	    $this->template->title = "Upload Leads For Agent";
	    $this->template->content = View::factory('zip/addzip')
                                    ->bind('state_array',$state_array)
                                    ->bind('process_done',$process_done)
                                    ->bind('process_dup',$process_dup)    
                                    ->bind('lead_uploaded',$lead_uploaded);
        }
   
} // End Welcome

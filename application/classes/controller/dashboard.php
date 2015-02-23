<?php defined('SYSPATH') or die('No direct script access.');

  class Controller_Dashboard extends Controller_Layout {

  	public function before(){
		 parent::before();
	     $this->template->set_filename('layout/admin');
	}

  	public function __construct(Request $request)
	{
            
            // Check Login or not
               if (Auth::instance()->logged_in('',$all_required=false) == 0) {
            
                 Request::current()->redirect('/auth/signin');
                }
            
		// Assign the request to the controller
    		parent::__construct($request);
	}

	
	public function action_index()
	{
            
            $obj_dashboard = new Model_Dashboard();
            $logged_in_userid = Auth::instance()->get_user()->id;
            $graphLeadsCount= $obj_dashboard->chart_data();
            
            $objLeads_payday = ORM::factory('paydaylead',array("agent_id" => $logged_in_userid));
            $today = date('Y-m-d');
            $paydayleadsData = $objLeads_payday->select()->where('agent_id','=',$logged_in_userid)->where('c_date','like',"%".$today."%")->find_all()->as_array();
            $paydayleadsData_reminder = $objLeads_payday->select()->where('agent_id','=',$logged_in_userid)->where('lead_reminder','like',"%".$today."%")->find_all()->as_array();
           //echo Database::instance()->last_query;
            //print_r($paydayleadsData);
            
            $objLeads_insurance = ORM::factory('insurance',array("agent_id" => $logged_in_userid));
           
            $insurancesLeadData = $objLeads_insurance->select()->where('agent_id','=',$logged_in_userid)->where('c_date','like',"%".$today."%")->find_all()->as_array();
            
            
            $this->createGraph();
           
		$this->template->title = "Dashboard";
		$this->template->content = View::factory('dashboard/index')
  			->set('dash_datas', $dash_datas)
                        ->set('paydayleadsData',  $paydayleadsData)
                         ->set('money_coming', $money_coming)
                        ->set('paydayleadsData_reminder', $paydayleadsData_reminder)
                        ->set('insurancesLeadData', $insurancesLeadData)
                        ->set('newest_members_lists', $newest_members_lists);
               
                        
	}
	public function action_indexr()
	{
            
            $obj_dashboard = new Model_Dashboard();
            $logged_in_userid = Auth::instance()->get_user()->id;
  

		$this->template->title = "Dashboard";
		$this->template->content = View::factory('dashboard/index_real')
  			->set('dash_datas', $dash_datas)
                        ->set('money_coming', $money_coming)
                        ->set('newest_members_lists', $newest_members_lists);
                        
	}
        
        public function createGraph()
        {
            $NewcarData = ORM::factory('newcar')->count_all();
            $AutoData = ORM::factory('leadauto')->count_all();
            $NewpaydayData = ORM::factory('paydaylead')->count_all();
            $paydayData = ORM::factory('payday')->count_all();
            
            $AutoData ='30';// Delete this once online
            
           
            $file_string='{
                    "graphset":[
                            {
                                "type":"pie",
                                "alpha":1,
                                "background-color":"#2A2325",
                                "title":{
                                    "text":"Total Leads",
                                    "font-family":"helvetica",
                                    "font-size":"20px",
                                    "font-weight":"bold",
                                    "background-color":"#2A2325",
                                    "margin-top":"15px",
                                    "margin-left":"45px",
                                    "margin-bottom":"10px",
                                    "text-align":"left"
                                },
                                "legend":{
                                    "layout":"2x2",
                                    "position":"95% 0%",
                                    "width":"175px",
                                    "height":"45px",
                                    "visible":true,
                                    "border-radius":"5px",
                                    "font-family":"helvetica",
                                    "font-size":"10px",
                                    "background-color":"#2A2325",
                                    "border-width":"1px",
                                    "border-color":"#808080",
                                    "item":{
                                        "font-color":"#fff",
                                        "marker-style":"circle",
                                        "padding":"-2 2",
                                        "border-width":"0px"
                                    }
                                },
                                "tooltip":{
                                    "visible":true,
                                    "font-color":"#000000"
                                },
                                "plot":{
                                    "offset":"5",
                                    "tooltip-text":"%v  %t",
                                    "detach":true,
                                    "border-color":"#2A2325",
                                    "value-box":{
                                        "placement":"in",
                                        "connected":false,
                                        "font-color":"#000000"
                                    }
                                },
                                "series":[
                                    {
                                        "values":['.$AutoData.'],
                                        "background-color":"#8DD62E",
                                        "text":"Auto"
                                    },
                                    {
                                        "values":['.$paydayData.'],
                                        "background-color":"#FF006F",
                                        "text":"Payday"
                                    },
                                    {
                                        "values":['.$NewcarData.'],
                                        "background-color":"#00D3E6",
                                        "text":"NewCar"
                                    },
                                    {
                                        "values":['.$NewpaydayData.'],
                                        "background-color":"#FFD540",
                                        "text":"New Payday"
                                    }
                                ]
                            }
                        ]
                        }';
            $myFile_ping_response = "chart/Leads_Client.txt";
            $fh = fopen($myFile_ping_response, 'w') or die("can't open file");
            fwrite($fh, $file_string);
            fclose($fh);
        }
} // End Dashboard

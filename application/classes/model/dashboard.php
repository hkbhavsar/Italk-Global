<?php
class Model_Dashboard extends Model{
    
   public function chart_data()
    {
         $countLeadData = DB::select('lead_types', 'count("id") as cnt')
                     ->from('tbl_leads')
                     ->group_by('lead_types')->execute()->as_array();
        //print_r($countLeadData);
        
        $json = '{
                    "graphset":[
                        {
                            "type":"pie",
                            "alpha":1,
                            "background-color":"#2A2325",
                            "title":{
                                "text":"Lead Agent Graph",
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
                                "tooltip-text":"%v cars propelled<br/>by %t<br/> Percentage: %npv %",
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
                                    "values":['.$countLeadData[0]['cnt'].'],
                                    "background-color":"#8DD62E",
                                    "text":"'.$countLeadData[0]['lead_types'].'"
                                },
                                {
                                   "values":['.$countLeadData[1]['cnt'].'],
                                    "background-color":"#FF006F",
                                    "text":"'.$countLeadData[1]['lead_types'].'"
                                },
                                {
                                    "values":[37],
                                    "background-color":"#00D3E6",
                                    "text":"Gasoline"
                                },
                                {
                                    "values":[13],
                                    "background-color":"#FFD540",
                                    "text":"Diesel"
                                }
                            ]
                        }
                    ]
                    }';
                //$json = str_replace(array("\r","\n"), "", $json);
                $myFile = $_SERVER['DOCUMENT_ROOT'].Url::base()."chart/pie_dark.txt";
                //$myFile = "pie_dark.txt";
                $fh = fopen($myFile, 'w') or die("can't open file");
                fwrite($fh, $json);
                fclose($fh);    
     }
    
    public function find_date()
    {
        $today = date('D');
        switch ($today){
                case('Sun'):
                $days = "-3 day";
                break;
                case('Mon'):
                $days = "-4 day";
                break;
                case('Tue'):
                $days = "-5 day";
                break;
                case('Wed'):
                $days = "-6 day";
                break;
                case('Thu'):
                $days = "-7 day";
                break;
                case('Fri'):
                $days = "-1 day";
                break;
                case('Sat'):
                $days = "-2 day";
                break;
         }

        $converted = strtotime($days, strtotime(date('Y-m-d')));
        $startDate = date('Y-m-d', $converted);
        return $startDate;
    }
    public function get_dashboarddata($logged_in_userid)
    {
            $startDate= $this->find_date();
            $todayDate = date('Y-m-d H:i:s');
        
            
        $tot_visitor = DB::select(DB::expr('count(id) as tot_visit'))
                        ->from('visits')
                        ->where('user_id','=',$logged_in_userid)
                        ->and_where_open()
                        ->or_where('visit_date','BETWEEN',array($startDate.' 00:00:00',$todayDate))
                        ->and_where_close()
                        ->group_by('prospect_id')
                        ->execute()
                        ->as_array();
        
        $tot_visitor_morethan_one = DB::select(DB::expr('count(id) as tot_visit_moreone'))
                                    ->from('visits')
                                    ->where('user_id','=',$logged_in_userid)
                                    ->and_where_open()
                                    ->or_where('visit_date','BETWEEN',array($startDate.' 00:00:00',$todayDate))
                                    ->and_where_close()
                                    ->group_by('prospect_id')
                                    ->having(DB::expr('count(total_visit)'),'>',1)
                                    ->execute()
                                    ->as_array();
        
        $total_prospectes =  DB::select(DB::expr('count(id) as total_prospects'))
                                ->from('prospects')
                                ->where('user_id','=',$logged_in_userid)
                                ->and_where_open()
                                ->or_where('created_date','BETWEEN',array($startDate.' 00:00:00',$todayDate))
                                ->and_where_close()
                                ->execute()
                                ->as_array();
        
        $total_members =  DB::select(DB::expr('count(id) as total_members'))
                            ->from('users')
                            ->where('parent_id','=',$logged_in_userid)
                            ->and_where_open()
                            ->or_where('created_date','BETWEEN',array($startDate.' 00:00:00',$todayDate))
                            ->and_where_close()
                            ->execute()
                            ->as_array();
        
        /*$leftside_prospectes =  DB::select(DB::expr('count(id) as leftprospects'))
                                ->from('prospects')
                                ->where('user_id','=',$logged_in_userid)
                                ->where('binary_side','=','left')
                                ->execute()
                                ->as_array();
        
        $rightside_prospectes = DB::select(DB::expr('count(id) as rightprospects'))->from('prospects')->where('user_id','=',$logged_in_userid)->where('binary_side','=','right')->execute()->as_array();

        $leftside_members =  DB::select(DB::expr('count(id) as leftmembers'))->from('users')->where('parent_id','=',$logged_in_userid)->where('binary_side','=','left')->execute()->as_array();
        $rightside_members = DB::select(DB::expr('count(id) as rightmembers'))->from('users')->where('parent_id','=',$logged_in_userid)->where('binary_side','=','right')->execute()->as_array();*/
        
        $datas['tot_visitor'] = count($tot_visitor);
        $datas['tot_visitor_more_than_one'] = count($tot_visitor_morethan_one);
        $datas['total_prospectes'] = $total_prospectes[0]['total_prospects'];
        $datas['total_members'] = $total_members[0]['total_members'];
        return $datas;
    }
    
    public function chackpassword()
    {
        $pass_data = DB::select('training_lessons.*')
		->from('training_lessons')
		->where('lessons', '=', $_GET['step'])
		->execute()->as_array();
        $password = $pass_data[0]['password'];
        return $password;
    }

    public function getAllNewestMembers()
    {
        $prospects = ORM::factory('prospects');
        $newest_member_lists = $prospects->select('prospects.*','users.parent_id');
        $newest_member_lists = $newest_member_lists->join('users','right');
        $newest_member_lists = $newest_member_lists->on('prospects.id', '=', 'users.prospect_id');
        $newest_member_lists = $newest_member_lists->where('users.created_date','>=', DB::expr("DATE_SUB(CURDATE( ) , INTERVAL 7 DAY )"));
        $newest_member_lists = $newest_member_lists->where('users.created_date','<=', DB::expr('CURDATE( )'));
        $newest_member_lists = $newest_member_lists->order_by('users.created_date');
        $newest_member_lists = $newest_member_lists->find_all();
        $newest_member_lists = $newest_member_lists->as_array();
        
        return $newest_member_lists;
    }
}
<?php

class Model_Prospects extends ORM {
     protected $_table_name  = 'prospects'; // default: accounts
     protected $_primary_key = 'id';      // default: id
     protected $_sorting = array('created_date' => 'ASC');

    protected $_rules = array(
        'first_name'      => array('not_empty' => null)
    );

    protected $_filters = array(TRUE => array('trim' => NULL));

    public function insert_visits($prospect_id)
	{
              if(isset($prospect_id) && $prospect_id!='')
              {
                  $prospects = ORM::factory('prospects',$prospect_id);
                  $getvisitor_data =  DB::select()->from('visits')->where('prospect_id','=',$prospect_id)->execute()->as_array();
                  $visit_data = array(
                                                'prospect_id'	=> $prospect_id,
                                                'visit_date'	=> DB::expr('now()'),
                                                'total_visit'   => DB::expr('total_visit+1'),
                                                'user_id'       =>$prospects->user_id
                                          );

                    $diff = DB::select(DB::expr('TIME_FORMAT( TIMEDIFF( NOW( ) , visit_date ) , \'%H\' ) AS diff'))
                                            ->where('prospect_id','=',$prospect_id)
                                            ->from('visits')
                                            ->execute()
                                            ->as_array();

                       if(count($getvisitor_data)==0)
                       { $page = (bool) DB::insert('visits', array_keys($visit_data))
                                    ->values($visit_data)
                                    ->execute();
                         $prospects->last_visit_date = date("Y-m-d H:i:s");
                  		 $prospects->visit_count = $prospects->visit_count + 1;
                 		 $prospects->save();
                       }

                       if($diff[0]['diff']>0 && $getvisitor_data){
                            $page = (bool) DB::insert('visits', array_keys($visit_data))
                                    ->values($visit_data)
                                    ->execute();
                     		$prospects->last_visit_date = date("Y-m-d H:i:s");
                  		 	$prospects->visit_count = $prospects->visit_count + 1;
                 		 	$prospects->save();

                      }
              }
        }
      public function auto_search()
         {

            $q = strtolower($_GET["q"]);
            if (!$q) return;
            $results =  DB::select('username','id')->from('users')->execute()->as_array();
            for($i=0;$i<count($results);$i++)
            {
                $name = $results[$i]['username'];
                if (strpos(strtolower($name), $q) !== false) {
                echo "$name<div style='display:none'>,".$results[$i]['id']."</div>\n";
                };
            };exit;
         }

     function get_moneycoming($user_id=null)
       {
       	/**
       	 * Money coming is defined as a prospect who has been added in the current cycle
       	 * who has a member in thier downline
       	 *
       	 */

       		$current_cycle_date = Helper_Utils::currentcycle();
       		$prospects = ORM::factory('prospects');
            $users = ORM::factory('Users');

            if ($user_id == null){
               $user_id = Auth::instance()->get_user()->id;
            }



            //Retrieve users who have been added this cycle who are in success line
            $new_users = $users->select('prospect_id');
            $new_users = $new_users->join('prospects');
            $new_users = $new_users->on('users.prospect_id','=','prospects.id');
            $new_users = $new_users->where('prospects.user_id','=',$user_id);
            $new_users = $new_users->where('users.created_date','>',$current_cycle_date);
            $new_users = $new_users->where('prospects.user_id','=',$user_id);
            $new_users = $new_users->find_all();
            $new_users = $new_users->as_array();

            /**
             * get the newest prospect in the downline who has converted to a user
             * because every prospect in upline has money coming.
             */

            $high_id=0;
			foreach($new_users as $nu){
				if ($nu->prospect_id > $high_id){
					$high_id = $nu_prospect_id;
				}
			}

			$money_list = array();
			if ($high_id > 0){
				$money_list = $prospects->select('*')
							->where('user_id', '=', $user_id)
							->where('id', '<', $high_id)
							->where('is_user', '=', 'no')
							->find_all()
                            ->as_array();
			}
            return $money_list;
       }

       // filter search for user
       function searchForUser(){

            $logged_in_userid = Auth::instance()->get_user()->id;
            $user_role = Session::instance()->get('user_role_id');

            $prospects_list = $this->select('prospects.*','country.country_name');

            if($user_role==1)
                $prospects_list= $prospects_list->and_where('prospects.user_id', '=', $logged_in_userid);

            // filter name search start
            if($_POST['filter_name']!=''){
                $prospects_list = $prospects_list->and_where_open();
                $prospects_list= $prospects_list->and_where('prospects.first_name', 'like', '%'.trim($_POST['filter_name']).'%');
                $prospects_list= $prospects_list->or_where('prospects.last_name', 'like', '%'.trim($_POST['filter_name']).'%');
                $prospects_list = $prospects_list->and_where_close();
            }
            // filter name search end

            // filter email search start
            if($_POST['filter_email']!='')
                $prospects_list= $prospects_list->where('prospects.email', 'like', '%'.trim($_POST['filter_email']).'%');
            // filter email search end

            // filter phone search start
            if($_POST['filter_phone']!='')
                $prospects_list= $prospects_list->where('prospects.phone', 'like', '%'.trim($_POST['filter_phone']).'%');
            // filter phone search end

            // filter location search start
            if($_POST['filter_location']!='')
                $prospects_list= $prospects_list->where('prospects.country_name', 'like', '%'.$_POST['filter_location'].'%');
            // filter location search end

            // filter binary search start
            if($_POST['filter_binary']!='')
                $prospects_list= $prospects_list->where('prospects.binary_side', '=', $_POST['filter_binary']);
            // filter binary search end


            $filterMemberType = $_POST['filter_member_type'];
            // filter member type search start
            switch($filterMemberType){
                case 'Pre-Enrollee':
                            //$prospects_list = $prospects_list->join('users','left');
                            $prospects_list = $prospects_list->join('users');
                            $prospects_list = $prospects_list->on('prospects.id', '=', 'users.prospect_id');
                            if($user_role==1)
                                $prospects_list = $prospects_list->where('users.prospect_id','=',$logged_in_userid);
                            else
                                $prospects_list = $prospects_list->where('users.prospect_id','is',NULL);

                            break;

                case 'Single-Returnee':
                            $prospects_list = $prospects_list->join('users','right');
                            $prospects_list = $prospects_list->on('prospects.id', '=', 'users.prospect_id');
                            $prospects_list = $prospects_list->join('visits');
                            $prospects_list = $prospects_list->on('visits.prospect_id', '=', 'prospects.id');
                            $prospects_list = $prospects_list->where('visits.total_visit','!=', 0);
                            $prospects_list = $prospects_list->group_by('visits.prospect_id');
                            $prospects_list = $prospects_list->having(DB::expr('count(total_visit)'),'=',1);
                            //$prospects_list = $prospects_list->order_by('visits.id');
                            break;

                case 'Multiple-Returnee':
                            $prospects_list = $prospects_list->join('users','right');
                            $prospects_list = $prospects_list->on('prospects.id', '=', 'users.prospect_id');
                            $prospects_list = $prospects_list->join('visits');
                            $prospects_list = $prospects_list->on('visits.prospect_id', '=', 'prospects.id');
                            $prospects_list = $prospects_list->where('visits.total_visit','!=', 0);
                            $prospects_list = $prospects_list->group_by('visits.prospect_id');
                            $prospects_list = $prospects_list->having(DB::expr('count(total_visit)'),'>',1);
                            //$prospects_list = $prospects_list->order_by('visits.id');
                            break;

                case 'Money Coming':
                            // get date of money coming starts
                            $today = strtolower(date('D'));
                            switch ($today){
                                    case('sun'):     $days = "-3 days";break;
                                    case('mon'):    $days = "-4 days";break;
                                    case('tue'):      $days = "-5 days";break;
                                    case('wed'):     $days = "-6 days";break;
                                    case('thurs'):   $days = "-0 days";break;
                                    case('fri'):        $days = "-1 days";break;
                                    case('sat'):      $days = "-2 days";break;
                            }
                            $moneyComingDate = date('Y-m-d 00:00:00', strtotime($days));
                            // get date of money coming ends

                            $prospects_list = $prospects_list->join('users','right');
                            $prospects_list = $prospects_list->on('prospects.id', '=', 'users.prospect_id');
                            $prospects_list = $prospects_list->where('users.parent_id','!=','""');
                            $prospects_list = $prospects_list->where('users.parent_id','is not',NULL);
                            $prospects_list = $prospects_list->where('users.created_date','>',$moneyComingDate);
                            //$prospects_list = $prospects_list->order_by('users.id');
                            break;

                case 'New Member':
                            $prospects_list = $prospects_list->join('users','right');
                            $prospects_list = $prospects_list->on('prospects.id', '=', 'users.prospect_id');
                            $prospects_list = $prospects_list->where('users.created_date','>=', DB::expr("DATE_SUB(CURDATE( ) , INTERVAL 7 DAY )"));
                            $prospects_list = $prospects_list->where('users.created_date','<=', DB::expr('CURDATE( )'));
                            //$prospects_list = $prospects_list->order_by('users.id');
                            break;

                case 'All Members':
                            $prospects_list = $prospects_list->join('users','right');
                            $prospects_list = $prospects_list->on('prospects.id', '=', 'users.prospect_id');
                            //$prospects_list = $prospects_list->order_by('users.id');
                            break;

                case 'Sponsors':
                            break;
                case 'Enroller':
                            $prospects_list = $prospects_list->join('users','right');
                            $prospects_list = $prospects_list->on('prospects.id', '=', 'users.prospect_id');

                            $prospects_list = $prospects_list->join(DB::expr('users as u'));
                            $prospects_list = $prospects_list->on('users.id', '=', 'u.parent_id');
                            //$prospects_list = $prospects_list->order_by('users.id');
                            break;
            }
            // filter member type search end

            // filter whos status search start
            if($_POST['filter_status'] != "" && $_POST['status_operator'] == 'not'){
                $prospects_list = $prospects_list->where('prospects.status_id','not in',DB::expr('('.$_POST['filter_status'].')'));
                $prospects_list = $prospects_list->where('prospects.status_id','is not',NULL);
            }
            if($_POST['filter_status'] != "" && $_POST['status_operator'] == 'is'){
                $prospects_list = $prospects_list->where('prospects.status_id','in',DB::expr('('.$_POST['filter_status'].')'));
            }
            // filter whos status search end

            // check if lead type exists starts
            if($_POST['filter_lead_type'] !="" ){
                $prospects_list = $prospects_list->where('prospects.lead_type_id','in',DB::expr('('.$_POST['filter_lead_type'].')'));
            }
            // check if lead type exists ends

            $prospects_list =  $prospects_list->join('country','left');
            $prospects_list =  $prospects_list->on('prospects.country_id', '=', 'country.country_id');

            $prospects_list = $prospects_list->join('prospect_address','left');
            $prospects_list = $prospects_list->on('prospects.prospect_address_id','=','prospect_address.id');

            // filter zip search start
            if($_POST['filter_zip']!=''){
                $prospects_list = $prospects_list->where('prospect_address.postalcode', '=', $_POST['filter_zip']);
            }
            // filter zip search end

            // filter state search start
            if($_POST['filter_state']!=''){
                $prospects_list = $prospects_list->where('prospect_address.statecode', '=', $_POST['filter_state']);
            }
            // filter state search end

            // filter pre enrollee date search start
            if($_POST['from']!='')
                $prospects_list= $prospects_list->where('created_date', '>=', ''.date('Y-m-d',strtotime($_POST['from'])).'');

            if($_POST['to']!='')
               $prospects_list= $prospects_list->where('created_date', '<=', ''.date('Y-m-d',strtotime($_POST['to'])).'');
            // filter pre enrollee date search end

            // search contact start
            if($_POST['filter_contacted_from']!='' || $_POST['filter_contacted_to']!=''){
                $prospects_list = $prospects_list->join('campaigns','right');
                $prospects_list = $prospects_list->on('prospects.id', '=', 'campaigns.prospect_id');
            }

            if($_POST['filter_contacted_from']!='')
                $prospects_list = $prospects_list->where('prospects.created_date', '>=', ''.date('Y-m-d',strtotime($_POST['filter_contacted_from'])).'');
            if($_POST['filter_contacted_to']!='')
               $prospects_list = $prospects_list->where('prospects.created_date', '<=', ''.date('Y-m-d',strtotime($_POST['filter_contacted_to'])).'');
            // search contact end

            // search visitors start
            if($_POST['filter_date_visited_from']!='' || $_POST['filter_date_visited_to']!=''){
                $prospects_list = $prospects_list->join('visits','right');
                $prospects_list = $prospects_list->on('prospects.id', '=', 'visits.prospect_id');
            }

            if($_POST['filter_date_visited_from']!='')
                $prospects_list = $prospects_list->where('visits.visit_date', '>=', ''.date('Y-m-d',strtotime($_POST['filter_date_visited_from'])).'');
            if($_POST['filter_date_visited_to']!='')
               $prospects_list = $prospects_list->where('visits.visit_date', '<=', ''.date('Y-m-d',strtotime($_POST['filter_date_visited_to'])).'');
            // search visitors end

            // search date convert to member start
            if(($_POST['filter_date_convert_member_from'] != '' || $_POST['filter_date_convert_member_to'] != '') && $filterMemberType == ""){
                    $prospects_list = $prospects_list->join('users','right');
                    $prospects_list = $prospects_list->on('prospects.id', '=', 'users.prospect_id');
            }

            if($_POST['filter_date_convert_member_from']!='')
                $prospects_list = $prospects_list->where('users.created_date', '>=', ''.date('Y-m-d',strtotime($_POST['filter_date_convert_member_from'])).'');
            if($_POST['filter_date_convert_member_to']!='')
               $prospects_list = $prospects_list->where('users.created_date', '<=', ''.date('Y-m-d',strtotime($_POST['filter_date_convert_member_to'])).'');
            // search date convert to member end

            // order by start
            switch($filterMemberType){
                case 'Pre-Enrollee':
                        $prospects_list = $prospects_list->order_by('prospects.id');
                        break;

                case 'Single-Returnee':
                case 'Multiple-Returnee':
                        $prospects_list = $prospects_list->order_by('visits.id');
                        break;

                case 'Money Coming':
                case 'New Member':
                case 'All Members':
                case 'Sponsors':
                case 'Enroller':
                        $prospects_list = $prospects_list->group_by('prospects.id');
                        $prospects_list = $prospects_list->order_by('users.id');
                        break;
            }
            // order by end

            $prospects_list =  $prospects_list->find_all();
            $prospects_list =  $prospects_list->as_array();

            return $prospects_list;
       }

       //get visitors list
       function getVisitors($startDate,$todayDate){

            $logged_in_userid = Auth::instance()->get_user()->id;
            $prospects = ORM::factory('prospects');

            if(isset($_GET['tab']) && $_GET['tab']=='visitmore')
            {
                $return_data = $this->GetVisitMore($startDate,$todayDate);
            }

            else
            {

                $visitor_list = $prospects->select('prospects.*','country.country_name','visits.visit_date');
                $visitor_list = $visitor_list->where('prospects.user_id', '=', $logged_in_userid);
                if(isset($_GET['tab']) && strlen($_GET['tab']) > 0 && ($_GET['tab'] == 'visit' || $_GET['tab'] == 'visitmore'))
                {
                     $visitor_list = $visitor_list->and_where_open();
                     $visitor_list = $visitor_list->or_where('visit_date','BETWEEN',array($startDate.' 00:00:00',$todayDate));
                     $visitor_list = $visitor_list->and_where_close();
                }

                $visitor_list = $visitor_list->join('country','left');
                $visitor_list = $visitor_list->on('prospects.country_id', '=', 'country.country_id');
                $visitor_list = $visitor_list->join('visits','right');
                $visitor_list = $visitor_list->on('prospects.id', '=', 'visits.prospect_id');

                /*if($_POST['filter_date_visited_from']!='')
                    $visitor_list = $visitor_list->where('visits.visit_date', '>=', ''.date('Y-m-d',strtotime($_POST['filter_date_visited_from'])).'');
                if($_POST['filter_date_visited_to']!='')
                   $visitor_list = $visitor_list->where('visits.visit_date', '<=', ''.date('Y-m-d',strtotime($_POST['filter_date_visited_to'])).'');*/

                $visitor_list = $visitor_list->group_by('prospects.id');
                $visitor_list = $visitor_list->find_all();
                $visitor_list = $visitor_list->as_array();

                $count_visitors_list = count($visitor_list);

              // Create an instance of Pagination class and set values
                /*$pagination_visitors = Pagination::factory(array(
                        'total_items'    => $count_visitors_list,
                        'items_per_page' => 10,
                ));
                */
              if(isset($_GET['itemperpage']))
              {
                 $pagination_visitors = Pagination::factory(array(
                      'total_items'    => $count_visitors_list,
                      'items_per_page' => $_GET['itemperpage'],

              ));
                  $visitorcurrent_page = $_GET['itemperpage'];
              }else{
                  $visitorcurrent_page = helper_utils::defaultitemperpage();
                  $pagination_visitors = Pagination::factory(array(
                      'total_items'    => $count_visitors_list,
                      'items_per_page' => $visitorcurrent_page,
                  ));
              }

              $visitor_item = helper_utils::page_dropdown($visitorcurrent_page,4);


                $visitor_list = $prospects->select('prospects.*','country.country_name','visits.visit_date');
                $visitor_list = $visitor_list->where('prospects.user_id', '=', $logged_in_userid);
                if(isset($_GET['tab']) && $_GET['tab']=='visitmore')
                    $visitor_list = $visitor_list->where('visits.total_visit', '>', 1);

                if(isset($_GET['tab']) && strlen($_GET['tab']) > 0 && ($_GET['tab'] == 'visit' || $_GET['tab'] == 'visitmore'))
                {
                     $visitor_list = $visitor_list->and_where_open();
                     $visitor_list = $visitor_list->or_where('visit_date','BETWEEN',array($startDate.' 00:00:00',$todayDate));
                     $visitor_list = $visitor_list->and_where_close();
                }

                $visitor_list = $visitor_list->join('country','left');
                $visitor_list = $visitor_list->on('prospects.country_id', '=', 'country.country_id');
                $visitor_list = $visitor_list->join('visits','right');

                /*if($_POST['filter_date_visited_from']!='')
                    $visitor_list = $visitor_list->where('visits.visit_date', '>=', ''.date('Y-m-d',strtotime($_POST['filter_date_visited_from'])).'');
                if($_POST['filter_date_visited_to']!='')
                   $visitor_list = $visitor_list->where('visits.visit_date', '<=', ''.date('Y-m-d',strtotime($_POST['filter_date_visited_to'])).'');*/

                $visitor_list = $visitor_list->on('prospects.id', '=', 'visits.prospect_id');
                $visitor_list = $visitor_list->group_by('prospects.id');
                $visitor_list = $visitor_list->limit($pagination_visitors->items_per_page);
                $visitor_list = $visitor_list->offset($pagination_visitors->offset);
                if($_GET['order'] && $_GET['ordertab'] == '4')
                {
                  $order = $_GET['order'];
                }else{
                    $order = 'created_date';
                }

                if($_GET['order'] == 'visit_date' && $_GET['ordertab'] == '4')
                {
                    $table_alias = 'visits';
                }else{
                    $table_alias = 'prospects';
                }

                if($_GET['orderby']) $orderby = $_GET['orderby']; else $orderby = 'DESC';

                if($_GET['order'] && $_GET['ordertab'] == '4')
                {
                    $visitor_list = $visitor_list->order_by($table_alias.'.'.$order, $orderby);
                }

                $visitor_list = $visitor_list->find_all();

                $visitor_list = $visitor_list->as_array();

                $page_links_pagging_visitors = $pagination_visitors->render();

                $return_data['visitor_list'] = $visitor_list;
                $return_data['count_visitors_list'] = $count_visitors_list;
                $return_data['page_links_pagging_visitors'] = $page_links_pagging_visitors;
                $return_data['visitorcurrent_page'] = $visitorcurrent_page;
                $return_data['visitor_item'] = $visitor_item;
            }

            return $return_data;
       }

       //get visitors list
       function GetVisitMore($startDate,$todayDate){

                $logged_in_userid = Auth::instance()->get_user()->id;
                $visits = ORM::factory('visits');

                $visitor_list = $visits->select('visits.*','prospects.*',DB::expr('count(visits.id) as tot_visit'),'country.country_name');
                $visitor_list = $visitor_list->join('prospects','right');
                $visitor_list = $visitor_list->on('prospects.id', '=', 'visits.prospect_id');
                $visitor_list = $visitor_list->join('country','left');
                $visitor_list = $visitor_list->on('prospects.country_id', '=', 'country.country_id');
                $visitor_list = $visitor_list->where('visits.user_id', '=', $logged_in_userid);

                $visitor_list = $visitor_list->and_where_open();
                $visitor_list = $visitor_list->or_where('visit_date','BETWEEN',array($startDate.' 00:00:00',$todayDate));
                $visitor_list = $visitor_list->and_where_close();
                $visitor_list = $visitor_list->group_by('prospect_id');
                $visitor_list = $visitor_list->having(DB::expr('count(total_visit)'),'>',1);

                $visitor_list = $visitor_list->find_all();
                $visitor_list = $visitor_list->as_array();

                $count_visitors_list = count($visitor_list);

              // Create an instance of Pagination class and set values
                $pagination_visitors = Pagination::factory(array(
                        'total_items'    => $count_visitors_list,
                        'items_per_page' => 10,
                ));


                $visitor_list = $visits->select('visits.*','prospects.*',DB::expr('count(visits.id) as tot_visit'),'country.country_name');
                $visitor_list = $visitor_list->join('prospects','right');
                $visitor_list = $visitor_list->on('prospects.id', '=', 'visits.prospect_id');
                $visitor_list = $visitor_list->join('country','left');
                $visitor_list = $visitor_list->on('prospects.country_id', '=', 'country.country_id');
                $visitor_list = $visitor_list->where('visits.user_id', '=', $logged_in_userid);

                $visitor_list = $visitor_list->and_where_open();
                $visitor_list = $visitor_list->or_where('visit_date','BETWEEN',array($startDate.' 00:00:00',$todayDate));
                $visitor_list = $visitor_list->and_where_close();
                $visitor_list = $visitor_list->group_by('prospect_id');
                $visitor_list = $visitor_list->having(DB::expr('count(total_visit)'),'>',1);
                $visitor_list = $visitor_list->limit($pagination_visitors->items_per_page);
                $visitor_list = $visitor_list->offset($pagination_visitors->offset);
                $visitor_list = $visitor_list->find_all();
                $visitor_list = $visitor_list->as_array();


                $page_links_pagging_visitors = $pagination_visitors->render();

                $return_data['visitor_list'] = $visitor_list;
                $return_data['count_visitors_list'] = $count_visitors_list;
                $return_data['page_links_pagging_visitors'] = $page_links_pagging_visitors;

                return $return_data;
       }


       //get new prospects list
       function getNewProspects(){
            $logged_in_userid = Auth::instance()->get_user()->id;
            $prospects = ORM::factory('prospects');

            $newest_list = $prospects->select('prospects.*','country.country_name')
                                      ->where('prospects.user_id', '=', $logged_in_userid)
                                      ->where('created_date', '>=',new Database_Expression('DATE_SUB( CURDATE( ) , INTERVAL 7 DAY )'))
                                      ->where('prospects.is_user', '=', 'no')
                                      ->join('country','left')
                                      ->on('prospects.country_id', '=', 'country.country_id')
                                      ->find_all()
                                      ->as_array();
            $count_newest_list = count($newest_list);

          // Create an instance of Pagination class and set values
            /*$pagination_newest_list = Pagination::factory(array(
                    'total_items'    => $count_newest_list,
                    'items_per_page' => 10,
            ));
            */
            if(isset($_GET['itemperpage']))
              {
                 $pagination_newest_list = Pagination::factory(array(
                      'total_items'    => $count_newest_list,
                      'items_per_page' => $_GET['itemperpage'],

              ));
                  $newprospectcurrent_page = $_GET['itemperpage'];
              }else{
                  $newprospectcurrent_page = helper_utils::defaultitemperpage();
                  $pagination_newest_list = Pagination::factory(array(
                      'total_items'    => $count_newest_list,
                      'items_per_page' => $visitorcurrent_page,
                  ));
              }

              $new_prospect_item = helper_utils::page_dropdown($newprospectcurrent_page,6);


            if($_GET['order'] && $_GET['ordertab'] == 6)
            {
              $order = $_GET['order'];
            }else{
                $order = 'created_date';
            }


            if($_GET['orderby']) $orderby = $_GET['orderby']; else $orderby = 'DESC';

             $newest_list = $prospects->select('prospects.*','country.country_name')
                                      ->where('prospects.user_id', '=', $logged_in_userid)
                                      ->where('created_date', '>=',new Database_Expression('DATE_SUB( CURDATE( ) , INTERVAL 7 DAY )'))
                                      ->where('prospects.is_user', '=', 'no')
                                      ->join('country','left')
                                      ->on('prospects.country_id', '=', 'country.country_id')
                                      ->limit($pagination_newest_list->items_per_page)
                                      ->offset($pagination_newest_list->offset)
                                      ->order_by('prospects.'.$order, $orderby)
                                      ->find_all()
                                      ->as_array();

             $page_links_pagging_visitors_new = $pagination_newest_list->render();

            $return_data_new['newest_list'] = $newest_list;
            $return_data_new['count_newest_list'] = $count_newest_list;
            $return_data_new['page_links_pagging_visitors'] = $page_links_pagging_visitors_new;

            $return_data_new['newprospectcurrent_page'] = $newprospectcurrent_page;
            $return_data_new['new_prospect_item'] = $new_prospect_item;

            return $return_data_new;
       }

       //get recent contact list
       function getRecentContact(){
            $logged_in_userid = Auth::instance()->get_user()->id;
            $prospects = ORM::factory('prospects');

            $contact_list = $prospects->select('prospects.id','prospects.first_name','prospects.last_name','prospects.email',
                                                'prospects.phone','prospects.binary_side',
                                                'country.country_name','campaigns.created_date')
                                    ->where('prospects.user_id', '=', $logged_in_userid)
                                    ->join('country','left')
                                    ->on('prospects.country_id', '=', 'country.country_id')
                                    ->join('campaigns','right')
                                    ->on('prospects.id', '=', 'campaigns.prospect_id');

            /*if($_POST['filter_contacted_from']!='')
                $contact_list = $contact_list->where('prospects.created_date', '>=', ''.date('Y-m-d',strtotime($_POST['filter_contacted_from'])).'');
            if($_POST['filter_contacted_to']!='')
               $contact_list = $contact_list->where('prospects.created_date', '<=', ''.date('Y-m-d',strtotime($_POST['filter_contacted_to'])).'');*/

            $contact_list = $contact_list->find_all()
                                    ->as_array();

            return $contact_list;
       }

       //get default prospect list count
       function getDefaultProspectListCount($startDate,$todayDate){
            $logged_in_userid = Auth::instance()->get_user()->id;
            $prospects = ORM::factory('prospects');
            $user_role = Session::instance()->get('user_role_id');

            $prospects_list = $prospects->select('prospects.*','country.country_name');
            if($user_role==1)
            $prospects_list = $prospects_list->where('prospects.user_id', '=', $logged_in_userid);
            if(isset($_REQUEST['side']))
            {
                $prospects_list = $prospects_list->and_where_open();
                $prospects_list = $prospects_list->or_where('created_date','BETWEEN',array($startDate.' 00:00:00',$todayDate));
                $prospects_list = $prospects_list->and_where_close();
            }
            $prospects_list = $prospects_list->join('country','left');
            $prospects_list = $prospects_list->on('prospects.country_id', '=', 'country.country_id');
            $prospects_list = $prospects_list->find_all();
            $prospects_list = $prospects_list->as_array();

            return $prospects_list;
       }

       //get default prospect list
       function getDefaultProspectList($startDate,$todayDate,$pagination){
            $logged_in_userid = Auth::instance()->get_user()->id;
            $prospects = ORM::factory('prospects');
            $user_role = Session::instance()->get('user_role_id');


                    $prospects_list = $prospects->select('prospects.*','country.country_name');
                    if($user_role==1)
                        $prospects_list = $prospects_list->where('prospects.user_id', '=', $logged_in_userid);
                    if(isset($_REQUEST['side']))
                    {
                        $prospects_list = $prospects_list->and_where_open();
                        $prospects_list = $prospects_list->or_where('created_date','BETWEEN',array($startDate.' 00:00:00',$todayDate));
                        $prospects_list = $prospects_list->and_where_close();
                    }
                    $prospects_list = $prospects_list->join('country','left');
                    $prospects_list = $prospects_list->on('prospects.country_id', '=', 'country.country_id');
                    $prospects_list = $prospects_list->limit($pagination->items_per_page);
                    $prospects_list = $prospects_list->offset($pagination->offset);

                    if($_GET['order'] && $_GET['tab'] == '1')
                    {
                      $order = $_GET['order'];
                    }else{
                        $order = 'created_date';
                    }

                    if($_GET['orderby']) $orderby = $_GET['orderby']; else $orderby = 'DESC';
                    $prospects_list = $prospects_list->order_by('prospects.'.$order, $orderby);
                    $prospects_list = $prospects_list->find_all();
                    $prospects_list = $prospects_list->as_array();

                    return $prospects_list;
       }

       //get warm market list
       function getWarmMarketProspects(){
            $logged_in_userid = Auth::instance()->get_user()->id;
            //$prospects = ORM::factory('prospects');

            if($_GET['order'] && $_GET['ordertab'] == 3)
            {
              $order = $_GET['order'];
            }else{
                $order = 'created_date';
            }


            if($_GET['orderby']) $orderby = $_GET['orderby']; else $orderby = 'DESC';

            //$prospects_list = $prospects_list;
            $warmmarket_list = $this->select('prospects.*','country.country_name')
                                      ->where('prospects.user_id', '=', $logged_in_userid)
                                      ->where('prospects.lead_type_id', '=', 3)
                                      ->join('country','left')
                                      ->on('prospects.country_id', '=', 'country.country_id')
                                      ->order_by('prospects.'.$order, $orderby)
                                      ->find_all()
                                      ->as_array();
            $count_warmmarket_list = count($warmmarket_list);

          // Create an instance of Pagination class and set values
           /* $pagination_warmmarket_list = Pagination::factory(array(
                    'total_items'    => $count_warmmarket_list,
                    'items_per_page' => 10,
            )); */

            if(isset($_GET['itemperpage']))
              {
                 $pagination_warmmarket_list = Pagination::factory(array(
                      'total_items'    => $count_warmmarket_list,
                      'items_per_page' => $_GET['itemperpage'],

              ));
                  $warmcurrent_page = $_GET['itemperpage'];
              }else{
                  $warmcurrent_page = helper_utils::defaultitemperpage();
                  $pagination_warmmarket_list = Pagination::factory(array(
                      'total_items'    => $count_warmmarket_list,
                      'items_per_page' => $warmcurrent_page,
                  ));
              }

              $warmpagination_item = helper_utils::page_dropdown($warmcurrent_page,3);


             $newest_list = $this->select('prospects.*','country.country_name')
                                      ->where('prospects.user_id', '=', $logged_in_userid)
                                      ->where('prospects.lead_type_id', '=', 3)
                                      ->join('country','left')
                                      ->on('prospects.country_id', '=', 'country.country_id')
                                      ->limit($pagination_warmmarket_list->items_per_page)
                                      ->offset($pagination_warmmarket_list->offset)
                                      ->find_all()
                                      ->as_array();

             $page_links_pagging_warmmarket_new = $pagination_warmmarket_list->render();

            $return_data_new['warmmarket_list'] = $warmmarket_list;
            $return_data_new['count_warmmarket_list'] = $count_warmmarket_list;
            $return_data_new['page_links_pagging_warmmarket'] = $page_links_pagging_warmmarket_new;
            $return_data_new['warmcurrent_page'] = $warmcurrent_page;
            $return_data_new['warmpagination_item'] = $warmpagination_item;

            return $return_data_new;
       }

        public function getAllNewestMembers4Front()
        {
            $userdetail = DB::select('*')
                            ->from('prospects')
                            ->execute()
                            ->as_array();
               //echo "<pre>";print_r($userdetail);die;
                    return $userdetail;

        }

        public function getCurrentProspectStep($prospects_id)
        {
            $prospects_steps = $this->find($prospects_id);
            //$prospects_steps = ORM::factory('prospects',$prospects_id);
            return $prospects_steps->step;
        }

        /***********************************************************************
       	 * Function to get the List of the Money Coming // Creted Date :15-12-12
       	 * who has a member in thier downline
       	 **********************************************************************/

     function get_moneycoming_list($user_id=null , $currentprospectid)
       {
       	/**
       	 * Money coming is defined as a prospect who has been added in the current cycle
       	 * who has a member in thier downline
       	 *
       	 */

            $current_cycle_date = Helper_Utils::currentcycle();
            $prospects = ORM::factory('prospects');
            $users = ORM::factory('Users');

            if ($user_id == null){
               $user_id = Auth::instance()->get_user()->id;
            }



            //Retrieve users who have been added this cycle who are in success line
            $new_users = $users->select('prospect_id');
            $new_users = $new_users->join('prospects');
            $new_users = $new_users->on('users.prospect_id','=','prospects.id');
            $new_users = $new_users->where('prospects.user_id','=',$user_id);
            $new_users = $new_users->where('users.created_date','>',$current_cycle_date);
            $new_users = $new_users->where('prospects.user_id','=',$user_id);
            $new_users = $new_users->find_all();
            $new_users = $new_users->as_array();

            /**
             * get the newest prospect in the downline who has converted to a user
             * because every prospect in upline has money coming.
             */

            $array_monycoming = array();
            foreach($new_users as $key => $nu){
                $money_coming_id = $prospects->select('*')
                        ->where('user_id', '=', $user_id)
                        ->where('id', '>', $nu->prospect_id)
                        ->where('id', '>', $currentprospectid)
                        ->where('is_user', '=', 'no')
                        ->find_all();

            	if(empty($array_monycoming) && $money_coming_id!='')
	    	{
            		foreach($money_coming_id as $mc){
	                    if(isset($new_users[$key+1]->prospect_id) && $mc->id < $new_users[$key+1]->prospect_id)
        	            {
                	        $array_monycoming[]= $mc;
                    	    }
                        }
		 }
            }

            return $array_monycoming;
       }

      /**
      * @desc This function list all the prospectes under belong to user 
      * @return array $prospects_list
      * @since Dec 28th, 2011 
      * @author Harvy Call 
      **/

       function getProspectList(){
            $logged_in_userid = Auth::instance()->get_user()->id;
            $prospects = ORM::factory('prospects');
            $user_role = Session::instance()->get('user_role_id');

            $prospects_list = $prospects->select('prospects.*','country.country_name');
            if($user_role==1)
            $prospects_list = $prospects_list->where('prospects.user_id', '=', $logged_in_userid);
            $prospects_list = $prospects_list->where('prospects.is_user', '=', 'no');
            $prospects_list = $prospects_list->join('country','left');
            $prospects_list = $prospects_list->on('prospects.country_id', '=', 'country.country_id');
            $prospects_list = $prospects_list->find_all();
            $prospects_list = $prospects_list->as_array();
            return $prospects_list;
       }

}
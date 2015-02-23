<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Processlead extends Controller_Layout {

    public function before() {
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

    public function __construct(Request $request) {
        if (Auth::instance()->logged_in('', $all_required = false) == 0) {

            Request::current()->redirect('/auth/signin');
        }
        // Assign the request to the controller
        parent::__construct($request);
    }

    public function action_index() {

        $process_id = $_POST['pid'];
        $lead_type = $_POST['lead_type'];
        $selected_client = $_POST['selected_client'];
        $objLeads = ORM::factory('leads');
        $objLeads->processLead($process_id, $lead_type, $selected_client);


        $this->request->redirect($this->request->uri(
                        array('action' => 'list')), 301);
    }

    public function action_multiple() {

        $selected_client = $_POST['selectedclient'];
        $process_id = $_POST['pid'];
        $lead_type = $_POST['lead_type'];
        $objLeads = ORM::factory('leads');
          
        $objLeads->process_Multi_Client_Lead($process_id, $selected_client, $lead_type);
    }

    public function action_searchphoneforpayday() {
        $phone = $_POST['phonenumber'];
        
        $objLeads_payday = ORM::factory('paydaylead');
        $paydayData = $objLeads_payday->where('phone', '=', $phone)->find_all()->as_array();
        if($paydayData[0]->newpayday_id!='')
        {
            $msg = "Duplicate Phone";
            echo json_encode($msg);
            exit;
        }
        else
        {
            $objLeads_Newpayday = ORM::factory('newpaydayleadupload');
            $newpaydayData = $objLeads_Newpayday->where('phone', '=', $phone)->find_all()->as_array();

           

            $dob = date('m/d/Y', strtotime($newpaydayData[0]->dob));
            $array['fname'] = $newpaydayData[0]->fname;
            $array['lname'] = $newpaydayData[0]->lname;
            $array['phone'] = $newpaydayData[0]->phone;
            $array['address'] = $newpaydayData[0]->address;
            $array['city'] = $newpaydayData[0]->city;
            $array['state'] = $newpaydayData[0]->state;
            $array['zip'] = $newpaydayData[0]->zip;
            $array['email'] = $newpaydayData[0]->email;
            $array['dob'] = $dob;
            $array['ssn'] = $newpaydayData[0]->ssn;
            $array['uin'] = $newpaydayData[0]->uin;
            echo json_encode($array);
            exit;
        }
    }
    public function action_searchphoneforlead() {
        $phone = $_POST['phonenumber'];
        $lead_type = $_POST['lead_type'];
        
        if($lead_type=='auto')
        {
            $objLeads_check = ORM::factory('leadauto');
            $field = 'lead_auto_id';
        }
        else if($lead_type=='new')
        {
            $objLeads_check = ORM::factory('newcar');
            $field = 'lead_new_id';
        }
        else if($lead_type=='payday')
        {
            $objLeads_check = ORM::factory('payday');
            $field = 'payday_id';
        }
        else if($lead_type='insurance')
        {
            $objLeads_check = ORM::factory('insurance');
            $field = 'lead_insurance_id';
        }
        
        $checkPhoneDup = $objLeads_check->where('phone', '=', $phone)->find_all()->as_array();
        
        if($checkPhoneDup[0]->$field!='')
        {
            $msg = "Duplicate Phone";
            echo json_encode($msg);
            exit;
        }
        else
        {
        
            $objLeads_Newpayday = ORM::factory('agentuploadlead');
            $newpaydayData = $objLeads_Newpayday->where('phone', '=', $phone)->find_all()->as_array();

            $dob = date('m/d/Y', strtotime($newpaydayData[0]->birthday));
            $array['fname'] = $newpaydayData[0]->fname;
            $array['lname'] = $newpaydayData[0]->lname;
            $array['phone'] = $newpaydayData[0]->phone;
            $array['address'] = $newpaydayData[0]->address;
            $array['city'] = $newpaydayData[0]->city;
            $array['state'] = $newpaydayData[0]->state;
            $array['zip'] = $newpaydayData[0]->zip;
            $array['email'] = $newpaydayData[0]->email;
            $array['birthday'] = $dob;
            $array['ssn'] = $newpaydayData[0]->ssn;
            //$array['uin'] = $newpaydayData[0]->uin;
            echo json_encode($array);
            exit;
        }
    }
    
    public function action_searchzip() {
        $zip = $_POST['zipcode'];
        $objZip = ORM::factory('zip');
        $zipData = $objZip->where('zipcode', '=', $zip)->find_all()->as_array();
      
        $array['city'] = $zipData[0]->city;
        $array['state'] = $zipData[0]->state;
        //$array['uin'] = $newpaydayData[0]->uin;
       
        echo json_encode($array);
        exit;
    }

}

// End Welcome

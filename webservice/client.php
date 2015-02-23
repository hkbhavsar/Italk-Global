<?php

 include('nusoap/nusoap.php');
  $client = new nusoap_client("http://localhost/vemma/v1/webservice/webservice.php");
  


$data_array = array (
    "0" => array("member_id" => "55555", "business_center_id" => "1245", 
                 "binary_side" => "r","sponsor_contact_id" => "55555", 
                 "sponsor_business_center_id" => "xyz", "contact_name" => "left",
                 "contact_name2" => "xyz", "contact_status" => "left",
                 "enroller_contact_id" => "xyz", "enroller_business_center_id" => "left"
                ),
    "1" => array("member_id" => "66666", "business_center_id" => "Hardik", 
                 "binary_side" => "left","sponsor_contact_id" => "55555", 
                 "sponsor_business_center_id" => "xyz", "contact_name" => "left",
                 "contact_name2" => "xyz", "contact_status" => "left",
                 "enroller_contact_id" => "xyz", "enroller_business_center_id" => "left"
                ),
    "2" => array("member_id" => "777778", "business_center_id" => "xyz", 
                 "binary_side" => "left","sponsor_contact_id" => "55555", 
                 "sponsor_business_center_id" => "xyz", "contact_name" => "left",
                 "contact_name2" => "xyz", "contact_status" => "left",
                 "enroller_contact_id" => "xyz", "enroller_business_center_id" => "left"
                ),
 );
$result = $client->call(
    'syncadd',                       // method name
    array('data_array' => $data_array)    // input parameters
);


        echo '<h2>Request</h2>';
        echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
        echo '<h2>Response</h2>';
        echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
        exit;
?> 
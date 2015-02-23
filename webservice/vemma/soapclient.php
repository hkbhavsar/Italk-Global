<?php
// Pull in the NuSOAP code
require_once "nusoap/nusoap.php";
// Create the client instance
$client = new nusoap_client('http://vemma.com/webservices/v1/service.cfc?wsdl', true);
// Check for an error
$err = $client->getError();
if ($err) {
    // Display the error
    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    // At this point, you know the call that follows will fail
}
// Call the SOAP method
$param=array('status'=>$row[status], 'name1'=>$row[first_name] , 'name2'=>$row[last_name], 'address1'=>$row[address1], 'address2'=>$row[address2], 'address3'=>$row[address3], 'address4'=>$row[address4], 'city'=>$row[city], 'stateCode'=>$row[statecode], 'countryCode'=>$row[countrycode], 'postalCode'=>$row[postalcode], 'phone1'=>$row[phone1], 'phone2'=>$row[phone2], 'email'=>$row[email], 'referral'=>'referral', 'sponsor'=>'sponsor', 'ssn'=>'ssn', 'source'=>'source', 'userName'=>$row[username], 'password'=>$row[password], 'question'=>'question', 'answer'=>'answer', 'externalId'=>'10', 'placement'=>'placement', 'entryDate'=>'entryDate', 'sponsorBusinessCenterId'=>'10', 'enrollerBusinessCenterId'=>$row[business_center_id]);
$result = $client->call('createMember',$param,"http://v1.webservices","",array('username'=>'ckeatly', 'password'=>'ck2011?'));

// Check for a fault
if ($client->fault) {
    echo '<h2>Fault</h2><pre>';
    print_r($result);
    echo '</pre>';
} else {
    // Check for errors
    $err = $client->getError();
    if ($err) {
        // Display the error
        echo '<h2>Error</h2><pre>' . $err . '</pre>';
    } else {
        // Display the result
        echo '<h2>Result</h2><pre>';
        print_r($result);
    echo '</pre>';
    }
}
// Display the request and response
echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
// Display the debug messages
echo '<h2>Debug</h2>';
echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';
?>

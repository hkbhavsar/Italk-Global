<?php
// Pull in the NuSOAP code
require_once "nusoap/nusoap.php";
require_once('dbcredentials.php');
require_once('mysql.php');
$username = 'ckeatly';
$password = 'ck2011?';
$mynamespace = 'ns1="http://12.47.207.73/webservices/v1/service.cfc?wsdl';

// Create the client instance
$client = new nusoap_client('http://12.47.207.73/webservices/v1/service.cfc?wsdl', true);



// Check for an error
$err = $client->getError();
if ($err) {
    // Display the error
    echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
    // At this point, you know the call that follows will fail
}
// Call the SOAP method

 //authenticate to the service:
 //$client->setCredentials('ckeatly', 'ck2011?', '');

 $client->setHeaders('<ns1:authentication xsi:type="authentication"><username>'.$username.'</username><password>'.$password.'</password></ns1:authentication>');

//fetch data from database
//***************************************
//while sending data to client, client has to check if the record for the provided
//data exists or not..if exists, then update the record accordingly or simply insert it

// change query, i have limited it to one record (see query ... users.id='27' ) for testing purpose,
//delete this if changed...........imp
//***************************************

$query_result=mysql_query("select * from users JOIN user_address on users.id=user_address.user_id where (vemma_id=0 or err_sync=1 ) ");
while($row=mysql_fetch_assoc($query_result))
{
    $idis= $row['user_id'];
    //echo "hi".$idis;
    //echo $row['first_name'];
    $para_string=array('status'=>'U', 'name1'=>$row[first_name] , 'name2'=>$row[last_name], 'address1'=>$row[address1], 'address2'=>$row[address2], 'address3'=>$row[address3], 'address4'=>$row[address4], 'city'=>$row[city], 'stateCode'=>$row[statecode], 'countryCode'=>$row[countrycode], 'postalCode'=>$row[postalcode], 'phone1'=>$row[phone1], 'phone2'=>'', 'email'=>$row[email], 'referral'=>'referral', 'sponsor'=>'sponsor', 'ssn'=>'ssn', 'source'=>'source', 'userName'=>$row[username], 'password'=>$row[password], 'question'=>'question', 'answer'=>'answer', 'externalId'=>'10', 'placement'=>'placement', 'entryDate'=>'06/27/2011', 'sponsorBusinessCenterId'=>'10', 'enrollerBusinessCenterId'=>$row[business_center_id]);
   // print_r($para_string);


//send it and get result
print "<br>Create Member: ";
 $result = $client->call('createMember',$para_string);
// Display the request and response
echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
 

//

//verify result

if ($client->fault) {
    echo '<h2>Fault</h2><pre>';
	print_r($result);
    echo "System Unavailable";
    echo '</pre>';
    //for error....we strickly need to set some flag here
    error_syncing($idis);
}
else
{
    // Check for errors
    $err = $client->getError();
    if ($err) {
        // Display the error
        //echo '<h2>Error</h2><pre>' . $err . '</pre>';
         echo '<h2>Error</h2><pre>System Unavailable</pre>';
         //for error....we strickly need to set some flag here
         error_syncing($idis);
    } else {
        // Display the result and proceed update record
        echo '<h2>Result: Member Created</h2><pre>';
        print_r($result);
        // echo '</pre>';
        $vemma_id=$result;
        mysql_query("update users set veema_id='$result' where id=$idis");
        //Proceed to Create Order Request
        $query_result2=mysql_query("select * from user_orders where user_id=$idis");
        if(mysql_num_rows($query_result2)!=0)
        {
        while($row2=mysql_fetch_assoc($query_result2))
        {
            $para2=array(memberUid=>$vemma_id,items=>$row2['items'],shippingOption=>$row2['shippingOption'],
                    name1=>$row1['name1'],name2=>$row1['name2'],address1=>$row1['address1'],
                    address2=>$row1['address2'],address3=>$row1['address3'],address4=>$row1['address4'],
                    city=>$row1['city'],stateCode=>$row1['stateCode'],countryCode=>$row1['countryCode'],
                    postalCode=>$row1['postalCode'],subOrderType=>$row2['subOrderType'],entryDate=>$row2['entryDate'],
                    ccType=>$row2['ccType'],ccHolder=>$row2['ccHolder'],ccNumber=>$row2['ccNumber'],
                    ccExpDate=>$row2['ccExpDate'],externalOrderNumber=>$row2['externalOrderNumber'],
                    orderSource=>$row2['orderSource']);
            $result2 = $client->call('createOrder',$para2);

            if ($client->fault) {
              echo '<h2>Fault</h2><pre>';
              //print_r($result);
              echo "System Unavailable";
              echo '</pre>';
              //for error....we strickly need to set some flag here
              error_syncing($idis);
            }
            else
            {
                // Check for errors
                $err = $client->getError();
                if ($err) {
                // Display the error
                //echo '<h2>Error</h2><pre>' . $err . '</pre>';
                 echo '<h2>Error</h2><pre>System Unavailable</pre>';
                 //for error....we strickly need to set some flag here
                 error_syncing($idis);
                } else {
                    // Display the result and proceed to shipping
                    echo '<h2>Result: Order Created </h2><pre>';

                    //now create shiping order
                    $query_result3=mysql_query("select * from user_shipping where user_id=$idis");
                    while($row3=mysql_fetch_assoc($query_result3))
                    {
                        $para3=array(MemberUid=>$vemma_id,items=>$row3['items'],shippingOption=>$row3['shippingoption'],name1=>$row1['name1'],
                                      name2=>$row1['name2'],address1=>$row1['address1'],
                                      address2=>$row1['address2'],address3=>$row1['address3'],address4=>$row1['address4'],
                                      city=>$row1['city'],stateCode=>$row1['stateCode'],countryCode=>$roW1['countryCode'],
                                      postalCode=>$row1['postalCode'],subOrderType=>$row2['subordertype'],entryDate=>$row3['entrydate'],
                                      ccType=>$row2['ccType'],ccHolder=>$row2['ccHolder'],ccNumber=>$row2['ccNumber'],ccExpDate=>$row2['ccExpDate'],
                                      batchStart=>$row3['batchstart'], effectiveDate=>$row3['effectivedate'],externalOrderNumber =>$row2['externalordernumber']
                                      );
                        $result3 = $client->call('createAutoShipOrder',$para3);

                        if ($client->fault) {
                          echo '<h2>Fault</h2><pre>';
                          //print_r($result);
                          echo "System Unavailable";
                          echo '</pre>';
                          //for error....we strickly need to set some flag here
                          error_syncing($idis);
                        }
                        else
                        {
                            // Check for errors
                            $err = $client->getError();
                            if ($err) {
                            // Display the error
                            //echo '<h2>Error</h2><pre>' . $err . '</pre>';
                             echo '<h2>Error</h2><pre>System Unavailable</pre>';
                             //for error....we strickly need to set some flag here
                             error_syncing($idis);
                            } else {
                                // Display the result and proceed to shipping
                                echo '<h2>Result: Order Created </h2><pre>';
                                echo 'Success';

                            }
                        }
                    }
                   //end of create shipping
                }
            }
        }
        }
    }
}
}
function error_syncing($err_uid)
{
   mysql_query("update users set err_sync=1 where id=$err_uid");
}
// Display the request and response
/*echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
// Display the debug messages
echo '<h2>Debug</h2>';
echo '<pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';    */
?>

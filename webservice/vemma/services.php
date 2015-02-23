<?php
require_once('nusoap/nusoap.php');
require_once('common.php');
require_once('dbcredentials.php');
require_once('mysql.php');


//header('Content-Type: text/xml; charset=ISO-8859-1');

// Create the server instance
$server = new nusoap_server();
$server->xml_encoding = "UTF-8";
$server->soap_defencoding = "UTF-8";
//$server->decode_utf8 = false;

$server->configureWSDL('syncaddwsdl', 'urn:syncaddwsdl');

$server->wsdl->addComplexType(
    'data',
    'complexType',
    'array',
    'all',
    ''
);

/*checks whether user is logged in the system or not
Input : email,password
*/
$server->register('syncadd',
	array('member_id'=>'xsd:int','business_center_id'=>'xsd:int','binary_side'=>'xsd:string','sponsor_contact_id'=>'xsd:int','sponsor_business_center_id'=>'xsd:int','contact_name'=>'xsd:string','contact_name2'=>'xsd:string','contact_status'=>'xsd:string','enroller_contact_id'=>'xsd:int','enroller_business_center_id'=>'xsd:int'),
	array('return'=>'tns:data'),
	'urn:syncaddwsdl',                      // namespace
	'urn:syncaddwsdl#syncaddupdate',       // soapaction
	'rpc',                                // style
	'encoded',                            // use
	'Get Kampaign Data'
);
/*checks whether user is logged in the system or not
Input : email,password
*/

// function for user login
function syncadd($member_id,$business_center_id,$binary_side,$sponsor_contact_id,$sponsor_business_center_id,$contact_name,$contact_name2,$contact_status,$enroller_contact_id,$enroller_business_center_id)
{

    //check if member_id already exists in vemmas' table..if yes then update else insert
    $query1=mysql_query("select id from vemmas where id='$member_id'");
    if(mysql_num_rows($query1)!=0)
    {
      mysql_query("update vemmas set
        business_center_id='".mysql_escape_string($business_center_id)."' ,
        binary_side='".mysql_escape_string($binary_side)."' ,
        sponsor_contact_id='".mysql_escape_string($sponsor_contact_id)."' ,
        sponsor_business_center_id='".mysql_escape_string($sponsor_business_center_id)."' ,
        contact_name='".mysql_escape_string($contact_name)."',
        contact_name2='".mysql_escape_string($contact_name2)."' ,
        contact_status='".mysql_escape_string($contact_status)."',
        enroller_contact_id='".mysql_escape_string($enroller_contact_id)."',
        enroller_business_center_id='".mysql_escape_string($enroller_business_center_id)."' where id='$member_id'");
        $result =array('status'=>array('code'=>'RW1','message'=>'Data Updated'));
    }
    else
    {
  mysql_query("INSERT INTO vemmas (id, business_center_id ,binary_side ,sponsor_contact_id ,sponsor_business_center_id ,contact_name,contact_name2 ,contact_status,enroller_contact_id,enroller_business_center_id ) VALUES
                ('".mysql_escape_string($member_id)."',
                 '".mysql_escape_string($business_center_id)."',
                 '".mysql_escape_string($binary_side)."',
                 '".mysql_escape_string($sponsor_contact_id)."',
                 '".mysql_escape_string($sponsor_business_center_id)."',
                 '".mysql_escape_string($contact_name)."',
                 '".mysql_escape_string($contact_name2)."',
                 '".mysql_escape_string($contact_status)."',
                 '".mysql_escape_string($enroller_contact_id)."',
                 '".mysql_escape_string($enroller_business_center_id)."')");

    $result =array('status'=>array('code'=>'RW1','message'=>'New Data Inserted'));
    //print_r($restult);die;
    }
    return array($result);
}




// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
exit();

?>
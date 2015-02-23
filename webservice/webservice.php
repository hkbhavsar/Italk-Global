<?php
ini_set('display_errors',0);

 include('header.php');
 include('../lib/nusoap/nusoap.php');
 // Create the server instance
$server = new soap_server();

$server = new nusoap_server();
$server->xml_encoding = "UTF-8";
$server->soap_defencoding = "UTF-8";

$server->configureWSDL('syncadd', 'urn:syncadd');

$server->wsdl->addComplexType(
    'data',
    'complexType',
    'array',
    'all',
    ''
);

/***********************************************************************
	Method : syncadd() - Insert / Update the Data in to vemmas table
************************************************************************/
$server->register('syncadd',array('member_id'=>'xsd:array'),
	array('return'=>'tns:data'),'urn:syncaddwsdl',                      // namespace
	'urn:syncaddwsdl#finishSync',       // soapaction
	'rpc',                                // style
	'encoded',                            // use
	'Add Data');


/***********************************************************************
	Method :  finishSync() - Data Tree Process Completed
************************************************************************/
$server->register('finishSync',
	array('member_id'=>'xsd:array'),
	array('return'=>'tns:data'),
	'urn:syncaddwsdl',                      // namespace
	'urn:syncaddwsdl#finishSync',       // soapaction
	'rpc',                                // style
	'encoded',                            // use
	'Remove Data'
);

// function for syncadd

function syncadd($data_array)
{
	if(count($data_array)>0)
		{
            for($i=0;$i<count($data_array);$i++)
            {
                $vemma = ORM::factory('vemmas',$data_array[$i]['member_id']);
                $data_get = ORM::factory('vemmas')->where('id', '=', $data_array[$i]['member_id'])->find()->as_array();
                if ($data_get['id']=='')
                $vemma->id = mysql_escape_string($data_array[$i]['member_id']);
                $vemma->business_center_id = mysql_escape_string($data_array[$i]['business_center_id']);
                $vemma->binary_side = mysql_escape_string($data_array[$i]['binary_side']);
                $vemma->sponsor_contact_id  = mysql_escape_string($data_array[$i]['sponsor_contact_id']);
                $vemma->sponsor_business_center_id = mysql_escape_string($data_array[$i]['sponsor_business_center_id']);
                $vemma->contact_name = mysql_escape_string($data_array[$i]['contact_name']);
                $vemma->contact_name2  = mysql_escape_string($data_array[$i]['contact_name2']);
                $vemma->contact_status  = mysql_escape_string($data_array[$i]['contact_status']);
                $vemma->enroller_contact_id  =mysql_escape_string($data_array[$i]['enroller_contact_id']);
                $vemma->enroller_business_center_id  = mysql_escape_string($data_array[$i]['enroller_business_center_id']);
                $vemma->save();
        //check if member_id already exists in vemmas' table..if yes then update else insert
            if ($data_get['id']=='')
                $result[] =array('status'=>array('code'=>'RWI','vid'=>$data_array[$i]['member_id'],'message'=>'Data Insert Sucessfully'));
            else
                $result[] =array('status'=>array('code'=>'RWU','vid'=>$data_array[$i]['member_id'],'message'=>'Data Update Sucessfully'));
            }
		}
	else
		{
			$result[] =array('status'=>array('code'=>'RWN','vid'=>0,'message'=>'NULL DATA'));
		}
						
            return ($result);
}

    function finishSync($test)
    {
            $result =array('status'=>array('code'=>'RW','message'=>'Data-tree is Finished'));
            return array($result);
    }

// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
exit();
?>
<?php
require_once('nusoap/nusoap.php');
require_once('common.php');
require_once('dbcredentials.php');
require_once('mysql.php');

header('Content-Type: text/xml; charset=ISO-8859-1');
// Create the server instance
$server = new nusoap_server();
$server->xml_encoding = "ISO-8859-1";
$server->soap_defencoding = "ISO-8859-1";

$server->configureWSDL('hellowsdl2', 'urn:hellowsdl2');

$server->wsdl->addComplexType(
	'commentsdata',
	'complexType',
	'array',
	'all',
	''
);

/*add comment function
Input: id,match_id,message_id,comment_text
*/
$server->register(
	'addcomments',
	array('id' => 'xsd:int','match_id' => 'xsd:int','message_id' => 'xsd:int','comment_text' => 'xsd:string','timestamp' => 'xsd:int'),
	array('return'=>'tns:commentsdata'),
	'urn:hellowsdl',
	'urn:hellowsdl#hello',
	'rpc',
	'encoded',
	'Add comment'
);

/*get comment for message
Input: id,message_id,timestamp
*/
$server->register(
	'getCommentForMessage',
	array('id' => 'xsd:int','message_id' => 'xsd:int','timestamp' => 'xsd:int'),
	array('return'=>'tns:commentsdata'),
	'urn:hellowsdl',
	'urn:hellowsdl#hello',
	'rpc',
	'encoded',
	'Get comments for message'
);

//function for adding comments//
function addcomments($id,$match_id,$message_id,$comment_text,$timestamp)
{
	$id = intval($id);
	$match_id = intval($match_id);
	$message_id = intval($message_id);
	$comment_text = strval($comment_text);
	$comment_text=utf8_encode($comment_text);
	//$timestamp = intval($timestamp);
	//$timestamp = convertTimeZone($timestamp,"");
	
	$gmtDate = gmdate("Y-m-d H:i:s");
	$timestamp = convertTimeZone(convert_date_timestamp($gmtDate),"");
	insertLog('addcomments',$id,$match_id,"message id =$message_id,comment text	=$comment_text");
	if(isLoggedIn($id))
	{
		if(strlen($comment_text) <= 255)
		{
			$qry = mysql_query("SELECT CMT_USR_id FROM cmt_comments WHERE CMT_USR_id=".mysql_real_escape_string($id)." And CMT_MST_id=".mysql_real_escape_string($message_id));
			$qry = "INSERT INTO cmt_comments(CMT_USR_id, CMT_MAT_id, CMT_MST_id, CMT_MST_text)VALUES ('".mysql_real_escape_string($id)."','".mysql_real_escape_string($match_id)."','".mysql_real_escape_string($message_id)."','".mysql_real_escape_string($comment_text)."')";
			mysql_query($qry);
			mysql_query("UPDATE cmt_comments SET CMT_timestamp = ".mysql_real_escape_string($timestamp)." WHERE CMT_MST_id = ".mysql_real_escape_string($message_id));
			mysql_query("UPDATE oms_official_match_history SET OMH_timestamp = ".mysql_real_escape_string($timestamp).",MEL_timestamp=".mysql_real_escape_string($timestamp)." WHERE OMH_MAT_id = ".mysql_real_escape_string($match_id));

			$result['status']=  array('code'=>'TOC0','message'=>"Success");
			$result['timestamp'] = convertTimeZone("",$timestamp);
		}
		else
		{
			$result['status']=  array('code'=>'TOC2','message'=>"Maximum 255 characters allowed for comment text.");
		}
	}
	else
	{
		$result['status'] = array('code'=>'AAA_1','message'=>'Your session is expired.');
	}
	return array($result);
}

//function for fetching comments for particular message//
function getCommentForMessage($id,$message_id,$timestamp)
{
	$id = intval($id);
	$message_id = intval($message_id);
	$timestamp = intval($timestamp);
	
	$timestamp = convertTimeZone($timestamp,"");

	insertLog('getCommentForMessage',$id,'',"message id =$message_id");
	if(isLoggedIn($id))
	{
		$qry = mysql_query("SELECT CMT_timestamp FROM cmt_comments WHERE CMT_MST_id=".mysql_real_escape_string($message_id));
		
		if(mysql_num_rows($qry) > 0)
		{
			$timest = mysql_fetch_array($qry,MYSQL_ASSOC);
			if($timest['CMT_timestamp']!= $timestamp)
			{
				$num_of_record=mysql_num_rows(mysql_query("SELECT u.USR_nick,u.USR_image,c.CMT_MST_text,c.CMT_USR_id FROM cmt_comments AS c LEFT JOIN usr_user AS u ON c.CMT_USR_id = u.USR_id WHERE c.CMT_MST_id = ".mysql_real_escape_string($message_id)));

				$limitstart=$num_of_record-5;
				$query = mysql_query("SELECT USR_nick,u.USR_image,c.CMT_MST_text,c.CMT_USR_id FROM cmt_comments AS c LEFT JOIN usr_user AS u ON c.CMT_USR_id = u.USR_id WHERE c.CMT_MST_id = ".mysql_real_escape_string($message_id)." ORDER BY c.CMT_id ASC LIMIT ".$limitstart.",5");
	
				$result['status']=  array('code'=>'TIC0','message'=>'Success');
				$result['timestamp']= convertTimeZone("",$timest['CMT_timestamp']);
				while($record = mysql_fetch_assoc($query))
				{
					$record["USR_image"] = USER_IMAGE.$record["USR_image"];
					$result['comments'][]= $record;
				}
			}
			else
			{
				$result['status'] = array('code'=>'AAA_2','message'=> 'API version is same.');
			}
		}
		else
		{
			$result['status']=  array('code'=>'TIC1','message'=>'Message ID not found.');
		}
	}
	else
	{
		$result['status'] = array('code'=>'AAA_1','message'=>'Your session is expired.');
	}
	return array($result);
}

// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
exit();

?>
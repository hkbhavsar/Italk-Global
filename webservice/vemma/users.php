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

$server->configureWSDL('hellowsdl2', 'urn:hellowsdl2');

$server->wsdl->addComplexType(
    'userdata',
    'complexType',
    'array',
    'all',
    ''
);

/*insert user function
Input : password,email,nickname,deviceserial,devicetype,filename
*/
$server->register(
	'insertUser',
	array('password'=>'xsd:string','email'=>'xsd:string','nickname'=>'xsd:string','deviceserial'=>'xsd:string','devicename'=>'xsd:string','devicetype'=>'xsd:string','filename'=>'xsd:string','language'=>'xsd:string'),
	array('return'=>'tns:userdata'),
	'urn:hellowsdl',                      // namespace
	'urn:hellowsdl#hello',                // soapaction
	'rpc',                                // style
	'encoded',                            // use
	'Says hello world to client'          // documentation
);

/*checks whether user is logged in the system or not
Input : email,password
*/
$server->register('userLogin',
	array('email'=>'xsd:string','password'=>'xsd:string','language'=>'xsd:string','userDeviceSerial'=>'xsd:string'),
	array('return'=>'tns:userdata'),
	'urn:hellowsdl',                      // namespace
	'urn:hellowsdl#hello',                // soapaction
	'rpc',                                // style
	'encoded',                            // use
	'Says hello world to client'
);

/*get user list function
Input : id
*/
$server->register(
	'getUserList',
	array('id' => 'xsd:int'),
	array('return'=>'tns:userdata'),
	'urn:hellowsdl',                      // namespace
	'urn:hellowsdl#hello',                // soapaction
	'rpc',                                // style
	'encoded',                            // use
	'Says hello world to client'          // documentation
);

/* update league id for user
Input : user_id,league_id
*/
$server->register(
	  'updateUserLeague',
	  array('user_id' => 'xsd:int','league_id' => 'xsd:int'),
	  array('return'=>'tns:userdata'),
	  'urn:hellowsdl',                      // namespace
	  'urn:hellowsdl#hello',                // soapaction
	  'rpc',                                // style
	  'encoded',                            // use
	  'Says hello world to client'          // documentation
);
 /* update league id for user
Input : user_id,league_id
*/
$server->register(
	  'uploadUserImage',
	  array('user_id' => 'xsd:int','image' => 'xsd:string'),
	  array('return'=>'tns:userdata'),
	  'urn:hellowsdl',                      // namespace
	  'urn:hellowsdl#hello',                // soapaction
	  'rpc',                                // style
	  'encoded',                            // use
	  'Says hello world to client'          // documentation
);
/*Forgot Password*/
$server->register(
	  'forgotPassword',
	  array('email' => 'xsd:string','isLoginFromDevice'=>'xsd:int'),
	  array('return'=>'tns:userdata'),
	  'urn:hellowsdl',                      // namespace
	  'urn:hellowsdl#hello',                // soapaction
	  'rpc',                                // style
	  'encoded',                            // use
	  'Says hello world to client'          // documentation
);
 //user logout
$server->register(
	'userLogout',
   	array('id'=>'xsd:int'),
	array('return'=>'tns:userdata'),
	'urn:hellowsdl',                        // namespace
	'urn:hellowsdl#hello',                  // soapaction
	'rpc',                                  // style
	'encoded',                              // use
	'User Logout'            				// documentation
);
$server->register('userLoginTemp',
	array('nick'=>'xsd:string','email'=>'xsd:string','password'=>'xsd:string','language'=>'xsd:string','userDeviceSerial'=>'xsd:string'),
	array('return'=>'tns:userdata'),
	'urn:hellowsdl',                      // namespace
	'urn:hellowsdl#hello',                // soapaction
	'rpc',                                // style
	'encoded',                            // use
	'Says hello world to client'
);

$server->register('insertGuestUser',
	array('deviceserial'=>'xsd:string','language'=>'xsd:string'),
	array('return'=>'tns:userdata'),
	'urn:hellowsdl',                      // namespace
	'urn:hellowsdl#hello',                // soapaction
	'rpc',                                // style
	'encoded',                            // use
	'Says hello world to client'
);

$server->register('updateHelpKeyValue',
	array('id'=>'xsd:int','key'=>'xsd:string'),
	array('return'=>'tns:userdata'),
	'urn:hellowsdl',                      // namespace
	'urn:hellowsdl#hello',                // soapaction
	'rpc',                                // style
	'encoded',                            // use
	'Key Value will be become 1'
);
/* function for insert user*/
function insertUser($password,$email,$nickname,$deviceserial,$devicename,$devicetype,$filestring,$language)
{
	$password = strval($password);
	$password = utf8_encode($password);
	$email = strval($email);
	$email = utf8_encode($email);
	$nickname = strval($nickname);
	$nickname = utf8_encode($nickname);
	$deviceserial = strval($deviceserial);
	$deviceserial = utf8_encode($deviceserial);
	$devicename = strval($devicename);
	$devicename = utf8_encode($devicename);
	$devicetype = strval($devicetype);
	$devicetype = utf8_encode($devicetype);
	$filestring = strval($filestring);
 	$language=strtolower($language);

	$curr_timestamp = convertTimeZone(convert_date_timestamp(gmdate("Y-m-d H:i:s")),"");

    $nick_check=check_nick_exists($nickname);
	$email_check=check_email_exists($email);
	
    // check nickname exist or not
    if($nick_check==true)
    {
        $result =array('status'=>array('code'=>'RW1','message'=>'Registration Warning Nick Exists'));
        return array($result);
    }

    //check email
    if(!isValidEmail($email))
    {
        $result =array('status'=>array('code'=>'RW3','message'=>'Registration Warning Email Format'));
        return array($result);

    }

    // check email exists or not
    if($email_check==true)
    {
        $result = array('status'=>array('code'=>'RW2','message'=>'Registration Warning Email Exists'));
        return array($result);

    }

    //nickname valid or not

    if(!isValidNick($nickname))
    {
         $result =array('status'=>array('code'=>'RW8','message'=>'Registration Warning Nickname Incorrect'));
        return array($result);
    }
     //return "here";
    //password valid or not

    if(!isValidPassword($password))
    {
        $result = array('status'=>array('code'=>'RW4','message'=>'Registration Warning Password Incorrect'));
        return array($result);

    }
	insertLog('insertUser','','',"email=$email,nickname=$nickname");
	
    $qry="INSERT INTO usr_user (USR_password ,USR_email ,USR_status,USR_nick ,USR_device_serial ,USR_device_name ,USR_device_type,USR_image,USR_session,USR_created_timestamp,USR_confirm_code,USR_language)VALUES ('".mysql_real_escape_string($password)."','".mysql_real_escape_string($email)."','4','".mysql_real_escape_string($nickname)."','".mysql_real_escape_string($deviceserial)."','".mysql_real_escape_string($devicename)."','".mysql_real_escape_string($devicetype)."','".mysql_real_escape_string($filename)."',".mysql_real_escape_string($curr_timestamp).",".mysql_real_escape_string($curr_timestamp).",'".md5($email)."','".$language."')";


	$query = mysql_query($qry);

	$id=mysql_insert_id();

     mysql_query("INSERT INTO pua_pushalarms SET PUA_USR_id = ".mysql_real_escape_string($id).",timestamp = ".mysql_real_escape_string($curr_timestamp));

    mysql_query("INSERT INTO ulh_user_login_history (ULH_USR_id,ULH_type,ULH_timestamp) VALUES ('".mysql_real_escape_string($id)."', 'Registered','".mysql_real_escape_string($curr_timestamp)."')");

    mysql_query("INSERT INTO uhp_user_help (UHP_USR_id,timestamp) VALUES ('".mysql_real_escape_string($id)."',".mysql_real_escape_string($curr_timestamp).")");

	$imgname= $id.".jpg";

	if($filestring!="")
	{
		$fp = fopen("../admin/images/user_images/".$imgname, "w");
		fwrite($fp, base64_decode($filestring));
		fclose($fp);
	}
	else
	{
		$img = "../admin/images/user_images/default.png";
		$fd = fopen($img, 'rb');
		$size = filesize($img);
		$cont = fread($fd, $size);
		$fp = fopen("../admin/images/user_images/".$imgname, "w");
		fwrite($fp, $cont);
		fclose($fp);
	}
	//update icon field in database
	$qry="UPDATE usr_user SET `USR_image` = '".mysql_real_escape_string($imgname)."' WHERE `USR_id` =".mysql_real_escape_string($id);
	$query = mysql_query($qry);

	if($query==true)
	{
		$rs= mysql_query("
			SELECT u.*, urs.URS_name_DE as USR_de, urs.URS_name_EN as USR_en,(SELECT LGT_name FROM lgt_league_tree WHERE LGT_id=u.USR_last_league_LGT_id) as USR_last_league_LGT_name,pa.*
			FROM usr_user u
			INNER JOIN pua_pushalarms pa ON pa.PUA_USR_id = u.USR_id
			INNER JOIN urs_user_registration_status urs ON urs.URS_id=u.USR_status 
			WHERE u.USR_id = ".mysql_real_escape_string($id)
		);

		if(mysql_num_rows($rs)>0)
		{
            $result['status']=  array('code'=>'RW0','message'=>'Success');

			$_SESSION["session_USR_id"] = $id;

            $record=mysql_fetch_assoc($rs);

			$result['data']= $record;
			$result['data']['USR_image'] = USER_IMAGE.$record['USR_image'];
			if($language=="de")
			{
				$result['data']['USR_status'] = $record['USR_de'];
			}
			else
			{
				$result['data']['USR_status'] = $record['USR_en'];
			}
			
			$result['data']['membersince'] = date("m/Y",convertTimeZone("",$record['USR_created_timestamp']));
			
			//get count for use followed /reporting
			$total_rpt_qry = func_query_first_cell("select count(*) as total_reported from rpt_reporting where RPT_reported=1 and RPT_USR_ID=".mysql_real_escape_string($id));
			$total_follow_qry = func_query_first_cell("select count(*) as total_followed from rpt_reporting where RPT_followed=1 and RPT_USR_ID=".mysql_real_escape_string($id));

			$total_rpt_qry['total_reported'] = intval($total_rpt_qry['total_reported']);
			$total_follow_qry['total_followed'] = intval($total_follow_qry['total_followed']);

			$result['data']['reporting']=$total_rpt_qry['total_reported'];
			$result['data']['followed']=$total_follow_qry['total_followed'];
			unset($result['data']['USR_password']);
        }
		//send mail to registered user
		// message
		
        $messagebody = '
        <html>
        <head>
          <title>confirmation email</title>
        </head>
        <body>';
		if($language=="de" )
    	{
    		$subject="Bitte bestätige Deine Registrierung bei Tickerfriends.com";
	        $messagebody.='<p>
	Hallo '.$nickname.', </p>

	<p>Danke für Deine Registiereung bei Tickerfriends. Damit kannst Du nun alle Funktionalitäten bei Tickderfriends benutzen. Wir wünschen Dir viel Spaß. </p>

	<p>Bitte klicke den folgenden Link, um Deine Registrierung abzuschließen.</p>

	<p><a href="'.SITE_URL.'/services/cofirmation.php?code='.md5($email).'">'.SITE_URL.'/services/cofirmation.php?code='.md5($email).'</a></p>

	<p>Dein Tickerfriends.com Team</p>';
		}
		else
		{
			$subject="Please confirm your registration at Tickerfriends.com";
	        $messagebody.='<p>
	Hallo '.$nickname.', </p>

	<p>thank you for registering with Tickerfriends.com. You can now use all functionality of Tickerfriends. We wish you lots of fun. Please click on the link below to activate your email address and complete registration.</p>

	<p><a href="'.SITE_URL.'/services/cofirmation.php?code='.md5($email).'">'.SITE_URL.'/services/cofirmation.php?code='.md5($email).'</a></p>

	<p>Your Tickerfriends.com team	</p>';			
		}
        $messagebody.='</body>
        </html>
        ';
		//echo $messagebody;die;
		include_once("phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth   = SMTP_AUTH;  // enable SMTP authentication
		$mail->Host       = SMTP_HOST;  // sets  as the SMTP server
		$mail->Port       = SMTP_PORT;  // set the SMTP port for the server
		$mail->Username   = REG_USER;  //  username
		$mail->Password   = REG_PASS;  //  password
		$mail->From       = REG_USER;  //From email id
		$mail->FromName   = REG_USER;//From name
		$mail->Subject    = $subject;
		$mail->WordWrap   = 50; // set word wrap
		$mail->MsgHTML($messagebody);
		$mail->AddAddress($email);
		$mail->AddAddress(ADDR_EMAIL);
		$mail->AddAddress(TATVA_EMAIL);

		$mail->IsHTML(true); // send as HTML
		$mail->Send();

        return array($result);
	}
	else
	{
		return array(array('status'=>array('code'=>'RW9','message'=>'user not inserted')));
	}
}

// function for user login
function userLogin($email,$password,$language,$deviceserial)
{
	 $password = strval($password);
	 $email = strval($email);
	 $language=strtolower($language);
     //$deviceserial=strtolower($deviceserial);

	$curr_timestamp = convertTimeZone(convert_date_timestamp(gmdate("Y-m-d H:i:s")),"");

     if(isset($email) && !empty($email))
     {
     	insertLog('userLogin','','',"email= $email,language =$language");
        $sql = sprintf("SELECT u.*,urs.URS_name_DE as USR_de, urs.URS_name_EN as USR_en,(SELECT LGT_name FROM lgt_league_tree WHERE LGT_id=u.USR_last_league_LGT_id) as USR_last_league_LGT_name,pa.*
		FROM usr_user u
		INNER JOIN pua_pushalarms pa ON pa.PUA_USR_id = u.USR_id
		INNER JOIN urs_user_registration_status urs ON urs.URS_id=u.USR_status
		WHERE USR_email = '%s' and USR_password = '%s'", mysql_real_escape_string($email), mysql_real_escape_string($password));

        $rs = mysql_query($sql) or throw_ex();

        if(mysql_num_rows($rs)>0)
        {
            $result=array('status'=>array('code'=>'RW0','message'=>'Success'));

			$record=mysql_fetch_assoc($rs);
        	if($record['USR_isUserLoggedIn']==1 && $record['USR_device_serial']!=$deviceserial && isLoggedIn($record['USR_id']))
			{
				$result=array('status'=>array('code'=>'AAA_3','message'=>'User is already loge in'));
			}
			else
			{
				$result=array('status'=>array('code'=>'RW0','message'=>'Success'));

				$_SESSION["session_USR_id"] = $record["USR_id"];

				$result['data']=$record;

                mysql_query("UPDATE usr_user SET USR_session = ".mysql_real_escape_string($curr_timestamp).",USR_language = '".mysql_real_escape_string($language)."',USR_device_serial= '".mysql_real_escape_string($deviceserial)."' WHERE `USR_id` =".mysql_real_escape_string($record['USR_id']));
                //insert in user history
                mysql_query("INSERT INTO ulh_user_login_history (ULH_USR_id,ULH_type,ULH_timestamp) VALUES ('".mysql_real_escape_string($record['USR_id'])."', 'login','".mysql_real_escape_string($curr_timestamp)."')");

    			$result['data']['USR_image']= USER_IMAGE.$record['USR_image'];
    			if($language=="de")
    			{
    				$result['data']['USR_status'] = $record['USR_de'];
    				$result['data']['USR_language'] =$language;
    			}
    			else
    			{
    				$result['data']['USR_status'] = $record['USR_en'];
    				$result['data']['USR_language'] =$language;
    			}
    			$result['data']['membersince'] = date("m/Y",convertTimeZone("",$record['USR_created_timestamp']));

    			//get count for use followed /reporting
    			$total_rpt_qry = func_query_first_cell("select count(*) as total_reported from rpt_reporting where RPT_reported=1 and RPT_USR_ID=".mysql_real_escape_string($record['USR_id']));
    			$total_follow_qry = func_query_first_cell("select count(*) as total_followed from rpt_reporting where RPT_followed=1 and RPT_USR_ID=".mysql_real_escape_string($record['USR_id']));

    			$total_rpt_qry['total_reported'] = intval($total_rpt_qry['total_reported']);
    			$total_follow_qry['total_followed'] = intval($total_follow_qry['total_followed']);

    			$result['data']['reporting']=$total_rpt_qry['total_reported'];
    			$result['data']['followed']=$total_follow_qry['total_followed'];
                //get help for user
                $help_qry ="SELECT uhp.UHP_HNLN as HNLN,uhp.UHP_HNLT as HNLT,uhp.UHP_HNLE as HNLE,uhp.UHP_HNTD as HNTD,uhp.UHP_HNRE as HNRE,uhp.UHP_HNTI as HNTI,uhp.UHP_HNOTHERS as HNOTHERS,uhp.UHP_HNRM as HNRM,uhp.UHP_HNAB as HNAB,uhp.UHP_HNSE as HNSE,uhp.UHP_HNBM as HNBM,uhp.UHP_HNPL as HNPL,uhp.UHP_HNWE as HNWE FROM uhp_user_help uhp where UHP_USR_id=".$record["USR_id"];
                $help_sql = mysql_fetch_assoc(mysql_query($help_qry));
                $result['data']['Help']=$help_sql;

    			unset($result['data']['USR_password']);
            }
        }
        else
        {
            $result =array('status'=>array('code'=>'RW5','message'=>'Invalid username or password.'));
        }

     }
     else
     {
          $result =array('status'=>array('code'=>'RW5','message'=>'Invalid username or password.'));
     }

	 return array($result);
}

// function for user login
function userLoginTemp($nick,$email,$password,$language,$deviceserial)
{
     $nick = strval($nick);
	 $password = strval($password);
	 $email = strval($email);
	 $language=strtolower($language);

	$curr_timestamp = convertTimeZone(convert_date_timestamp(gmdate("Y-m-d H:i:s")),"");

     if((isset($email) && !empty($email)) || (isset($nick) && !empty($nick)))
     {
     	insertLog('userLogin','','',"nick= $nick,email= $email,language =$language");
     	if(!empty($email) && !empty($nick))
 	       $where = " WHERE USR_nick = '".mysql_real_escape_string($nick)."' and USR_email = '".mysql_real_escape_string($email)."' and USR_password = '".mysql_real_escape_string($password)."'";
		elseif(!empty($email) )
			$where = " WHERE USR_email = '".mysql_real_escape_string($email)."' and USR_password = '".mysql_real_escape_string($password)."'";
		elseif(!empty($nick) )
			$where = " WHERE USR_nick = '".mysql_real_escape_string($nick)."' and USR_password = '".mysql_real_escape_string($password)."'";
		
		$sql ="SELECT u.*,urs.URS_name_DE as USR_de, urs.URS_name_EN as USR_en,
				(SELECT LGT_name FROM 	lgt_league_tree WHERE LGT_id=u.USR_last_league_LGT_id) as USR_last_league_LGT_name,pa.*
		FROM usr_user u
		INNER JOIN pua_pushalarms pa ON pa.PUA_USR_id = u.USR_id
		INNER JOIN urs_user_registration_status urs ON urs.URS_id=u.USR_status
        $where";

        $rs = mysql_query($sql) or throw_ex();

        if(mysql_num_rows($rs)>0)
        {
        	$record=mysql_fetch_assoc($rs);
        	if($record['USR_isUserLoggedIn']==1 && $record['USR_device_serial']!=$deviceserial && isLoggedIn($record['USR_id']))
			{
				$result=array('status'=>array('code'=>'AAA_3','message'=>'User is already loge in'));
			}
			else
			{
				$result=array('status'=>array('code'=>'RW0','message'=>'Success'));

				$_SESSION["session_USR_id"] = $record["USR_id"];

				$result['data']=$record;

	            mysql_query("UPDATE usr_user SET USR_session = ".mysql_real_escape_string($curr_timestamp).",USR_isUserLoggedIn = 1,USR_language = '".mysql_real_escape_string($language)."',USR_device_serial= '".mysql_real_escape_string($deviceserial)."' WHERE `USR_id` =".mysql_real_escape_string($record['USR_id']));

                //insert in user history
                mysql_query("INSERT INTO ulh_user_login_history (ULH_USR_id,ULH_type,ULH_timestamp) VALUES ('".mysql_real_escape_string($record['USR_id'])."', 'login','".mysql_real_escape_string($curr_timestamp)."')");

				$result['data']['USR_image']= USER_IMAGE.$record['USR_image'];
				if($language=="de")
				{
					$result['data']['USR_status'] = $record['USR_de'];
					$result['data']['USR_language'] =$language;
				}
				else
				{
					$result['data']['USR_status'] = $record['USR_en'];
					$result['data']['USR_language'] =$language;
				}		   
				$result['data']['membersince'] = date("m/Y",convertTimeZone("",$record['USR_created_timestamp']));

				//get count for use followed /reporting
				$total_rpt_qry = func_query_first_cell("select count(*) as total_reported from rpt_reporting where RPT_reported=1 and RPT_USR_ID=".mysql_real_escape_string($record['USR_id']));
				$total_follow_qry = func_query_first_cell("select count(*) as total_followed from rpt_reporting where RPT_followed=1 and RPT_USR_ID=".mysql_real_escape_string($record['USR_id']));

				$total_rpt_qry['total_reported'] = intval($total_rpt_qry['total_reported']);
				$total_follow_qry['total_followed'] = intval($total_follow_qry['total_followed']);

				$result['data']['reporting']=$total_rpt_qry['total_reported'];
				$result['data']['followed']=$total_follow_qry['total_followed'];

                //get help for user
                $help_qry ="SELECT uhp.UHP_HNLN as HNLN,uhp.UHP_HNLT as HNLT,uhp.UHP_HNLE as HNLE,uhp.UHP_HNTD as HNTD,uhp.UHP_HNRE as HNRE,uhp.UHP_HNTI as HNTI,uhp.UHP_HNOTHERS as HNOTHERS,uhp.UHP_HNRM as HNRM,uhp.UHP_HNAB as HNAB,uhp.UHP_HNSE as HNSE,uhp.UHP_HNBM as HNBM,uhp.UHP_HNPL as HNPL,uhp.UHP_HNWE as HNWE FROM uhp_user_help uhp where UHP_USR_id=".$record["USR_id"];
                $help_sql = mysql_fetch_assoc(mysql_query($help_qry));
				$result['data']['Help']=$help_sql;
				unset($result['data']['USR_password']);

			}
        }
        else
        {
            $result =array('status'=>array('code'=>'RW5','message'=>'Invalid username or password.'));
        }

     }
     else
     {
          $result =array('status'=>array('code'=>'RW5','message'=>'Invalid username or password.'));
     }

	 return array($result);
}

// function for user logout
function userLogout($id)
{
	insertLog('userLogout','','',"id= $id");
    $curr_timestamp = convertTimeZone(convert_date_timestamp(gmdate("Y-m-d H:i:s")),"");
	$query=mysql_query("UPDATE usr_user SET USR_session ='0',USR_isUserLoggedIn = 0 WHERE USR_id =".mysql_real_escape_string($id));
    //insert in user history
    mysql_query("INSERT INTO ulh_user_login_history (ULH_USR_id,ULH_type,ULH_timestamp) VALUES ('".mysql_real_escape_string($id)."', 'logout','".mysql_real_escape_string($curr_timestamp)."')");
	$query=mysql_query("DELETE FROM ues_user_extra_settings WHERE UES_USR_id  =".mysql_real_escape_string($id));
	if($query==true)
	{
		$result =array('status'=>array('code'=>'LG0','message'=>'Success'));	
	}
	else
	{
		$result =array('status'=>array('code'=>'LG1','message'=>mysql_error()));	
	}
	return array($result);
}

// function for fetching user list
function getUserList($id)
{
   $id = intval($id);
   	insertLog('getUserList',$id,'',"");
   if(isLoggedIn($id))
   {
		$qry="SELECT * FROM usr_user";
		$query = mysql_query($qry);
		if(mysql_num_rows($query)>0)
		{
			$result['status'] =array('code'=>'RW0','message'=>'Success');
			while($record=mysql_fetch_assoc($query))
			{
				$result['data'][]=$record;
			}
		}
		else
		{
			$result="NO records is found";
		}
   }
   else
   {
		$result[]['status'] = array('code'=>'AAA_1','message'=>'Your session is expired.');
   }

	return array($result);
}

// update the league id of user
function updateUserLeague($user_id,$league_id)
{
	$user_id = intval($user_id);
	$league_id = intval($league_id);
	insertLog('updateUserLeague',$user_id,'',"league_id=$league_id");
    if(isLoggedIn($user_id))
    {
		$query2 =  "SELECT * FROM lgt_league_tree WHERE LGT_id=".mysql_real_escape_string($league_id);
		$res2 = mysql_query($query2);
		// check league exits or not
		if(mysql_num_rows($res2)>0)
		{
			mysql_query("UPDATE usr_user SET `USR_last_league_LGT_id` ='$league_id' WHERE `USR_id` =".mysql_real_escape_string($user_id));
			$result =array('status'=>array('code'=>'LN0','message'=>'Success'));
			return array($result);
		}
		else
		{
			 $result =array('status'=>array('code'=>'LN1','message'=>"League doesn't exist."));
			 return array($result);
		}
    }
    else
    {
        $result =array('status'=>array('code'=>'AAA_1','message'=>'Your session is expired.'));
    }
    return $result;
}

//upldad user image
function uploadUserImage($id,$filestring)
{
    $id = intval($id);
    $filestring = strval($filestring);
	$curr_timestamp = convertTimeZone(convert_date_timestamp(gmdate("Y-m-d H:i:s")),"");
	insertLog('uploadUserImage',$id,'',"");
    if(isLoggedIn($id))
    {
    	$delimgname=func_query_first_cell("SELECT USR_image FROM usr_user where USR_id=".$id);
		@unlink("../admin/images/user_images/".$delimgname['USR_image']);
    	$imgname= $id."_".$curr_timestamp.".jpg";
        $fp = fopen("../admin/images/user_images/".$imgname, "w");
    	fwrite($fp, base64_decode($filestring));
    	fclose($fp);
        //return $result =array('status'=>array('code'=>$filestring));
    	//update icon field in database
    	$qry="UPDATE usr_user SET USR_image = '".mysql_real_escape_string($imgname)."' WHERE `USR_id` =".mysql_real_escape_string($id);
    	$query = mysql_query($qry);
        $result =array('status'=>array('code'=>'SE0','message'=>'imageuploaded'));
     }
     else
    {
        $result =array('status'=>array('code'=>'AAA_1','message'=>'Your session is expired.'));
    }
    return array($result);
}
/* function for forgot password*/
function forgotPassword($email,$isLoginFromDevice=0)
{


	$email_check=check_email_exists($email);
	
    //check email
    if(!isValidEmail($email))
    {
        $result =array('status'=>array('code'=>'FP2','message'=>'Email has no valid Format'));
        return array($result);

    }

    // check email exists or not
    if($email_check!=true)
    {
        $result = array('status'=>array('code'=>'FP1','message'=>'Email Not Exists'));
        return array($result);

    }


	insertLog('forgotPassword','','',"email=$email");
	$rs= mysql_query("SELECT u.* FROM usr_user u WHERE u.USR_email = '".mysql_real_escape_string($email)."'");
	$record=mysql_fetch_assoc($rs);
	$language=userLanguage($record['USR_id']);
	$isLoginFromDevice=intval($isLoginFromDevice);
	if($isLoginFromDevice==1)
	{
		$password=createRandomPassword();
		//send mail to user
		// message
	
	    $messagebody = '
	    <html>
	    <head>
	      <title>Password Reset email</title>
	    </head>
	    <body>';
		if($language=="de" )
	   	{
	   		$subject="Tickerfriends.com - Passwort zurückgesetzt";
	        $messagebody.='<p>Hallo '.$record['USR_nick'].', </p>
			<p>Du hast uns gebeten, Dein Password zurückzusetzen. Dein neues Paswoert lautet:</p>
			<p>Benutzername: '.$email.'</p>
			<p>Passwort: '.$password.'</p>
			<p>Du kannst Dein Passwort jederzeit in Deinem Profil auf tickerfriends.com ändern.</p>
			<p>Dein Tickerfriends.com team</p>';
		}
		else
		{
			$subject="Tickerfriends.com - Password reset";
	        $messagebody.='<p>Dear '.$record['USR_nick'].', </p>
			<p>You requested to reset your password. Please find your new password below:</p>
			<p>Username: '.$email.'</p>
			<p>Password: '.$password.'</p>
			<p>You can always change your password in your profile on tickerfriends.com</p>
			<p>Your Tickerfriends.com team	</p>';			
		}
	       $messagebody.='</body>
	       </html>
	       ';	

		 	include_once("phpmailer/class.phpmailer.php");
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth   = SMTP_AUTH;  // enable SMTP authentication
			$mail->Host       = SMTP_HOST;  // sets  as the SMTP server
			$mail->Port       = SMTP_PORT;  // set the SMTP port for the server
			$mail->Username   = REG_USER;  //  username
			$mail->Password   = REG_PASS;  //  password
			$mail->From       = REG_USER;  //From email id
			$mail->FromName   = REG_USER;//From name
			$mail->Subject    = $subject;
			$mail->WordWrap   = 50; // set word wrap
			$mail->MsgHTML($messagebody);
			$mail->AddAddress($email);
			$mail->AddAddress(ADDR_EMAIL);
			$mail->AddAddress(TATVA_EMAIL);

			$mail->IsHTML(true); // send as HTML
			if(!$mail->Send())
	    	{
	    		$result = array('status'=>array('code'=>'FP3','message'=>'Email Sendin Failed'));
	    	}
			else
			{
				$qry=mysql_query("UPDATE usr_user SET USR_password = '".mysql_real_escape_string($password)."',USR_confirm_code='' WHERE USR_id =".mysql_real_escape_string($record['USR_id']));;
				$query = mysql_query($qry);	
				$result = array('status'=>array('code'=>'FP0','message'=>'Email Sent'));
			}
	}
	else
	{
		if($record['USR_isUserLoggedIn']==1 && isLoggedIn($record['USR_id']))
		{
			if($language=="de" )
		   	{
		   		$msg="Sie befinden sich aktuell bereits von einem anderen Gerät oder auf der Web protokolliert. Sie müssen von dort zuerst um das Kennwort zurückzusetzen Abmeldung.";
		   	}
			else
			{
				$msg="You are currently already logged from another device or on the web. You must logout from there first to reset the password.";
			}	
			$result=array('status'=>array('code'=>'AAA_3','message'=>utf8_encode($msg)));
		}
		else
		{
			$password=createRandomPassword();
	 		//send mail to user
			// message
			
		    $messagebody = '
		    <html>
		    <head>
		      <title>Password Reset email</title>
		    </head>
		    <body>';

            $fetch_bodymsg = mysql_fetch_assoc(mysql_query("SELECT TAP_content_en,TAP_content_de FROM tap_texts_and_properties WHERE TAP_ID = 347"));

			if($language=="de" )
		   	{
		   		$subject="Bestätigung für Passwort zurücksetzen";
		        $Content = utf8_decode($fetch_bodymsg["TAP_content_de"]);
			}
			else
			{
				$subject="Password reset confirmation";
                $Content = utf8_decode($fetch_bodymsg["TAP_content_en"]);
			}

			$Content = str_replace('[USR_nick]',$record['USR_nick'],$Content);

            $Content = str_replace('[SITE_URL]',SITE_URL,$Content);

			$Content = str_replace('[Email]',md5($email),$Content);
            //  echo $Content;die;
            $messagebody.=$Content;
            $messagebody.='</body>
		       </html>';
            // To send HTML mail, the Content-type header must be set
            /*$headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            mail("hiren.vekariya@sparsh.com",$subject,$messagebody,$headers);
			echo utf8_encode($messagebody);die;*/
			include_once("phpmailer/class.phpmailer.php");
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth   = SMTP_AUTH;  // enable SMTP authentication
			$mail->Host       = SMTP_HOST;  // sets  as the SMTP server
			$mail->Port       = SMTP_PORT;  // set the SMTP port for the server
			$mail->Username   = REG_USER;  //  username
			$mail->Password   = REG_PASS;  //  password
			$mail->From       = REG_USER;  //From email id
			$mail->FromName   = REG_USER;//From name
			$mail->Subject    = $subject;
			$mail->WordWrap   = 50; // set word wrap
			$mail->MsgHTML($messagebody);
			$mail->AddAddress($email);
			$mail->AddAddress(ADDR_EMAIL);
			$mail->AddAddress(TATVA_EMAIL);

			$mail->IsHTML(true); // send as HTML
		    if(!$mail->Send())
		    {
		        $result = array('status'=>array('code'=>'FP3','message'=>'Email Sendin Failed'));
		    }
			else
			{
				$qry=mysql_query("UPDATE usr_user SET USR_confirm_code = '".md5($email)."' WHERE USR_id =".mysql_real_escape_string($record['USR_id']));		
				$result = array('status'=>array('code'=>'FP0','message'=>'Email Sent'));
			}
		}	
	}	
	return array($result);
}
/* function for insert guest user*/
function insertGuestUser($deviceserial,$language)
{
	$res = mysql_query("SHOW TABLE STATUS LIKE 'usr_user'");
	$row = mysql_fetch_assoc($res);
	$nextId = $row['Auto_increment'];
	//generate parameter for insert
	$password = "guestguest";
	$email = "Guest$nextId@tickerfriends.com";
	$nickname = "Guest$nextId";
	$deviceserial = strval($deviceserial);
 	$language=strtolower($language);

	$curr_timestamp = convertTimeZone(convert_date_timestamp(gmdate("Y-m-d H:i:s")),"");

	$query_deviceserial = sprintf("select * from usr_user where USR_device_serial = '".mysql_real_escape_string($deviceserial)."' AND USR_status=1");
    $res_deviceserial = mysql_query($query_deviceserial);
	insertLog('insertGuestUser','','',"deviceserial=$deviceserial,language=$language");
	if(mysql_num_rows($res_deviceserial)==0)
	{
		$qry="INSERT INTO usr_user (USR_password ,USR_email ,USR_status,USR_nick ,USR_device_serial ,USR_session,USR_created_timestamp,USR_language)VALUES ('".mysql_real_escape_string($password)."','".mysql_real_escape_string($email)."','1','".mysql_real_escape_string($nickname)."','".mysql_real_escape_string($deviceserial)."',".mysql_real_escape_string($curr_timestamp).",".mysql_real_escape_string($curr_timestamp).",'".$language."')";
		$query = mysql_query($qry);
		$id=mysql_insert_id();
		mysql_query("INSERT INTO pua_pushalarms SET PUA_USR_id = ".mysql_real_escape_string($id).",timestamp = ".mysql_real_escape_string($curr_timestamp));
        mysql_query("INSERT INTO uhp_user_help (UHP_USR_id,timestamp) VALUES ('".mysql_real_escape_string($id)."',".mysql_real_escape_string($curr_timestamp).")");

	}
	else
	{
		$rec_deviceserial=mysql_fetch_assoc($res_deviceserial);
		$id=$rec_deviceserial['USR_id'];
		mysql_query("UPDATE usr_user SET USR_session = '".mysql_real_escape_string($curr_timestamp)."',USR_language = '".mysql_real_escape_string($language)."' WHERE USR_id =".mysql_real_escape_string($id));
	}
	$rs= mysql_query("
		SELECT u.*, urs.URS_name_DE as USR_de, urs.URS_name_EN as USR_en,(SELECT LGT_name FROM lgt_league_tree WHERE LGT_id=u.USR_last_league_LGT_id) as USR_last_league_LGT_name,pa.*
		FROM usr_user u
		INNER JOIN pua_pushalarms pa ON pa.PUA_USR_id = u.USR_id
		INNER JOIN urs_user_registration_status urs ON urs.URS_id=u.USR_status 
		WHERE u.USR_id = ".mysql_real_escape_string($id)
	);
	$result['status']=  array('code'=>'RW0','message'=>'Success');
	$record=mysql_fetch_assoc($rs);

	$result['data']= $record;
	if($language=="de")
	{
		$result['data']['USR_status'] = $record['USR_de'];
		$result['data']['USR_language'] =$language;
	}
	else
	{
		$result['data']['USR_status'] = $record['USR_en'];
		$result['data']['USR_language'] =$language;
	}
	
	$result['data']['membersince'] = date("m/Y",convertTimeZone("",$record['USR_created_timestamp']));
	
	//get count for use followed /reporting
	$total_rpt_qry = func_query_first_cell("select count(*) as total_reported from rpt_reporting where RPT_reported=1 and RPT_USR_ID=".mysql_real_escape_string($id));
	$total_follow_qry = func_query_first_cell("select count(*) as total_followed from rpt_reporting where RPT_followed=1 and RPT_USR_ID=".mysql_real_escape_string($id));

	$total_rpt_qry['total_reported'] = intval($total_rpt_qry['total_reported']);
	$total_follow_qry['total_followed'] = intval($total_follow_qry['total_followed']);

	$result['data']['reporting']=$total_rpt_qry['total_reported'];
	$result['data']['followed']=$total_follow_qry['total_followed'];
    //get help for user
    $help_qry ="SELECT uhp.UHP_HNLN as HNLN,uhp.UHP_HNLT as HNLT,uhp.UHP_HNLE as HNLE,uhp.UHP_HNTD as HNTD,uhp.UHP_HNRE as HNRE,uhp.UHP_HNTI as HNTI,uhp.UHP_HNOTHERS as HNOTHERS,uhp.UHP_HNRM as HNRM,uhp.UHP_HNAB as HNAB,uhp.UHP_HNSE as HNSE,uhp.UHP_HNBM as HNBM,uhp.UHP_HNPL as HNPL,uhp.UHP_HNWE as HNWE FROM uhp_user_help uhp where UHP_USR_id=".$record["USR_id"];

    $help_sql = mysql_fetch_assoc(mysql_query($help_qry));
$result['data']['Help']=$help_sql;
	unset($result['data']['USR_password']);
   return array($result);

}

function updateHelpKeyValue($id,$key)
{
  $id=intval($id);
  //$key= strtoupper($key);
  $curr_timestamp = convertTimeZone(convert_date_timestamp(gmdate("Y-m-d H:i:s")),"");


  if(isLoggedIn($id))
  {
    $get_field_qry =mysql_query("SHOW COLUMNS FROM uhp_user_help");

    while($record=mysql_fetch_assoc($get_field_qry))
    {
        if($record['Field']!='UHP_id' && $record['Field']!='UHP_USR_id' && $record['Field']!='timestamp')
        {
            $fieldnames[]=$record['Field'];
        }
    }
    //print "<pre>";print_r($fieldnames);die;

    if(in_array("UHP_".$key,$fieldnames))
    {
      mysql_query("UPDATE uhp_user_help SET UHP_".$key."=1,timestamp=".mysql_real_escape_string($curr_timestamp)." WHERE UHP_USR_id =".mysql_real_escape_string($id));
      $result['status']=  array('code'=>'RW0','message'=>'Success');
    }
    else
    {
       $result['status']=  array('code'=>'RW0','message'=>'You Enter wrong key');
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
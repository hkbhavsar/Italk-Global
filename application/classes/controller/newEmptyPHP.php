<?php
include "../config.php";
include "../constant.php";
include "../class/functions.php";

if ($_SESSION['agent_id'] == '')
    header("location: index.php");

$id = $_SESSION['agent_id'];
$select = "select * from agent as ag, callcenter as c where ag.agent_id=$id and ag.callcenter_id = c.id";
$res = mysql_query($select);
$result = mysql_fetch_assoc($res);
$callcenter = $result[id];
$check_saving = array();

if (isset($_POST['lead_types'])) {
    if ($_POST['lead_types'] == 'auto_sale')
        header("location: auto.php");
    else if ($_POST['lead_types'] == 'creditline')
        header("location: creditline.php");
    else if ($_POST['lead_types'] == 'home_security')
        header("location: home_security.php");
    else if ($_POST['lead_types'] == 'insurance')
        header("location: insurance.php");
    else if ($_POST['lead_types'] == 'newcar')
        header("location: newcar.php");
    else if ($_POST['lead_types'] == 'payday')
        header("location: payday.php");
    else if ($_POST['lead_types'] == 'newpayday')
        header("location: newpayday.php");
}

if (isset($_POST['hdnaction']) && isset($_POST['submitk'])) {
//print_r($_POST); exit;

    if (isset($_POST['check_saving']))
        $check_saving = implode(',', $_POST['check_saving']);
    if ($check_saving != '')
        $check_saving = explode(',', $check_saving);

    function trim_value(&$value) {
        $value = trim($value);
    }

    array_walk($_POST, 'trim_value');
/////////////////////////////////////////////////////////////////////////////////
    extract($_POST, EXTR_SKIP);
    $phone_msg = '';
    if (isset($_POST['submitk'])) {
        if ($phone_msg == '') { //
            $phone = trim(addslashes($phone));

            $fname = trim(addslashes($fname));
            $lname = trim(addslashes($lname));

            $ssn = trim(addslashes($ssn));
            $email = trim(addslashes($email));

            $address = trim(addslashes($address));
            $city = trim(addslashes($city));
            $state = trim(addslashes($state));
            $zip = trim(addslashes($zip));


            $year = trim(addslashes($year));
            $month = trim(addslashes($month));
            $day = trim(addslashes($day));

            $birthday = $year . '-' . $month . '-' . $day;
            $comment = trim(addslashes($comment));
            $insert = "INSERT INTO `newpayday` 
			( 
			 `fname`, 
			 `lname`, 
			 `phone`,
			 `address`, 
			 `city`, 
			 `state`, 
			 `zip`, 
			 `email`, 
			 `dob`, 
			 `ssn`, 
			 `uin`, 
			 `comment`, 
			 `agent_id`
			 ) VALUES 
			  (
			 '$fname', 
			 '$lname', 
			 '$phone',
			 '$address',
			 '$city',
			 '$state', 
			 '$zip', 
			 '$email', 
			 '$birthday', 
			 '$ssn', 
			 '$uin', 
			 '$comment', 
			 '$id'
			 );";

            $res = mysql_query($insert);

            if ($res) {
                unset($_POST);
                header("location: newpayday.php");
                exit;
            }
            else
                $error = '<tr><td colspan="3"><font color="red">Error in inserting data in database:</font></td></tr>';
        }
    }
}

/* * ********************* When Phone Search Number is Pressed *** *///////////////////

if (isset($_POST['search'])) {
    $ph = $_POST['phone_search'];
    $date_phone = date('Y-m-d H:i:s', mktime(date('H'), date('i'), date('s'), date('m'), date('d') - 60, date('Y')));
    //echo "select phone from cash_advance where phone='$ph' and lead_types = 'payday' and c_date >= '$date_phone'";exit;
    //echo "select phone from newpayday_for_agent where phone='$ph' and create_date >= '$date_phone'";
    //echo mysql_num_rows(mysql_query("select phone from newpayday where phone='$ph' and create_date >= '$date_phone'"));exit;
    if (mysql_num_rows(mysql_query("select phone from newpayday where phone='$ph' and create_date >= '$date_phone'")) == 0) {
        $sql_aca = "select * from newpayday_for_agent where phone = " . $ph . "";
        $selresult = mysql_query($sql_aca);
        if (mysql_num_rows($selresult) > 0) {
            $row_mor = mysql_fetch_assoc($selresult);
            $zipcode = $row_mor[check_saving];
            $ssn = $row_mor['ssn'];
            $uin = $row_mor['uin'];
            $fname = $row_mor['fname']; //
            $lname = $row_mor['lname']; //
            $email = $row_mor['email']; //

            $address = $row_mor['address']; //
            $zip = $row_mor['zip']; //
            $city = $row_mor['city']; //
            $state = $row_mor['state']; //

            $ssn = $row_mor['ssn']; //
            list($year, $month, $day) = explode('-', $row_mor['dob']);

            $comment = $row_mor[comment];
        }//print_r($row_mor);	
    } else {
        $duplicate_error = '<font color="red">Duplicate Phone, Already exists within last 60 days:</font>';
        echo "<script>document.getElementById('submit_k').style.visibility='hidden';</script>";
    }
}


/* * ************************** End Code for Phone Search Number ******************* */
?>
<!--<link rel="stylesheet" href="../css/style.css" type="text/css">-->
<script src="../js/ajax.js"></script>
<script>
    function check_homepay(){
        //alert(document.formauto22.rent_own[0].value);
        if(document.formauto22.rent_own[0].checked == true && document.formauto22.home_pay.value < 100){
            alert("Invalid Home pay");
            document.getElementById('home_pay').value = '';//document.getElementById('home_pay').focus();
        }
    }
	
	
    ////////////////////////// AJAX CODE FOR THE VALIDATE EMAIL Comment///////////////////////////////////

    var element2;

    var http_request = false;
    function makePOSTRequest(url, parameters,elementid) {
   

        http_request = false;
        if (window.XMLHttpRequest) { // Mozilla, Safari,...
            http_request = new XMLHttpRequest();
            if (http_request.overrideMimeType) {
                // set type accordingly to anticipated content type
                //http_request.overrideMimeType('text/xml');
                http_request.overrideMimeType('text/html');
            }
        } else if (window.ActiveXObject) { // IE
            try {
                http_request = new ActiveXObject("Msxml2.XMLHTTP");
            } catch (e) {
                try {
                    http_request = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (e) {}
            }
        }
        if (!http_request) {
            alert('Cannot create XMLHTTP instance');
            return false;
        }   
	
        http_request.onreadystatechange = alertContents;
        http_request.open('POST', url, true);
        http_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        http_request.setRequestHeader("Content-length", parameters.length);
        http_request.setRequestHeader("Connection", "close");
        http_request.send(parameters);
    }

    function alertContents() {
        if (http_request.readyState == 4) {
            if (http_request.status == 200) {
                // alert(http_request.responseText);
                result = http_request.responseText;
                result1 = http_request.responseText;
                document.getElementById('myspan').innerHTML = result+" Email Address.";            		   		   		  		    
		   
                //   if(element2 == 'submit' && result1 == 'Valid' )
                if(element2 == 'submit')
                {		   			
                    document.formauto22.hdnaction.value = 1;
                    document.formauto22.submit();
                }
		     
            } else {
                //alert('There was a problem with the request.');
            }
        }
    }   
   
    /// Trim function for the Trim a string Comment
   

  
   
    function validate_email(element)
    {    
        element2 = element;
        var email_id = document.formauto22.email.value;
        var poststr = "email=" + encodeURI(email_id);				   					
        makePOSTRequest('test2.php', poststr,element);	

    }

    ////////////////////////// End Here /////////////////////////////////////////////////////////////////////////////////
	
</script>
<link rel="stylesheet" href="../css/style_muk.css" type="text/css">
<style>
    .small_links {
        color:#ffffff;
        font-size:11px;
        font-weight:bold;
        font-family: Tahoma, Arial;
        text-decoration:none;
    }
</style>
<?php include "header.php"; ?>
<style type="text/css">
    <!--
    #alertstop {
        /* IE 5.0/Win and other lesser browsers will use this */
        position: absolute; right: 0px; bottom: 0px; }
    body > div#alertstop {
        /* used by Netscape6+/Mozilla, Opera 5+, Konqueror, Safari, OmniWeb 4.5+, ICEbrowser */
        position: fixed;
    }
    .adtop{z-index:5; width:230px;}
    .icon{background:url(mails/images/IconStrip.gif) no-repeat; height:16px;}
    .close3 {background-position:-1059px 0px; width:14px;}

    -->
</style><style type="text/css">
    #scroll1{overflow: hidden;}
</style>
<style type="text/css">
    <!--
    .style1{font-size: 14px}
    -->
</style>

<? require "campaign_sel.php"; ?>
<!-- Added By Hardik for validation --->
<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="css/template.css" type="text/css"/>

<script src="js/validation/jquery-1.7.2.min.js" type="text/javascript">
</script>
<script src="js/validation/languages/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
</script>
<script src="js/validation/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
</script>
<script>
    jQuery(document).ready(function(){
        // binds form submission and fields to the validation engine
        jQuery("#formauto22").validationEngine();
    });

    /**
     *
     * @param {jqObject} the field where the validation applies
     * @param {Array[String]} validation rules for this field
     * @param {int} rule index
     * @param {Map} form options
     * @return an error string if validation failed
     */
    function checkHELLO(field, rules, i, options){
        if (field.val() != "HELLO") {
            // this allows to use i18 for the error msgs
            return options.allrules.validate2fields.alertText;
        }
    }
</script>
<!-- End By Hardik for validation --->
<form name="formauto22" action="newpayday.php" method="post" >
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(../images/auto-bg.jpg) 260px -20px repeat-y;  ">
        <tr>
            <td width="4%">&nbsp;</td>
            <td width="23%">&nbsp;</td>
            <td width="50">&nbsp;</td>
            <td width="66%">
                <table cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                        <td width="10%"><span class="bold" style="color:white;">Phone Number </span></td>
                        <td height="20" width="10%"><?php if ($callcenter == '6') { ?>
                                <input name="phone_search" id="phone_search" class="a1_form" type="text" value="<?= $phone_search; ?>"  maxlength="10" /><? } else { ?><input name="phone_search" id="phone_search" class="a1_form" type="text" value="<?= $phone_search; ?>"  maxlength="10" onblur="fetch_phone(this.value , 'payday');"  /><? } ?><span style="font-size:12px;color:#F00;" id="phone_validate"></span></td>
                        <td width="30%"><input id="btnGo" name="search" type="submit" class="on" value="Go" style="width:30px; height:20px; font-weight:bold; background:#dbdbdb;" />
                            <input name="cancel" type="submit" class="on" value="Cancel" style="width:50px; height:20px; font-weight:bold; background:#dbdbdb;" /></td>
                    </tr>
        </tr>
    </table>
</td>
</tr>
</table>
</form>

<form name="formauto22" action="newpayday.php" method="post" id="formauto22">
    <input type="hidden" name="phone" id="phone" class="a1_form" type="text" value="<?php echo $_REQUEST['phone_search'] ?>" />
    <input type="hidden" name="hdnaction" value="" />
    
     <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(../images/auto-bg.jpg) 260px -20px repeat-y;  ">
         <tr><td></td></tr>
     </table>
    
    <table width="100%" border="0" cellpadding="0" cellspacing="0" style="background:url(../images/auto-bg.jpg) 260px -20px repeat-y;  ">
        <tr>
            <td width="4%" >&nbsp;</td>
            <td width="23%" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="">
                    <tr>
                        <td height="20" colspan="2" class="a1"></td>
                    </tr>
                    <tr>
                    </tr>
                    <tr>
                        <td height="20" colspan="2">&nbsp;</td>
                    </tr>      
                    <tr>
                        <td height="20" colspan="2" class="a1_title">&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="20" colspan="2">&nbsp;</td>
                    </tr>
                </table></td>
            <td width="50">&nbsp;</td>
            <td width="66%"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td></td></tr>


                    <tr>
                        <td height="10" colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td height="20" colspan="2" class="a1"><table width="402" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td height="9" colspan="3" background="../images/container-top.gif" style="background-repeat:no-repeat"></td>
                                </tr>
                                <tr>
                                    <td height="30" colspan="3" bgcolor="#d6e1f5"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td height="11" colspan="3"><font  size="2px;"><?= $consumer_err_msg; ?><? echo $phone_err_msg; ?></font></td>
                                            </tr>
                                            <tr>
                                                <td width="23">&nbsp;</td>
                                                <td width="164"><span class="bold">First Name:</span></td>
                                                <td width="215" height="20"><span class="bold">Last Name:</span></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td><input name="fname" id="fname" type="text"  class="a1_form validate[required] text-input" value="<?= $fname; ?>" <? if ($fname_err != "") { ?>style="background-color:#FFCCFF;"
<? } ?>  /></td>
                                                <td height="20"><input   name="lname" id="lname"  class="a1_form validate[required] text-input" value="<?= $lname; ?>"type="text" /></td>
                                            </tr>

                                            <tr>
                                                <td>&nbsp;</td>
                                                <td><span class="bold">Email</span></td>
                                                <td><span class="bold">&nbsp;</span></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <input name="email" id="email" type="text" class="a1_form validate[required,custom[email]] text-input" value="<?= $email; ?>" />
                                                </td>			    <td height="20">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td>&nbsp;</td>
                                                <td><span class="bold">Address</span></td>
                                                <td height="20">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td height="20" colspan="2"><input name="address" id="address" class="a2_form validate[required] text-input" value="<?= $address; ?>" type="text" /></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td height="20" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td width="32%"><span class="bold">City : </span></td>
                                                            <td width="27%"><span class="bold">State</span></td>
                                                            <td width="27%" height="25"><span class="bold">Zip</span></td>

                                                        </tr>
                                                        <tr>
                                                            <td><input name="city" id="city" type="text" class="a1_form validate[required] text-input" value="<?= $city; ?>" style="width:80px;" /></td>
                                                            <td><input name="state" id="state" type="text" class="a1_form validate[required] text-input" value="<?= $state; ?>" style="width:80px;" maxlength="2" /></td>	
                                                            <td><input name="zip" id="zip" type="text" class="a1_form a1_form validate[required,minSize[5]] text-input" value="<?= $zip; ?>" style="width:80px;" maxlength="5" onblur="fetchcity_state(this.id);"/></td>
                                                        </tr>
                                                    </table></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td><span class="bold">SSN </span></td>
                                                <td><span class="bold">UIN</span></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <input name="ssn" id="ssn" type="text" class="a1_form validate[required,minSize[9]] text-input" value="<?= $ssn; ?>" maxlength="9" /><span id="phone_validate"></span>
                                                </td>
                                                <td height="20">

                                                    <input name="uin" id="uin" type="text" class="a1_form validate[required,minSize[9]] text-input" value="<?= $uin; ?>"  /><span id="phone_validate"></span>

                                                </td>
                                            </tr>
                                            <tr><td>&nbsp;</td>
                                                <td height="20" colspan="3" class="bold">What is your date of birth?</td>
                                            </tr>
                                            <tr><td>&nbsp;</td>
                                                <td height="20" colspan="3"><select name="month" class="a1_form validate[required]" style="width:50px">
                                                        <?php //$year_array=date('Y',mktime(0,0,0,0,0,date('Y')-18));
                                                        //print_r($year_array);exit;
                                                        ?> <option value="">MM</option>
                                                        <?
                                                        $month_array = array("01" => "01", "02" => "02", "03" => "03", "04" => "04", "05" => "05", "06" => "06", "07" => "07", "08" => "08", "09" => "09", "10" => "10", "11" => "11", "12" => "12");
                                                        foreach ($month_array as $key => $line) {
                                                            $selected = '';
                                                            if ($key == $month)
                                                                $selected = 'selected';
                                                            echo '<option value="' . $key . '" ' . $selected . '>' . $line . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <select name="day" class="a1_form validate[required]" style="width:50px">
                                                        <option value="">DD</option>
                                                        <?
                                                        $day_array = array("01" => "01", "02" => "02", "03" => "03", "04" => "04", "05" => "05", "06" => "06", "07" => "07", "08" => "08", "09" => "09", "10" => "10", "11" => "11", "12" => "12", "13" => "13", "14" => "14", "15" => "15", "16" => "16", "17" => "17", "18" => "18", "19" => "19", "20" => "20", "21" => "21", "22" => "22", "23" => "23", "24" => "24", "25" => "25", "26" => "26", "27" => "27", "28" => "28", "29" => "29", "30" => "30", "31" => "31");
                                                        foreach ($day_array as $key => $line) {
                                                            $selected = '';
                                                            if ($key == $day)
                                                                $selected = 'selected';
                                                            echo '<option value="' . $key . '" ' . $selected . '>' . $line . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                    <select name="year" class="a1_form validate[required]" style="width:60px">
                                                        <option value="">YYYY</option>
                                                        <?
                                                        $year_array = date('Y', mktime(0, 0, 0, 0, 0, date('Y')));
                                                        print_r($year_array);
                                                        for ($i = $year_array; $i >= 1900; $i--) {
                                                            $selected = '';
                                                            if ($i == $year)
                                                                $selected = 'selected';
                                                            echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                                        }
                                                        ?>
                                                    </select></td>

                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td><span class="bold">Loan Amount</span></td>
                                                <td><span class="bold">&nbsp;</span></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <input type="text" value="" class="a1_form validate[required,custom[email]] text-input" id="loan_amount" name="loan_amount">
                                                </td>			    <td height="20">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td>12 Months</td>
                                                <td><span class="bold">24 Months</span></td>
                                                <td><span class="bold">36 Months</span></td>
                                            </tr>

                                            <tr>
                                                <td>&nbsp;</td>

                                                <td class="bold"><b>Comment:</b></td></tr>
                                            <tr>

                                                <td>&nbsp;</td>
                                                <td><label>
<?php if ($comment == "") { ?>
                                                            <textarea name="comment" id="comment" cols="20" rows="3"></textarea>
<? } else { ?>
                                                            <textarea name="comment" id="comment" cols="20" rows="3"><?php print $comment; ?></textarea>
<? } ?>
                                                    </label></td>
                                            </tr>
                                            <tr><td>&nbsp;</td></tr>
                                            <tr>
                                                <td>&nbsp;</td>

                                                <td height="8"><input name="submitk" type="submit" class="on" value="Submit" style="width:150px; height:40px; font-weight:bold; background:#dbdbdb;" />
                                                </td>
                                            </tr>

                                        </table></td>
                                </tr>
                                <tr>
                                    <td height="10" colspan="3" background="../images/container-btm.gif" style="background-repeat:no-repeat"></td>
                                </tr>
                            </table></td>
                        <td >&nbsp;</td>
                    </tr> 





                </table></td>
        </tr>
    </table></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
</table>
</form>
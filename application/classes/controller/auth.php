<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller_Layout {

    function action_register() {

        #If user already signed-in

        if (Auth::instance()->logged_in() != 0) {
            #redirect to the user account
            Request::instance()->redirect('/welcome/index');
        }
        #Load the view
        $content = $this->template->content = View::factory('auth/register');
        $content->errors = NULL;
        #If there is a post and $_POST is not empty

        if ($_POST) {

            #Instantiate a new user

            $user = ORM::factory('user');



            #Load the validation rules, filters etc...

            $post = $user->validate_create($_POST);



            #If the post data validates using the rules setup in the user model

            if ($post->check()) {

                #Affects the sanitized vars to the user object

                $user->values($post);

                #create the account

                $user->save();

                #Add the login role to the user

                $login_role = new Model_Role(array('name' => 'login'));

                $user->add('roles', $login_role);
                #sign the user in
                Auth::instance()->login($post['username'], $post['password']);
                #redirect to the user account
                Request::instance()->redirect('/');
            } else {

                #Get errors for display in view

                $errors = $_POST->errors('register');

                $err = NULL;

                if (!empty($errors)) {

                    foreach ($errors as $key => $value) {

                        $err .= "<br>" . $value;
                    }
                }

                $content->errors = $err;
            }
        }
    }

    public function action_signin() {


        $styles = array(
            'css/framework.css' => 'screen',
            'css/login.css' => 'screen',
            'css/theme/darkblue.css' => 'screen',
			'css/theme/darkblue.css' => 'screen',
        );

        $scripts = array(
            'js/mobiledevices.js',
			'js/jquery-1.7.2.min.js',
			'js/jquery-ui-1.8.22.min.js',
            'js/jquery.ui.touch-punch.min.js',
            'js/tipsy.js',
            'js/e_styleswitcher.1.0.min.js',
            'js/login.js',
            'js/modernizr.min.js',
        );
        $this->template->styles = array_merge($this->template->styles, $styles);
        $this->template->scripts = array_merge($this->template->scripts, $scripts);

       

        #If there is a post and $_POST is not empty

        if ($_POST) {
		
            #Instantiate a new user
            $user = ORM::factory('user');
            #Check Auth
			
            $status = $user->login($_POST); 
			//echo  Auth::instance()->hash_password($_POST['password']);exit;
			//$status = 1;
			#If the post data validates using the rules setup in the user model
            if ($status) {
                #redirect to the user account
                $myTweets = array(
                    "success" => true, "error" => $errors
                );
                /*echo $myJSONTweets = json_encode($myTweets);
                exit;*/
                Request::current()->redirect('/dashboard');
            } else {
				
                #Get errors for display in view				
				$_POST['errors'] = Array(
                    'success' =>'' ,
                    'error' => 'username or password is wrong..!!',
                    'fail' => '1'
                );
				
                //$content->errors = $_POST['errors'];
                $errors = $_POST['errors'];
				
                $err = NULL;
                /*if (!empty($errors)) {
					
                    foreach ($errors as $key => $value) {
						echo $value;
                        $err .= $value . "<br>";
                    }
                }
				echo $err;exit;	*/
				
                //$content->errors = $errors;
            }
        }
		 #If user already signed-in
		
        if (Auth::instance()->logged_in('', $all_required = false) != 0) {
            #redirect to the user account
            Request::current()->redirect('/dashboard');
        }
		$objCallcenter = ORM::factory('callcenter');
		$callcenterData = $objCallcenter->find_all()->as_array();
        $this->template->set_filename('layout/login');
        $content = $this->template->content = View::factory('welcome/index');
        $content->bind('errors', $errors);
		$content->bind('callcenterData', $callcenterData);
		
		
    }

    public function action_signout() {

        #Sign out the user
        Auth::instance()->logout();
       #redirect to the user account and then the signin page if logout worked as expected
        Request::instance()->redirect('/');
    }

    public function action_forgotpassword() {

        if ($_POST) {

            if (!isset($_POST['username']) || $_POST['username'] == '') {
                Session::instance()->set('error_username_empty', 'Username can\'t be blank');
                Session::instance()->set('from', 'forgotpass');
                $this->request->redirect('auth/signin');
            } else {
                $find_user = DB::select('username', 'email', 'id', 'first_name')->from('users')->where('username', '=', $_POST['username'])->execute()->as_array();
                $new_password = $this->generatePassword();
                $db_password = Auth::instance()->hash_password($new_password);
                if (count($find_user) > 0) {
                    try {
                        $total_rows = DB::update('users')->set(array('password' => $db_password))
                                        ->where('id', '=', $find_user[0]['id'])->execute();
                        Session::instance()->set('sucess_pass_change', 'Password Changed Successfully and mail sent to you');
                        Session::instance()->set('from', 'forgotpass');
                        $this->sendmail($find_user[0]['email'], $find_user[0]['first_name'], $new_password);
                        $this->request->redirect('auth/signin');
                        echo Kohana::debug($total_rows);
                    } catch (Database_Exception $e) {
                        echo $e->getMessage();
                    }
                } else {
                    Session::instance()->set('error_username_empty', 'Username Not Found');
                    Session::instance()->set('from', 'forgotpass');
                    $this->request->redirect('auth/signin');
                }
            }
        }
        #redirect to the user account and then the signin page if logout worked as expected

        Request::instance()->redirect('/');
    }

    public function sendmail($tomail, $toname, $new_password) {

        // multiple recipients
        //$to  = 'aidan@example.com' . ', '; // note the comma
        //$to .= 'wez@example.com';
        // subject
        $subject = 'Forgot Password ';

        // message
        $message = '
            <html>
            <head>
              <title>Forgot Password</title>
            </head>
            <body>
              <p>Hi,' . $toname . '</p><br>
                   <p>your forgot password request has been confirmed , here is your new password : <strong>' . $new_password . '</strong></p><br>
              <p>Regrads,<br>Vemma Line Launch</p>
            </body>
            </html>
            ';

        // To send HTML mail, the Content-type header must be set
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'To: ' . $toname . '<' . $tomail . '>' . "\r\n";
        $headers .= 'From: admin@vemmadev.co.cc</p> <birthday@example.com>' . "\r\n";
        //$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
        //$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
        // Mail it
        if (!mail($tomail, $subject, $message, $headers))
            echo "Mail Not Sent..!";
    }

    public function generatePassword($length=9, $strength=0) {
        $vowels = 'aeuy';
        $consonants = 'bdghjmnpqrstvz';
        if ($strength & 1) {
            $consonants .= 'BDGHJLMNPQRSTVWXZ';
        }
        if ($strength & 2) {
            $vowels .= "AEUY";
        }
        if ($strength & 4) {
            $consonants .= '23456789';
        }
        if ($strength & 8) {
            $consonants .= '@#$%';
        }

        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }
        return $password;
    }

}


<?php


/**
* 
*/

session_start();
header("content-type:application/json");
header("access-allow-control-origin: *");

$api = new API();
$api->login_construct();

class API {
	
	
	const DB_SERVER = 'localhost';
	const DB_USER = 'root';
	const DB_PASSWORD = NULL;
	const DB_NAME = 'pinpoint_prize';
	const TBL_NAME = 'tblUsers';
	
	private $db = NULL;
	
	
public function __construct(){
	
	$_SESSION = array();
	
}

//Call only from login page when logging in or signing up.

public function login_construct() {

	
	if(!isset($_GET['repeat_pass'])) {
		if(isset($_GET['email']) && isset($_GET['password'])){
			if(!empty($_GET['email']) && !empty($_GET['password'])){

				$this->db = new mysqli(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD, self::DB_NAME);
		
				$user = array('email' => $_GET['email'], 'password' => $_GET['password'], "submit" => $_GET['submit']);
	
				$username = stripslashes($user['email']);
				$password = stripslashes($user['password']);

				$username = mysqli_real_escape_string($this->db, $user['email']);
				$password = mysqli_real_escape_string($this->db, $user['password']);
	
				$this->check($user);
	
				}
				else {
	
					$_SESSION['error_msg'] = "Please make sure all fields are entered";
	 
	 				//var_dump(json_encode($_SESSION['error_msg']));
					//header("location:http://localhost/login_signup");
					header("content-type:application/json");
					echo json($_SESSION['error_msg']);

				}
			}
	
		else {
	
			$_SESSION['error_msg'] = "Please make sure all fields are entered";
	 
	 		//var_dump(json_encode($_SESSION['error_msg']));
			//header("location:http://localhost/login_signup");
			header("content-type:application/json");
			echo json($_SESSION['error_msg']);
	}
	
}
	else {
		if(isset($_GET['email']) && isset($_GET['password']) && isset($_GET['repeat_pass'])){
			if(!empty($_GET['email']) && !empty($_GET['password']) && !empty($_GET['repeat_pass'])){

				$this->db = new mysqli(self::DB_SERVER, self::DB_USER, self::DB_PASSWORD, self::DB_NAME);
		
				$user = array('email' => $_GET['email'], 'password' => $_GET['password'], 'repeat_pass' => $_GET['repeat_pass'],  "submit" => $_GET['submit']);
	
				$username = stripslashes($user['email']);
				$password = stripslashes($user['password']);
				$repeat = stripslashes($user['repeat_pass']);

				$username = mysqli_real_escape_string($this->db, $user['email']);
				$password = mysqli_real_escape_string($this->db, $user['password']);
				$repeat = mysqli_real_escape_string($this->db, $user['repeat_pass']);
				
	
				$this->check($user);
	
			}
			else {
	
			$_SESSION['error_msg'] = "Please make sure all fields are entered";
	 
	 		//var_dump(json_encode($_SESSION['error_msg']));
			//header("location:http://localhost/login_signup");
			header("content-type:application/json");
			echo json($_SESSION['error_msg']);
			
			}
		}
		else {
	
			$_SESSION['error_msg'] = "Please make sure all fields are entered";
	 
	 		//var_dump(json_encode($_SESSION['error_msg']));
			//header("location:http://localhost/login_signup");
			header("content-type:application/json");
			echo json($_SESSION['error_msg']);
			
		}
	}
}

private function check($user){
		switch($user['submit']){
	
			case 'Sign Up':	$this::signup($user['email'], $user['password'], $user['repeat_pass']);
 							break;
			case 'Login': 	$this::login($user['email'], $user['password']);
							break;
	
		}
}
	/*public function processAPI(){

		$func = strtolower(trim(str_replace('/', '', $_REQUEST['request'])));
		if ((int)method_exists($this, $func) > 0) {
			# code...
			$this -> $func;
		}
		else {
			$this -> response('', 404);
		}



	}
	*/
	
private function signup($email, $password, $repeat_pass){
	
			//Signup
			$cost = 10;

			// Create a salt
			$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

			// Prefix information about the hash so PHP knows how to verify it later.
			$salt = sprintf("$2y$%02d$", $cost) . $salt;

			// Hash the password with the salt
			$hash = crypt($password, $salt);
	
	
			$rep_cost = 10;

			// Create a salt
			$rep_salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

			// Prefix information about the hash so PHP knows how to verify it later.
			$rep_salt = sprintf("$2y$%02d$", $cost) . $salt;

			// Hash the password with the salt
			$rep_hash = crypt($repeat_pass, $salt);
		
			if(hash_equals($hash, $rep_hash) === true){
	
				$new_user = $this->db->prepare("INSERT INTO " .self::TBL_NAME. " (email, password, confirm) VALUES (?, ?, FALSE);");
				//var_dump($this->db);
				$type = 'ss';
				$new_user->bind_param($type, $email, $hash);
				$new_user->execute();					
				
					if($new_user->errno > 0){
	
						//echo $this->db->error;
		
						if($new_user->errno == 1062){
							json("Sorry that username is taken");
		
							}
						}
	
					else {
				
						if($this->isAjax()) {
							$loc = array("location" => "http://localhost/login_signup/signup_success.php");
							json($loc);
					
        			
    				}
    					else {
        					header("Location: index.php");
    			}
    
    		$_SESSION['user'] = "Welcome";

		}
	}
	
		else {
			$_SESSION['error_msg'] = 'Your passwords did not match. <strong>Please try again.<strong>';
			json($_SESSION['error_msg']);	
	}
}

//End of signup
		
	
	

	
private function login($email, $password){
	
		$user_query = $this->db->prepare("SELECT * FROM tblUsers WHERE email=?;");
		$types = 's';
		$user_query->bind_param($types, $email);
		$user_query->execute();
		
		$send_user = $user_query->get_result();
		
		if($send_user != NULL){
			
				if($send_user->num_rows === 1){
				$send_user = $send_user->fetch_object();
					$expected = trim($send_user->password);
					$correct = trim(crypt($password, $send_user->password));

					if (hash_equals($expected, $correct) === true) {
  					// Ok!
		
						if($send_user->confirm == true){
							$_SESSION['json'] = json_encode($send_user);
							$_SESSION['user'] = "Welcome Back";

								if(isset($_SESSION['json'])){
									if($this->isAjax()) {
										$_SESSION['uid'] = $send_user->id;
										$loc = array("location" => "http://localhost/login_signup/login_success.php");
										json($loc);

        			
    								} 
    								else {
    									$_SESSION['uid'] = $send_user->id;
       		 							header("Location: index.php");
    				 	}
					}	
				}
				else {
						$_SESSION['error_msg'] = "Please activate your account via the <strong>email<strong> that was sent to you.</strong>";
						json($_SESSION['error_msg']);
				}
			}
		
					else {
						//Code if fail
						header("content-type:application/json");

						$_SESSION['error_msg'] = "Incorrect email or password. <strong>Please try again<strong>";
						json($_SESSION['error_msg']);
		}
	}
	else {
		$_SESSION['error_msg'] = "Incorrect email or password. <strong>Please try again<strong>";
		json($_SESSION['error_msg']);
	}
}
	
	
		else {
			$_SESSION['error_msg'] = "Incorrect email or password. <strong>Please try again<strong>";
			json($_SESSION['error_msg']);
	
		}
	}

	
private function isAjax() {
        
        	return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
   		}
	}

 //End of API class
	 
		function json($data) {
		
			# code...
			//echo "<pre>", var_dump($data), "</pre>";
			echo json_encode($data);
		
	}
	
?>
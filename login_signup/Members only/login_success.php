<?php
session_start();
if (!$_SESSION['user']) {
	# code..
	header('location: http://localhost/login_signup');

}



?>
<html>
<body>Login Successful

	<?php //echo "<pre>", $_SESSION['json'] ,"</pre>";
			echo json_encode($_SESSION['user']); ?>
</body>
</html>
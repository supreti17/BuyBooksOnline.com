<?php

$action = filter_input(INPUT_POST, 'action');

require ('php/connection.php');

$login_error = "";

switch ($action) {
	case 'sign_in_form':
		$username = filter_input(INPUT_POST, 'username');
		$password = filter_input(INPUT_POST, 'password');
		$checkUser($username, $password);
//		header('Location: index.php');
//		exit();
		break;

	case 'sign_out':
		header('Location: index.php');
		exit();
		break;

	case 'sign_up_form':
		header('Location: index.php');
		exit();
		break;
	
	default:
		header('Location: signin.php');
		exit();
		break;
}

function checkUser($username, $password) {
	$sql = "SELECT id, username, password FROM Users
			WHERE username=$username AND password=$password";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		header('Location: index.php');
		exit();
	} else {
		global $login_error;
		$login_error = "Incorrect username or password! Please try again!";
	}
}


?>
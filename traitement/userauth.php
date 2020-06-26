<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();
require_once('../lib/otphp.php');

function ret($success, $error)
{
	die(json_encode([
		'success' => $success,
		'error' => $error
	], JSON_PRETTY_PRINT));
}

function exist($user)
{
	return (strtolower($user) === 'arthur');
}

function checkpw($password, $user)
{
	$fakeuser = ['arthur' => "test"];
	if (isset($fakeuser[$user])) {
		return $fakeuser[$user] == $password;
	} else {
		return false;
	}
}

if (!isset($_POST['action']))
	die(json_encode([
		'success' => false,
		'error' => 'no action'
	], JSON_PRETTY_PRINT));

// * Login

if ($_POST['action'] === 'login') {
	if (!isset($_POST['usr']))
		ret(false, 'no username');


	if (!isset($_POST['pwd']))
		ret(false, 'no password');


	if (!isset($_POST['ota']))
		ret(false, 'no token');


	if (exist($_POST['usr'])) {

		$_SESSION['user'] = $_POST['usr'];
		$_SESSION['page'] = $title = 'user';

		if (checkpw($_POST['pwd'], $_POST['usr'])) {
			$_SESSION["password"] = Base32::encode($_POST['pwd']);
			$_SESSION["password"] = 'SECRETTT';

			$delay = 0;  // (en secondes)
			date_default_timezone_set('Europe/Paris');
			$now = time() + $delay;
			require_once('../lib/otphp.php');
			$totp = new \OTPHP\TOTP($_SESSION['password'], array('interval' => 30));
			$ota = $totp->at($now);


			if ($_POST['ota'] != $ota) {
				unset($_SESSION['user']);
				unset($_SESSION['password']);
				unset($_SESSION['page']);
				ret(false, 'Wrong token' . $ota);
			}
			$_SESSION["password"] = Base32::encode($_POST['pwd']);
		} else {
			unset($_SESSION['user']);
			unset($_SESSION['page']);
			ret(false, 'Wrong password');
		}
	} else {

		ret(false, 'Wrong username');
	}


	$_SESSION['page'] = $title = 'user';

	ret(true, 'Successfully logged in');
}

// * Logout
if ($_POST['action'] === 'logout') {
	unset($_SESSION['user']);
	unset($_SESSION['password']);
	unset($_SESSION['page']);
	ret(true, 'Successfully logged out');
}

// ldapsearch   -x -h adserver.domain.int -D "user@domain.int" -W -b "cn=users,dc=domain,dc=int" 
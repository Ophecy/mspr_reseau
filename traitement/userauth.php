<?php
if (session_status() != PHP_SESSION_ACTIVE) session_start();

if (!isset($_POST['action']))
	die(json_encode([
		'success' => false,
		'error' => 'no action'
	], JSON_PRETTY_PRINT));

// * Login

if ($_POST['action'] === 'login') {
	if (!isset($_POST['usr']))
		die(json_encode([
			'success' => false,
			'error' => 'no username'
		], JSON_PRETTY_PRINT));

	if (!isset($_POST['pwd']))
		die(json_encode([
			'success' => false,
			'error' => 'no password'
		], JSON_PRETTY_PRINT));

	if (!isset($_POST['ota']))
		die(json_encode([
			'success' => false,
			'error' => 'no token'
		], JSON_PRETTY_PRINT));

	// TODO: implementer login

	$_SESSION['page'] = $title = 'user';
	$_SESSION['user'] = "arthur";
	$_SESSION['password'] = "SECRETTT";
	die(json_encode([
		'success' => true,
		'error' => 'Successfully logged in'
	], JSON_PRETTY_PRINT));
}

// * Logout
if ($_POST['action'] === 'logout') {
	unset($_SESSION['user']);
	unset($_SESSION['page']);

	die(json_encode([
		'success' => true,
		'error' => 'Successfully logged out'
	], JSON_PRETTY_PRINT));
}

// ldapsearch   -x -h adserver.domain.int -D "user@domain.int" -W -b "cn=users,dc=domain,dc=int" 
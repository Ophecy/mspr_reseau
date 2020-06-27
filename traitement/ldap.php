<?php
$server = "172.31.1.1/1";
$port = "389";
$racine = "o=portail.chatelet, c=lab";
$rootdn = "cn=Administrateur, o=MSPR.portail.chatelet, c=lab";
$rootpw = "Azerty123";

// try {
// 	$ds = ldap_connect("LDAP://$server:$port");
// } catch (\Throwable $th) {
// 	echo "Impossible de se connecter au serveur LDAP : ";
// 	echo "<pre>";
// 	var_dump($th);
// 	die("</pre>");
// }

// if ($ds == 1) {
// 	// on s'authentifie en tant que super-utilisateur, ici, ldap_admin
// 	$r = ldap_bind($ds, $rootdn, $rootpw);
// 	echo "ldap connecté <br><pre>";
// 	var_dump($r);
// 	echo "</pre>";
// 	ldap_close($ds);
// } else {
// 	echo "Impossible de se connecter au serveur LDAP";
// }


if ((isset($_POST['username']) && isset($_POST['password'])) || true) {

	$adServer = "LDAP://$server:$port";

	$ldap = ldap_connect($adServer);
	$username = "fmacon";
	$password = "Azerty123";

	$ldaprdn = 'portail.chatelet' . "\\" . $username;

	ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

	$bind = @ldap_bind($ldap, $ldaprdn, $password);

	if ($bind) {
		$filter = "(sAMAccountName=$username)";
		$result = ldap_search($ldap, $rootdn, $filter);
		ldap_sort($ldap, $result, "sn");
		$info = ldap_get_entries($ldap, $result);
		for ($i = 0; $i < $info["count"]; $i++) {
			if ($info['count'] > 1)
				break;
			echo "<p>You are accessing <strong> " . $info[$i]["sn"][0] . ", " . $info[$i]["givenname"][0] . "</strong><br /> (" . $info[$i]["samaccountname"][0] . ")</p>\n";
			echo '<pre>';
			var_dump($info);
			echo '</pre>';
			$userDn = $info[$i]["distinguishedname"][0];
		}
		@ldap_close($ldap);
	} else {
		$msg = "Invalid email address / password ($username:$password)";
		echo $msg;
	}
}

<?php
$server = "172.31.1.1/1";
$port = "389";
$racine = "o=portail.chatelet, c=lab";
$rootdn = "cn=Administrateur, o=portail.chatelet, c=lab";
$rootpw = "Azerty123";

try {
	$ds = ldap_connect($server);
} catch (\Throwable $th) {
	echo "Impossible de se connecter au serveur LDAP : ";
	echo "<pre>";
	var_dump($th);
	echo "</pre>";
}

if ($ds == 1) {
	// on s'authentifie en tant que super-utilisateur, ici, ldap_admin
	$r = ldap_bind($ds, $rootdn, $rootpw);
	echo "<pre>";
	var_dump($r);
	echo "</pre>";
	ldap_close($ds);
} else {
	echo "Impossible de se connecter au serveur LDAP";
}

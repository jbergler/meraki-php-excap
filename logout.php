<?php
	$logoutUrl = "http://www.google.com/";
	if (isset($_COOKIE['LogoutURL'])) {
		$logoutUrl = urldecode($_COOKIE['LogoutURL']) . "&continue=" . urlencode("http://splash.jb.net.nz/test.php");

		//Empty cookie, and expire one hour ago so client removes it
		unset($_COOKIE['LogoutURL']);
		setcookie("LogoutURL", "", time()-3600);
	}
	header("Location: {$logoutUrl}");


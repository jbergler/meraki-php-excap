<?php
	//Default redirect in case we don't have a cookie with a logout url
	$logoutUrl = "http://www.google.com/";

	//URL for after the logout is complete
	$continueUrl = "http://" . $_SERVER['SERVER_NAME'] . "/logged-out.php" ;

	if (isset($_COOKIE['LogoutURL'])) {
		$logoutUrl = urldecode($_COOKIE['LogoutURL']) . "&continue_url=" . urlencode($continueUrl);

		//Empty cookie, and expire one hour ago so client removes it
		unset($_COOKIE['LogoutURL']);
		setcookie("LogoutURL", "", time()-3600);
	}

	header("Location: {$logoutUrl}");


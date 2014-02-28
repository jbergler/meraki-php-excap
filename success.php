<?php

$logoutUrl = urldecode($_REQUEST['logout_url']);
$nextUrl = urldecode($_REQUEST['continue']);

setcookie("LogoutURL", $logoutUrl, 0);

if (preg_match("/^http:\/\/", $nextUrl)) {
	header("Location: {$nextUrl}");
	echo "You are being redirected to: {$nextUrl}";
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Login Successful</title>

	<script type="text/javascript" src="assets/jquery-2.1.0.min.js"></script>
	<link rel="stylesheet" href="assets/bootstrap.min.css">
	<link rel="stylesheet" href="assets/style.css">
</head>
<body>
	<div class="container">
		<h2>You are now logged in!</h2>
		<h4>Want to <a href="<?= $logoutUrl ?>">logout?</a></h4>
	</div>
</body>
</html>

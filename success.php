<?php

$logoutUrl = urldecode($_REQUEST['logout_url']);
$nextUrl = urldecode($_REQUEST['continue']);

setcookie("LogoutURL", $logoutUrl, 0);
header("Location: {$nextUrl}");

<?php
	// What is the request state?
	$isLoginRequest = isset($_REQUEST['ap_mac']);
	$isLoginError = isset($_REQUEST['error_message']);
	$isLoggedIn = isset($_COOKIE['LogoutURL']);

	// Lets get the values from the query parameters
	$data = array();

	// Location of the splash
	$data['rootUrl'] = "http://" . $_SERVER['SERVER_NAME'];

	if ($isLoginRequest) {
		// URLs
		$data['loginUrl'] = urldecode($_REQUEST['login_url']);
		$data['nextUrl'] = urldecode($_REQUEST['continue']);

		// Access Point Info
		$data['ap']['mac'] = $_REQUEST['ap_mac'];
		$data['ap']['name'] = $_REQUEST['ap_name'];
		$data['ap']['tags'] = explode(" ", $_REQUEST['ap_tags']);

		// Client Info
		$data['client']['mac'] = $_REQUEST['client_mac'];
	}

	if ($isLoginError) {
		// Error Message
		$data['errorMessage'] = $_REQUEST['error_message'];
	}

	if ($isLoggedIn) {
		// Get the logout URL from the cookie
		$data['logoutUrl'] = urldecode($_COOKIE['LogoutURL']);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Splash Page Test</title>

	<script type="text/javascript" src="assets/jquery-2.1.0.min.js"></script>
	<link rel="stylesheet" href="assets/bootstrap.min.css">
	<link rel="stylesheet" href="assets/style.css">
</head>
<body>
	<div class="container">
		<form class="form-signin" role="form" method="POST" action="<?= $data['loginUrl']; ?>#">
			<?php if ($isLoginRequest) { ?>
				<h2 class="form-signin-heading">Demo Splash Page</h2>
				<h4><?= $data['ap']['name']; ?></h4>

				<?php if ($isLoginError) { ?>
					<div class="alert alert-danger"><?= $data['errorMessage'] ?></div>
				<?php } ?>

				<input type="text" name="username" class="form-control" placeholder="Username" required autofocus value="<?= $_REQUEST['username'] ?>">
				<input type="password" name="password" class="form-control" placeholder="Password" required>
				<input type="hidden" name="success_url" value="<?= $data['rootUrl'] ?>/success.php<?php if ($data['nextUrl']) { echo "?continue=" . urlencode($data['nextUrl']); }?>" />
				<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>

				<br/>

				<h4>Example Users</h4>
				<button type="button" class="btn btn-l btn-info btn-block" type="submit" onclick="javascript:setUser('gptest1', 'testing');">gp: radius-test-1</button>
				<button type="button" class="btn btn-l btn-info btn-block" type="submit" onclick="javascript:setUser('gptest2', 'testing');">gp: radius-test-2</button>
				<button type="button" class="btn btn-l btn-warning btn-block" type="submit" onclick="javascript:setUser('denyme', 'testing');">deny</button>

				<br/>

				<button type="button" class="btn btn-xs btn-danger btn-block" type="submit" onclick="javascript:$('#debug').show();$(this).hide();">Show Debug</button>
			<?php } else  if ($isLoggedIn) { ?>
				<div class="alert alert-info">Already logged in? <a href="/logout.php">Logout</a></div>
			<?php } else { ?>
				<div class="alert alert-danger">Hmmm... not sure what you're doing here...</div>
			<?php } ?>
		</form>

		<script>
			function setUser(username, password) {
				$('input[name=username]').val(username);
				$('input[name=password]').val(password);
			}
		</script>
		<pre id='debug' style="display: none"><?php var_dump($data); ?></pre>
	</div>
</body>
</html>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login/Registration</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
</head>
<body>
	<form class="box" action="login_user" method="post">
		<h1>Log In</h1>
<?php 		if(!empty($login_error)) { ?>
			<p class="red"><?php echo $login_error ?></p>
<?php		} ?>
		<p>Email: <input type="text" name="email" placeholder="xyz@example.com"></p>
		<p>Password: <input type="password" name="password"></p>
		<input type="submit" name="login" value="Login">
	</form>
	<form class="box" action="register_user" method="post">
		<h1>Register</h1>
<?php 		if(!empty($this->session->flashdata('errors'))) { ?>
			<p class="red"><?php echo $this->session->flashdata('errors'); ?></p>
<?php		} ?>
		<p>First Name: <input type="text" name="first_name" placeholder="First Name"></p>
		<p>Last Name: <input type="text" name="last_name" placeholder="Last Name"></p>
		<p>Email Address: <input type="text" name="email" placeholder="xyz@yexample.com"></p>
		<p>Password: <input type="password" name="password"></p>
		<p>Confirm Password: <input type="password" name="password2"></p>
		<input class="btn btn-primary" type="submit" name="register" value="Register">
	</form>
</body>
</html>


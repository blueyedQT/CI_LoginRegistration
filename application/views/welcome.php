<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
</head>
<body>
	<div class="box">
		<a class="right" href="logout">Logout</a>
		<h1>Welcome <?php echo $user['first_name'] ?></h1>
		<p>First Name: <?php echo $user['first_name'] ?></p>
		<p>Last Name: <?php echo $user['last_name'] ?></p>
		<p>Email Address: <?php echo $user['email'] ?></p>
	</div>
</body>
</html>
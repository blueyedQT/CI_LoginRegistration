<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
</head>
<body>
	<h1 class="col-md-4">Welcome <?php echo $user['first_name'] ?></h1>
	<a class="col-md-5" href="logout">Logout</a>
	<div class="box">
		<p>First Name: <?php echo $user['first_name'] ?></p>
		<p>Last Name: <?php echo $user['last_name'] ?></p>
		<p>Email Address: <?php echo $user['email'] ?></p>
	</div>
</body>
</html>
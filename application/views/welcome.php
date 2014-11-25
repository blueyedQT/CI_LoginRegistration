<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
</head>
<body>
	<?php var_dump($this->session->all_userdata()); ?>
	<h1>Welcome <?php echo $this->session->userdata['user'] ?></h1>
	<a href="#">Logout</a>
	<div class="box">
		<p>First Name: (Name)</p>
		<p>Last Name: (Name)</p>
		<p>Email Address: (email)</p>
	</div>
</body>
</html>
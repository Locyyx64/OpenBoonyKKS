<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "head_mutual.php" ?>
	<link rel="stylesheet" href="../scss-css/style.css">
        <title>Welcome</title>
</head>
<body>
	<?php include "connection.php" ?>
	<?php include "functions.php" ?>
	<?php 
		addUsers();	
	?>
	<script src="../javascript/home.js"></script>
</body>
</html>

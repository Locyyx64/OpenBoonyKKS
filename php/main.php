<?php ob_start() ?>
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "head_mutual.php" ?>
	<meta name="robots" content="index, follow">
	<link rel="stylesheet" href="../scss-css/style_home.css?v=<?php echo time(); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,100;1,300;1,400&display=swap" rel="stylesheet">
	<script src="../engine/jquery-3.6.0.min.js"></script> 
       	<title>OpenBoonyKKS</title>
</head>
<body>
	<?php include "mutual.php" ?>

	<?php echo "<p id='greetings'>Welcome, ".$username."!"; ?>
	<main>	
		<div id="title">
			<h2>Technology News</h2>
			<hr>
		</div>
	</main>
	<!--Time Displayer-->
	<div id="timeDiv">
		<p class="time" id="date" ></p>
		<p class="time" id="time" ></p>
	</div>

	<!--Player with the Highest Point Number-->
	<?php 
		$all_points = "SELECT MAX(PointCount) AS LargestPoint FROM Users";
		$all_points_query = mysqli_query($connection, $all_points);
		$largest = mysqli_fetch_assoc($all_points_query);
		$highest_point = $largest["LargestPoint"];
		$highest_achiever = "SELECT * FROM Users ";
		$highest_achiever .= "WHERE PointCount=$highest_point";
		$highest_achiever_query = mysqli_query($connection, $highest_achiever);
		while($row = mysqli_fetch_assoc($highest_achiever_query)){
			$highest_username = $row["Username"];
			$highest_ppic = $row["ProfilePicture"];
		}
	?>
	<div id="best_achiever">
		<p id="highest_title">The point master:</p>
		<div id="inner_achiever">
			<div id="name_points">
				<p id="uname"><?php echo $highest_username ?></p>
				<p id="points"><?php echo $highest_point ?></p>
			</div>
			<img src="../<?php echo $highest_ppic ?>" title="Profile Picture of <?php echo $highest_username ?>" id="highest_ppic">
		</div>
	</div>

	<!--Mostly bought Product-->
	<div id="famous_product">
	</div>

	<!--Crypto Tracker-->
	<div id="widgets">
		<div id="cryptos">
			<input type="text" id="cryptoInput" placeholder="Add a cryptocurrency">
			<ul>
			</ul>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			$("#timeDiv").delay(500).animate({opacity: "1", right: "3%"});
		});
	</script>
	<script src="../javascript/crypto.js"></script>
	<script src="../javascript/animation.js"></script>
	<script src="../javascript/dropdown.js"></script>
	<script src="../javascript/timer.js"></script>
</body>

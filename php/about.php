<?php ob_start() ?>
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "head_mutual.php" ?>
	<link rel="stylesheet" href="../scss-css/about.css?v=<?php echo time(); ?>">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,100;1,300;1
,400&display=swap" rel="stylesheet">
        <script src="../engine/jquery-3.6.0.min.js"></script>
        <title>About Us</title>

</head>
<body>
	<?php include "mutual.php" ?>

	<main>
		<video id="intro" controls>
			<source src="" type="video/mp4">
		</video>
		<div id="descriptionText">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Pretium nibh ipsum consequat nisl. Dictum non consectetur a erat nam at lectus. Pulvinar mattis nunc sed blandit libero. Vestibulum morbi blandit cursus risus at ultrices mi tempus. Pulvinar etiam non quam lacus suspendisse. Eu feugiat pretium nibh ipsum consequat nisl vel pretium. Et malesuada fames ac turpis egestas. Tincidunt augue interdum velit euismod. Non odio euismod lacinia at quis risus sed. Quam elementum pulvinar etiam non quam lacus suspendisse faucibus. Suspendisse sed nisi lacus sed viverra tellus in. Porta nibh venenatis cras sed felis. Nulla facilisi etiam dignissim diam quis enim lobortis scelerisque fermentum. Sed faucibus turpis in eu mi bibendum. Mauris vitae ultricies leo integer malesuada nunc. Id velit ut tortor pretium viverra. Id donec ultrices tincidunt arcu non sodales. Morbi tristique senectus et netus. Mi ipsum faucibus vitae aliquet nec ullamcorper sit amet.</p>
		</div>
	</main>

	<script src="../javascript/animation.js"></script>
	<script src="../javascript/dropdown.js"></script>
</body>
</html>


<?php ob_start() ?>
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "head_mutual.php" ?>
	<link rel="stylesheet" href="../scss-css/style_products.css?v=<?php echo time(); ?>">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,100;1,300;1,400&display=swap" rel="stylesheet">
        <script src="../engine/jquery-3.6.0.min.js"></script>
	<title>Products</title>
</head>
<body>
	<?php
		if(isset($_GET["prod_id"])){
			include "product_info.php";
		}
		elseif(isset($_GET["prod_buy_id"])){
			include "product_buy.php";
		}
		else{
			include "products_list.php";
		}
		
	?>
	<script src="../javascript/animation.js"></script>
        <script src="../javascript/dropdown.js"></script>
</body>

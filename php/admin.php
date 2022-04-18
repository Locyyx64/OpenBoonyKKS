<?php ob_start() ?>
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "head_mutual.php" ?>
	<link rel="stylesheet" href="../scss-css/style_admin.css?v=<?php echo time(); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,100;1,300;1,400&display=swap" rel="stylesheet">
        <script src="../engine/jquery-3.6.0.min.js"></script>
        <title>Products</title>
</head>
<body>
	<?php include "mutual.php" ?>

	<!--Admin Site List-->
	<div id="navbar-admin">
		<ul>
			<li><a href="admin.php?source=manage_products">Manage Products</a></li>
			<li><a href="admin.php?source=add_product">Add Product</a></li>
			<li><a href="admin.php?source=recently_sold">Recently Sold Products</a></li>
			<li><a href="admin.php?source=manage_users">Manage Users</a></li>
			<li><a href="admin.php?source=add_user">Add User</a></li>
			<li><a href="">N/A</a></li>
		</ul>
	</div>

	<?php 
		if(isset($_GET["source"])){
			$source = $_GET["source"];
		} else{
			$source = "";
		}

		switch($source){
			case "add_product":
				include "add_product.php";
				break;
			case "manage_products":
				include "manage_products.php";
				break;
			case "recently_sold":
				include "recently_sold.php";
				break;
			case "manage_users":
				include "manage_users.php";
				break;
			case "add_user":
				include "add_user.php";
				break;
			default:
				include "manage_products.php";
				break;
		}

	?>

	<script src="../javascript/animation.js"></script>
	<script src="../javascript/dropdown.js"></script>
</body>

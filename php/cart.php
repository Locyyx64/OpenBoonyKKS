<?php ob_start() ?>
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
        <?php include "head_mutual.php" ?>
        <link rel="stylesheet" href="../scss-css/style_cart.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="../scss-css/style_productlist.css?v=<?php echo time() ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,100;1,300;1,400&display=swap" rel="stylesheet">
        <script src="../engine/jquery-3.6.0.min.js"></script>
        <title>Your Cart</title>
</head>
<body>
	<?php include "mutual.php" ?>

	<main>
		<div id="productsShow">
			<h1>Your Cherished Products: </h1>
			<table id="products-list">
				<thead>
					<th>Product Picture</th>
					<th>Product Name</th>
					<th>Product Price</th>
					<th>Product Publisher</th>
					<th>Publish Date</th>
					<th>Product ID</th>					
				</thead>
				<tbody>
					<?php 
						$chosen_ids = explode(" ", $current_cart);
						for ($i = 1; $i < count($chosen_ids); $i++){
							$get_chosen_prod = "SELECT * FROM Products ";
							$get_chosen_prod .= "WHERE ProductID={$chosen_ids[$i]}";
							$get_chosen_prod_q = mysqli_query($connection, $get_chosen_prod);
							checkQuery($get_chosen_prod_q, "fetch the data for product id {$chosen_ids[$i]}");

							while($row = mysqli_fetch_assoc($get_chosen_prod_q)){
								$product_name = $row["ProductName"];
								$product_picture = $row["ProductPicture"];
								$product_price = $row["ProductPrice"];
								$product_author = $row["ProductSource"];
								$product_publish_date = $row["ProductDate"];
							}

							$msg = "<tr>\n";
							$msg .= "<td><img src='../images/{$product_picture}' alt='Product with ID {$chosen_ids[$i]}' class='product-images'></td>\n";
							$msg .= "<td>{$product_name}</td>\n";
							$msg .= "<td>{$product_price}</td>\n";
							$msg .= "<td>{$product_author}</td>\n";
							$msg .= "<td>{$product_publish_date}</td>\n";
							$msg .= "<td>{$chosen_ids[$i]}</td>\n";
							$msg .= "</tr>";

							echo $msg;
						}
					?>
				</tbody>
			</table>
		</div>
	</main>
	
	<script src="../javascript/animation.js"></script>
	<script src="../javascript/dropdown.js"></script>
</body>

<?php ob_start() ?>
<?php session_start() ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "head_mutual.php" ?>
	<link rel="stylesheet" href="../scss-css/style_account.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" href="../scss-css/style_productlist.css?v=<?php echo time(); ?>">
	<link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;1,100;1,300;1
,400&display=swap" rel="stylesheet">
        <script src="../engine/jquery-3.6.0.min.js"></script>
        <title>Ongoing Purchases</title>

</head>
<body>
	<?php include "mutual.php" ?>


	<table id="products-list">
		<thead>
			<th>Product Picture</th>
                        <th><a href="purchases.php?sort=ProductName">Product Name</a></th>
                        <th><a href="purchases.php?sort=ProductPrice">Product Price</a></th>
                        <th><a href="purchases.php?sort=ProductSource">Product Publisher</a></th>
                        <th><a href="purchases.php?sort=ProductDate">Publish Date</a></th>
                        <th><a href="purchases.php?sort=ProductID">Product ID</a></th>
		</thead>
		<tbody>
			<?php
				$products_per_page = 20;
				$page = getPage();
				$sort = getSort();
				$limit = getLimit($products_per_page, $page);

				$condition = "OngoingBuyer='$username'";

				getProductsBy($condition, $limit, $sort);
			?>
		</tbody>
	</table>

	<!--Pagination-->
	<div id="page-nav">
		<ul>
			<?php
				for ($i = 1; $i <= ceil(getNumOfProds($condition) / $products_per_page); $i++){
					if ($i == $page){
						echo "<li><a id='page-selected' href='products.php?page=$i'>$i</a></li>";
					} else{
						echo "<li><a href='products.php?page=$i'>$i</a></li>";
					}
				}
			?>
		</ul>
	</div>

	<script src="../javascript/animation.js"></script>
	<script src="../javascript/dropdown.js"></script>
</body>
</html>

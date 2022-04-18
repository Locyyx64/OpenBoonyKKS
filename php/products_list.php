 <?php include "mutual.php" ?>

<table id="products-list">
	<thead>
		<tr>
			<th>Product Picture</th>
			<th><a href="products.php?sort=ProductName">Product Name</a></th>
			<th><a href="products.php?sort=ProductPrice">Product Price</a></th>
			<th><a href="products.php?sort=ProductSource">Product Publisher</a></th>
			<th><a href="products.php?sort=ProductDate">Publish Date</a></th>
			<th><a href="products.php?sort=ProductID">Product ID</a></th>
		</tr>
	</thead>
	<tbody>
		<?php
			$products_per_page = 20;
			$page = getPage();
			$sort = getSort();
			$limit = getLimit($products_per_page, $page);

			$condition = "ProductBuyer IS NULL";

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

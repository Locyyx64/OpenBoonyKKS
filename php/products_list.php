<?php include "mutual.php" ?>
<script src="../javascript/search_products.js"></script>

<form action="products.php" method="get" id="searchProduct" name="searchProduct">
	<label for="searchInput"><img src="../images/static/search.png" id="searchImg"></label>
	<input type="text" name="q" placeholder="Search" id="searchInput">
</form>
<ul id="searchDropdown">
</ul>

<?php 
	foreach(getAllNames() as $name => $id){
		echo "<script>all_names['$name'] = $id</script>";
	}
?>
<script>
	search_drop(all_names);
</script>

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
			if(!isset($_GET["q"])){
				$condition = "ProductBuyer IS NULL";
			} else{
				$search_for = $_GET["q"];
				$condition = "ProductName LIKE '%{$search_for}%'";
			}
				getProductsBy($condition, $limit, $sort);
		?>
		<tr>
		<!--Pagination-->
			<td colspan=6 id="pagination">
				<div id="page-nav">
					<ul>
						<?php
							$iter_num = ceil(getNumOfTable("Products", $condition) / $products_per_page);
							
							if($iter_num > 1){
								for ($i = 1; $i <= $iter_num; $i++){
									if ($i == $page){
										echo "<li><a id='page-selected' href='products.php?page=$i'>$i</a></li>";
									} else{
										echo "<li><a href='products.php?page=$i'>$i</a></li>";
									}
								}
							}
						?>
					</ul>
				</div>
			</td>
		</tr>
	</tbody>
</table>

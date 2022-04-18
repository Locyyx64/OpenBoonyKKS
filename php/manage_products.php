	<?php 
		if(isset($_GET["id"])){
			$product_id = $_GET["id"];
			$delete = "DELETE FROM Products WHERE ProductID=$product_id";
			$delete_query = mysqli_query($connection, $delete);
			if(!$delete_query){
				die("Product Deletion Failed: ".mysqli_errno($connection));
			}
			header("Location: admin.php?source=manage_products");
		}
	?>	
	


	<table id="products-table">
                <thead>
                        <tr>
                                <th>Product Picture</th>
				<th><a href="admin.php?source=manage_products&sort=ProductName">Product Name</a></th>
                                <th><a href="admin.php?source=manage_products&sort=ProductPrice">Product Price</a></th>
                                <th><a href="admin.php?source=manage_products&sort=ProductSource">Product Publisher</a></th>
                                <th><a href="admin.php?source=manage_products&sort=ProductDate">Publish Date</a></th>
				<th><a href="admin.php?source=manage_products&sort=ProductID">Product ID</a></th>
				<th>----</th>
                        </tr>
                </thead>
                <tbody>
			<?php
				if(isset($_GET["page"])){
					$page = $_GET["page"];
				} else{
					$page = 1;
				}

				$products_per_page = 8;
				
				if($page === 1){
					$limit = "LIMIT $products_per_page";
				} else{
					$start_from = ($products_per_page * $page) - $products_per_page;
					$end_at = $products_per_page;
					$limit = "LIMIT $start_from, $end_at";
				}



                                if (isset($_GET["sort"])){
                                        $sort = $_GET["sort"];
                                } else{
                                        $sort = "ProductName";
				}

				$get_all_prod = "SELECT * FROM Products";
				$get_all_prod .= " WHERE ProductBuyer IS NULL";
				$get_all_query = mysqli_query($connection, $get_all_prod);
				$product_count = mysqli_num_rows($get_all_query);



                                $get_products = "SELECT * FROM Products ";
				$get_products .= "WHERE ProductBuyer IS NULL ";
				$get_products .= "ORDER BY $sort ASC ";
				$get_products .= $limit;
                                $get_products_query = mysqli_query($connection, $get_products);
				

				while($row = mysqli_fetch_assoc($get_products_query)){
                                        $product_name = $row["ProductName"];
                                        $product_id = $row["ProductID"];
                                        $product_date = $row["ProductDate"];
                                        $product_picture = $row["ProductPicture"];
                                        $product_price = $row["ProductPrice"];
                                        $product_publisher = $row["ProductSource"];

                                        $table_row = "<tr> \n";
                                        $table_row .= "<td><img class=product-images src='../images/$product_picture' alt='Image not found :('></td> \n";
                                        $table_row .= "<td>{$product_name}</td> \n";
                                        $table_row .= "<td>{$product_price}</td> \n";
                                        $table_row .= "<td>{$product_publisher}</td> \n";
                                        $table_row .= "<td>{$product_date}</td> \n";
					$table_row .= "<td>{$product_id}</td> \n";
					$table_row .= "<td><a href='admin.php?source=manage_products&id=$product_id'>Delete</a></td>";
                                        $table_row .= "</tr>";

                                        echo $table_row;
				}

                        ?>
		</tbody>
	</table>

	<!--Pagination-->
	<div id="page-nav">
		<ul>
			<?php
				for ($i = 1; $i <= ceil($product_count / $products_per_page); $i++){
					if ($i == $page){
						echo "<li><a id='page-selected' href='admin.php?page=$i'>$i</a></li>";
					} else{
						echo "<li><a href='admin.php?page=$i'>$i</a></li>";
					}
				}	
			?>
		</ul>
	</div>

<?php
	include "connection.php";
	
	function checkQuery($query, string $identifier){
		global $connection;
		if(!$query){
			die("Something went wrong with the '{$identifier}'. => ".mysqli_errno($connection));
		}
	}

	function getProductsBy(string $sqlcondition, string $limit, string $sort, string $sort_type="ASC"){
		//Echo all attributes of a product, in a tablerow style, that match the given condition.
		global $connection;

		$get_products = "SELECT * FROM Products ";
		$get_products .= "WHERE {$sqlcondition} ";
		$get_products .= "ORDER BY {$sort} {$sort_type} ";
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
			$table_row .= "<td><a href='products.php?prod_id={$product_id}'><img class=product-images src='../images/$product_picture' alt='Image not found :('></a></td> \n";
			$table_row .= "<td>{$product_name}</td> \n";
			$table_row .= "<td>{$product_price}</td> \n";
			$table_row .= "<td>{$product_publisher}</td> \n";
			$table_row .= "<td>{$product_date}</td> \n";
			$table_row .= "<td>{$product_id}</td> \n";
			$table_row .= "</tr>";

			echo $table_row;
		}	
	}

	function getLimit(int $products_per_page, int $page){
		if($page === 1){
			return "LIMIT $products_per_page";
		} else{
			$start_from = ($products_per_page * $page) - $products_per_page;
			$end_at = $products_per_page;
			return "LIMIT $start_from, $end_at";
		}
	}

	function getNumOfProds(string $sqlcondition){
		global $connection;
		$get_all_prod = "SELECT * FROM Products ";
                $get_all_prod .= "WHERE {$sqlcondition}";
                $get_all_query = mysqli_query($connection, $get_all_prod);
                return mysqli_num_rows($get_all_query);
	}

	function getPage() : int{
		if(isset($_GET["page"])){
			return (int)$_GET["page"];
		} else{
			return 1;
		}
	}

	function getSort() : string{
		if(isset($_GET["sort"])){
			return $_GET["sort"];
		} else{
			return "ProductName";
		}
	}

?>

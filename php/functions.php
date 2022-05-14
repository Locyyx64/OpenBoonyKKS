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

			$table_row = "<tr class=product> \n";
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
	function getUsersBy(string $limit, string $sort, string $sqlcondition, string $sort_type="ASC"){
		global $connection;

		$get_users = "SELECT * FROM Users ";
		$get_users .= "WHERE {$sqlcondition} ";
		$get_users .= "ORDER BY $sort $sort_type ";
		$get_users .= $limit;
		$get_users_query = mysqli_query($connection, $get_users);

		while($row = mysqli_fetch_assoc($get_users_query)){
			$ppic = $row["ProfilePicture"];
			$uname = $row["Username"];
			$nick = $row["UserNickname"];
			$upoints = $row["PointCount"];

			$msg = "<tr class=user>\n";
			$msg .= "<td><img class='product-images' src='../{$ppic}' title='Profile Picture of {$uname}'></td> \n";
			$msg .= "<td>{$uname}</td> \n";
			$msg .= "<td>{$nick}</td> \n";
			$msg .= "<td>{$upoints}</td> \n";
			$msg .= "</tr>";

			echo $msg;
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

	function getNumOfTable(string $sqltable, string $sqlcondition){
		global $connection;
		$get_all_prod = "SELECT * FROM {$sqltable} ";
                $get_all_prod .= "WHERE {$sqlcondition}";
                $get_all_query = mysqli_query($connection, $get_all_prod);
                return mysqli_num_rows($get_all_query);
	}

	function getAllNames(){
		global $connection;
		$get_all_prods = "SELECT * FROM Products";
		$get_all_prods_query = mysqli_query($connection, $get_all_prods);
		$names = [];
		while($row = mysqli_fetch_assoc($get_all_prods_query)){
			$names["{$row["ProductName"]}"] = $row["ProductID"];
		}
		return $names;
	}

	function getPage() : int{
		if(isset($_GET["page"])){
			return (int)$_GET["page"];
		} else{
			return 1;
		}
	}

	function getSort(string $custom_sort="ProductName") : string{
		if(isset($_GET["sort"])){
			return $_GET["sort"];
		} else{
			return $custom_sort;
		}
	}

?>

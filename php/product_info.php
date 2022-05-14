<?php include "mutual.php" ?>
<?php 
 	$option = $_GET["prod_id"];
	$get_product_info = "SELECT * FROM Products ";
	$get_product_info .= "WHERE ProductID={$option}";
	$info_query = mysqli_query($connection, $get_product_info);
	if(!$info_query){
		die("Failed to fetch data about the product, with id {$option}. => ".mysqli_errno($connection));
	}

	while ($row = mysqli_fetch_assoc($info_query)){
		$product_name = $row["ProductName"];
		$product_date = $row["ProductDate"];
		$product_author = $row["ProductSource"];
		$product_price = $row["ProductPrice"];
		$product_picture = $row["ProductPicture"];
		if(empty($row["ProductDesc"])){
			$product_desc = "<p style='font-style: italic; font-weight: lighter;'>No description provided.</p>";
		}
		else{
			$product_desc = $row["ProductDesc"];
		}
	}
	$formatted_date_arr = str_split(strval($product_date), 4);
	$formatted_date = $formatted_date_arr[0] . "-" . implode("-", str_split($formatted_date_arr[1], 2));
?>
	<form id="view_product" method="POST" action="<?php echo $_SERVER["REQUEST_URI"]?>">
		<h1><?php echo $product_name ?></h1>
		<div id="productInfo">
			<img id="product_view_img"src="../images/<?php echo $product_picture ?>" alt="Image not found >:(">
			<?php echo $product_desc ?>
			<p class="product_info"><span class="marker_txt">Price:</span> <?php echo "$".$product_price?></p>
			<p class="product_info"><span class="marker_txt">Publisher:</span> <?php echo $product_author?></p>
			<p class="product_info"><span class="marker_txt">Publish Date:</span> <?php echo $formatted_date?></p>
		</div>	

		<div id="sphere1"></div>
		<div id="sphere2"></div>
			
		<input type="submit" name="submit" id="submitToCart" value="Add To Cart"></input>
	</form>

<?php 
	if(isset($_POST["submit"])){
		if(strpos($current_cart, $option) === false) {
			$add_to_cart = "UPDATE Users ";
			$add_to_cart .= "SET CurrentCart='$current_cart $option' ";
			$add_to_cart .= "WHERE Username='$username'";
			$add_to_cart_query = mysqli_query($connection, $add_to_cart);
			checkQuery($add_to_cart_query, "adding the product of ID {$option} to the cart of user {$username}");

			header("Location: products.php");
		} else{
			echo "<h2 id='err'>Product already inside cart.</h2>";
		}
	}
?>
<script src="../javascript/focusCart.js"></script>

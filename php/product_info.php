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

	$prod_buy_url = "products.php?prod_buy_id=$option";
	$prod_view_url = "products.php?prod_id=$option";	
?>
<main id="view_product">
	<h1><?php echo $product_name ?></h1>
	<div>
		<img id="product_view_img"src="../images/<?php echo $product_picture ?>" alt="Image not found >:(">
		<?php echo $product_desc ?>
		<p class="product_info"><span class="marker_txt">Price:</span> <?php echo "$".$product_price?></p>
		<p class="product_info"><span class="marker_txt">Publisher:</span> <?php echo $product_author?></p>
		<p class="product_info"><span class="marker_txt">Publish Date:</span> <?php echo $formatted_date?></p>
	</div>	

	<button onclick=accept()>Buy</button>
</main>

<script>
	const urlBuy = "<?php echo $prod_buy_url?>";
	const urlView = "<?php echo $prod_view_url?>";
	const accept = () => {
		const result = confirm("Are you sure?");
		console.log(result);
		if (result){
			location.assign(urlBuy);
		}
		else if(!result){
			location.assign(urlView);
		}
	}
</script>

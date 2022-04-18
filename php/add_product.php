
<h1>Product Creation</h1>

<!--Product Creation Form-->

<form action="admin.php?source=add_product" method="post" id="productCreation" enctype="multipart/form-data">
	Product Name: <input type="text" name="product_name" maxlength=32 placeholder="Name" required> <br>
	Product Price: <input type="number" name="product_price" maxlength=30 required>	<br>	
	Product Picture: <input type="file" name="product_picture"> <br>

	<label for="product_desc">Product Description: </label>
        <textarea name="product_desc" id="product_desc" rows=5 cols=50>
        </textarea> <br>
	
	<input type="submit" value="Add Product" name="submit">
</form>

<?php 
	if(isset($_POST["submit"])){
		$product_name = $_POST["product_name"];
		$product_price = $_POST["product_price"];
		$product_description = $_POST["product_desc"];
		$product_date = date("Ymd");
		$product_author = $_SESSION["Username"];

		$product_picture = basename($_FILES["product_picture"]["name"]);
		$product_temp_picture = $_FILES["product_picture"]["tmp_name"];

		$target_dir = "/opt/lampp/htdocs/ecomm/images/";
		$target_file = $target_dir . $product_picture;

		
		#Authenticating the given picture
		$uploadOk = 1;
		
		//Check if the file is actually an image
		$check = getimagesize($_FILES["product_picture"]["tmp_name"]);
		if(!$check){
			echo "File is not an image.";
			$uploadOk = 0;
		} else{
			$uploadOk = 1;
		}

		//Check if file already exists
		if(file_exists($target_file)){
			echo "File already exists.";
			$uploadOk = 1;
		}
		
		//Uploading the file
		if($uploadOk !== 0){
			move_uploaded_file($product_temp_picture, $target_file);
		}


		$add_prod = "INSERT INTO Products ";
		$add_prod .= "VALUES(NULL, '$product_name', $product_date, '$product_author', NULL, $product_price, '$product_picture', '$product_description')";
		$add_prod_query = mysqli_query($connection, $add_prod);
		if(!$add_prod_query){
			die("Failed to add a new product: ".mysqli_errno($connection));
		}

		header("Location: admin.php?source=manage_products");
	
	
	}

?>

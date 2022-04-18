<?php include "mutual.php" ?>

<?php 
	$prod_id = $_GET["prod_buy_id"];	

	$get_product = "SELECT * FROM Products ";
	$get_product .= "WHERE ProductID=$prod_id";
	$get_prod_query = mysqli_query($connection, $get_product);
	checkQuery($get_prod_query, "fetching the product, with id $prod_id");

	while($row = mysqli_fetch_assoc($get_prod_query)){
		$product_price = $row["ProductPrice"];
	}
?>

<p style="text-align: center; font-family: 'Experimental', sans-serif;">Inquiring user address, phone / email,  options for purchasing</p>
<div>
	<form action="products.php?prod_buy_id=<?php echo $prod_id ?>" method="POST" id="order-form">
		<table id="order-table">
			<tr>
				<table id="address-table">
					<tr>
						<td colspan="2" class="table-title">Address</td>		
					</tr>
					<tr>
						<td>
							<label for="country">Country: </label>
							<input name="country" id="country" pattern="(\s?[A-Z]{1}[a-z]+)+" required>
						</td>
					</tr>
					<tr>
						<td>
							<label for="city">City: </label>
                                                	<input name="city" id="city" pattern="(\s?[A-Z]{1}[a-z]+)+" required>
						</td>
					</tr>
					<tr>
						<td>
							<label for="real-addr">House Number, Street</label>
                                                	<input name="real-addr" id="real-addr" pattern="\d+\s([A-Z]?{1}[a-z]+)\s([A-Z]{1}?[a-z]{1,5})?" required>
						</td>
					</tr>
				</table>
			</tr>
			<tr>
				<td id="ordering-options">
					<label for="order-option" class="table-title">Way of Ordering:</label>
					<select name="order-option" id="order-option">
						<option value="delivery">Delivery</option>
						<option value="online">With Credit Card</option>
					</select>
				</td>
			</tr>
			<tr>
				<table id="addition-table">
					<tr>
						<td class="table-title">Extras</td>
					</tr>
					<tr><td><input type="checkbox" value="extra-package" name="extra-package"><label for="extra-package">Extra Packaging (+200 HUF)</label></td></tr>
					<tr><td><input type="checkbox" value="quick-delivery" name="quick-del"><label for="quick-del">Quick Delivery (+600 HUF)</label></td></tr>
				</table>
			</tr>
			<tr><td><input type="submit" value="Order" name="submit" id="order-submit"></td></tr>
		</table>
	</form>
</div>


<?php 
	function resetPoints(string $user){
		//Experimental function
		global $connection;
		$reset_points = "UPDATE Users ";
		$reset_points .= "SET PointCount=0 ";
		$reset_points .= "WHERE Username='$user'";
		$reset_points_query = mysqli_query($connection, $reset_points);
		if(!$reset_points_query){
			die("Failed to reset the point number on '$user'  => ".mysqli_errno($connection));
		} else{
			echo "Point removal was succesful.";
		}
	}
	function setOngoing(int $product_id, string $user_) : bool{
		global $connection;
		$set_ong = "UPDATE Products ";
		$set_ong .= "SET OngoingBuyer='$user_' ";
		$set_ong .= "WHERE ProductID=$product_id";
		$set_ong_query = mysqli_query($connection, $set_ong);
		if(!$set_ong_query){
			die("Failed to set ongoing buyer value on product $product_id => ".mysqli_errno($connection));
			return False;
		} else{
			return True;
		}
	}

	if(isset($_POST["submit"])){
		$full_price = (int)$product_price;
		$get_user .= "SELECT * FROM Users ";
		$get_user .= "WHERE Username='$username'";
		$get_user_query = mysqli_query($connection, $get_user);
		checkQuery($get_user_query, "fetch the user's points.");

		while($row = mysqli_fetch_assoc($get_user_query)){
			$user_points = (int)$row["PointCount"];
		}

                if(isset($_POST["extra-package"])){
			$full_price += 1; 

		}
		if(isset($_POST["quick-del"])){
			$full_price += 2;
		}

		if($product_price >= 200){
			$next_points = $user_points + 150;
		}
		else{
			$next_points = $user_points + ($full_price / 20) * 10;	
		}

		$append_points = "UPDATE Users ";
		$append_points .= "SET PointCount=$next_points ";
		$append_points .= "WHERE Username='$username'";
		$append_points_query = mysqli_query($connection, $append_points);
		checkQuery($append_points_query, "change the user's pointcount.");

		setOngoing($prod_id, $username);
	}
?>

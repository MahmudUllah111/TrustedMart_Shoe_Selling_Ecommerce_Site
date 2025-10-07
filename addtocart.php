<!DOCTYPE>
<html>
	<script type="text/javascript">
		function goback()
		{
			window.history.back();
		}
	</script>
	<?php
		ini_set('error_reporting', 'E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR');

		include 'connection.php';
		$conn = OpenCon();

		session_start();

		if($_SESSION['logged_in'] == false)
		{
			echo '<script>alert("You are not logged in. You must login to continue. ")</script>';
			echo '<meta http-equiv="refresh" content="0; URL=\'login.php\'" />';
			exit;
		}
		$user_name=$_SESSION['username'];
		$query='SELECT wallet from userss where user_id='.$user_name;
		$result=mysqli_query($conn,$query);
		$row=$result->fetch_assoc();
		$wallet=$row['wallet'];
		$_SESSION['wallet']=$wallet;
		
		$product_id = $_GET['product_id'];
		$quantity = $_POST['quantity'];
		$selected_size = $_POST['selected_size'];
		
		// Validate that a size was selected
		if (empty($selected_size)) {
			echo '<script>alert("Please select a size before adding to cart.");</script>';
			echo '<script>window.history.back();</script>';
			exit;
		}
		
		// Check stock for selected size
		$stock_query = "SELECT stock_quantity FROM product_sizes WHERE product_id = $product_id AND size = '$selected_size'";
		$stock_result = mysqli_query($conn, $stock_query);
		
		if ($stock_result->num_rows == 0) {
			echo '<script>alert("Selected size is not available for this product.");</script>';
			echo '<script>window.history.back();</script>';
			exit;
		}
		
		$stock_row = $stock_result->fetch_assoc();
		$available_stock = $stock_row['stock_quantity'];
		
		if ($quantity > $available_stock) {
			echo '<script>alert("Only ' . $available_stock . ' units available for size ' . $selected_size . '. Please reduce quantity.");</script>';
			echo '<script>window.history.back();</script>';
			exit;
		}
		
		$print_pro = 'Product ID = '.$product_id.' \n Size = '.$selected_size.' \n Quantity = '.$quantity.' \n ';
		$query = 'SELECT price from products where product_id='.$product_id;
		$result=mysqli_query($conn,$query);
		$row=$result->fetch_assoc();
		$price=$row['price'];
		$print_pro = $print_pro.'Price = '.$price.' \n ';
		$total = $price*$quantity;
		$ttotal=$total;
		$print_pro = $print_pro.'Total Price = '.$total.' \n ';
		
		if($ttotal > $wallet)
		{
			echo '<script> alert("You don\'t have enough money. Please recharge your account to buy products.");</script>';
			echo '<script>window.history.back();</script>';
			exit;
		}
		
		// Check if same product with same size already in cart
		$query='SELECT quantity,total from cart WHERE user_id='.$user_name.' AND product_id='.$product_id.' AND size=\''.$selected_size.'\'';
		$result=mysqli_query($conn,$query);
		
		if($result->num_rows == 1)
		{
			$row=$result->fetch_assoc();
			$q=$row['quantity'];
			$t=$row['total'];
			$new_quantity=$quantity+$q;
			
			// Check if new quantity exceeds stock
			if ($new_quantity > $available_stock) {
				echo '<script>alert("Cannot add more than available stock. You already have ' . $q . ' in cart. Only ' . $available_stock . ' available total.");</script>';
				echo '<script>window.history.back();</script>';
				exit;
			}
			
			$new_total=$total+$t;
			$query='DELETE from cart WHERE user_id='.$user_name.' AND product_id='.$product_id.' AND size=\''.$selected_size.'\'';
			$deleteresult=mysqli_query($conn,$query);
			$quantity = $new_quantity;
			$total = $new_total;
		}
		
		$query='INSERT INTO cart (user_id, product_id, size, quantity, total) VALUES('.$user_name.','.$product_id.',\''.$selected_size.'\','.$quantity.','.$total.')';
		$result=mysqli_query($conn,$query);
		
		if ($result) {
			$wallet=$wallet-$ttotal;
			$_SESSION['wallet']=$wallet;
			$query='UPDATE userss SET wallet='.$wallet.' WHERE user_id = '.$user_name;
			$result=mysqli_query($conn,$query);
			echo '<script>alert("'.$print_pro.' \n Product Added to Cart");</script>';
		} else {
			echo '<script>alert("Error adding product to cart: ' . mysqli_error($conn) . '");</script>';
		}

		echo '<meta http-equiv="refresh" content="0; URL=\'ehome.php\'" />';		
	?>
	
	
</html>
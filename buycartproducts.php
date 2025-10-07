<!DOCTYPE>
<html>
	<script type="text/javascript">
	var store_name = 'TrustedMart'
	document.title=store_name;
	document.write("<center><h1>",store_name,"<h1></center>");

	</script>

	<?php
		include 'connection.php';
		$conn = OpenCon();
		if (mysqli_connect_errno())	
		{
			echo "Unable to connect to server " . mysqli_connect_error();
		}
		$insert_conn = OpenCon();
		if (mysqli_connect_errno())	
		{
			echo "Unable to connect to server " . mysqli_connect_error();
		}
		session_start();
		$username = $_SESSION["username"];
		if($_SESSION['admin'] == true)
		{
			echo '<script>window.history.back()</script>';
			exit;
		}
		
		if($_SESSION['logged_in'] == false)
		{
			echo '<script>alert("You are not logged in. You must be logged in to view this page.")</script>';
			echo '<script>window.history.back()</script>';
			exit;
		}
		
		$query='SELECT order_id from orders ORDER by order_id DESC';
		$result=mysqli_query($conn,$query);
		$row = $result->fetch_assoc();
		$order = $row['order_id'];
		$order = $order+1;
		$query='INSERT INTO orders(user_id,order_id,status) VALUES('.$username.','.$order.',\'pending\')';
		$result = mysqli_query($conn, $query);
		
		$query = 'SELECT product_id, size, quantity, total FROM cart where user_id = '.$username;
		$result = mysqli_query($conn, $query);
		if($result->num_rows == 0)
		{
			echo '<script>alert("No products in cart");</script>';
			echo '<script>window.history.back();</script>';
			exit;
		}
		else
		{
			// First, check stock availability for all items
			$out_of_stock_items = [];
			while($row = $result->fetch_assoc()) {
				$prod_id = $row['product_id'];
				$size = $row['size'];
				$quan = $row['quantity'];
				
				$stock_query = "SELECT stock_quantity FROM product_sizes WHERE product_id = $prod_id AND size = '$size'";
				$stock_result = mysqli_query($conn, $stock_query);
				$stock_row = $stock_result->fetch_assoc();
				
				if ($stock_row['stock_quantity'] < $quan) {
					$out_of_stock_items[] = "Product ID: $prod_id, Size: $size (Available: {$stock_row['stock_quantity']}, Requested: $quan)";
				}
			}
			
			if (!empty($out_of_stock_items)) {
				echo '<script>alert("Some items are out of stock:\\n' . implode('\\n', $out_of_stock_items) . '");</script>';
				echo '<script>window.history.back();</script>';
				exit;
			}
			
			// Reset result pointer
			mysqli_data_seek($result, 0);
			
			// Process the order
			while($row = $result->fetch_assoc()) {
				$prod_id = $row['product_id'];
				$size = $row['size'];
				$quan = $row['quantity'];
				$tot = $row['total'];
				
				$insert_query = 'INSERT INTO buy(user_id, product_id, size, quantity, total, order_id) VALUES('.$username.','.$prod_id.',\''.$size.'\','.$quan.','.$tot.','.$order.')';
				$insert_result = mysqli_query($insert_conn,$insert_query);
				
				if($insert_result) {
					// Update stock quantity
					$update_stock_query = "UPDATE product_sizes SET stock_quantity = stock_quantity - $quan WHERE product_id = $prod_id AND size = '$size'";
					mysqli_query($conn, $update_stock_query);
				} else {
					echo '<script>alert("Error ordering products. Please try later")</script>';
					exit;
				}
			}
			
			$query = 'DELETE FROM cart where user_id='.$username;
			$result = mysqli_query($conn, $query);
			echo '<script>alert("Your products have been ordered. Your ORDERID = '.$order.'. You will soon have your order at your door step");</script>';
			echo '<script>window.location.href = "ehome.php";</script>';
			exit;
		}
		
	?>
</html>
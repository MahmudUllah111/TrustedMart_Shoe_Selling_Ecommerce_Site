<!DOCTYPE HTML>
<html lang="en">
	<head>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title>TrustedMart - Online Shopping in Bangladesh</title>
        <link rel="stylesheet" type="text/css" href="estyle.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      	<link style="width: 100%;height: 100%" rel="tab icon" href="store_images/TM.png"/>
    </head>

	<?php
		ini_set('error_reporting', 'E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR');

		include 'connection.php';
		$conn = OpenCon();

		session_start();

		if($_SESSION['logged_in'] == false)
		{
			echo '<script>alert("You are not logged in.") </script>.';
			echo '<meta http-equiv="refresh" content="0;url=login.php">';
			exit;
			
		}
		if($_SESSION['admin'] == true)
		{
			echo '<script>window.history.back();</script>';
			exit;
		}

		$un=0;
		if($_SESSION['logged_in'] == true)
		{
			$fn=$_SESSION["fullname"];
			$wallet=$_SESSION["wallet"];
			$un = $_SESSION["username"];
		}
		else
		{
			if(isset($_POST['user_name'],$_POST['password']) == false)
			{
				if($_SESSION['logged_in'] == false)
				{
					echo '<script>alert("You must login to continue.")</script>';
					echo '<meta http-equiv="refresh" content="0; URL=\'login.php\'" /> ';
					exit;
				}
			}
			$un=$_POST["user_name"];
			$p=$_POST["password"];
			$query = "SELECT * FROM userss WHERE user_id = ";
			$query=$query.$un;
			$result = mysqli_query($conn, $query);
			$number_of_rows = $result->num_rows;
			if($number_of_rows == 1)
			{
					$row=$result->fetch_assoc();
					$pass=$row["password"];
					$fn=$row["first_name"];
					$ln=$row["last_name"];
					$wallet=$row["wallet"];
					$full_name=$fn." ".$ln;
					if($p == $pass)
					{
						$_SESSION["admin"]=false;
						$_SESSION["logged_in"]=true;
						$_SESSION["username"]=$un;
						$_SESSION["fullname"]=$full_name;
						$_SESSION["wallet"]=$wallet;
					}
					else
					{
						echo "Invalid Password <br>";
						exit;
					}
			}
			else
			{
				echo "Invalid User_ID <br>";
				exit;
			}		 
		}
		
		$qu = 'SELECT wallet from userss where user_id='.$un;
		$resu=mysqli_query($conn,$qu);
		$ro=$resu->fetch_assoc();
		$wallet = $ro['wallet'];
		$_SESSION['wallet']=$wallet;

	?>


	<body style="font-size: 15px;">
    	<!-- Top navigation Bar ( LOGO + Other Buttons) -->
    	<header>        
            <div class="logo"><a href="ehome.php"><img class="logoClass" src="store_images/mmmyyylogo.png"></a></div>
            <nav role = "header">
            	<ul>
            		<li><a href="ehome.php" class="active">HOME</a></li>
            		<li><a href="trackmyorder.php"> TRACK MY ORDER</a></li>
            		<li><a href="info.php"> ABOUT DEVELOPERS</a></li>
            		

            		<label for="profile2" class="profile-dropdown">
						<input type="checkbox" id="profile2">
						<img src="https://cdn0.iconfinder.com/data/icons/avatars-3/512/avatar_hipster_guy-512.png">
					   	<span> <?php echo'<font size="1.5rem" style="color:white;">'.$fn.'</font>' ?></span>
					   	
					   	<label for="profile2"><i class="mdi mdi-menu"></i></label>
					   	<ul>
					   		<li><a href="#" class="mdi mdi-account">Account</a></li>
					   		<li><a href="#" class="mdi mdi-settings">Settings</a></li>
					   		<li><a href="logout.php" target="_self" class="mdi mdi-logout">Logout</a></li>
					   		<?php
			            		echo 
			            		'<li>
			            			<a class="mdi mdi-wallet" id="walletBtn" href="#">
			            				<font size = "2">Tk. '.$wallet.'</font>
			            			</a>
			            		</li>'
		            		?>
					   	</ul>
					</label>
            	</ul>
            </nav>
            <div class="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></div>
    	</header>
    	
    	<br>
    	<br>
    	<br>

    	<!-- Categories Button + Search Bar + Cart -->
    	<div class="catsearchDiv">

    		<!-- Categories Button -->
    		<nav role = "catmenu" id='categorymenu'>
		        <ul>
		            <li role = "plusminusANDtext"><a href='#' class="plusMinus" style="margin-top: 1px;height: 10px;box-sizing : border-box;border-radius: 5px;outline: none;border: 4px solid #ff6d4d;text-align: center;" >CATEGORIES</a>
		                <ul>
		                	<?php
		                		$query = 'SELECT category_name FROM category';
		                		$result = mysqli_query($conn,$query);
		                		
		                		while($row = $result->fetch_assoc())
		                		{
		                			echo "<li role = 'plusminus'><a href='search.php?query=".$row['category_name']."'>".$row['category_name']."</a> </li>";
		                		}				             
		                
			            	?>
			         
		              	</ul>
		            </li>
		        </ul>
		    </nav>

		    <!-- Search bar -->
		    <form class="search" method="POST" action="search.php">
		        <input type="text" name="sp" class="searchTerm" pattern="\S+.*"/ placeholder="Search in TrustedMart ...">
		        <input type="submit" class="searchButton">
		    	
		    	<select class="filterclass" name="search_filters" id="search_filters" onchange="searchfilters(this.options[this.selectedIndex].value)">
					<option value="no_filters">No filters </option>
					<option value="price_lth">Price Low to High </option>
					<option value="price_htl">Price High to Low</option>
					<option value="date_added_r">Recent Products</option>
					<option value="date_added_o">Old Added Products</option>
				</select>
		    </form>
		    
		    <!-- Cart -->
		    <div class="cart"><a href="mycart.php"><img class="cartClass" src="store_images/cart (4).png"></a></div>
    	</div>
    	

    	<br>
    	<br>
    	<br>
    	<br>


	

		<?php
			$product_id = $_GET['product_id'];
			$query = 'SELECT icon_name,product_id,product_name,products.category_id,category_name,price,date_added,description FROM products,category WHERE (products.category_id=category.category_id) AND (product_id = '.$product_id.')';
			$result= mysqli_query($conn,$query);
			if($result->num_rows == 0)
			{
				echo 'Invalid Product ID <br>';
			}
			else
			{
				$row = $result->fetch_assoc();
				

				$productname=$row['product_name'];
				$productprice=$row['price'];
				$productdescription=$row['description'];
				$image=$row['icon_name'];
				
				// Fetch available sizes for the product - FIXED THE QUERY
				$available_sizes_query = "SELECT size, stock_quantity FROM product_sizes WHERE product_id = $product_id AND stock_quantity > 0";
				$available_sizes_result = mysqli_query($conn, $available_sizes_query);
				
				// Debug: Check if we got any results
				$num_sizes = $available_sizes_result->num_rows;
		?>

		<div>	<style scoped>
		        @import "style.css";</style>
		    
		<div class="container" style="border: 1px solid #262626;">
		
    		<br>
			<div class="border-0">
				<div class="row">
					<aside class="col-sm-4">
						<article class="gallery-wrap"> 
							<div class="img-big-wrap">
								<div>
									<a href="#">
										<?php
											echo '<img src="images/'.$image.'">';
										?>
									</a>
								</div>
							</div>
							
						</article>
					</aside>

					<aside class="col-sm-5">
						<article class="card-body m-0 pt-0 pl-5">
							<h3 class="title text-uppercase"><?php echo $productname ?></h3>
							<div class="rating">
								<div class="stars">
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star checked"></span>
									<span class="fa fa-star"></span>
									<span class="fa fa-star"></span>
									<span class="review-no ml-2">(41 reviews)</span>
								</div>
							</div>

							<div class="mb-3 mt-3"> 
								<span class="h7 text-success">In stock.</span>
							</div>						
							<div class="mb-3 mt-3"> 
								<span class="price-title">Price : </span>
								<span class="price color-price-waanbii"><?php echo $productprice ?> Tk.</span>
							</div>
							<dl class="item-property">
								<dt>Description</dt>
								<dd>
									<p><?php echo $productdescription ?></p>
								</dd>
							</dl>
						</article>
					</aside>

					<aside class="col-sm-3">
						<div class="row">
							<dl class="param param-inline">
								<dt>Available Sizes:</dt>
							</dl>
						</div>

						<div class="row">
							<select name="selected_size" class="form-control" id="sizeSelect">
								<option value="">Select a size</option>
								<?php
								if ($num_sizes > 0) {
									while ($size_row = $available_sizes_result->fetch_assoc()) {
										echo '<option value="'. htmlspecialchars($size_row['size']) . '">' . htmlspecialchars($size_row['size']) . ' (Stock: '. $size_row['stock_quantity'] . ')</option>';
									}
								} else {
									echo '<option value="">No sizes available</option>';
								}
								?>
							</select>
							<?php
							// Debug information (remove this after testing)
							echo "<!-- Debug: Found $num_sizes sizes for product $product_id -->";
							?>
						</div>

						<br>

						<div class="row">
							<dl class="param param-inline">
								<dt>Quantity: </dt>
							</dl>
						</div>

						<div class="row ">
							<?php
								echo
								'<form method="POST" action="addtocart.php?product_id='.$product_id.'" id="addToCartForm">
									<input type="hidden" name="selected_size" id="selected_size_input" value="">
									<input type="number" min="1" max="10" style="width : 100%" name="quantity" required placeholder="Enter quantity"/>
									<br>
									<br>
									<button type="submit" class="btn btn-lg color-box-waanbii" id="addToCartBtn" disabled><i class="fa fa-shopping-cart"></i>Add to cart </button>
								</form>'
							?>
						</div>

						<div class="row mb-4 mt-4">
							<button class="btn btn-lg btn-success" type="button"><i class="fa fa-heart fa-beat"></i></button>
						</div>
						<hr class="m-0 p-0">
						<div class="row mb-4 mt-4">
							<?php
							if ($num_sizes > 0) {
								echo "Select your size and quantity to add to cart.";
							} else {
								echo "<span style='color: red;'>No sizes available for this product. Please contact admin.</span>";
							}
							?>
						</div>
					</aside>
				</div>
			</div>
		</div>
		</div>
		
		<script>
		document.getElementById('sizeSelect').addEventListener('change', function() {
			const selectedSize = this.value;
			document.getElementById('selected_size_input').value = selectedSize;
			
			// Enable/disable add to cart button based on size selection
			document.getElementById('addToCartBtn').disabled = !selectedSize;
		});
		</script>
		
		<?php 
			}
		?>

		<!-- Rest of your footer code remains the same -->
		<br><br><br>
    	<br>
    	<br>
    	<br>
    	<br>

		<footer class="ct-footer">
			<!-- Your footer content here -->
		</footer>

		<script type="text/javascript"> 
			function searchfilters(name){
				 var filter;
				 filter = 'nf';
				 if(name == "price_lth")
				 {
					filter = 'plth'
				 }
				 else if(name == "price_htl")
				 {
					filter = 'phtl'; 
				 }
				 else if(name == "date_added_r")
				 {
					filter = 'rp'; 
				 }
				 else if(name == "date_added_o")
				 {
					filter = 'oap'; 
				 }
				 else if(name == "no_filters")
				 {
					filter = 'nf';
				 }
				 document.cookie="filter="+filter;
			}
		</script>
	</body>
</html>
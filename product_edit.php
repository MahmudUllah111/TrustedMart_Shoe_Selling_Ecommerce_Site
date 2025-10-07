<!DOCTYPE>
<html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<head><link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous"></head>

<style type="text/css">
  @charset "UTF-8";
@import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,700,400italic);

html {
  box-sizing: border-box;
}
body {
  background: #f1f2f7;
  font-family: "Open Sans", arial, sans-serif;
  color: darkslategray;
}
header[role ="banner"] h1 {
  margin: 0;
  font-weight: 300;
  padding: 1rem;
}
  header[role="banner"] {
    background: white;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.15);
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 99;
    height: 75px;
    padding-right: 0.6em;
  color: red;
  }
  header[role="banner"] .utilities {
    position: absolute;
    top: 0;
    right: 0;
    background: transparent;
    color: darkslategray;
    width: auto;
  }
  header[role="banner"] .utilities li {
    display: inline-block;
  }
  header[role="banner"] .utilities li a {
    padding: 0.5em 1em;
  }

a {
  text-decoration: none;
  color: inherit;
}

ul,
li {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

@media screen and (min-width: 600px) 
{
  
  nav[role="navigation"] {
    position: fixed;
    width: 200px;
    top: 75px;
    bottom: 0px;
    left: 0px;
  }

  main[role="main"] 
  {
    margin: 75px 0 40px 200px;
  }

  .panel {
    margin: 2% 0 0 2%;
    float: left;
    width: 96%;
  }

@media screen and (min-width: 900px) {


  .panel 
  {
    width: 47%;
    clear: none;
  }
  .panel.important {
    width: 96%;
  }
  .panel.secondary 
  {
    width: 23%;
  }
  .logout
  {
    color:red;
  }

.rempro
{
	color:red;
	display: inline-block;
	margin-top: -2px;
}
.imgpro
{
	margin-top: 5%;
	height: 250px;
	width: 250px;
	border: 1px solid black;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

#search_options
{
	
	background-color: darkslategrey;
	border: none;
  	border-bottom: solid 4px black;
  	padding: 0.7em 3em;
  	margin: 1em 0;
	color:white;
	text-shadow: 0 -1px 0 #e60000;
	  font-size: 1.1em;
	  font-weight: bold;
	  display: inline-block;
	  width: auto;
}

form input,
form textarea,
form select {
  width: 100%;
  display: block;
  border: solid 1px #dde;
  padding: 0.5em;
}

form label,
form legend {
  display: block;
  margin: 1em 0 0.5em;
}

form input[type = "submit"] 
{
  background: #ff1a1a;
  border: none;
  border-bottom: solid 4px #e60000;
  padding: 0.7em 3em;
  margin: 1em 0;
  color: white;
  text-shadow: 0 -1px 0 #e60000;
  font-size: 1.1em;
  font-weight: bold;
  display: inline-block;
  width: auto;
  -webkit-border-radius: 0.5em;
  -moz-border-radius: 0.5em;
  -ms-border-radius: 0.5em;
  border-radius: 0.5em;
}

.size-management {
  margin: 20px 0;
  padding: 15px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.size-row {
  display: flex;
  gap: 10px;
  margin-bottom: 10px;
  align-items: center;
}

.size-row input {
  flex: 1;
}

.remove-size {
  background: #ff4444;
  color: white;
  border: none;
  padding: 5px 10px;
  border-radius: 3px;
  cursor: pointer;
}

.add-size {
  background: #4CAF50;
  color: white;
  border: none;
  padding: 8px 15px;
  border-radius: 3px;
  cursor: pointer;
  margin-top: 10px;
}

</style>

<script type="text/javascript">
    
    function showfield(name)
    {
      if(name == "upn")
      {
        document.getElementById('dupr').style.display="none";
        document.getElementById('dude').style.display="none";
        document.getElementById('duim').style.display="none";
        document.getElementById('dupn').style.display="block";
        document.getElementById('size-management').style.display="none";
      }
      else if(name == "upr")
      {
        document.getElementById('dupn').style.display="none";
        document.getElementById('dude').style.display="none";
        document.getElementById('duim').style.display="none";
        document.getElementById('dupr').style.display="block";
        document.getElementById('size-management').style.display="none";
      }
      else if(name == "ude")
      {
        document.getElementById('dupr').style.display="none";
        document.getElementById('dupn').style.display="none";
        document.getElementById('duim').style.display="none";
        document.getElementById('dude').style.display="block";
        document.getElementById('size-management').style.display="none";
      }
      else if(name == "uim")
      {
        document.getElementById('dupr').style.display="none";
        document.getElementById('dude').style.display="none";
        document.getElementById('dupn').style.display="none";
        document.getElementById('duim').style.display="block";
        document.getElementById('size-management').style.display="none";
      }
      else if(name == "usize")
      {
        document.getElementById('dupr').style.display="none";
        document.getElementById('dude').style.display="none";
        document.getElementById('dupn').style.display="none";
        document.getElementById('duim').style.display="none";
        document.getElementById('size-management').style.display="block";
      }
    }
    
    function starting()
    {
      document.getElementById('dupr').style.display="none";
      document.getElementById('dude').style.display="none";
      document.getElementById('duim').style.display="none";
      document.getElementById('dupn').style.display="block";
      document.getElementById('size-management').style.display="none";
    }
    
    function checkdisable(texbox,submitbutton)
    {
      var tb=document.getElementById(texbox).value;
      if(tb == "")
      {
        document.getElementById(submitbutton).disabled = true;
      }
      else
      {
        document.getElementById(submitbutton).disabled = false;
      }
    }

    function addNewSizeRow() {
      const newRow = document.createElement('div');
      newRow.className = 'size-row';
      newRow.innerHTML = `
        <input type="text" name="new_sizes[]" placeholder="Size (e.g., US 7)" required>
        <input type="number" name="new_quantities[]" placeholder="Quantity" min="1" required>
        <button type="button" class="remove-size" onclick="this.parentElement.remove()">Remove</button>
      `;
      document.getElementById('new-sizes-container').appendChild(newRow);
    }
    
  </script>

<header role="banner">
  <h1> <i style="color:#332F2F;" class="fas fa-user-lock"></i> Admin Portal</h1>
  <ul class="utilities">
    <br>
    <li class="users">
    </a></li>
    <li class="logout"><a href="logout.php"><i class="fas fa-sign-out-alt" style =" margin-right: 4px"></i>Log Out</a></li>
  </ul>
</header>

<?php
    ini_set('error_reporting', 'E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR');
    include 'connection.php';
    $conn = OpenCon();
    session_start();
    if($_SESSION["admin"] === false)
    {
      echo '<script>alert("You are not admin. Only admins can view this page.");</script>';
      echo '<script>window.history.back();</script>';
      exit;
    }
    $product_id = $_GET['productid'];
    $query = 'SELECT products.icon_name,products.product_id,products.product_name,products.category_id,category_name,price,date_added,description FROM products,category WHERE (products.category_id=category.category_id) AND (product_id = '.$product_id.')';
    $result= mysqli_query($conn,$query);
    if($result->num_rows == 0)
    {
      echo '<script>alert("Invalid Product ID");window.history.back();</script>';
      exit;
    }
    else
    {
      $row = $result->fetch_assoc();
      $image=$row['icon_name'];
      echo '<img class = "imgpro" src="images/'.$image.'" alt="Image">';
      echo '<br><br>';
      	
      		echo '<table>';

		    echo '<tr>';
			echo '<td> Product ID </td> <td> '.$product_id.'</td>';
			echo '</tr>';

			echo '<tr>';
			echo '<td> Product Name </td> <td> '.$row['product_name'].'</td>';
			echo '</tr>';

			echo '<tr>';
			echo '<td>Category ID</td> <td> '.$row['category_id'].'</td>';
			echo '</tr>';

      echo '<tr>';
      echo '<td style = "color:black;">Category Name</td> <td>'.$row['category_name'].'<br>';
      echo '</tr>';

      echo '<tr>';
      echo '<td>Price</td> <td> TK  '.$row['price'].'<br>';
      echo '</tr>';

      echo '<tr>';
      echo '<td>Description</td> <td>'.$row['description'].'<br>'; 
      echo '</tr>';
      echo '</table>';

      // Fetch existing sizes
      $sizes_query = "SELECT product_size_id, size, stock_quantity FROM product_sizes WHERE product_id = $product_id";
      $sizes_result = mysqli_query($conn, $sizes_query);
      $existing_sizes = [];
      while ($s_row = $sizes_result->fetch_assoc()) {
          $existing_sizes[] = $s_row;
      }
	 
    }

    // Handle form submission for sizes
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_sizes'])) {
        // Update existing sizes
        if (isset($_POST['existing_sizes'])) {
            foreach ($_POST['existing_sizes'] as $size_id => $data) {
                $size = mysqli_real_escape_string($conn, $data['size']);
                $quantity = (int)$data['quantity'];
                $update_size_query = "UPDATE product_sizes SET size = '$size', stock_quantity = $quantity WHERE product_size_id = $size_id";
                mysqli_query($conn, $update_size_query);
            }
        }
        
        // Add new sizes
        if (isset($_POST['new_sizes']) && isset($_POST['new_quantities'])) {
            for ($i = 0; $i < count($_POST['new_sizes']); $i++) {
                $size = mysqli_real_escape_string($conn, $_POST['new_sizes'][$i]);
                $quantity = (int)$_POST['new_quantities'][$i];
                if (!empty($size) && $quantity > 0) {
                    $insert_size_query = "INSERT INTO product_sizes (product_id, size, stock_quantity) VALUES ($product_id, '$size', $quantity)";
                    mysqli_query($conn, $insert_size_query);
                }
            }
        }
        
        // Delete sizes
        if (isset($_POST['delete_sizes'])) {
            foreach ($_POST['delete_sizes'] as $size_id_to_delete) {
                $delete_size_query = "DELETE FROM product_sizes WHERE product_size_id = $size_id_to_delete";
                mysqli_query($conn, $delete_size_query);
            }
        }
        
        echo '<script>alert("Sizes updated successfully");</script>';
        echo '<script>window.location.reload();</script>';
    }
  ?>

  <body onload="starting()">

  <select name="search_options" id="search_options"  onchange="showfield(this.options[this.selectedIndex].value)">
    <option value="upn">Update Product Name</option>
    <option value="upr">Update Price</option>
    <option value="ude">Update Description</option>
    <option value="uim">Update Image</option>
    <option value="usize">Manage Shoe Sizes</option>
  </select>
  
  </br> </br>
  
  <div id="dupn">
    <form action=<?php echo 'updateproductname.php?productid='.$product_id.'&'?> method="POST">
      <input type="text" name="update_pn" id="epn" required placeholder="Enter Product Name" onchange="checkdisable('epn','idupn')" onkeyup="checkdisable('epn','idupn')"> </br>
      <input type="submit" id="idupn" disabled value="Update Product Name" />
    </form>
  </div>
  
  
  <div id="dupr">
    <form action=<?php echo 'updateproductprice.php?productid='.$product_id.'&'?> method="POST">
      <input type="number" min="0" name="update_pp" id="epp" required placeholder="Enter Product Price" onchange="checkdisable('epp','idupp')" onkeyup="checkdisable('epp','idupp')"> </br>
      <input type="submit" id="idupp" disabled value="Update Product Price" />
    </form>
  </div>
  
  
  <div id="dude">
    <form action=<?php echo 'updateproductdescription.php?productid='.$product_id.'&'?> method="POST">
      <textarea rows = "10" cols = "16" id="epd" required name = "descrip" placeholder="Enter Product Description" onchange="checkdisable('epd','idude')" onkeyup="checkdisable('epn','idupn')" /> </textarea></br>
      <input type="submit" id="idude" disabled value="Update Product Description" />
    </form>
  </div>
  
  
  <div id="duim">
    <form action=<?php echo 'updateproductimage.php?productid='.$product_id.'&'?> method="POST" enctype="multipart/form-data">
      <input type="FILE" id="epim" name="pic" required placeholder="Enter Product Name" accept="image/*" value="Go" onchange="checkdisable('epim','iduim')" onkeyup="checkdisable('epim','iduim')"> </br>
      <input type="submit" id="iduim" disabled value="Update Product Image" />
    </form>
  </div>

  <div id="size-management" class="size-management" style="display: none;">
    <h3>Manage Shoe Sizes</h3>
    <form method="POST">
        <h4>Existing Sizes:</h4>
        <?php foreach ($existing_sizes as $size): ?>
            <div class="size-row">
                <input type="text" name="existing_sizes[<?php echo $size['product_size_id']; ?>][size]" 
                       value="<?php echo htmlspecialchars($size['size']); ?>" placeholder="Size" required>
                <input type="number" name="existing_sizes[<?php echo $size['product_size_id']; ?>][quantity]" 
                       value="<?php echo $size['stock_quantity']; ?>" min="0" placeholder="Quantity" required>
                <label>
                    <input type="checkbox" name="delete_sizes[]" value="<?php echo $size['product_size_id']; ?>"> Delete
                </label>
            </div>
        <?php endforeach; ?>
        
        <h4>Add New Sizes:</h4>
        <div id="new-sizes-container">
            <div class="size-row">
                <input type="text" name="new_sizes[]" placeholder="Size (e.g., US 7)" required>
                <input type="number" name="new_quantities[]" placeholder="Quantity" min="1" required>
                <button type="button" class="remove-size" onclick="this.parentElement.remove()">Remove</button>
            </div>
        </div>
        <button type="button" class="add-size" onclick="addNewSizeRow()">Add Another Size</button>
        
        <br><br>
        <input type="submit" name="update_sizes" value="Update Sizes">
    </form>
  </div>
</section>
<div>
  
  </body>
  
	<?php
		echo '<br>';
		echo '<div class = "rempro" align="right"><i class="fas fa-trash"></i> <a href="delete_product.php?product_id='.$product_id.'">Remove </div>';
		echo '<br>';
	?>
  
</html>
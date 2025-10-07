<!DOCTYPE html>
<html>
<?php
// Turn on full error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include connection
include 'connection.php';
$conn = OpenCon();
session_start();

// Check admin session
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] == false) {
    echo '<script>alert("You are not admin. Only admins can view this page.");</script>';
    echo '<script>window.history.back();</script>';
    exit;
}

// Handle image upload
$target_dir = 'images/';
$filename = basename($_FILES["pic"]["name"]);
$target_file = $target_dir . $filename;

if (file_exists($target_file)) {
    echo '<script>alert("Sorry, file already exists with this name")</script>';
    echo '<script>window.location.href = "admin.php";</script>';
    exit;
}

// Get new product ID
$check_query = 'SELECT product_id FROM products ORDER BY product_id DESC LIMIT 1';
$result = mysqli_query($conn, $check_query);
$row = $result->fetch_assoc();
$p_id = $row ? $row['product_id'] + 1 : 1;

// Check if product with same ID already exists (not really needed since ID is unique)
$dup_check = 'SELECT product_id FROM products WHERE product_id=' . $p_id;
$check_result = mysqli_query($conn, $dup_check);
$number_of_rows = $check_result->num_rows;

if ($number_of_rows == 1) {
    echo '<script>alert("Product already exists with this ID") </script>';
    echo '<script>window.location.href = "admin.php";</script>';
    exit;
}

// Move image file
if (!move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
    echo '<script>alert("Sorry, there was an error uploading your file. Product not added");</script>';
    echo '<script>window.location.href = "admin.php";</script>';
    exit;
}

// Add product to DB
$add_query = "INSERT INTO products (product_id, product_name, category_id, date_added, description, price, icon_name) 
              VALUES ($p_id, '{$_POST['product_name']}', {$_POST['category_id']}, NOW(), 
              '{$_POST['description']}', {$_POST['price']}, '$filename')";

$add = mysqli_query($conn, $add_query);

if ($add) {
    $new_product_id = $p_id;

    // Insert shoe sizes if provided
    if (isset($_POST["sizes"]) && isset($_POST["quantities"])) {
        $sizes = $_POST["sizes"];
        $quantities = $_POST["quantities"];
        
        for ($i = 0; $i < count($sizes); $i++) {
            $size = mysqli_real_escape_string($conn, $sizes[$i]);
            $quantity = (int)$quantities[$i];
            
            if (!empty($size) && $quantity > 0) {
                $insert_size_query = "INSERT INTO product_sizes (product_id, size, stock_quantity) 
                                      VALUES ($new_product_id, '$size', $quantity)";
                mysqli_query($conn, $insert_size_query);
            }
        }
    }
    
    echo '<script>alert("Product and sizes have been added");</script>';
    echo '<script>window.location.href = "admin.php";</script>';
    exit;
} else {
    echo '<script>alert("Error adding product: ' . mysqli_error($conn) . '")</script>';
    echo '<script>window.location.href = "admin.php";</script>';
    exit;
}
?>
</html>
<?php
// Start session at the very top, before any output
session_start();

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include database connection
include 'connection.php';
$conn = OpenCon();

if (mysqli_connect_errno()) {
    die('<div class="error-message">Unable to connect to server: ' . mysqli_connect_error() . '</div>');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrustedMart - Track My Order</title>
    <link rel="stylesheet" type="text/css" href="estyle.css">
    <link href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="icon" href="store_images/TM.png"/>
    <style>
        .trackorder {
            padding: 20px;
            text-align: center;
            margin: 20px auto;
            max-width: 800px;
            border-radius: 16px;
            background-color: #fff;
        }

        table {
            text-align: center;
            border-collapse: collapse;
            width: 96%;
            margin: 20px auto;
        }

        th {
            text-align: center;
            font-weight: 400;
            font-size: 13px;
            text-transform: uppercase;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            padding: 10px;
        }

        tr:not(:first-child):hover {
            background: rgba(0, 0, 0, 0.1);
        }

        td {
            text-align: center;
            line-height: 40px;
            font-weight: 300;
            padding: 10px;
        }

        .priceclass {
            text-align: center;
        }

        .error-message, .order-details {
            color: #333;
            text-align: center;
            margin: 20px;
        }

        .trackorder input, .trackorder button {
            height: 40px;
            border-radius: 8px;
            padding: 10px;
            margin: 5px;
        }

        .trackorder input {
            width: 300px;
        }

        .trackorder button {
            width: 150px;
            background-color: #ff6d4d;
            color: white;
            border: none;
            cursor: pointer;
        }

        .trackorder button:hover {
            background-color: #e55a3c;
        }

        /* Adjust content to avoid overlap with fixed header */
        body {
            padding-top: 120px; /* Height of the fixed header + some extra space */
        }
    </style>
</head>
<body>
    <!-- Top Navigation Bar -->
    <header>
        <div class="logo"><a href="ehome.php"><img class="logoClass" src="store_images/mmmyyylogo.png" alt="TrustedMart Logo"></a></div>
        <nav role="header">
            <ul>
                <li><a href="ehome.php" class="active">HOME</a></li>
                <li><a href="trackmyorder.php">TRACK MY ORDER</a></li>
                <li><a href="info.php">ABOUT DEVELOPERS</a></li>
            </ul>
        </nav>
        <div class="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></div>
    </header>

    <!-- Track My Order Section -->
    <form method="POST" class="trackorder" action="trackmyorder.php">
        <input type="number" name="orderid" placeholder="Enter Order ID" min="1" required>
        <button type="submit">Track My Order</button>
    </form>

    <?php
    if (isset($_POST['orderid']) && is_numeric($_POST['orderid']) && $_POST['orderid'] > 0) {
        $orderid = (int)$_POST['orderid'];

        // Use prepared statement to prevent SQL injection
        $oquery = "SELECT buy.product_id, products.product_name, buy.size, products.price, buy.quantity, buy.total
                   FROM orders
                   JOIN buy ON orders.order_id = buy.order_id
                   JOIN products ON buy.product_id = products.product_id
                   WHERE orders.order_id = ?";
        
        $stmt = mysqli_prepare($conn, $oquery);
        if (!$stmt) {
            echo '<div class="error-message">Error preparing query: ' . mysqli_error($conn) . '</div>';
            mysqli_close($conn);
            exit;
        }

        mysqli_stmt_bind_param($stmt, "i", $orderid);
        if (!mysqli_stmt_execute($stmt)) {
            echo '<div class="error-message">Error executing query: ' . mysqli_stmt_error($stmt) . '</div>';
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            exit;
        }

        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) == 0) {
            echo '<div class="error-message">No order found with this ID</div>';
        } else {
            $sum = 0;
            echo '<div class="order-details">';
            echo '<table><tr><th>Product ID</th><th>Product Name</th><th>Size</th><th>Price per Unit</th><th>Quantity</th><th>Total</th></tr>';
            while ($row = mysqli_fetch_assoc($result)) {
                $sum += $row['total'];
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['product_id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['product_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['size'] ?: 'N/A') . '</td>';
                echo '<td>' . htmlspecialchars($row['price']) . '</td>';
                echo '<td>' . htmlspecialchars($row['quantity']) . '</td>';
                echo '<td class="priceclass">' . htmlspecialchars($row['total']) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>';
            echo '<div style="text-align:right; color:#333; margin: 20px;">Total Amount = Tk.' . htmlspecialchars($sum) . '</div>';
        }
        mysqli_stmt_close($stmt);
    } else if (isset($_POST['orderid'])) {
        echo '<div class="error-message">Please enter a valid Order ID.</div>';
    }

    mysqli_close($conn);
    ?>

    <!-- Footer -->
    <footer class="ct-footer">
        <div class="container">
            <ul class="ct-footer-list text-center-sm">
                <li>
                    <h2 class="ct-footer-list-header">Learn More</h2>
                    <ul>
                        <li><a href="info.php">About us</a></li>
                    </ul>
                </li>
                <li>
                    <h2 class="ct-footer-list-header">Services</h2>
                    <ul>
                        <li><a href="">Design</a></li>
                        <li><a href="">Marketing</a></li>
                        <li><a href="">Sales</a></li>
                        <li><a href="">Programming</a></li>
                        <li><a href="">Support</a></li>
                    </ul>
                </li>
                <li>
                    <h2 class="ct-footer-list-header">Our Team</h2>
                    <ul>
                        <li><a href="info.php">Developers</a></li>
                    </ul>
                </li>
                <li>
                    <h2 class="ct-footer-list-header">Customer Care</h2>
                    <ul>
                        <li><a href="">Help Centre</a></li>
                        <li><a href="#" onclick="alert('You can add money in your wallet through coupons. Coupons are available at general stores. Add money using coupon and add products you want to buy in cart. After that press check out button. Products will be delivered at your door step')">How to buy?</a></li>
                        <li><a href="#" onclick="alert('Track your order by entering your Order ID in the form above')">Track Your Order</a></li>
                        <li><a href="#" onclick="alert('You can buy coupons from General Stores around your house')">How to get coupon?</a></li>
                        <li><a href="#" onclick="alert('At your given address the products will be delivered')">Delivery method</a></li>
                    </ul>
                </li>
                <li>
                    <h2 class="ct-footer-list-header">TrustedMart</h2>
                    <ul>
                        <li><a href="info.php">About Us</a></li>
                        <li><a href="#" onclick="alert('We will not be responsible if you give incorrect address. Products will be delivered once on user confirmation. If user fails to receive, company is not responsible for it.')">Terms and Conditions</a></li>
                        <li><a href="#" onclick="alert('You can email us at \n 2230406@iub.edu.bd \n')">Contact Us</a></li>
                    </ul>
                </li>
            </ul>
            <div class="ct-footer-meta text-center-sm">
                <div class="row">
                    <div class="col-sm-6 col-md-2">
                        <img class="footerlogo" alt="TrustedMart Logo" src="store_images/TM.PNG">
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <address>
                            <span>TrustedMart Co.<br></span>
                            Alif Tower<br>Dhaka, Bangladesh<br>
                            <span>Phone: <a href="tel:5555555555">(000) 000-000</a></span>
                        </address>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <ul class="ct-socials list-unstyled list-inline">
                            <li><a href="#" target="_blank"><img alt="Facebook" src="store_images/Social-Media logo.png"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="ct-footer-post">
            <div class="container">
                <div class="inner-left">
                    <ul>
                        <li><a href="">FAQ</a></li>
                        <li><a href="">News</a></li>
                        <li><a href="">Contact Us</a></li>
                    </ul>
                </div>
                <div class="inner-right">
                    <p>Copyright © 2025 TrustedMartCo.&nbsp;<a href="">Privacy Policy</a></p>
                    <p><a class="ct-u-motive-color" href="#" target="_blank">Web Design</a> by Mahmud Ullah</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
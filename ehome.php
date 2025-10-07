<!DecoType HTML>

<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>TrustedMart - Online Shopping in Bangladesh</title>
        <link rel="stylesheet" type="text/css" href="estyle.css">

        <link href="https://cdn.materialdesignicons.com/3.6.95/css/materialdesignicons.min.css" media="all" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

        <link style="width: 100%;height: 100%" rel="tab icon" href="store_images/TM.png"/>
    
    </head>

    <?php
        ini_set('error_reporting', 'E_COMPILE_ERROR|E_RECOVERABLE_ERROR|E_ERROR|E_CORE_ERROR');

        include 'connection.php';
        $conn = OpenCon();

        if (mysqli_connect_errno())
        {
            echo "Unable to connect to server " . mysqli_connect_error();
        }

        session_start();
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
            $query = "SELECT * FROM userss WHERE user_id = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "s", $un);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $number_of_rows = mysqli_num_rows($result);
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
            mysqli_stmt_close($stmt);
        }
        
        $qu = 'SELECT wallet from userss where user_id=?';
        $stmt = mysqli_prepare($conn, $qu);
        mysqli_stmt_bind_param($stmt, "s", $un);
        mysqli_stmt_execute($stmt);
        $resu = mysqli_stmt_get_result($stmt);
        $ro=$resu->fetch_assoc();
        $wallet = $ro['wallet'];
        $_SESSION['wallet']=$wallet;
        mysqli_stmt_close($stmt);
    ?>
    
    <script type="text/javascript">
        function checkpass() {
            const oldPass = document.getElementById("oldppa").value;
            const newPass = document.getElementById("passaa").value;
            const confirmPass = document.getElementById("passbb").value;
            const submitBtn = document.getElementById("chpp");

            if (oldPass.trim() !== "" && newPass.trim() !== "" && confirmPass.trim() !== "" && newPass === confirmPass) {
                submitBtn.disabled = false;
            } else {
                submitBtn.disabled = true;
            }
        }
        function showhidepass()
        {
            var x=document.getElementById("passaa");
            var y=document.getElementById("passbb");
            if(x.type == "password")
            {
                x.type="text";
            }
            else if(x.type == "text")
            {
                x.type="password";
            }
        }
        $(document).ready(function(){
            $('.menu-toggle').click(function(){
                $('nav').toggleClass('active')
            })
        })
        $(document).ready(function(){
                    $(document).on("click", "#changepasswordBtn", function(event){
                        event.preventDefault();
                        $("#changepasswordModal").modal();            });
        });

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
    
        function showhidediv(id)
        {
            var a=document.getElementById(id);
            if(a.style.display === "none")
            {
                a.style.display = "block";
            }
            else
            {
                a.style.display = "none";
            }
        }
    </script>

    <body style="color: #f1f2f7">
        <header>        
            <div class="logo"><a href="ehome.php"><img class="logoClass" src="store_images/mmmyyylogo.png"></a></div>
            <nav role="header">
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
                            <li><a href="#" id="changepasswordBtn" class="mdi mdi-textbox-password"><font size="2"><b>Change Password</b></font></a></li>
                            <li><a href="logout.php" target="_self" class="mdi mdi-logout">Logout</a></li>
                            <?php
                                echo 
                                '<li>
                                    <a class="mdi mdi-wallet" id="walletBtn" href="#">
                                        <font size = "2">Tk. '.$wallet.'</font>
                                    </a>
                                </li>'
                            ?>
                            <li><a href="addcouponcode.php" class="mdi mdi-credit-card-plus">Add Money</a></li>
                        </ul>
                    </label>
                </ul>
            </nav>
            <div class="menu-toggle"><i class="fa fa-bars" aria-hidden="true"></i></div>
        </header>
        
        <br>
        <br>
        <br>

        <div class="catsearchDiv">
            <nav role="catmenu" id='categorymenu'>
                <ul>
                    <li role="plusminusANDtext"><a href='#' class="plusMinus" style="margin-top: 1px;height: 10px;box-sizing : border-box;border-radius: 5px;outline: none;border: 4px solid #2196f3;text-align: center;" >CATEGORIES</a>
                        <ul>
                            <?php
                                $query = 'SELECT category_name FROM category';
                                $result = mysqli_query($conn,$query);
                                
                                while($row = $result->fetch_assoc())
                                {
                                    echo "<li role='plusminus'><a href='search.php?query=".$row['category_name']."'>".$row['category_name']."</a> </li>";
                                }            
                            ?>
                    
                        </ul>
                    </li>
                </ul>
            </nav>

            <form class="search" method="POST" action="search.php">
                <input type="text" name="sp" class="searchTerm" pattern="\S+.*" placeholder="Search in TrustedMart ...">
                <input type="submit" class="searchButton">
                
                <select class="filterclass" name="search_filters" id="search_filters" onchange="searchfilters(this.options[this.selectedIndex].value)">
                    <option value="no_filters">No filters </option>
                    <option value="price_lth">Price Low to High </option>
                    <option value="price_htl">Price High to Low</option>
                    <option value="date_added_r">Recent Products</option>
                    <option value="date_added_o">Old Added Products</option>
                </select>
            </form>
            
            <div class="cart"><a href="mycart.php"><img class="cartClass" src="store_images/cart (4).png"></a></div>
        </div>
        
        <div class="slideBack container" style="width: 100%">
            <div id="myCarousel" class="carousel slide" data-ride="carousel" style="width: 50%;margin-left: 25%;">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                    <li data-target="#myCarousel" data-slide-to="4"></li>
                </ol>

                <div class="carousel-inner">
                    <div class="item active">
                        <img src="store_images/nike shoe-1.jpg" alt="" style="width:100%;">
                        <div class="carousel-caption">
                            <h3></h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="store_images/nike shoe-2.jpg" alt="" style="width:100%;">
                        <div class="carousel-caption">
                            <h3></h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="store_images/nike shoe-3.jpg" alt="" style="width:100%;">
                        <div class="carousel-caption">
                            <h3></h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="store_images/nike shoe-5.jpg" alt="" style="width:100%;">
                        <div class="carousel-caption">
                            <h3></h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="store_images/nike shoe-6.jpg" alt="" style="width:100%;">
                        <div class="carousel-caption">
                            <h3></h3>
                            <p></p>
                        </div>
                    </div>
                </div>

                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

        </br>
        </br>
        </br>

        <div class="container" style="border: 1px solid #ff6d4d;border-radius: 10px ;margin-top: 5px;">
            <div class="row">
                <?php
                    $disp_lp='SELECT product_id,product_name,products.category_id,category_name,date_added,price,icon_name,description FROM category,products WHERE (products.category_id=category.category_id) ORDER BY date_added DESC';
                    $result = mysqli_query($conn,$disp_lp);
                    while($row = $result->fetch_assoc())
                    {
                        $productid=$row['product_id'];
                        $productname=$row['product_name'];
                        $productcategory=$row['category_name'];
                        $productprice=$row['price'];
                        $productdescription=$row['description'];
                        $image=$row['icon_name'];

                        $link =  '<a href="product.php?product_id='.$productid.'">';
                ?>
                        <div class="col-md-3 col-sm-6" style="margin-top: 25px;margin-bottom: 25px">
                            <div class="product-grid7" style="border: 1px solid #262626">
                                <div class="product-image7">
                                    <?php
                                        echo '<a href="product.php?product_id='.$productid.'">
                                                <img class="pic-1" src="images/'.$image.'" height="300" width="250">
                                        </a>'
                                        ?>
                                    <ul class="social">
                                        <li><?php echo '<a href="product.php?product_id='.$productid.'" class="fa fa-search"></a>' ?></li>
                                        <li><a href="" class="fa fa-shopping-cart"></a></li>
                                    </ul>
                                    <span class="product-new-label">New</span>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="#"><?php echo $productname ?></a></h3>
                                    <ul class="rating">
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                        <li class="fa fa-star"></li>
                                    </ul>
                                    <div class="price"><?php echo $productprice ?> Tk. 
                                        <span>20.00 Tk.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }                
                                    
                ?>
            </div>
        </div>
        
        <br><br><br>

        <br>
        <br>
        <br>
        <br>

        <div class="container">
            <div class="modal fade" id="changepasswordModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header" style="padding:35px 50px;">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4><span class="glyphicon glyphicon-lock"></span>Change Password</h4>
                        </div>
                        <div class="modal-body" id="change_pass_div" style="padding:40px 50px;">
                            <form role="form" method="POST" action="updateuserpassword.php">
                                <div class="form-group">
                                    <label for="currentpassword"><span class="glyphicon glyphicon-user"></span> Current Password</label>
                                    <input name="oldpassword" type="password" id="oldppa" required class="form-control" placeholder="Enter Current Password" onkeyup="checkpass();">
                                </div>
                                <div class="form-group">
                                    <label for="newpassword"><span class="glyphicon glyphicon-user"></span> New Password</label>
                                    <input name="newpassword" type="password" id="passaa" required class="form-control" placeholder="Enter New Password" onkeyup="checkpass();">
                                </div>
                                <div class="form-group">
                                    <label for="confirmpassword"><span class="glyphicon glyphicon-user"></span> Confirm Password</label>
                                    <input name="confirmpassword" type="password" id="passbb" required class="form-control" placeholder="Confirm Password" onkeyup="checkpass();">
                                </div>

                                <div class="checkbox">
                                    <label><input type="checkbox" value="" id="showpass" onchange="showhidepass()">Show Password</label>
                                </div>
                                <button type="submit" class="btn btn-success btn-default pull-right" id="chpp" disabled>Save Changes</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
                            <span class="glyphicon glyphicon-remove"></span> Cancel</button>
                        </div>
                    </div>
                </div>
            </div> 
        </div>

        <footer class="ct-footer">
            <div class="container">
                <ul class="ct-footer-list text-center-sm">
                    <li>
                        <h2 class="ct-footer-list-header">Learn More</h2>
                        <ul>
                            <li>
                                <a href="info.php">About us</a>
                            </li>
                            
                        </ul>
                    </li>
                    
                    <li>
                        <h2 class="ct-footer-list-header">Services</h2>
                        <ul>
                            <li>
                                <a href="#" onclick="alert('Design: At TrustedMart, our design team creates visually appealing and user-friendly interfaces for our online store. We focus on innovative shoe designs and a seamless shopping experience tailored to your preferences!')">Design</a>
                            </li>
                            <li>
                                <a href="#" onclick="alert('Marketing: Our marketing team promotes TrustedMart through targeted campaigns, social media, and special offers to bring the best shoe deals to customers across Bangladesh!')">Marketing</a>
                            </li>
                            <li>
                                <a href="#" onclick="alert('Sales: Our sales team ensures smooth transactions and provides excellent customer support to help you find and purchase the perfect shoes with ease!')">Sales</a>
                            </li>
                            <li>
                                <a href="#" onclick="alert('Programming: Our programming experts develop and maintain the robust platform that powers TrustedMart, ensuring a secure and efficient online shopping environment!')">Programming</a>
                            </li>
                            <li>
                                <a href="#" onclick="alert('Support: Our support team is dedicated to assisting you with any issues, from order inquiries to technical help, ensuring your shopping experience is hassle-free!')">Support</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <h2 class="ct-footer-list-header">Our Team</h2>
                        <ul>
                            <li>
                                <a href="info.php">Developers</a>
                            </li>
                            
                        </ul>
                    </li>
                    
                    <li>
                        <h2 class="ct-footer-list-header">Customer Care</h2>
                        <ul>
                            <li>
                                <a href="#" onclick="alert('Welcome to TrustedMart Help Centre!\n\nFor assistance, please contact us:\n- Email: 2230406@iub.edu.bd or mahmudsets@gmail.com\n- Phone: 01875351392\n- Hours: 9 AM - 6 PM, Monday to Friday\n\nWe are here to help with your shopping queries!')">Help Centre</a>
                            </li>
                            <li>
                                <a href="#" onclick="alert('You can add money in your wallet through coupons. Coupons are avaiable at general stores. Add money using coupon and add products you want to buy in cart. After that press check out button. Products will be deleivered at your door step')" >How to buy?</a>
                            </li>
                            <li>
                                <a href="#" onclick="alert('This feature is not working at the moment. Please try later')" >Track Your Order</a>
                            </li>
                            <li>
                                <a href="#" onclick="alert('You can buy coupons from General Stores around your house')" >How to get coupon?</a>
                            </li>
                            <li>
                                <a href="#" onclick="alert('At your given address the products will be delievered');" >Delivery method</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <h2 class="ct-footer-list-header">TrustedMart</h2>
                        <ul>
                            <li>
                                <a href="info.php">About Us</a>
                            </li>
                            <li>
                                <a href="#" onclick="alert('We will not be responsible if you give incorrect address. Products will be deleivered once on user confirmation. If user fails to receive, company is not responsible for it.')" >Terms and Conditions</a>
                            </li>
                            <li>
                                <a href="#" onclick="alert('You can email us at \n 2230406@iub.edu.bd \n mahmudsets@gmail.com \n')" >Contact Us</a>
                            </li>
                        </ul>
                      </li>
                </ul>
            

                <div class="ct-footer-meta text-center-sm">
                    <div class="row">
                        <div class="col-sm-6 col-md-2">
                            <img class="footerlogo" alt="logo" src="store_images/TM.PNG">
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <address>
                                <span>TrustedMart Co.<br></span>
                                Alif Tower<br>Dhaka, Bangladesh<br>
                                <span>Phone: <a href="tel:5555555555">01875351392</a></span>
                            </address>
                        </div>
                        
                        
                        <div class="col-sm-6 col-md-3">
                            <ul class="ct-socials list-unstyled list-inline">
                                <li>
                                    <a href="#" target="_blank"><img alt="facebook" src="store_images/Social-Media logo.png"></a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="ct-footer-post">
                <div class="container">
                    <div class="inner-left">
                        <ul>
                            <li>
                                <a href="">FAQ</a>
                            </li>
                            <li>
                                <a href="">News</a>
                            </li>
                            <li>
                                <a href="">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="inner-right">
                        <p>Copyright © 2025 TrustedMartCo.&nbsp;<a href="">Privacy Policy</a></p>
                        <p><a class="ct-u-motive-color" href="" target="_blank">Web Design</a> by Mahmud Ullah <a href="" target="_blank"></a></p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
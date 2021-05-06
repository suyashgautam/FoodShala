<?php
session_start();
include './dbConnection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="./css/all.min.css">

    <link rel="stylesheet" href="./css/custom.css">

    <link rel="stylesheet" href="./css/jumbo.css">
    <link rel="stylesheet" href="./css/slider.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Foodshala</title>
</head>

<body>

    <!-- Nav menu with user information -->
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark p-0 pmd-navbar pmd-z-depth fixed-top">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Foodshala</a>

        <div class="navbar-nav ml-auto">
            <div class="dropdown pmd-dropdown pmd-user-info ml-auto mr-2"
                style="display: <?php if (isset($_SESSION["is_customer_login"])) {echo "inline";} else {echo "none";}?>">
                <a href="Customer/CustomerCart.php"><span style="color:green; font-size:30px;"><i
                            class="fas fa-shopping-cart" aria-hidden="true"><span style="color:red;" id="cart"
                                class="badge badge-light"></span></i></span></a>
            </div>


            <div class="dropdown pmd-dropdown pmd-user-info mr-3">
                <?php
$link;

if (isset($_SESSION["is_customer_login"])) {
    $link = "./Customer/CustomerProfile.php";
} else {
    if (isset($_SESSION["is_restaurant_login"])) {
        $link = "./Restaurants/RestaurantProfile.php";
    }
}
if (isset($_SESSION['is_customer_login']) || (isset($_SESSION['is_restaurant_login']))) {
    $name;
    if (isset($_SESSION['is_customer_login'])) {
        $email = $_SESSION['rEmail'];
        $sql   = "SELECT * from customerlogin_tb where c_email = '$email'";
        $query = mysqli_query($conn, $sql);
        $row   = mysqli_fetch_array($query);
        $name  = $row['c_name'];
        $img   = 'Customer/' . $row['c_image'];

    }
    if (isset($_SESSION['is_restaurant_login'])) {
        $email = $_SESSION['rEmail'];
        $sql   = "SELECT * from restaurantlogin_tb where r_email = '$email'";
        $query = mysqli_query($conn, $sql);
        $row   = mysqli_fetch_array($query);
        $name  = $row['r_name'];
        $img   = 'Restaurants/' . $row['r_image'];
    }
    echo '
            <a href="javascript:void(0);" class="btn-user dropdown-toggle media align-items-center" data-toggle="dropdown" data-sidebar="true" aria-expanded="false">
            <img class="mr-2" src="' . $img . '" width="40" height="40" style = "border-radius: 50px" alt="avatar">
            <div style = "color: white;" class="media-body">
                ' . $name . '
            </div>
            <i class="fas fa-ellipsis-v" aria-hidden="true">    </i>
        </a>
        <ul class="dropdown-menu dropdown-menu-right" role="menu">
            <a class="dropdown-item" href="' . $link . '">Dashboard</a>
            <a class="dropdown-item" href="./logout.php">Logout</a>
        </ul></div>';

} else {
    echo '
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myLoginModal">
            Login
          </button>
          /
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#mySignupModal">
          Signup
        </button>
        </div></div>
        ';
}
?>
            </div>
    </nav>

    <div class="modal fade" id="mySignupModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100">Signup</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">
                        <div class="card-columns d-flex justify-content-center">
                            <div class="card" style="width: 18rem;">
                                <div class="card-block">
                                    <a href="./Customer/CustomerRegistration.php">
                                        <img class="card-img-top" src="./images/customer.jpg" alt="Card image cap"
                                            height="150" width="50"></a>
                                    <h4 class="card-title">Customer Signup</h4>
                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <div class="card-block">
                                    <a href="./Restaurants/RestaurantRegistration.php">
                                        <img class="card-img-top" src="./images/rest.jpg" alt="Card image cap"
                                            height="150" width="50"></a>
                                    <h4 class="card-title">Restaurant Signup</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>






    <!-- The Modal -->
    <div class="modal fade" id="myLoginModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100">Login</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">
                        <div class="card-columns d-flex justify-content-center">
                            <div class="card" style="width: 18rem;">
                                <div class="card-block">
                                    <a href="./Customer/CustomerLogin.php">
                                        <img class="card-img-top" src="./images/customer.jpg" alt="Card image cap"
                                            height="150" width="50"></a>
                                    <h4 class="card-title">Customer Login</h4>
                                </div>
                            </div>
                            <div class="card" style="width: 18rem;">
                                <div class="card-block">
                                    <a href="./Restaurants/RestaurantLogin.php">
                                        <img class="card-img-top" src="./images/rest.jpg" alt="Card image cap"
                                            height="150" width="50"></a>
                                    <h4 class="card-title">Restaurant Login</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <br>
    <br>
    <?php
$rest_id = "";
if (isset($_REQUEST['All_Dishes'])) {
    $rest_id = $_REQUEST['rest_id'];
}
?>
    <?php
    if (isset($_REQUEST['All'])) {
    $rest_id = '';
    }
    ?>

    <div class="jumbotron img-jumbo">
        <div class="container text-center">
            <h1 class="text-white" style="font-size: 6rem;"><strong>Foodshala</strong></h1>
            <h3 class="text-white">Discover the best food and drinks around you.</h3>
        </div>
    </div>


    <h1><strong>Restaurants</strong></h1>
    <br>
    <div class="wrapper">
        <?php
            $sectionid = 1;
            $itemcnt = 0;
if ($query = mysqli_query($conn, "select rest_id, r_image, r_name, r_address from restaurantlogin_tb")) {
    if (mysqli_num_rows($query)) {
        while ($row = mysqli_fetch_array($query)) {
            $itemcnt = $itemcnt + 1;
            if($itemcnt == 1)
            {
                echo "<section id='section$sectionid'>";
                echo "<a href='#section$sectionid' class='arrow__btn'>‹</a>";                
            }
            if($itemcnt > 5)
            {
                $itemcnt = 1;
                $temp = $sectionid;
                $sectionid = $sectionid + 1;

                echo "<section id='section$sectionid'>";
                echo "<a href='#section$temp' class='arrow__btn'>‹</a>";                
            }
            ?>
        <div class="item card">
            <!-- <div style="border-radius:10px;" class="card"> -->
            <img src="<?php if ($row['r_image'] != "") {
                echo './Restaurants/' . $row['r_image'];
            } else {
                echo "../image-not-available.jpg";
            }
            ?>" alt="" class="card-img-top" height="250" width="300">
            <div class="card-body text-center">
                <h5 class="card-title"><strong><?php echo $row['r_name']; ?></strong></h5>
                <p class="card-text">Address: <?php echo $row['r_address']; ?></p>
                <form method="POST">
                    <button type="submit" name="All_Dishes" class="btn btn-default">All Dishes</button>
                    <input type="hidden" name="rest_id" value="<?php echo $row['rest_id']; ?>">
                </form>
            </div>
            <!-- </div> -->
        </div>

        <?php
if($itemcnt == 5){
    $tt = $sectionid + 1;
    echo "<a href='#section$tt' class='arrow__btn'>›</a>";
    echo "</section>";
}
?>

        <?php
}
if($itemcnt != 5){
    while($itemcnt < 5)
    {
        echo "        <div class='item card'>
        <!-- <div style='border-radius:10px;' class='card'> -->
        <img src='./cs.jpg' alt='' class='card-img-top' height='250' width='100'>
        <div class='card-body text-center'>
            <h5 class='card-title'>Coming Soon</h5>
            <p class='card-text'>Address: </p>
                <button type='submit' name='#' class='btn btn-default'>All Dishes</button>
                <input type='hidden' name='rest_id' value=''>
        </div>
        <!-- </div> -->
    </div>";
    $itemcnt = $itemcnt + 1;
    }

    echo "<a href='#section1' class='arrow__btn'>›</a>";
    echo "</section>";
}
    } else {
        $msg = "please add some Items";
    }
} else {
    echo "failed";
}

?>

    </div>

    <br>
    <hr>


    <div class="container mt-5 dishes">
        <h1><strong>Dishes</strong></h1>
        <form method="POST">
            <button type="submit" name="All" class="btn btn-info">All Dish</button>
        </form>
        <br>
        <div class="row">
            <?php

$sql;
if ($rest_id != "") {
    $sql = "select * from dishes_tb where rest_id = $rest_id";
} else {
    $sql = "select * from dishes_tb";
}
if ($query = mysqli_query($conn, $sql)) {
    if (mysqli_num_rows($query)) {
        while ($row = mysqli_fetch_array($query)) {
            $resto_id   = $row['rest_id'];
            $sql        = "SELECT r_name FROM restaurantlogin_tb WHERE rest_id = '$resto_id'";
            $temp_query = mysqli_query($conn, $sql);
            $rows       = mysqli_fetch_array($temp_query);
            $r_name     = $rows['r_name'];
            ?>

            <div class="col-lg-3 mb-5">
                <div class="card">
                    <img src="<?php if ($row['d_image'] != "") {
                echo './Restaurants/' . $row['d_image'];
            } else {
                echo "./image-not-available.jpg";
            }
            ?>" height="150" width="100%" alt="" class="card-img-top">
                    <form action="./Customer/manage_cart.php" method="POST">
                        <div class="card-body text-center">
                            <h5 class="card-title"><strong><?php echo $row['d_name']; ?></strong></h5>
                            <p class="card-text"><em>Price:</em> Rs. <?php echo $row['d_cost']; ?></p>
                            <p class="card-text"><em>Type: </em><?php echo $row['d_type']; ?></p>
                            <p class="card-text"><em>Restaurant:</em> <?php echo $r_name; ?></p>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                            <button type="submit" name="Add_To_Cart" class="btn btn-info">Add to Cart</button>
                            <input type="hidden" name="d_id" value="<?php echo $row['d_id']; ?>">
                            <input type="hidden" name="r_id" value="<?php echo $row['rest_id']; ?>">
                            <input type="hidden" name="d_cost" value="<?php echo $row['d_cost']; ?>">
                            <input type="hidden" name="Item_Name" value="<?php echo $row['d_name']; ?>">
                        </div>
                    </form>
                </div>
            </div>

            <?php
}
    } else {
        $msg = "please add some Items";
    }
} else {
    echo "failed";
}

?>
        </div>
    </div>
    <footer class="text-center text-white" style="background-color: #f1f1f1;">
        <!-- Grid container -->
        <div class="container pt-4">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-facebook-f"></i></a>

                <!-- Twitter -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-twitter"></i></a>

                <!-- Google -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-google"></i></a>

                <!-- Instagram -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-instagram"></i></a>

                <!-- Linkedin -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-linkedin"></i></a>
                <!-- Github -->
                <a class="btn btn-link btn-floating btn-lg text-dark m-1" href="#!" role="button"
                    data-mdb-ripple-color="dark"><i class="fab fa-github"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2021 Copyright:
            <a class="text-dark" href="https://suyashgautam.me/">Suyash Gautam</a>
        </div>
        <!-- Copyright -->
    </footer>

    <script src="./js/jquery.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/all.min.js"></script>
</body>

</html>
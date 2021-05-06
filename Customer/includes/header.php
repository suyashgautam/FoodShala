<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        <?php echo TITLE ?>
    </title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">

    <!-- Custome CSS -->
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.php">Foodshala</a>
    </nav>

    <!-- Side Bar -->
    <div class="container-fluid mb-5 " style="margin-top:40px;">
        <div class="row">
            <nav class="col-sm-2 bg-light sidebar py-5 d-print-none">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'CustomerProfile') { echo 'active'; } ?>"
                                href="CustomerProfile.php">
                                <i class="fas fa-user"></i>
                                Profile <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'Cart') { echo 'active'; } ?>" href="CustomerCart.php">
                                <i class="fab fa-accessible-icon"></i>
                                Cart
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'PreviousOrders') { echo 'active'; } ?>"
                                href="CustomerOrders.php">
                                <i class="fas fa-align-center"></i>
                                Previous Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if(PAGE == 'Customerchangepass') { echo 'active'; } ?>"
                                href="CustomerChangePass.php">
                                <i class="fas fa-key"></i>
                                Change Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">
                                <i class="fas fa-sign-out-alt"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
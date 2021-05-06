<?php
include '../dbConnection.php';

if (isset($_REQUEST['rSignup'])) {
 // Checking for Empty Fields
 if (($_REQUEST['rName'] == "") || ($_REQUEST['rEmail'] == "") || ($_REQUEST['rPassword'] == "") || ($_REQUEST['rAddress'] == "")) {
  $regmsg = '<div class="alert alert-warning mt-2" role="alert"> All Fields are Required </div>';
 } else {
  $sql    = "SELECT r_email FROM restaurantlogin_tb WHERE r_email='" . $_REQUEST['rEmail'] . "'";
  $result = $conn->query($sql);
  if ($result->num_rows == 1) {
   $regmsg = '<div class="alert alert-warning mt-2" role="alert"> Email ID Already Registered </div>';
  } else {
   // Assigning User Values to Variable
   if (isset($_POST['rSignup'])) {
    $rName     = $_REQUEST['rName'];
    $rAddress  = $_REQUEST['rAddress'];
    $rEmail    = $_REQUEST['rEmail'];
    $rPassword = $_REQUEST['rPassword'];
    if ($_FILES['f1']['name']) {
     move_uploaded_file($_FILES['f1']['tmp_name'], "image/" . $_FILES['f1']['name']);
     $img = "image/" . $_FILES['f1']['name'];
    }
    // $rImage = 'image/'.$_FILES['rImage']['name'];
    $sql = "INSERT INTO restaurantlogin_tb(r_name, r_email, r_password, r_address, r_image) VALUES ('$rName','$rEmail', '$rPassword', '$rAddress', '$img')";
    if ($conn->query($sql) == true) {
     $regmsg = '<div class="alert alert-success mt-2" role="alert"> Account Succefully Created </div>';
    } else {
     $regmsg = '<div class="alert alert-danger mt-2" role="alert"> Unable to Create Account </div>';
    }
   }
  }
 }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="../css/all.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->


    <style>
    .custom-margin {
        margin-top: 8vh;
    }
    </style>
    <title>Restaurant Signup</title>
</head>

<body>
    <div class="mb-3 text-center mt-5" style="font-size: 30px;">
        <i class="fas fa-utensils"></i>
        <span><strong>Foodshala</strong></span>
    </div>
    <p class="text-center" style="font-size: 20px;"> <i class="fas fa-user-secret text-danger"></i> <span>Restaurant
            Signup</span>
    </p>
    <div class="container pt-5" id="registration">
        <h2 class="text-center">Create an Account</h2>
        <div class="row mt-4 mb-4">
            <div class="col-md-6 offset-md-3">
                <form action="" class="shadow-lg p-4" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <i class="fas fa-user"></i><label for="name" class="pl-2 font-weight-bold">Name</label><input
                            type="text" class="form-control" placeholder="Name" name="rName">
                    </div>

                    <div class="form-group">
                        <i class="fas fa-address-book"></i><label for="address"
                            class="pl-2 font-weight-bold">Address</label><input type="text" class="form-control"
                            placeholder="Address" name="rAddress">
                    </div>

                    <div class="form-group">
                        <i class="fas fa-envelope"></i><label for="email"
                            class="pl-2 font-weight-bold">Email</label><input type="email" class="form-control"
                            placeholder="Email" name="rEmail">
                        <!--Add text-white below if want text color white-->
                        <small class="form-text">We'll never share your email with anyone else.</small>
                    </div>

                    <div class="form-group">
                        <i class="fas fa-key"></i><label for="pass" class="pl-2 font-weight-bold">New
                            Password</label><input type="password" class="form-control" placeholder="Password"
                            name="rPassword">
                    </div>

                    <div class="form-group">
                        <i class="fas fa-image"></i><label for="img" class="pl-2 font-weight-bold">Image
                        </label><input type="file" class="form-control" name="f1">
                    </div>

                    <button type="submit" class="btn btn-danger mt-5 btn-block shadow-sm font-weight-bold"
                        name="rSignup">Sign Up</button>
                    <em style="font-size:10px;">Note - By clicking Sign Up, you agree to our Terms, Data
                        Policy and Cookie Policy.</em>
                    <?php if (isset($regmsg)) {echo $regmsg;}?>
                </form>
                <div class="text-center"><a class="btn btn-info mt-3 shadow-sm font-weight-bold"
                        href="../index.php">Back
                        to Home</a></div>
            </div>
        </div>
    </div>
    </div>

    <!-- Boostrap JavaScript -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/all.min.js"></script>

</body>

</html>
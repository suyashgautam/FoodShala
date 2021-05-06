<?php
define('TITLE', 'Restaurant Profile');
define('PAGE', 'RestaurantProfile');
include 'includes/header.php';
include '../dbConnection.php';
session_start();
if ($_SESSION['is_restaurant_login']) {
 $rEmail = $_SESSION['rEmail'];
} else {
 echo "<script> location.href='RestaurantLogin.php'; </script>";
}

$sql    = "SELECT * FROM restaurantlogin_tb WHERE r_email='$rEmail'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
 $row      = $result->fetch_assoc();
 $rName    = $row["r_name"];
 $rAddress = $row['r_address'];
 $rImage   = $row['r_image'];
}

if (isset($_REQUEST['nameupdate'])) {
 if (($_REQUEST['rName'] == "" || $_REQUEST['rAddress'] == "")) {
  // msg displayed if required field missing
  $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
 } else {
  $r_Name    = trim($_REQUEST["rName"]);
  $r_Address = trim($_REQUEST['rAddress']);
  if ($_FILES['f1']['name']) {
   move_uploaded_file($_FILES['f1']['tmp_name'], "image/" . $_FILES['f1']['name']);
   $img = "image/" . $_FILES['f1']['name'];
  } else {
   $img = $rImage;
  }
  $sql = "UPDATE restaurantlogin_tb SET r_name = '$r_Name', r_address = '$r_Address', r_image = '$img' WHERE r_email = '$rEmail'";
  if ($conn->query($sql) == true) {
   // below msg display on form submit success
   $passmsg  = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
   $rName    = trim($r_Name);
   $rAddress = trim($r_Address);
  } else {
   // below msg display on form submit failed
   $passmsg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Update </div>';
  }
 }
}
?>
<div class="col-sm-6 mt-5">
    <form class="mx-5" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <img src="<?php echo $rImage; ?>" alt="" height="150" width="150">
        </div>
        <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" value=" <?php echo $rEmail ?>" readonly>
        </div>
        <div class="form-group">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" id="inputName" name="rName" value=" <?php echo $rName ?>">
        </div>

        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="rAddress" value=" <?php echo $rAddress ?>">
        </div>
        <div class="form-group">
            <i class="fas fa-key"></i><label for="img" class="pl-2 font-weight-bold">Image
            </label><input type="file" class="form-control" name="f1">
        </div>
        <button type="submit" class="btn btn-danger" name="nameupdate">Update</button>
        <?php if (isset($passmsg)) {echo $passmsg;}?>
    </form>
</div>
</div>
</div>
<?php
include 'includes/footer.php';
?>
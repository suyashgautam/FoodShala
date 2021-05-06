<?php
define('TITLE', 'Customer Profile');
define('PAGE', 'CustomerProfile');
include 'includes/header.php';
include '../dbConnection.php';
session_start();
if ($_SESSION['is_customer_login']) {
 $rEmail = $_SESSION['rEmail'];
} else {
 echo "<script> location.href='CustomerLogin.php'; </script>";
}

$sql    = "SELECT * FROM customerlogin_tb WHERE c_email='$rEmail'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
 $row       = $result->fetch_assoc();
 $rName     = $row["c_name"];
 $c_phone   = $row['c_phone'];
 $c_address = $row['c_address'];
 $c_image   = $row['c_image'];
}

if (isset($_REQUEST['nameupdate'])) {
 if (($_REQUEST['rName'] == "" || $_REQUEST['rAddress'] == "" || $_REQUEST['rPhone'] == "")) {
  // msg displayed if required field missing
  $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
 } else {
  if ($_FILES['f1']['name']) {
   move_uploaded_file($_FILES['f1']['tmp_name'], "image/" . $_FILES['f1']['name']);
   $img = "image/" . $_FILES['f1']['name'];
  } else {
   $img = $c_image;
  }
  $rName    = trim($_REQUEST["rName"]);
  $rAddress = trim($_REQUEST['rAddress']);
  $rPhone   = trim($_REQUEST['rPhone']);

  $sql = "UPDATE customerlogin_tb SET c_name = '$rName', c_phone = $rPhone, c_address = '$rAddress', c_image = '$img'  WHERE c_email = '$rEmail'";
  if ($conn->query($sql) == true) {
   // below msg display on form submit success
   $passmsg   = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
   $rName     = trim($rName);
   $c_phone   = trim($rPhone);
   $c_address = trim($rAddress);
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
            <img src="<?php echo $c_image; ?>" alt="" height="150" width="150">
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
            <input type="text" class="form-control" id="inputAddress" name="rAddress" value=" <?php echo $c_address ?>">
        </div>
        <div class="form-group">
            <label for="inputPhone">Phone</label>
            <input type="tel" class="form-control" id="inputPhone" name="rPhone" value=" <?php echo $c_phone ?>">
        </div>
        <div class="form-group">
            <i class=""></i><label for="img" class="pl-2 font-weight-bold">Image
            </label><input type="file" class="form-control" name="f1">
        </div>
        <button type="submit" class="btn btn-danger" name="nameupdate">Update</button>
        <?php if (isset($passmsg)) {echo $passmsg;}?>
    </form>
</div>
</div>

<?php
include 'includes/footer.php';
?>
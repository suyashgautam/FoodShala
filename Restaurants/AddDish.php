<?php
define('TITLE', 'Add Dish');
define('PAGE', 'AddDish');
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
 $row = $result->fetch_assoc();
}

$rName = $row["r_name"];
$rid   = $row["rest_id"];

if (isset($_REQUEST['AddDish'])) {
 $name = $_REQUEST['rName'];
 $cost = $_REQUEST['rCost'];
 $type = $_REQUEST['rPreference'];
 if ($_FILES['f1']['name']) {
  move_uploaded_file($_FILES['f1']['tmp_name'], "image/" . $_FILES['f1']['name']);
  $img = "image/" . $_FILES['f1']['name'];
 }
 else{
     $img="";
 }
 if (($_REQUEST['rName'] == "") || ($_REQUEST['rCost'] == "") || ($_REQUEST['rPreference'] == "")) {
  $regmsg = '<div class="alert alert-warning mt-2" role="alert"> All Fields are Required </div>';
 } else {
  $sql    = "SELECT * FROM dishes_tb WHERE rest_id='" . $rid . "' AND d_name = '" . $name . "'";
  $result = $conn->query($sql);

  if ($result) {
   if ($result->num_rows == 1) {
    $regmsg = '<div class="alert alert-warning mt-2" role="alert"> Dish is already present in the Menu. </div>';
   } else {

    $sql = "INSERT INTO dishes_tb (rest_id, d_name, d_cost, d_type, d_image) VALUES ('$rid','$name', '$cost', '$type', '$img')";
    if ($conn->query($sql) == true) {
     $regmsg = '<div class="alert alert-success mt-2" role="alert"> Dish Succefully Added </div>';
    } else {
     $regmsg = '<div class="alert alert-danger mt-2" role="alert"> Unable to Add Dish </div>';
    }

   }
  } else {

   $sql = "INSERT INTO dishes_tb (rest_id, d_name, d_cost, d_type, d_image) VALUES ('$rid','$name', '$cost', '$type', '$img')";
   if ($conn->query($sql) == true) {
    $regmsg = '<div class="alert alert-success mt-2" role="alert"> Dish Succefully Added </div>';
   } else {
    $regmsg = '<div class="alert alert-danger mt-2" role="alert"> Unable to Add Dish </div>';
   }

  }
 }
}

?>

<div class="container pt-5" id="registration">
    <h2 class="text-center">Add Dish</h2>
    <div class="row mt-4 mb-4">
        <div class="col-md-6 offset-md-3">
            <form action="" class="shadow-lg p-4" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <i class="fas fa-user"></i><label for="name" class="pl-2 font-weight-bold">Dish Name</label><input
                        type="text" class="form-control" placeholder="Name" name="rName">
                </div>

                <div class="form-group">
                    <i class="fas fa-user"></i><label for="cost" class="pl-2 font-weight-bold">Cost</label><input
                        type="number" class="form-control" placeholder="Cost" name="rCost">
                </div>

                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <label for="preference" class="pl-2 font-weight-bold">Preference</label>
                    <select class=form-control name="rPreference">
                        <option>Veg</option>
                        <option>Non Veg</option>
                    </select>
                </div>

                <div class="form-group">
                    <i class="fas fa-key"></i><label for="img" class="pl-2 font-weight-bold">Image
                    </label><input type="file" class="form-control" name="f1">
                </div>

                <button type="submit" class="btn btn-danger mt-5 btn-block shadow-sm font-weight-bold"
                    name="AddDish">Add Dish</button>
                <?php if (isset($regmsg)) {echo $regmsg;}?>
            </form>
        </div>
    </div>
</div>

<?php
include './includes/footer.php';
?>
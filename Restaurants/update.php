<?php
define('TITLE', 'Restaurant Dishes');
define('PAGE', 'RestaurantDishes');
include 'includes/header.php';
include '../dbConnection.php';
session_start();
if ($_SESSION['is_restaurant_login']) {
 $rEmail = $_SESSION['rEmail'];
} else {
 echo "<script> location.href='RestaurantLogin.php'; </script>";
}

$food_id = $_GET['dish_id'];
$query   = mysqli_query($conn, "select * from dishes_tb   where d_id='$food_id'");
if (mysqli_num_rows($query)) {
 $row    = mysqli_fetch_array($query);
 $d_name = trim($row['d_name']);
 $d_cost = trim($row['d_cost']);
 $d_type = trim($row['d_type']);
 $d_img  = trim($row['d_image']);
}

if (isset($_REQUEST['dish_update'])) {
 if (($_REQUEST['name'] == "" || $_REQUEST['cost'] == "" || $_REQUEST['d_preference'] == "")) {
  // msg displayed if required field missing
  $passmsg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
 } else {

  $rName = trim($_REQUEST['name']);
  $cost  = trim($_REQUEST['cost']);
  $type  = trim($_REQUEST['d_preference']);
  if ($_FILES['f1']['name']) {
   move_uploaded_file($_FILES['f1']['tmp_name'], "image/" . $_FILES['f1']['name']);
   $img = "image/" . $_FILES['f1']['name'];
  } else {
   $img = $d_img;
  }
  $sql = "UPDATE dishes_tb SET d_name = '$rName', d_cost = '$cost', d_type = '$type', d_image='$img'  WHERE d_id = '$food_id'";
  if ($conn->query($sql) == true) {
   // below msg display on form submit success
   $passmsg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Updated Successfully </div>';
   $d_name  = trim($rName);
   $d_cost  = trim($cost);
   $d_type  = trim($type);
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
            <label for="inputdishname">Dish Name</label>
            <input type="text" name="name" class="form-control" id="inputdishname" value="<?php echo $d_name ?>">
        </div>
        <div class="form-group">
            <label for="inputName">Cost</label>
            <input type="text" class="form-control" id="inputCost" name="cost" value="<?php echo $d_cost ?>">
        </div>

        <div class="form-group">
            <i class="fas fa-user"></i>
            <label for="preference" class="pl-2 font-weight-bold">Preference</label>
            <select class=form-control name="d_preference">
                <option <?php if ($d_type == 'Veg') {
 echo "Selected";
}
?>>Veg</option>
                <option <?php if ($d_type == 'Non Veg') {
 echo "Selected";
}
?>>Non Veg</option>
            </select>
        </div>
        <div class="form-group">
            <i class="fas fa-key"></i><label for="img" class="pl-2 font-weight-bold">Image
            </label><input type="file" class="form-control" name="f1">
        </div>
        <button type="submit" class="btn btn-danger" name="dish_update">Update</button>
        <?php if (isset($passmsg)) {echo $passmsg;}?>
    </form>
</div>
</div>
</div>
<?php
include './includes/footer.php';
?>
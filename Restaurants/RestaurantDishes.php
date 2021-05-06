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

$sql    = "SELECT * FROM restaurantlogin_tb WHERE r_email='$rEmail'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
 $row = $result->fetch_assoc();
}

$rName = $row["r_name"];
$rid   = $row["rest_id"];

if (isset($_REQUEST['Delete'])) {
 $id = $_REQUEST['id'];
 if (mysqli_query($conn, "delete  from  dishes_tb where d_id='$id' ")) {
  echo "<script>alert('Dish succesfully deleted');</script>";
 } else {
  echo "<script>alert('Dish not deleted, Try again later');</script>";
 }
}

?>

<div class="container tab-content" id="myTabContent" style="align-items: center;">

    <div class="mt-5" id="viewitem" role="tabpanel" aria-labelledby="home-tab">
        <div class="container">
            <table border="1" bordercolor="#F0F0F0" cellpadding="20px">
                <th>Pic</th>
                <th>food name</th>
                <th>food Price</th>
                <th>Type</th>
                <th>Delete Item </th>
                <th>Update item Details </th>
                <?php
if ($query = mysqli_query($conn, "select dishes_tb.d_image,restaurantlogin_tb.rest_id,restaurantlogin_tb.r_email,dishes_tb.d_id,dishes_tb.d_name,dishes_tb.d_cost,dishes_tb.d_type,restaurantlogin_tb.r_name from restaurantlogin_tb inner join dishes_tb on restaurantlogin_tb.rest_id=dishes_tb.rest_id where restaurantlogin_tb.r_email='$rEmail'")) {
 if (mysqli_num_rows($query)) {
  while ($row = mysqli_fetch_array($query)) {
   ?>
                <tr>
                    <td><img src="<?php echo $row['d_image'] ?>" alt="" height="150" width="150"><br></td>
                    <td style="width:150px;"><?php echo $row['d_name'] . "<br>"; ?></td>
                    <td align="center" style="width:150px;"><?php echo $row['d_cost'] . "<br>"; ?></td>
                    <td align="center" style="width:150px;"><?php echo $row['d_type'] . "<br>"; ?></td>

                    <td align="center" style="width:150px;">

                        <!-- <a href="vendor_delete_food.php?food_id=""><button type="button" class="btn btn-warning">Delete </button></a> -->

                        <form method="POST"><input type="hidden" name="id" value="<?php echo $row['d_id']; ?>"><button
                                name="Delete" type="submit" class="btn btn-warning">Delete </button></form>


                    </td>
                    <td align="center" style="width:150px;">

                        <a href="update.php?dish_id=<?php echo $row['d_id'] ?>"><button type="button"
                                class="btn btn-danger">Update </button></a>
                    </td>
                </tr>

                <?php

   $foodname = "";
   $cuisines = "";
   $cost     = "";
  }
 } else {
  $msg = "please add some Items";
 }
} else {
 echo "failed";
}

?>
            </table>
        </div>
    </div>
    <?php
include './includes/footer.php';
?>
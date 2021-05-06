<?php
define('TITLE', 'Restaurant Orders');
define('PAGE', 'RestaurantOrders');
include './includes/header.php';
include '../dbConnection.php';
session_start();
if ($_SESSION['is_restaurant_login']) {
 $rEmail = $_SESSION['rEmail'];
} else {
 echo "<script> location.href='RestaurantLogin.php'; </script>";
}

?>



<div class="container">
    <div class='row dashboard-cards'>
        <?php
$email = $_SESSION['rEmail'];
$sql   = "SELECT rest_id from restaurantlogin_tb WHERE r_email = '$rEmail'";
//$sql = "SELECT * FROM restaurantlogin_tb WHERE r_email='$rEmail'";
$query = mysqli_query($conn, $sql);
$row   = mysqli_fetch_array($query);
$idd   = $row['rest_id'];
$sql   = "SELECT DISTINCT(o_id) FROM order_dishes WHERE r_id = $idd";
if ($query = mysqli_query($conn, $sql)) {
 if (mysqli_num_rows($query)) {
  $sr = 0;
  while ($row = mysqli_fetch_array($query)) {
   $sr      = $sr + 1;
   $temp_id = $row['o_id'];
   $t_sql   = "SELECT * FROM order_dishes WHERE o_id = $temp_id AND r_id = $idd";
   $t_query = mysqli_query($conn, $t_sql);
   $t1_row  = mysqli_fetch_array($t_query);
   ?>
        <div class='card col-md-8 '>
            <div class='card-title'>
                <h2>
                    Order ID: <?php echo $sr; ?>
                    <small><?php echo $t1_row['c_email']; ?></small>
                </h2>
                <div class='task-count'>
                    <?php echo mysqli_num_rows($t_query); ?>
                </div>
            </div>
            <div class='card-flap flap1'>
                <div class='card-description'>
                    <ul class='task-list'>
                        <?php
if ($t_query = mysqli_query($conn, $t_sql)) {
    if (mysqli_num_rows($t_query)) {
     while ($t_row = mysqli_fetch_array($t_query)) {
      $tt_id   = $t_row['d_id'];
      $p_sql   = "SELECT d_name FROM dishes_tb WHERE d_id = $tt_id";
      $p_query = mysqli_query($conn, $p_sql);
      $p_row   = mysqli_fetch_array($p_query);
      ?>
                        <li>
                            <?php echo $p_row['d_name']; ?>
                            <span>X <?php echo $t_row['d_quantity']; ?></span>
                        </li>

                        <?php
}
    }
   }
   ?>
                    </ul>
                </div>
                <div class='card-flap flap2'>
                    <div class='card-actions'>
                        <a class='btn' href='#'>Close</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
}
 }
}
?>

    </div>
</div>



<?php
include './includes/footer.php';
?>
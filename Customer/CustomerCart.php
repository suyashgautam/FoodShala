<?php
define('TITLE', 'My Cart');
define('PAGE', 'Cart');
include '../dbConnection.php';

session_start();
if (!isset($_SESSION['is_customer_login'])) {
 if (isset($_SESSION['is_restaurant_login'])) {
  echo '<script>alert("Please login as customer to order")</script>';
  echo "<script> location.href='CustomerLogin.php'; </script>";
 } else {
  echo "<script> location.href='CustomerLogin.php'; </script>";
 }
}

?>

<?php
include './includes/header.php'
?>

<div class="container text-center border rounded bg-light my-5">
    <h1>MY CART</h1>


    <div class="col-lg-9">
        <table class="table">
            <thead class="text-center">
                <tr>
                    <th scope="col">Serial No.</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Item Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
$total = 0;
$email = $_SESSION['rEmail'];

if (isset($_POST['purchase'])) {
 $new_o_id;
 $sql = "SELECT * FROM order_tb WHERE o_status = 'Cart' AND c_email = '$email'";
 if ($query = mysqli_query($conn, $sql)) {
  if (mysqli_num_rows($query)) {
   while ($row = mysqli_fetch_array($query)) {
    if (!isset($new_o_id)) {
     $new_o_id = $row['o_id'];
    }
    $d_id       = $row['d_id'];
    $d_quantity = $row['o_quantity'];
    $r_id       = $row['r_id'];
    $c_email    = $row['c_email'];
    $tempsql    = "INSERT INTO order_dishes (o_id, d_id, d_quantity, r_id, c_email) VALUES($new_o_id, $d_id, $d_quantity, $r_id, '$c_email')";
    if ($conn->query($tempsql)) {
     echo "<script>alert('Dishes are purchased');</script>";
    }
   }
  }
 }

 $sql              = "UPDATE order_tb SET o_status = 'InProcess' WHERE o_status = 'Cart' AND c_email = '$email'";
 $_SESSION['cart'] = array();
 if ($conn->query($sql)) {
  echo "<script>alert('Dishes are purchased');</script>";
 }
}

$sql = "SELECT * FROM order_tb WHERE c_email = '$email'";

if ($query = mysqli_query($conn, "select * from order_tb where c_email = '$email' and o_status = 'Cart'")) {
 if (mysqli_num_rows($query)) {
  $sr = 0;
  while ($row = mysqli_fetch_array($query)) {
   $sr    = $sr + 1;
   $total = $total + $row['o_payment'];
   ?>

                <tr>
                    <th scope='row'><?php echo $sr; ?></th>
                    <td><?php echo $row['d_name'] ?></td>
                    <td><?php echo $row['o_payment'] ?><input type='hidden' class='iprice'
                            value='<?php echo $row['o_payment'] ?>'></td>
                    <td><input class='text-center iquantity' onchange='subTotal()' type='number'
                            value='<?php echo $row['o_quantity'] ?>' min='1' max='10'></td>
                    <td class='itotal'></td>
                    <td>
                        <form action='./manage_cart.php' method='POST'>
                            <button name='Remove_Item' class='btn btn-sm btn-outline-danger'>REMOVE</button>
                            <input type='hidden' class="oid" name='o_id' value='<?php echo $row['o_id'] ?>'>
                            <input type='hidden' name='Item_Name' value='<?php echo $row['d_name'] ?>'>
                        </form>
                    </td>
                </tr>

                <?php

  }
 } else {
  $msg = "please add some Items";
 }
} else {
 echo "failed11";
}

?>
            </tbody>
        </table>

        <div class="col-lg-3">
            <div class="border bg-light rounded p-4">
                <h4>Grand Total:</h4>
                <h5 class="text-right" id="gtotal"></h5>
                <br>
                <form action="" method="POST">
                    <button name="purchase" class="btn btn-primary btn-block">Make Purchase</button>
                </form>
            </div>

        </div>

    </div>
</div>

<script>
var gt = 0;
var iprice = document.getElementsByClassName('iprice');
var oid = document.getElementsByClassName('oid');
var iquantity = document.getElementsByClassName('iquantity');
var itotal = document.getElementsByClassName('itotal');
var gtotal = document.getElementById('gtotal');

function subTotal() {
    gt = 0;
    var req = new XMLHttpRequest();
    for (i = 0; i < iprice.length; i++) {
        itotal[i].innerText = (iprice[i].value) * (iquantity[i].value);
        gt = gt + (iprice[i].value) * (iquantity[i].value);
        req.open("GET", 'https://foodshala-suyash-1.herokuapp.com/Customer/manage.php?oid=' + oid[i].value + '&' +
            'qty=' + iquantity[
                i].value + '&price=' + itotal[i].innerText, true);
        req.send()
        req.onreadystatechange = function() {
            if (req.status == 200) {
                //alert('Done Successfully');
            } else {
                alert('Failed123');
            }
        }
    }
    gtotal.innerText = gt;
}


subTotal();
</script>
<?php
include './includes/footer.php'
?>
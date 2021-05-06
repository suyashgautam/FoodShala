<?php
session_start();
include '../dbConnection.php';
if (isset($_SESSION['is_customer_login'])) {
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['Add_To_Cart'])) {
   $c_email  = $_SESSION['rEmail'];
   $r_id     = $_POST['r_id'];
   $d_id     = $_POST['d_id'];
   $o_status = "Cart";
   $d_price  = $_POST['d_cost'];
   $d_name   = $_POST['Item_Name'];
   if (isset($_SESSION['cart'])) {

    $myitems = array_column($_SESSION['cart'], 'Item_Name');
    if (in_array($_POST['Item_Name'], $myitems)) {
     echo "<script>
                    alert('Item Already Added');
                    window.location.href = '../index.php';
                    </script>";
    } else {
     $count                    = count($_SESSION['cart']);
     $_SESSION['cart'][$count] = array('Item_Name' => $_POST['Item_Name'], 'Price' => $_POST['d_cost'], 'Quantity' => 1);
     $sql                      = "INSERT INTO order_tb (r_id, d_id, c_email, o_payment, o_status, o_quantity, d_name) VALUES ('$r_id', '$d_id', '$c_email', '$d_price', 'Cart', '1', '$d_name')";
     if ($conn->query($sql) == true) {
      // $regmsg = '<div class="alert alert-success mt-2" role="alert"> Account Succefully Created </div>';
      echo "<script>
                        alert('Item Already Added');
                        window.location.href = '../index.php';
                        </script>";
     } else {
      // $regmsg = '<div class="alert alert-danger mt-2" role="alert"> Unable to Create Account </div>';
      echo "<script>
                        alert('Item Not Added Please try again');
                        window.location.href = '../index.php';
                        </script>";
     }
    }

   } else {
    $_SESSION['cart'][0] = array('Item_Name' => $_POST['Item_Name'], 'Price' => $_POST['d_cost'], 'Quantity' => 1);
    $sql                 = "INSERT INTO order_tb (r_id, d_id, c_email, o_payment, o_status, o_quantity, d_name) VALUES ('$r_id', '$d_id', '$c_email', '$d_price', 'Cart', '1', '$d_name')";
    if ($conn->query($sql) == true) {
     // $regmsg = '<div class="alert alert-success mt-2" role="alert"> Account Succefully Created </div>';
     echo "<script>
                        alert('Item Already Added');
                        window.location.href = '../index.php';
                        </script>";
    } else {
     // $regmsg = '<div class="alert alert-danger mt-2" role="alert"> Unable to Create Account </div>';
     echo "<script>
                        alert('Item Not Added Please try again');
                        window.location.href = '../index.php';
                        </script>";
    }

    // echo "<script>
    // alert('Item Already Added');
    // window.location.href = '../index.php';
    // </script>";
   }

  }

  if (isset($_POST['Remove_Item'])) {
   foreach ($_SESSION['cart'] as $key => $value) {
    if ($value['Item_Name'] == $_POST['Item_Name']) {
     unset($_SESSION['cart'][$key]);
     $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
   }
   $oid = $_POST['o_id'];
   echo $oid;
   $sql = "DELETE FROM order_tb WHERE o_id = '$oid' ";

   if ($conn->query($sql) == true) {
    // $regmsg = '<div class="alert alert-success mt-2" role="alert"> Account Succefully Created </div>';
    echo "<script>
                alert('Item Removed');
                window.location.href = './CustomerCart.php';
                </script>";
   } else {
    // $regmsg = '<div class="alert alert-danger mt-2" role="alert"> Unable to Create Account </div>';
    echo "<script>
                alert('Item Not Deleted Please try again');
                window.location.href = './CustomerCart.php';
                </script>";
   }
  }
 }
} else {
 echo "<script>window.location.href='./CustomerLogin.php';</script>";
}
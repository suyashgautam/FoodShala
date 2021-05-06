<?php
include '../dbConnection.php';
$oid   = $_GET['oid'];
$qty   = $_GET['qty'];
$price = $_GET['price'];
echo $oid, $qty, $price;

$sql = "update order_tb SET o_quantity = $qty WHERE o_id = $oid";
echo $sql;
if (mysqli_query($conn, $sql)) {
 // echo"<script>alert('Update done successfully');</script>";
} else {
 echo "<script>alert('Not done successfully');</script>";
}
<?php
include "db.php";
$id=$_GET['id'] ?? '';
$sql="DELETE FROM products where id='$id'";
$result=mysqli_query($conn, $sql);
if($result){
    header("Location:products.php");
    exit();
}


?>
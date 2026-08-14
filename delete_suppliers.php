<?php
include "db.php";
$id=$_GET['id'];
$sql="DELETE FROM suppliers where id='$id'";
$result=mysqli_query($conn, $sql);
if($result){
    header("Location:suppliers.php");
    exit();
}


?>
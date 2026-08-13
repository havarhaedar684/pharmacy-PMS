<?php
include "db.php";
$id=$_GET['id'];
$sql="DELETE FROM categories where id='$id'";
$result=mysqli_query($conn,$sql);
if($result){
    header("Location:categories.php");
    exit();
}
?>
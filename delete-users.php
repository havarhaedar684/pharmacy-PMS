<?php
include "db.php";
$id=$_GET['id'] ?? '';
$sql_d="DELETE FROM users WHERE id='$id'";
$result_d=mysqli_query($conn, $sql_d);
if($result_d){
 header("Location:show.php");
 exit();
}


?>
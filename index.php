<?php
session_start();
include "db.php";
$error;
if($_POST){
$email=$_POST['email'];
$pass=$_POST['password'];
$sql="SELECT * FROM users where email='$email' AND pass='$pass'";
$result=mysqli_query($conn, $sql);

if(mysqli_num_rows($result)>0){
   $row=mysqli_fetch_assoc($result);

$_SESSION['username']=$row['usename'];
$_SESSION['role']=$row['role'];

header("Location:show.php");
exit();

}else{
    $error="You can not login";
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Pharmacy POS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #96B6C5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.form-container {
    background: #ADC4CE;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    width: 350px;
}

.card-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
}

.icon-box {
    background-color: #155674;
    color: white;
    width: 45px;
    height: 45px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.card-header h2 {
    margin: 0;
    color: #155674;
    font-size: 22px;
}

.input-group {
    margin-bottom: 15px;
}

.input-group label {
    display: block;
    margin-bottom: 5px;
    color: #333333;
    font-size: 14px;
}

.input-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #cccccc;
    border-radius: 6px;
    box-sizing: border-box;
    font-size: 14px;
    background-color: #ffffff;
    outline: none;
}

.input-group input:focus {
    border-color: #0891b2;
}
.error-message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    border-radius: 6px;
    font-size: 13px;
    margin-bottom: 15px;
    border: 1px solid #f5c6cb;
    text-align: center;
}

.btn {
    width: 100%;
    padding: 10px;
    background-color: #155674;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s ease;
    display: block;
    text-align: center;
    text-decoration: none;
    box-sizing: border-box;
    margin-top: 15px;
}

.btn:hover {
    background-color: #0891b2;
}
</style>
<body>

    <div class="form-container">
        <div class="card-header">
            <div class="icon-box"><i class="fa-solid fa-right-to-bracket"></i></div>
            <h2>Login</h2>
        </div>
        <?php if(!empty($error)) { ?>
            <div class="error-message">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <form method="POST">
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>
    </div>

</body>
</html>
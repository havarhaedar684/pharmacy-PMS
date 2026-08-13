<?php
include "db.php";
if($_POST){
$name=$_POST['username'];
$email=$_POST['email'];
$pass=$_POST['password'];
$role=$_POST['role'];

$sql="INSERT INTO users (name, email, pass, role)VALUES ('$name','$email','$pass','$role')";
$result=mysqli_query($conn, $sql);
if($result){
    header("Location:insert.php");
    exit();
}
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add User - Pharmacy POS</title>
    <link rel="stylesheet" href="style.css">
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
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 350px;
}

.form-container h2 {
    margin-bottom: 20px;
    color: #333333;
    text-align: center;
}

.input-group {
    margin-bottom: 15px;
}

.input-group label {
    display: block;
    margin-bottom: 5px;
    color: #555555;
    font-size: 14px;
}

.input-group input, 
.input-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #cccccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
}

.input-group input:focus, 
.input-group select:focus {
    border-color: #007bff;
    outline: none;
}

.btn {
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn:hover {
    background-color: #0056b3;
}
</style>
<body>

    <div class="form-container">
        <h2>Add New User</h2>
        <form method="POST">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="input-group">
                <label>Role</label>
                <select name="role">
                    <option value="admin">Admin</option>
                    <option value="cashier">Cashier</option>
                </select>
            </div>

            <button type="submit" name="add_user" class="btn">Save User</button>
        </form>
    </div>

</body>
</html>
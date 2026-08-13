<?php
include "db.php";
if($_POST){
$name=$_POST['name'];
$sql="INSERT INTO categories(name)VALUES('$name')";
$result=mysqli_query($conn, $sql);
if($result){
    header("Location:categories.php");
    exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category - Pharmacy POS</title>
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
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    width: 350px;
}

.form-container h2 {
    margin-bottom: 20px;
    color: #155674;
    text-align: center;
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
    margin-top: 10px;
}

.btn:hover {
    background-color: #0891b2;
}
.cancel-btn {
    background-color: #6c757d;
}

.cancel-btn:hover {
    background-color: #5a6268;
}
</style>
<body>

    <div class="form-container">
        <h2>Add New Category</h2>
        <form method="POST">
            <div class="input-group">
                <label>Category Name</label>
                <input type="text" name="name" required>
            </div>

            <button type="submit" class="btn">Save Category</button>
              <a href="categories.php" class="btn cancel-btn">Cancel</a>
        </form>

    </div>

</body>
</html>
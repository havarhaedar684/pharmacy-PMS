<?php
include "db.php";
if($_POST){
$name=$_POST['s_name'];
$category=$_POST['category'];
$supplier=$_POST['supplier'];
$sale_price=$_POST['sale_price'];
$purchase_price=$_POST['purchase_price'];
$stock=$_POST['stock'];
$sql_pro="INSERT INTO products (s_name, category, supplier, sale_price , purchase_price, stock)
 values ('$name', '$category', '$supplier', '$sale_price', '$purchase_price', '$stock')";
 $result_pro=mysqli_query($conn, $sql_pro);
 if($result_pro){
    header("Location:products.php");
    exit();
 }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product - Pharmacy POS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
body {
    font-family: Arial, sans-serif;
    background-color: #96B6C5;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    margin: 0;
}

.form-container {
    background: #ADC4CE;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    width: 380px;
    margin: 20px 0;
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

.input-group input, .input-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #cccccc;
    border-radius: 6px;
    box-sizing: border-box;
    font-size: 14px;
    background-color: #ffffff;
    outline: none;
}

.input-group input:focus, .input-group select:focus {
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
    background-color: #d9534f;
}

.cancel-btn:hover {
    background-color: #c9302c;
}
</style>
<body>

    <div class="form-container">
        <h2>Add New Product</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label>Product Name</label>
                <input type="text" name="s_name" required>
            </div>

            <div class="input-group">
                <label>Category</label>
                <select name="category" required>
                    <option value="">Select Category</option>
                     <?php
                     $sql="SELECT * FROM categories";
                     $result=mysqli_query($conn, $sql);
                     if($result){
                     while($row=mysqli_fetch_assoc($result)){
                 echo "<option value='".$row['name']."'>".$row['name']."</option>";
                   
                     }
                     }
                     
                   ?>
                </select>
            </div>

            <div class="input-group">
                <label>Supplier</label>
                <select name="supplier" required>
                    <option value="">Select Supplier</option>
                    <?php 
                    $sql1="SELECT * FROM suppliers";
                    $result1=mysqli_query($conn, $sql1);
                    if($result1){
                        while($row1=mysqli_fetch_assoc($result1)){
                  echo "<option value='".$row1['name']."'>".$row1['name']."</option>";

                        }
                    }
                    
                    ?>
                   
                </select>
            </div>

            <div class="input-group">
                <label>Sale Price</label>
                <input type="number" step="0.01" name="sale_price" required>
            </div>

            <div class="input-group">
                <label>Purchase Price</label>
                <input type="number" step="0.01" name="purchase_price" required>
            </div>

            <div class="input-group">
                <label>Stock</label>
                <input type="number" name="stock" required>
            </div>

            <button type="submit" class="btn">Save Product</button>
            <a href="products.php" class="btn cancel-btn">Cancel</a>
        </form>
    </div>

</body>
</html>
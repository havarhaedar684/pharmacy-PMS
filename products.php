<?php
include "db.php";
$sql="SELECT * FROM products";
$result=mysqli_query($conn, $sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - Pharmacy POS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
body {
    background-color: #96B6C5;
    margin: 0;
    font-family: Arial, sans-serif;
    display: flex;
}

.sidebar {
    width: 220px;
    height: 100vh;
    background-color: #ADC4CE;
    padding: 30px 20px 20px 20px;
    position: fixed;
    top: 0;
    left: 0;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.sidebar-top {
    display: flex;
    flex-direction: column;
}

.sidebar h2 {
    color: #155674;
    font-size: 20px;
    margin-top: 0;
    margin-bottom: 25px;
}

.sidebar a {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #2c3e50;
    text-decoration: none;
    padding: 12px 15px;
    margin-bottom: 8px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 500;
}

.sidebar a:hover, .sidebar a.active {
    background-color: #0891b2;
    color: white;
}

.logout-btn {
    background-color: #d9534f;
    color: white;
    margin-bottom: 0;
}

.logout-btn:hover {
    background-color: #c9302c !important;
    color: white;
}

.main-content {
    margin-left: 220px;
    padding: 40px;
    box-sizing: border-box;
    flex-grow: 1;
}

.card {
    background-color: #ADC4CE;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
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

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    margin-top: 15px;
}

th, td {
    padding: 14px 16px;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
    font-size: 14px;
}

th {
    background-color: #155674;
    color: white;
    font-weight: 600;
}

.action-btns {
    display: flex;
    gap: 8px;
}

.edit-btn, .delete-btn {
    padding: 6px 14px;
    border-radius: 6px;
    color: white;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
}

.edit-btn {
    background-color: #155674;
}

.delete-btn {
    background-color: #d9534f;
}

.edit-btn:hover, .delete-btn:hover {
    background-color: #0891b2;
}

.btn {
    background-color: #155674;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 20px;
    font-size: 14px;
    font-weight: 500;
}

.btn:hover {
    background-color: #0891b2;
}
</style>
<body>

<div class="sidebar">
    <div class="sidebar-top">
        <h2>Dashboard</h2>
        <a href="dashboard.php"><i class="fa-solid fa-house"></i> Home</a>
        <a href="categories.php"><i class="fa-solid fa-list"></i> Categories</a>
        <a href="products.php" class="active"><i class="fa-solid fa-pills"></i> Products</a>
        <a href="suppliers.php"><i class="fa-solid fa-truck"></i> Suppliers</a>
        <a href="sales.php"><i class="fa-solid fa-cash-register"></i> Sales</a>
        <a href="report.php"><i class="fa-solid fa-chart-line"></i> Report</a>
        <a href="show.php"><i class="fa-solid fa-users"></i> Users</a>
    </div>
    
    <div class="sidebar-bottom">
        <a href="logout.php" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>
</div>

<div class="main-content">
    <div class="card">
        <div class="card-header">
            <div class="icon-box"><i class="fa-solid fa-pills"></i></div>
            <h2>Products Records</h2>
        </div>
        
        <table>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>CATEGORY</th>
                <th>SUPPLIER</th>
                <th>PURCHASE PRICE</th>
                <th>SALE PRICE</th>
                <th>STOCK</th>
                <th>ACTION</th>
            </tr>
          <?php  
          if($result){
            while($row=mysqli_fetch_assoc($result)){

            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['s_name']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['supplier']; ?></td>
                <td><?php echo number_format($row['sale_price'])." IQD"; ?></td>
                <td><?php echo number_format($row['purchase_price'])." IQD"; ?></td>
                <td><?php echo $row['stock']; ?></td>
                <td>
                    <div class="action-btns">
                        <a href="update_pro.php?id=<?php echo $row['id'];?>" class="edit-btn">Edit</a>
                        <a href="delete_pro.php?id=<?php echo $row['id'];?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </td>
            </tr>
            <?php
            }
          }
            ?>
        </table>
        
        <a href="add_product.php" class="btn"><i class="fa-solid fa-plus"></i> Add New Product</a>
    </div>
</div>

</body>
</html>
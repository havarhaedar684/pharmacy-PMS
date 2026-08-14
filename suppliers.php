<?php
include "db.php";
$sql="SELECT * FROM suppliers";
$result=mysqli_query($conn, $sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suppliers - Pharmacy POS</title>
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

/* Sidebar */
.sidebar {
    width: 220px;
    height: 100vh;
    background-color: #ADC4CE;
    padding: 20px;
    position: fixed;
    top: 0;
    left: 0;
    box-sizing: border-box;
}

/* Dashboard Title */
.sidebar h2 {
    color: #155674;
    font-size: 20px;
    margin-top: 0;
    margin-bottom: 25px;
}

/* Sidebar Links */
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

/* Active & Hover */
.sidebar a:hover,
.sidebar a.active {
    background-color: #0891b2;
    color: white;
}

/* Logout Button */
.logout-btn {
    background-color: #d9534f;
    color: white;

    position: absolute;
    bottom: 35px;
    left: 20px;

    width: 180px;
    box-sizing: border-box;

    margin-bottom: 0 !important;
}

/* Logout Hover */
.logout-btn:hover {
    background-color: #c9302c !important;
    color: white;
}

/* Main Content */
.main-content {
    margin-left: 220px;
    padding: 40px;
    box-sizing: border-box;
    flex-grow: 1;
}

/* Card */
.card {
    background-color: #ADC4CE;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Card Header */
.card-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
}

/* Icon Box */
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

/* Card Title */
.card-header h2 {
    margin: 0;
    color: #155674;
    font-size: 22px;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    margin-top: 15px;
}

/* Table Cells */
th,
td {
    padding: 14px 16px;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
    font-size: 14px;
}

/* Table Header */
th {
    background-color: #155674;
    color: white;
    font-weight: 600;
}

/* Action Buttons */
.action-btns {
    display: flex;
    gap: 8px;
}

/* Edit & Delete Buttons */
.edit-btn,
.delete-btn {
    padding: 6px 14px;
    border-radius: 6px;
    color: white;
    text-decoration: none;
    font-size: 13px;
    font-weight: 500;
}

/* Edit */
.edit-btn {
    background-color: #155674;
}

/* Delete */
.delete-btn {
    background-color: #d9534f;
}

/* Edit & Delete Hover */
.edit-btn:hover,
.delete-btn:hover {
    background-color: #0891b2;
}

/* Add Button */
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

/* Add Button Hover */
.btn:hover {
    background-color: #0891b2;
}
</style>
<body>

<div class="sidebar">
    <h2>Dashboard</h2>
    <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
    <a href="categories.php"><i class="fa-solid fa-list"></i> Categories</a>
     <a href="products.php"><i class="fa-solid fa-pills"></i> Products</a>
    <a href="suppliers.php" class="active"><i class="fa-solid fa-truck"></i> Suppliers</a>
    <a href="show.php"><i class="fa-solid fa-users"></i> Users</a>
     <div>
        <a href="logout.php" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>
</div>

<div class="main-content">
    <div class="card">
        <div class="card-header">
            <div class="icon-box"><i class="fa-solid fa-truck"></i></div>
            <h2>Suppliers Records</h2>
        </div>
        
        <table>
            <tr>
                <th>ID</th>
                <th>SUPPLIER NAME</th>
                <th>PHONE</th>
                <th>CREATED AT</th>
                <th>ACTION</th>
            </tr>
            <?php
            if($result){
            while($row=mysqli_fetch_assoc($result)){
            
            ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['phone'];?></td>
                <td><?php echo $row['create_at'];?></td>
                <td>
                    <div class="action-btns">
                        <a href="update_suppliers.php?id=<?php echo $row['id'];?>" class="edit-btn">Edit</a>
                        <a href="delete_suppliers.php?id=<?php echo $row['id'];?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </td>
            </tr>
            <?php
            }
            }
            ?>
        </table>
        
        <a href="add_suppliers.php" class="btn"><i class="fa-solid fa-plus"></i> Add New Supplier</a>
    </div>
</div>

</body>
</html>
<?php
include "db.php";
// for total products
$sql_p="SELECT COUNT(*) as total FROM products";
$result_p=mysqli_query($conn, $sql_p);
if($result_p){
    $row_p=mysqli_fetch_assoc($result_p);
    $total_p=$row_p['total']; 
}
// for total sales
$sql_s="SELECT COUNT(*) as total FROM sales";
$result_s=mysqli_query($conn,$sql_s);
if($result_s){
    $row_s=mysqli_fetch_assoc($result_s);
    $total_s=$row_s['total'];
}
//for total suppliers
$sql_su="SELECT COUNT(*) as total FROM suppliers";
$result_su=mysqli_query($conn, $sql_su);
if($result_su){
    $row_su=mysqli_fetch_assoc($result_su);
    $total_su=$row_su['total'];
}
//for total users
$sql_u="SELECT COUNT(*) as total FROM users";
$result_u=mysqli_query($conn, $sql_u);
if($result_u){
    $row_u=mysqli_fetch_assoc($result_u);
    $total_u=$row_u['total'];
}
$sql_low="SELECT s_name, category, stock FROM products where stock <=5 ";
$result_low=mysqli_query($conn, $sql_low);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home - Pharmacy PMS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
    background-color: #96B6C5;
    margin: 0;
    font-family: Arial, sans-serif;
    display: flex;
}

/* Sidebar Styles */
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

/* Main Content Styles */
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

/* Dashboard Grid Cards */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.stat-card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 22px;
}

.stat-info h3 {
    margin: 0 0 5px 0;
    font-size: 14px;
    color: #64748b;
}

.stat-info p {
    margin: 0;
    font-size: 20px;
    font-weight: bold;
    color: #155674;
}

/* Welcome Banner */
.welcome-banner {
    background: white;
    padding: 25px;
    border-radius: 10px;
    color: #155674;
}

.welcome-banner h3 {
    margin-top: 0;
    font-size: 18px;
}

.welcome-banner p {
    margin-bottom: 0;
    color: #475569;
    font-size: 14px;
}
/* Tables Section Inside Card */
.tables-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-top: 25px;
}

@media(max-width: 1100px) {
    .tables-container {
        grid-template-columns: 1fr;
    }
}

.table-box {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.table-box h3 {
    margin-top: 0;
    color: #155674;
    font-size: 16px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.table-box table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 6px;
    overflow: hidden;
}

.table-box th, .table-box td {
    padding: 10px 12px;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
    font-size: 13px;
}

.table-box th {
    background-color: #155674;
    color: white;
    font-weight: 600;
}

/* Badge for Low Stock */
.badge-low {
    background-color: #f8d7da;
    color: #721c24;
    padding: 4px 8px;
    border-radius: 4px;
    font-weight: bold;
    font-size: 12px;
}
</style>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-top">
            <h2>Dashboard</h2>
            <a href="dashboard.php" class="active"><i class="fa-solid fa-house"></i> Home</a>
            <a href="categories.php"><i class="fa-solid fa-list"></i> Categories</a>
            <a href="products.php"><i class="fa-solid fa-pills"></i> Products</a>
            <a href="suppliers.php"><i class="fa-solid fa-truck"></i> Suppliers</a>
            <a href="sales.php"><i class="fa-solid fa-cash-register"></i> Sales</a>
            <a href="report.php"><i class="fa-solid fa-chart-line"></i> Report</a>
            <a href="show.php"><i class="fa-solid fa-users"></i> Users</a>
        </div>
        
        <div class="sidebar-bottom">
            <a href="logout.php" class="logout-btn"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="card">
            <div class="card-header">
                <div class="icon-box"><i class="fa-solid fa-house"></i></div>
                <h2>Dashboard Overview</h2>
            </div>

            <!-- Dashboard Statistics Cards -->
            <div class="dashboard-grid">
                <div class="stat-card">
                    <div class="stat-icon" style="background-color: #0891b2;"><i class="fa-solid fa-pills"></i></div>
                    <div class="stat-info">
                        <h3>Total Products</h3>
                        <p><?php echo $total_p; ?></p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background-color: #10b981;"><i class="fa-solid fa-cash-register"></i></div>
                    <div class="stat-info">
                        <h3>Total Sales</h3>
                        <p><?php echo $total_s;?></p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background-color: #f59e0b;"><i class="fa-solid fa-truck"></i></div>
                    <div class="stat-info">
                        <h3>Suppliers</h3>
                        <p><?php echo $total_su;?></p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background-color: #8b5cf6;"><i class="fa-solid fa-users"></i></div>
                    <div class="stat-info">
                        <h3>System Users</h3>
                        <p><?php echo $total_u;?></p>
                    </div>
                </div>
            </div>

            <!-- Tables Section (Sales History & Low Stock) -->
<div class="tables-container">
    <!-- Recent Sales History Table -->
    <div class="table-box">
        <h3><i class="fa-solid fa-clock-rotate-left"></i> Recent Sales History</h3>

        <table>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Subtotal</th>
                <th>Time</th>
            </tr>
            <?php $sql1="SELECT * FROM sales";
            $result1=mysqli_query($conn,$sql1);
            if($result1){
             while($row1=mysqli_fetch_assoc($result1)){
            
            
            ?>
            <tr>
                <td><?php echo $row1['name_pro'];?></td>
                <td><?php echo $row1['quantity'];?></td>
                <td><?php echo number_format($row1['subtotal'])." IQD";?></td>
                <td><?php echo $row1['create_at'];?></td>

            </tr>
            <?php
            }
            }
            ?>
        </table>
    </div>

    <!-- Low Stock Alert Table -->
    <div class="table-box">
        <h3><i class="fa-solid fa-triangle-exclamation" style="color: #d9534f;"></i> Low Stock Alerts</h3>
        <table>
            <tr>
                <th>Products</th>
                <th>Category</th>
                <th>Stock</th>
            </tr>
           <?php if($result_low){
           while($row_low=mysqli_fetch_assoc($result_low)){
           ?>
            <tr>
                <td><?php echo $row_low['s_name'];?></td>
                <td><?php echo $row_low['category'];?></td>
                <td><?php echo $row_low['stock'];?></td>
            </tr>
            <?php
           }
           }
            ?>
        </table>
    </div>
</div>

</body>
</html>
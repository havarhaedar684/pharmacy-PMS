<?php
session_start();
include "db.php";
if(!isset($_SESSION['username']) && $_SESSION['role']!='admin'){
    header("Location:index.php");
    exit();
}
$sql="SELECT * FROM sales";
$result=mysqli_query($conn, $sql);


$sql_total="SELECT sum(subtotal) as total FROM sales";
$total_q=mysqli_query($conn, $sql_total);
$total_r=mysqli_fetch_assoc($total_q);
$total=$total_r['total'];




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Report - Pharmacy POS</title>
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

/* Table Styles */
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

/* Report Summary Box */
.report-summary {
    margin-top: 20px;
    background: white;
    padding: 15px 20px;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 18px;
    font-weight: bold;
    color: #155674;
}

.print-btn {
    background-color: #155674;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.print-btn:hover {
    background-color: #0891b2;
}

/* Print Optimization */
@media print {
    .sidebar, .print-btn {
        display: none;
    }
    .main-content {
        margin-left: 0;
        padding: 0;
    }
    .card {
        background-color: white;
        box-shadow: none;
    }
}
</style>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-top">
            <h2>Dashboard</h2>
            <a href="dashboard.php"><i class="fa-solid fa-house"></i> Home</a>
            <a href="categories.php"><i class="fa-solid fa-list"></i> Categories</a>
            <a href="products.php"><i class="fa-solid fa-pills"></i> Products</a>
            <a href="suppliers.php"><i class="fa-solid fa-truck"></i> Suppliers</a>
            <a href="sales.php"><i class="fa-solid fa-cash-register"></i> Sales</a>
            <a href="report.php" class="active"><i class="fa-solid fa-chart-line"></i> Report</a>
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
                <div class="icon-box"><i class="fa-solid fa-chart-line"></i></div>
                <h2>Sales Report</h2>
            </div>

            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($result){
                    while($row=mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name_pro']; ?></td>
                        <td><?php echo number_format($row['price'])." IQD"; ?></td>
                        <td><?php echo $row['quantity']; ?></td>
                        <td><?php echo number_format($row['subtotal'])." IQD"; ?></td>
                        <td><?php echo $row['create_at']; ?></td>
                    </tr>
                    <?php 
                    }
                    }
                    ?>
                </tbody>
            </table>

            <!-- Report Summary -->
            <div class="report-summary">
                <span>Total Revenue: <?php echo  number_format($total)." IQD";?></span>
                <button class="print-btn" onclick="window.print()"><i class="fa-solid fa-print"></i> Print Report</button>
            </div>
        </div>
    </div>

</body>
</html>
<?php
include "db.php";
$sql="SELECT * FROM users";
$result=mysqli_query($conn, )



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users - Pharmacy POS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background-color: #93b1c6;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.main-container {
    width: 80%;
    max-width: 900px;
    background: #e6edf3;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.header-title {
    margin-bottom: 20px;
}

.header-title h2 {
    color: #1d3557;
    font-size: 22px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.header-title p {
    color: #5c677d;
    font-size: 13px;
    margin-top: 5px;
}

.table-card {
    background: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #d0d7de;
}

table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
}

th, td {
    padding: 12px 15px;
    font-size: 14px;
}

th {
    background-color: #1d3557;
    color: white;
    font-weight: 600;
}

tr:nth-child(even) {
    background-color: #f6f8fa;
}

tr:not(:last-child) td {
    border-bottom: 1px solid #d0d7de;
}

td {
    color: #333333;
}

.badge {
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    text-transform: uppercase;
}

.badge.admin {
    background-color: #d1e7dd;
    color: #0f5132;
}

.badge.cashier {
    background-color: #cfe2ff;
    color: #084298;
}
</style>
<body>

    <div class="main-container">
        <div class="header-title">
            <h2><i class="fa-solid fa-users"></i> Users Management</h2>
            <p>Manage all system users and roles</p>
        </div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Havar Haider</td>
                        <td>havar@gmail.com</td>
                        <td><span class="badge admin">admin</span></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Ahmad Ali</td>
                        <td>ahmad@gmail.com</td>
                        <td><span class="badge cashier">cashier</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
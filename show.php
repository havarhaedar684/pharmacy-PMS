<?php
include "db.php";
 $sql = "SELECT * FROM users";
 $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users - Pharmacy POS</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            padding: 20px;
            box-sizing: border-box;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h2 {
            color: #155674;
            font-size: 20px;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #333;
            text-decoration: none;
            padding: 10px 15px;
            margin-bottom: 8px;
            border-radius: 6px;
            font-size: 15px;
        }

        .sidebar a:hover, .sidebar a.active {
            background-color: #155674;
            color: white;
        }

        .main-content {
            margin-left: 220px;
            flex-grow: 1;
            padding: 30px;
            box-sizing: border-box;
        }

        .card {
            background-color: #ADC4CE;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .icon-box {
            background-color: #155674;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 8px;
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

        .card-header p {
            margin: 2px 0 0 0;
            color: #555;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background-color: #155674;
            color: white;
        }

        .action-btns {
            display: flex;
            gap: 6px;
        }

        .edit-btn, .delete-btn {
            padding: 6px 12px;
            border-radius: 4px;
            color: white;
            text-decoration: none;
            font-size: 12px;
            display: inline-block;
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
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            font-size: 14px;
        }

        .btn:hover {
            background-color: #0891b2;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Dashboard</h2>
    <a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
    <a href="users.php" class="active"><i class="fa-solid fa-users"></i> Users</a>
</div>

<div class="main-content">
    <div class="card">
        <div class="card-header">
            <div class="icon-box"><i class="fa-solid fa-users"></i></div>
            <div>
                <h2>Users Records</h2>
                <p>Market POS Management Panel</p>
            </div>
        </div>
        
        <table>
            <tr>
                <th>ID</th>
                <th>USERNAME</th>
                <th>EMAIL</th>
                <th>ROLE</th>
                <th>ACTION</th>
            </tr>
            <?php

                if($result){
                    while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['role']; ?></td>
                <td>
                    <div class="action-btns">
                        <a href="update-users.php?id=<?php echo $row['id'];?>" class="edit-btn">Edit</a>
                        <a href="delete-users.php?id=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </td>
            </tr>
            <?php
                    }
                }
            ?>
        </table>
        
        <a href="insert.php" class="btn"><i class="fa-solid fa-user-plus"></i> Add New User</a>
    </div>
</div>

</body>
</html>
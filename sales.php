<?php
include "db.php";
$error="";
if(isset($_POST['index']) && isset($_POST['return_qty'])){
    $sale_id = $_POST['index'] ?? '';
    $return_qty = $_POST['return_qty'] ?? '';

$return_sale="SELECT * FROM sales where id='$sale_id'";
$query_sale=mysqli_query($conn,$return_sale);

if($query_sale && mysqli_num_rows($query_sale)>0){
$row_sale=mysqli_fetch_assoc($query_sale);
$name_sale=$row_sale['name_pro'];
$quantity_sale=$row_sale['quantity'];
$unit_price=$row_sale['price'];

if($return_qty < $quantity_sale){
$update_product = "UPDATE products SET stock = stock + $return_qty WHERE s_name='$name_sale'";
 mysqli_query($conn, $update_product);

$new_qty = $quantity_sale - $return_qty;
$new_subtotal = $new_qty * $unit_price;
$update_sale = "UPDATE sales SET quantity='$new_qty', subtotal='$new_subtotal' WHERE id='$sale_id'";
mysqli_query($conn, $update_sale);

    header("Location: sales.php");
    exit();
}

else if($return_qty == $quantity_sale){
 $update_products="UPDATE Products SET stock=stock+$return_qty where s_name='$name_sale' ";
 mysqli_query($conn, $update_products);
$delete_sale="DELETE FROM sales where id='$sale_id'";
$result_delete=mysqli_query($conn, $delete_sale);

header("Location:sales.php");
exit();
}
else{
    $error="You dont have enough stock";
}

}
}

if($_POST){
$product=$_POST['product'] ?? '';
$qty=$_POST['qty'] ?? '';
$find_price="SELECT purchase_price FROM products where s_name='$product'";
$find_result=mysqli_query($conn,$find_price);
if($find_result && mysqli_num_rows($find_result)>0){
$find_row=mysqli_fetch_assoc($find_result);
$price=$find_row['purchase_price'];

$subtotal=$price*$qty;

$sql_show="INSERT INTO sales (name_pro, quantity, price, subtotal) 
values ('$product', '$qty','$price','$subtotal')";
$result_show=mysqli_query($conn, $sql_show);

$select_pro="SELECT stock FROM products where s_name='$product'";
$result_pro=mysqli_query($conn, $select_pro);
$row_pro=mysqli_fetch_assoc($result_pro);
$quantity=$row_pro['stock'];
$quantity=$quantity-$qty;

$update_pro="UPDATE products set stock='$quantity' WHERE s_name ='$product'";
$result_up=mysqli_query($conn,$update_pro);

}
}

$select="SELECT * FROM sales";
$result_select=mysqli_query($conn,$select);

$total_amount="SELECT SUM(subtotal) AS total FROM sales";
$total_result=mysqli_query($conn, $total_amount);
$total_row=mysqli_fetch_assoc($total_result);
$total=$total_row['total'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales - Pharmacy POS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

.sales-form {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    align-items: center;
}

.sales-form select, .sales-form input {
    padding: 10px;
    border: 1px solid #cccccc;
    border-radius: 6px;
    font-size: 14px;
    outline: none;
    background: white;
}

.sales-form select {
    flex: 2;
}

.sales-form input {
    flex: 1;
}

.add-btn {
    background-color: #155674;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}

.add-btn:hover {
    background-color: #0891b2;
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

.total-container {
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

.checkout-btn {
    background-color: #155674;
    color: white;
    border: none;
    padding: 10px 25px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
}

.checkout-btn:hover {
    background-color: #0891b2;
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
            <a href="sales.php" class="active"><i class="fa-solid fa-cash-register"></i> Sales</a>
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
                <div class="icon-box"><i class="fa-solid fa-cash-register"></i></div>
                <h2>Point of Sale (Sales)</h2>
            </div>

            <?php if(!empty($error)){ ?>
                <div class="alert-error">
                    <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $error; ?>
                </div>
            <?php } ?>

            <!-- بەشی هەڵبژاردنی بەرهەم بە Select -->
            <form class="sales-form" action="" method="POST">
                <select name="product" required>
                    <option value="">Select Product</option>
                    <?php
                    $sql_pro="SELECT * FROM products";
                    $result_pro=mysqli_query($conn, $sql_pro);
                    if($result_pro){
                        while($row_pro=mysqli_fetch_assoc($result_pro)){
                          
                       echo  "<option value='".$row_pro['s_name']."'>".$row_pro['s_name']."(price:".number_format($row_pro['purchase_price'])." IQD)"."</option>";
                        }
                    }
                    
                    ?>
                   
                </select>
                <input type="number" name="qty" placeholder="Quantity" min="1" value="1" required>
                <button type="submit" class="add-btn"><i class="fa-solid fa-plus"></i> Add</button>
            </form>
            
            <!-- خشتەی فرۆشتن -->
            <table>

                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Create_at</th>
                    <th>Action</th>
                </tr>
                <?php 
                if($result_select){
                while($row_select=mysqli_fetch_assoc($result_select)){
                ?>
                <tr>
                <td><?php echo $row_select['name_pro'];?></td>
                <td><?php echo number_format($row_select['price'])." IQD";?></td>
                <td><?php echo $row_select['quantity'];?></td>
                <td><?php echo number_format($row_select['subtotal'])." IQD";?></td>
                <td><?php echo $row_select['create_at'];?></td>
                
                
                <td><a href="delete_sale.php?id=<?php echo $row_select['id'];?>" style="color: #d9534f; text-decoration: none;"><i class="fa-solid fa-trash"></i> Delete
                </a>
                <form action="sales.php" method="POST" style="display: inline-flex; gap: 5px; align-items: center;">
                                 <input type="hidden" name="index" value="<?php echo $row_select['id']; ?>">
                                   <input type="number" name="return_qty" value="1" min="1" max="<?php echo $row_select['quantity'];?>" class="return-input">
                                    <button type="submit" class="btn-return-row">Return</button>
                                 </form>
               </td>
               
                </tr>
                <?php
                }
                }

                ?>
            </table>

            <!-- بەشی کۆی گشتی پسووڵە -->
            <div class="total-container">
                <span>Total Amount:<?php echo number_format($total)." IQD";?></span>
                <button class="checkout-btn">Complete Sale</button>
            </div>
        </div>
    </div>

</body>
</html>
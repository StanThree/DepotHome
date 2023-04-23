<!DOCTYPE html>
<html>
<head>
  <title>The Home Depot</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

  <body>
    <!-- Navigation bar -->
<div id="topBar">
  <h1>The Home Depot</h1>
  <ul>
    <a class="active" href="">Home</a>
    <a href="shoppingCart.php">Shopping Cart</a>
    <a href="login.php">Login/Change User</a>
    <a href="create_user.php">Create New User</a>
    <a href="customer_info.php">My Account</a>
  </ul>
</div>
    <!-- Main content -->
    <div id="content">
    <form id="filterForm" method="post" action="">
      <label for="department">Select Department:</label>
      <select id="department" name="department">
      <option value="0">All Departments</option>
        <!-- Department options will be filled dynamically -->
      </select>
      <input type="submit" value="Filter">
    </form>
          
       <?php
          // Enable error reporting
          //error_reporting(E_ALL);
          //ini_set('display_errors', '1');

          // Start a new session
          session_start();

          // Include the db_connection.php file
          include 'db_connection.php';

          // Create a new database connection
          $conn = createConnection();

          // Prepare a SQL query to fetch all departments
          $deptSql = "SELECT * FROM dept";
          $deptResult = $conn->query($deptSql);

          // Get the selected department and current store
          $selectedDepartment = isset($_POST['department']) ? (int)$_POST['department'] : 0;
          $currentStore = isset($_SESSION['customer_info']['currentStore']) ? $_SESSION['customer_info']['currentStore'] : 0;

          // Prepare a SQL query to fetch products based on the selected department and current store
          $sql = "SELECT * FROM product WHERE deptID='$selectedDepartment' AND storeID='$currentStore'";

          // If no department is selected, fetch products only from the current store
          if ($selectedDepartment == 0) {
            $sql = "SELECT * FROM product WHERE storeID='$currentStore'";
          }

          // Echo the SQL query for debugging purposes
          //echo "SQL Query: $sql<br>";

          $result = $conn->query($sql);
          // Check if there are any departments in the result
          if ($deptResult->num_rows > 0) {
            // Output each department as an option in the dropdown
            while($deptRow = $deptResult->fetch_assoc()) {
              echo "<script>document.getElementById('department').innerHTML += '<option value=\"" . $deptRow['deptID'] . "\">" . $deptRow['deptName'] . "</option>';</script>";
            }
          }

          // Generate the products table
          echo "<table class='product-table' border='1'>";
          echo "<tr><th>Product ID</th><th>Product Name</th><th>Product Price</th><th>Product Quantity</th><th>Product Image</th></tr>";

          // Check if there are any products in the result
          if ($result->num_rows > 0) {
            // Output each product as a table row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['productID'] . "</td>";
                echo "<td>" . $row['productName'] . "</td>";
                echo "<td>" . $row['productPrice'] . "</td>";
                echo "<td>" . $row['productQuantity'] . "</td>";
                echo "<td><img src='" . $row['imageUrl'] . "' alt='" . $row['productName'] . "' width='100' height='100'></td>";
                echo "<td>";
                echo "<form method='post' action='addToCart.php'>";
                echo "<input type='hidden' name='productID' value='" . $row['productID'] . "'>";
                echo "<input type='submit' value='Add to Cart'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
          } else {
            // Display a message if no products are found
            echo "<tr><td colspan='6'>No products found</td></tr>";
          }

          // Close the table and the database connection
          echo "</table>";
          $conn->close();
          ?>

    </div>
  </body>
</html>


<?php
echo 'Customer Service Contact: 1-800-Home-Depot';
?>

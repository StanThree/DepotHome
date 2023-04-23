<?php
session_start();

// Get the customer ID and shopping cart ID from the session
$customerID = $_SESSION['customerID'];
$shoppingCartID = $_SESSION['customer_info']['customerShoppingCart'];

// Include the database connection file
include 'db_connection.php';
$conn = createConnection();

// Prepare a SQL query to get the cart items and product details for the current shopping cart
$sql = "SELECT p.productID, p.productName, p.productPrice, ci.quantity, p.imageUrl, ci.storeID
        FROM cartItems ci
        JOIN product p ON ci.productID = p.productID
        WHERE ci.shoppingCartID = ?";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo "Error preparing the statement: " . $conn->error;
    exit();
}

// Bind the shopping cart ID to the prepared statement and execute the query
$stmt->bind_param('i', $shoppingCartID);
$stmt->execute();

if (!$stmt->execute()) {
    echo "Error executing the statement: " . $stmt->error;
    exit();
}

// Get the result of the executed query
$result = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <h1>Shopping Cart</h1>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Image</th>
            <th>Store ID</th>
        </tr>
        <?php
        // Loop through the query results and display each cart item
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['productID'] . "</td>";
            echo "<td>" . $row['productName'] . "</td>";
            echo "<td>" . $row['productPrice'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td><img src='" . $row['imageUrl'] . "' width='100' height='100' alt='" . $row['productName'] . "'></td>";
            echo "<td>" . $row['storeID'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <a href="index.php">Back to Home</a>
</body>
</html>
<?php
// Close the statement and the connection
$stmt->close();
$conn->close();
?>

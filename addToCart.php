<?php
session_start();

// If there is no productID in the POST request, redirect to the index page
if (!isset($_POST['productID'])) {
    header("Location: index.php");
    exit;
}

$productID = $_POST['productID'];
$quantity = 1; // Default quantity of 1. You can change this or get it from the form
$customerID = $_SESSION['customerID'];
$shoppingCartID = $_SESSION['customer_info']['customerShoppingCart'];
$storeID = $_SESSION['customer_info']['currentStore'];

// Include the database connection file
include 'db_connection.php';
$conn = createConnection();

// Check if the customer has a shopping cart; if not, create one
if (!$shoppingCartID) {
    $sql = "INSERT INTO shoppingCart (customerID) VALUES (?)";
    $stmt = $conn->prepare($sql);

    // If there is an error preparing the statement, display an error message
    if ($stmt === false) {
        die("Error preparing statement for creating a new shopping cart: " . $conn->error);
    }

    $stmt->bind_param("i", $customerID);
    $result = $stmt->execute();

    // If the new shopping cart is created successfully, update the session variable
    if ($result) {
        $shoppingCartID = $stmt->insert_id;
        $_SESSION['customer_info']['customerShoppingCart'] = $shoppingCartID;
    } else {
        echo "Error creating a new shopping cart: " . $conn->error;
    }

    $stmt->close();
}

// Insert the new cart item into the cartItems table
$sql = "INSERT INTO cartItems (shoppingCartID, productID, quantity, storeID) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// If there is an error preparing the statement, display an error message
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("iiii", $shoppingCartID, $productID, $quantity, $storeID);
$result = $stmt->execute();

// If the cart item is added successfully, update the product quantity in the product table
if ($result) {
    $sql = "UPDATE product SET productQuantity = productQuantity - 1 WHERE productID = ?";
    $stmt = $conn->prepare($sql);

    // If there is an error preparing the statement, display an error message
    if ($stmt === false) {
        die("Error preparing statement for updating product quantity: " . $conn->error);
    }

    $stmt->bind_param("i", $productID);
    $result = $stmt->execute();

    // If the product quantity is updated successfully, display a success message
    if ($result) {
        echo "Product quantity updated successfully";
    } else {
        echo "Error updating product quantity: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Error adding product to cart: " . $conn->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();

// Redirect to the index page
header("Location: index.php");
exit;
?>

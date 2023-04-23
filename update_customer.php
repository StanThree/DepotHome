<?php
// Start a new session
session_start();

// Include the db_connection.php file
include 'db_connection.php';

// Create a new database connection
$conn = createConnection();

// Get the customer ID from the session
$customerID = $_SESSION['customerID'];

// Get the new customer information from the form
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$address = $_POST['address'];
$email = $_POST['email'];
$phoneNum = $_POST['phoneNum'];

// Prepare a SQL query to update the customer's information
$sql = "UPDATE customer SET customerFirstName=?, customerLastName=?, customerAddress=?, customerEmail=? WHERE customerID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssisi", $firstName, $lastName, $address, $email, $customerID);
$stmt->execute();

// Prepare a SQL query to update the customer's contact information
$sql = "UPDATE contact SET phoneNum=? WHERE contactID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $phoneNum, $customer['customerContact']);
$stmt->execute();

// Close the prepared statement and database connection
$stmt->close();
$conn->close();

// Redirect the user back to the customer_info.php page
header("Location: customer_info.php");
exit();
?>

<?php
session_start();

// Include the db_connection.php file
include 'db_connection.php';

// Create a new database connection
$conn = createConnection();

// Define a function to get the customer information
function get_customer_info($customerID, $conn) {
    // Prepare an SQL query to get the customer, address, contact, and store information
    $sql = "SELECT customer.*, address.*, contact.*, store.*
            FROM customer
            JOIN address ON customer.customerAddress = address.addressID
            JOIN contact ON customer.customerContact = contact.contactID
            JOIN store ON customer.currentStore = store.storeId
            WHERE customer.customerID = ?";

    // Prepare the SQL statement and bind the customerID parameter
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customerID);
    $stmt->execute();
    $result = $stmt->get_result();

    // If there is a result, return the customer information, otherwise return null
    if ($result->num_rows > 0) {
        $customer_info = $result->fetch_assoc();
        return $customer_info;
    } else {
        return null;
    }
}

// Get the customer ID from the session, which was set in authenticate.php
$customerID = $_SESSION['customerID'];

// Retrieve the customer information for the given customer ID
$customer_info = get_customer_info($customerID, $conn);

// If the customer information is found, store it in the session and display a success message
if ($customer_info) {
    $_SESSION["customer_info"] = $customer_info;
    echo "Customer information successfully stored in session.";
} else {
    // If no customer information is found, display an error message
    echo "No customer found with the given ID.";
}

// Close the database connection
$conn->close();

?>

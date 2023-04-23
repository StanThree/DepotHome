<?php
// Start a new session
session_start();

// Include the db_connection.php file
include 'db_connection.php';

// Create a new database connection
$conn = createConnection();

// Get the submitted email and password from the login form
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare a SQL query to authenticate the user
// Email is stored in the contact table, not the customer table, so we use a JOIN
$sql = "SELECT c.customerID, c.customerFirstName, c.customerLastName
        FROM customer c
        INNER JOIN contact ct ON c.customerContact = ct.contactID
        WHERE ct.email = ? AND c.password = ?";

// Execute the prepared statement with the user's email and password
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if the email and password match a customer in the database
if ($result->num_rows > 0) {
    // Fetch the customer's information
    $row = $result->fetch_assoc();

    // Display a welcome message
    echo "Welcome, " . $row['customerFirstName'] . " " . $row['customerLastName'] . "!";

    // Get the customerID
    $customerID = $row['customerID'];

    // Prepare a SQL query to get customer information
    $sql = "SELECT customer.*, address.*, contact.*, store.*
            FROM customer
            LEFT JOIN address ON customer.customerAddress = address.addressID
            LEFT JOIN contact ON customer.customerContact = contact.contactID
            LEFT JOIN store ON customer.currentStore = store.storeId
            WHERE customer.customerID = ?";

    // Execute the prepared statement with the customerID
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $customerID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if customer information was retrieved
    if ($result->num_rows > 0) {
        // Fetch the customer's information and store it in the session
        $customer_info = $result->fetch_assoc();
        $_SESSION["customer_info"] = $customer_info;
        echo "Customer information successfully stored in session.";

    } else {
        // Display an error message if the customer information is not stored in the session
        echo "Customer info not stored in session";
    }

    // Redirect the user to the customer_info.php page
    header("Location: customer_info.php");
    exit;
} else {
    // Display an error message if the email or password is incorrect
    echo "Invalid email or password. Please try again.";
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>

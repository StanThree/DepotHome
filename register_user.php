<?php
// Start a new session
session_start();

// Include the db_connection.php file
include 'db_connection.php';

// Create a new database connection
$conn = createConnection();

// Get form data from the submitted form
$email = $_POST['email'];
$password = $_POST['password'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];

// Begin database transaction
$conn->begin_transaction();

try {
    // Insert email into the 'contact' table
    $stmt = $conn->prepare("INSERT INTO contact (email) VALUES (?)");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $contactID = $conn->insert_id;

    // Get the selected store ID from the form
    $currentStore = $_POST['currentStore'];

    // Insert user data into the 'customer' table
    $stmt = $conn->prepare("INSERT INTO customer (customerFirstName, customerLastName, customerContact, currentStore, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $firstName, $lastName, $contactID, $currentStore, $password);
    $stmt->execute();
    $customerID = $conn->insert_id;

    // Commit the transaction
    $conn->commit();

    // Save user information to the session
    $_SESSION['customerID'] = $customerID;
    $_SESSION['customerFirstName'] = $firstName;
    $_SESSION['customerLastName'] = $lastName;
    $_SESSION['customerEmail'] = $email;

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

    // Redirect the user to the customer_info.php page
    header("Location: customer_info.php");

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


} catch (Exception $e) {
    // Rollback the transaction in case of error
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();

<div class="homepage-link">
  <a href="index.php">Home</a>
</div>

<?php
session_start();
if (!isset($_SESSION['customer_info'])) {
    header("Location: login.php");
    exit;
}

// Include the db_connection.php file
include 'db_connection.php';

// Create a new database connection
$conn = createConnection();

// Retrieve the customer information from the session
$customer_info = $_SESSION['customer_info'];
$customerID = $customer_info['customerID'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the submitted values
    $customerFirstName = $_POST['customerFirstName'];
    $customerLastName = $_POST['customerLastName'];
    $currentStore = $_POST['currentStore'];
    $email = $_POST['email'];
    $phoneNum = $_POST['phoneNum'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $streetName = $_POST['streetName'];
    $streetNum = $_POST['streetNum'];
    $zipcode = $_POST['zipcode'];

        // Check if customer has an address associated
        if (!$customer_info['addressID']) {
            // Insert a new address entry
            $sql = "INSERT INTO address (city, state, streetName, streetNum, zipcode) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssii", $city, $state, $streetName, $streetNum, $zipcode); // Change the fourth parameter to 'i' (integer)
            
            if ($stmt->execute()) {
                echo "New address created.<br>";
            } else {
                echo "Error creating address: " . $stmt->error . "<br>";
            }
            
            // Get the new address ID
            $newAddressID = $conn->insert_id;

            // Update the customer's address ID
            $sql = "UPDATE customer SET customerAddress = ? WHERE customerID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $newAddressID, $customerID);
            
            if ($stmt->execute()) {
                echo "Customer address updated.<br>";
            } else {
                echo "Error updating customer address: " . $stmt->error . "<br>";
            }
        }

        // Check if customer has a contact associated
        if (!$customer_info['contactID']) {
            // Insert a new contact entry
            $sql = "INSERT INTO contact (email, phoneNum) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $phoneNum);
            $stmt->execute();
            
            // Get the new contact ID
            $newContactID = $conn->insert_id;
    
            // Update the customer's contact ID
            $sql = "UPDATE customer SET customerContact = ? WHERE customerID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $newContactID, $customerID);
            $stmt->execute();
        }

    // Update the customer's information in the customer table
    $sql = "UPDATE customer SET customerFirstName = ?, customerLastName = ?, currentStore = ? WHERE customerID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $customerFirstName, $customerLastName, $currentStore, $customer_info['customerID']);
    $stmt->execute();

    // Update the contact information in the contact table
    $sql = "UPDATE contact SET email = ?, phoneNum = ? WHERE contactID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sii", $email, $phoneNum, $customer_info['contactID']);
    $stmt->execute();

    // Update the address information in the address table
    $sql = "UPDATE address SET city = ?, state = ?, streetName = ?, streetNum = ?, zipcode = ? WHERE addressID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiii", $city, $state, $streetName, $streetNum, $zipcode, $customer_info['addressID']);
    $stmt->execute();

    // Update the customer information in the session
    $updated_customer_info = [
        'customerFirstName' => $customerFirstName,
        'customerLastName' => $customerLastName,
        'currentStore' => $currentStore,
        'email' => $email,
        'phoneNum' => $phoneNum,
        'city' => $city,
        'state' => $state,
        'streetName' => $streetName,
        'streetNum' => $streetNum,
        'zipcode' => $zipcode
    ];
    $_SESSION['customer_info'] = array_merge($customer_info, $updated_customer_info);

    // Display a success message
    echo "Your information has been updated. Refreshing page.";

    header("Refresh: 3; url=customer_info.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Information</title>
</head>
<body>
    <h1>Customer Information</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label for="customerFirstName">First Name:</label>
        <input type="text" id="customerFirstName" name="customerFirstName" value="<?php echo $customer_info['customerFirstName']; ?>"><br>
        
        <label for="customerLastName">Last Name:</label>
        <input type="text" id="customerLastName" name="customerLastName" value="<?php echo $customer_info['customerLastName']; ?>"><br>
        
        <label for="currentStore">Current Store ID:</label>
        <input type="number" id="currentStore" name="currentStore" value="<?php echo $customer_info['currentStore']; ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $customer_info['email']; ?>"><br>

        <label for="phoneNum">Phone Number:</label>
        <input type="text" id="phoneNum" name="phoneNum" value="<?php echo $customer_info['phoneNum']; ?>"><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" value="<?php echo $customer_info['city']; ?>"><br>

        <label for="state">State:</label>
        <input type="text" id="state" name="state" value="<?php echo $customer_info['state']; ?>"><br>

        <label for="streetName">Street Name:</label>
        <input type="text" id="streetName" name="streetName" value="<?php echo $customer_info['streetName']; ?>"><br>

        <label for="streetNum">Street Number:</label>
        <input type="text" id="streetNum" name="streetNum" value="<?php echo $customer_info['streetNum']; ?>"><br>

        <label for="zipcode">Zipcode:</label>
        <input type="text" id="zipcode" name="zipcode" value="<?php echo $customer_info['zipcode']; ?>"><br>

        <input type="submit" value="Update Information">
    </form>
</body>
</html>

<?php
  // Start a new session or resume the existing one
  session_start();
  
  // Include your database connection file
  include 'db_connection.php';
  
  // Get database connection
  $conn = createConnection();
  
  //Retrieve usable customer address based on session variable containing address's ID

?>
<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
    <form action="update_customer.php" method="POST">
      <label for="firstName">First Name:</label>
      <input type="text" name="firstName" id="firstName" value="<?php echo $_SESSION['customerFirstName']; ?>"><br>
      <label for="lastName">Last Name:</label>
      <input type="text" name="lastName" id="lastName" value="<?php echo $_SESSION['customerLastName']; ?>"><br>
      <label for="address">Address:</label>
      <input type="text" name="address" id="address" value="<?php echo $customer['customerAddress']; ?>"><br>
      <label for="email">Email:</label>
      <input type="text" name="email" id="email" value="<?php echo $_SESSION['customerEmail']; ?>"><br>
      <label for="phoneNum">Phone Number:</label>
      <input type="text" name="phoneNum" id="phoneNum" value="<?php echo $contact['phoneNum']; ?>"><br>
      <input type="submit" value="Update">
    </form>
  </body>
</html>

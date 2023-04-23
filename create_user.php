<!DOCTYPE html>
<html>
<head>
    <title>Create New User</title>
</head>
<div class="homepage-link">
  <a href="index.php">Home</a>
</div>
<body>
    <h1>Create New User</h1>
    <!-- The form submits user data to register_user.php -->
    <form action="register_user.php" method="post">
        <!-- Email input field -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <!-- Password input field -->
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <!-- First name input field -->
        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" name="firstName" required><br><br>

        <!-- Last name input field -->
        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" name="lastName" required><br><br>

        <!-- Store selection dropdown -->
        <label for="currentStore">Choose a store:</label>
        <select name="currentStore" id="currentStore">
            <?php
            // Start a new session
            session_start();

            // Include the db_connection.php file
            include 'db_connection.php';

            // Create a new database connection
            $conn = createConnection();

            // Fetch available stores from the 'store' table
            $result = $conn->query("SELECT storeId, storeAddress FROM store");
            if ($result->num_rows > 0) {
                // Loop through the rows and create an option element for each store
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=\"" . $row['storeId'] . "\">Store " . $row['storeId'] . " - Address ID: " . $row['storeAddress'] . "</option>";
                }
            }
            // Close the database connection
            $conn->close();
            ?>
        </select>
        <br><br>

        <!-- Submit button -->
        <input type="submit" value="Create User">
    </form>
</body>
</html>

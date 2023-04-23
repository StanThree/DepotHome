<!DOCTYPE html>
<html>
<head>
    <title>Login/Change User</title>
</head>
<div class="homepage-link">
  <a href="index.php">Home</a>
</div>

<body>
    <h1>Login/Change User</h1>
    <form action="authenticate.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
    <p><a href="create_user.php">Create New User</a></p>

</body>
</html>

<?php
session_start();

// Check if the admin is already logged in; if yes, redirect to the admin dashboard
if (isset($_SESSION['admin_id'])) {
    header('Location: index.php');
    exit();
}

// Check if the login form is submitted
if (isset($_POST['login'])) {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace this part with your actual database validation logic
    // Check if the username and password are correct
    if ($username === "admin" && $password === "1234") {
        // If the login is successful, set the admin_id session variable
        $_SESSION['admin_id'] = 1; // Replace with your admin ID
        header('Location: index.php'); // Redirect to the dashboard on success
        exit();
    } else {
        // If the login fails, set an error message
        $_SESSION['login_error'] = 'Invalid username or password';
        header('Location: login.php'); // Redirect back to the login page on failure
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles/reset.min.css" />
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/admin-login.css" />
  </head>
  <body>
    <div class="container">
      <form class="login-form" action="login.php" method="post">
        <h1>Admin Login</h1>
        <?php if (isset($_SESSION['login_error'])) : ?>
        <div class="error"><?php echo $_SESSION['login_error']; ?></div>
        <?php unset($_SESSION['login_error']); ?>
        <?php endif; ?>
        <div class="form-group">
          <label for="username">Username:</label>
          <input type="text" id="username" name="username" required />
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required />
        </div>
        <button type="submit" name="login">Login</button>
      </form>
    </div>
  </body>
</html>

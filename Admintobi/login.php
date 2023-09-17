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
      <form class="login-form" action="index.php" method="post">
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

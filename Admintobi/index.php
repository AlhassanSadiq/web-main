<?php
session_start();

// Check if the admin is logged in; if not, redirect to the login page
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}

// Check if the "Logout" button is submitted
if (isset($_POST['logout'])) {
    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header('Location: login.php');
    exit();
}

$host = 'localhost'; // Your database host
$dbname = 'porcode_db'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Retrieve user data from the database
$userQuery = "SELECT * FROM users";
$userResult = $db->query($userQuery);
if (!$userResult) {
    die("Error: " . $db->errorInfo()[2]);
}

// Retrieve order data from the database
$orderQuery = "SELECT * FROM orders";
$orderResult = $db->query($orderQuery);
if (!$orderResult) {
    die("Error: " . $db->errorInfo()[2]);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="UTF-8" />
    <meta name="keywords" content="Admin Dashboard" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles/reset.min.css" />
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/admin-dashboard.css" />
    <link rel="stylesheet" href="css/bootstrap.css" />
    <!-- Bootstrap-Core-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <style>
        .logout-button {
            background-color: #ff0000; /* Change the background color */
            color: #fff; /* Change the text color */
        }
    </style>
  </head>
  <body>
    <div class="sidebar">
      <h2>Admin Dashboard</h2>
      <ul>
        <li class="active" onclick="showSection('user-management')">
          User Management
        </li>
        <li onclick="showSection('order-management')">View Orders</li>
        <li>
            <form onsubmit="return confirm('Are you sure you want to log out?');" action="" method="post">
                <button type="submit" name="logout" class="logout-button">Logout</button>
            </form>
        </li>
      </ul>
    </div>
    <div class="main">
      <div class="admin-section">
      </div>
      <div class="content">
        <div class="section user-management active">
          <h2>User Management</h2>
          <table class="user-table">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
            <?php
            while ($row = $userResult->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                // Add more columns as needed
                echo "<td>";
                echo "<button>Edit</button>";
                echo "<button>Delete</button>";
                echo "</td>";
                echo "</tr>";
            }
            ?>
          </table>
        </div>
        <div class "section order-management">
          <h2>View Orders</h2>
          <table class="order-table">
            <tr>
              <th>ID</th>
              <th>Order Date</th>
              <th>Service</th>
              <th>Country</th>
              <th>Number</th>
              <th>Payment Status</th>
            </tr>
            <?php
            while ($row = $orderResult->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['order_id'] . "</td>";
                echo "<td>" . $row['order_date'] . "</td>";
                echo "<td>" . $row['service'] . "</td>";
                echo "<td>" . $row['country'] . "</td>";
                echo "<td>" . $row['number'] . "</td>";
                echo "<td>" . $row['payment_status'] . "</td>";
                echo "</tr>";
            }
            ?>
          </table>
        </div>
        <!-- Other sections and content go here -->
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>

<?php
// Include your database connection code here
// $conn = mysqli_connect($hostname, $username, $password, $database);

// Check the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch order data from the orders table
$sql = "SELECT order_id, order_date, service, country, number, payment_status FROM orders";
$result = mysqli_query($conn, $sql);

// Display order data
if ($result && mysqli_num_rows($result) > 0) {
    echo '<table class="order-table">';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Order Date</th>';
    echo '<th>Service</th>';
    echo '<th>Country</th>';
    echo '<th>Number</th>';
    echo '<th>Payment Status</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['order_id'] . '</td>';
        echo '<td>' . $row['order_date'] . '</td>';
        echo '<td>' . $row['service'] . '</td>';
        echo '<td>' . $row['country'] . '</td>';
        echo '<td>' . $row['number'] . '</td>';
        echo '<td>' . $row['payment_status'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo 'No orders found.';
}

// Close the database connection
mysqli_close($conn);
?>

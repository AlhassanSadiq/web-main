<?php
// Include your database connection code here
// $conn = mysqli_connect($hostname, $username, $password, $database);

// Check the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user data from the users table
$sql = "SELECT id, username, email, role, status FROM users";
$result = mysqli_query($conn, $sql);

// Display user data
if ($result && mysqli_num_rows($result) > 0) {
    echo '<table class="user-table">';
    echo '<tr>';  
    echo '<th>ID</th>';
    echo '<th>Name</th>';
    echo '<th>Email</th>';
    echo '<th>Role</th>';
    echo '<th>Status</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['username'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '<td>' . $row['role'] . '</td>';
        echo '<td>' . $row['status'] . '</td>';
        echo '<td>';
        echo '<button>Edit</button>';
        echo '<button>Delete</button>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo 'No users found.';
}

// Close the database connection
mysqli_close($conn);
?>

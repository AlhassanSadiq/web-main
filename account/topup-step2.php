<?php
include_once 'header.php';

// topup-step2.php

// Check if the payment method is Binance
if (isset($_GET['payment_method']) && $_GET['payment_method'] === 'Binance') {
  // Retrieve the selected payment amount from the form
  $selectedAmount = $_POST['payment_amount'];

  // Make sure the selected amount is valid and numeric
  if (!is_numeric($selectedAmount) || $selectedAmount <= 0) {
      // Invalid payment amount, redirect to top-up page with an error message
      header('Location: topup-page.php?error=1');
      exit();
  }

  // Initialize Binance Pay SDK (you should have already done this in script.js)
  // const binancePay = new BinancePay({ apiKey: 'YOUR_API_KEY', secretKey: 'YOUR_SECRET_KEY' });

  // ... The rest of your Binance Pay integration code ...

  // For demonstration purposes, we'll simulate a successful payment
  $paymentSuccessful = true;

  if ($paymentSuccessful) {
      // Fetch the user's current balance from the database based on their user ID
      $userId = $_SESSION['user_id']; // Adjust this to get the user's ID from your session
      $query = "SELECT balance FROM users WHERE id = $userId";
      $result = mysqli_query($conn, $query);

      if ($result && mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          $currentBalance = $row['balance'];

          // Calculate the new balance
          $newBalance = $currentBalance + $selectedAmount;

          // Update the user's balance in the database
          $updateQuery = "UPDATE users SET balance = $newBalance WHERE id = $userId";
          if (mysqli_query($conn, $updateQuery)) {
              // Balance updated successfully, redirect to dashboard with success message
              header('Location: dashboard.php?success=1');
              exit();
          } else {
              // Handle database update error, redirect to top-up page with error message
              header('Location: topup-page.php?error=1');
              exit();
          }
      }
  } else {
      // Payment failed, redirect to top-up page with error message
      header('Location: topup-page.php?error=1');
      exit();
  }
} else {
  // Invalid payment method, redirect to top-up page with error message
  header('Location: topup-page.php?error=1');
  exit();
}

<?php
// Start the session
session_start();
include 'db.php'; // Include database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get form inputs
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];

  // Validate if passwords match
  if ($password !== $confirm_password) {
    $error = "Passwords do not match!";
  } else {
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, phone, address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $hashed_password, $phone, $address);

    if ($stmt->execute()) {
      $_SESSION['user_id'] = $stmt->insert_id;  // Save user ID in session for OTP verification
      echo "<script>alert('Registration successful! Please verify your OTP.');</script>";
    } else {
      echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Davis Kunyu">
  <title>Sign Up - Davira Suites</title>

  <style>
    /* CSS styles updated for aesthetics */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f0f0;
    }

    header {
      background-color: #001f3f;
      color: white;
      text-align: center;
      padding: 20px;
    }

    main {
      padding: 20px;
      text-align: center;
    }

    form {
      margin: 0 auto;
      width: 50%;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input {
      padding: 10px;
      margin: 10px;
      width: 80%;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    button {
      padding: 15px 30px;
      background-color: #0074D9;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #001f3f;
    }
  </style>
</head>

<body>
  <header>
    <h1>Sign Up for Davira Suites</h1>
  </header>

  <main>
    <?php
    if (isset($error)) {
      echo "<p style='color:red; font-weight:bold;'>$error</p>";
    }
    ?>
    <form id="signup-form" action="" method="POST">
      <input type="text" name="username" placeholder="Enter Username" required>
      <input type="email" name="email" placeholder="Enter Email" required>
      <input type="password" name="password" placeholder="Enter Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <input type="text" name="phone" placeholder="Enter Phone Number" required>
      <input type="text" name="address" placeholder="Enter Address" required>

      <button type="button" onclick="requestOtp()">Request OTP</button>
      <input type="text" id="otp" name="otp" placeholder="Enter OTP" required>

      <button type="submit" id="signup-btn">Sign Up</button>
    </form>
  </main>

  <script>
    function requestOtp() {
      // Assuming OTP is generated here and sent via SMS API
      alert("OTP has been sent to your phone.");
    }
  </script>
</body>

</html>

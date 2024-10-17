<?php
// userprofile.php
// Include the database connection and start session
include 'db_connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

// Fetch the user data from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$user = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Davis Kunyu">
  <title>User Profile - Davira Suites</title>

  <style>
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

    .profile-container {
      background-color: white;
      padding: 20px;
      margin: 20px auto;
      width: 50%;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile-details {
      text-align: left;
      margin-bottom: 20px;
    }

    button {
      padding: 10px 20px;
      background-color: #0074D9;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #001f3f;
    }

    .profile-icon {
      display: inline-block;
      vertical-align: middle;
      width: 20px;
      height: 20px;
    }
  </style>
  
  <!-- Inline JS for handling navigation -->
  <script>
    function navigateTo(page) {
      window.location.href = page;
    }
  </script>
</head>
<body>
  <header>
    <h1>User Profile</h1>
  </header>

  <main>
    <div class="profile-container">
      <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
      <div class="profile-details">
        <p>
          <img class="profile-icon" src="icons/email-icon.png" alt="Email Icon">
          Email: <?php echo htmlspecialchars($user['email']); ?>
        </p>
        <p>
          <img class="profile-icon" src="icons/phone-icon.png" alt="Phone Icon">
          Phone: <?php echo htmlspecialchars($user['phone']); ?>
        </p>
        <p>
          <img class="profile-icon" src="icons/address-icon.png" alt="Address Icon">
          Address: <?php echo isset($user['address']) ? htmlspecialchars($user['address']) : 'Not provided'; ?>
        </p>
      </div>
      <button onclick="navigateTo('home.php')">Back to Home</button>
    </div>
  </main>

</body>
</html>

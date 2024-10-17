<?php
// Connecting PHP backend to the Hotel Management System
// Step by step integration, maintaining the in-page styling, and enhancing the design and user experience of each file.

/* Step 1: Setup database connection in a reusable way */

// Create a reusable PHP file for database connection (db_connect.php) to be included in all other files where needed
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'hotel_management_system';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Davis Kunyu">
  <title>Signup - Davira Suites</title>

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

    .btn-group {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 10px;
    }

    .btn-submit {
      padding: 15px 30px;
      background-color: #0074D9;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn-submit:hover {
      background-color: #001f3f;
    }
  </style>
</head>
<body>

  <?php
  // Including the database connection file
  include 'db_connect.php';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$password')";

      if ($conn->query($sql) === TRUE) {
          echo "<script>alert('Registration successful! Please log in.'); window.location.href = 'login.php';</script>";
      } else {
          echo "<script>alert('Error: ' . $sql . ' ' . $conn->error);</script>";
      }
  }
  ?>

  <header>
    <h1>Sign Up</h1>
  </header>

  <main>
    <form action="signup.php" method="POST">
      <input type="text" name="username" placeholder="Enter Username" required>
      <input type="email" name="email" placeholder="Enter Email" required>
      <input type="text" name="phone" placeholder="Enter Phone Number" required>
      <input type="password" name="password" placeholder="Enter Password" required>
      <div class="btn-group">
        <button type="submit" class="btn-submit">Sign Up</button>
      </div>
    </form>
  </main>

</body>
</html>

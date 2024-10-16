<?php
include 'db.php'; // Include the database connection
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $otp = $_POST['otp'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, password, phone FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Fetch user data
        $stmt->bind_result($id, $username, $hashed_password, $phone);
        $stmt->fetch();

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            // Verify the OTP
            $otp_stmt = $conn->prepare("SELECT otp_code FROM otp_codes WHERE user_id = ? AND expires_at > NOW()");
            $otp_stmt->bind_param("i", $id);
            $otp_stmt->execute();
            $otp_stmt->bind_result($db_otp);
            if ($otp_stmt->fetch() && $otp == $db_otp) {
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $id;
                header("Location: dashboard.php");
                exit;
            } else {
                echo "<script>alert('Invalid or expired OTP!');</script>";
            }
            $otp_stmt->close();
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('No account found with that username!');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Davira Suites</title>

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

    button {
      padding: 10px 20px;
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
    <h1>Login to Davira Suites</h1>
  </header>

  <main>
    <form action="login.php" method="POST">
      <input type="text" name="username" placeholder="Enter Username" required>
      <input type="password" name="password" placeholder="Enter Password" required>
      <button type="button" onclick="requestOtp()">Request OTP</button>
      <input type="text" name="otp" placeholder="Enter OTP" required>
      <button type="submit">Login</button>
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

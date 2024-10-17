
<?php
// login.php
// Include the database connection and start session
include 'db_connect.php';
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare statement to check user credentials
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Failed to prepare statement: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $login_error = "Invalid username or password.";
    } else {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'admin') {
                header("Location: adminprofile.php");
            } else {
                header("Location: userprofile.php");
            }
            exit();
        } else {
            $login_error = "Invalid username or password.";
        }
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Davis Kunyu">
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
      padding: 15px 30px;
      background-color: #0074D9;
      color: white;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      transition: background-color 0.3s, transform 0.2s;
    }

    button:hover {
      background-color: #001f3f;
      transform: scale(1.05);
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
      <button type="submit">Login</button>
      <?php if (isset($login_error)): ?>
          <p style="color: red;"> <?php echo $login_error; ?> </p>
      <?php endif; ?>
    </form>
  </main>
</body>
</html>
```

userprofile.php
```php
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
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Failed to prepare statement: " . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found.");
}

$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Davis Kunyu">
  <title>User Profile - Davira Suites</title>
  
  <!-- Reuse CSS and JS styling from sign up page -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>User Profile</h1>
  </header>

  <main>
    <div class="profile-container">
      <h2>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h2>
      <div class="profile-details">
        <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
        <p>Phone: <?php echo htmlspecialchars($user['phone']); ?></p>
        <p>Address: <?php echo isset($user['address']) ? htmlspecialchars($user['address']) : 'Not provided'; ?></p>
      </div>
      <button onclick="navigateTo('home.php')">Back to Home</button>
    </div>
  </main>

</body>
</html>
```

adminprofile.php
```php
<?php
// adminprofile.php
// Include the database connection and start session
include 'db_connect.php';
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Fetch the admin data from the database
$admin_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = ? AND role = 'admin'";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Failed to prepare statement: " . $conn->error);
}

$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Admin not found.");
}

$admin = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Davis Kunyu">
  <title>Admin Profile - Davira Suites</title>

  <!-- Reuse CSS and JS styling from sign up page -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header>
    <h1>Admin Profile</h1>
  </header>

  <main>
    <div class="profile-container">
      <h2>Welcome, <?php echo htmlspecialchars($admin['username']); ?>!</h2>
      <div class="profile-details">
        <p>Email: <?php echo htmlspecialchars($admin['email']); ?></p>
      </div>
      <button onclick="navigateTo('home.php')">Back to Home</button>
    </div>
  </main>
</body>
</html>

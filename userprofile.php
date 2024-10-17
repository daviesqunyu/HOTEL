<?php
// Debugging to ensure errors are visible
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session before any output to prevent header errors
session_start();

// Include the database connection
include 'db_connect.php';

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
    echo "<p>User not found.</p>";
    exit();
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

  <!-- External Stylesheets and Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.css" />

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(to right, #001f4d, #004d99);
      color: #f9f9f9;
      overflow-x: hidden;
    }

    header {
      background-color: rgba(0, 0, 51, 0.9);
      color: white;
      text-align: center;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      animation: fadeIn 2s ease-in-out;
    }

    main {
      padding: 20px;
      text-align: center;
      animation: slideIn 1.5s ease-in-out;
    }

    .profile-container {
      background-color: rgba(255, 255, 255, 0.9);
      padding: 30px;
      margin: 20px auto;
      width: 60%;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
      animation: animate__animated animate__fadeInUp;
    }

    .profile-details {
      text-align: left;
      margin-bottom: 20px;
      font-size: 18px;
      color: #333;
    }

    button {
      padding: 12px 25px;
      background-color: #0074D9;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.2s;
    }

    button:hover {
      background-color: #00509d;
      transform: scale(1.05);
    }

    .profile-icon {
      display: inline-block;
      vertical-align: middle;
      width: 20px;
      height: 20px;
    }

    .calendar-container {
      margin-top: 40px;
      background-color: rgba(0, 0, 51, 0.8);
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
    }

    .three-js-container {
      margin-top: 40px;
      text-align: center;
    }

    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideIn {
      from { transform: translateY(-50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
  </style>

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

    <!-- Booking Calendar Widget -->
    <div class="calendar-container">
      <h3>Your Bookings</h3>
      <div id="user-booking-calendar"></div>
    </div>

    <!-- AI Interactive Widget -->
    <div class="three-js-container">
      <h3>Explore Our Virtual Lobby</h3>
      <div id="three-js-lobby"></div>
    </div>
  </main>

  <!-- JavaScript for Calendar Widget and 3D Experience -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

  <script>
    // Initialize the calendar
    $(document).ready(function() {
      $('#user-booking-calendar').fullCalendar({
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        events: [
          {
            title: 'Luxury Suite Booking',
            start: '2024-11-15',
            end: '2024-11-18',
            color: '#0074D9'
          },
          {
            title: 'Spa & Wellness Appointment',
            start: '2024-11-20',
            end: '2024-11-21',
            color: '#2ECC40'
          }
        ]
      });
    });

    // Three.js interactive 3D model for the lobby view
    var scene = new THREE.Scene();
    var camera = new THREE.PerspectiveCamera(75, window.innerWidth / 600, 0.1, 1000);
    var renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth * 0.6, 600);
    document.getElementById('three-js-lobby').appendChild(renderer.domElement);

    var geometry = new THREE.BoxGeometry();
    var material = new THREE.MeshBasicMaterial({ color: 0x00ff00 });
    var cube = new THREE.Mesh(geometry, material);
    scene.add(cube);

    camera.position.z = 5;

    function animate() {
      requestAnimationFrame(animate);
      cube.rotation.x += 0.01;
      cube.rotation.y += 0.01;
      renderer.render(scene, camera);
    }
    animate();
  </script>
</body>
</html>

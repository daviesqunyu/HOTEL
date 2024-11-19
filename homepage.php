<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <div style="text-align:center;padding:15%;">
        <p style="font-size: 50px;font-weight:bold;">
        Hello 
        <?php
        $email = $_SESSION['email'];
        $query = $conn->prepare("SELECT firstName, lastName FROM users WHERE email = ?");
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();

        if ($row = $result->fetch_assoc()) {
            echo htmlspecialchars($row['firstName']) . ' ' . htmlspecialchars($row['lastName']);
        }
        ?>
        </p>
    </div>
</body>
</html>

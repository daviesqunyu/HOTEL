<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Davis Kunyu">
  <title>Sign Up - Davira Suites</title>

  <!-- FontAwesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    /* Button arrangements */
    .btn-group {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 10px;
    }

    .icon-btn {
      padding: 10px 20px;
      background-color: #0074D9;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: background-color 0.3s;
      margin-bottom: 15px;
    }

    .icon-btn i {
      font-size: 20px;
    }

    .icon-btn:hover {
      background-color: #25486c;
    }

  /* Bigger and darker sign-up button */
#submit-btn {
  background-color: #190546;
  padding: 15px 30px;
  font-size: 20px;
  font-weight: 900; 
  color: #ffffff; 
  border-radius: 10px; 
  border: none; 
  transition: background-color 0.3s, transform 0.2s; 
}

#submit-btn:hover {
  background-color: #0f2389; /* Darker color on hover */
  transform: scale(1.05); /* Slightly enlarges the button on hover */
}

    /* CAPTCHA Section */
    .captcha {
      display: none;
      margin-top: 20px;
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      padding: 15px;
      text-align: center;
      border-radius: 5px;
    }

    .captcha-images {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 10px;
      margin: 20px 0;
    }

    .captcha-images img {
      width: 100px;
      height: 100px;
      cursor: pointer;
      border: 2px solid #ccc;
      transition: border-color 0.3s;
    }

    .captcha-images img.selected {
      border-color: #4CAF50;
    }

    .captcha button {
      padding: 10px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }

    .captcha button:hover {
      background-color: #218838;
    }

    /* Cookies Banner */
    .cookies-banner {
      position: fixed;
      bottom: -100px;
      left: 0;
      right: 0;
      background-color: #ffcc00;
      padding: 10px;
      border-radius: 5px;
      text-align: center;
      font-size: 14px;
      transition: bottom 0.5s ease-in-out;
    }

    .cookies-banner.visible {
      bottom: 0;
    }

    .cookies-banner button {
      background-color: #0074D9;
      color: white;
      padding: 5px 10px;
      border: none;
      cursor: pointer;
      margin: 5px;
    }

    #captcha-result {
      color: red;
      font-weight: bold;
      margin-top: 10px;
    }
  </style>

</head>

<body>

  <header>
    <h1>Sign Up for Davira Suites</h1>
  </header>

  <main>
    <form id="signup-form" action="signup.php" method="POST">
      <input type="text" name="username" placeholder="Enter Username" required>
      <input type="email" name="email" placeholder="Enter Email" required>
      <input type="password" name="password" placeholder="Enter Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <input type="text" name="phone" placeholder="Enter Phone Number" required>
      <input type="text" name="address" placeholder="Enter Address" required>

      <!-- OTP and "I'm not a robot" Section -->
      <div class="btn-group">
        <button type="button" class="icon-btn" onclick="requestOtp()">
          <i class="fas fa-mobile-alt"></i> OTP
        </button>
        <button type="button" class="icon-btn" id="robot-check" onclick="showCaptcha()">
          <i class="fas fa-robot"></i> I'm not a robot
        </button>
      </div>

      <!-- CAPTCHA Section -->
      <div id="captcha" class="captcha">
        <p>Select all images with bedsides in a hotel</p>
        <div class="captcha-images">
          <img src="bedside.jpg" alt="bedside" data-correct="true" onclick="selectImage(this)">
          <img src="bed.jpg" alt="random image 1" data-correct="false" onclick="selectImage(this)">
          <img src="sidebed.jpg" alt="random image 2" data-correct="false" onclick="selectImage(this)">
          <img src="hotel.jpg" alt="bedside" data-correct="true" onclick="selectImage(this)">
        </div>
        <button type="button" onclick="verifyCaptcha()">Verify CAPTCHA</button>
        <p id="captcha-result"></p>
      </div>

      <!-- Bigger Sign Up Button -->
      <div class="btn-group">
        <button id="submit-btn" type="submit" disabled>Sign Up</button>
      </div>
    </form>
  </main>

  <!-- Cookies acceptance banner -->
  <div class="cookies-banner" id="cookies-banner">
    This website uses cookies to ensure you get the best experience.
    <button type="button" onclick="acceptCookies()">Accept Cookies</button>
    <button type="button" onclick="rejectCookies()">Reject Cookies</button>
  </div>

  <script>
    let selectedImages = [];
    let captchaVerified = false;

    // Function to simulate OTP request
    function requestOtp() {
      alert("OTP has been sent to your phone.");
    }

    // Show CAPTCHA when "I'm not a robot" is clicked
    function showCaptcha() {
      const captcha = document.getElementById('captcha');
      captcha.style.display = 'block'; // Show the CAPTCHA images
    }

    // Image selection function
    function selectImage(image) {
      if (selectedImages.includes(image)) {
        image.classList.remove('selected');
        selectedImages = selectedImages.filter(img => img !== image);
      } else {
        image.classList.add('selected');
        selectedImages.push(image);
      }
    }

    // CAPTCHA verification
    function verifyCaptcha() {
      const correctImages = Array.from(document.querySelectorAll('img[data-correct="true"]'));
      const allCorrectSelected = correctImages.every(img => selectedImages.includes(img)) && selectedImages.length === correctImages.length;
      const captchaResult = document.getElementById('captcha-result');

      if (allCorrectSelected) {
        captchaResult.textContent = "CAPTCHA verified successfully!";
        captchaResult.style.color = "green";
        captchaVerified = true;
        document.getElementById("submit-btn").disabled = false; // Enable sign-up button
      } else {
        captchaResult.textContent = "CAPTCHA verification failed. Please try again.";
        captchaResult.style.color = "red";
        captchaVerified = false;
        document.getElementById("submit-btn").disabled = true; // Disable sign-up button
      }
    }

    // Cookies acceptance banner slide in and slide out effect
    function acceptCookies() {
      const cookiesBanner = document.getElementById('cookies-banner');
      cookiesBanner.classList.remove('visible');
      alert("You have accepted cookies.");
      cookiesBanner.style.display = 'none'; // Hide banner after accepting
    }

    function rejectCookies() {
      const cookiesBanner = document.getElementById('cookies-banner');
      cookiesBanner.classList.remove('visible');
      alert("You have rejected cookies.");
      cookiesBanner.style.display = 'none'; // Hide banner after rejecting
    }

    // Slide in the cookies banner
    window.onload = function () {
      const cookiesBanner = document.getElementById('cookies-banner');
      setTimeout(() => {
        cookiesBanner.classList.add('visible');
      }, 1000); // Show cookies banner 1 second after page loads
    }
  </script>

</body>

</html>

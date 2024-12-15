<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register and Log-In</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: system-ui, sans-serif; }
    body { background-color: rgb(16, 3, 65); background: -moz-repeating-linear-gradient(); }
    .container { background: #ceeade; width: 450px; padding: 1.5rem; margin: 50px auto; border-radius: 10px; box-shadow: 0 20px 35px rgba(0, 0, 1, 0.09); }
    form { margin: 0 2rem; }
    .form-title { font-size: 1.5rem; font-weight: bold; text-align: center; padding: 1.3rem; margin-bottom: 0.4rem; }
    input { color: inherit; width: 100%; background-color: transparent; border: none; border-bottom: 1px solid #757575; padding-left: 1.5rem; font-size: 15px; }
    .input-group { padding: 1%; position: relative; }
    .input-group i { position: absolute; color: black; }
    input:focus { background-color: transparent; outline: transparent; border-bottom: 2px solid hsl(327, 90%, 28%); }
    label { color: black; position: relative; left: 1.2rem; top: 1.3rem; cursor: auto; transition: 0.3s ease all; }
    input:focus ~ label, input:not(:placeholder-shown) ~ label { top: -3em; color: hsl(327, 90%, 28%); font-size: 15px; }
    .btn { font-size: 1.1rem; padding: 8px 0; border-radius: 5px; outline: none; border: none; width: 100%; background: rgb(12, 12, 220); color: white; cursor: pointer; transition: 0.9s; }
    .btn:hover { color: rgba(3, 3, 3, 0.715); }
    .icons i { color: rgb(119, 31, 178); padding: 0.8rem; border-radius: 10px; font-size: 1.5rem; cursor: pointer; margin: 0 15px; transition: 1s; }
    .icons i:hover { background: #07001f; font-size: 1.6rem; border: 2px solid rgb(125, 125, 235); }
    .link { display: flex; justify-content: space-around; padding: 0 4rem; margin-top: 0.9rem; font-weight: bold; }
    button { color: rgb(6, 12, 8); border-top-right-radius: 0.5px; border-block-end-style: double; background-color: rgb(73, 147, 73); font-size: 1rem; font-weight: bold; }
    button:hover { text-decoration: underline; color: rgb(30, 30, 167); }
    #cookieConsent { position: fixed; bottom: 10px; left: 0; width: 100%; background-color: rgba(0, 0, 0, 0.8); color: white; padding: 15px; text-align: center; font-size: 16px; z-index: 9999; }
    #cookieConsent button { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; margin-left: 20px; font-size: 16px; }
    #cookieConsent button:hover { background-color: #45a049; }
    .security-banner { position: fixed; top: 0; left: 0; width: 100%; background-color: #f1c40f; color: black; padding: 10px; text-align: center; font-size: 16px; z-index: 9999; display: none; }
    .security-banner button { background-color: #e67e22; color: white; padding: 5px 15px; border: none; cursor: pointer; font-size: 16px; }
    .security-banner button:hover { background-color: #d35400; }
  </style>
</head>
<body>

  <!-- Security Banner -->
  <div id="securityBanner" class="security-banner">
    <span id="securityMessage"></span>
    <button onclick="closeSecurityBanner()">Close</button>
  </div>

  <!-- Secure Registration Form -->
  <div class="container" id="signup" style="display:none;">
    <h1 class="form-title">Register</h1>
    <form method="post" action="register.php" id="registrationForm" autocomplete="off">
      <!-- First Name Input -->
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="fName" id="fName" required pattern="[A-Za-z]+" title="First name must contain only letters" autocomplete="given-name">
        <label for="fName">First Name</label>
      </div>
      <!-- Last Name Input -->
      <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" name="lName" id="lName" required pattern="[A-Za-z]+" title="Last name must contain only letters" autocomplete="family-name">
        <label for="lName">Last Name</label>
      </div>
      <!-- Email Input -->
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="email" required autocomplete="email">
        <label for="email">E-Mail</label>
      </div>
      <!-- Password Input -->
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="password" required pattern=".{8,}" title="Password must be at least 8 characters long" autocomplete="new-password">
        <label for="password">Password</label>
      </div>
      <!-- Submit Button -->
      <input type="submit" class="btn" value="Sign Up" name="Sign Up">
    </form>
    <p class="or">--------------or sign up with--------------</p>
    <div class="icons">
      <i class="fab fa-google"></i>
      <i class="fab fa-facebook"></i>
      <i class="fab fa-instagram"></i>
    </div>
    <div class="links">
      <p class="account-text">Already have an account?</p>
      <button id="signInButton" class="sign-in-button" aria-label="Sign In to Your Account">Sign In</button>
    </div>
  </div>

  <!-- Secure Sign In Form -->
  <div class="container" id="signIn">
    <h1 class="form-title">Sign In</h1>
    <form method="post" action="login.php" id="loginForm" autocomplete="off">
      <div class="input-group">
        <i class="fas fa-envelope"></i>
        <input type="email" name="email" id="loginEmail" required autocomplete="email">
        <label for="loginEmail">E-Mail</label>
      </div>
      <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" id="loginPassword" required autocomplete="current-password">
        <label for="loginPassword">Password</label>
      </div>
      <div class="input-group otp-group">
        <button type="button" onclick="sendOTP()">Send OTP</button>
        <input type="text" id="otp" placeholder="Enter OTP" enabled />
      </div>
      <input type="submit" class="btn" value="Log In">
      
    </form>
    <p class="or">--------------or log in with--------------</p>
    <div class="icons">
      <i class="fab fa-google"></i>
      <i class="fab fa-facebook"></i>
      <i class="fab fa-instagram"></i>
    </div>
    <div class="links">
      <p class="account-text">Don't have an account?</p>
      <button id="signUpButton" class="sign-up-button" aria-label="Create an Account">Sign Up</button>
    </div>
  </div>

<script>
  // Toggle Forms
document.getElementById("signInButton").addEventListener("click", () => {
  document.getElementById("signup").style.display = "none";
  document.getElementById("signIn").style.display = "block";
});

document.getElementById("signUpButton").addEventListener("click", () => {
  document.getElementById("signup").style.display = "block";
  document.getElementById("signIn").style.display = "none";
});

// Email validation regex
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

// Password validation (min 12 characters, includes symbols, letters, and numbers)
function validatePassword(password) {
  const passwordRegex = /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{12,}$/;
  return passwordRegex.test(password);
}

// Validate password on signup
function validateSignUpPassword() {
  const password = document.getElementById("signupPassword").value;
  const passwordMessage = document.getElementById("passwordMessage");

  if (!validatePassword(password)) {
    passwordMessage.style.color = "red";
    passwordMessage.textContent =
      "Password must be at least 12 characters with letters, numbers, and symbols.";
    return false;
  }
  passwordMessage.style.color = "green";
  passwordMessage.textContent = "Password meets security requirements.";
  return true;
}

// OTP to email
async function sendOTP() {
  const email = document.getElementById("loginEmail").value;

  if (!emailRegex.test(email)) {
    alert("Please enter a valid email address.");
    return;
  }

  try {
    // Simulate an API request to send the OTP
    const response = await fetch("https://api.example.com/send-otp", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ email }),
    });

    if (response.ok) {
      const result = await response.json();
      if (result.success) {
        showSecurityBanner(`OTP sent to ${email}. Please check your inbox.`);
      } else {
        alert("Failed to send OTP. Please try again.");
      }
    } else {
      alert("An error occurred while sending OTP. Please try again later.");
    }
  } catch (error) {
    console.error("Error sending OTP:", error);
    alert("An unexpected error occurred. Please try again later.");
  }
}

// Display security banner
function showSecurityBanner(message) {
  const banner = document.getElementById("securityBanner");
  const bannerMessage = document.getElementById("securityMessage");

  banner.style.display = "block";
  bannerMessage.innerText = message;

  // Auto-hide the banner after 10 seconds
  setTimeout(() => {
    banner.style.display = "none";
  }, 10000);
}

// Close security banner manually
function closeSecurityBanner() {
  document.getElementById("securityBanner").style.display = "none";
}

// Attach validation to password field
document
  .getElementById("signupPassword")
  .addEventListener("input", validateSignUpPassword);

// Example: Restrict submit button until the password is valid
document.getElementById("signupForm").addEventListener("submit", (e) => {
  if (!validateSignUpPassword()) {
    e.preventDefault();
    alert("Please fix the errors in your form before submitting.");
  }
});

</script>
</body>
</html>

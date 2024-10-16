<?php
// Include the database connection if needed
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Davis Kunyu">
  <title>Davira Suites - Luxury Meets Comfort</title>

  <!-- Inline CSS for styling and animations -->
  <style>
    /* General body styles */
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Helvetica Neue', sans-serif;
      background: url('hotel.jpg') no-repeat center/cover;
      color: white;
      overflow-x: hidden;
    }

    /* Header styles */
    .hero-section {
      text-align: center;
      padding: 60px;
      background-color: rgba(0, 0, 0, 0.6);
      animation: fadeIn 2s ease-in;
    }

    .hero-section h1 {
      font-size: 55px;
      margin: 0;
      padding-bottom: 10px;
      font-weight: bold;
    }

    .hero-section p {
      font-size: 22px;
      padding-bottom: 30px;
    }

    /* Navigation buttons */
    nav button {
      background-color: #0074D9;
      color: white;
      border: none;
      padding: 15px 25px;
      margin: 10px;
      border-radius: 8px;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.3s;
    }

    nav button:hover {
      background-color: #001f3f;
      transform: scale(1.1);
    }

    /* Main content area */
    .about-section, .services {
      padding: 40px;
      text-align: center;
      background-color: rgba(0, 0, 0, 0.6);
      margin-top: -40px;
      border-radius: 25px 25px 0 0;
      animation: slideInUp 1.5s ease-in;
    }

    .about-section h2, .services h2 {
      font-size: 36px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .about-section p, .services p {
      font-size: 18px;
      color: #f0f0f0;
      line-height: 1.8;
      padding: 0 15%;
      animation: fadeIn 2s ease-in-out;
    }

    /* Contact Information */
    .contact-section {
      padding: 40px;
      text-align: center;
      background-color: rgba(0, 0, 0, 0.7);
      margin-top: 40px;
      animation: fadeIn 2s ease-in-out;
    }

    .contact-section h3 {
      font-size: 30px;
      color: #fff;
      font-weight: bold;
    }

    .contact-icons {
      display: flex;
      justify-content: center;
      padding: 20px;
    }

    .contact-icons a {
      color: white;
      margin: 0 15px;
      font-size: 30px;
      transition: transform 0.3s ease;
    }

    .contact-icons a:hover {
      transform: scale(1.2);
    }

    /* Footer */
    footer {
      background-color: #001f3f;
      color: white;
      padding: 20px;
      text-align: center;
      font-size: 16px;
      margin-top: 40px;
      border-top: 3px solid #0074D9;
    }

    /* Animations */
    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    @keyframes slideInUp {
      from {
        transform: translateY(100%);
      }
      to {
        transform: translateY(0);
      }
    }
  </style>

  <!-- Icons for social links -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <!-- Inline JavaScript for page navigation -->
  <script>
    function navigateTo(page) {
      // Before navigating, check if the page exists to handle broken links gracefully
      fetch(page, { method: 'HEAD' })
        .then(response => {
          if (response.ok) {
            window.location.href = page;
          } else {
            alert('The page you are trying to access is currently unavailable.');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert('An error occurred while trying to navigate to the page.');
        });
    }
  </script>
</head>

<body>

  <!-- Hero Section -->
  <header class="hero-section">
    <h1>Welcome to Davira Suites</h1>
    <p>Where Luxury Meets Comfort</p>
    <nav>
      <button onclick="navigateTo('login.php')">Login</button>
      <button onclick="navigateTo('services.html')">Our Services</button>
      <button onclick="navigateTo('contact.html')">Contact Us</button>
    </nav>
  </header>

  <!-- Main content area -->
  <main>
    <section class="about-section">
      <h2>About Davira Suites</h2>
      <p>At Davira Suites, we pride ourselves on delivering unparalleled luxury and comfort. Our hotel, located in the vibrant heart of the city, offers state-of-the-art accommodations with modern amenities. Whether you're staying for business or leisure, our experienced team is dedicated to ensuring your experience is nothing short of exceptional.</p>
    </section>

    <section class="services">
      <h2>Explore Our Premium Services</h2>
      <p>From luxury suites to world-class spa treatments, we offer a wide range of services to make your stay unforgettable. Enjoy fine dining, rejuvenating spa therapies, a fully equipped fitness center, and more.</p>
    </section>
  </main>

  <!-- Contact Section -->
  <div class="contact-section">
    <h3>Get In Touch</h3>
    <div class="contact-icons">
      <a href="tel:+1234567890"><i class="fas fa-phone"></i></a>
      <a href="mailto:info@davirasuites.com"><i class="fas fa-envelope"></i></a>
      <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
    </div>
  </div>

  <!-- Footer section -->
  <footer>
    <p>&copy; 2024 Davira Suites - All Rights Reserved</p>
  </footer>

</body>

</html>

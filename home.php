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
    header {
      text-align: center;
      padding: 60px;
      background-color: rgba(0, 0, 0, 0.6);
      animation: fadeIn 2s ease-in;
    }

    header h1 {
      font-size: 55px;
      margin: 0;
      padding-bottom: 10px;
      font-weight: bold;
    }

    header p {
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
    main {
      padding: 40px;
      text-align: center;
      background-color: rgba(0, 0, 0, 0.6);
      margin-top: -40px;
      border-radius: 25px 25px 0 0;
      animation: slideInUp 1.5s ease-in;
    }

    main h2 {
      font-size: 36px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    main p {
      font-size: 18px;
      color: #f0f0f0;
      line-height: 1.8;
      padding: 0 15%;
      animation: fadeIn 2s ease-in-out;
    }

    /* Services section */
    .services {
      background: url('luxury.jpg') no-repeat center/cover;
      padding: 40px;
      color: white;
      background-size: cover;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
      margin: 40px auto;
      max-width: 1000px;
      border-radius: 15px;
      text-align: center;
      animation: zoomIn 1.5s ease-out;
    }

    .services h2 {
      font-size: 36px;
      color: #0074D9;
      font-weight: bold;
    }

    .services p {
      font-size: 18px;
      margin: 10px 0;
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

    @keyframes zoomIn {
      from {
        transform: scale(0.8);
        opacity: 0;
      }
      to {
        transform: scale(1);
        opacity: 1;
      }
    }
  </style>

  <!-- Icons for social links -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>

  <!-- Hero Section -->
  <header>
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
    <h2>About Davira Suites</h2>
    <p>At Davira Suites, we pride ourselves on delivering unparalleled luxury and comfort. Our hotel, located in the vibrant heart of the city, offers state-of-the-art accommodations with modern amenities. Whether you're staying for business or leisure, our experienced team is dedicated to ensuring your experience is nothing short of exceptional.</p>
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
      <a href="https://www.facebook.com"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
      <a href="https://www.twitter.com"><i class="fab fa-twitter"></i></a>
    </div>
  </div>

  <!-- Footer section -->
  <footer>
    <p>&copy; 2024 Davira Suites - All Rights Reserved</p>
  </footer>

  <!-- JavaScript for navigation -->
  <script>
    function navigateTo(page) {
      window.location.href = page;
    }
  </script>

</body>

</html>

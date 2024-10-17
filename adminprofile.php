<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Davis Kunyu">
  <title>Admin Dashboard - Davira Suites</title>

  <!-- External Stylesheets and Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">

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

    .admin-container {
      background-color: white;
      padding: 20px;
      margin: 20px auto;
      width: 60%;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    button {
      padding: 10px 20px;
      background-color: #0074D9;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s, transform 0.2s;
    }

    button:hover {
      background-color: #001f3f;
      transform: scale(1.05);
    }

    .widget-container {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      margin-top: 20px;
    }

    .widget {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 30%;
      margin: 10px;
      text-align: left;
    }

    .widget h3 {
      margin-bottom: 10px;
    }

    .chart {
      width: 100%;
      height: 200px;
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

  <!-- Chart.js for Data Visualization -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Axios for API Calls -->
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

  <header>
    <h1>Admin Dashboard</h1>
  </header>

  <main>
    <div class="admin-container animate__animated animate__fadeIn">
      <h2>Manage Users</h2>
      <button onclick="navigateTo('userlist.html')">View Users</button>
      <h2>Manage Bookings</h2>
      <button onclick="navigateTo('bookings.html')">View Bookings</button>
    </div>

    <!-- Widgets Section -->
    <div class="widget-container">
      <!-- User Analytics Widget -->
      <div class="widget animate__animated animate__fadeInUp">
        <h3><i class="fas fa-chart-bar"></i> User Analytics</h3>
        <canvas id="userChart" class="chart"></canvas>
      </div>

      <!-- Booking Statistics Widget -->
      <div class="widget animate__animated animate__fadeInUp">
        <h3><i class="fas fa-hotel"></i> Booking Statistics</h3>
        <canvas id="bookingChart" class="chart"></canvas>
      </div>

      <!-- AI Chatbot Widget -->
      <div class="widget animate__animated animate__fadeInUp">
        <h3><i class="fas fa-robot"></i> AI Assistant</h3>
        <div id="chatbot">
          <input type="text" id="chatInput" placeholder="Ask me anything..." onkeypress="handleChat(event)">
          <div id="chatResponse"></div>
        </div>
      </div>
    </div>
  </main>

  <!-- JavaScript for Navigation, Widgets, and API Integration -->
  <script>
    function navigateTo(page) {
      window.location.href = page;
    }

    // Sample Data for Charts
    document.addEventListener('DOMContentLoaded', () => {
      // User Analytics Chart
      const userCtx = document.getElementById('userChart').getContext('2d');
      const userChart = new Chart(userCtx, {
        type: 'line',
        data: {
          labels: ['January', 'February', 'March', 'April', 'May'],
          datasets: [{
            label: 'New Users',
            data: [12, 19, 3, 5, 2],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false
        }
      });

      // Booking Statistics Chart
      const bookingCtx = document.getElementById('bookingChart').getContext('2d');
      const bookingChart = new Chart(bookingCtx, {
        type: 'bar',
        data: {
          labels: ['Room A', 'Room B', 'Room C'],
          datasets: [{
            label: 'Bookings',
            data: [5, 10, 3],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
              'rgba(255, 99, 132, 1)',
              'rgba(54, 162, 235, 1)',
              'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false
        }
      });
    });

    // AI Chatbot Functionality
    function handleChat(event) {
      if (event.key === 'Enter') {
        const userInput = document.getElementById('chatInput').value;
        if (userInput) {
          axios.post('https://api.openai.com/v1/engines/davinci-codex/completions', {
            prompt: userInput,
            max_tokens: 50
          }, {
            headers: {
              'Authorization': 'Bearer YOUR_OPENAI_API_KEY'
            }
          }).then(response => {
            const answer = response.data.choices[0].text.trim();
            document.getElementById('chatResponse').innerHTML = `<p>${answer}</p>`;
          }).catch(error => {
            console.error('Error fetching chatbot response:', error);
          });
        }
      }
    }

    // Fetch Data from Admin APIs (Placeholder for Real API Calls)
    function fetchAdminData() {
      axios.get('https://api.example.com/admin/users')
        .then(response => {
          console.log('User Data:', response.data);
        })
        .catch(error => {
          console.error('Error fetching user data:', error);
        });

      axios.get('https://api.example.com/admin/bookings')
        .then(response => {
          console.log('Booking Data:', response.data);
        })
        .catch(error => {
          console.error('Error fetching booking data:', error);
        });
    }

    // Call API fetch function on page load
    window.onload = fetchAdminData;
  </script>
</body>
</html>

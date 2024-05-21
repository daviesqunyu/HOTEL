function toggleDropdown() {
  var dropdownContent = document.getElementById("dropdownContent");
  if (dropdownContent.style.display === "block") {
    dropdownContent.style.display = "none";
  } else {
    dropdownContent.style.display = "block";
  }
}

function navigateTo(page) {
  // Add your navigation logic here
  console.log("Navigating to " + page);
  // Example: window.location.href = page + ".html";
}

document.addEventListener('DOMContentLoaded', () => {
  const roadStatus = document.getElementById('roadStatus');
  const pedestrianStatus = document.getElementById('pedestrianStatus');
  const carStatus = document.getElementById('carStatus');

  const roadStatusEndpoint = 'https://api.example.com/roadStatus';
  const pedestrianStatusEndpoint = 'https://api.example.com/pedestrianStatus';
  const carStatusEndpoint = 'https://api.example.com/carStatus';
  const apiKey = 'your_api_key';

  // Function to fetch and update road status
  function fetchRoadStatus() {
      fetch(`${roadStatusEndpoint}?api_key=${apiKey}`)
          .then(response => response.json())
          .then(data => {
              roadStatus.textContent = `Road Status: ${data.status}`;
          })
          .catch(error => {
              roadStatus.textContent = 'Road Status: Error fetching data';
              console.error('Error fetching road status:', error);
          });
  }

  // Function to fetch and update pedestrian status
  function fetchPedestrianStatus() {
      fetch(`${pedestrianStatusEndpoint}?api_key=${apiKey}`)
          .then(response => response.json())
          .then(data => {
              pedestrianStatus.textContent = `Pedestrian Status: ${data.status}`;
          })
          .catch(error => {
              pedestrianStatus.textContent = 'Pedestrian Status: Error fetching data';
              console.error('Error fetching pedestrian status:', error);
          });
  }

  // Function to fetch and update car status
  function fetchCarStatus() {
      fetch(`${carStatusEndpoint}?api_key=${apiKey}`)
          .then(response => response.json())
          .then(data => {
              carStatus.textContent = `Car Status: ${data.status}`;
          })
          .catch(error => {
              carStatus.textContent = 'Car Status: Error fetching data';
              console.error('Error fetching car status:', error);
          });
  }

  // Function to update all statuses
  function updateStatus() {
      fetchRoadStatus();
      fetchPedestrianStatus();
      fetchCarStatus();
  }

  // Initially load the traffic data
  updateStatus();

  // Refresh traffic data every 60 seconds
  setInterval(updateStatus, 60000);
});

document.addEventListener('DOMContentLoaded', () => {
  // Simulated data (replace with actual data fetching logic)
  const vehicleCount = 150;
  const pedestrianCount = 50;
  const heavyTrafficRoads = ['Mombasa Road', 'Uhuru Highway'];
  const preferredRoute = 'Waiyaki Way';
  const weatherCondition = 'Sunny';
  const roadCondition = 'Good';
  const speedLimit = '50 km/h';

  // Update numeric data
  document.getElementById('vehicleCount').innerText = vehicleCount;
  document.getElementById('pedestrianCount').innerText = pedestrianCount;
  document.getElementById('heavyTrafficRoads').innerText = heavyTrafficRoads.join(', ');
  document.getElementById('preferredRoute').innerText = preferredRoute;
  document.getElementById('weatherCondition').innerText = weatherCondition;
  document.getElementById('roadCondition').innerText = roadCondition;
  document.getElementById('speedLimit').innerText = speedLimit;

  // Generate visual representation (for demonstration purposes)
  const visualRepresentation = document.getElementById('visualRepresentation');
  visualRepresentation.innerHTML = `
      <img src="map.png" alt="Nairobi CBD Map">
      <!-- Add additional HTML/CSS/JS to generate visual representation -->
  `;
});

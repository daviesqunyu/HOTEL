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

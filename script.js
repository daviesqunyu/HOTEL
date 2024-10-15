const loginBtn = document.getElementById('loginBtn');
const signupBtn = document.getElementById('signupBtn');
const container = document.querySelector('.container');

// Toggle Login and Sign-Up
loginBtn.addEventListener('click', () => {
  container.classList.remove('right-panel-active');
});

signupBtn.addEventListener('click', () => {
  container.classList.add('right-panel-active');
});

document.addEventListener('DOMContentLoaded', function() {
  document.getElementById('signupForm').addEventListener('submit', function(event) {
      event.preventDefault();
      clearErrors();
    
      var username = document.getElementById('username').value.trim();
      var email = document.getElementById('email').value.trim();
      var password = document.getElementById('password').value.trim();
    
      var isValid = true;
    
      if (username === '') {
          isValid = false;
          document.getElementById('usernameError').innerText = 'Username is required.';
      }
    
      if (email === '') {
          isValid = false;
          document.getElementById('emailError').innerText = 'Email is required.';
      } else if (!isValidEmail(email)) {
          isValid = false;
          document.getElementById('emailError').innerText = 'Invalid email format.';
      }
    
      if (password === '') {
          isValid = false;
          document.getElementById('passwordError').innerText = 'Password is required.';
      } else if (password.length < 6) {
          isValid = false;
          document.getElementById('passwordError').innerText = 'Password must be at least 6 characters.';
      }
    
      if (isValid) {
          // Here you can send the form data to your backend for further processing
          alert('Signup successful!');
          // Optionally, redirect to a login page or dashboard
      }
  });
});

function clearErrors() {
  var errors = document.getElementsByClassName('error');
  for (var i = 0; i < errors.length; i++) {
      errors[i].innerText = '';
  }
}

function isValidEmail(email) {
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

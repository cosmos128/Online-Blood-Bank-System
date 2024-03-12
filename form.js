  function displayFileName() {
        const fileInput = document.getElementById("customFileInput");
        const fileNameDisplay = document.getElementById("fileName");

        if (fileInput.files.length > 0) {
          fileNameDisplay.textContent = `Selected File: ${fileInput.files[0].name}`;
        } else {
          fileNameDisplay.textContent = "";
        }
      }
       function validateForm() {
      // Clear previous errors
      clearErrors();

      // Get form values
      var fullName = document.getElementById('fullName').value;
      var mobileNumber = document.getElementById('mobileNumber').value;
      var age = document.getElementById('age').value;
      var address = document.getElementById('address').value;
      var bloodType = document.getElementById('bloodType').value;
      var image = document.getElementById('image').value;

      // Validate full name (only letters and spaces)
      if (!/^[a-zA-Z\s]+$/.test(fullName)) {
        document.getElementById('fullNameError').innerHTML = 'Invalid full name';
        return;
      }

      // Validate mobile number (10 digits)
      if (!/^\d{10}$/.test(mobileNumber)) {
        document.getElementById('mobileNumberError').innerHTML = 'Invalid mobile number';
        return;
      }

      // Validate age (must be 18 or older)
      if (age < 0) {
        document.getElementById('ageError').innerHTML = 'Age must be 1 or older';
        return;
      }

      // Validate address (non-empty)
      if (address.trim() === '') {
        document.getElementById('addressError').innerHTML = 'Address cannot be empty';
        return;
      }

      // Validate blood type (not the default value)
      if (bloodType === '') {
        document.getElementById('bloodTypeError').innerHTML = 'Please select a blood type';
        return;
      }

      // Validate image (not empty)
      if (image === '') {
        document.getElementById('imageError').innerHTML = 'Please upload an image';
        return;
      }

      // If all validations pass, submit the form
      alert('Form submitted successfully!');
    }

    function clearErrors() {
      // Clear all error messages
      var errorElements = document.getElementsByClassName('error');
      for (var i = 0; i < errorElements.length; i++) {
        errorElements[i].innerHTML = '';
      }
    }
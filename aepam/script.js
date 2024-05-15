document.getElementById('enrollment-form').addEventListener('submit', function(event) {
    event.preventDefault();
  
    // Get form data
    var schoolId = document.getElementById('school-id').value;
    var studentName = document.getElementById('student-name').value;
    var studentRoll = document.getElementById('student-roll').value;
    var classValue = document.getElementById('class').value;
    var section = document.getElementById('section').value;
  
    // Validate form data
    if (schoolId.trim() === '' || studentName.trim() === '' || studentRoll.trim() === '') {
      alert('Please fill in all required fields.');
      return;
    }
  
    // Prepare data for submission
    var formData = {
      school_id: schoolId,
      student_name: studentName,
      student_roll: studentRoll,
      class: classValue,
      section: section
    };
  
    // Send data to server using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'submit-enrollment.php', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        alert('Enrollment submitted successfully!');
        // Reset the form
        document.getElementById('enrollment-form').reset();
      } else {
        alert('Error submitting enrollment. Please try again later.');
      }
    };
    xhr.send(JSON.stringify(formData));
  });
  
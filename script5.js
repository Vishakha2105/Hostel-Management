document.getElementById('login-toggle').addEventListener('click', function() {
    document.getElementById('login-form').classList.add('active');
    document.getElementById('signup-form').classList.remove('active');
    this.classList.add('active');
    document.getElementById('signup-toggle').classList.remove('active');
});

document.getElementById('signup-toggle').addEventListener('click', function() {
    document.getElementById('signup-form').classList.add('active');
    document.getElementById('login-form').classList.remove('active');
    this.classList.add('active');
    document.getElementById('login-toggle').classList.remove('active');
});

document.getElementById('login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    window.location.href = "form3.html";

    // Implement login validation here
    // For example, check if the username and password are correct
    // Show an error message if the login is unsuccessful
});

document.getElementById('signup-form').addEventListener('submit', function(event) {
    event.preventDefault();
    // Implement sign-up validation here
    // Check if the username is unique and meets password requirements
    // Create the user account if validation is successful
    // Show an error message if sign-up fails
});



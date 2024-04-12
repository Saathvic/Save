// Get the modal elements
var loginModal = document.getElementById("loginModal");
var signupModal = document.getElementById("signupModal");

// Get the buttons that open the modals
var loginBtn = document.getElementById("loginBtn");
var signupBtn = document.getElementById("signupBtn");

// Get the <span> elements that close the modals
var closeBtns = document.getElementsByClassName("close");

// When the user clicks on the button, open the modal
loginBtn.onclick = function() {
    loginModal.style.display = "block";
}

signupBtn.onclick = function() {
    signupModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
for (var i = 0; i < closeBtns.length; i++) {
    closeBtns[i].onclick = function() {
        loginModal.style.display = "none";
        signupModal.style.display = "none";
    }
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == loginModal) {
        loginModal.style.display = "none";
    }
    if (event.target == signupModal) {
        signupModal.style.display = "none";
    }
}

// Dummy login and logout functionality
var loginForm = document.getElementById("loginForm");
var dashboardBtn = document.getElementById("dashboardBtn");
var logoutBtn = document.getElementById("logoutBtn");

loginForm.onsubmit = function(event) {
    event.preventDefault();
    // Dummy authentication logic
    var username = loginForm.querySelector('input[type="text"]').value;
    var password = loginForm.querySelector('input[type="password"]').value;
    if (username === "user" && password === "password") {
        // Successful login
        alert("Login successful!");
        loginModal.style.display = "none";
        loginBtn.style.display = "none";
        signupBtn.style.display = "none";
        dashboardBtn.style.display = "inline";
        logoutBtn.style.display = "inline";
    } else {
        // Failed login
        alert("Invalid username or password. Please try again.");
    }
}

logoutBtn.onclick = function() {
    // Dummy logout functionality
    loginBtn.style.display = "inline";
    signupBtn.style.display = "inline";
    dashboardBtn.style.display = "none";
    logoutBtn.style.display = "none";
    alert("Logout successful!");
}

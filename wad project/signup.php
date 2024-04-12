<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    // Perform basic validation
    if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($phone) || empty($address) || empty($city) || empty($state) || empty($zip)) {
        echo '<div class="alert alert-danger">Please fill in all fields.</div>';
    } else {
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="alert alert-danger">Invalid email format.</div>';
        } else {
            // Connect to your database using PHPMyAdmin credentials
            $servername = "localhost"; // Change this if your PHPMyAdmin is hosted elsewhere
            $username = "root"; // Change this to your PHPMyAdmin username
            $password_db = ""; // Change this to your PHPMyAdmin password
            $dbname = "signup"; // Change this to your database name

            // Create connection
            $conn = new mysqli($servername, $username, $password_db, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Prepare and bind SQL statement to insert data into a users table (replace users with your table name)
            $stmt = $conn->prepare("INSERT INTO user_details (firstName, lastName, email, password, phone, address, city, state, zip) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssssss", $firstName, $lastName, $email, $password, $phone, $address, $city, $state, $zip);

            // Execute the statement
            if ($stmt->execute()) {
                echo '<div class="alert alert-success">Signup successful. You can now login.</div>';
            } else {
                echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
            }

            // Close statement and database connection
            $stmt->close();
            $conn->close();
        }
    }
}
?>

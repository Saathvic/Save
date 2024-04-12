<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $college = $_POST['college'];
    $department = $_POST['department'];
    $year = $_POST['year'];
    $courseName = $_POST['course_name'];

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

    // Prepare and bind SQL statement to insert data into course_details table
    $stmt = $conn->prepare("INSERT INTO course_detail (name, dob, gender, college, department, year, course_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $dob, $gender, $college, $department, $year, $courseName);

    // Execute the statement
    if ($stmt->execute()) {
        echo '<div class="alert alert-success">Course enrollment successful. You can check dashboard.</div>';
    } else {
        echo '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>

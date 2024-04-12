<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are present
    if (isset($_POST['cid']) && isset($_POST['newName']) && isset($_POST['newCollege']) && isset($_POST['newDepartment']) && isset($_POST['newYear'])) {
        // Retrieve form data
        $cid = $_POST['cid'];
        $newName = $_POST['newName'];
        $newCollege = $_POST['newCollege'];
        $newDepartment = $_POST['newDepartment'];
        $newYear = $_POST['newYear'];

        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "signup");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare and bind the UPDATE statement
        $stmt = $conn->prepare("UPDATE course_detail SET name=?, college=?, department=?, year=? WHERE cid=?");
        $stmt->bind_param("ssssi", $newName, $newCollege, $newDepartment, $newYear, $cid);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Course details updated successfully.";
        } else {
            echo "Error updating course details: " . $stmt->error;
        }

        // Close statement and connection
        $stmt->close();
        mysqli_close($conn);
    } else {
        echo "All form fields are required.";
    }
} else {
    echo "Form not submitted.";
}
?>

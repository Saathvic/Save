<?php
// Check if the course ID is provided in the URL
if(isset($_GET['cid'])) {
    $cid = $_GET['cid'];

    // Delete the course from the database using the course ID
    $conn = mysqli_connect("localhost", "root", "", "signup");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "DELETE FROM course_detail WHERE cid='$cid'";
    if (mysqli_query($conn, $sql)) {
        echo "Course removed successfully.";
    } else {
        echo "Error removing course: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Course ID not provided.";
}
?>

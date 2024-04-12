<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Edit Course</h1>
    <?php
    // Check if the course name is provided in the URL
    if(isset($_GET['name'])) {
        $courseName = $_GET['name'];
        // Fetch the course details from the database using the course name
        $conn = mysqli_connect("localhost", "root", "", "signup");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM course_details WHERE course_name='$courseName'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Display the form with course details for editing
            ?>
            <form action="update_course.php" method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>">
                </div>
                <div class="form-group">
                    <label for="college">College</label>
                    <input type="text" class="form-control" id="college" name="college" value="<?php echo $row['college']; ?>">
                </div>
                <div class="form-group">
                    <label for="department">Department</label>
                    <input type="text" class="form-control" id="department" name="department" value="<?php echo $row['department']; ?>">
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="text" class="form-control" id="year" name="year" value="<?php echo $row['year']; ?>">
                </div>
                <input type="hidden" name="courseName" value="<?php echo $courseName; ?>">
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            <?php
        } else {
            echo "Course not found.";
        }
        mysqli_close($conn);
    } else {
        echo "Course name not provided.";
    }
    ?>
</div>

</body>
</html>

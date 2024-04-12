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
    // Check if the course ID is provided in the URL
    if(isset($_GET['cid'])) {
        $cid = $_GET['cid'];

        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "signup");

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare and bind the SELECT statement
        $stmt = $conn->prepare("SELECT name, college, department, year FROM course_detail WHERE cid = ?");
        $stmt->bind_param("i", $cid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $oldName = $row['name'];
            $oldCollege = $row['college'];
            $oldDepartment = $row['department'];
            $oldYear = $row['year'];

            // Display the form with the course details for editing
            ?>
            <form action="edit_course.php" method="POST">
                <div class="form-group">
                    <label for="cid">Course ID</label>
                    <input type="text" class="form-control" id="cid" name="cid" value="<?php echo $cid; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="newName">New Name</label>
                    <input type="text" class="form-control" id="newName" name="newName" value="<?php echo $oldName; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newCollege">New College</label>
                    <input type="text" class="form-control" id="newCollege" name="newCollege" value="<?php echo $oldCollege; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newDepartment">New Department</label>
                    <input type="text" class="form-control" id="newDepartment" name="newDepartment" value="<?php echo $oldDepartment; ?>" required>
                </div>
                <div class="form-group">
                    <label for="newYear">New Year</label>
                    <input type="text" class="form-control" id="newYear" name="newYear" value="<?php echo $oldYear; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
            <?php
        } else {
            echo "No course details found.";
        }

        // Close statement and connection
        $stmt->close();
        mysqli_close($conn);
    } else {
        echo "Course ID not provided.";
    }
    ?>
</div>

</body>
</html>

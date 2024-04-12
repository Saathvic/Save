<!DOCTYPE html>
<html>
<head>
    <title>Display Course Details</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Reset CSS */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        header {
            background: #333;
            color: #fff;
            padding: 20px 0;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        nav ul {
            list-style-type: none;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Online Course Enrollment</a>
            <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div
                    class="collapse navbar-collapse justify-content-between"
                    id="navbarNav"
            >
                <div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="main.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="courses.html">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="aboutus.html">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php" id="dashboardBtn">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php" id="loginBtn">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="signup.html" id="signupBtn">Sign Up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.html" id="logoutBtn" style="display: none">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>

<div class="container">
    <h1>Course Details</h1>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
        <tr>
            <th>Course Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        <?php
        // Establish a connection to MySQL
        $conn = mysqli_connect("localhost", "root", "", "signup");

        // Check if the connection is successful
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // SQL query to fetch data from course_details table
        $sql = "SELECT cid, course_name FROM course_detail";
        $result = mysqli_query($conn, $sql);

        // Check if any data is returned
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['course_name'] . "</td>";
                echo "<td>";
                echo "<form action='edit_course_form.php' method='GET' style='display:inline'>";
                echo "<input type='hidden' name='cid' value='" . $row['cid'] . "'>";
                echo "<button type='submit' class='btn btn-primary btn-sm mr-2'><i class='fas fa-edit'></i> Edit</button>";
                echo "</form>";
                echo "<form action='remove_course.php' method='GET' style='display:inline'>";
                echo "<input type='hidden' name='cid' value='" . $row['cid'] . "'>";
                echo "<button type='submit' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i> Remove</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>0 results</td></tr>";
        }

        // Close the connection
        mysqli_close($conn);
        ?>
        </tbody>
    </table>
</div>

</body>
</html>

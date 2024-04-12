<?php
session_start(); // Start the session to store user data

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Connect to MySQL database
    $servername = "localhost";
    $username = "root"; // Change to your MySQL username
    $password = ""; // Change to your MySQL password
    $dbname = "signup"; // Change to your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }

    // Prepare data for insertion
    $email = $_POST['email'];
    $user_password = $_POST['password']; // Changed variable name to avoid conflict

    // SQL query to verify credentials (Note: Use prepared statements to prevent SQL injection)
    $stmt = $conn->prepare("SELECT * FROM user_details WHERE email=? AND password=?");
    $stmt->bind_param("ss", $email, $user_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Set session variables to store user data
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $row['username']; // Assuming 'username' is a field in your database
        $_SESSION['loggedin'] = true;

        // Redirect to main page after successful login
        header("Location: main.html");
        exit(); // Stop further execution
    } else {
        $message = "Invalid email or password";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Online Course Enrollment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #343a40; /* Dark background color */
            color: #fff; /* Light text color */
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }
        .container {
            width: 300px; /* Adjust width as needed */
            margin: auto;
            text-align: center;
            background-color: #495057; /* Darker container background color */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .error-message {
            color: red;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            background-color: #f8f9fa; /* Lighter input background color */
            color: #495057; /* Darker text color */
        }
        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus {
            outline: none;
            border-color: #007bff; /* Focus border color */
        }
        input[type="submit"] {
            background-color: #007bff; /* Primary button color */
            color: #fff; /* Light text color */
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3; /* Darker primary button color on hover */
        }
        .signup-link {
            color: #fff; /* Light text color */
        }
        .signup-link:hover {
            color: #007bff; /* Primary link color on hover */
        }
    </style>
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>

    <div class="container">
        <?php if (!empty($message)):?>
            <div class="error-message"><?php echo htmlspecialchars($message);?></div>
        <?php endif;?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" placeholder="Enter your email" required><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" placeholder="Enter your password" required><br><br>
            <input type="submit" name="submit" value="Login">
        </form>
        <p class="signup-link">Don't have an account? <a href="signup.html">Sign up here</a></p>
    </div>

    <footer style="text-align: center; padding: 10px;">
        <p>&copy; 2024 Online Course Enrollment. All rights reserved.</p>
    </footer>
</body>
</html>

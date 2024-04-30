<?php
// Database credentials
$hostname = "localhost";
$username = "root";
$password = "";
$database = "handcraft_business_consulting_system";

// Creating connection
$connection = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving form data
    $fname  = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $telephone = $_POST['telephone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $activation_code = $_POST['activation_code'];
    
    // Prepare and bind SQL statement
    $stmt = $connection->prepare("INSERT INTO user (firstname, lastname, email, username, password, telephone, activation_code) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fname, $lname, $email, $username, $password, $telephone, $activation_code);

    // Execute SQL statement
    if ($stmt->execute()) {
        // Redirecting to login page on successful registration
        header("Location: login.html");
        exit();
    } else {
        // Displaying error message if query execution fails
        echo "Error: Registration failed. Please try again later.";
    }

    // Close statement
    $stmt->close();
}

// Closing database connection
$connection->close();
?>

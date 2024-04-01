<?php
// Database connection details
$host = 'sql6.freesqldatabase.com';
$dbname = 'sql6695602';
$user = 'sql6695602';
$password = 'your-password-here';

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user's email and password from form
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare statement to select user by email and password
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
  // User exists, redirect to welcome page
  header('Location: welcome.php');
} else {
  // User not found, display error message
  echo "Invalid email or password";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
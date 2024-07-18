<?php
$email = $_POST['email'];
$contact = $_POST['contact'];
$password = $_POST['password'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'login1');
if ($conn->connect_error) {
    die("Connection Failed : " . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO admin (email, contact, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $contact, $password);
    $execval = $stmt->execute();
    echo $execval;
    echo "Registration successful!";
    $stmt->close();
    $conn->close();
}
?>

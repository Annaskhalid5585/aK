<?php
// Database connection details
$host = "localhost";
$username = "root";
$password = "admin";
$database = "aepam";
// $database = "school_enrollment";

// Create connection
$conn = new mysqli($host, $username, $password, $database, "3308");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $School_id = isset($_POST['School_id']) ? trim($_POST['School_id']) : null;
    $Student_name = isset($_POST['Student_name']) ? trim($_POST['Student_name']) : null;
    $Student_roll = isset($_POST['Student_roll']) ? trim($_POST['Student_roll']) : null;
    $Class = isset($_POST['Class']) ? trim($_POST['Class']) : null;
    $Section = isset($_POST['Section']) ? trim($_POST['Section']) : null;

    // Validate form data
    if (empty($School_id) || empty($Student_name) || empty($Student_roll)) {
        die("Error: Please fill in all required fields.");
    }

    // Prepare and execute SQL query
    $stmt = $conn->prepare("INSERT INTO school_enrollment(School_id, Student_name, Student_roll, Class, Section) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $School_id, $Student_name, $Student_roll, $Class, $Section);

    if ($stmt->execute()) {
        echo "Enrollment submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Form data not submitted.";
}

$conn->close();
?>

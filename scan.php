<?php
include('connection.php');  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve input values from POST
    $name = $_POST['name'];
    $student_id = $_POST['student-id'];
    $payment_purpose = $_POST['payment-purpose'];
    $request_purpose = $_POST['request-purpose'];
    
    // Validate inputs (optional but recommended)
    if (empty($name) || empty($student_id) || empty($payment_purpose) || empty($request_purpose)) {
        echo "<script>alert('All fields are required!');</script>";
        exit;
    }

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO info (name, studentNumber, payment, request) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ssss", $name, $student_id, $payment_purpose, $request_purpose);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Registration successful!');</script>";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

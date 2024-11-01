<?php
// Include database connection
include 'db.php';

// Function to update registration count
function updateRegistrationCount($conn) {
    // Check if the registration count record exists
    $checkCount = "SELECT * FROM user_registration_counts LIMIT 1";
    $result = $conn->query($checkCount);
    
    if ($result->num_rows > 0) {
        // Increment the count by 1
        $updateCountSql = "UPDATE user_registration_counts SET total_users = total_users + 1 WHERE id = 1";
        if (!$conn->query($updateCountSql)) {
            echo "Error updating registration count: " . $conn->error;
        }
    } else {
        // Insert the initial count if the row does not exist
        $insertCountSql = "INSERT INTO user_registration_counts (total_users) VALUES (1)";
        if (!$conn->query($insertCountSql)) {
            echo "Error inserting registration count: " . $conn->error;
        }
    }
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $full_name = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // Insert data into the users table
    $sql = "INSERT INTO users (full_name, email, username, password) VALUES ('$full_name', '$email', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful
        updateRegistrationCount($conn); // Call function to update the count

        echo "Registration successful!";
        // Redirect to login-user.php
        header("Location: login-user.php");
        exit();
    } else {
        // Handle registration error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>

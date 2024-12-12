<?php
// Include database connection
include('setup.php');

// Update each user password to a hashed version
$users = [
    ['user_id' => 1, 'password' => 'password123'],
    ['user_id' => 2, 'password' => 'securepass'],
    ['user_id' => 3, 'password' => 'mypassword'],
    ['user_id' => 4, 'password' => 'passw0rd'],
    ['user_id' => 5, 'password' => 'adminpass']
];

foreach ($users as $user) {
    $hashed_password = password_hash($user['password'], PASSWORD_DEFAULT);

    // Update the password in the database
    $sql = "UPDATE Users SET password = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $hashed_password, $user['user_id']);

    if ($stmt->execute()) {
        echo "Password for user ID {$user['user_id']} updated successfully.<br>";
    } else {
        echo "Error updating password for user ID {$user['user_id']}: " . $stmt->error . "<br>";
    }
}

$stmt->close();
$conn->close();
?>

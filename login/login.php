<?php
session_start();
include('config.php');

if (isset($_POST['username']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $un = validate($_POST['username']);
    $pw = validate($_POST['password']);

    $query = "SELECT * FROM userAccount WHERE userName='$un' AND password='$pw'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (($row['userName'] == $un) && ($row['password'] == $pw)) {
            $_SESSION['userName'] = $row['userName'];
            $_SESSION['userID'] = $row['userID'];
            echo "<script>alert('Logged in!');</script>";
            echo "<script>window.location.href = '../index.html';</script>"; // Redirect to the homepage after successful login
            exit();
        } else {
            echo "<script>alert('Incorrect username or password.');</script>";
            echo "<script>window.location.href = 'index.html';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Incorrect username or password.');</script>";
        echo "<script>window.location.href = 'index.html';</script>";
        exit();
    }
} else {
    echo "<script>window.location.href = 'index.html';</script>";
    exit();
}
?>

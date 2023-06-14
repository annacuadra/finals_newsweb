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
    $ps = validate($_POST['password']);

    $query = "SELECT * FROM userAccount WHERE userName='$un' AND password='$ps'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['userName'] = $un;
        $_SESSION['password'] = $ps;
        echo "<script>alert('Successfully logged in!');</script>";
        echo "<script>window.location.href = '../index.html';</script>"; // Redirect to the homepage after successful login
        exit();
    } else {
        echo "<script>alert('Incorrect username or password.');</script>";
        echo "<script>window.location.href = 'index.html';</script>";
    }
}
?>

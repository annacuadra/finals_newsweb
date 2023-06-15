<?php
    require('config.php');

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $un = mysqli_real_escape_string($conn, $_POST['username']);
        $ps = mysqli_real_escape_string($conn, $_POST['password']);

        //CRUD OPERATION (READ)
        $query = "SELECT * FROM userAccount WHERE userName='$un' AND password='$ps'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);

        //IF ELSE CONDITION
        if ($count == 1) {
            $_SESSION['userName'] = $un;
            $_SESSION['password'] = $ps;
            echo "<script>alert('Successfully logged in!');</script>";
            echo "<script>window.location.href = '../index.html';</script>";
            exit();
        } else {
            echo "<script>alert('Incorrect username or password.');</script>";
            echo "<script>window.location.href = '../logpage.html';</script>";
        }
    }
?>

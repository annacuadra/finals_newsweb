<?php
    require('config.php');

    if (isset($_POST['email'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        
        //CRUD OPERATION (READ)
        $query = "SELECT * FROM userAccount WHERE emailAdd='$email'";
        $result = mysqli_query($conn, $query);
        $count = mysqli_num_rows($result);

        //IF ELSE CONDITION
        if ($count == 1) {
            $_SESSION['emailAdd'] = $email;
            echo "<script>alert('Successfully sent email into your account!');</script>";
            echo "<script>window.location.href = '../reset_pass.html';</script>";
            exit();
        } else {
            echo "<script>alert('No account existing!');</script>";
            echo "<script>window.location.href = '../forgot_pass.html';</script>";
        }
    }
?>

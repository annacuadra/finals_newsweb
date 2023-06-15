<?php
    require('config.php');

    if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cps = mysqli_real_escape_string($conn, $_POST['c_password']);

        //CRUD OPERATION (INSERT)
        $query = "INSERT INTO userAccount (emailAdd, userName, password)
                  VALUES ('$email', '$username', '$password')";
        $query2 = "SELECT * FROM userAccount WHERE emailAdd='$email'";
        $result = mysqli_query($conn, $query2);
        $count = mysqli_num_rows($result);

        //IF ELSE CONDITION
        if ($count == 1) {
            echo "<script>alert('The email has already been used.');</script>";
            echo "<script>window.location.href = '../register.html';</script>";
        } else {
            if(!($password == $cps)){
                echo "<script>alert('The passwords do not match!');</script>";
                echo "<script>window.location.href = '../register.html';</script>";
            } else {if(mysqli_query($conn, $query)){
                    echo "<script>alert('Successfully registered!');</script>";
                    echo "<script>window.location.href = '../logpage.html';</script>";
                }else{
                    echo "<script>alert('ERROR!');</script>";
                    echo "<script>window.location.href = '../register.html';</script>";
                }
            }
        }
       
    }
?>

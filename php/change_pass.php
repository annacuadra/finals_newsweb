<?php
    require('config.php');

    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $ps = mysqli_real_escape_string($conn, $_POST['password']);
        $cps = mysqli_real_escape_string($conn, $_POST['c_password']);

        // CRUD OPERATION (READ + UPDATE)
        $query1 = "SELECT * FROM userAccount WHERE emailAdd='$email'";    
        $query2 = "SELECT * FROM userAccount WHERE password='$ps'";    
        $query3 = "UPDATE userAccount SET password = '$ps' WHERE emailAdd='$email'";
        $result1 = mysqli_query($conn, $query1);
        $result2 = mysqli_query($conn, $query2);
        $count = mysqli_num_rows($result1);
        $count2 = mysqli_num_rows($result2);

        //IF ELSE CONDITION
        if(!($cps == $ps)){
            echo "<script>alert('The passwords do not match!');</script>";
            echo "<script>window.location.href = '../reset_pass.html';</script>";
        } else {
        //SWITCH
            switch ($count) {
                case 1:
                    if ($count2 == 1) {
                        echo "<script>alert('Same as the old password!');</script>";
                        echo "<script>window.location.href = '../reset_pass.html';</script>";
                        exit();
                    } else if(mysqli_query($conn, $query3)){
                        echo "<script>alert('Successfully changed!');</script>";
                        echo "<script>window.location.href = '../logpage.html';</script>";
                    }
                    break;
        
                default:
                    echo "<script>alert('No account existing!');</script>";
                    echo "<script>window.location.href = '../reset_pass.html';</script>";
                    break;
            }
        }
    }
?>

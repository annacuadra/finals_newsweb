<?php
    define('ROOT_URL', '');
    define('DB_HOST', 'sql12.freesqldatabase.com');
    define('DB_USER', 'sql12625359');
    define('DB_PASS', 'tMbricvV8P');
    define('DB_NAME', 'sql12625359');
    
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if(mysqli_connect_errno()){
        echo 'Failed to connect to MySQL'.mysqli_connect_errno();
    }
<?php
        $host = "localhost:3306";
        $user = "root";
        $password = "Oracledj+2017";
        $dbname = "btc";
        $connect = mysqli_connect($host, $user, $password, $dbname);
        if(mysqli_connect_errno()){
            die("Database connection failed: ".
            mysqli_connect_error() . 
            " (" . mysqli_connect_errno(). ")"
            );
        }
?>

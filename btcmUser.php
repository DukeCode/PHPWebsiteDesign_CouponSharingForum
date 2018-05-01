<?php
    session_start(); // session started
    require 'dbConnection.php';
    require 'securityCheck.php';
    date_default_timezone_set('America/New_York'); // set default timezone

    // enhanced security check
    if (isset($_SESSION)) {
        $username = escapeSQL($connect, $_SESSION['username']);
        $password = escapeSQL($connect, $_SESSION['password']);
        $userId = $_SESSION['userId'];
        $query = 'SELECT userId FROM btcUser WHERE userName=' . "'" . $username . "' AND password='" . $password . "'";
        $result = mysqli_query($connect, $query);
        if (!$result) {
            die("Database failed");
        }
        $row = mysqli_fetch_row($result);
        if ($row[0] >= 1) {
            $success = true;
        }
        mysqli_free_result($result); // release variable
    }
    require 'btcmHeader.php';
?>


       
<?php
    mysqli_close($connect); // close connection
    include 'btcFooter.php';
?>

<?php
    session_start(); // session started
    require 'dbConnection.php';
    require 'securityCheck.php';
    if ($_POST) {
        if (!preg_match($usernamePattern, $_POST['username'])) {
            $check = false;
        } else if (!preg_match($passwordPattern, $_POST['password'])) {
            $check = false;
        } else if (!normalLength($_POST['username'], $maxUsernameLength)) {
            $check = false;
        } else if (!normalLength($_POST['password'], $maxPasswordLength)) {
            $check = false;
        } else if (!has_presence($_POST['username']) || !has_presence($_POST['password'])) {
            $check = false;
        } else {
            $check = true;
        }
    }
    if ($_POST && $check) {
        $username = escapeSQL($connect, $_POST['username']);
        $password = escapeSQL($connect, $_POST['password']);
        $query = 'SELECT userId FROM btcUser WHERE userName=' . "'" . $username . "' AND password='" . $password . "'";
        $result = mysqli_query($connect, $query);
        if (!$result) {
            die("Database failed");
        }
        $row = mysqli_fetch_row($result);
        if ($row[0] >= 1) {
            $success = true;
            $_SESSION['userId'] = $row[0]; //store userID in session
            $_SESSION['username'] = $username; //store user name in session
            $_SESSION['password'] = $password; //store password in session
        }
        mysqli_free_result($result); // release variable
    }
    if ($success) {
        require 'btcmHeader.php';
?>
        <div class="container mainContent">
            <div class="row">
                <div class="col-xs-12">
                    <h4 id="welcomeMessage"><span class="glyphicon glyphicon-king" aria-hidden="true"></span> Good to see you again, <?php echo "$username"; ?>! Click <a href="btcHome.php">here</a> to homepage.</h4>
                </div>
            </div>
        </div>         
<?php
    } else if ($_POST) {
        require 'btcHeader.php';
?>
        <div class="container mainContent">
            <div class="row">
                <div class="col-xs-12">
                    <h4><span class="glyphicon glyphicon-king" aria-hidden="true"></span> Username or Password is not correct. Login process failed, please try again.</h4>
                </div>
            </div>
        </div>
<?php 
    } else {
        require 'btcHeader.php';
        require 'btcPage.php';
    }
    mysqli_close($connect); // close connection
    include 'btcFooter.php';
?>

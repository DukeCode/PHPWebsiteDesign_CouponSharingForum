<?php
    session_start(); // session started
    require 'dbConnection.php';
    require 'securityCheck.php';
    date_default_timezone_set('America/New_York'); // set default timezone

    // post request handler
    // (1) handle request of creating post
    // sanitize and security procedure
    if ($_POST && $_POST['label'] == "") {
        if (!has_presence($_POST['subject']) || !has_presence($_POST['message'])) {
            $checkPost = false;
        } else if (!normalLength($_POST['subject'], $maxSubjectLength)) {
            $checkPost = false;
        } else if (!normalLength($_POST['message'], $maxMessageLength)) {
            $checkPost = false;
        } else {
            $checkPost = true;
        }
        // insert into database
        if ($checkPost) {
            $subject = escapeSQL($connect, $_POST['subject']);
            $message = escapeSQL($connect, $_POST['message']);
            $time = $_POST['time'];
            $userId = $_POST['userId'];
            $category = $_POST['category'];
            $brand = $_POST['brand'];
            $query10 = 'SELECT categoryId FROM btcCategory C WHERE C.categoryName =' . "'" . $category . "'";
            $result10 = mysqli_query($connect, $query10);
            if (!$result10) {
                die("Database failed");
            }
            $row10 = mysqli_fetch_row($result10);
            $categoryId = $row10[0];
            mysqli_free_result($result10); // release variable

            $queryBrandId = 'SELECT brandId FROM btcBrand C WHERE C.brandName =' . "'" . $brand . "'";
            $resultBrandId = mysqli_query($connect, $queryBrandId);
            if (!$queryBrandId) {
                die("Database failed");
            }
            $rowBrandId = mysqli_fetch_row($resultBrandId);
            $brandId = $rowBrandId[0];
            mysqli_free_result($resultBrandId); // release variable

            $query11 = 'INSERT INTO btcPost (subject, message, time, userId, categoryId, brandId) VALUES (' . "'" . $subject . "','" . $message. "','" . $time. "','" . $userId . "','" . $categoryId . "','" . $brandId . "')";
            $result11 = mysqli_query($connect, $query11);
            if (!$result11) {
                die("Database failed");
            } else {
                $createPost = true;
            }
            mysqli_free_result($result11); // release variable
        }
    }

    // post request handler
    // (2) handle request of creating comments
    // sanitize and security procedure
    if ($_POST && $_POST['label'] == "comment") {
        if (!has_presence($_POST['message'])) {
            $checkComment = false;
        } else if (!normalLength($_POST['message'], $maxMessageLength)) {
            $checkComment = false;
        } else {
            $checkComment = true;
        }
        // insert into database
        if ($checkComment) {
            $postId = $_POST['postId'];
            $message = escapeSQL($connect, $_POST['message']);
            $time = $_POST['time'];
            $userId = $_POST['userId'];
            $query20 = 'INSERT INTO btcReply (postId, message, time, userId) VALUES (' . "'" . $postId . "','" . $message. "','" . $time. "','" . $userId . "'" . ")";
            $result20 = mysqli_query($connect, $query20);
            if (!$result20) {
                die("Database failed");
            } else {
                $createComment = true;
            }
            mysqli_free_result($result20); // release variable
        }
    }

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

    if ($success) {
        require 'btcmHeader.php';
?>
       
<?php
        require 'btcmPage.php';
    } else {
        require 'btcHeader.php';
        require 'btcPage.php';
    }
    mysqli_close($connect); // close connection
    include 'btcFooter.php';
?>

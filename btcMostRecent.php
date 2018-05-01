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

    if (!$success) {
        require 'btcHeader.php';
?>
<!-- This element is cited from https://codepen.io/aleksandarp/pen/WzyEzp -->
<div class="container flowSection">
    <div class="dealdash section">
        <div class="text"><a href="https://www.dealdash.com/">DealDash</a></div>
    </div>
    <div class="groupon section">
        <a href="https://www.groupon.com/"><div class="text">Groupon</div></a>
    </div>
    <div class="macy section">
        <a href="https://www.macys.com//"><div class="text">Macy</div></a>
    </div>
    <div class="costco section">
        <a href="https://www.costco.com/"><div class="text">Costco</div></a>
    </div>
    <div class="walmart section">
        <a href="https://www.walmart.com/"><div class="text">Walmart</div></a>
    </div>
    <div class="sephora section">
        <a href="https://www.sephora.com/"><div class="text">sephora</div></a>
    </div>
</div>

    <div class="container mainContent">
        <div class="row">
            <div class="col-xs-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#mostrecent">Most Recent 10 &nbsp </a></li>
                </ul>

                <div class="tab-content">
                    <?php
                        echo '<div class="tab-pane fade in active">';
                        $tempQuery1 = "SELECT P.postId, P.subject, P.time,  U.userName, P.message
                        FROM btcCategory C, btcPost P, btcUser U
                        WHERE C.categoryId = P.categoryId AND P.userId = U.userId ORDER BY P.time DESC LIMIT 10";
                        $tempResult1 = mysqli_query($connect, $tempQuery1);
                        if (!$tempResult1) {
                            die("Database failed");
                        }
                        while ($tempRow1 = mysqli_fetch_row($tempResult1)) {
                            echo "<h3>$tempRow1[1]</h3>";
                            echo "<h5>Published by $tempRow1[3] on $tempRow1[2]</h5>";
                            echo "<p>$tempRow1[4]</p>";
                            echo '<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#' . $tempRow1[0] . '"><span class="glyphicon glyphicon-hand-up"></span> Show Comments</button>';
                                // fetch and show comments for each topic
                            $tempQuery2 = "SELECT U.userName, R.time, R.message
                            FROM btcReply R, btcUser U
                            WHERE R.userId = U.userId AND R.postId =" . "'" . $tempRow1[0] . "' ORDER BY R.time DESC";
                            $tempResult2 = mysqli_query($connect, $tempQuery2);
                            if (!$tempResult2) {
                                die("Database failed");
                            }
                            echo '<div id="' . $tempRow1[0] . '" class="collapse">';
                            echo '<table class="table table-striped"><tbody>';
                            while ($tempRow2 = mysqli_fetch_row($tempResult2)) {
                                echo '<tr>';
                                echo "<td> $tempRow2[2] &nbsp &nbsp - By $tempRow2[0] on $tempRow2[1]</td>";
                                echo '</tr>';
                            }
                            mysqli_free_result($tempResult2);
                            echo '</tbody></table>';
                            echo '</div>';
                            echo "<hr/>";
                        }
                        echo '</div>';
                        mysqli_free_result($tempResult1);
                    ?>    
                </div>
            </div>
        </div>
    </div>
<?php
    } else {
        require 'btcmHeader.php';
?>
<!-- This element is cited from https://codepen.io/aleksandarp/pen/WzyEzp -->
<div class="container flowSection">
    <div class="dealdash section">
        <div class="text"><a href="https://www.dealdash.com/">DealDash</a></div>
    </div>
    <div class="groupon section">
        <a href="https://www.groupon.com/"><div class="text">Groupon</div></a>
    </div>
    <div class="macy section">
        <a href="https://www.macys.com//"><div class="text">Macy</div></a>
    </div>
    <div class="costco section">
        <a href="https://www.costco.com/"><div class="text">Costco</div></a>
    </div>
    <div class="walmart section">
        <a href="https://www.walmart.com/"><div class="text">Walmart</div></a>
    </div>
    <div class="sephora section">
        <a href="https://www.sephora.com/"><div class="text">sephora</div></a>
    </div>
</div>
    <div class="container mainContent">
        <div class="row">
            <div class="col-xs-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#mostrecent">Most Recent 10 Coupon Sharing &nbsp </a></li>
                </ul>

                <div class="tab-content">
                    <?php
                        echo '<div class="tab-pane fade in active">';
                        $tempQuery1 = "SELECT P.postId, P.subject, P.time,  U.userName, P.message
                        FROM btcCategory C, btcPost P, btcUser U
                        WHERE C.categoryId = P.categoryId AND P.userId = U.userId ORDER BY P.time DESC LIMIT 10";
                        $tempResult1 = mysqli_query($connect, $tempQuery1);
                        if (!$tempResult1) {
                            die("Database failed");
                        }
                        while ($tempRow1 = mysqli_fetch_row($tempResult1)) {
                            echo "<h3>$tempRow1[1]</h3>";
                            echo "<h5>Published by $tempRow1[3] on $tempRow1[2]</h5>";
                            echo "<p>$tempRow1[4]</p>";
                            echo '<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#' . $tempRow1[0] . '"><span class="glyphicon glyphicon-hand-up"></span> Show Comments</button>';
                             echo '<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#' . $tempRow1[0] . 'w"><span class="glyphicon glyphicon-pencil"></span> Write Comments</button>';
                                // fetch and show comments for each topic
                            $tempQuery2 = "SELECT U.userName, R.time, R.message
                            FROM btcReply R, btcUser U
                            WHERE R.userId = U.userId AND R.postId =" . "'" . $tempRow1[0] . "' ORDER BY R.time DESC";
                            $tempResult2 = mysqli_query($connect, $tempQuery2);
                            if (!$tempResult2) {
                                die("Database failed");
                            }
                            echo '<div id="' . $tempRow1[0] . '" class="collapse">';
                            echo '<table class="table table-striped"><tbody>';
                            while ($tempRow2 = mysqli_fetch_row($tempResult2)) {
                                echo '<tr>';
                                echo "<td> $tempRow2[2] &nbsp &nbsp - By $tempRow2[0] on $tempRow2[1]</td>";
                                echo '</tr>';
                            }
                            mysqli_free_result($tempResult2);
                            echo '</tbody></table>';
                            echo '</div>';
                    ?>
                                <!-- Providing the feature of creating comments -->
                                <div id=<?php echo '"' . $tempRow1[0] .  'w"'; ?> class="collapse">
                                    <form class="form-horizontal" action="btcMostRecent.php" method="post" role="form">
                                        <input type="hidden" name="label" value="comment">
                                        <input type="hidden" name="postId" value=<?php echo '"' . $tempRow1[0] .  '"'; ?>>
                                        <input type="hidden" name="userId" value=<?php echo '"' . $userId .  '"'; ?>>
                                        <input type="hidden" name="time" value=<?php 
                                            $date = date("Y-m-d H:i:s");
                                            echo '"' . $date .  '"'; 
                                        ?>>
                                        <div class="form-group">
                                            <div class="col-sm-8">          
                                                <textarea type="text" class="form-control" id="message" placeholder="Please write your comment here..." name="message" ></textarea>
                                            </div>
                                            <div class="col-sm-4">
                                            </div>
                                        </div>
                                        <div class="submitReply">
                                            <h5 class="thanks">Thank you for your comments. At BitCoupon, your opinion matters.</h5>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>                                    
                                </div>
                    <?php
                            echo "<hr/>";
                        }
                        echo '</div>';
                        mysqli_free_result($tempResult1);
                    ?>    
                </div>
            </div>
        </div>
    </div>
<?php
    }
    mysqli_close($connect); // close connection
    include 'btcFooter.php';
?>
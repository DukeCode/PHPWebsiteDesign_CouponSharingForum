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
<!-- end citation -->
  <div class="container mainContent">
        <div class="row">
            <div class="col-xs-12">
                <ul class="nav nav-tabs">
                   <?php  
                        $query1 = "SELECT C.categoryName, count(*) 
                            FROM btcCategory C, btcPost P 
                            WHERE C.categoryId = P.categoryId
                            Group By C.categoryName";
                        $result1 = mysqli_query($connect, $query1);
                        if (!$result1) {
                            die("Database failed");
                        }
                        $tempCount = 0;
                        while ($row1 = mysqli_fetch_row($result1)) { // fetch count of docs for each category
                            // adjust tab sequence
                            if (strcmp($row1[0], "Other") == 0) {
                                $otherCount = $row1[1];
                                continue;
                                echo "true";
                            }
                            if ($tempCount == 0) {
                                echo '<li class="active"><a data-toggle="tab" href="#' . $row1[0] . '">' . $row1[0] 
                                    . '&nbsp <span class="badge"> ' . $row1[1] . '</span></a></li>';
                                } else {
                                    echo '<li><a data-toggle="tab" href="#' . $row1[0] . '">' . $row1[0] 
                                    . '&nbsp <span class="badge"> ' . $row1[1] . '</span></a></li>';
                            }
                            $categoryArray[] = $row1[0];
                            $tempCount++;
                        }
                        echo '<li><a data-toggle="tab" href="#Other"> Other &nbsp <span class="badge"> ' . $otherCount . '</span></a></li>';
                        $categoryArray[] = "Other";
                        mysqli_free_result($result1); // release variable
                    ?>
                </ul>

                <div class="tab-content">
                    <?php
                        $tempCount = 0;
                        foreach ($categoryArray as $value1) {
                            if ($tempCount == 0) {
                                echo '<div id="'. $value1 . '" class="tab-pane fade in active">';
                            } else {
                                echo '<div id="'. $value1 . '" class="tab-pane fade">';
                            }
                            // Get all docs belong to a specific category
                            $tempQuery1 = "SELECT P.postId, P.subject, P.time,  U.userName, P.message
                                            FROM btcCategory C, btcPost P, btcUser U
                                            WHERE C.categoryName =" . "'" . $value1 . "' AND C.categoryId = P.categoryId AND P.userId = U.userId ORDER BY P.time DESC";
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
                            $tempCount++;
                        }
                        mysqli_free_result($tempResult1); // release result variable
                    ?>    
                </div>
            </div>
        </div>
    </div>

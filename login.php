<?php
    session_start(); // session started
    require 'btcHeader.php';
?>
    <div class="container mainContent">
        <div class="row">
            <div class="col-xs-12">
                <div class="thanksDiv">
                <h3><span class="glyphicon glyphicon-king" aria-hidden="true"></span> Welcome back! Fresh coupons are on the way!</h3>
                </div>
                <form class="form-horizontal" action="loginProcessor.php" method="post" role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="username">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" pattern="^[0-9a-zA-Z\s]+$" title="Note: punctions or special characters are not allowed.">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="password">Password</label>
                        <div class="col-sm-10">          
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" pattern="^[0-9a-zA-Z]+$" title="Note: punctions or special characters are not allowed.">
                        </div>
                    </div>
                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    include 'btcFooter.php';
?>

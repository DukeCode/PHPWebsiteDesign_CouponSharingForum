<!doctype html>
<html lang=en>
<head>
    <meta charset="utf-8">
    <meta name="author" content=“Jin Dai">
    <title>BitCoupon</title>
    <link rel="icon" type="image/png" href="webImg/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Libre+Barcode+128+Text" rel="stylesheet" type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.css" />
    <link rel="stylesheet" href="CSS/home.css" />
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="btcHome.php">BitCoupon</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="btcHome.php"><i class="fa fa-bank" aria-hidden="true"></i> Forum Home</a></li>
                    <li class="dropdown">
                        <a href=" " class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span> Menu <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">Official Posts</li>
                            <li><a href="btcBigBrand.php">Check Big Brands</a></li>
                            <li><a href="btcEditorChoice.php">Editor's Choice</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Member's Share</li>
                            <!-- <li><a href=" ">Most Popular</a></li> -->
                            <li><a href="btcMostRecent.php">Most Recent 10</a></li>
                        </ul>
                    </li>
                    <li><a href="btcHome.php"><i class="fa fa-bold" aria-hidden="true"></i> About Us </a></li>
                    <li><a href="btcHome.php"><i class="fa fa-paper-plane" aria-hidden="true"></i> Contact Us</a></li>
                </ul>
                <!-- for searching service -->
                <form class="navbar-form navbar-left" action="btcSearch.php" method="get" role="form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search Coupns" name="search">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <!-- for login and signup -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="login.php"><span class="glyphicon glyphicon-king" aria-hidden="true"></span> Login </a> </li>
                    <li><a href="#"><span class="glyphicon glyphicon-pawn"></span> Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <header>
        <div class="container jumbotron">
            <div class="row">
                <div class="col-xs-12 col-sm-2">
                    <a href="btcHome.php"><img src="webImg/logo.png"/></a>
                </div>
                <div class="col-xs-12 col-sm-10">
                    <h1>BitCoupon</h1>
                    <p id="brandMessage">Get coupons everyday, we always have what you want.</p>
                </div>
            </div>
        </div>
    </header>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <button onclick="topFunction()" id="topButton" title="Go to top"><i class="fa fa-arrow-circle-up fa-2x" aria-hidden="true"></i>
                </div>
            </div>
        </div>
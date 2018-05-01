<?php
    session_start(); // session started
    if (isset($_SESSION)){
        session_destroy();
    }
    require 'btcHome.php';
?>
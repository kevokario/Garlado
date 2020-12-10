<?php
    function connect() {
        $host = "localhost";
        $user = "root";
        $pass = "riotech";
        $db = "garladodb";
        /*$user = "myonline_garlado";
        $pass = "l}W[5(0STLKE";
        $db = "myonline_garladodb";*/
        $con = new mysqli($host, $user, $pass, $db);
        if ($con->connect_error) {
            $con = 'Connect Error'; // "error ".$conn->connect_error;
        }
        return $con;
    }
?>
<?php

include '../Core/functions.php';
//sleep(2);
if (isset($_GET['cat'])) {

    $cat = $_GET['cat'];
    ///////////////////////////____________ LOGIN CODE______________ ///////////////////////////////
    if ($cat === "Login") {
        $con = connect();
        if ($con === 'Connect Error') {
            echo $con;
        } else {
            $username = $_GET['uname'];
            $pasword = $_GET['pword'];

            $sql = "Select * from `admins` where `email`='$username' And `password`='$pasword'";
            $con = connect();

            $result = $con->query($sql);
            $rows = $result->num_rows;

            if ($rows === 0) {
                echo 'FailedLogin';
            } else {
                $adminid = 0;
                for ($a = 0; $a < $rows; $a++) {
                    $result->data_seek($a);
                    $adminid = $result->fetch_assoc()['adminId'];
                }
                $_SESSION['marvelId'] = $adminid;
                $_SESSION['marvel'] = $username;
                $action='LOG IN';
                $event='Successful login into adminitstration panel.';
                auditLogger($action,$event);
                $month = getTime('month');
                $year = (int)getTime('year');
                $sqlmonth="INSERT INTO `month`(`month`) VALUES ('$month');";
                $sqlyear="INSERT INTO `year`(`year`) VALUES ($year)";
                $con->query($sqlmonth);
                $con->query($sqlyear);
                echo 'SuccessLogin';
            }
        }
    }
    ///////////////////////////____________ Recover CODE______________ ///////////////////////////////
    if ($cat === "recoverPass") {
        $email = $_GET['email'];

        $sql = "Select * from `admins` where `email`='$email'";
        $con = connect();

        $result = $con->query($sql);
        $rows = $result->num_rows;
        if ($rows === 0) {
            echo 'emailInvalid';
        } else {
            echo 'emailValid';
        }
    }
}
 
   
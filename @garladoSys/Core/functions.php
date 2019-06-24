<?php

session_start();
error_reporting(0);

//sleep(2);

function connect() {
    $host = "localhost";
    $user = "root";
    $pass = "riotech";
    $db = "garladodb";
    $con = new mysqli($host, $user, $pass, $db);
    if ($con->connect_error) {
        $con = 'Connect Error'; // "error ".$conn->connect_error;
    }
    return $con;
}

function createUserSession($user) {
    $_SESSION['marvel'] = $user;
    $value = false;
    if (isset($_SESSION['marvel'])) {
        $value = true;
    } else {
        $value = false;
    }
    return $value;
}

function getTime($type) {
    date_default_timezone_set('Africa/Nairobi');
    $now = new DateTime();
    if ($type === 'time') {
        return $now->format("H:m:s");
    } else if ($type === 'year') {
        return $now->format("Y");
    } else if ($type === 'month') {
        return $now->format("m");
    } else if ($type === 'date') {
        return $now->format("d/m/Y");
    } else if ($type === 'day') {
        return $now->format("d");
    }
}

function auditLogger($action, $event) {
    $adminId = $_SESSION['marvelId'];
    $time = getTime('time');
    $date = getTime('date');
    $day = getTime('day');
    $month = getTime('month');
    $year = getTime('year');
    $con = connect();
    $sql = "INSERT INTO 
       `adminlog`(`adminId`, `time`, `date`, `day`, `month`, `year`, `action`, `event`) 
           VALUES ($adminId,'$time','$date','$day','$month','$year','$action','$event');";
    $con->query($sql);
}

function logout() {
    ?>
    <script>document.location.href = '../@logout.php';</script>
    <?php

}

function myAccount($email) {
    $sql = "Select * from `admins` where `email`='$email'";
    $con = connect();

    $result = $con->query($sql);
    $rows = $result->num_rows;
    $name = '';
    $phone = '';
    $level = '';
    $image = '';
    for ($a = 0; $a < $rows; $a ++) {
        $result->data_seek($a);
        $name = $result->fetch_assoc()['name'];

        $result->data_seek($a);
        $phone = $result->fetch_assoc()['phone'];

        $result->data_seek($a);
        $level = $result->fetch_assoc()['level'];

        $result->data_seek($a);
        $image = $result->fetch_assoc()['image'];
    }
    echo '~' . $name . '!' . $email . '+' . $phone . '_' . $level . '$' . $image . '=';
}

/* ===============================================================
 * @STAFF MANAGER LOGIC
  ===============================================================
 */

function addMember($name, $mail, $phone, $level, $image, $stat) {
    $sqlinsert = " INSERT INTO `admins` (`name`, `email`, `phone`, `password`, `level`, `image`,`status`) VALUES ('$name', '$mail', '$phone', '$mail', '$level', '$image',$stat);";
    $sqlcheckmail = "Select * from `admins` where `email`='$mail'";
    $con = connect();

    if ($con === 'Connect Error') {
        echo 'Something went wrong!<br>
                    Please check your internet connection then try again. User : kevok<br/>
        <span class="fa fa-stack" style="font-weight:100"><i class="fa fa-stack-1x fa-globe"></i><i class="fa fa-stack-2x fa-ban"></i>\n\
        </span>';
    } else {
        $result = $con->query($sqlcheckmail);
        $rows = $result->num_rows;
        if ($rows === 0) {
            $con->query($sqlinsert);
            if ($con->error) {
                echo '<p class="text-danger">User <strong>' . $mail . '</strong> was not added!</p>' . $con->error;
            } else {
                $action = 'ADDED NEW MEMBER';
                $event = 'Successful addition of member ' . $mail . ' as a user of adminitstration panel.';
                auditLogger($action, $event);
                echo 'User <strong>' . $mail . '</strong> successfuly added!';
            }
        } else {
            echo '<p class="text-danger"><strong>' . $mail . '</strong> already exists!</p>';
        }
    }
}

function viewMember() {
    $name = '';
    $mail = '';
    $phone = '';
    $level = '';
    $stat = '';
    $id = '';
    $tr = '';
    $sql = "SELECT `adminid`,`name`,`email`,`phone`,`password`,`level`,`image`,`status` from `admins`";
    $con = connect();

//
    $result = $con->query($sql);

    $rows = $result->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $id = $result->fetch_assoc()['adminid'];

        $result->data_seek($a);
        $name = $result->fetch_assoc()['name'];

        $result->data_seek($a);
        $mail = $result->fetch_assoc()['email'];

        $result->data_seek($a);
        $phone = $result->fetch_assoc()['phone'];

        $result->data_seek($a);
        $level = $result->fetch_assoc()['level'];

        $result->data_seek($a);
        $stat = $result->fetch_assoc()['status'];

        $status = 'ACTIVE';
        if ($stat === '0') {
            $status = 'INACTIVE';
        }
        $tr = $tr . ' <tr class="text-uppercase">
                    <td>' . ($a + 1) . '</td>'
                . '<td>' . $name . '</td>'
                . '<td>' . $mail . '</td> '
                . '<td>' . $phone . '</td> '
                . '<td>' . $level . '</td>'
                . '<td>' . $status . '</td>
                      <td>
                      <button class="btn btn-warning"
                      title="View More details"
                      value="' . $id . '"
                      onclick="Launchdiv(this.value)"
                      ><span class="fa fa-folder-open-o"></span>...
                      </button>
                      </td>
                </tr>  ';
    }
    echo $tr;
}

function showDetails($id) {
    $sql = "Select * from `admins` where `adminid`=$id";
    $con = connect();

    $result = $con->query($sql);
    $rows = $result->num_rows;
    $name = '';
    $mail = '';
    $stat = '';
    $status = 'ACTIVE';
    $phone = '';
    $level = '';
    $image = '';
    for ($a = 0; $a < $rows; $a ++) {
        $result->data_seek($a);
        $name = $result->fetch_assoc()['name'];

        $result->data_seek($a);
        $mail = $result->fetch_assoc()['email'];

        $result->data_seek($a);
        $phone = $result->fetch_assoc()['phone'];

        $result->data_seek($a);
        $level = $result->fetch_assoc()['level'];

        $result->data_seek($a);
        $image = $result->fetch_assoc()['image'];

        $result->data_seek($a);
        $stat = $result->fetch_assoc()['status'];


        if ($stat === '0') {
            $status = 'INACTIVE';
        }
    }

    echo

    '  <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-4">
                                <h4 class="text-center col-sm-12" style="text-decoration: underline">User Picture.</h4>
                                <img class="userImg" src="./userpics/' . $image . '" alt=""/>
                            </div>
                            <div class="col-sm-8">
                                <h4 class="" style="text-decoration: underline">User Details.</h4>
                                <form style="margin-top: 5px">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label> Name </label>
                                                <p class="form-control-static">' . $name . '</p>
                                            </div>
                                           <div class="form-group">
                                                <label> Email </label>
                                                 <p class="form-control-static">' . $mail . '</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label> Phone </label>
                                                 <p class="form-control-static">' . $phone . '</p>
                                            </div>
                                            <div class="form-group">
                                               <div class="row">
                                                <div class="col-sm-6">
                                                    <label> Level </label>
                                                    <p class="form-control-static">' . $level . '</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label> Status </label>
                                                    <p class="form-control-static">' . $status . '</p>
                                                </div>
                                               </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button  value="' . $id . '" onclick="editMember(this.value)" class="btn btn-warning btn-sm" type="button">
                                                Edit
                                            </button>
                                            
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>';
}

function editMember($id) {
    $sql = "Select * from `admins` where `adminid`=$id";
    $con = connect();

    $result = $con->query($sql);
    $rows = $result->num_rows;
    $name = '';
    $mail = '';
    $phone = '';
    $level = '';
    $image = '';
    $status = '';
    for ($a = 0; $a < $rows; $a ++) {
        $result->data_seek($a);
        $name = $result->fetch_assoc()['name'];

        $result->data_seek($a);
        $mail = $result->fetch_assoc()['email'];

        $result->data_seek($a);
        $phone = $result->fetch_assoc()['phone'];

        $result->data_seek($a);
        $level = $result->fetch_assoc()['level'];

        $result->data_seek($a);
        $image = $result->fetch_assoc()['image'];

        $result->data_seek($a);
        $status = $result->fetch_assoc()['status'];
    }
    echo '~' . $name . '!' . $mail . '+' . $phone . '_' . $level . '$' . $image . '%' . $status;
}

function UpdateMemberDataB($id, $name, $email, $phone, $level, $status) {
    $con = connect();
    $mail = $_SESSION['marvel'];
    $sql = "UPDATE `admins` 
                SET `name`='$name',`email`='$email',`phone`='$phone',`level`='$level',
                `status`=$status WHERE `adminId`=$id";
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        if ($mail === $email) {
            $sql = "UPDATE `admins` 
                SET `name`='$name',`email`='$email',`phone`='$phone',`level`='$level',`status`=1
                WHERE `adminId`=$id";
        } else {
            
        }

        $con->query($sql);
        if ($con->errror) {
            echo '<p class="text-danger">Could save changes. Please check your internet connection then try again!</p>';
        } else {
            $action = 'MODIFIED USER DATA';
            $event = 'Successful modification of user ' . $email . ' information.';
            auditLogger($action, $event);
            echo 'Changes Successfuly saved!' . $sql;
        }
    }
}

function UpdateMemberDataA($id, $name, $email, $phone, $level, $status, $image) {
    $con = connect();
    $sql = "UPDATE `admins` 
                SET `name`='$name',`email`='$email',`phone`='$phone',`level`='$level',`image`='$image',
                `status`=$status WHERE `adminId`=$id";
    $mail = $_SESSION['marvel'];
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        if ($mail === $email) {
            $sql = "UPDATE `admins` 
                SET `name`='$name',`email`='$email',`phone`='$phone',`level`='$level',`image`='$image'
                WHERE `adminId`=$id";
        } else {
            
        }
        $con->query($sql);
        if ($con->errror) {
            echo '<p class="text-danger">Could save changes. Please check your internet connection then try again!</p>';
        } else {
            $action = 'MODIFIED USER DATA';
            $event = 'Successful modification of user ' . $email . ' information including Profile picture.';
            auditLogger($action, $event);
            echo 'Changes Successfuly saved!';
        }
    }
}

/* ===============================================================
 * @GOODS MANAGER LOGIC
  ===============================================================
 */

//=========================GROUP=======================================
function addGroup($name) {
    $sqlcheck = "Select * from `majorcategory` where `majorName` like '%$name%'";
    $sqladd = "insert into `majorcategory` (`majorName`,`status`) values('$name',0)";

    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $result = $con->query($sqlcheck);
        $rows = $result->num_rows;
        if ($rows === 0) {
            //  add
            $con->query($sqladd);
            if ($con->error) {
                echo '<p class="text-danger">Group <strong>' . $name . '</strong> was not added! Please try again. if this error ocuurs again contact Admin</p>';
            } else {
                $action = 'ADDED NEW GENERAL GROUP';
                $event = 'Successful addition of general group ' . $name . '.';
                auditLogger($action, $event);
                echo '<p class="text-success">Group <strong>' . $name . '</strong> successfuly added!</p>';
            }
        } else {
            // already exists
            echo '<p class="text-danger">Group <strong>' . $name . '</strong> already exist!</p>';
        }
    }
}

function viewGroupFilter($filter) {
    if ($filter === 'Active only') {
        $sqlget = "select * from `majorcategory` where `status`=1 order by `majorId` asc";
    } else if ($filter === 'Inactive only') {
        $sqlget = "select * from `majorcategory` where `status`=0 order by `majorId` asc";
    } else {
        $sqlget = "select * from `majorcategory` order by `majorId` asc";
    }
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $result = $con->query($sqlget);
        $rows = $result->num_rows;
        $name = '';
        $status = '';
        $stat = '';
        $tr = '';
        $majorId = '';

        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $name = $result->fetch_assoc()['majorName'];

            $result->data_seek($a);
            $majorId = $result->fetch_assoc()['majorId'];

            $result->data_seek($a);
            $status = $result->fetch_assoc()['status'];

            if ($status === '0') {
                $stat = 'Not Active';
            } else {
                $stat = 'Active';
            }

            $tr = $tr . '<tr class="text-uppercase"> '
                    . '<td>' . ($a + 1) . '</td> '
                    . '<td>' . $name . '</td> '
                    . '<td>' . $stat . '</td>'
                    . ' <td>'
                    . '<button '
                    . 'value="' . $majorId . '"'
                    . ' class="btn btn-warning"'
                    . ' onclick="editGroupModal(this.value)"'
                    . '>'
                    . '<i class="fa fa-edit"></i>'
                    . 'Edit'
                    . '</button>'
                    . '</td>  '
                    . '</tr>';
        }

        echo $tr;
    }
}

function groupDataView($id) {
    $sqlget = "select * from `majorcategory` where `majorId` =" . $id;

    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $name = '';
        $status = '';
        $result = $con->query($sqlget);
        $rows = $result->num_rows;

        if ($rows === 0) {
            echo '<p>There was an error while handling this request. Please contact the admin.</p>';
        } else {
            for ($a = 0; $a < $rows; $a++) {
                $result->data_seek($a);
                $name = $result->fetch_assoc()['majorName'];

                $result->data_seek($a);
                $status = $result->fetch_assoc()['status'];
            }
            echo '~' . $name . '^' . $status . '';
        }
    }
}

function updateGroup($id, $name, $stat) {
    $sqlupdate = "update `majorCategory` set `majorName`='$name',`status`=$stat WHERE `majorId`=$id";

    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $con->query($sqlupdate);
        if ($con->error) {
            echo '<p class="text-danger">Changes were not made, Please check your internet connection then try again!</p>';
        } else {
            $action = 'MODIFIED GENERAL GROUP';
            $event = 'Successful modifictation of general group ' . $name . '\'s data.';
            auditLogger($action, $event);
            echo 'Update Successful!';
        }
    }
}

function viewGroup() {
    $sqlget = "select * from `majorcategory` order by `majorId` asc";
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $result = $con->query($sqlget);
        $rows = $result->num_rows;
        $name = '';
        $status = '';
        $stat = '';
        $tr = '';
        $majorId = '';

        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $name = $result->fetch_assoc()['majorName'];

            $result->data_seek($a);
            $majorId = $result->fetch_assoc()['majorId'];

            $result->data_seek($a);
            $status = $result->fetch_assoc()['status'];

            if ($status === '0') {
                $stat = 'Not Active';
            } else {
                $stat = 'Active';
            }

            $tr = $tr . '<tr class="text-uppercase"> '
                    . '<td>' . ($a + 1) . '</td> '
                    . '<td>' . $name . '</td> '
                    . '<td>' . $stat . '</td>'
                    . ' <td>'
                    . '<button '
                    . 'value="' . $majorId . '"'
                    . ' class="btn btn-warning"'
                    . ' onclick="editGroupModal(this.value)"'
                    . '>'
                    . '<i class="fa fa-edit"></i>'
                    . 'Edit'
                    . '</button>'
                    . '</td>  '
                    . '</tr>';
        }

        echo $tr;
    }
}

//============================CATEGORY=================================
function filterCategory($status, $group) {
    $con = connect();
    $sql = "SELECT majorCategory.majorName, category.catName, category.status, category.catid
                FROM category
                INNER JOIN majorCategory
                ON category.majorId=majorCategory.majorId
                 where majorCategory.status=1 AND majorCategory.majorName='$group' AND category.status=0;";
    if ($status === 'ALL' && $group === 'ALL') {
        $sql = "SELECT majorCategory.majorName, category.catName, category.status, category.catid
                FROM category
                INNER JOIN majorCategory
                ON category.majorId=majorCategory.majorId
                where majorCategory.status=1";
    } else if ($status === 'ACTIVE' && $group === 'ALL') {
        $sql = "SELECT majorCategory.majorName, category.catName, category.status, category.catid
                FROM category
                INNER JOIN majorCategory
                ON category.majorId=majorCategory.majorId
                 where majorCategory.status=1 AND category.status=1;";
    } else if ($status === 'INACTIVE' && $group === 'ALL') {
        $sql = "SELECT majorCategory.majorName, category.catName, category.status, category.catid
                FROM category
                INNER JOIN majorCategory
                ON category.majorId=majorCategory.majorId
                where majorCategory.status=1 AND category.status=0;";
    } else if ($status === 'ALL') {
        $sql = "SELECT majorCategory.majorName, category.catName, category.status, category.catid
                FROM category
                INNER JOIN majorCategory
                ON category.majorId=majorCategory.majorId
               where majorCategory.status=1 AND majorCategory.majorName='$group';";
    } else if ($status === 'ACTIVE') {
        $sql = "SELECT majorCategory.majorName, category.catName, category.status, category.catid
                FROM category
                INNER JOIN majorCategory
                ON category.majorId=majorCategory.majorId
                where majorCategory.status=1 AND majorCategory.majorName='$group' AND category.status=1;";
    }

    $mname = '';
    $cname = '';
    $status = '';
    $stat = '';
    $id = '';
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $result = $con->query($sql);
        if ($con->error) {
            //error found
            echo '<p class="text-danger">Could not load Data, Please check your internet connection then try again!</p>';
        } else {
            //no error found.
            for ($a = 0; $a < $result->num_rows; $a++) {
                $result->data_seek($a);
                $mname = $result->fetch_assoc()['majorName'];

                $result->data_seek($a);
                $cname = $result->fetch_assoc()['catName'];

                $result->data_seek($a);
                $status = $result->fetch_assoc()['status'];
                if ($status === '0') {
                    $stat = 'Not Active';
                } else {
                    $stat = 'Active';
                }

                $result->data_seek($a);
                $id = $result->fetch_assoc()['catid'];

                $tr = $tr . '<tr class="text-uppercase">  '
                        . '<td>' . ($a + 1) . '</td>'
                        . '<td>' . $mname . '</td> '
                        . '<td>' . $cname . '</td> '
                        . '<td>' . $stat . '</td> '
                        . '<td>'
                        . '<button class="btn btn-warning" type="button" value="' . $id . '" onclick="editCategory(this.value)">'
                        . '<i class="fa fa-edit"></i> Edit...'
                        . '</button>'
                        . '</td> '
                        . '</tr>';
            }
            echo $tr;
        }
    }
}

function PopCategoryData($id) {
    $con = connect();
    $general = '';
    $catname = '';
    $status = '';

    $sql = "SELECT majorcategory.majorname, category.catname, category.status
            FROM category
            INNER JOIN majorcategory ON majorcategory.majorId = category.majorId
            WHERE category.catid =$id;";

    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $result = $con->query($sql);
        $rows = $result->num_rows;
        if ($con->error) {
            echo '<p class="text-danger">Could not load data. Please check your internet connection then try again!</p>';
        } else {
            for ($a = 0; $a < $rows; $a++) {
                $result->data_seek($a);
                $general = $result->fetch_assoc()['majorname'];

                $result->data_seek($a);
                $catname = $result->fetch_assoc()['catname'];

                $result->data_seek($a);
                $status = $result->fetch_assoc()['status'];
            }
            echo '^' . $general . '*' . $catname . '+' . $status;
        }
    }
}

function updateCategory($catid, $catname, $status) {
    $con = connect();
    $sql = "update `category` set `catname`='$catname',`status`=$status where `catid`=$catid";
    if ($con->error) {
        echo '<p class="text-danger">Could not load data. Please check your internet connection then try again!</p>';
    } else {
        $con->query($sql);
        if ($con->errror) {
            echo '<p class="text-danger">Could save changes. Please check your internet connection then try again!</p>';
        } else {
            $action = 'MODIFIED CATEGORY GROUP';
            $event = 'Successful modification of categrory group ' . $catname . '.';
            auditLogger($action, $event);

            echo 'Changes Successfuly saved!';
        }
    }
}

function populateParentCategory() {
    $con = connect();
    $sql = "select * from `majorCategory` where `status`=1 order by `majorId` asc";
    $name = '';
    $result = $con->query($sql);
    $rows = $result->num_rows;
    $options = '<option >------SELECT PARENT GENERAL GROUP------</option>';
    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $name = $result->fetch_assoc()['majorName'];
        $options = $options . '<option>' . $name . '</option>';
    }
    echo $options;
}

function populateParentCategoryEdit() {
    $con = connect();
    $sql = "select * from `majorCategory` where `status`=1 order by `majorId` asc";
    $name = '';
    $result = $con->query($sql);
    $rows = $result->num_rows;
    $options = '<option>---select Group---</option><option>ALL</option>';
    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $name = $result->fetch_assoc()['majorName'];
        $options = $options . '<option>' . $name . '</option>';
    }
    echo $options;
}

function addCategory($name, $general) {
    $con = connect();
    $sqlconfirmcat = "select * from `category` where `catName` like '%$name%' ";
    $sqlGetMajorId = "select * from majorcategory where majorname = '$general'";

    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $resultconfirm = $con->query($sqlconfirmcat);
        $rowsconfirm = $resultconfirm->num_rows;
        if ($rowsconfirm > 0) {
            //exists
            echo '<p class="text-danger">Category group <strong>' . $name . '</strong> already exists!</p>';
        } else {
            //get majorId,add item
            $resultmajor = $con->query($sqlGetMajorId);
            $rowsMajor = $resultmajor->num_rows;
            $majorId = '';

            for ($a = 0; $a < $rowsMajor; $a++) {
                $resultmajor->data_seek($a);
                $majorId = $resultmajor->fetch_assoc()['majorId'];
            }

            $sqladd = "insert into `category`(`majorID`,`catName`,`status`) VALUES ($majorId,'$name',0)";
            $con->query($sqladd);

            if ($con->error) {
                echo '<p class="text-danger">Category group <strong>' . $name . '</strong> successfuly added! Check internet connection then try again</p>';
            } else {
                $action = 'ADDED NEW CATEGORY GROUP';
                $event = 'Successful addition of category group ' . $name . '.';
                auditLogger($action, $event);

                echo '<p>Category group <strong>' . $name . '</strong> successfuly added!</p>';
            }
        }
    }
}

function populateCateOnGeneral($general) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sqlGetMajorId = "select * from majorcategory where majorname = '$general';";
        $resultmajor = $con->query($sqlGetMajorId);
        $rowsMajor = $resultmajor->num_rows;
        $majorId = '';

        for ($a = 0; $a < $rowsMajor; $a++) {
            $resultmajor->data_seek($a);
            $majorId = $resultmajor->fetch_assoc()['majorId'];
        }

        $sql2 = "SELECT * FROM `category` where `majorid`=$majorId;";
        $result2 = $con->query($sql2);
        $rows2 = $result2->num_rows;
        $opt = '<option>------SELECT CATEGORY GROUP------</option>';
        $dat = '';
        if ($rows2 === 0) {
            echo 'nothing';
        } else {
            for ($a = 0; $a < $rows2; $a++) {
                $result2->data_seek($a);
                $dat = $result2->fetch_assoc()['catName'];
                $opt = $opt . '<option>' . $dat . '</option>';
            }
            echo $opt;
        }
    }
}

function populateCateOnGeneralEdit($general) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $opt = '<option>---select Cat---</option>';
        if ($general === 'ALL') {
            $sql2 = "SELECT category.catName from category 
                    INNER JOIN majorcategory on majorcategory.majorId = category.majorId";
            $opt = '<option>---select Cat---</option><option>ALL</option>';
        } else {
            $sql2 = "SELECT category.catName from category 
                    INNER JOIN majorcategory on majorcategory.majorId = category.majorId
                    where majorcategory.majorName = '$general'";
            $opt = '<option>---select Cat---</option><option>ALL</option>';
        }
        $result2 = $con->query($sql2);
        $rows2 = $result2->num_rows;
        $dat = '';
        if ($rows2 === 0) {
            echo 'nothing';
        } else {
            for ($a = 0; $a < $rows2; $a++) {
                $result2->data_seek($a);
                $dat = $result2->fetch_assoc()['catName'];
                $opt = $opt . '<option>' . $dat . '</option>';
            }
            echo $opt;
        }
    }
}

function addMinorCategory($category, $name) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql1 = "select * from `minorcategory` where `minorname` like '%$name%'";
        $resultconfirm = $con->query($sql1);
        $rows = $resultconfirm->num_rows;
        if ($rows > 0) {
            echo '<p class="text-danger">Specific group <strong>' . $name . '</strong> already exists!</p>';
        } else {
            $sqlGetMajorId = "select catid from category where catname = '$category'";
            $resultmajor = $con->query($sqlGetMajorId);
            $rowsMajor = $resultmajor->num_rows;
            $catId = '';
            for ($a = 0; $a < $rowsMajor; $a++) {
                $resultmajor->data_seek($a);
                $catId = $resultmajor->fetch_assoc()['catid'];
            }
            $sql3 = "INSERT INTO `minorcategory` (`catId`, `minorName`, `status`) VALUES ($catId, '$name', '0');";
            $con->query($sql3);

            if ($con->error) {
                echo '<p class="text-danger">Specific Category group <strong>' . $name . '</strong>'
                . ' Was not added! '
                . 'Check internet connection then try again</p><br>' . $rowsMajor;
            } else {
                $action = 'ADDED NEW SPECIFIC GROUP';
                $event = 'Successful addition of specific group ' . $name . '.';
                auditLogger($action, $event);

                echo '<p>Specific Category group <strong>' . $name . '</strong> successfuly added!</p>';
            }
        }
    }
}

function filterMinorCategoryEdit($general, $category, $status) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = '';
        if ($general === 'ALL' && $category === 'ALL' && $status === 'ALL') {
            $sql = "SELECT majorCategory.majorName, category.catName, minorcategory.minorName, minorcategory.minorId, minorcategory.status
                FROM minorcategory
                INNER JOIN category ON minorcategory.catId = category.catId
                INNER JOIN majorCategory ON category.majorId = majorCategory.majorId
                WHERE majorCategory.status =1 AND category.status=1
                ";
        } else if ($general === 'ALL' && $category === 'ALL' && $status === 'ACTIVE') {
            $sql = "SELECT majorCategory.majorName, category.catName, minorcategory.minorName, minorcategory.minorId, minorcategory.status
                FROM minorcategory
                INNER JOIN category ON minorcategory.catId = category.catId
                INNER JOIN majorCategory ON category.majorId = majorCategory.majorId
                WHERE majorCategory.status =1 AND category.status=1 AND minorcategory.status=1
                ";
        } else if ($general === 'ALL' && $category === 'ALL' && $status === 'INACTIVE') {
            $sql = "SELECT majorCategory.majorName, category.catName, minorcategory.minorName, minorcategory.minorId, minorcategory.status
                FROM minorcategory
                INNER JOIN category ON minorcategory.catId = category.catId
                INNER JOIN majorCategory ON category.majorId = majorCategory.majorId
                WHERE majorCategory.status =1 AND category.status=1 AND minorcategory.status=0
                ";
        } else if ($category === 'ALL' && $status === 'ALL') {
            $sql = "SELECT majorCategory.majorName, category.catName, minorcategory.minorName, minorcategory.minorId, minorcategory.status
                FROM minorcategory
                INNER JOIN category ON minorcategory.catId = category.catId
                INNER JOIN majorCategory ON category.majorId = majorCategory.majorId
                WHERE majorCategory.status =1 AND majorCategory.majorName like '%$general%' AND category.status=1
                ";
        } else if ($category === 'ALL' && $status === 'ACTIVE') {
            $sql = "SELECT majorCategory.majorName, category.catName, minorcategory.minorName, minorcategory.minorId, minorcategory.status
                FROM minorcategory
                INNER JOIN category ON minorcategory.catId = category.catId
                INNER JOIN majorCategory ON category.majorId = majorCategory.majorId
                WHERE majorCategory.status =1 AND majorCategory.majorName like '%$general%' AND category.status=1 AND minorcategory.status=1
                ";
        } else if ($category === 'ALL' && $status === 'INACTIVE') {
            $sql = "SELECT majorCategory.majorName, category.catName, minorcategory.minorName, minorcategory.minorId, minorcategory.status
                FROM minorcategory
                INNER JOIN category ON minorcategory.catId = category.catId
                INNER JOIN majorCategory ON category.majorId = majorCategory.majorId
                WHERE majorCategory.status =1 AND majorCategory.majorName like '%$general%' AND category.status=1 AND minorcategory.status=0
                ";
        } else if ($general === 'ALL' && $status === 'ALL') {
            $sql = "SELECT majorCategory.majorName, category.catName, minorcategory.minorName, minorcategory.minorId, minorcategory.status
                FROM minorcategory
                INNER JOIN category ON minorcategory.catId = category.catId
                INNER JOIN majorCategory ON category.majorId = majorCategory.majorId
                WHERE majorCategory.status =1 AND category.status=1 AND category.catName like '%$category%'
                ";
        } else if ($general === 'ALL' && $status === 'ACTIVE') {
            $sql = "SELECT majorCategory.majorName, category.catName, minorcategory.minorName, minorcategory.minorId, minorcategory.status
                FROM minorcategory
                INNER JOIN category ON minorcategory.catId = category.catId
                INNER JOIN majorCategory ON category.majorId = majorCategory.majorId
                WHERE majorCategory.status =1 AND category.status=1 AND category.catName like '%$category%' AND minorcategory.status=1
                ";
        } else if ($general === 'ALL' && $status === 'INACTIVE') {
            $sql = "SELECT majorCategory.majorName, category.catName, minorcategory.minorName, minorcategory.minorId, minorcategory.status
                FROM minorcategory
                INNER JOIN category ON minorcategory.catId = category.catId
                INNER JOIN majorCategory ON category.majorId = majorCategory.majorId
                WHERE majorCategory.status =1 AND category.status=1 AND category.catName like '%$category%' AND minorcategory.status=0
                ";
        } else if ($status === 'ACTIVE') {
            $sql = "SELECT majorCategory.majorName, category.catName, minorcategory.minorName, minorcategory.minorId, minorcategory.status
                FROM minorcategory
                INNER JOIN category ON minorcategory.catId = category.catId
                INNER JOIN majorCategory ON category.majorId = majorCategory.majorId
                WHERE majorCategory.status =1 AND majorCategory.majorName like '%$general%' AND category.status=1 AND  category.catName like '%$category%' AND minorcategory.status=1
                ";
        } else if ($status === 'INACTIVE') {
            $sql = "SELECT majorCategory.majorName, category.catName, minorcategory.minorName, minorcategory.minorId, minorcategory.status
                FROM minorcategory
                INNER JOIN category ON minorcategory.catId = category.catId
                INNER JOIN majorCategory ON category.majorId = majorCategory.majorId
                WHERE majorCategory.status =1 AND majorCategory.majorName like '%$general%' AND category.status=1 AND  category.catName like '%$category%' AND minorcategory.status=0
                ";
        } else if ($status === 'ALL') {
            $sql = "SELECT majorCategory.majorName, category.catName, minorcategory.minorName, minorcategory.minorId, minorcategory.status
                FROM minorcategory
                INNER JOIN category ON minorcategory.catId = category.catId
                INNER JOIN majorCategory ON category.majorId = majorCategory.majorId
                WHERE majorCategory.status =1 AND majorCategory.majorName like '%$general%' AND category.status=1  AND category.catName like '%$category%'
                ";
        }

        $majorname = '';
        $catname = '';
        $minorname = '';
        $minorid = '';
        $minstat = '';
        $stat = 'Not Active';
        $tr = '';
        $result = $con->query($sql);
        $rows = $result->num_rows;
        if ($con->error) {
            echo '<p class="text-danger">Could not load data. Please check your internet connection then try again!</p>';
        } else {
            for ($a = 0; $a < $rows; $a++) {
                $result->data_seek($a);
                $majorname = $result->fetch_assoc()['majorName'];

                $result->data_seek($a);
                $catname = $result->fetch_assoc()['catName'];

                $result->data_seek($a);
                $minorname = $result->fetch_assoc()['minorName'];

                $result->data_seek($a);
                $minorid = $result->fetch_assoc()['minorId'];

                $result->data_seek($a);
                $minstat = $result->fetch_assoc()['status'];

                if ($minstat === '0') {
                    $stat = 'Not Active';
                } else {
                    $stat = 'Active';
                }

                $tr = $tr . '
                        <tr class="text-uppercase">
                        <td>' . ($a + 1) . '</td>
                        <td>' . $majorname . '</td>
                        <td>' . $catname . '</td>
                        <td>' . $minorname . '</td>
                        <td>' . $stat . '</td>
                        <td>
                            <button
                            class="btn btn-warning"
                            value="' . $minorid . '"
                            onclick="editMinorCatUpdator(this.value)"
                            >
                                <i class="fa fa-edit"></i> Edit
                            </button>
                        </td>
                        </tr>
                        ';
            }
            echo $tr;
        }
    }
}

function EditMinCatUpdate($id) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "SELECT majorCategory.majorName, category.catName, minorcategory.minorName, minorcategory.status
                FROM minorcategory
                INNER JOIN category ON minorcategory.catId = category.catId
                INNER JOIN majorCategory ON category.majorId = majorCategory.majorId
                WHERE majorCategory.status =1
                AND category.status =1
                AND minorcategory.minorId =$id
                ";

        $majorname = '';
        $catname = '';
        $minorname = '';
        $minstat = '';
        $result = $con->query($sql);
        $rows = $result->num_rows;
        if ($con->error) {
            echo '<p class="text-danger">Could not load data. Please check your internet connection then try again!</p>';
        } else {
            for ($a = 0; $a < $rows; $a++) {
                $result->data_seek($a);
                $majorname = $result->fetch_assoc()['majorName'];

                $result->data_seek($a);
                $catname = $result->fetch_assoc()['catName'];

                $result->data_seek($a);
                $minorname = $result->fetch_assoc()['minorName'];

                $result->data_seek($a);
                $minstat = $result->fetch_assoc()['status'];
            }

            $data = '^' . $majorname . '*' . $catname . '~' . $minorname . '+' . $minstat;

            echo $data;
        }
    }
}

function SaveMinorChangeUpdate($id, $name, $status) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $stat = 0;

        $sql = "UPDATE `minorcategory`
                    set `minorname`='$name',
                        `status`=$status
                            WHERE
                            `minorid`=$id;

                ";

        $con->query($sql);
        if ($con->errror) {
            echo '<p class="text-danger">Could save changes. Please check your internet connection then try again!</p>';
        } else {
            $action = 'MODIFIED SPECIFIC GROUP';
            $event = 'Successful modification of specific group ' . $name . ' data .';
            auditLogger($action, $event);

            echo 'Changes Successfuly saved!';
        }
    }
}

function populateAppProductGeneral() {
    $con = connect();
    $sql = "select * from `majorCategory` where `status`=1 order by `majorId` asc";
    $name = '';
    $result = $con->query($sql);
    $rows = $result->num_rows;
    $options = '<option>------GENERAL GROUP------</option>';
    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $name = $result->fetch_assoc()['majorName'];
        $options = $options . '<option>' . $name . '</option>';
    }
    echo $options;
}

function populateAppProductCategory($name) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {


        $sql2 = "SELECT category.catname
                 from category
                 inner join majorcategory
                 on category.majorid = majorcategory.majorid
                 where
                 majorcategory.status=1 AND majorcategory.majorName='$name' AND category.status=1
                ";
        $result2 = $con->query($sql2);
        $rows2 = $result2->num_rows;
        $opt = '<option>------CATEGORY GROUP------</option>';
        $dat = '';
        if ($rows2 === 0) {
            echo 'nothing';
        } else {
            for ($a = 0; $a < $rows2; $a++) {
                $result2->data_seek($a);
                $dat = $result2->fetch_assoc()['catname'];
                $opt = $opt . '<option>' . $dat . '</option>';
            }
            echo $opt;
        }
    }
}

function populateAppProductSpecific($name) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {

        $sqlGetMajorId = "SELECT minorcategory.minorname
                        FROM minorcategory
                        INNER JOIN category ON category.catid = minorcategory.catid
                        INNER JOIN majorcategory ON majorcategory.majorId = category.majorid
                        WHERE majorcategory.status=1 AND category.status=1 AND category.catname = '$name' AND minorcategory.status=1";
        $resultmajor = $con->query($sqlGetMajorId);
        $rowsMajor = $resultmajor->num_rows;

        $opt = '<option>------SPECIFIC GROUP------</option>';
        $dat = '';
        if ($rowsMajor === 0) {
            echo 'nothing';
        } else {
            for ($a = 0; $a < $rowsMajor; $a++) {
                $resultmajor->data_seek($a);
                $dat = $resultmajor->fetch_assoc()['minorname'];
                $opt = $opt . '<option>' . $dat . '</option>';
            }
            echo $opt;
        }
    }
}

function populateAppProductSpecificEdit($name) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {

        if ($name === 'ALL') {
            $sqlGetMajorId = "SELECT minorcategory.minorname
                        FROM minorcategory
                        INNER JOIN category ON category.catid = minorcategory.catid
                        INNER JOIN majorcategory ON majorcategory.majorId = category.majorid
                        WHERE majorcategory.status=1 AND category.status=1 AND minorcategory.status=1";
        } else {
            $sqlGetMajorId = "SELECT minorcategory.minorname
                        FROM minorcategory
                        INNER JOIN category ON category.catid = minorcategory.catid
                        INNER JOIN majorcategory ON majorcategory.majorId = category.majorid
                        WHERE majorcategory.status=1 AND category.status=1 AND category.catname = '$name' AND minorcategory.status=1";
        }
        $resultmajor = $con->query($sqlGetMajorId);
        $rowsMajor = $resultmajor->num_rows;

        $opt = '<option>---select group---</option><option>ALL</option>';
        $dat = '';
        if ($rowsMajor === 0) {
            echo '<option>---select group---</option>';
        } else {
            for ($a = 0; $a < $rowsMajor; $a++) {
                $resultmajor->data_seek($a);
                $dat = $resultmajor->fetch_assoc()['minorname'];
                $opt = $opt . '<option>' . $dat . '</option>';
            }
            echo $opt;
        }
    }
}

function addBrandGroup($name, $general, $pic) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sqlgetMaorId = "
                                select * from majorcategory where majorname='$general';
                            ";
        $resultGet = $con->query($sqlgetMaorId);
        $majorId = '';
        $rowsMajor = $resultGet->num_rows;
        for ($a = 0; $a < $rowsMajor; $a++) {
            $resultGet->data_seek($a);
            $majorId = $resultGet->fetch_assoc()['majorId'];
        }
        //echo $majorId;
        $sqlcheck = "select brand.brandName from brand
                    inner join majorCategory
                    on brand.majorId=majorCategory.majorId
                    where majorcategory.status=1 AND majorcategory.majorid=$majorId AND brand.brandname='$name';
                ";
        $resultcheck = $con->query($sqlcheck);
        $rowscheck = $resultcheck->num_rows;
        if ($rowscheck === 0) {
            //none found;
            $keyname = $majorId . $name;
            $sqladdBrand = "INSERT INTO `brand` ( `majorId`, `brandName`, `status`, `keyName`, `brandPic`) "
                    . "VALUES ( $majorId, '$name', 0, '$keyname','$pic');";
            $con->query($sqladdBrand);
            if ($con->error) {

                echo '<p class="text-danger">Brand group <strong>' . $name . '</strong>'
                . ' Was not added for Group <strong>' . $general . '</strong>.! '
                . 'Check internet connection then try again</p>';
            } else {
                $action = 'ADDED NEW BRAND GROUP';
                $event = 'Successful addition of brand group ' . $name . '.';
                auditLogger($action, $event);
                echo '<p>brand group <strong>' . $name . '</strong> successfuly added for Group <strong>' . $general . '</strong>!</p>';
            }
        } else {
            echo '<p class="text-danger">Brand name <strong>' . $name . '</strong> already exists for Group <strong>' . $general . '</strong>!</p>';
        }
    }
}

function filterBrand($status, $general) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "
                SELECT majorcategory.majorname, brand.brandname, brand.status, brand.brandid
                from brand
                inner join majorcategory
                on brand.majorid=majorcategory.majorid
                where
                majorcategory.status = 1
                ";
        if ($status === 'ALL' && $general === 'ALL') {
            $sql = $sql . " AND brand.status=0 OR brand.status=1;";
        } else if ($status === 'ACTIVE' && $general === 'ALL') {
            $sql = $sql . " AND brand.status=1";
        } else if ($status === 'INACTIVE' && $general === 'ALL') {
            $sql = $sql . " AND brand.status=0";
        } else if ($status === 'ALL') {
            $sql = $sql . " AND majorcategory.majorname='$general'";
        } else if ($status === 'ACTIVE') {
            $sql = $sql . " AND majorcategory.majorname='$general' AND brand.status=1";
        } else if ($status === 'INACTIVE') {
            $sql = $sql . " AND majorcategory.majorname='$general' AND brand.status=0";
        }

        $mname = '';
        $bname = '';
        $status = '';
        $stat = '';
        $id = '';
        $con = connect();
        if ($con === 'Connect Error') {
            echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
        } else {
            $result = $con->query($sql);
            if ($con->error) {
                //error found
                echo '<p class="text-danger">Could not load Data, Please check your internet connection then try again!</p>';
            } else {
                //no error found.
                for ($a = 0; $a < $result->num_rows; $a++) {
                    $result->data_seek($a);
                    $mname = $result->fetch_assoc()['majorname'];

                    $result->data_seek($a);
                    $bname = $result->fetch_assoc()['brandname'];

                    $result->data_seek($a);
                    $status = $result->fetch_assoc()['status'];
                    if ($status === '0') {
                        $stat = 'Not Active';
                    } else {
                        $stat = 'Active';
                    }

                    $result->data_seek($a);
                    $id = $result->fetch_assoc()['brandid'];

                    $tr = $tr . '<tr class="text-uppercase">  '
                            . '<td>' . ($a + 1) . '</td>'
                            . '<td>' . $mname . '</td> '
                            . '<td>' . $bname . '</td> '
                            . '<td>' . $stat . '</td> '
                            . '<td>'
                            . '<button class="btn btn-warning" type="button" value="' . $id . '" onclick="populateBrandData(this.value)">'
                            . '<i class="fa fa-edit"></i> Edit...'
                            . '</button>'
                            . '</td> '
                            . '</tr>';
                }
                echo $tr;
            }
        }
    }
}

function populateBrandData($id) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "
                SELECT majorcategory.majorname, brand.brandname, brand.status, brand.brandid, brand.brandPic
                from brand
                inner join majorcategory
                on brand.majorid=majorcategory.majorid
                where
                majorcategory.status = 1 AND brand.brandid=$id
                ";
        $mname = '';
        $bname = '';
        $status = '';
        $pic = '';
        $result = $con->query($sql);
        if ($con->error) {
            //error found
            echo '<p class="text-danger">Could not load Data, Please check your internet connection then try again!</p>';
        } else {
            //no error found.
            for ($a = 0; $a < $result->num_rows; $a++) {
                $result->data_seek($a);
                $mname = $result->fetch_assoc()['majorname'];

                $result->data_seek($a);
                $bname = $result->fetch_assoc()['brandname'];

                $result->data_seek($a);
                $status = $result->fetch_assoc()['status'];

                $result->data_seek($a);
                $pic = $result->fetch_assoc()['brandPic'];
            }
            echo '^' . $mname . '~' . $bname . '*' . $status . '{' . $pic . '}';
        }
    }
}

function updateBandDataSql($id, $brand, $status) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "
                UPDATE brand set `brandname`='$brand', `status`=$status
                    where
                    `brandid` = $id
                ";
        $con->query($sql);
        if ($con->error) {
            //error found
            echo '<p class="text-danger">Could save changes, Please check your internet connection then try again!</p>';
        } else {
            $action = 'MODIFIED BRAND GROUP';
            $event = 'Successful modification of brand group ' . $brand . '.';
            auditLogger($action, $event);

            echo 'Changes Successfuly saved!';
        }
    }
}

function updateBandDataSqlWithImage($id, $brand, $status, $logo) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "
                UPDATE brand set `brandname`='$brand', `status`=$status , `brandPic`='$logo'
                    where
                    `brandid` = $id
                ";
        $con->query($sql);
        if ($con->error) {
            //error found
            echo '<p class="text-danger">Could save changes, Please check your internet connection then try again!</p>';
        } else {
            $action = 'MODIFIED BRAND GROUP';
            $event = 'Successful modification of brand group ' . $brand . '.';
            auditLogger($action, $event);

            echo 'Changes Successfuly saved!';
        }
    }
}

function populateAppProductBrand($name) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "
                SELECT brand.brandname
                 from brand
                 inner join majorcategory
                 on brand.majorid=majorcategory.majorid
                 where
                 majorcategory.majorname = '$name' and majorcategory.status=1
                ";

        $opt = '<option>------SET BRAND------</option>';
        $result = $con->query($sql);
        $dat = '';
        $rows = $result->num_rows;
        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $dat = $result->fetch_assoc()['brandname'];
            $opt = $opt . '<option>' . $dat . '</option>';
        }
        echo $opt;
    }
}

function addProductAddSql($specific, $name, $price, $mprice, $image, $brand, $status) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        //1:get minorid and brandid
        $brandid = 0;
        if ($brand === 'NONE') {
            $brandid = 0;
        } else {
            $sql1 = "select brand.brandId FROM brand WHERE brand.brandName='$brand'";
            $result1 = $con->query($sql1);
            for ($a = 0; $a < $result1->num_rows; $a++) {
                $result1->data_seek($a);
                $brandid = $result1->fetch_assoc()['brandId'];
            }
        }
        $minorid = 0;
        $sql2 = "SELECT `minorId` FROM `minorcategory` WHERE `minorName`='$specific'";
        $result2 = $con->query($sql2);
        for ($a = 0; $a < $result2->num_rows; $a++) {
            $result2->data_seek($a);
            $minorid = $result2->fetch_assoc()['minorId'];
        }

        //2:edd items to db.
        $sqlinsert = "
                        INSERT INTO
                        items( `minorId`, `itemName`, `itemPic`, `newPrice`, `oldPrice`, `brandId`, `itemQuantity`, `itemRating`, `status`)
                        VALUES ($minorid  , '$name'     , '$image'    ,'$price'    ,'$mprice'     ,$brandid, '0','0',$status);
                    ";
        //3:check if the name  is alredy there
        $sqlcheck = "SELECT * FROM `items` WHERE `itemName` LIKE '$name';";
        $resultcheck = $con->query($sqlcheck);
        $rowscheck = $resultcheck->num_rows;

        if ($rowscheck === 0) {
            $con->query($sqlinsert);
            if ($con->error) {
                echo '<p class="text-danger">Product <strong>' . $name . '</strong> was not added! Please try again. if this error ocuurs again contact Admin</p>';
            } else {
                $action = 'ADDED NEW PRODUCT';
                $event = 'Successful addition of product ' . $name . '.';
                auditLogger($action, $event);

                echo '<p class="text-success">Product <strong>' . $name . '</strong> successfuly added!</p>';
            }
        } else {
            echo '<p class="text-danger">Product <strong>' . $name . '</strong> already exists<p>';
        }
    }
}

function populateTableEditProduct($general, $category, $specific, $status) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {

        $sql = "
            SELECT
            items.itemId, majorcategory.majorName,
            category.catName,minorcategory.minorName,
            items.itemName,brand.brandName,items.status,items.brandId
            FROM items
            INNER JOIN brand ON items.brandId=brand.brandId
            INNER JOIN minorcategory ON items.minorId = minorcategory.minorId
            INNER JOIN category ON minorcategory.catId = category.catId
            INNER JOIN majorcategory ON category.majorId = majorcategory.majorId
                ";

        if ($status === 'ALL' && $general === 'ALL' && $category === 'ALL' && $specific === 'ALL') {
            
        } else if ($status === 'ACTIVE' && $general === 'ALL' && $category === 'ALL' && $specific === 'ALL') {
            $sql = $sql . " and items.status=1";
        } else if ($status === 'INACTIVE' && $general === 'ALL' && $category === 'ALL' && $specific === 'ALL') {
            $sql = $sql . " and items.status=0";
        } else if ($status === 'ALL' && $category === 'ALL' && $specific === 'ALL') {
            $sql = $sql . " and majorcategory.majorname='$general'";
        } else if ($status === 'ACTIVE' && $category === 'ALL' && $specific === 'ALL') {
            $sql = $sql . " and majorcategory.majorname='$general' AND items.status=1";
        } else if ($status === 'INACTIVE' && $category === 'ALL' && $specific === 'ALL') {
            $sql = $sql . " and majorcategory.majorname='$general' AND items.status=0";
        } else if ($status === 'ALL' && $specific === 'ALL') {
            $sql = $sql . " and majorcategory.majorname='$general' AND category.catname='$category'";
        } else if ($status === 'ACTIVE' && $specific === 'ALL') {
            $sql = $sql . " and majorcategory.majorname='$general' AND category.catname='$category' AND items.status=1";
        } else if ($status === 'INACTIVE' && $specific === 'ALL') {
            $sql = $sql . " and majorcategory.majorname='$general' AND category.catname='$category' AND items.status=0";
        } else if ($status === 'ALL') {
            $sql = $sql . " and majorcategory.majorname='$general' AND category.catname='$category' AND minorcategory.minorname='$specific'";
        } else if ($status === 'ACTIVE') {
            $sql = $sql . " and majorcategory.majorname='$general' AND category.catname='$category' AND minorcategory.minorname='$specific' AND items.status=1";
        } else if ($status === 'INACTIVE') {
            $sql = $sql . " and majorcategory.majorname='$general' AND category.catname='$category' AND minorcategory.minorname='$specific' AND items.status=0";
        }
//
        $itemid = '';
        $mname = '';
        $cname = '';
        $sname = '';
        $iname = '';
        $brand = '';
        $brandid = '';
        $status = '';
        $stat = 'Not Active';

        $tr = "";

        $result = $con->query($sql);
        $rows = $result->num_rows;
        if ($con->error) {
            echo '<p class="text-danger">Could not load data! Please try again. if this error ocuurs again contact Admin</p>' . $sql;
        } else {
            for ($a = 0; $a < $rows; $a++) {

                $result->data_seek($a);
                $itemid = $result->fetch_assoc()['itemId'];

                $result->data_seek($a);
                $mname = $result->fetch_assoc()['majorName'];

                $result->data_seek($a);
                $cname = $result->fetch_assoc()['catName'];

                $result->data_seek($a);
                $sname = $result->fetch_assoc()['minorName'];

                $result->data_seek($a);
                $iname = $result->fetch_assoc()['itemName'];

                $result->data_seek($a);
                $brandid = $result->fetch_assoc()['brandId'];


                $result->data_seek($a);
                $brand = $result->fetch_assoc()['brandName'];


                $result->data_seek($a);
                $status = $result->fetch_assoc()['status'];

                if ($status === '0') {
                    $stat = 'Not Active';
                } else {
                    $stat = 'Active';
                }

                $tr = $tr . '
                        <tr class="text-uppercase">
                        <td>' . ($a + 1) . '</td>
                        <td>' . $mname . '</td>
                        <td>' . $cname . '</td>
                        <td>' . $sname . '</td>
                        <td>' . $iname . '</td>
                        <td>' . $brand . '</td>
                        <td>' . $stat . '</td>
                            <td>
                            <button
                            class="btn btn-warning" value="' . $itemid . '"onclick="editProductModal1(this.value)"> <i class="fa fa-edit"></i> Edit
                            </button>
                        </td>
                        </tr>';
            }
            echo $tr;
        }
    }
}

function getProductData($id) {

    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {

        $sql = "SELECT 
        majorcategory.majorName, category.catName, minorcategory.minorName, brand.brandName,
        items.itemName, items.newPrice,items.oldPrice,items.status, items.itemPic 
        from items 
        INNER JOIN 
        minorcategory ON minorcategory.minorId=items.minorId
        INNER JOIN 
        brand on brand.brandId = items.brandId
        INNER JOIN
        category ON minorcategory.catId = category.catId 
        INNER JOIN
        majorcategory ON majorcategory.majorId = category.majorId
        WHERE
    items.itemId=$id;";


        $mname = '';
        $cname = '';
        $sname = '';
        $iname = '';
        $price = '';
        $mprice = '';
        $brand = '';
        $status = '';
        $itempic = '';


        $tr = "";

        $result = $con->query($sql);
        $rows = $result->num_rows;
        if ($con->error) {
            echo '<p class="text-danger">Could not load data! Please try again. if this error ocuurs again contact Admin</p>' . $con->error;
        } else {
            for ($a = 0; $a < $rows; $a++) {

                $result->data_seek($a);
                $mname = $result->fetch_assoc()['majorName'];

                $result->data_seek($a);
                $cname = $result->fetch_assoc()['catName'];

                $result->data_seek($a);
                $sname = $result->fetch_assoc()['minorName'];

                $result->data_seek($a);
                $iname = $result->fetch_assoc()['itemName'];

                $result->data_seek($a);
                $price = $result->fetch_assoc()['newPrice'];

                $result->data_seek($a);
                $mprice = $result->fetch_assoc()['oldPrice'];

                $result->data_seek($a);
                $brand = $result->fetch_assoc()['brandName'];

                $result->data_seek($a);
                $status = $result->fetch_assoc()['status'];

                $result->data_seek($a);
                $itempic = $result->fetch_assoc()['itemPic'];
            }
            echo '~' . $mname . '*' . $cname . '/' . $sname . '+' . $iname . '_' . $price . '^' . $status . '#' . $itempic . '{' . $mprice . '}' . $brand . ']';
        }
    }
}

function updateProductDetailsSql($id, $name, $price, $mprice, $stat) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "update items set itemname='$name',status=$stat,newPrice='$price',oldPrice='$mprice' where itemid=$id";
        $con->query($sql);
//        
        if ($con->error) {
            echo '<p class="text-danger">Updates were not saved! Please try again. if this error occurs again contact Admin</p>';
        } else {
            $action = 'MODIFIED PRODUCT ' . $name;
            $event = 'Successful modificaion of product ' . $name . '. data';
            auditLogger($action, $event);

            echo 'Updates successfuly saved!';
        }
//        echo $sql;
    }
}

function loadMorePicStuff($id) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "select items.itemName,items.itemPic from items WHERE items.itemId=$id";
        $result = $con->query($sql);
        $rows = $result->num_rows;
        $name = '';
        $pic = '';
        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $name = $result->fetch_assoc()['itemName'];
            $result->data_seek($a);
            $pic = $result->fetch_assoc()['itemPic'];
        }

        echo '^' . $name . '~' . $pic;
    }
}

function addMorePicSql($id, $img, $name) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "INSERT INTO itemimages(itemId,imageName) VALUES ($id,'$img');";
        $con->query($sql);
        if ($con->error) {
            echo '<p class="text-danger">New Image not uploaded! Please try again. if this error occurs again contact Admin</p>';
        } else {
            $action = 'ADDED A PICTURE FOR PRODUCT ' . $name;
            $event = 'Successful additon of a picture for product ' . $name . '. ';
            auditLogger($action, $event);
            echo '<p class="mydef">New image successfuly added!</p>';
        }
    }
}

function loadPicList($id) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "SELECT items.itemPic from items where items.itemId = $id  UNION  SELECT itemimages.imageName from itemimages WHERE itemimages.itemId =$id";
        $result = $con->query($sql);
        $rows = $result->num_rows;
        $imagename = '';
        $data = '';
        $counter = '';
        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $counter = $result->fetch_assoc()['itemPic'];
            if ($a === 0) {
                $data = $counter;
                $imagename = $imagename . '<button class="list-group-item" value="' . $counter . '" '
                        . 'onclick="popImageProduct(this.value+\'^\'+this.innerHTML)"> <i class="fa fa-image"></i> Picture ' . ($a + 1) . '</button>';
            } else {
                $imagename = $imagename . '<button class="list-group-item" value="' . $counter . '" '
                        . 'onclick="popImageProduct(this.value+\'^\'+this.innerHTML)"><i class="fa fa-image"></i> Picture ' . ($a + 1) . '</button>';
            }
        }
        echo '<div class="list-group">' . $imagename . '</div>' . '~' . $data;
//     echo $data;
    }
}

function setWebPicFunction($id, $imagename, $name) {

//        echo $id.'_'.$imagename.'<br>From s2';
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
//        
        $sql1 = "SELECT items.itemPic from items WHERE items.itemId=$id";
        $picItems = '';
        $result1 = $con->query($sql1);
        for ($a = 0; $a < $result1->num_rows; $a++) {
            $result1->data_seek($a);
            $picItems = $result1->fetch_assoc()['itemPic'];
        }
//        echo $picItems;
        if ($picItems === $imagename) {
            echo 'Update successful!!!';
//            echo 'identical';
        } else {
//            echo 'not identical';
            $sql2 = "UPDATE itemimages set itemimages.imageName='$picItems' WHERE itemimages.imageName='$imagename' AND itemimages.itemId=$id";
            $sql3 = "UPDATE items set items.itemPic = '$imagename' where items.itemId=$id";
            $con->query($sql2);
            if ($con->error) {
                echo $con->error;
            } else {
                $con->query($sql3);
                if ($con->error) {
                    echo $con->error;
                } else {
                    $action = 'SET WEB PICTURE FOR PRODUCT ' . $name;
                    $event = 'Successful setting of a web picture for product ' . $name . '. ';
                    auditLogger($action, $event);
                    echo 'Update successful!!!';
                }
            }
        }
    }
}

function loadCarousel($id) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "SELECT items.itemPic from items where items.itemId = $id  UNION  SELECT itemimages.imageName from itemimages WHERE itemimages.itemId =$id";
        $result = $con->query($sql);
        $rows = $result->num_rows;
        $counter = '';
//        //Big Div
        $top = '<div class="carousel slide" id="myCarousel1" data-ride="carousel">';
        //dot part
        $ol_start = '<ol class="carousel-indicators">';
        $li = '';
        $ol_end = '</ol>';
//        //content
        $data_start = '<div class="carousel-inner" role="listbox">';
        $items = '';
        $data_end = '</div>';
        //arrows
        $arr = '<a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
       
    </a>
    <a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    </a>';
        $end = '</div>';
//       
        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $counter = $result->fetch_assoc()['itemPic'];
            if ($a === 0) {
                $li = $li . '<li data-target="#myCarousel1" data-slide-to="' . $a . '" class="active"></li>';
                $items = $items . '<div class="item active"><img src="../productImages/' . $counter . '"  alt="Garlado Product"/></div>';
            } else {
                $li = $li . '<li data-target="#myCarousel1" data-slide-to="' . $a . '"></li>';
                $items = $items . '<div class="item"><img src="../productImages/' . $counter . '" alt=""/></div>';
            }
        }
        $dat = $top . $ol_start . $li . $ol_end . $data_start . $items . $data_end . $arr . $end;
        echo $dat;
    }
}

function deleteWebPic($id, $name, $pname) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql1 = "SELECT items.itemPic from items WHERE items.itemPic='$name'";
        $result1 = $con->query($sql1);
        $rows1 = $result1->num_rows;

//        exists in table items
        if ($rows !== 0) {
            $sql2 = "SELECT itemimages.imageName from itemimages where itemid=$id";
            $namefromimages = '';
            $result2 = $con->query($sql2);
            for ($a = 0; $a < $result2->num_rows; $a++) {
                if ($a === 0) {
                    $result2->data_seek($a);
                    $namefromimages = $result2->fetch_assoc()['imageName'];
                }
            }
//            echo $namefromimages;
            if ($namefromimages === '') {
                echo '<p>This is the last image. We cannot Delete this image.</p>';
            } else {
                $sql3 = "UPDATE items set items.itemPic = '$namefromimages' where items.itemId=$id";
                $con->query($sql3);
                if ($con->error) {
                    echo $con->error;
                } else {
                    $sql4 = "DELETE FROM itemimages where imageName='$name';";
                    $con->query($sql4);
                    if ($con->error) {
                        echo $con->error;
                    } else {
                        $action = 'DELETED A PICTURE FOR PRODUCT ' . $pname;
                        $event = 'Successful deletion of a picture for product ' . $pname . '.';
                        auditLogger($action, $event);
                        echo 'Picture Successfuly Deleted!!';
                    }
                }
            }
        }
//        //doesnot exist in table 
        else {
            $sql5 = "DELETE FROM itemimages where itemimages.imageName='$name';";
            $con->query($sql5);
            if ($con->error) {
                echo $con->error;
            } else {
                $action = 'DELETED A PICTURE FOR PRODUCT ' . $pname;
                $event = 'Successful deletion of a picture for product ' . $pname . '.';
                auditLogger($action, $event);
                echo 'Picture Successfuly Deleted!!';
            }
        }
    }
}

function addCompFeatureSql($id, $ram, $rom, $processor, $os, $display, $sim, $productname) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql1 = "select * from featurescomps where itemid=$id";
        $result1 = $con->query($sql1);
        $rows = $result1->num_rows;
        if ($rows === 0) {
            $sql = "INSERT INTO `featurescomps`(`itemId`, `ram`, `rom`, `displaySize`, `operatingSystem`, `processor`, `simslot`)
                                        VALUES ($id,'$ram','$rom','$display','$os','$processor',$sim);";
            $con->query($sql);
            if ($con->error) {
                echo $con->error;
            } else {
                $action = 'ADDED FEATURES FOR PRODUCT ' . $productname;
                $event = 'Successful addition of features for product ' . $productname . '.';
                auditLogger($action, $event);
                echo 'Features Successfuly Saved!!';
            }
        } else {
            echo '<p class="text-danger">This item has described features.<br> Click on Non-compFeatures to add more features.</p>';
        }
    }
}

function AddNoCompFeature($id) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "SELECT items.itemPic FROM items WHERE items.itemId=$id";
        $result = $con->query($sql);
        $pic = '';
        $rows = $result->num_rows;
        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $pic = $result->fetch_assoc()['itemPic'];
        }
        echo '<img src="../productImages/' . $pic . '" class="productImg" alt=""/>';
    }
}

function AddcaddNCompFeatureSql($id, $prop1, $prop2, $productname) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "INSERT INTO `itemfeatures`(`itemId`, `keyFeatures`) "
                . "VALUES ($id,'$prop1');";
        $sql2 = "INSERT INTO `itemfeatures`(`itemId`, `keyFeatures`) VALUES ($id,'$prop2');";
        $con->query($sql);
        if ($con->error) {
            echo $con->error;
        } else {
            $con->query($sql2);
            if ($con->error) {
                echo $con->error;
            } else {
                $action = 'ADDED DESCRIPTION FOR PRODUCT ' . $productname;
                $event = 'Successful addition of descripton for product ' . $productname . '.';
                auditLogger($action, $event);
                echo 'Description successfuly added!';
            }
        }
    }
}

function ViewNCompFeature($id) {
    $con = connect();
    $corepresent = '';
    $despreseent = '';
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        //1.check if item has data in core table
        $sql1 = "SELECT * FROM `featurescomps` WHERE featurescomps.itemId=$id";
        $result1 = $con->query($sql1);
        $rows1 = $result1->num_rows;
        $ram = '';
        $rom = '';
        $display = '';
        $os = '';
        $cpu = '';
        $sim = '';
        $coredat = '';
        $idComp = '';
        //2.if core table data is:
        //2.1 true,fetch it,set corepresent = 1

        if ($rows1 > 0) {
            $corepresent = '1';
            for ($a = 0; $a < $rows1; $a++) {
                $result1->data_seek($a);
                $ram = $result1->fetch_assoc()['ram'];

                $result1->data_seek($a);
                $rom = $result1->fetch_assoc()['rom'];

                $result1->data_seek($a);
                $display = $result1->fetch_assoc()['displaySize'];

                $result1->data_seek($a);
                $os = $result1->fetch_assoc()['operatingSystem'];

                $result1->data_seek($a);
                $cpu = $result1->fetch_assoc()['processor'];

                $result1->data_seek($a);
                $sim = $result1->fetch_assoc()['simslot'];

                $result1->data_seek($a);
                $idComp = $result1->fetch_assoc()['featureId'];
            }
            $coredat = '<dl class="text-uppercase">
                    <div class="row">
                        <div class="col-sm-4">
                            <dt>RAM</dt><dd>' . $ram . '</dd>
                            <dt>HDD</dt><dd>' . $rom . '</dd>
                            <dt>CPU</dt><dd>' . $cpu . '</dd>
                        </div>
                        <div class="col-sm-8">
                            <dt>Operating System</dt><dd>' . $os . '</dd>
                            <dt>Display</dt><dd>' . $display . '</dd>
                            <dt>Sim Slots</dt><dd>' . $sim . '</dd>
                        </div>
                        <div class="text-center">
                            <button value="' . $idComp . '" class="btn btn-sm btn-warning" onclick="editCoreDataClick(this.value)"><I class="fa fa-edit"></I> Edit</button>
                            <button value="' . $idComp . '" class="btn btn-sm btn-danger" onclick="deleteCFeature(this.value)"><I class="fa fa-trash-o"></I> Delete</button>
                        </div>
                    </div>
                </dl>';
        }

        //2.2 false,set corepresent = 0
        else {
            $corepresent = '0';
        }
        //3.check if item has descriptions
        $sql2 = "SELECT * FROM `itemfeatures` WHERE itemfeatures.itemId=$id";
        $result2 = $con->query($sql2);
        $rows2 = $result2->num_rows;
        $idFeature = '';
        $prop = '';
        $desdat = '';
        //3.1 true, fetch it,set despresent = 1
        if ($rows2 > 0) {
            $despreseent = '1';
            for ($a = 0; $a < $rows2; $a++) {
                $result2->data_seek($a);
                $prop = $result2->fetch_assoc()['keyFeatures'];
                $result2->data_seek($a);
                $idFeature = $result2->fetch_assoc()['featureId'];
                $desdat = $desdat . '<tr class="text-uppercase">
                              <td>
                              ' . $prop . '
                              </td>
                              <td>
                                <button type="button"
                                class="btn btn-danger"
                                value="' . $idFeature . '"
                                onclick="deleteNFeature(this.value)">
                                   <i class="fa fa-trash-o"></i>
                                    Delete
                                </button>
                              </td>
                              </tr>';
            }
        }
        //3.2 false, set despresent = 0
        else {
            $despreseent = '0';
        }
        //4. getImage
        $sql3 = 'SELECT items.itemPic,items.itemName FROM items WHERE items.itemId=' . $id;
        $result3 = $con->query($sql3);
        $img = '';
        $name = '';
        for ($a = 0; $a < $result3->num_rows; $a++) {
            $result3->data_seek($a);
            $img = $result3->fetch_assoc()['itemPic'];
            $result3->data_seek($a);
            $name = $result3->fetch_assoc()['itemName'];
        }

        echo '~' . $corepresent . '^' . $despreseent . '#' . $coredat . '*' . $desdat . '+<img class="productImg" src="../productImages/' . $img . '"  alt=""/>_' . $name;
        //5 echo all data
    }
}

function editCoreDataClick($id) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql1 = "SELECT * FROM `featurescomps` WHERE featurescomps.featureId=$id";
        $result1 = $con->query($sql1);
        $rows1 = $result1->num_rows;
        $ram = '';
        $rom = '';
        $display = '';
        $os = '';
        $cpu = '';
        $sim = '';
        $coredat = '';
        for ($a = 0; $a < $rows1; $a++) {
            $result1->data_seek($a);
            $ram = $result1->fetch_assoc()['ram'];

            $result1->data_seek($a);
            $rom = $result1->fetch_assoc()['rom'];

            $result1->data_seek($a);
            $display = $result1->fetch_assoc()['displaySize'];

            $result1->data_seek($a);
            $os = $result1->fetch_assoc()['operatingSystem'];

            $result1->data_seek($a);
            $cpu = $result1->fetch_assoc()['processor'];

            $result1->data_seek($a);
            $sim = $result1->fetch_assoc()['simslot'];
        }
        echo '~' . $ram . '!' . $rom . '#' . $display . '$' . $os . '%' . $cpu . '^' . $sim;
    }
}

function saveCoreDataClickSql($id, $ram, $rom, $cpu, $os, $display, $sim, $productname) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "  
                UPDATE `featurescomps` 
                SET                 
                `ram`='$ram',
                `rom`='$rom',
                `displaySize`='$display',
                `operatingSystem`='$os',
                `processor`='$cpu',
                `simslot`='$sim' WHERE `featureId`=$id
                ";
        $con->query($sql);
        if ($con->error) {
            echo '<p class="text-danger">Updates were not saved! Please try again. if this error occurs again contact Admin</p>';
        } else {
            $action = 'MODIFIED FEATURES FOR PRODUCT ' . $productname;
            $event = 'Successful modified key features for product ' . $productname . '.';
            auditLogger($action, $event);
            echo 'Updates successfuly saved!';
        }
    }
}

function deleteNFeature($itemId, $featureId) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        //delete the feature

        $sql1 = "DELETE FROM itemfeatures WHERE itemfeatures.featureId=$featureId";
        $con->query($sql1);
        //populate the table once more
        $sql2 = "SELECT * FROM `itemfeatures` WHERE itemfeatures.itemId=$itemId";
        $result2 = $con->query($sql2);
        $rows2 = $result2->num_rows;
        $idFeature = '';
        $prop = '';
        $rows = '0';
        $desdat = '';
        //3.1 true, fetch it,set despresent = 1
        if ($rows2 > 0) {
            $rows = '1';
            for ($a = 0; $a < $rows2; $a++) {
                $result2->data_seek($a);
                $prop = $result2->fetch_assoc()['keyFeatures'];
                $result2->data_seek($a);
                $idFeature = $result2->fetch_assoc()['featureId'];
                $desdat = $desdat . '<tr class="text-uppercase">
                              <td>
                              ' . $prop . '
                              </td>
                              <td>
                                <button type="button"
                                class="btn btn-danger"
                                value="' . $idFeature . '"
                                onclick="deleteNFeature(this.value)">
                                   <i class="fa fa-trash-o"></i>
                                    Delete
                                </button>
                              </td>
                              </tr>';
            }
        }
        echo '~' . $rows . '^' . $desdat;
    }
}

function deleteCFeature($id, $productname) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "DELETE FROM `featurescomps` WHERE featurescomps.featureId=$id";
        $con->query($sql);
        if ($con->error) {
            echo '<p class="text-danger">Core features were not deleted! Please try again. if this error occurs again contact Admin</p>';
        } else {
            $action = 'DELETED FEATURES FOR PRODUCT ' . $productname;
            $event = 'Successful deletion of features for product ' . $productname . '.';
            auditLogger($action, $event);
            echo 'Core features successfuly deleted!';
        }
    }
}

function populateTableAddStore($general, $category, $specific, $status) {
    $con = connect();
    $sql = "
           SELECT items.itemId, majorcategory.majorName, category.catName,minorcategory.minorName,
           items.itemName,items.itemQuantity FROM items 
           INNER JOIN minorcategory ON items.minorId = minorcategory.minorId 
           INNER JOIN category ON minorcategory.catId =category.catId 
           INNER JOIN majorcategory ON category.majorId = majorcategory.majorId
                ";

    if ($status === 'ALL' && $general === 'ALL' && $category === 'ALL' && $specific === 'ALL') {
        
    } else if ($status === 'ACTIVE' && $general === 'ALL' && $category === 'ALL' && $specific === 'ALL') {
        $sql = $sql . " and items.status=1";
    } else if ($status === 'ALL' && $category === 'ALL' && $specific === 'ALL') {
        $sql = $sql . " and majorcategory.majorname='$general'";
    } else if ($status === 'ACTIVE' && $category === 'ALL' && $specific === 'ALL') {
        $sql = $sql . " and majorcategory.majorname='$general' AND items.status=1";
    } else if ($status === 'ALL' && $specific === 'ALL') {
        $sql = $sql . " and majorcategory.majorname='$general' AND category.catname='$category'";
    } else if ($status === 'ACTIVE' && $specific === 'ALL') {
        $sql = $sql . " and majorcategory.majorname='$general' AND category.catname='$category' AND items.status=1";
    } else if ($status === 'ALL') {
        $sql = $sql . " and majorcategory.majorname='$general' AND category.catname='$category' AND minorcategory.minorname='$specific'";
    } else if ($status === 'ACTIVE') {
        $sql = $sql . " and majorcategory.majorname='$general' AND category.catname='$category' AND minorcategory.minorname='$specific' AND items.status=1";
    }
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {


//
        $itemid = '';
        $mname = '';
        $cname = '';
        $sname = '';
        $iname = '';
        $quantity = '';

        $tr = "";

        $result = $con->query($sql);
        $rows = $result->num_rows;
        if ($con->error) {
            echo '<p class="text-danger">Could not load data! Please try again. if this error ocuurs again contact Admin</p>' . $sql;
        } else {
            for ($a = 0; $a < $rows; $a++) {

                $result->data_seek($a);
                $itemid = $result->fetch_assoc()['itemId'];

                $result->data_seek($a);
                $mname = $result->fetch_assoc()['majorName'];

                $result->data_seek($a);
                $cname = $result->fetch_assoc()['catName'];

                $result->data_seek($a);
                $sname = $result->fetch_assoc()['minorName'];

                $result->data_seek($a);
                $iname = $result->fetch_assoc()['itemName'];


                $result->data_seek($a);
                $quantity = $result->fetch_assoc()['itemQuantity'];





                $tr = $tr . '
                        <tr class="text-uppercase">
                        <td>' . ($a + 1) . '</td>
                        <td>' . $mname . '</td>
                        <td>' . $cname . '</td>
                        <td>' . $sname . '</td>
                        <td>' . $iname . '</td>
                        <td>' . $quantity . '</td>
                     
                            <td>
                            <button
                            class="btn btn-warning" value="' . $itemid . '"onclick="popMoreStock(this.value)"><i class="fa fa-folder-open-o"></i>...
                            </button>
                        </td>
                        </tr>';
            }
            echo $tr;
        }
    }
}

function populateTableAddStoreName($name) {

    $sql = "
           SELECT items.itemId, majorcategory.majorName, category.catName,minorcategory.minorName, 
           items.itemName,items.itemQuantity FROM items 
           INNER JOIN minorcategory ON items.minorId = minorcategory.minorId 
           INNER JOIN category ON minorcategory.catId =category.catId 
           INNER JOIN majorcategory ON category.majorId = majorcategory.majorId 
           WHERE 
           majorcategory.majorName LIKE '%$name%' OR "
            . "category.catName LIKE '%$name%' OR minorcategory.minorName LIKE '/%$name%/'
                 OR items.itemName like '%$name%'
                ";
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {


//
        $itemid = '';
        $mname = '';
        $cname = '';
        $sname = '';
        $iname = '';
        $quantity = '';

        $tr = "";

        $result = $con->query($sql);
        $rows = $result->num_rows;
        if ($con->error) {
            echo '<p class="text-danger">Could not load data! Please try again. if this error ocuurs again contact Admin</p>' . $sql;
        } else {
            for ($a = 0; $a < $rows; $a++) {

                $result->data_seek($a);
                $itemid = $result->fetch_assoc()['itemId'];

                $result->data_seek($a);
                $mname = $result->fetch_assoc()['majorName'];

                $result->data_seek($a);
                $cname = $result->fetch_assoc()['catName'];

                $result->data_seek($a);
                $sname = $result->fetch_assoc()['minorName'];

                $result->data_seek($a);
                $iname = $result->fetch_assoc()['itemName'];


                $result->data_seek($a);
                $quantity = $result->fetch_assoc()['itemQuantity'];





                $tr = $tr . '
                        <tr class="text-uppercase">
                        <td>' . ($a + 1) . '</td>
                        <td>' . $mname . '</td>
                        <td>' . $cname . '</td>
                        <td>' . $sname . '</td>
                        <td>' . $iname . '</td>
                        <td>' . $quantity . '</td>
                     
                            <td>
                            <button
                            class="btn btn-warning" value="' . $itemid . '"onclick="popMoreStock(this.value)"><i class="fa fa-folder-open-o"></i>...
                            </button>
                        </td>
                        </tr>';
            }
            echo $tr;
        }
    }
}

function popMoreStock($id) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "SELECT items.itemName, items.newPrice, items.itemPic, items.itemQuantity FROM items WHERE items.itemId=$id";
        $result = $con->query($sql);
        $rows = $result->num_rows;

        $name = '';
        $price = '';
        $image = '';
        $qnty = '';

        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $name = $result->fetch_assoc()['itemName'];

            $result->data_seek($a);
            $price = $result->fetch_assoc()['newPrice'];

            $result->data_seek($a);
            $image = $result->fetch_assoc()['itemPic'];

            $result->data_seek($a);
            $qnty = $result->fetch_assoc()['itemQuantity'];
        }
        echo ' <h4 class="text-center" style="margin-top:1px;"> <strong>' . $name . '</strong></h4>
                    <div class="col-sm-8 col-sm-offset-2">
                        <div>
                            <img src="../productImages/' . $image . '" alt="" class="productImg"/>
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                               
                                    <dl>
                                        <dt>Price</dt>
                                        <dd>' . $price . '</dd>
                                        <dt>
                                            Quantity
                                        </dt>
                                        <dd>
                                           ' . $qnty . '
                                        </dd>
                                    </dl>
                                   
                                        <button value="' . $id . '" onclick="AddStockModal(this.value)"class="btn btn-sm btn-warning">
                                            Add Stock
                                        </button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
        ';
    }
}

function AddStockModalData($id) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "SELECT items.itemName, items.itemQuantity FROM items WHERE items.itemId=$id";
        $result = $con->query($sql);
        $rows = $result->num_rows;

        $name = '';
        $qnty = '';

        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $name = $result->fetch_assoc()['itemName'];

            $result->data_seek($a);
            $qnty = $result->fetch_assoc()['itemQuantity'];
        }
        echo '~' . $name . '@' . $qnty;
    }
}

function saveStockSql($id, $current, $stock) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        //update stock
        $sqlUpdateStock = "UPDATE items set items.itemQuantity = '$current' WHERE items.itemId=$id;";
        $con->query($sqlUpdateStock);
        //get user id

        $mail = $_SESSION['marvel'];
        $sql = "select admins.adminId FROM admins WHERE admins.email = '$mail';";
        $adminId = '';
        $result = $con->query($sql);
        for ($a = 0; $a < $result->num_rows; $a++) {
            $result->data_seek($a);
            $adminId = $result->fetch_assoc()['adminId'];
        }


        if ($con->error) {
            echo $con->error;
        } else {


            $time = getTime('time');
            $date = getTime('date');
            $month = getTime('month');
            $year = getTime('year');
            $action = '';
            $event = '';
            $fb = '';
            if ($stock > 0) {
                $action = 'STOCK ADDITION';
                $event = 'Added ' . $stock . ' More items';
                $fb = $stock . ' items Successfuly added!';
            } else {
                $action = 'STOCK REDUCTION';
                $event = 'Removed ' . ($current - ($current + $stock)) . ' items';
                $fb = $stock . ' items Successfuly removed!';
            }
            //insert into itemLog
            $sqlSaveEvent = "INSERT INTO `itemlog`"
                    . "(adminId, itemId, time, date, month, year, action, event) "
                    . "VALUES ($adminId,$id,'$time','$date','$month','$year','$action','$event');";
            $con->query($sqlSaveEvent);

            if ($con->error) {
                echo $con->error . '<br>' . $sqlSaveEvent . '<br>User:' . $adminId . '<br>Item:' . $id . '<br>';
            } else {
                echo $fb;
            }
        }
    }
}

function getviewStoreDefaults() {
    $con = connect();

    //get total gen,cat,spec grps
    //$general
    $sqlGen = "SELECT DISTINCT COUNT(majorcategory.majorId) as GenTot FROM majorcategory";
    $GenTot = '';
    $r1 = $con->query($sqlGen);
    for ($a = 0; $a < $r1->num_rows; $a++) {
        $r1->data_seek($a);
        $GenTot = $r1->fetch_assoc()['GenTot'];
    }
    //$cat
    $sqlCat = "SELECT DISTINCT COUNT(category.catId) as CatTot FROM category;";
    $CatTot = '';
    $r2 = $con->query($sqlCat);
    for ($a = 0; $a < $r2->num_rows; $a++) {
        $r2->data_seek($a);
        $CatTot = $r2->fetch_assoc()['CatTot'];
    }
    //$spec
    $sqlSpec = "SELECT DISTINCT COUNT(minorcategory.minorId) as SpecTot FROM minorcategory";
    $SpecTot = '';
    $r3 = $con->query($sqlSpec);
    for ($a = 0; $a < $r3->num_rows; $a++) {
        $r3->data_seek($a);
        $SpecTot = $r3->fetch_assoc()['SpecTot'];
    }
    //get sum total
    $sqlTot = "SELECT items.newPrice as a,items.itemQuantity as b from items";

    $TOT = '';
    $ar = '';
    $b = '';
    $r4 = $con->query($sqlTot);
    for ($a = 0; $a < $r4->num_rows; $a++) {
        $r4->data_seek($a);
        $ar = $r4->fetch_assoc()['a'];
        $r4->data_seek($a);
        $b = $r4->fetch_assoc()['b'];
        $TOT = $TOT + ($ar * $b);
    }



    echo '~' . $GenTot . '!' . $CatTot . '|' . $SpecTot . '#' . $TOT . '$';
}

function veiwMyStoreGeneral() {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        //get sql data of each table item
        $sql1 = "SELECT majorcategory.majorName as A, COUNT(category.catId) as B from majorcategory
                LEFT JOIN category
                on majorcategory.majorId = category.majorId
                GROUP BY majorcategory.majorName ";
        //get no of groups
        $result = $con->query($sql1);
        $rows = $result->num_rows;
        $tr = '';
        $d1 = '';
        $arrname = '';
        $arrdata = '';
        $d2 = 0;
        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $d1 = $result->fetch_assoc()['A'];
            $np = 0;
            $qt = 0;
            $sql2 = "SELECT majorcategory.majorName, items.itemName, items.newPrice, items.itemQuantity
                    from majorcategory 
                    LEFT join category on category.majorId = majorcategory.majorId
                    LEFT JOIN minorcategory on minorcategory.catId = category.catId
                    LEFT JOIN items on items.minorId = minorcategory.minorId 
                    WHERE majorcategory.majorName LIKE '%$d1%'";
            $result2 = $con->query($sql2);
            for ($b = 0; $b < $result2->num_rows; $b++) {
                $result2->data_seek($b);
                $np = $result2->fetch_assoc()['newPrice'];
                $result2->data_seek($b);
                $qt = $result2->fetch_assoc()['itemQuantity'];
//               if(empty($np)===false && empty($qt)===false){
                $d2 = $d2 + ($np * $qt);
//               }
            }
            $tr = $tr . '<tr> <td>' . ($a + 1) . '</td> <td>' . $d1 . '</td> <td>' . moneyFormatter($d2) . '</td> </tr>';
            $arrname = $arrname . ($a + 1) . '*' . $d1 . '#';
            $arrdata = $arrdata . ($a + 1) . '*' . $d2 . '#';



            $d2 = 0;
        }
        //get Total
        $sqlTot = "SELECT items.newPrice as a,items.itemQuantity as b from items";
//         
        $TOT = '';
        $ar = '';
        $b = '';
        $r4 = $con->query($sqlTot);
        for ($a = 0; $a < $r4->num_rows; $a++) {
            $r4->data_seek($a);
            $ar = $r4->fetch_assoc()['a'];
            $r4->data_seek($a);
            $b = $r4->fetch_assoc()['b'];
            $TOT = $TOT + ($ar * $b);
        }




        echo '~' . $tr . '@' . $TOT . '$' . $rows . '%' . $arrname . '^' . $arrdata . '&';
//       echo $TOT;
    }
}

function myStoreFilterCategory($name) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sqlCount = "SELECT COUNT(category.catId) AS A from category
                      INNER JOIN majorcategory on category.majorId= majorcategory.majorId 
                      WHERE majorcategory.majorName LIKE '%$name%'";
        $resultCount = $con->query($sqlCount);
        $gcount = '';
        for ($a = 0; $a < $resultCount->num_rows; $a++) {
            $resultCount->data_seek($a);
            $gcount = $resultCount->fetch_assoc()['A'];
        }

        $sql1 = "SELECT category.catName as A, COUNT(minorcategory.minorId) as B from category
                LEFT JOIN minorcategory
                on category.catId = minorcategory.catId
                LEFT JOIN majorcategory on majorcategory.majorId = category.majorId
                where majorcategory.majorName='$name'
                GROUP BY category.catName ORDER by b DESC ";
        //get no of groups
        $result = $con->query($sql1);
        $rows = $result->num_rows;
        $tr = '';
        $d1 = '';
        $arrname = '';
        $arrdata = '';
        $d2 = 0;
        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $d1 = $result->fetch_assoc()['A'];
            $np = 0;
            $qt = 0;
            $sql2 = "SELECT category.catName,items.itemName, items.itemQuantity,items.newPrice from category
                    RIGHT JOIN minorcategory on minorcategory.catId = category.catId
                    RIGHT JOIN items on items.minorId = minorcategory.minorId
                    LEFT JOIN majorcategory on majorcategory.majorId = category.majorId
                    WHERE category.catName LIKE '%$d1%'";
            $result2 = $con->query($sql2);
            for ($b = 0; $b < $result2->num_rows; $b++) {
                $result2->data_seek($b);
                $np = $result2->fetch_assoc()['newPrice'];
                $result2->data_seek($b);
                $qt = $result2->fetch_assoc()['itemQuantity'];
//               if(empty($np)===false && empty($qt)===false){
                $d2 = $d2 + ($np * $qt);
//               }
            }
            $tr = $tr . '<tr> <td>' . ($a + 1) . '</td> <td>' . $d1 . '</td> <td>' . moneyFormatter($d2) . '</td> </tr>';
            $arrname = $arrname . ($a + 1) . '*' . $d1 . '#';
            $arrdata = $arrdata . ($a + 1) . '*' . $d2 . '#';
            $d2 = 0;
        }

        $sqlTot = " SELECT
            items.itemId, majorcategory.majorName,
            category.catName,minorcategory.minorName,
            items.itemName,items.newPrice as a,items.itemQuantity as b
            FROM items
            INNER JOIN brand ON items.brandId=brand.brandId
            INNER JOIN minorcategory ON items.minorId = minorcategory.minorId
            INNER JOIN category ON minorcategory.catId = category.catId
            INNER JOIN majorcategory ON category.majorId = majorcategory.majorId
             WHERE majorcategory.majorName='$name'";
//         
        $TOT = '0';
        $ar = '';
        $b = '';
        $r4 = $con->query($sqlTot);
        for ($a = 0; $a < $r4->num_rows; $a++) {
            $r4->data_seek($a);
            $ar = $r4->fetch_assoc()['a'];
            $r4->data_seek($a);
            $b = $r4->fetch_assoc()['b'];
            $TOT = $TOT + ($ar * $b);
        }
        echo '!' . $gcount . '@' . $tr . '#' . $arrname . '$' . $arrdata . '%' . $TOT . '^';
    }
}

function viewMyStoreCategory() {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        //fetch combo data
        $sql = "select * from `majorCategory` order by `majorId` asc";
        $name = '';
        $resultCombo = $con->query($sql);
        $rowsCombo = $resultCombo->num_rows;
        $options = '<option>---select Group---</option><option>ALL</option>';
        for ($a = 0; $a < $rowsCombo; $a++) {
            $resultCombo->data_seek($a);
            $name = $resultCombo->fetch_assoc()['majorName'];
            $options = $options . '<option>' . $name . '</option>';
        }

        $sqlCount = "SELECT COUNT(category.catId) AS A from category
                 INNER JOIN majorcategory on category.majorId= majorcategory.majorId";
        $resultCount = $con->query($sqlCount);
        $gcount = '';
        for ($a = 0; $a < $resultCount->num_rows; $a++) {
            $resultCount->data_seek($a);
            $gcount = $resultCount->fetch_assoc()['A'];
        }

        //gat amount for each and total
        $sql1 = "SELECT category.catName as A, COUNT(minorcategory.minorId) as B from category
                LEFT JOIN minorcategory
                on category.catId = minorcategory.catId
                GROUP BY category.catName ORDER by b DESC ";
        //get no of groups
        $result = $con->query($sql1);
        $rows = $result->num_rows;
        $tr = '';
        $d1 = '';
        $arrname = '';
        $arrdata = '';
        $d2 = 0;
        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $d1 = $result->fetch_assoc()['A'];
            $np = 0;
            $qt = 0;
            $sql2 = "SELECT category.catName,items.itemName, items.itemQuantity,items.newPrice from category
                    RIGHT JOIN minorcategory on minorcategory.catId = category.catId
                    RIGHT JOIN items on items.minorId = minorcategory.minorId
                    LEFT JOIN majorcategory on majorcategory.majorId = category.majorId
                    WHERE category.catName LIKE '%$d1%'";
            $result2 = $con->query($sql2);
            for ($b = 0; $b < $result2->num_rows; $b++) {
                $result2->data_seek($b);
                $np = $result2->fetch_assoc()['newPrice'];
                $result2->data_seek($b);
                $qt = $result2->fetch_assoc()['itemQuantity'];
//               if(empty($np)===false && empty($qt)===false){
                $d2 = $d2 + ($np * $qt);
//               }
            }
            $tr = $tr . '<tr> <td>' . ($a + 1) . '</td> <td>' . $d1 . '</td> <td>' . moneyFormatter($d2) . '</td> </tr>';
            $arrname = $arrname . ($a + 1) . '*' . $d1 . '#';
            $arrdata = $arrdata . ($a + 1) . '*' . $d2 . '#';
            $d2 = 0;
        }

        $sqlTot = "SELECT items.newPrice as a,items.itemQuantity as b from items";
//         
        $TOT = '';
        $ar = '';
        $b = '';
        $r4 = $con->query($sqlTot);
        for ($a = 0; $a < $r4->num_rows; $a++) {
            $r4->data_seek($a);
            $ar = $r4->fetch_assoc()['a'];
            $r4->data_seek($a);
            $b = $r4->fetch_assoc()['b'];
            $TOT = $TOT + ($ar * $b);
        }


        echo '~' . $options . '!' . $gcount . '@' . $tr . '#' . $arrname . '$' . $arrdata . '%' . $TOT . '^';
    }
}

/*

  SELECT COUNT(category.catId) AS A from category
  INNER JOIN majorcategory on category.majorId= majorcategory.majorId
  WHERE majorcategory.majorName LIKE '%COMPUTING%'

 */

function viewMyStoreSpecific() {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        //populate comboBox
        $sql = "select * from `majorCategory` order by `majorId` asc";
        $name = '';
        $resultCombo = $con->query($sql);
        $rowsCombo = $resultCombo->num_rows;
        $options = '<option>---select Group---</option><option>ALL</option>';
        for ($a = 0; $a < $rowsCombo; $a++) {
            $resultCombo->data_seek($a);
            $name = $resultCombo->fetch_assoc()['majorName'];
            $options = $options . '<option>' . $name . '</option>';
        }
        //get total group count
        $countSpec = '';
        $sqlCountSpec = '
                       SELECT DISTINCT COUNT(minorcategory.minorId) as SpecTot FROM minorcategory
                        ';
        $resultCountSpec = $con->query($sqlCountSpec);
        for ($a = 0; $a < $resultCountSpec->num_rows; $a++) {
            $resultCountSpec->data_seek($a);
            $countSpec = $resultCountSpec->fetch_assoc()['SpecTot'];
        }
        $sql1 = "SELECT minorcategory.minorName as A, COUNT(items.itemId) as B from minorcategory
                LEFT JOIN items
                on minorcategory.minorId = items.itemId
                GROUP BY minorcategory.minorName ";
        //get no of groups
        $result = $con->query($sql1);
        $rows = $result->num_rows;
        $tr = '';
        $d1 = '';
        $arrname = '';
        $arrdata = '';
        $d2 = 0;
        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $d1 = $result->fetch_assoc()['A'];
            $np = 0;
            $qt = 0;
            $sql2 = "SELECT category.catName,minorcategory.minorName,items.itemName, items.itemQuantity,items.newPrice from minorcategory
                    RIGHT JOIN category on minorcategory.catId = category.catId
                    RIGHT JOIN items on items.minorId = minorcategory.minorId
                    LEFT JOIN majorcategory on majorcategory.majorId = category.majorId
                    WHERE minorcategory.minorName LIKE '%$d1%' ORDER BY items.itemQuantity DESC";
            $result2 = $con->query($sql2);
            for ($b = 0; $b < $result2->num_rows; $b++) {
                $result2->data_seek($b);
                $np = $result2->fetch_assoc()['newPrice'];
                $result2->data_seek($b);
                $qt = $result2->fetch_assoc()['itemQuantity'];
//               if(empty($np)===false && empty($qt)===false){
                $d2 = $d2 + ($np * $qt);
//               }
            }
            $tr = $tr . '<tr> <td>' . ($a + 1) . '</td> <td>' . $d1 . '</td> <td>' . moneyFormatter($d2) . '</td> </tr>';
            $arrname = $arrname . ($a + 1) . '*' . $d1 . '#';
            $arrdata = $arrdata . ($a + 1) . '*' . $d2 . '#';
            $d2 = 0;
        }
        $sqlTot = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName, items.itemName, items.newPrice as a, items.itemQuantity as b
                    from minorcategory
                    right JOIN items on items.minorId = minorcategory.minorId
                    LEFT JOIN category on minorcategory.catId = category.catId
                    LEFT JOIN majorcategory on majorcategory.majorId = category.majorId
                   ";

        $TOT = '0';
        $ar = '';
        $b = '';
        $r4 = $con->query($sqlTot);
        for ($a = 0; $a < $r4->num_rows; $a++) {
            $r4->data_seek($a);
            $ar = $r4->fetch_assoc()['a'];
            $r4->data_seek($a);
            $b = $r4->fetch_assoc()['b'];
            $TOT = $TOT + ($ar * $b);
        }

        echo '~' . $options . '!' . $countSpec . '@' . $tr . '+' . $arrname . '$' . $arrdata . '%' . $TOT . '^';
    }
}

function myStoreFilterSpecific($name, $general) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sqlCount = '';

        if ($name === 'ALL') {
            $sqlCount = " SELECT COUNT(minorcategory.minorId) AS A from minorcategory 
                                inner JOIN category on category.catId = minorcategory.catId
                                inner JOIN majorcategory on majorcategory.majorId = category.majorId
                                where majorcategory.majorName LIKE '%$general%'";
        } else {
            $sqlCount = "SELECT COUNT(minorcategory.minorId) AS A from minorcategory
                      INNER JOIN category on minorcategory.catId= category.catId 
                      WHERE category.catName LIKE '%$name%'";
        }


        $resultCount = $con->query($sqlCount);
        $gcount = '';
        for ($a = 0; $a < $resultCount->num_rows; $a++) {
            $resultCount->data_seek($a);
            $gcount = $resultCount->fetch_assoc()['A'];
        }

        $sql1 = '';
        if ($name === 'ALL') {
            $sql1 = "SELECT minorcategory.minorName as A, COUNT(items.itemId) as B from minorcategory
                left JOIN items on items.minorId = minorcategory.minorId
                LEFT JOIN category on category.catId = minorcategory.catId
                left join majorcategory on majorcategory.majorId = category.majorId
                WHERE majorcategory.majorName LIKE'%$general%'
                GROUP BY minorcategory.minorName ORDER by b DESC;";
        } else {
            $sql1 = "SELECT minorcategory.minorName as A, COUNT(items.itemId) as B from minorcategory
                LEFT JOIN items on items.minorId = minorcategory.minorId
                LEFT JOIN category on category.catId = minorcategory.catId
                WHERE category.catName LIKE'%$name%'
                GROUP BY minorcategory.minorName ORDER BY b DESC;";
        }
        //get no of groups
        $result = $con->query($sql1);
        $rows = $result->num_rows;
        $tr = '';
        $d1 = '';
        $arrname = '';
        $arrdata = '';
        $d2 = 0;
        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $d1 = $result->fetch_assoc()['A'];
            $np = 0;
            $qt = 0;
            $sql2 = "SELECT category.catName,minorcategory.minorName,items.itemName, items.itemQuantity,items.newPrice from minorcategory
                    RIGHT JOIN items on items.minorId = minorcategory.minorId
                    LEFT JOIN category on category.catId = minorcategory.catId
                    WHERE minorcategory.minorName LIKE '%$d1%';";
            $result2 = $con->query($sql2);
            for ($b = 0; $b < $result2->num_rows; $b++) {
                $result2->data_seek($b);
                $np = $result2->fetch_assoc()['newPrice'];
                $result2->data_seek($b);
                $qt = $result2->fetch_assoc()['itemQuantity'];
                $d2 = $d2 + ($np * $qt);
            }
            $tr = $tr . '<tr> <td>' . ($a + 1) . '</td> <td>' . $d1 . '</td> <td>' . moneyFormatter($d2) . '</td> </tr>';
            $arrname = $arrname . ($a + 1) . '*' . $d1 . '#';
            $arrdata = $arrdata . ($a + 1) . '*' . $d2 . '#';
            $d2 = 0;
        }

        $sqlTot = "";

        //condition 1 : specific Major ALL cat
        if ($name === 'ALL') {
            $sqlTot = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName, items.itemName, items.newPrice as a, items.itemQuantity as b
                        from minorcategory
                        right JOIN items on items.minorId = minorcategory.minorId
                        LEFT JOIN category on minorcategory.catId = category.catId
                        LEFT JOIN majorcategory on majorcategory.majorId = category.majorId
                        WHERE majorcategory.majorName LIKE '%$general%'";
        } else {
            $sqlTot = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName, items.itemName, items.newPrice as a, items.itemQuantity as b
                    from minorcategory
                    right JOIN items on items.minorId = minorcategory.minorId
                    LEFT JOIN category on minorcategory.catId = category.catId
                    LEFT JOIN majorcategory on majorcategory.majorId = category.majorId
                    WHERE majorcategory.majorName LIKE '%$general%' AND category.catName LIKE '%$name%'";
        }
//         
        $TOT = '0';
        $ar = '';
        $b = '';
        $r4 = $con->query($sqlTot);
        for ($a = 0; $a < $r4->num_rows; $a++) {
            $r4->data_seek($a);
            $ar = $r4->fetch_assoc()['a'];
            $r4->data_seek($a);
            $b = $r4->fetch_assoc()['b'];
            $TOT = $TOT + ($ar * $b);
        }
        echo '!' . $gcount . '@' . $tr . '+' . $arrname . '$' . $arrdata . '%' . $TOT . '^';
    }
}

function moneyFormatter($d2) {
    $data1 = number_format($d2, 2, '.', ',');
    return $data1;
}

function resetPasswordSql($email, $pass) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql = "UPDATE admins set admins.password='$pass' WHERE admins.email='$email';";
        $con->query($sql);
        if ($con->error) {
            echo '<p class="text-danger">Failed to set a new Password! Check internet connection then try again</p>';
        } else {
            $action = 'CHANGED PASSWORD';
            $event = 'User ' . $_SESSION['marvel'] . ' Successfuly changed password.';
            auditLogger($action, $event);
            echo '<p> Password successfuly changed! use your new password on next login</p>';
        }
    }
}

function popAuditCombo($adminId) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $sql1 = "SELECT * FROM `month` order by month asc";
        $result1 = $con->query($sql1);
        $month = '<option>---select Month---</option>';
        for ($a = 0; $a < $result1->num_rows; $a++) {
            $result1->data_seek($a);
            $month = $month . '<option>' . intToMonth($result1->fetch_assoc()['month']) . '</option>';
        }

        $sql2 = "SELECT * FROM `year` order by year asc ";
        $year = '<option>---select year---</option>';
        $result2 = $con->query($sql2);
        for ($a = 0; $a < $result2->num_rows; $a++) {
            $result2->data_seek($a);
            $year = $year . '<option>' . $result2->fetch_assoc()['year'] . '</option>';
        }

        $sql3 = "SELECT admins.name from admins WHERE admins.adminId=$adminId";
        $name = '';
        $r3 = $con->query($sql3);
        for ($a = 0; $a < $r3->num_rows; $a++) {
            $r3->data_seek($a);
            $name = $r3->fetch_assoc()['name'];
        }

        echo '~' . $month . '@' . $year . '$' . $name . '%';
    }
}

function intToMonth($intm) {
    $res = '';
    if ($intm === '01') {
        $res = 'JAN';
    } else if ($intm === '02') {
        $res = 'FEB';
    } else if ($intm === '03') {
        $res = 'MAR';
    } else if ($intm === '04') {
        $res = 'APR';
    } else if ($intm === '05') {
        $res = 'MAY';
    } else if ($intm === '06') {
        $res = 'JUN';
    } else if ($intm === '07') {
        $res = 'JUL';
    } else if ($intm === '08') {
        $res = 'AUG';
    } else if ($intm === '09') {
        $res = 'SEP';
    } else if ($intm === '10') {
        $res = 'OCT';
    } else if ($intm === '11') {
        $res = 'NOV';
    } else if ($intm === '12') {
        $res = 'DEC';
    }
    return $res;
}

function monthToInt($intm) {
    $res = '';
    if ($intm === 'JAN') {
        $res = '01';
    } else if ($intm === 'FEB') {
        $res = '02';
    } else if ($intm === 'MAR') {
        $res = '03';
    } else if ($intm === 'APR') {
        $res = '04';
    } else if ($intm === 'MAY') {
        $res = '05';
    } else if ($intm === 'JUN') {
        $res = '06';
    } else if ($intm === 'JUL') {
        $res = '07';
    } else if ($intm === 'AUG') {
        $res = '08';
    } else if ($intm === 'SEP') {
        $res = '09';
    } else if ($intm === 'OCT') {
        $res = '10';
    } else if ($intm === 'NOV') {
        $res = '11';
    } else if ($intm === 'DEC') {
        $res = '12';
    }
    return $res;
}

function showUserAuditSql($id, $mf, $mt, $yf, $yt) {
    $con = connect();
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $mf = monthToInt($mf);
        $mt = monthToInt($mt);

        $sql = "select adminlog.time,adminlog.date,adminlog.action, adminlog.event FROM adminlog
                inner JOIN admins on admins.adminId = adminlog.adminId
                where adminlog.month BETWEEN '$mf' AND '$mt' and adminlog.year BETWEEN '$yf' and '$yt'
                AND adminlog.adminId=$id
                union
                SELECT itemlog.time,itemlog.date,itemlog.action, itemlog.event from itemlog
                inner join admins on admins.adminId = itemlog.adminId
                where itemlog.month BETWEEN '$mf' AND '$mt' and itemlog.year BETWEEN '$yf' and '$yt'
                    AND itemlog.adminId=$id
                order by date ASC;";
        $tr = '';
        $time = '';
        $date = '';
        $action = '';
        $event = '';

        $result = $con->query($sql);
        $rows = $result->num_rows;
        $sql2 = "select adminlog.time,adminlog.date,adminlog.action, adminlog.event FROM adminlog
                inner JOIN admins on admins.adminId = adminlog.adminId
                where adminlog.month BETWEEN '$mf' AND '$mt' and adminlog.year BETWEEN '$yf' and '$yt'
                union
                SELECT itemlog.time,itemlog.date,itemlog.action, itemlog.event from itemlog
                inner join admins on admins.adminId = itemlog.adminId
                where itemlog.month BETWEEN '$mf' AND '$mt' and itemlog.year BETWEEN '$yf' and '$yt'
                order by date ASC;";
        $r = $con->query($sql2);
        $tot = $r->num_rows;

        $ac = moneyFormatter(($rows / $tot) * 100);
        for ($a = 0; $a < $result->num_rows; $a++) {
            $result->data_seek($a);
            $time = $result->fetch_assoc()['time'];

            $result->data_seek($a);
            $date = $result->fetch_assoc()['date'];

            $result->data_seek($a);
            $action = $result->fetch_assoc()['action'];

            $result->data_seek($a);
            $event = $result->fetch_assoc()['event'];

            $tr = $tr . '<tr><td>' . ($a + 1) . '</td><td>' . $time . '</td> <td>' . $date . '</td> <td>' . $action . '</td> <td>' . $event . '</td></tr>';
        }

        echo '~' . $tr . '_' . $ac . '#';
//      echo $tr;
    }
}

function popUsers() {
    $con = connect();
    // continiue from here!!
    if ($con === 'Connect Error') {
        echo '<p class="text-danger">Something went wrong. Please check your internet connection then try again!</p>';
    } else {
        $div = '';
        //select user data
        $sql1 = "SELECT admins.adminId, admins.name, admins.image from admins;";
        $name = '';
        $id = '';
        $image = '';
        $stat = '';
        //selet total no of activities
        $sql2 = " select adminlog.time,adminlog.date,adminlog.action, adminlog.event FROM adminlog
                  inner JOIN admins on admins.adminId = adminlog.adminId
                  UNION
                  SELECT itemlog.time,itemlog.date,itemlog.action, itemlog.event from itemlog
                  inner join admins on admins.adminId = itemlog.adminId";
        $r2 = $con->query($sql2);
        $tot = $r2->num_rows;

        //select count for each user and perform operation

        $userAc = '';
        $userAc1 = '';

        $r1 = $con->query($sql1);
        for ($a = 0; $a < $r1->num_rows; $a++) {
            $r1->data_seek($a);
            $name = $r1->fetch_assoc()['name'];

            $r1->data_seek($a);
            $id = $r1->fetch_assoc()['adminId'];

            $r1->data_seek($a);
            $image = $r1->fetch_assoc()['image'];
            $sql3 = "   select adminlog.time,adminlog.date,adminlog.action, adminlog.event FROM adminlog
                  inner JOIN admins on admins.adminId = adminlog.adminId
                  WHERE adminlog.adminId=$id
                  UNION
                  SELECT itemlog.time,itemlog.date,itemlog.action, itemlog.event from itemlog
                  inner join admins on admins.adminId = itemlog.adminId
                  WHERE itemlog.adminId=$id;";

            $r3 = $con->query($sql3);
            $userAc = $r3->num_rows;

            $userAc1 = ($userAc / $tot) * 100;
            $div = $div . '<div class="col-sm-3 menu"  onclick="divclick(this.innerHTML)">
                    <input type="hidden" class="inputMy" value="' . $id . '" name="index"/>
                    <img src="./userpics/' . $image . '" class="myUserImg"/>
                    <p style="margin: 2px">Name :<strong>' . $name . '</strong></p>
                    <p style="margin: 2px">Active Level : <strong>' . moneyFormatter($userAc1) . '%</strong></p>
                </div>';
        }
        echo $div;
    }
}

function countryAdd($jsonData) {
    $con = connect();
    $arrayData = json_decode($jsonData);
    $name = $arrayData[0];
    $code = $arrayData[1];
//    check if the name exists
    $sql1 = "SELECT * from country WHERE country.contName like '%$name%';";
    //doesnt exits, add the stuff
    $sql2 = "INSERT INTO `country`(`contName`,`code`,`status`) VALUES ('$name','$code',1);";

    $r = $con->query($sql1);
    if ($r->num_rows > 0) {
        echo '<p class="text-danger">Country \'<strong>' . $name . '</strong>\' already exists!</p>';
    } else {
        $con->query($sql2);
        if ($con->error) {
            echo '<p class="text-danger">Country <strong>' . $name . '</strong> was not added! Please try again. if this error ocuurs again contact Admin</p>';
        } else {
            $action = 'ADDED NEW COUNTRY GROUP';
            $event = 'Successful addition of Country ' . $name . '.';
            auditLogger($action, $event);
            echo '<p class="text-success">Country <strong>' . $name . '</strong> successfuly added!</p>';
        }
    }
}

function loadCountries($t) {
    $con = connect();
    $sql = "SELECT country.contName,country.code,country.status,country.contId from country ";
    if ($t === 'ALL') {
        
    } else if ($t === 'ACTIVE') {
        $sql = $sql . " where country.status = 1";
    } else if ($t === 'INACTIVE') {
        $sql = $sql . " where country.status = 0";
    }
    $tr = '';
    $name = '';
    $id = '';
    $status = '';
    $code = '';
    $stat = 'ACTIVE';
    $result = $con->query($sql);
    for ($a = 0; $a < $result->num_rows; $a++) {
        $result->data_seek($a);
        $name = $result->fetch_assoc()['contName'];

        $result->data_seek($a);
        $code = $result->fetch_assoc()['code'];

        $result->data_seek($a);
        $status = $result->fetch_assoc()['status'];
        if ($status === '0') {
            $stat = 'INACTIVE';
        }
        $result->data_seek($a);
        $id = $result->fetch_assoc()['contId'];

        $tr .= '<tr><td>' . ($a + 1) . '</td> <td>' . $name . '</td> <td>' . $code . '</td> <td>' . $stat . '</td> <td><button value="' . $id . '" onclick="editCountryClicked(this.value)"  class="btn btn-warning"><i class="fa fa-edit">...</i></button></td> </tr>';
    }
    echo $tr;
//   echo $sql;
}

function loadCountryEdit($id) {
    $con = connect();
    $sql = "SELECT country.contName,country.code,country.status from country where country.contId=$id";
    $arrayFeedback = array();
    $r = $con->query($sql);
    $rows = $r->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $arrayFeedback[0] = $r->fetch_assoc()['contName'];
        $r->data_seek($a);
        $arrayFeedback[1] = $r->fetch_assoc()['status'];
        $r->data_seek($a);
        $arrayFeedback[2] = $r->fetch_assoc()['code'];
    }
    $jsonData = json_encode($arrayFeedback);
    echo $jsonData;
}

function editCountrySave($jsonData) {
    $con = connect();
    $data = json_decode($jsonData);
    $code = '+' . ltrim(rtrim($data[3]));
    $sql = "UPDATE country set country.contName='$data[1]',country.status=$data[2],country.code='$code' where country.contId=$data[0]";
//    
    $con->query($sql);
    if ($con->error) {
        echo '<p class="text-danger"> <i class="fa fa-frown-o"></i> Changes were not saved! Please try again. if this error ocuurs again contact Admin</p>';
    } else {
        $action = 'MODIFIED COUNTRY INFO';
        $event = 'Successful modification of Country ' . $data[1] . '.';
        auditLogger($action, $event);
        echo '<p><i class="fa fa-smile-o"></i> Changes successfuly Saved!</p>';
    }
//    echo $sql;
}

function getCountryAdd() {
    $con = connect();
    $sql = "SELECT country.contName from country order by country.contName asc;";
    $response = '<option>---select Country---</option>';
    $r = $con->query($sql);
    $rows = $r->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $response = $response . '<option>' . $r->fetch_assoc()['contName'] . '</option>';
    }
    echo $response;
}

function addNewCounty($jsonData) {
    $con = connect();
    //arrayFormat 0->country,1->name
    $data = json_decode($jsonData);

    //check if exists
    $sql1 = "SELECT * from county where county.conName LIKE '%$data[1]%';";
    $r = $con->query($sql1);
    //if exists
    if ($r->num_rows > 0) {
        echo '<p class="text-danger">County <strong>' . $data[1] . '</strong> already exists!</p>';
    }
    //else [doesnt exist]
    //get the country id, insert data
    else {
        $sql2 = "SELECT country.contId from country where country.contName = '$data[0]';";
        $contid = '';
        $r1 = $con->query($sql2);
        for ($a = 0; $a < $r1->num_rows; $a++) {
            $r1->data_seek($a);
            $contid = $r1->fetch_assoc()['contId'];
        }
        $sql3 = "INSERT INTO `county`( `contId`, `conName`, `status`) VALUES ($contid,'$data[1]',1);";
        $con->query($sql3);
        if ($con->error) {
            echo '<p class="text-danger">County <strong>' . $data[1] . '</strong> Was not added! Please try again. if this error ocuurs again contact Admin</p>';
        } else {
            $action = 'ADDED A COUNTY';
            $event = 'Successful Addition of County ' . $data[1] . '.';
            auditLogger($action, $event);
            echo '<p><i class="fa fa-smile-o"></i> County <strong></strong> Successfully added!</p>';
        }
    }
//    echo 'Wddup Yo ',$data[1] .' -> '.$data[0] ;
}

function filterCountyData($jsonData) {
    //Get jsonData, get the countryname and status
    //
    //json format 0:-> country, 1:-> status
    $con = connect();
    $data = json_decode($jsonData);
    $country = $data[0];
    $status = $data[1];

    $sql = "SELECT country.contName,county.conId,county.conName,county.status from county
            inner join country on country.contId = county.contId
            WHERE
            country.status = 1 
            ";
    if ($status === '---select status---' && $country === '---select Country---') {
        
    } else if ($status === 'ALL' && $country === '---select Country---') {
        
    } else if ($status === 'ACTIVE' && $country === '---select Country---') {
        $sql .= " and county.status=1 ";
    } else if ($status === 'INACTIVE' && $country === '---select Country---') {
        $sql .= " and county.status = 0 ";
    } else if ($status === 'ALL') {
        $sql .= " and country.contName = '$country' ";
    } else if ($status === '---select status---') {
        $sql .= " and country.contName = '$country' ";
    } else if ($status === 'ACTIVE') {
        $sql .= " and country.contName = '$country' and county.status=1 ";
    } else if ($status === 'INACTIVE') {
        $sql .= " and country.contName = '$country' and county.status=0 ";
    }
    $Cty = '';
    $cty = '';
    $stat = '';
    $id = '';
    $stat1 = 'ACTIVE';
    $tr = '';

    $r = $con->query($sql);
    $rows = $r->num_rows;

    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $Cty = $r->fetch_assoc()['contName'];

        $r->data_seek($a);
        $cty = $r->fetch_assoc()['conName'];

        $r->data_seek($a);
        $stat = $r->fetch_assoc()['status'];

        $r->data_seek($a);
        $id = $r->fetch_assoc()['conId'];

        if ($stat === '0') {
            $stat1 = 'INACTIVE';
        } else {
            $stat1 = 'ACTIVE';
        }
        $tr = $tr . '<tr> <td>' . ($a + 1) . '</td> <td>' . $Cty . '</td> <td>' . $cty . '</td> <td>' . $stat1 . '</td> <td><button value="' . $id . '" onclick="editCounty(this.value)" class="btn btn-warning"><i class="fa fa-edit"></i>...</button></td> </tr>';
        $stat1 = '';
    }
    echo $tr;
}

function getCountyDataEdit($id) {
    $con = connect();
    $array = array();
    $sql = "select country.contName,county.conName,county.status from county
            inner JOIN country on country.contId = county.contId
            where county.conId=$id;";
    $r = $con->query($sql);
    //format of data: 0->country,1->county,2->status
    for ($a = 0; $a < $r->num_rows; $a++) {
        $r->data_seek($a);
        $array[0] = $r->fetch_assoc()['contName'];

        $r->data_seek($a);
        $array[1] = $r->fetch_assoc()['conName'];

        $r->data_seek($a);
        $array[2] = $r->fetch_assoc()['status'];
    }
    echo json_encode($array);
}

function saveEditCountyDataUpdate($jsonData) {
    //json format : 0->name, 1-> status : 2-> id
    $con = connect();
    $data = json_decode($jsonData);
    $id = (int) $data[2];
    $sql = "UPDATE county SET county.conName='$data[0]', county.status=$data[1] where county.conId=$id";
    $action = 'MODIFIED COUNTY NAME DATA';
    $event = 'Successful Modification of County ' . $data[0] . ' data.';
    $con->query($sql);
    if ($con->error) {
        echo '<p class="text-danger">Changes not saved! Please try again. if this error occurs again contact Admin</p>';
    } else {
        auditLogger($action, $event);
        echo '<p><i class="fa fa-smile-o"></i> Changes successfully saved!</p>';
    }
}

function loadCountiesForCountries($country) {


    $con = connect();
    $sql = "SELECT county.conName from county
            inner join country on country.contId = county.contId
            where country.status=1 AND country.contName='$country'
            order BY county.conName asc;";

    $response = "<option>---select County---</option>";
    $r = $con->query($sql);
    for ($a = 0; $a < $r->num_rows; $a++) {
        $r->data_seek($a);
        $response .= "<option>" . $r->fetch_assoc()['conName'] . "</option>";
    }
    echo $response;
}

function loadCountiesForCountriesEdit($country) {
    $con = connect();
    $sql = "SELECT county.conName from county
            inner join country on country.contId = county.contId
            where country.status=1 AND country.contName='$country'
            order BY county.conName asc;";

    $response = "<option>---select County---</option><option>ALL</option>";
    $r = $con->query($sql);
    for ($a = 0; $a < $r->num_rows; $a++) {
        $r->data_seek($a);
        $response .= "<option>" . $r->fetch_assoc()['conName'] . "</option>";
    }
    echo $response;
}

function addConstituency($jsonData) {
    //json data format 0:-> country, 1:->county, 2:->constituency :3.>countyid,
    $con = connect();
    $data = json_decode($jsonData);
    //get ids for country $ county
    // 
    //
     $sql1 = "SELECT county.contId from county where county.conName='$data[1]';";
    $r = $con->query($sql1);
    for ($a = 0; $a < $r->num_rows; $a++) {
        $r->data_seek($a);
        $data[3] = (int) $r->fetch_assoc()['contId'];
    }
    //confirm if such nombiation exists. county id and 
    $sql = "SELECT country.contName, county.conName, constituency.constName from constituency
            inner JOIN county on county.conId = constituency.conId
            INNER join country on country.contId = county.contId
            WHERE country.contName='$data[0]' AND county.conName = '$data[1]' AND constituency.constName like'%$data[2]%'";
    $rc = $con->query($sql);
    if ($rc->num_rows > 0) {
        echo '<p class="text-danger">Constitency/State <strong>' . $data[2] . '</strong> Already Exists!</p>';
    } else {
        $sql2 = "INSERT INTO `constituency`( `conId`, `constName`, `status`) VALUES ($data[3],'$data[2]',1);";
        $action = 'ADDED NEW CONSTITUENCY ' . $data[0];
        $event = 'Successful ADDITION of Constituency ' . $data[0] . ' data.';
        $con->query($sql2);
        if ($con->error) {
            echo '<p class="text-danger">State/Constituency <strong>' . $data[2] . '</strong> not saved! Please try again. if this error occurs again contact Admin</p>' . $con->error;
        } else {
            auditLogger($action, $event);
            echo '<p><i class="fa fa-smile-o"></i> State/Constituency <strong>' . $data[2] . '</strong> successfully saved!</p>';
        }
    }
}

function loadTableConstituencySql($jsonData) {
    $con = connect();
    $data = json_decode($jsonData);
    //json format 0:->country, 1:->county,  $action = 'MODIFIED COUNTY NAME DATA';
//    /2:->status
    $country = $data[0];
    $county = $data[1];
    $status = $data[2];
    $sql = "SELECT country.contName,county.conName,constituency.constName, constituency.status, constituency.constId FROM constituency
            inner JOIN county on constituency.conId = county.conId
            inner join country on county.contId = country.contId "
    ;
    if ($status === '---select status---' && $country === '---select Country---' && $county === '---select County---') {
        $sql .= " WHERE country.status = 1 and county.status=1 ";
    } else if ($status === 'ALL' && $country === '---select Country---' && $county === '---select County---') {
        $sql .= " WHERE country.status = 1 and county.status=1 ";
    } else if ($status === 'ACTIVE' && $country === '---select Country---' && $county === '---select County---') {
        $sql .= " WHERE country.status = 1 and county.status=1 and constituency.status=1";
    } else if ($status === 'INACTIVE' && $country === '---select Country---' && $county === '---select County---') {
        $sql .= " WHERE country.status = 1 and county.status=1 and constituency.status=0";
    } else if ($status === '---select status---' && $county === '---select County---') {
        $sql .= " WHERE country.status = 1 and country.contName='$country' and county.status=1 ";
    } else if ($status === 'ALL' && $county === '---select County---') {
        $sql .= " WHERE country.status = 1 and country.contName='$country' and county.status=1 ";
    } else if ($status === 'ACTIVE' && $county === '---select County---') {
        $sql .= " WHERE country.status = 1 and country.contName='$country' and county.status=1 and constituency.status=1";
    } else if ($status === 'INACTIVE' && $county === '---select County---') {
        $sql .= " WHERE country.status = 1 and country.contName='$country' and county.status=1 and constituency.status=0";
    } else if ($status === '---select status---' && $county === 'ALL') {
        $sql .= " WHERE country.status = 1 and country.contName='$country' and county.status=1 ";
    } else if ($status === 'ALL' && $county === 'ALL') {
        $sql .= " WHERE country.status = 1 and country.contName='$country' and county.status=1 ";
    } else if ($status === 'ACTIVE' && $county === 'ALL') {
        $sql .= " WHERE country.status = 1 and country.contName='$country' and county.status=1 and constituency.status=1";
    } else if ($status === 'INACTIVE' && $county === 'ALL') {
        $sql .= " WHERE country.status = 1 and country.contName='$country' and county.status=1 and constituency.status=0";
    } else if ($status === '---select status---') {
        $sql .= " WHERE country.status = 1 and country.contName='$country' and county.status=1 and county.conName = '$county' ";
    } else if ($status === 'ALL') {
        $sql .= " WHERE country.status = 1 and country.contName='$country' and county.status=1 and county.conName = '$county' ";
    } else if ($status === 'ACTIVE') {
        $sql .= " WHERE country.status = 1 and country.contName='$country' and county.status=1 and county.conName = '$county' constituency.status=1 ";
    } else if ($status === 'INACTIVE') {
        $sql .= " WHERE country.status = 1 and country.contName='$country' and county.status=1 and county.conName = '$county'  constituency.status=0";
    }


    $r1 = $con->query($sql);
    $rows = $r1->num_rows;
    $countrydb = '';
    $countydb = '';
    $stat = 'ACTIVE';
    $statusdb = '';
    $const = '';
    $id = '';
    $tr = '';
    for ($a = 0; $a < $rows; $a++) {
        $r1->data_seek($a);
        $countrydb = $r1->fetch_assoc()['contName'];
        $r1->data_seek($a);
        $countydb = $r1->fetch_assoc()['conName'];
        $r1->data_seek($a);
        $const = $r1->fetch_assoc()['constName'];
        $r1->data_seek($a);
        $statusdb = $r1->fetch_assoc()['status'];
        if ($statusdb === '0') {
            $stat = 'INACTIVE';
        }
        $r1->data_seek($a);
        $id = $r1->fetch_assoc()['constId'];
        $tr .= '<tr>
            <td>' . ($a + 1) . '</td>
            <td>' . $countrydb . '</td>
            <td>' . $countydb . '</td>
            <td>' . $const . '</td>
            <td>' . $stat . '</td>
            <td>
            <button class="btn btn-warning" value="' . $id . '" onclick="EditStateDetails(this.value)">
                <i class="fa fa-edit"></i>...
            </button>
            </td>
            </tr>';
    }
    echo $tr;
}

function EditStateDetails($id) {
    $con = connect();
    $data = array();
    $sql = "SELECT country.contName, county.conName, constituency.constName, constituency.status from constituency
            inner join county on county.conId = constituency.conId
            inner join country on  country.contId = county.contId
            WHERE constituency.constId=$id;";
    $r = $con->query($sql);
    $rows = $r->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $data[0] = $r->fetch_assoc()['contName'];
        $r->data_seek($a);
        $data[1] = $r->fetch_assoc()['conName'];
        $r->data_seek($a);
        $data[2] = $r->fetch_assoc()['constName'];
        $r->data_seek($a);
        $data[3] = $r->fetch_assoc()['status'];
    }
    echo json_encode($data);
}

function editStateDetailsSaveSql($jsonData) {
    $con = connect();
    $data = json_decode($jsonData);
    $stat = 0;
    if ($data[2] === 'ACTIVE') {
        $stat = 1;
    }
    $sql = "UPDATE constituency SET constName='$data[1]',status=$stat WHERE constituency.constId=$data[0];";
    $action = 'MODIFIED Constituency DATA';
    $event = 'Successful Modification of County ' . $data[0] . ' data.';
    $con->query($sql);
    if ($con->error) {
        echo '<p class="text-danger">Changes not saved! Please try again. if this error occurs again contact Admin</p>';
    } else {
        auditLogger($action, $event);
        echo '<p><i class="fa fa-smile-o"></i> Changes successfully saved!</p>';
    }
}

function loadStatesSql($county) {
    $con = connect();
    $sql = "SELECT constituency.constName from constituency
            inner join county on county.conId = constituency.conId
            where county.conName = '$county';";
    $fb = "<option>---select State---</option>";
    $r = $con->query($sql);
    $rows = $r->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $fb .= '<option>' . $r->fetch_assoc()['constName'] . '</option>';
    }
    echo $fb;
}

function loadStatesSql1($county) {
    $con = connect();
    $sql = "SELECT constituency.constName from constituency
            inner join county on county.conId = constituency.conId
            where county.conName = '$county';";
    $fb = "<option>---select State---</option><option>ALL</option>";
    $r = $con->query($sql);
    $rows = $r->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $fb .= '<option>' . $r->fetch_assoc()['constName'] . '</option>';
    }
    echo $fb;
}

function AddPickupPoint($jsonData) {
    //json format 0->country 1->county, 2->state 3->address 4->des
    $con = connect();
    $data = json_decode($jsonData);
    //get the state id. statename = 2
    $sql1 = "SELECT constituency.constId from constituency where constituency.constName = '$data[2]';";
    $constid = '';
    $r1 = $con->query($sql1);
    for ($a = 0; $a < $r1->num_rows; $a++) {
        $r1->data_seek($a);
        $constid = $r1->fetch_assoc()['constId'];
    }

    $sql2 = "SELECT * FROM `pickuppoints` WHERE pickuppoints.pickupAddress LIKE '%$data[3]%' AND pickuppoints.pickupDescription LIKE '%$data[4]%';";
    $r2 = $con->query($sql2);
    if ($r2->num_rows > 0) {
        echo '<p class="text-danger">pickup point with addess <strong>' . $data[3] . '</strong> exists! Please try changing the wording then try again.</p>';
    } else {
        $sql = "INSERT INTO `pickuppoints`
                ( `constId`, `pickupAddress`, `pickupDescription`, `status`) 
                VALUES ($constid,'$data[3]','$data[4]',1);";
        $con->query($sql);

        if ($con->error) {
            echo '<p class="text-danger">pickup point not added! Please try again. if this error occurs again contact Admin</p>';
        } else {
            $action = 'ADDED NEW PICKUP POINT ';
            $event = 'Successful Addition of pickuppoint ' . $data[3] . ' data.';
            auditLogger($action, $event);
            echo '<p><i class="fa fa-smile-o"></i> Changes successfully saved!</p>';
        }
    }
}

function populateTableEditPickup($jsonData) {
    $data = json_decode($jsonData);
    $con = connect();
    $sql = "SELECT country.contName,county.conName, constituency.constName, pickuppoints.pickupAddress,pickuppoints.pickupid,pickuppoints.status from pickuppoints
            inner join constituency on constituency.constId = pickuppoints.constId
            inner join county on county.conId = constituency.conId
            inner join country on country.contId = county.conId ";
    $country = $data[0];
    $county = $data[1];
    $state = $data[2];
    $status = $data[3];

    if ($country === '---select Country---' && $county === '---select County---' && $state === '---select State---' && $status === '---select status---') {
        $sql .= " where country.status=1 and county.status=1 and constituency.status=1 ";
    } else if ($country === '---select Country---' && $county === '---select County---' && $state === '---select State---' && $status === 'ALL') {
        $sql .= " where country.status=1 and county.status=1 and constituency.status=1 ";
    } else if ($country === '---select Country---' && $county === '---select County---' && $state === '---select State---' && $status === 'ACTIVE') {
        $sql .= " where country.status=1 and county.status=1 and constituency.status=1 and pickuppoints.status=1 ";
    } else if ($country === '---select Country---' && $county === '---select County---' && $state === '---select State---' && $status === 'INACTIVE') {
        $sql .= " where country.status=1 and county.status=1 and constituency.status=1 and pickuppoints.status=0 ";
    } else if ($county === '---select County---' && $state === '---select State---' && $status === '---select status---') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and constituency.status=1 ";
    } else if ($county === '---select County---' && $state === '---select State---' && $status === 'ALL') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and constituency.status=1 ";
    } else if ($county === '---select County---' && $state === '---select State---' && $status === 'ACTIVE') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and constituency.status=1 and pickuppoints.status=1 ";
    } else if ($county === '---select County---' && $state === '---select State---' && $status === 'INACTIVE') {
        $sql .= " where country.status=1 and country.contName='$country' and constituency.status=1 and pickuppoints.status=0 ";
    } else if ($county === 'ALL' && $state === '---select State---' && $status === '---select status---') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and constituency.status=1 ";
    } else if ($county === 'ALL' && $state === '---select State---' && $status === 'ALL') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and constituency.status=1 ";
    } else if ($county === 'ALL' && $state === '---select State---' && $status === 'ACTIVE') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and constituency.status=1 and pickuppoints.status=1 ";
    } else if ($county === 'ALL' && $state === '---select State---' && $status === 'INACTIVE') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 constituency.status=1 and pickuppoints.status=0 ";
    } else if ($county === 'ALL' && $state === 'ALL' && $status === '---select status---') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and constituency.status=1 ";
    } else if ($county === 'ALL' && $state === 'ALL' && $status === 'ALL') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and constituency.status=1 ";
    } else if ($county === 'ALL' && $state === 'ALL' && $status === 'ACTIVE') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and constituency.status=1 and pickuppoints.status=1 ";
    } else if ($county === 'ALL' && $state === 'ALL' && $status === 'INACTIVE') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 constituency.status=1 and pickuppoints.status=0 ";
    } else if ($state === '---select State---' && $status === '---select status---') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and county.conName='$county' and constituency.status=1 ";
    } else if ($state === '---select State---' && $status === 'ALL') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and county.conName='$county' and constituency.status=1 ";
    } else if ($state === '---select State---' && $status === 'ACTIVE') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and county.conName='$county' and constituency.status=1 and pickuppoints.status=1 ";
    } else if ($state === '---select State---' && $status === 'INACTIVE') {
        $sql .= " where country.status=1 and country.contName='$country' county.status=1 and county.conName='$county'and constituency.status=1 and pickuppoints.status=0 ";
    } else if ($state === 'ALL' && $status === '---select status---') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and county.conName='$county' and constituency.status=1 ";
    } else if ($state === 'ALL' && $status === 'ALL') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and county.conName='$county' and constituency.status=1 ";
    } else if ($state === 'ALL' && $status === 'ACTIVE') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and county.conName='$county' and constituency.status=1 and pickuppoints.status=1 ";
    } else if ($state === 'ALL' && $status === 'INACTIVE') {
        $sql .= " where country.status=1 and country.contName='$country' county.status=1 and county.conName='$county'and constituency.status=1 and pickuppoints.status=0 ";
    } else if ($status === '---select status---') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and county.conName='$county' and constituency.status=1 and constituency.constName = '$state' ";
    } else if ($status === 'ALL') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and county.conName='$county' and constituency.status=1 and constituency.constName = '$state' ";
    } else if ($status === 'ACTIVE') {
        $sql .= " where country.status=1 and country.contName='$country' and county.status=1 and county.conName='$county' and constituency.status=1 and constituency.constName = '$state'  and pickuppoints.status=1 ";
    } else if ($status === 'INACTIVE') {
        $sql .= " where country.status=1 and country.contName='$country' county.status=1 and county.conName='$county'and constituency.status=1 and and constituency.constName = '$state'  pickuppoints.status=0 ";
    }

    $tr = '';
    $countrydb = '';
    $countydb = '';
    $statedb = '';
    $id = '';
    $addressdb = '';
    $statusdb = '';
    $statdb = 'ACTIVE';
    $r = $con->query($sql);
    $rows = $r->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $countrydb = $r->fetch_assoc()['contName'];

        $r->data_seek($a);
        $countydb = $r->fetch_assoc()['conName'];

        $r->data_seek($a);
        $id = $r->fetch_assoc()['pickupid'];

        $r->data_seek($a);
        $statedb = $r->fetch_assoc()['constName'];

        $r->data_seek($a);
        $addressdb = $r->fetch_assoc()['pickupAddress'];

        $r->data_seek($a);
        $statusdb = $r->fetch_assoc()['status'];

        if ((int) $statusdb === 0) {
            $statdb = 'INACTIVE';
        }
        $tr .= ' <tr>
                <td>' . ($a + 1) . '</td>
                <td>' . $countrydb . '</td>
                <td>' . $countydb . '</td>
                <td>' . $statedb . '</td>
                <td>' . $addressdb . '</td>
                <td>' . $statdb . '</td>
                <td><button value="' . $id . '" onclick="editPickupPointData(this.value)" class="btn btn-warning"><i class="fa fa-edit"></i>...</button></td>
                </tr>
';
    }

    echo $tr;
}

function getPickupPointData($id) {
    $con = connect();
    $sql = "SELECT country.contName,county.conName, constituency.constName, pickuppoints.pickupAddress,pickuppoints.pickupDescription,pickuppoints.status from pickuppoints
            inner join constituency on constituency.constId = pickuppoints.constId
            inner join county on county.conId = constituency.conId
            inner join country on country.contId = county.conId where pickuppoints.pickupid=$id";
    $data = array();

    $r = $con->query($sql);
    $rows = $r->num_rows;

    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $data[0] = $r->fetch_assoc()['contName'];

        $r->data_seek($a);
        $data[1] = $r->fetch_assoc()['conName'];

        $r->data_seek($a);
        $data[2] = $r->fetch_assoc()['constName'];

        $r->data_seek($a);
        $data[3] = $r->fetch_assoc()['pickupAddress'];

        $r->data_seek($a);
        $data[4] = $r->fetch_assoc()['pickupDescription'];

        $r->data_seek($a);
        $data[5] = $r->fetch_assoc()['status'];
    }
    echo json_encode($data);
}

function pickupDetailsDataSave($jsonData) {
    //json format = [id,address,description,st]
    $con = connect();
    $data = json_decode($jsonData);
    $sql = "UPDATE pickuppoints SET pickuppoints.pickupAddress='$data[1]', pickuppoints.pickupDescription='$data[2]', pickuppoints.status=$data[3] where pickuppoints.pickupId=$data[0];";
    $con->query($sql);
    if ($con->error) {
        echo '<p class="text-danger">pickup point not added! Please try again. if this error occurs again contact Admin</p>';
    } else {
        $action = 'MODIFIED PICKUP POINT DATA ';
        $event = 'Successful modification of pickuppoint ' . $data[1] . ' data.';
        auditLogger($action, $event);
        echo '<p><i class="fa fa-smile-o"></i> Changes successfully saved!</p>';
    }
}

//==========================================
function checkOrder() {
    $con = connect();
    $sql = "SELECT count(clientorders.orderId) as openOrders from clientorders where clientorders.status = 'new';";
    $result = $con->query($sql);
    $newOrders = '';
    for ($a = 0; $a < $result->num_rows; $a++) {
        $result->data_seek($a);
        $newOrders = $result->fetch_assoc()['openOrders'];
    }
    echo $newOrders;
}
function checkOrderPending() {
    $con = connect();
    $sql = "SELECT count(clientorders.orderId) as openOrders from clientorders where clientorders.status = 'pending';";
    $result = $con->query($sql);
    $newOrders = '';
    for ($a = 0; $a < $result->num_rows; $a++) {
        $result->data_seek($a);
        $newOrders = $result->fetch_assoc()['openOrders'];
    }
    echo $newOrders;
}

function loadNewOrders() {
    $con = connect();
    $sql = "SELECT clientorders.orderNumber, clientorders.itemCount, clientorders.orderAmount, clientorders.status "
            . "FROM clientorders where clientorders.status='new'";
    $result = $con->query($sql);
    $rows = $result->num_rows;
    $array = array();
    $fb = '';
    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $array[0] = $result->fetch_assoc()['orderNumber'];

        $result->data_seek($a);
        $array[1] = $result->fetch_assoc()['itemCount'];

        $result->data_seek($a);
        $array[2] = $result->fetch_assoc()['orderAmount'];

        $result->data_seek($a);
        $array[3] = $result->fetch_assoc()['status'];

        $fb .= "<tr>
                <td>" . ($a + 1) . "</td>
                <td>" . $array[0] . "</td>
                <td>" . $array[1] . "</td>
                <td>" . moneyFormatter($array[2]) . "</td>
                <td><span class='label label-success'>" . $array[3] . "</span></td>
                <td>
                <button class='btn btn-warning'>
                    <i class='fa fa-folder-open-o'></i>...
                </button>
                
                </td>
                </tr>";
        $array[0] = $array[1] = $array[2] = $array[3] = '';
    }

    echo $fb;
}

function getOrderItems($orderNumber) {
    $con = connect();
    $sql = "SELECT 
            clientaddress.fname,clientaddress.lname,clientaddress.phone,
            clientaddress.addressdetails,clientaddress.addresstype,clientorders.orderitems,
            orderamount,clientorders.itemcount,clientorders.time,
            clientorders.date,clientorders.status,
            country.contName, county.conName, constituency.constName
            from clientorders 
            inner join
            clientaddress on clientaddress.addressId = clientorders.addressId
            inner join constituency on constituency.constId = clientaddress.constId
            inner join county on county.conId = constituency.conId
            inner join country on country.contId = county.contId
            where clientorders.ordernumber = '$orderNumber'";

//    $fb = '';
    $result = $con->query($sql);
//    echo 'welcome home';

    /*    This is what we will need to do 
      Get address details
     *     
     *     Get details for the items
     * 
     *     Get Map Details
     *  */
//    Address details
    $clientArray = array();

    $rows = $result->num_rows;

    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $clientArray[0] = $result->fetch_assoc()['fname'];


        $result->data_seek($a);
        $clientArray[1] = $result->fetch_assoc()['lname'];


        $result->data_seek($a);
        $clientArray[2] = $result->fetch_assoc()['phone'];


        $result->data_seek($a);
        $clientArray[3] = $result->fetch_assoc()['addressdetails'];


        $result->data_seek($a);
        $clientArray[4] = $result->fetch_assoc()['addresstype'];


        $result->data_seek($a);
        $clientArray[5] = $result->fetch_assoc()['orderitems'];


        $result->data_seek($a);
        $clientArray[6] = $result->fetch_assoc()['orderamount'];


        $result->data_seek($a);
        $clientArray[7] = $result->fetch_assoc()['time'];


        $result->data_seek($a);
        $clientArray[8] = $result->fetch_assoc()['date'];

        $result->data_seek($a);
        $clientArray[9] = $result->fetch_assoc()['status'];
        
         $result->data_seek($a);
        $clientArray[10] = $result->fetch_assoc()['contName'];

        $result->data_seek($a);
        $clientArray[11] = $result->fetch_assoc()['conName'];

        $result->data_seek($a);
        $clientArray[12] = $result->fetch_assoc()['constName'];
        
         $result->data_seek($a);
        $clientArray[13] = $result->fetch_assoc()['itemcount'];
    }

//    echo json_encode($clientArray);
    $orderItems = array();
    $orderItemsJson = json_decode($clientArray[5]);

    

//    this array contains all the product names.
//    From product names order the following data.
//   i will have a multidimension array with the following. product name,product,newprice,product img,
//   first array format
//   0-fname 1-lname 2-phone 3-addressdetails 4-addresstype 5-orderitems 6-orderitems 7-orderamount 8-itemcount 9-time 10-date 11-status
//   second array format
    //Format : 0->name 1-> price 2->image 3-> quantity
    //Array format : 0>name, 1->quantity

    $sql1 = "";

    for ($b = 0; $b < count($orderItemsJson); $b++) {
        $sql1 = "SELECT items.newPrice, items.itemPic from items WHERE items.itemName = '" . $orderItemsJson[$b][0] . "';";
        $result1 = $con->query($sql1);
        for ($c = 0; $c < $result1->num_rows; $c++) {
            $orderItems[$b][0] = $orderItemsJson[$b][0];
            $result1->data_seek($c);
            $orderItems[$b][1] = $result1->fetch_assoc()['newPrice'];
            $result1->data_seek($c);
            $orderItems[$b][2] = $result1->fetch_assoc()['itemPic'];
            $orderItems[$b][3] = $orderItemsJson[$b][1];
        }
    }
//    
    $finalArray = array();
    $finalArray[0] = json_encode($clientArray);
    $finalArray[1] = json_encode($orderItems);
//    
    echo json_encode($finalArray);
}
?>
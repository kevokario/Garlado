<?php

include '../Core/functions.php';
//sleep(2);

if (isset($_SESSION['marvel']) === false) {
    logout();
}

if (isset($_GET['cat'])) {

    $cat = $_GET['cat'];

//Code for addinf new member

    if ($cat === 'addMember') {
        $name = $_GET['name'];
        $mail = $_GET['mail'];
        $phone = $_GET['phone'];
        $level = $_GET['level'];
        $image = $_GET['image'];
        $stat = $_GET['stat'];
        addMember($name, $mail, $phone, $level, $image,$stat);
    } else if ($cat === 'viewMember') {
        viewMember();
    } else if ($cat === 'showDetails') {

        $id = $_GET['id'];
        showDetails($id);
    } else if ($cat === 'addGroup') {
        $name = $_GET['GroupName'];
        addGroup($name);
    } else if ($cat === 'viewGroup') {
        viewGroup();
    } else if ($cat === 'viewGroupFilter') {
        $filter = $_GET['key'];
        viewGroupFilter($filter);
    } else if ($cat === 'groupDataView') {
        $id = $_GET['GroupId'];

        groupDataView($id);
    } else if ($cat === 'updateGroup') {
        $id = $_GET['id'];
        $name = $_GET['name'];
        $status = $_GET['status'];
        $stat = 0;
        if ($status === 'ACTIVE') {
            $stat = 1;
        }
        updateGroup($id, $name, $stat);
    } else if($cat === 'editMember'){
        $id=$_GET['id'];
        editMember($id);
    } else if($cat === 'UpdateMemberDataB'){
        $id = $_GET['id'];
        $name = $_GET['name'];
        $email= $_GET['email'];
        $phone = $_GET['phone'];
        $level = $_GET['level'];
        $status = $_GET['status'];
//        echo 'WELL DONE no pic'.$id;
        UpdateMemberDataB($id,$name,$email,$phone,$level,$status);
    }
    else if($cat === 'UpdateMemberDataA'){
        $id = $_GET['id'];
        $name = $_GET['name'];
        $email= $_GET['email'];
        $phone = $_GET['phone'];
        $level = $_GET['level'];
        $status = $_GET['status'];
        $image = $_GET['image'];
//        echo 'WELL DONE pic'.$id;
        UpdateMemberDataA($id,$name,$email,$phone,$level,$status,$image);
    }
}
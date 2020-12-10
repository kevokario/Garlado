<?php

session_start();
error_reporting(0);
require_once ('AfricasTalkingGateway.php');

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

function loadMajors() {
  $sql_major = "select * from majorcategory WHERE majorcategory.status=1";
  $sql_categ = "select * from category where category.status = 1";
  $sql_minor = "select * from minorcategory where minorcategory.status=1";
    $con = connect();
    $rmajor = $con->query($sql_major);
    $rcateg = $con->query($sql_categ);
    $rminor = $con->query($sql_minor);

    $arraymajor = array();
    $arraycateg = array();
    $arrayminor = array();

    for($a=0;$a<$rmajor->num_rows;$a++){
      $id = $name = '';
      $rmajor->data_seek($a);   $id = $rmajor->fetch_assoc()['majorId'];
      $rmajor->data_seek($a);   $name = $rmajor->fetch_assoc()['majorName'];
      array_push($arraymajor,[
        'id'=>$id,
        'name'=>$name,
      ]);
    }

    for($a=0;$a<$rcateg->num_rows;$a++){
      $id = $name = '';
      $rcateg->data_seek($a);   $id = $rcateg->fetch_assoc()['catId'];
      $rcateg->data_seek($a);   $mjid = $rcateg->fetch_assoc()['majorId'];
      $rcateg->data_seek($a);   $name = $rcateg->fetch_assoc()['catName'];
      array_push($arraycateg,[
        'id'=>$id,
        'mjid'=>$mjid,
        'name'=>$name,
      ]);
    }

    for($a=0;$a<$rminor->num_rows;$a++){
      $id = $name = '';
      $rminor->data_seek($a);
         $id = $rminor->fetch_assoc()['minorId'];
      $rminor->data_seek($a);   $ctid = $rminor->fetch_assoc()['catId'];
      $rminor->data_seek($a);   $name = $rminor->fetch_assoc()['minorName'];
      array_push($arrayminor,[
        'id'=>$id,
        'ctid'=>$ctid,
        'name'=>$name,
      ]);
    }

    $af = array();
    $ac = array();
    $am = array();
    $categ_minors = array();
    $amin = array();
    for ($b=0; $b < count($arraycateg); $b++) {
      for ($c=0; $c < count($arrayminor) ; $c++) {
        if($arraycateg[$b]['id'] == $arrayminor[$c]['ctid']){
          array_push($amin,$arrayminor[$c]['name']);
        }
      }
        array_push($categ_minors,[$arraycateg[$b]['name'],$amin]);
        unset($amin);
        $amin = array();
    }

    $major_categ = array();
    $all = array();
    for ($a=0; $a < count($arraymajor); $a++) {
      for ($b=0; $b < count($arraycateg) ; $b++) {
        if($arraymajor[$a]['id'] == $arraycateg[$b]['mjid']){
          array_push($all,$categ_minors[$b]);
        }
      }
      array_push($major_categ,[$arraymajor[$a]['name'],$all]);
      unset($all);
      $all = array();
    }
    echo json_encode($major_categ);
}

function loadDataOnMajors($majorName) {
    $con = connect();
    $sql1 = "SELECT category.catName from category "
            . "INNER JOIN majorcategory ON majorcategory.majorId = category.majorId "
            . "WHERE majorcategory.majorName like '%$majorName%';";
//    $sql1 = "SELECT category.catName from category
//            INNER JOIN majorcategory ON majorcategory.majorId = category.majorId
//            WHERE majorcategory.majorName='$majorName'".'\'';
    $r1 = $con->query($sql1);
    $all = '';
    $minors = '';
    $catName = '';
    $minorName = '';
    for ($a = 0; $a < $r1->num_rows; $a++) {
        $r1->data_seek($a);
        $catName = $r1->fetch_assoc()['catName'];

        $sql2 = " SELECT minorcategory.minorName from minorcategory
            inner join category on category.catId = minorcategory.catId
            where category.catName LIKE '%$catName%';";

        $r2 = $con->query($sql2);
        for ($b = 0; $b < $r2->num_rows; $b++) {
            $r2->data_seek($b);
            $minorName = $r2->fetch_assoc()['minorName'];
            if (($b + 1) === $r2->num_rows) {
                $minors = $minors . '<a href="shop.php?q=' . $minorName . '&t=m23">' . $minorName . '</a>';
            } else {
                $minors = $minors . '<a href="shop.php?q=' . $minorName . '&t=m23">' . $minorName . '</a> | ';
            }
        }
        $all = $all . '<h4><a href="shop.php?q=' . $catName . '&t=c12">' . $catName . '</a></h4><p>' . $minors . '</p>';
        $minors = '';
    }
    echo $all;
//    echo $sql1;
}

function searchItem($itemName) {
    $con = connect();
    $sql = "SELECT items.itemName, items.itemId,
            majorcategory.status as mjs,category.status as cs,
            minorcategory.status as mns,brand.status as bs from items
            INNER JOIN minorcategory on minorcategory.minorId = items.minorId
            INNER JOIN brand on brand.brandId = items.itemId
            INNER JOIN category on minorcategory.catId = category.catId
            INNER JOIN majorcategory on category.majorId = majorcategory.majorId
            WHERE majorcategory.majorName LIKE '%$itemName%'
            OR category.catName like '%$itemName%' OR
            minorcategory.minorName LIKE '%$itemName%' OR
            brand.brandName LIKE '%$itemName%' OR
            items.itemName LIKE '%$itemName%';";
    $itemdb = '';
    $items = '';
    $itemId = '';
    $mjs = '';
    $cs = '';
    $mns = '';
    $bs = '';
    $r = $con->query($sql);
    for ($a = 0; $a < $r->num_rows; $a++) {
        $r->data_seek($a);
        $itemdb = $r->fetch_assoc()['itemName'];
        $r->data_seek($a);
        $itemId = $r->fetch_assoc()['itemId'];
        $r->data_seek($a);
        $mjs = $r->fetch_assoc()['mjs'];
        $r->data_seek($a);
        $cs = $r->fetch_assoc()['cs'];
        $r->data_seek($a);
        $mns = $r->fetch_assoc()['mns'];
        $r->data_seek($a);
        $bs = $r->fetch_assoc()['bs'];

        if ($mjs === 0 && $cs === 0 && $mns === 0 && $bs === 0) {

        } else {
            if ($a === 13) {
                break;
            }
            $items = $items . '<a onmouseover="filProduct(this.innerHTML,0)" onclick="filPClicked(this.innerHTML)">' . $itemdb . '</a>';
        }
    }
    echo $items;
}

function loadMajorGroupData() {
    $con = connect();
    $sql = "SELECT minorcategory.minorName,items.itemPic from minorcategory
            inner join items on items.minorId = minorcategory.minorId
            ORDER BY rand () limit 6;";
    $r1 = $con->query($sql);
    $fb = '';
    $name = '';
    $pic = '';
    $array = array();
    for ($a = 0; $a < $r1->num_rows; $a++) {
        $r1->data_seek($a);
        $name = $r1->fetch_assoc()['minorName'];

        $r1->data_seek($a);
        $pic = $r1->fetch_assoc()['itemPic'];

        $fb = $fb . '<a class="col-sm-3" href="shop.php?q=' . $name . '&t=m23">
                 <img src="productImages/' . $pic . '" alt="groupName Pic"/>
                 <p class="pname">' . $name . '</p>
                 </a>';
        array_push($array,[
          'url'=>'shop.php?q=' . $name . '&t=m23',
          'pic'=>'productImages/' . $pic,
          'name'=>$name
        ]);
    }
    // echo $fb;
    echo json_encode($array);
}

function loadMostBoughtData() {
    $con = connect();
    $sql = "SELECT minorcategory.minorName,items.itemName,items.itemPic,items.oldPrice,items.newPrice from items
            inner join minorcategory on minorcategory.minorId = items.minorId
            inner join category on category.catid=minorcategory.catid
            inner join majorcategory on majorcategory.majorId = category.majorId
            where majorcategory.status=1 and category.status=1 and minorcategory.status=1
            ORDER BY `minorcategory`.`minorName` ASC,rand()
            limit 12;";
    $minorName = '';
    $itemName = '';
    $itemPic = '';
    $oldPrice = '';
    $newPrice = '';
    $car = '';
    $dat = '';
    $r1 = $con->query($sql);
    $array_all = array();
    $array_sort = array();
    $array_minor = array();
    for ($a = 0; $a < $r1->num_rows; $a++) {
        $r1->data_seek($a);
        $minorName = $r1->fetch_assoc()['minorName'];

        $r1->data_seek($a);
        $itemName = $r1->fetch_assoc()['itemName'];

        $r1->data_seek($a);
        $itemPic = $r1->fetch_assoc()['itemPic'];

        $r1->data_seek($a);
        $oldPrice = $r1->fetch_assoc()['oldPrice'];

        $r1->data_seek($a);
        $newPrice = $r1->fetch_assoc()['newPrice'];

        array_push($array_all,['group'=>$minorName,'product'=>$itemName,'price'=>moneyFormat($newPrice), 'pic'=>"productImages/$itemPic"]);
        array_push($array_minor,['group'=>$minorName]);

    }
    $array_group = array();
    for ($a=0; $a < 8 ; $a++) {
        if(array_search($array_minor[$a]['group'],$array_group) == false){
          array_push($array_group,$array_minor[$a]['group']);
        }
    }
    array_shift($array_group);

    // echo '~' . $car . '!' . $dat . '|';
    $array_work = array();
    for ($a=0; $a <count($array_group) ; $a++) {

      for ($b=0; $b <count($array_all) ; $b++) {
          if($array_group[$a] === $array_all[$b]['group']){
            array_push($array_work, [
              'pic'=>$array_all[$b]['pic'],
              'product'=>$array_all[$b]['product'],
              'price'=>$array_all[$b]['price'],
              'url'=>'#',
              ]  );
          }
      }
      array_push($array_sort,['name'=>$array_group[$a],'filter'=>str_replace(" ", "_", $array_group[$a]),'data'=>$array_work]);
      unset($array_work);
      $array_work = array();
    }
    echo json_encode($array_sort);
    // echo "$sql";
}

function moneyFormat($data) {
    return number_format($data, 2, '.', ',');
}

function loadMajorGroup1Data() {
    $con = connect();
    // select three major group names
    $sql1 = "SELECT majorcategory.majorName, count(items.itemId) as total FROM majorcategory
            LEFT JOIN category on category.majorId = majorcategory.majorId
            LEFT join minorcategory on minorcategory.catId = category.catId
            LEFT JOIN items on items.minorId = minorcategory.minorId
            WHERE majorcategory.status = 1 AND category.status = 1 and minorcategory.status = 1 and items.status=1
            GROUP BY majorcategory.majorName
            ORDER by total DESC";
    $major = '';
    $minorName = '';
    $itemName = '';
    $itemPic = '';
    $oldPrice = '';
    $newPrice = '';
    $all = array();
    $hd = '';
    $car = '';
    $dat = '';
    $array_main = array();
    $array_content = array();
    $r = $con->query($sql1);
    for ($a = 0; $a < 3; $a++) {
        $r->data_seek($a);
        $major = $r->fetch_assoc()['majorName'];
        // $hd = $major . '<span class="pull-right"><a href="viewProduct?q=' . $major . '&t=m12" style="font-size:12px">See More...</span></a>';
        $sql2 = " SELECT category.catName,minorcategory.minorName, items.itemName,
                 items.itemPic, items.oldPrice,items.newPrice from items
                inner JOIN minorcategory on minorcategory.minorId= items.minorId
                INNER JOIN category on minorcategory.catId = category.catId
                INNER join majorcategory on majorcategory.majorId = category.majorId
                where
                majorcategory.status = 1 and majorcategory.majorName LIKE '%$major%'
                AND category.status = 1
                AND minorcategory.status = 1
                and items.status = 1 limit 9;";
        $r2 = $con->query($sql2);
        for ($b = 0; $b < $r2->num_rows; $b++) {
            $r2->data_seek($b);
            $minorName = $r2->fetch_assoc()['minorName'];

            $r2->data_seek($b);
            $itemName = $r2->fetch_assoc()['itemName'];

            $r2->data_seek($b);
            $itemPic = $r2->fetch_assoc()['itemPic'];

            $r2->data_seek($b);
            $oldPrice = $r2->fetch_assoc()['oldPrice'];

            $r2->data_seek($b);
            $newPrice = $r2->fetch_assoc()['newPrice'];

            array_push($array_content,[
              // 'minor_name'=>$minorName,
              'item_name'=>$itemName,
              'item_pic'=>'productImages/'.$itemPic,
              'item_price'=>moneyFormat($newPrice),
            ]);
            /*if ($b < 3) {
                if ($b === 0) {
                    $car = $car . ' <div class="item active">
                            <img src="../productImages/' . $itemPic . '" alt="Garlado Limited..." class=""/>
                            <div class="carousel-caption displayBig">
                                <h3>' . $itemName . '</h3>
                                    <p>For as low as Ksh: ' . moneyFormat($newPrice) . '</p>
                            </div>
                        </div>';
                } else {
                    $car = $car . ' <div class="item">
                            <img src="../productImages/' . $itemPic . '" alt="Garlado Limited..." class=""/>
                            <div class="carousel-caption displayBig">
                                <h3>' . $minorName . '</h3>
                                   <p>For as low as Ksh: ' . moneyFormat($newPrice) . '</p>
                            </div>
                        </div>';
                }
            } else {
                $dat = $dat . ' <a class="col-sm-4" href="viewProduct?q=' . $minorName . '&t=m23">
                            <img src="../productImages/' . $itemPic . '" alt="groupName Pic"/>
                            <p class="pname">' . $itemName . '</p>
                            <p class="pcash">Ksh: ' . moneyFormat($newPrice - 23) . '/- <del class="oldFee"> ' . moneyFormat($oldPrice) . '/-</del></p>
                        </a>';
            }*/
        }
        // $all[$a] = '~' . $car . '!' . $dat . '|' . $hd . '*';
        // $car = '';
        // $dat = '';
        // $hd = '';
        array_push($array_main,['name'=>$major,'data'=>$array_content]);
        unset($array_content);
        $array_content=array();
    }
    // echo '[' . $all[0] . ']' . $all[1] . '{' . $all[2] . '}';
   // echo $sql2;
      echo json_encode($array_main);
}

//======================view product data============================
function fetchCrumbData($queryName, $queryType) {
    $sql = 'some query';
    $r = '';
    $con = connect();
    $fb = 'some data';
//case 1: Fetching major category
    if ($queryType === 'm12') {
        $sql = "SELECT majorcategory.majorName from majorcategory where majorcategory.majorName LIKE '%$queryName%';";
        $r = $con->query($sql);
        $majorName = '';
        $rows = $r->num_rows;
        for ($a = 0; $a < $rows; $a++) {
            $r->data_seek($a);
            $majorName = $r->fetch_assoc()['majorName'];
        }
        $fb = '<li>' . $majorName . '</li>';
    }
//case 2: fetching category
    if ($queryType === 'c12') {

        $sql = "SELECT majorcategory.majorName, category.catName from category
                inner join majorcategory on majorcategory.majorId = category.majorId
                where category.catName like '%$queryName%';";
        $r = $con->query($sql);
        $majorName = '';
        $catName = '';
        $rows = $r->num_rows;
        for ($a = 0; $a < $rows; $a++) {
            $r->data_seek($a);
            $majorName = $r->fetch_assoc()['majorName'];
            $r->data_seek($a);
            $catName = $r->fetch_assoc()['catName'];
        }
        $fb = '<li>' . $majorName . '</li><li>' . $catName . '</li>';
    }
//case 3: fetching minorcategory
    if ($queryType === 'm23') {
        $sql = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName from minorcategory
                inner join category on category.catId = minorcategory.catId
                inner JOIN majorcategory on majorcategory.majorId = category.majorId
                where minorcategory.minorName LIKE '%$queryName%';";
        $r = $con->query($sql);
        $majorName = '';
        $catName = '';
        $minorName = '';
        $rows = $r->num_rows;
        for ($a = 0; $a < $rows; $a++) {
            $r->data_seek($a);
            $majorName = $r->fetch_assoc()['majorName'];
            $r->data_seek($a);
            $catName = $r->fetch_assoc()['catName'];
            $r->data_seek($a);
            $minorName = $r->fetch_assoc()['minorName'];
        }
        $fb = '<li>' . $majorName . '</li><li>' . $catName . '</li><li>' . $minorName . '</li>';
    }
    //case 4 : fetching items
    /* item will come right here */
    if ($queryType === 'search'){
        $sql = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName from items
                inner JOIN minorcategry on minorcategory.minorId = items.minorId
                inner JOIN category on minorcategory.catId = category.catId
                inner JOIN majorcategory on majorcategory.majorId = category.majorId
                where items.itemName LIKE '%$queryName%';";
                 $r = $con->query($sql);
                 $majorName = '';
                 $catName = '';
                 $minorName = '';
                 $rows = $r->num_rows;
                 for ($a = 0; $a < $rows; $a++) {
                     $r->data_seek($a);
                     $majorName = $r->fetch_assoc()['majorName'];
                     $r->data_seek($a);
                     $catName = $r->fetch_assoc()['catName'];
                     $r->data_seek($a);
                     $minorName = $r->fetch_assoc()['minorName'];
                 }
                 $fb = '<li>' . $majorName . '</li><li>' . $catName . '</li><li>' . $minorName . '</li>';
    }
    echo $fb;
}

function loadTreeData($queryName, $queryType) {
    $con = connect();
    $majorName = "";
    $sql = '';
    $fb = '';
//major
    if ($queryType === 'm12') {
        $majorName = $queryName;
    }
//cat
    if ($queryType === 'c12') {
        $sql = "SELECT majorcategory.majorName, category.catName from category
                inner JOIN majorcategory on majorcategory.majorId = category.majorId
                where category.catName LIKE '%$queryName%';";
    }
//minor
    if ($queryType === 'm23') {
        $sql = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName from minorcategory
                inner JOIN category on minorcategory.catId = category.catId
                inner JOIN majorcategory on majorcategory.majorId = category.majorId
                where minorcategory.minorName LIKE '%$queryName%';";
    }
//item
    /* item will come right here */
    if ($queryType === 'search'){
        $sql = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName from items
                inner JOIN minorcategry on minorcategory.minorId = items.minorId
                inner JOIN category on minorcategory.catId = category.catId
                inner JOIN majorcategory on majorcategory.majorId = category.majorId
                where items.itemName LIKE '%$queryName%';";
    }
    $r1 = $con->query($sql);
    $rows1 = $r1->num_rows;
    for ($a = 0; $a < $rows1; $a++) {
        $r1->data_seek($a);
        $majorName = $r1->fetch_assoc()['majorName'];
    }

    $sql1 = "SELECT category.catName from category
            inner JOIN majorcategory on majorcategory.majorId = category.majorId
            where majorcategory.majorName LIKE '%$majorName%';";
    $r2 = $con->query($sql1);
    $rows2 = $r2->num_rows;
    $catName = '';

    for ($b = 0; $b < $rows2; $b++) {
        $r2->data_seek($b);
        $catName = $r2->fetch_assoc()['catName'];
        $fb = $fb . '<li><a href="shop.php?q=' . $catName . '&t=c12"> ' . $catName . ' </a></li>';
    }

    echo '~' . $majorName . '_' . $fb . '#';
}

function loadBrandData($queryName, $queryType) {
    $con = connect();
    $sql = "";
    $fb = '<p class="radio" ><span>ALL</span><span class="pull-right"><input type="radio" name="opt" onclick="brandClicked($(this).parent().parent())"/></span></p>';
    ;
    $brand = "";
//major
    if ($queryType === 'm12') {
        $sql = "SELECT brand.brandName from majorcategory
                inner join brand on majorcategory.majorId = brand.majorId
                where majorcategory.majorName LIKE '%$queryName%'";
    }
//cat
    if ($queryType === 'c12') {
        $sql = "SELECT brand.brandName from category
                inner JOIN majorcategory on majorcategory.majorId = category.majorId
                inner join brand on majorcategory.majorId = brand.majorId
                where category.catName like '%$queryName%'";
    }
//minor
    if ($queryType === 'm23') {
        $sql = "SELECT brand.brandName from minorcategory
                inner join category on category.catId = minorcategory.catId
                inner JOIN majorcategory on majorcategory.majorId = category.majorId
                inner join brand on brand.majorId = majorcategory.majorId
                where minorcategory.minorName LIKE '%$queryName%';";
    }

    //item
    /* item will come right here */
    if ($queryType === 'search'){
        $sql = "SELECT brand.brandName from items
                inner JOIN minorcategry on minorcategory.minorId = items.minorId
                inner JOIN category on minorcategory.catId = category.catId
                inner JOIN majorcategory on majorcategory.majorId = category.majorId
                inner join brand on brand.majorId = majorcategory.majorId
                where items.itemName LIKE '%$queryName%';";
    }
    $r = $con->query($sql);
    $rows = $r->num_rows;

    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $brand = $r->fetch_assoc()['brandName'];
        $fb = $fb . '<p class="radio" ><span>' . $brand . '</span><span class="pull-right"><input type="radio" name="opt" onclick="brandClicked($(this).parent().parent())"/></span></p>';
    }
    echo $fb;
}

/*
  function loadFeatures($queryName, $queryType) {
  $con = connect();
  $sql = "SELECT majorcategory.majorName,category.catName, minorcategory.minorName, items.itemName,
  featurescomps.ram,featurescomps.rom, featurescomps.displaySize,
  featurescomps.operatingSystem, featurescomps.processor from featurescomps
  inner join items on items.itemId =featurescomps.itemId
  inner join minorcategory on minorcategory.minorId = items.minorId
  inner JOIN category on category.catId = minorcategory.catId
  inner JOIN majorcategory on majorcategory.majorId = category.majorId ";
  //major
  if ($queryType === 'm12') {
  $sql = $sql . " WHERE majorcategory.majorName LIKE '%$queryName%';";
  }
  //cat
  if ($queryType === 'c12') {
  $sql = $sql . " WHERE category.catName LIKE '%$queryName%';";
  }
  //minor
  if ($queryType === 'm23') {
  $sql = $sql . " WHERE minorcategory.minorName LIKE '%$queryName%';";
  }

  $r = $con->query($sql);
  $rows = $r->num_rows;
  $fb = '';
  $tp = '';
  //item features exist / not exits
  //does not exist
  if ($rows === 0) {
  $tp = 'nt';
  }
  //exists
  else {
  $tp = 'it';
  $dataram = '';
  $datarom = '';
  $datasize = '';
  $dataos = '';
  $dataproc = '';

  for ($a = 0; $a < $rows; $a++) {
  $r->data_seek($a);
  $dataram = $dataram . ' <p class="radio" >' . $r->fetch_assoc()['ram'] . '<span class="pull-right"><input type="radio" name="opt" onclick="test($(this).parent().parent().text())"/></span></p>';
  $r->data_seek($a);
  $datarom = $datarom . ' <p class="radio" >' . $r->fetch_assoc()['rom'] . '<span class="pull-right"><input type="radio" name="opt" onclick="test($(this).parent().parent().text())"/></span></p>';
  $r->data_seek($a);
  $datasize = $datasize . ' <p class="radio" >' . $r->fetch_assoc()['displaySize'] . '<span class="pull-right"><input type="radio" name="opt" onclick="test($(this).parent().parent().text())"/></span></p>';
  $r->data_seek($a);
  $dataos = $dataos . ' <p class="radio" >' . $r->fetch_assoc()['operatingSystem'] . '<span class="pull-right"><input type="radio" name="opt" onclick="test($(this).parent().parent().text())"/></span></p>';
  $r->data_seek($a);
  $dataproc = $dataproc . ' <p class="radio" >' . $r->fetch_assoc()['processor'] . '<span class="pull-right"><input type="radio" name="opt" onclick="test($(this).parent().parent().text())"/></span></p>';
  }
  $fb = '~it!' . $dataram . '@' . $datarom . '#' . $datasize . '_' . $dataos . '%' . $dataproc . '^';
  }

  echo $fb;
  }
 */

function loadProducts($queryName, $queryType) {
    $con = connect();
    $limitArray = getMyLimiter();
    $sql1 = "limit 0,$limitArray";
    $sql = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName, items.itemName,
            items.itemPic, brand.brandName, items.newPrice, items.oldPrice, items.itemId from items
            inner join minorcategory on minorcategory.minorId = items.minorId
            INNER join brand on  items.brandId = brand.brandId
            inner join category on category.catId = minorcategory.catId
            inner join majorcategory on majorcategory.majorId = category.majorId ";

//major
    if ($queryType === 'm12') {
        $sql = $sql . " where majorcategory.majorName like '%$queryName%' ";
    }
//cat
    if ($queryType === 'c12') {
        $sql = $sql . " where category.catName like '%$queryName%' ";
    }
//minor
    if ($queryType === 'm23') {
        $sql = $sql . " where minorcategory.minorName like '%$queryName%' ";
    }
//items
    if ($queryType === 'search') {
        $sql = $sql." where items.itemname like '%$queryName%' ";
    }
    $pname = '';
    $pbrand = '';
    $newfee = '';
    $oldfee = '';
    $id = '';
    $pic = '';
    $fb = '';
    $array = array();
    
    $r = $con->query($sql . $sql1);
    $rows = $r->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $pname = $r->fetch_assoc()['itemName'];
        $r->data_seek($a);
        $pbrand = $r->fetch_assoc()['brandName'];
        $r->data_seek($a);
        $newfee = $r->fetch_assoc()['newPrice'];
        $r->data_seek($a);
        $oldfee = $r->fetch_assoc()['oldPrice'];
        $r->data_seek($a);
        $id = $r->fetch_assoc()['itemId'];
        $r->data_seek($a);
        $pic = $r->fetch_assoc()['itemPic'];
        array_push($array,[
            'name'=>$pname,
            'image'=>'productImages/'.$pic,
            'price'=>moneyFormat($newfee)
        ]);
        
        $fb = $fb . '<div class="col-sm-3">
                                <a href="productDetails?name=' . $pname . '"><img src="../productImages/' . $pic . '" alt="' . $pname . '"/></a>
                                <p class="productBrandName">' . $pbrand . '</p>
                                <p class="productName">' . $pname . '</p>
                                <p  class="pcash">Ksh ' . moneyFormat($newfee) . '
                                    <del class="oldFee">Ksh ' . moneyFormat($oldfee) . '</del>
                                </p>
                                <div class="col-sm-12 text-center">
                                    <button value="' . $pname . '" onclick="addToCart(this.value,this)" class="cartbtn">
                                        Add To Cart
                                        <i class="fa fa-cart-plus"></i>
                                    </button>
                                   <button value="' . $pname . '" onclick="buyProduct(this.value,this)" class="buybtn">
                                        Buy Now
                                        <i class="fa fa-money"></i>
                                    </button>
                                </div>
                            </div>';
    }
    // echo $fb;
    echo json_encode($array);
}

function priceFilter($queryName, $queryType, $fromPrice, $toPrice, $sortMethod) {
    $con = connect();
    $sql = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName, items.itemName,
            items.itemPic, brand.brandName, items.newPrice, items.oldPrice, items.itemId from items
            inner join minorcategory on minorcategory.minorId = items.minorId
            INNER join brand on  items.brandId = brand.brandId
            inner join category on category.catId = minorcategory.catId
            inner join majorcategory on majorcategory.majorId = category.majorId ";
    $sql1 = '';
    if ($sortMethod === 'Price ASC') {
        $sql1 = " Order by items.newPrice asc ";
    }
    if ($sortMethod === 'Price DESC') {
        $sql1 = " Order by items.newPrice desc ";
    }
    if ($sortMethod === 'Name ASC') {
        $sql1 = " Order by items.itemName asc ";
    }
    if ($sortMethod === 'Name DESC') {
        $sql1 = " Order by items.itemName desc ";
    }
//major
    if ($queryType === 'm12') {
        $sql = $sql . " where majorcategory.majorName like '%$queryName%' AND items.newPrice BETWEEN $fromPrice AND $toPrice";
    }
//cat
    if ($queryType === 'c12') {
        $sql = $sql . " where category.catName like '%$queryName%' AND items.newPrice BETWEEN $fromPrice AND $toPrice";
    }
//minor
    if ($queryType === 'm23') {
        $sql = $sql . " where minorcategory.minorName like '%$queryName%' AND items.newPrice BETWEEN $fromPrice AND $toPrice";
    }
//item
    if ($queryType === 'search') {
        $sql = $sql . " where items.itemName like '%$queryName%' AND items.newPrice BETWEEN $fromPrice AND $toPrice";
    }
    $pname = '';
    $pbrand = '';
    $newfee = '';
    $oldfee = '';
    $id = '';
    $pic = '';
    $fb = '';
    $r = $con->query($sql . $sql1);
//--------------------------------------------------------------------------------------------
    /* ----+Populate the pagination with this data+---- */
    $rowsData = $r->num_rows;
    $number = getLimiter($rowsData);
//    $number = 9;
    $fbNav = '';
    for ($a = 0; $a < $number; $a++) {
        if ($a === 4) {
            $fbNav .= '<li><a onclick="pagerClicked(this.innerHTML,this)"><i class="fa fa-chevron-right"></i></a></li>';
            break;
        }
        $fbNav .= '<li><a onclick="pagerClicked(this.innerHTML,this)">' . ($a + 1) . '</a></li>';
    }
//--------------------------------------------------------------------------------------------
    $rows = getMyLimiter();
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $pname = $r->fetch_assoc()['itemName'];
        $r->data_seek($a);
        $pbrand = $r->fetch_assoc()['brandName'];
        $r->data_seek($a);
        $newfee = $r->fetch_assoc()['newPrice'];
        $r->data_seek($a);
        $oldfee = $r->fetch_assoc()['oldPrice'];
        $r->data_seek($a);
        $id = $r->fetch_assoc()['itemId'];
        $r->data_seek($a);
        $pic = $r->fetch_assoc()['itemPic'];

        if (strlen($pname) === 0) {
            break;
        }

        $fb = $fb . '<div class="col-sm-3">
                                <a href="product.php?name=' . $pname . '"><img src="../productImages/' . $pic . '" alt="' . $pname . '"/></a>
                                <p class="productBrandName">' . $pbrand . '</p>
                                <p class="productName">' . $pname . '</p>
                                <p  class="pcash">Ksh ' . moneyFormat($newfee) . '
                                    <del class="oldFee">Ksh ' . moneyFormat($oldfee) . '</del>
                                </p>
                                <div class="col-sm-12 text-center">
                                    <button value="' . $pname . '" onclick="addToCart(this.value,this)" class="cartbtn">
                                        Add To Cart
                                        <i class="fa fa-cart-plus"></i>
                                    </button>
                                    <button value="' . $pname . '" onclick="buyProduct(this.value,this)" class="buybtn">
                                        Buy Now
                                        <i class="fa fa-money"></i>
                                    </button>
                                </div>
                            </div>';
    }
    echo '{' . $fb . '}' . $fbNav . '~';
}

function sortFilter($queryName, $queryType, $fromPrice, $toPrice, $filterName, $pr) {
    $con = connect();
    $sql1 = "";
    $sql2 = "";
    if ($pr === 'set') {
        $sql1 = " AND items.newPrice BETWEEN $fromPrice AND $toPrice ";
    }
    if ($filterName === 'Price ASC') {
        $sql2 = "Order by items.newPrice asc ";
    }
    if ($filterName === 'Price DESC') {
        $sql2 = "Order by items.newPrice desc ";
    }
    if ($filterName === 'Name ASC') {
        $sql2 = "Order by items.itemName asc ";
    }
    if ($filterName === 'Name DESC') {
        $sql2 = "Order by items.itemName desc ";
    }
    $sql = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName, items.itemName,
            items.itemPic, brand.brandName, items.newPrice, items.oldPrice, items.itemId from items
            inner join minorcategory on minorcategory.minorId = items.minorId
            INNER join brand on  items.brandId = brand.brandId
            inner join category on category.catId = minorcategory.catId
            inner join majorcategory on majorcategory.majorId = category.majorId ";
//major
    if ($queryType === 'm12') {
        $sql = $sql . " where majorcategory.majorName like '%$queryName%' " . $sql1 . $sql2;
    }
//cat
    if ($queryType === 'c12') {
        $sql = $sql . " where category.catName like '%$queryName%' " . $sql1 . $sql2;
    }
//minor
    if ($queryType === 'm23') {
        $sql = $sql . " where minorcategory.minorName like '%$queryName%' " . $sql1 . $sql2;
    }
//items
    if ($queryType === 'search') {
        $sql = $sql . " where items.itemName like '%$queryName%' " . $sql1 . $sql2;
    }
    $pname = '';
    $pbrand = '';
    $newfee = '';
    $oldfee = '';
    $id = '';
    $pic = '';
    $fb = '';
    $array = array();
    $r = $con->query($sql);
    
//    $rows = $r->num_rows;
    $rows = getMyLimiter();

    //--------------------------------------------------------------------------------------------
    /* ----+Populate the pagination with this data+---- */
    $rowsData = $r->num_rows;
    $number = getLimiter($rowsData);
//    $number = 9;
    $fbNav = '';
    for ($a = 0; $a < $number; $a++) {
        if ($a === 4) {
            $fbNav .= '<a onclick="pagerClicked(this.innerHTML,this)"><i class="fa fa-chevron-right"></i></a>';
            break;
        }
        $fbNav .= '<a onclick="pagerClicked(this.innerHTML,this)">' . ($a + 1) . '</a>';
    }
//--------------------------------------------------------------------------------------------
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $pname = $r->fetch_assoc()['itemName'];
        $r->data_seek($a);
        $pbrand = $r->fetch_assoc()['brandName'];
        $r->data_seek($a);
        $newfee = $r->fetch_assoc()['newPrice'];
        $r->data_seek($a);
        $oldfee = $r->fetch_assoc()['oldPrice'];
        $r->data_seek($a);
        $id = $r->fetch_assoc()['itemId'];
        $r->data_seek($a);
        $pic = $r->fetch_assoc()['itemPic'];
        if (strlen($pname) === 0) {
            break;
        }
        array_push($array,[
            'name'=>$pname,
            'image'=>'productImages/'.$pic,
            'price'=>moneyFormat($newfee)
        ]);
        /*$fb = $fb . '<div class="col-sm-3">
                                 <a href="productDetails?name=' . $pname . '"><img src="../productImages/' . $pic . '" alt="' . $pname . '"/></a>
                                <p class="productBrandName">' . $pbrand . '</p>
                                <p class="productName">' . $pname . '</p>
                                <p  class="pcash">Ksh ' . moneyFormat($newfee) . '
                                    <del class="oldFee">Ksh ' . moneyFormat($oldfee) . '</del>
                                </p>
                                <div class="col-sm-12 text-center">
                                    <button value="' . $pname . '" onclick="addToCart(this.value,this)" class="cartbtn">
                                        Add To Cart
                                        <i class="fa fa-cart-plus"></i>
                                    </button>
                                    <button value="' . $pname . '" onclick="buyProduct(this.value,this)" class="buybtn">
                                        Buy Now
                                        <i class="fa fa-money"></i>
                                    </button>
                                </div>
                            </div>';*/
    }
   
    echo json_encode([json_encode($array),json_encode($fbNav)]);
    // echo $fb;
}

function loadPagination($queryName, $queryType) {
    $con = connect();
    $sql = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName, items.itemName,
            items.itemPic, brand.brandName, items.newPrice, items.oldPrice, items.itemId from items
            inner join minorcategory on minorcategory.minorId = items.minorId
            INNER join brand on  items.brandId = brand.brandId
            inner join category on category.catId = minorcategory.catId
            inner join majorcategory on majorcategory.majorId = category.majorId ";
//major
    if ($queryType === 'm12') {
        $sql = $sql . " where majorcategory.majorName like '%$queryName%'";
    }
//cat
    if ($queryType === 'c12') {
        $sql = $sql . " where category.catName like '%$queryName%'";
    }
//minor
    if ($queryType === 'm23') {
        $sql = $sql . " where minorcategory.minorName like '%$queryName%'";
    }
//item
    if ($queryType === 'search') {
        $sql = $sql . " where items.itemName like '%$queryName%'";
    }

    $r = $con->query($sql);
    $rows = $r->num_rows;
    $number = getLimiter($rows);
//    $number = 9;
    $fb = '';
    for ($a = 0; $a < $number; $a++) {
        if ($a === 4) {
            $fb .= '<a onclick="pagerClicked(this.innerHTML,this)"><i class="fa fa-chevron-right"></i></a>';
            break;
        }
        $fb .= '<a onclick="pagerClicked(this.innerHTML,this)">' . ($a + 1) . '</a>';
    }
    echo $fb;
}

//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
//                                                                                               !!
//                                    Set The Limiter Here!                                      !!
//                                                                                               !!
//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!


class limitValue {

    public $currentValueStart = 0;

    public function setCurrentValue($value) {
        $this->currentValue = $value;
    }

    public function getCurrentValue() {
        return $this->currentValue;
    }

}

//Globa data
//This code segment handles the fetching of items from the db based on selected limits
// alter getMyLimiter Value to a number of products you want to see per page
// currently set to two items per page
// getMyLimiterSql() returns an array with the limit values to be used when fetching data based on the current load page
// during first item load, the items are set to 0 and 2 (current limiter value)
// data in getMyLimiterSQL is the number provided by the clicked list
//+++++++++++++++++++++++++++++++++++++++++++++++++++++
function getMyLimiter() {
    return 6;
}

function getMyLimiterSql($data) {
    $rowIndex = ($data - 1) * getMyLimiter();
    $limitValue = new limitValue();
    $limitValue->setCurrentValue($rowIndex);
    return $rowIndex;
}

function getLimiter($name) {
    $dat = getMyLimiter();
    $tot = (int) $name / $dat;
    $rem = (int) $name % $dat;
    if ($rem > 0) {
        $rem = 1;
    }
    return (int) $tot + $rem;
}

//+++++++++++++++++++++++++++++++++++++++++++++++++++++


function pagerClicked($queryName, $queryType, $data, $priceFrom, $priceTo, $filter, $brand) {
    $con = connect();
    $limitSize = getMyLimiter();
    $limitStart = getMyLimiterSql($data);
    $sql4 = "limit $limitStart,$limitSize";
    $sql2 = '';
    $sql3 = '';
    $sql1 = '';
    $sql = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName, items.itemName,
            items.itemPic, brand.brandName, items.newPrice, items.oldPrice, items.itemId from items
            inner join minorcategory on minorcategory.minorId = items.minorId
            INNER join brand on  items.brandId = brand.brandId
            inner join category on category.catId = minorcategory.catId
            inner join majorcategory on majorcategory.majorId = category.majorId ";

//major
    if ($queryType === 'm12') {
        $sql = $sql . " where majorcategory.majorName like '%$queryName%' ";
    }
//cat
    if ($queryType === 'c12') {
        $sql = $sql . " where category.catName like '%$queryName%' ";
    }
//minor
    if ($queryType === 'm23') {
        $sql = $sql . " where minorcategory.minorName like '%$queryName%' ";
    }
    //item
    if ($queryType === 'search') {
        $sql = $sql . " where items.itemName like '%$queryName%' ";
    }

//check if price value and filter are set
//case 1 : check if the prices are set
    if (strlen($priceFrom) > 0 && strlen($priceTo) > 0) {
        $sql1 = " and items.newPrice between $priceFrom and $priceTo ";
    }
//case 2 : check for filter
    if ($filter === 'Price ASC') {
        $sql3 = " Order by items.newPrice asc ";
    }
    if ($filter === 'Price DESC') {
        $sql3 = " Order by items.newPrice desc ";
    }
    if ($filter === 'Name ASC') {
        $sql3 = " Order by items.itemName asc ";
    }
    if ($filter === 'Name DESC') {
        $sql3 = " Order by items.itemName desc ";
    }
//case 3 : check brandType
    if (strlen($brand) > 0 && $brand !== 'ALL') {
        $sql2 = " and brand.brandName like '%$brand%' ";
    }
    $sqlgrand = $sql . $sql1 . $sql2 . $sql3 . $sql4;
    $r = $con->query($sqlgrand);
    $pname = '';
    $pbrand = '';
    $newfee = '';
    $oldfee = '';
    $id = '';
    $pic = '';
    $fb = '';
    $array = array();
    $rows = $r->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $pname = $r->fetch_assoc()['itemName'];
        $r->data_seek($a);
        $pbrand = $r->fetch_assoc()['brandName'];
        $r->data_seek($a);
        $newfee = $r->fetch_assoc()['newPrice'];
        $r->data_seek($a);
        $oldfee = $r->fetch_assoc()['oldPrice'];
        $r->data_seek($a);
        $id = $r->fetch_assoc()['itemId'];
        $r->data_seek($a);
        $pic = $r->fetch_assoc()['itemPic'];
        array_push($array,[
            'name'=>$pname,
            'image'=>'productImages/'.$pic,
            'price'=>moneyFormat($newfee)
        ]);
        $fb = $fb . '<div class="col-sm-3">
                                 <a href="shop.php?name=' . $pname . '"><img src="../productImages/' . $pic . '" alt="' . $pname . '"/></a>
                                <p class="productBrandName">' . $pbrand . '</p>
                                <p class="productName">' . $pname . '</p>
                                <p  class="pcash">Ksh ' . moneyFormat($newfee) . '
                                    <del class="oldFee">Ksh ' . moneyFormat($oldfee) . '</del>
                                </p>
                                <div class="col-sm-12 text-center">
                                    <button value="' . $pname . '" onclick="addToCart(this.value,this)" class="cartbtn">
                                        Add To Cart
                                        <i class="fa fa-cart-plus"></i>
                                    </button>
                                    <button value="' . $pname . '" onclick="buyProduct(this.value,this)" class="buybtn">
                                        Buy Now
                                        <i class="fa fa-money"></i>
                                    </button>
                                </div>
                            </div>';
    }
    // echo $fb;
//    echo $sqlgrand;

echo json_encode($array);
}

function loadNextMenu($queryName, $queryType, $lastItem, $priceFrom, $priceTo, $brand) {
    $con = connect();
    $sql2 = '';
    $sql3 = '';
    $sql1 = '';
    $sql = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName, items.itemName,
            items.itemPic, brand.brandName, items.newPrice, items.oldPrice, items.itemId from items
            inner join minorcategory on minorcategory.minorId = items.minorId
            INNER join brand on  items.brandId = brand.brandId
            inner join category on category.catId = minorcategory.catId
            inner join majorcategory on majorcategory.majorId = category.majorId ";

//major
    if ($queryType === 'm12') {
        $sql = $sql . " where majorcategory.majorName like '%$queryName%' ";
    }
//cat
    if ($queryType === 'c12') {
        $sql = $sql . " where category.catName like '%$queryName%' ";
    }
//minor
    if ($queryType === 'm23') {
        $sql = $sql . " where minorcategory.minorName like '%$queryName%' ";
    }

 //item
    if ($queryType === 'search') {
        $sql = $sql . " where items.itemName like '%$queryName%' ";
    }

//check if price value and filter are set
//case 1 : check if the prices are set
    if (strlen($priceFrom) > 0 && strlen($priceTo) > 0) {
        $sql1 = " and items.newPrice between $priceFrom and $priceTo ";
    }
//case 2 : check for filter
//case 3 : check brandType
    if (strlen($brand) > 0 && $brand !== 'ALL') {
        $sql2 = " and brand.brandName like '%$brand%' ";
    }
    $sqlgrand = $sql . $sql1 . $sql2 . $sql3;
    $r = $con->query($sqlgrand);
    $rows = $r->num_rows;
    $number = getLimiter($rows) - $lastItem;
//    $number = 9;
    $fb = '';
    for ($a = 0; $a < $number; $a++) {
        if ($a === 0) {
            $fb = '<a onclick="pagerClicked(this.innerHTML,this)"><i class="fa fa-chevron-left"></i></a>';
        }
        if ($a === 4) {
            $fb = $fb . '<a onclick="pagerClicked(this.innerHTML,this)"><i class="fa fa-chevron-right"></i></a>';
            break;
        }
        $fb = $fb . '<a onclick="pagerClicked(this.innerHTML,this)">' . ($a + ($lastItem + 1)) . '</a>';
    }
    echo $fb;
}

function loadPrevMenu($queryName, $queryType, $lastItem, $priceFrom, $priceTo, $brand) {
    $con = connect();
    $sql2 = '';
    $sql3 = '';
    $sql1 = '';
    $sql = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName, items.itemName,
            items.itemPic, brand.brandName, items.newPrice, items.oldPrice, items.itemId from items
            inner join minorcategory on minorcategory.minorId = items.minorId
            INNER join brand on  items.brandId = brand.brandId
            inner join category on category.catId = minorcategory.catId
            inner join majorcategory on majorcategory.majorId = category.majorId ";

//major
    if ($queryType === 'm12') {
        $sql = $sql . " where majorcategory.majorName like '%$queryName%' ";
    }
//cat
    if ($queryType === 'c12') {
        $sql = $sql . " where category.catName like '%$queryName%' ";
    }
//minor
    if ($queryType === 'm23') {
        $sql = $sql . " where minorcategory.minorName like '%$queryName%' ";
    }
//item
    if ($queryType === 'search') {
        $sql = $sql . " where items.itemName like '%$queryName%' ";
    }

//check if price value and filter are set
//case 1 : check if the prices are set
    if (strlen($priceFrom) > 0 && strlen($priceTo) > 0) {
        $sql1 = " and items.newPrice between $priceFrom and $priceTo ";
    }
//case 2 : check for filter
//case 3 : check brandType
    if (strlen($brand) > 0 && $brand !== 'ALL') {
        $sql2 = " and brand.brandName like '%$brand%' ";
    }
    $sqlgrand = $sql . $sql1 . $sql2 . $sql3;
    $r = $con->query($sqlgrand);
    $rows = $r->num_rows;
    $number = getLimiter($rows);
//    $number = 9;
    $fb = '';
    for ($a = 0; $a < $number; $a++) {
        if ($a === 0) {
            $fb = '<a onclick="pagerClicked(this.innerHTML,this)"><i class="fa fa-chevron-right"></i></a>';
        }
        if ($a === 4) {
            if ($number - $lastItem > 4) {
                $fb = '<a onclick="pagerClicked(this.innerHTML,this)"><i class="fa fa-chevron-left"></i></a>>' . $fb;
            } else {
//$fb = '<li><a onclick="pagerClicked(this.innerHTML,this)"><i class="fa fa-chevron-left"></i></a></li>' . $fb;
            }
            break;
        }
        $fb = '<a onclick="pagerClicked(this.innerHTML,this)">' . ($lastItem - ($a + 1)) . '</a>' . $fb;
    }
    echo $fb;
}

function brandClicked($queryName, $queryType, $priceFrom, $priceTo, $sortOrder, $brandName) {
    $con = connect();
    $sql = "SELECT majorcategory.majorName, category.catName, minorcategory.minorName, items.itemName,
            items.itemPic, brand.brandName, items.newPrice, items.oldPrice, items.itemId from items
            inner join minorcategory on minorcategory.minorId = items.minorId
            INNER join brand on  items.brandId = brand.brandId
            inner join category on category.catId = minorcategory.catId
            inner join majorcategory on majorcategory.majorId = category.majorId ";
    $sql3 = '';
    $sql2 = '';
    $sql1 = "";
    if ($brandName !== 'ALL') {
        $sql1 = " and brand.brandName like '%$brandName%' ";
    }

    if (strlen($priceFrom) > 0 && strlen($priceTo) > 0) {
        $sql2 = " AND items.newPrice BETWEEN $priceFrom AND $priceTo ";
    }
    if ($sortOrder === 'Price ASC') {
        $sql3 = " Order by items.newPrice asc ";
    }
    if ($sortOrder === 'Price DESC') {
        $sql3 = " Order by items.newPrice desc ";
    }
    if ($sortOrder === 'Name ASC') {
        $sql3 = " Order by items.itemName asc ";
    }
    if ($sortOrder === 'Name DESC') {
        $sql3 = " Order by items.itemName desc ";
    }
//major
    if ($queryType === 'm12') {
        $sql = $sql . " where majorcategory.majorName like '%$queryName%' ";
    }
//cat
    if ($queryType === 'c12') {
        $sql = $sql . " where category.catName like '%$queryName%' ";
    }
//minor
    if ($queryType === 'm23') {
        $sql = $sql . " where minorcategory.minorName like '%$queryName%' ";
    }
//item
    if ($queryType === 'search') {
        $sql = $sql . " where items.itemName like '%$queryName%' ";
    }
    $pname = '';
    $pbrand = '';
    $newfee = '';
    $oldfee = '';
    $id = '';
    $pic = '';
    $fb = '';
    $r = $con->query($sql . $sql1 . $sql2 . $sql3);
//--------------------------------------------------------------------------------------------
    /* ----+Populate the pagination with this data+---- */
    $rowsData = $r->num_rows;
    $number = getLimiter($rowsData);
//    $number = 9;
    $fbNav = '';
    for ($a = 0; $a < $number; $a++) {
        if ($a === 4) {
            $fbNav .= '<a onclick="pagerClicked(this.innerHTML,this)"><i class="fa fa-chevron-right"></i></a>';
            break;
        }
        $fbNav .= '<a onclick="pagerClicked(this.innerHTML,this)">' . ($a + 1) . '</a>';
    }
//--------------------------------------------------------------------------------------------
    $rows = getMyLimiter();
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $pname = $r->fetch_assoc()['itemName'];
        $r->data_seek($a);
        $pbrand = $r->fetch_assoc()['brandName'];
        $r->data_seek($a);
        $newfee = $r->fetch_assoc()['newPrice'];
        $r->data_seek($a);
        $oldfee = $r->fetch_assoc()['oldPrice'];
        $r->data_seek($a);
        $id = $r->fetch_assoc()['itemId'];
        $r->data_seek($a);
        $pic = $r->fetch_assoc()['itemPic'];

        if (strlen($pname) === 0) {
            break;
        }
        /**
         *  <div class="col-sm-3">
                                <a href="productDetails?name=' . $pname . '"><img src="../productImages/' . $pic . '" alt="' . $pname . '"/></a>
                                <p class="productBrandName">' . $pbrand . '</p>
                                <p class="productName">' . $pname . '</p>
                                <p  class="pcash">Ksh ' . moneyFormat($newfee) . '
                                    <del class="oldFee">Ksh ' . moneyFormat($oldfee) . '</del>
                                </p>
                                <div class="col-sm-12 text-center">
                                    <button value="' . $pname . '" onclick="addToCart(this.value,this)" class="cartbtn">
                                        Add To Cart
                                        <i class="fa fa-cart-plus"></i>
                                    </button>
                                    <button value="' . $pname . '" onclick="buyProduct(this.value,this)" class="buybtn">
                                        Buy Now
                                        <i class="fa fa-money"></i>
                                    </button>
                                </div>
                            </div>
         */

        $fb = $fb . '
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="productImages/' . $pic . '" alt="' . $pname . '">
                    <ul class="product__item__pic__hover">
                        <li><a href="#" value="'.$pname.'" onclick="buyProduct(this.value,this)"><i class="fa fa-money"></i></a></li>
                        <li><a href="#" value="' . $pname . '" onclick="addToCart(this.value,this)"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6><a href="product.php?name=' . $pname . '">' . $pname . '</a></h6>
                    <h5>Ksh ' . moneyFormat($newfee) . '</h5>
                </div>
            </div>
        </div>
       ';
    }
    echo '{' . $fb . '}' . $fbNav . '~';
}

/*
 *
  =============================================================================================================================
  =============================================================================================================================
  ======================                                PD SCRIPT HERE                                   ======================
  =============================================================================================================================
  =============================================================================================================================
 *
 */

function pdBreadCrumb($name) {
    $con = connect();
    $sql = " select majorcategory.majorName, category.catName,minorcategory.minorName,items.itemName from items
            inner join minorcategory on minorcategory.minorId = items.minorId
            inner join category on category.catId = minorcategory.catId
            inner join majorcategory on majorcategory.majorId = category.majorId
            where items.itemName = '$name'; ";
    $r = $con->query($sql);
    $rows = $r->num_rows;
    $majorName = '';
    $catName = '';
    $minorName = '';
    $itemName = '';
    $fb = '';
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $majorName = $r->fetch_assoc()['majorName'];
        $r->data_seek($a);
        $catName = $r->fetch_assoc()['catName'];
        $r->data_seek($a);
        $minorName = $r->fetch_assoc()['minorName'];
        $r->data_seek($a);
        $itemName = $r->fetch_assoc()['itemName'];

        $fb = ' <li><i class="fa fa-home"></i> : Home </li> <li>' . $majorName . '</li> <li>' . $catName . '</li> <li>' . $minorName . '</li> <li>' . $itemName . '</li> ';
    }
    echo $fb;
}

function pdloadImageDivData($name) {
    $con = connect();
    $sql = " SELECT items.itemPic, items.newPrice, items.oldPrice from items WHERE items.itemName = '$name';";
    $r = $con->query($sql);
    $rows = $r->num_rows;
    $itemPic = '';
    $newPrice = '';
    $oldPrice = '';
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $itemPic = $r->fetch_assoc()['itemPic'];
        $r->data_seek($a);
        $newPrice = $r->fetch_assoc()['newPrice'];
        $r->data_seek($a);
        $oldPrice = $r->fetch_assoc()['oldPrice'];
    }
    echo '~' . $itemPic . '!' . $newPrice . '|' . $oldPrice . '_';
}

function loadFeaturesPd($name) {
    $con = connect();
    $sql1 = "select items.itemName, featurescomps.ram,featurescomps.rom, featurescomps.displaySize,
             featurescomps.operatingSystem, featurescomps.processor, featurescomps.simslot from featurescomps
             INNER join items on items.itemId = featurescomps.itemId where items.itemName='$name'";
    $sql2 = "SELECT items.itemName,itemfeatures.keyFeatures from itemfeatures
            inner JOIN items on items.itemId = itemfeatures.itemId where items.itemName='$name'";
    $fb1 = '';
    $fb2 = '';
    $ram = '';
    $rom = '';
    $dis = '';
    $os = '';
    $proc = '';
    $simslot = '';

    $r1 = $con->query($sql1);
    $fb1s = '0';
    if ($r1->num_rows > 0) {
        $fb1s = '1';
    }
    for ($a = 0; $a < $r1->num_rows; $a++) {
        $r1->data_seek($a);
        $ram = $r1->fetch_assoc()['ram'];
        $r1->data_seek($a);
        $rom = $r1->fetch_assoc()['rom'];
        $r1->data_seek($a);
        $dis = $r1->fetch_assoc()['displaySize'];
        $r1->data_seek($a);
        $os = $r1->fetch_assoc()['operatingSystem'];
        $r1->data_seek($a);
        $proc = $r1->fetch_assoc()['processor'];
        $r1->data_seek($a);
        $simslot = $r1->fetch_assoc()['simslot'];

        $fb1 = '
            <li>Ram : ' . $ram . '</li>
            <li>Rom : ' . $rom . '</li>
            <li>Sreen Size : ' . $dis . '</li>
            <li>Operating System : ' . $os . '</li>
            <li>Processor : ' . $proc . '</li>
            <li>Simcard Slots : ' . $simslot . '</li>
              ';
    }

    $r2 = $con->query($sql2);
    $fb2s = '0';
    if ($r2->num_rows > 0) {
        $fb2s = '1';
    }
    for ($b = 0; $b < $r2->num_rows; $b++) {
        $r2->data_seek($b);
        $fb2 .= '<li>' . $r2->fetch_assoc()['keyFeatures'] . '</li>';
    }
    echo '{' . $fb1s . '}' . $fb2s . '[' . $fb1 . ']' . $fb2 . '|';
}

function loadMorePicDivData($name) {
    $con = connect();
    $sql = "select items.itemName, itemimages.imageName from itemimages
            inner join items on items.itemId = itemimages.itemId
            where items.itemName = '$name'
            ;";
    $sql1 = " SELECT items.itemPic, items.newPrice, items.oldPrice from items WHERE items.itemName = '$name';";
    $r1 = $con->query($sql1);
    $itemPic = '';
    for ($a = 0; $a < $r1->num_rows; $a++) {
        $r1->data_seek($a);
        $itemPic = $r1->fetch_assoc()['itemPic'];
    }


    $fb = '';
    $r = $con->query($sql);
    $rows = $r->num_rows;
    $img = '';
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $img = $r->fetch_assoc()['imageName'];
        $fb .= '<img src="./productImages/' . $img . '"  data-imgbigurl="./productImages/' . $img . '" alt="">';
    }
    echo $fb.'<img src="./productImages/' . $itemPic . '"  data-imgbigurl="./productImages/' . $itemPic . '" alt="">';
}

function loadMoreProductsDivDatapD() {
    $con = connect();
    $sql = "SELECT minorcategory.minorName, items.itemPic FROM minorcategory
            RIGHT JOIN items on items.minorId = minorcategory.minorId
            ORDER BY RAND ( )
            LIMIT 7;";
    $fb = '';
    $name = '';
    $pic = '';
    $r = $con->query($sql);
    $rows = $r->num_rows;
    for ($a = 1; $a < $rows; $a++) {
        $r->data_seek($a);
        $name = $r->fetch_assoc()['minorName'];

        $r->data_seek($a);
        $pic = $r->fetch_assoc()['itemPic'];
        $fb.='
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="productImages/' . $pic . '" alt="' . $pname . '">
                    <!--
                    <ul class="product__item__pic__hover">
                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                    -->
                </div>
                <div class="product__item__text">
                    <h6><a href="shop.php?q=' . $name . '&t=m23">' . $name . '</a></h6>
                </div>
            </div>
        </div>
        ';
        $name = '';
        $pic = '';
    }
    echo $fb;
}

/*
  =========================================================================================================
  =========================================================================================================
  =============                           CART ACTION DATA START                            ===============
  =========================================================================================================
  =========================================================================================================
 */

//i get the price
function addToCartInterface($name) {
    $con = connect();
    $sql = "SELECT items.newPrice from items WHERE items.itemName = '$name';";
    $price = '';
    $r = $con->query($sql);
    for ($a = 0; $a < $r->num_rows; $a++) {
        $r->data_seek($a);
        $price = $r->fetch_assoc()['newPrice'];
    }
    addCart($name, $price, 1);
}

function addToCartInterface1($name, $quantity) {
    $con = connect();
    $sql = "SELECT items.newPrice from items WHERE items.itemName = '$name';";
    $price = '';
    $Quanity = (int) $quantity;
    $r = $con->query($sql);
    for ($a = 0; $a < $r->num_rows; $a++) {
        $r->data_seek($a);
        $price = $r->fetch_assoc()['newPrice'];
    }
    $price1 = $price * $Quanity;
    addCart($name, $price1, $Quanity);
}

function getCart() {
    $data = '';
    if (isset($_SESSION['cart']) === true) {
        $data = $_SESSION['cart'];
    }
    echo $data;
}

function addCart($itemName, $itemPrice, $quantity) {
    if (isset($_SESSION['cart']) === false) {
        $cartArray = array();
        $itemPrice1 = $itemPrice * $quantity;
        $cartArray[0][0] = $itemName;
        $cartArray[0][1] = $itemPrice1;
        $cartArray[0][2] = $quantity;

        $_SESSION['cart'] = json_encode($cartArray);
        echo $_SESSION['cart'];
    } else {
        $cartArray = json_decode($_SESSION['cart']);
        $count = sizeof($cartArray);
//check if is already there. if true, dont add, update else, add
        $findStat = searchItemCart($itemName, $cartArray, 'status');
        if ($findStat === 'found') {
            $key = searchItemCart($itemName, $cartArray, 'index');

            $currentQunatity = $cartArray[$key][2];
            $newQuantity = $currentQunatity + $quantity;
            $newPrice = $newQuantity * $itemPrice;
            $cartArray[$key][1] = $newPrice;
            $cartArray[$key][2] = $newQuantity;
        } else {
            $cartArray[$count][0] = $itemName;
            $cartArray[$count][1] = $itemPrice;
            $cartArray[$count][2] = $quantity;
        }
        $_SESSION['cart'] = json_encode($cartArray);
        echo $_SESSION['cart'];
    }
}

function searchItemCart($data, $array, $responseType) {
    $arraySize = sizeof($array);
    $status = 'not found';
    $index = -1;
    $feedback = '';
    for ($a = 0; $a < $arraySize; $a++) {
        if ($array[$a][0] === $data) {
            $status = 'found';
            $index = $a;
            break;
        }
    }
    if ($responseType === 'status') {
        $feedback = $status;
    } if ($responseType === 'index') {
        $feedback = $index;
    }
    return $feedback;
}

function removeFromCart($index) {
    $itemIndex = $index;
    $cartArray = json_decode($_SESSION['cart']);

    $price = $cartArray[$itemIndex][1];
    $quantity = $cartArray[$itemIndex][2];

    if ($quantity == 1) {
        $newString = deleteItem($itemIndex);
        $_SESSION['cart'] = $newString;
        echo $newString;
    } else {
        $newQuantity = $quantity - 1;
        $newPrice = ($price / $quantity) * $newQuantity;
        $cartArray[$itemIndex][1] = $newPrice;
        $cartArray[$itemIndex][2] = $newQuantity;
        $_SESSION['cart'] = json_encode($cartArray);
        echo $_SESSION['cart'];
    }
}

function deleteItem($index) {
    $index1 = (int) $index;
    $cartArray = json_decode($_SESSION['cart']);
    $cartArray1 = array();
    $arraySize = sizeof($cartArray);
    $result = '';
    $b = 0;
    for ($a = 0; $a < $arraySize; $a++) {
        if ($a === $index1) {

        } else {
            $cartArray1[$b] = $cartArray[$a];
            $b++;
        }
    }
    $result = json_encode($cartArray1);
    return $result;
}

function checkUserLoggedIn() {
    $result = 'no';

    if (isset($_SESSION['ClientLoggedIn']) && $_SESSION['ClientLoggedIn'] !== 'null') {
        $result = 'yes';
    }
    echo $result;
}

/*
  =====================================================================================
  ====================                    USER AUTH           =========================
  =====================================================================================
 */

function attemptSignUp($jsonData) {
    //json format = email, number , password
    $data = json_decode($jsonData);
    //1: check mail
    $con = connect();
    $sql_checkMail = "SELECT clients.email from clients where clients.email LIKE '%$data[0]%';";
    $result_checkMail = $con->query($sql_checkMail);
    $rows_checkMail = $result_checkMail->num_rows;
    if ($rows_checkMail > 0) {
        $data[4] = '<p class="text-danger"><i class="fa fa-frown-o"></i> Sorry, the email <b>' . $data[0] . '</b> is already in use!</p>';
        echo json_encode($data);
    } else {
        //proceed to do some data
        $smsCode = generateCode($data[0], $data[1]);
        $data[3] = $smsCode;
        $fb = sendSms($data[1], $smsCode);
        $data[4] = $fb;
        if ($fb === 'sent') {
            $data[5] = 'Ok';
        } else {
            $data[5] = '<p class="text-danger">Sorry, we are experiencing a technical error at the moment, our team is looking into the situation, please try again later</p>';
        }
        $userData = json_encode($data);
        $_SESSION['attemptSignUp'] = $userData;
        echo $userData;
    }
}

function generateCode($mail, $number) {
    $date = getTime('date');
    $time = getTime('time');
    $hashedString = md5($mail . $number . $date . $time);
    $smsCode = substr($hashedString, 2, 6);
    return $smsCode;
}

function generateOrderNumber($mail, $number) {
    $date = getTime('date');
    $time = getTime('time');
    $hashedString = md5($mail . $number . $date . $time);
    $orderNumber = substr($hashedString, 2, 13);
    return $orderNumber;
}

/* This function is responsible for sending messages Yo
 * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 * ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++!
 * Just pass the number and message to be sent
 */

function sendSms($recipients, $message) {
    $username = "garlado";
    $apikey = "305f08dc00c30d48027023e53bee22976a19cf8c81e09a0d86621c6cbe54e393";
    $gateway = new AfricasTalkingGateway($username, $apikey);
    $fb = 'sent';
    try {
        $message = "Thank you for creating an account with us.Proivde the following verification code to activate your account.\nCODE : " . $message . " \n\nGarlado Online Store";
        $results = $gateway->sendMessage($recipients, $message);
    } catch (AfricasTalkingGatewayException $e) {
        $fb = 'unsent';
    }
    return $fb;
}

//this function verifies provided code
function codeVerificationDb($code) {
    $jsonData = $_SESSION['attemptSignUp'];
    $data = json_decode($jsonData);
    $myArr = array();
    //code = data[3]
    if ($code === $data[3]) {
        //add user to the database wit active account!
        $_SESSION['ClientLoggedIn'] = $data[0];
        $fb = addClient();
        $myArr[0] = 'match';
        $myArr[1] = $fb;
    } else {
        //display some negative message
        $myArr[0] = 'mismatch';
        $myArr[1] = 'Code missmatch!';
    }
    echo json_encode($myArr);
}

function addClient() {
    $con = connect();
    $jsonData = $_SESSION['attemptSignUp'];
    $data = json_decode($jsonData);
    $fb = '';
    $pass = md5($data[2]);
    $sql = "INSERT INTO `clients`( `phone`, `email`, `password`, `status`) VALUES ('$data[1]','$data[0]','$pass',1)";
    $con->query($sql);
    if ($con->error) {
        $fb = 'error';
    } else {
        $fb = 'ok';
    }
    $_SESSION['ClientLoggedIn'] = $data[0];
    return $fb;
}

function getResendCode() {
    $data = json_decode($_SESSION['attemptSignUp']);
    $data[3] = generateCode($data[0], $data[1]);
    $fb = sendSms($data[1], $data[3]);
    $data[4] = $fb;
    if ($fb === 'sent') {
        $data[5] = 'Ok';
    } else {
        $data[5] = '<p class="text-danger">Sorry, we are experiencing a technical error at the moment, our team is looking into the situation, please try again later.</p>';
    }
    $userData = json_encode($data);
    $_SESSION['attemptSignUp'] = $userData;
    echo $userData;
}

function clientLogin($jsonData) {
    $con = connect();
    $data = json_decode($jsonData);
    $pass = md5($data[1]);
    $array = array();
    $sql = "select clients.phone, clients.email from clients
             WHERE clients.email='$data[0]' and clients.password='$pass';";

    $result = $con->query($sql);
    $rows = $result->num_rows;

    if ($rows === 0) {
        $array[0] = 'empty';
    } else {
        $array[0] = 'nempty';
        $_SESSION['ClientLoggedIn'] = $data[0];
        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $array[1] = $result->fetch_assoc()['email'];
            $result->data_seek($a);
            $array[2] = $result->fetch_assoc()['phone'];
        }
    }
    $loginData = json_encode($array);
    $_SESSION['attemptSignUp'] = $loginData;
    echo $loginData;
}

function loadCustomerData() {
    echo $_SESSION['attemptSignUp'];
}

function loadCCountries() {
    $con = connect();
    $sql = "SELECT country.contName from country WHERE country.status=1 order by country.contName ASC;";
    $fb = "<option>---Select Country---</option>";
    $result = $con->query($sql);
    $rows = $result->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $fb .= "<option>" . $result->fetch_assoc()['contName'] . "</option>";
    }
    echo $fb;
}

function loadCCounties($country) {
    $con = connect();
    $sql = "SELECT county.conName from county
            INNER join country on country.contId = county.contId
            where country.contName = '$country' and county.status=1 ORDER by county.conName ASC;";
    $fb = "<option>---Select County---</option>";
    $result = $con->query($sql);
    $rows = $result->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $fb .= "<option>" . $result->fetch_assoc()['conName'] . "</option>";
    }
    echo $fb;
//   echo '<option>'.$country.'</option>';
}

function loadSttates($county) {
    $con = connect();
    $sql = "SELECT constituency.constName from constituency "
            . "INNER JOIN county on county.conId = constituency.conId "
            . "WHERE county.conName='$county' AND constituency.status=1 "
            . "ORDER by constituency.constName ASC";
    $fb = "<option>---Select State---</option>";
    $result = $con->query($sql);
    $rows = $result->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $fb .= "<option>" . $result->fetch_assoc()['constName'] . "</option>";
    }
    echo $fb;
}

function loadSttations($station) {
    $con = connect();
    $sql = "SELECT pickuppoints.pickupAddress from pickuppoints
            inner join constituency on constituency.constId = pickuppoints.constId
            where constituency.constName = '$station' and pickuppoints.status=1
            ORDER BY pickuppoints.pickupAddress ASC;";
    $fb = "<option>---Select Station---</option>";
    $result = $con->query($sql);
    $rows = $result->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $fb .= "<option>" . $result->fetch_assoc()['pickupAddress'] . "</option>";
    }
    echo $fb;
}

function loadStationAddress($station) {
    $con = connect();
    $sql = "SELECT pickuppoints.pickupDescription from pickuppoints WHERE pickupAddress = '$station';";
    $fb = "";
    $result = $con->query($sql);
    $rows = $result->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $fb = $result->fetch_assoc()['pickupDescription'];
    }
    echo $fb;
}

function addNewClientAddress($jsonData) {
    //json Format
    /*
      addresstype,email,fname,lname,phone,constituency,addressdescription
     */
    $con = connect();
    $data = json_decode($jsonData);
    $clientId = '';
    $constId = '';
    //1: get the user id
    $sql_GetUd = "SELECT clients.clientId from clients where clients.email = '$data[1]';";
    $rs = $con->query($sql_GetUd);
    for ($a = 0; $a < $rs->num_rows; $a++) {
        $rs->data_seek($a);
        $clientId = $rs->fetch_assoc()['clientId'];
    }
    //1: get the const id
    $sql_GetConstId = "SELECT constituency.constId from constituency where constituency.constName = '$data[5]';";
    $rs1 = $con->query($sql_GetConstId);
    for ($a = 0; $a < $rs1->num_rows; $a++) {
        $rs1->data_seek($a);
        $constId = $rs1->fetch_assoc()['constId'];
    }

    //insert Data
    $sql = "INSERT INTO
            `clientaddress`(`clientId`, `constId`, `fName`, `lName`, `phone`, `addressDetails`,`addressType`)
                      VALUES ($clientId,$constId,'$data[2]','$data[3]','$data[4]','$data[6]','$data[7]');";
    $con->query($sql);
    if ($con->error) {
        echo 'Error';
    } else {
        $addreses = loadClientAddress($clientId);
        $fbArray = array();
        $fbArray[0] = 'Success';
        $fbArray[1] = $addreses;
        echo json_encode($fbArray);
    }
}

function loadClientAddress($id) {
    $con = connect();
    $fb = array();
    $sd = '';
    $sql = "SELECT clientaddress.addressId, clientaddress.fName,clientaddress.lName,clientaddress.phone,clientaddress.addressDetails from clientaddress
            inner JOIN clients on clientaddress.clientId = clients.clientId
            WHERE clients.clientId = $id";
    $result = $con->query($sql);
    $rows = $result->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $fb[0] = $result->fetch_assoc()['addressId'];

        $result->data_seek($a);
        $fb[1] = $result->fetch_assoc()['fName'];

        $result->data_seek($a);
        $fb[2] = $result->fetch_assoc()['lName'];

        $result->data_seek($a);
        $fb[3] = $result->fetch_assoc()['phone'];

        $result->data_seek($a);
        $fb[4] = $result->fetch_assoc()['addressDetails'];

        $sd .= '  <div class="col-sm-6 panelAddress">
                        <table style="width: 100%">
                            <tr>
                                <td>
                                    <p class="addressName">
                                        <i class="fa fa-user-o"></i>
                                        ' . $fb[1] . ' ' . $fb[2] . '
                                    </p>
                                </td>
                                <td>
                                    <p class="addressPhone">
                                        <i class="glyphicon glyphicon-phone-alt"></i>
                                        ' . $fb[3] . '
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <p class="addressDescription">
                                        <i class="fa fa-map-marker"></i>
                                         ' . $fb[4] . '
                                    </p>
                                    <hr class="myHr"/>
                                    <div class="addressBtnDiv">
                                        <button value="' . $fb[0] . '" onclick="editAddressData(this.value)" class="btn mybtnAddress mybtnEdit">
                                            Edit <i class="fa fa-edit"></i>
                                        </button><!--
                                        <button value="' . $fb[0] . '" onclick="deleteAddressData(this)" class="btn mybtnAddress mybtnDelete">
                                            Delete <i class="fa fa-trash-o"></i>
                                        </button>-->
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    ';
        $fb[0] = '';
        $fb[1] = '';
        $fb[2] = '';
        $fb[3] = '';
        $fb[4] = '';
    }
    return $sd;
}

function loadClientAddresses($email) {
    $con = connect();
    $clientId = '';
    //1: get the user id
    $sql_GetUd = "SELECT clients.clientId from clients where clients.email = '$email';";
    $rs = $con->query($sql_GetUd);
    for ($a = 0; $a < $rs->num_rows; $a++) {
        $rs->data_seek($a);
        $clientId = $rs->fetch_assoc()['clientId'];
    }
    $addresses = loadClientAddress($clientId);
    echo $addresses;
}

function editAddressData($id) {
    $con = connect();
    $sql = "SELECT clientaddress.fName, clientaddress.lName, clientaddress.phone, country.contName, county.conName, constituency.constName,pickuppoints.pickupAddress, clientaddress.addressDetails, clientaddress.addressType
            from clientaddress
            inner join constituency on constituency.constId = clientaddress.constId
            inner join pickuppoints on pickuppoints.constId = constituency.constId
            inner join county on county.conId = constituency.conId
            inner join country on country.contId = county.contId
            where clientaddress.addressId=$id;";
    $fb = array();
    $r = $con->query($sql);
    $rows = $r->num_rows;
    for ($a = 0; $a < $rows; $a++) {
        $r->data_seek($a);
        $fb[0] = $r->fetch_assoc()['fName'];
        $r->data_seek($a);
        $fb[1] = $r->fetch_assoc()['lName'];
        $r->data_seek($a);
        $fb[2] = $r->fetch_assoc()['phone'];
        $r->data_seek($a);
        $fb[3] = $r->fetch_assoc()['contName'];
        $r->data_seek($a);
        $fb[4] = $r->fetch_assoc()['conName'];
        $r->data_seek($a);
        $fb[5] = $r->fetch_assoc()['constName'];
        $r->data_seek($a);
        $fb[6] = $r->fetch_assoc()['addressDetails'];
        $r->data_seek($a);
        $fb[7] = $r->fetch_assoc()['pickupAddress'];
        $r->data_seek($a);
        $fb[8] = $r->fetch_assoc()['addressType'];
    }
    // fetch respective data for option.

    $counties = JsonifyArray(getCountiesAssArray($fb[3], $fb[4]));
    $states = JsonifyArray(getStatessArray($fb[4], $fb[5]));
    $stations = JsonifyArray(getStationsAssArray($fb[5], $fb[7], $fb[8], $fb[6]));
    $jsonString = '{
            "fname" : "' . $fb[0] . '",
            "lname" : "' . $fb[1] . '",
            "phone" : "' . $fb[2] . '",
            "country" : "' . $fb[3] . '",
            "county" : "' . $fb[4] . '",
            "state" : "' . $fb[5] . '",
            "description" : "' . $fb[6] . '",
            "addressType" : "' . $fb[8] . '",
            "counties" : ' . $counties . ',
            "states" : ' . $states . ',
            "stations" : ' . $stations . '
           }';
    echo $jsonString;
}

function getCountiesAssArray($country, $county) {
    $con = connect();
    $sql = "SELECT county.conName from county inner JOIN country on country.contId = county.contId where country.contName='$country';";
    $jsonArray = array();
    $jsonArray[0] = $county;
    $result = $con->query($sql);
    $rows = $result->num_rows;
    $cnty = '';
    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $cnty = $result->fetch_assoc()['conName'];
        if ($cnty === $county) {

        } else {
            array_push($jsonArray, $cnty);
        }
    }
    return json_encode($jsonArray);
}

function getStatessArray($county, $state) {
    $con = connect();
    $sql = "SELECT constituency.constName from constituency inner join county on county.conId = constituency.conId
where county.conName = '$county';";
    $jsonArray = array();
    $jsonArray[0] = $state;
    $result = $con->query($sql);
    $rows = $result->num_rows;
    $const = '';
    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $const = $result->fetch_assoc()['constName'];
        if ($const === $state) {

        } else {
            array_push($jsonArray, $const);
        }
    }
    return json_encode($jsonArray);
}

function getStationsAssArray($constituency, $pickuppoint, $addressType, $pickupDescription) {
    if ($addressType === 'doorstep') {

    } else {
        $con = connect();

        //fetch the start pickup based on description.
        $jsonArray = array();
        $sql1 = "SELECT pickuppoints.pickupAddress from pickuppoints where pickuppoints.pickupDescription='$pickupDescription';";
        $r1 = $con->query($sql1);
        for ($b = 0; $b < 1; $b++) {
            $r1->data_seek($b);
            $jsonArray[0] = $r1->fetch_assoc()['pickupAddress'];
        }

        $sql = "SELECT pickuppoints.pickupAddress from pickuppoints
                inner join constituency on constituency.constId = pickuppoints.constId
                where constituency.constName='$constituency';";


        $result = $con->query($sql);
        $rows = $result->num_rows;
        $pic = '';
        for ($a = 0; $a < $rows; $a++) {
            $result->data_seek($a);
            $pic = $result->fetch_assoc()['pickupAddress'];
            if ($pic === $jsonArray[0]) {

            } else {
                array_push($jsonArray, $pic);
            }
        }
        return json_encode($jsonArray);
    }
}

function JsonifyArray($str) {
    $fb = '';
    $data = json_decode($str);
    for ($a = 0; $a < count($data); $a++) {
        if (($a + 1) === count($data)) {
            $fb .= "\"$data[$a]\"";
        } else {
            $fb .= "\"$data[$a]\",";
        }
    }
    return '[' . $fb . ']';
}

function saveEditAddress($jsonData) {
    //json Format
    /*
      addresstype,email,fname,lname,phone,constituency,addressdescription,addresstype,addressId
     */
    $con = connect();
    $data = json_decode($jsonData);
    $constId = '';
    $clientId = '';
    //1: get the const id
    $sql_GetUd = "SELECT clients.clientId from clients where clients.email = '$data[1]';";
    $rs = $con->query($sql_GetUd);
    for ($a = 0; $a < $rs->num_rows; $a++) {
        $rs->data_seek($a);
        $clientId = $rs->fetch_assoc()['clientId'];
    }
    $sql_GetConstId = "SELECT constituency.constId from constituency where constituency.constName = '$data[5]';";
    $rs1 = $con->query($sql_GetConstId);
    for ($a = 0; $a < $rs1->num_rows; $a++) {
        $rs1->data_seek($a);
        $constId = $rs1->fetch_assoc()['constId'];
    }

    //insert Data
    $sql = "UPDATE clientaddress SET
            constId=$constId,
            fName='$data[2]',
            lName='$data[3]',
            phone='$data[4]',
            addressDetails='$data[6]',
            addressType='$data[7]'
            WHERE
            addressId=$data[8]";
    $con->query($sql);
    if ($con->error) {
        echo 'Error' . $con->error . $sql;
    } else {
        $addreses = loadClientAddress($clientId);
        $fbArray = array();
        $fbArray[0] = 'Success';
        $fbArray[1] = $addreses;
        echo json_encode($fbArray);
    }
}

function deleteAddressData($jsonData) {
    $con = connect();
    $data = json_decode($jsonData);
    $sql = "DELETE from clientaddress where clientaddress.addressId=$data[1]";
    $con->query($sql);
    $clientId = '';
    //1: get the user id
    $sql_GetUd = "SELECT clients.clientId from clients where clients.email = '$data[0]';";
    $rs = $con->query($sql_GetUd);
    for ($a = 0; $a < $rs->num_rows; $a++) {
        $rs->data_seek($a);
        $clientId = $rs->fetch_assoc()['clientId'];
    }
    $addresses = loadClientAddress($clientId);
    $array = array();
    $array[0] = 'Success';
    $array[1] = $addresses;

    echo json_encode($array);
}

function verifyAddress($email) {
    $con = connect();
    $sql = "SELECT clientaddress.fName, clientaddress.lName, clientaddress.phone,
            clientaddress.addressDetails, clientaddress.addressId
            from clientaddress
            inner join clients on clients.clientId = clientaddress.clientId
            WHERE clients.email='$email';";
    $fb = "";
    $array = array();
    $rs = $con->query($sql);
    $arrayResult = array();
    if ($rs->num_rows === 0) {
        $arrayResult[0] = 'No Address';
    } else if ($rs->num_rows === 1) {
        $arrayResult[0] = 'Single Address';
        for ($a = 0; $a < 1; $a++) {
            $rs->data_seek($a);
            $arrayResult[1] = $rs->fetch_assoc()['addressId'];
        }
    } else {
        for ($a = 0; $a < $rs->num_rows; $a++) {
            $arrayResult[0] = 'Multiple Address';
            $rs->data_seek($a);
            $array[0] = $rs->fetch_assoc()['fName'];
            $rs->data_seek($a);
            $array[1] = $rs->fetch_assoc()['lName'];
            $rs->data_seek($a);
            $array[2] = $rs->fetch_assoc()['phone'];
            $rs->data_seek($a);
            $array[3] = $rs->fetch_assoc()['addressDetails'];
    $_SESSION['Client_address'] = $address;
    $rs->data_seek($a);
            $array[4] = $rs->fetch_assoc()['addressId'];
            $fb .= '<div class="radio">
                    <label>
                        <input type="radio" value="' . $array[4] . '" name="optionaddress">
                        <div class="myDiv">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <i class="fa fa-user"></i> <b>' . $array[0] . ' ' . $array[1] . '</b><br>
                                    <i class="fa fa-phone"></i> <b>' . $array[2] . '</b><br>
                                    <p class="text-justify"><i class="fa fa-map-marker"></i> ' . $array[3] . '</p>
                                </li>
                            </ul>
                        </div>
                    </label>
                 </div>';
            $array[0] = $array[1] = $array[2] = $array[3] = $array[4] = '';
        }
        $arrayResult[1] = $fb;
    }
    echo json_encode($arrayResult);
}

function loadOrderPayment($address) {
    $_SESSION['Client_address'] = $address;
    $con = connect();
    $sql = "SELECT  clientaddress.phone
            from clientaddress
            inner join clients on clients.clientId = clientaddress.clientId
            WHERE clientaddress.addressId='$address';";
    $rs = $con->query($sql);
    for ($a = 0; $a < $rs->num_rows; $a++) {
        $rs->data_seek($a);
        $_SESSION['Client_phone'] = $rs->fetch_assoc()['phone'];
    }

    echo 'set';
}

function getConfirmOrderDetails($address) {
    $cartData = $_SESSION['cart'];
    $addressId = $_SESSION['Client_address'];

    $data = json_decode($cartData);
    $item_count = 0;
    $total_price = 0;
    $array_size = count($data);
    for ($a = 0; $a < $array_size; $a++) {
        $item_count = $item_count + ($data[$a][2]);
        $total_price = $total_price + ((int) $data[$a][1]);
    }

    $fixedPrice = 200;

//    Get the address details based on provided id
    $destination_type = '';
    $shipping_fee = 200;
    $pay_ammount = $fixedPrice;
    $name = '';
    $phone = '';
    $destination_description = '';

    $con = connect();
    $sql = "SELECT clientaddress.fName, clientaddress.lName, clientaddress.phone,
            clientaddress.addressType, clientaddress.addressDetails from clientaddress
            where clientaddress.addressId = $address;";

    $result = $con->query($sql);
    $rows = $result->num_rows;

    for ($a = 0; $a < $rows; $a++) {
        $result->data_seek($a);
        $name = $result->fetch_assoc()['fName'];

        $result->data_seek($a);
        $name = $na11me . ' ' . $result->fetch_assoc()['lName'];

        $result->data_seek($a);
        $phone = $result->fetch_assoc()['phone'];

        $result->data_seek($a);
        $destination_type = $result->fetch_assoc()['addressType'];

        $result->data_seek($a);
        $destination_description = $result->fetch_assoc()['addressDetails'];
    }

//
//      echo count($data).' Items array found<br><br>'.$cartData.'<br><br>'.$item_count.' items <br> Ksh.'
//              . moneyFormat($total_price).'<br>Fixed price : KSH.'.$fixedPrice.'<br>Total Payable : '. moneyFormat(($fixedPrice+$total_price));
//

    $fb = array();
    $fb[0] = $item_count;
    $fb[1] = moneyFormat($total_price);
    $fb[2] = $shipping_fee;
    $fb[3] = moneyFormat(($fixedPrice + $total_price));
    $fb[4] = $destination_type;
    $fb[5] = $name;
    $fb[6] = $phone;
    $fb[7] = $destination_description;

    $json = json_encode($fb);
    echo $json;
}

// MPESA SECTION
// -----------------------
function getAccessToken(){
    $consumerKey = 'QpdbeP2J5c1CUwJwWc534A15AxQVsWuH';
    $consumerSecret = 'bwJAQT43nP41GxHo';

    $headers = ['Content-Type:application/json; charset=utf8'];

    $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

    $curl_init = curl_init( $url);
    curl_setopt($curl_init, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl_init, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl_init, CURLOPT_HEADER, FALSE);
    curl_setopt($curl_init, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);

    $result = curl_exec($curl_init);
    $result = json_decode($result);

    $access_token = $result->access_token;
    curl_close($curl_init);
    return $access_token;
   }


function placeOrder($json) {
    $cart = $_SESSION['cart'];
    $data = json_decode($cart);
    //contains name[1] and email[0]
    $jsonArray = json_decode($json);
    
    $addressId = $_SESSION['Client_address'];
    $item_count = 0;
    $total_price = 0;
    
    //get item name, item quantity
    $JsonArrayItems = array();
    $array_size = count($data);
    for ($a = 0; $a < $array_size; $a++) {
        $item_count = $item_count + ($data[$a][2]);
        $total_price = $total_price + ((int) $data[$a][1]);
        $JsonArrayItems[$a][0] = $data[$a][0];
        $JsonArrayItems[$a][1] = $data[$a][2];
    }

    // $fixedPrice = 200;
    // Return the fixed price back to 200
    $fixedPrice = 0;
    $sumTotal = $fixedPrice + $total_price;

    $orderNumber = generateOrderNumber($jsonArray[0], $jsonArray[1]);

    $orderItems = json_encode($JsonArrayItems);
    $status = 'new';
    $time = getTime('time');
    $date = getTime('date');
    $month = getTime('month');
    $year = getTime('year');
    $addressId = $_SESSION['Client_address'];


    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    //         MPESA SECTION
    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

     //User Details
     $client_data = json_decode( $_SESSION['attemptSignUp']);
     // Format
     // 1: Email
     // 2: Phone
 
     $phone = $_SESSION['Client_phone'];
     // $phone = '254704219247';
 
     //Prepare phone number for mpesa
     // 1:
 
     if(substr($phone,0,2) === '07'){
         $phone = '2547'.substr($phone,2);
     } else if(substr($phone,0,1) === '+'){
         $phone = substr($phone,1);
     }
 
    //  echo json_encode(['order placed',$phone, $sumTotal]);
    //  die;
  /*
     --------------------------------
     MPESA CODE SHOULD BE PLACED HERE
     ============ START =============
     --------------------------------
    */

    $merchant_id="174379"; //C2B Shortcode/Paybill
    $callback_url="http://2fe3c6ca6b42.ngrok.io/Core/mpesa/mpesa_callback.php";
    $passkey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919"; //Ask from Safaricom guys..
    $account_reference='AS '.$merchant_id;
    $transaction_description='Pay for Order:'.$phone;

    //Initiate PUSH
    $timestamp=date("YmdHis");
    $password=base64_encode($merchant_id . $passkey .$timestamp); //No more Hashing like before
    // dd($password);
    $access_token = getAccessToken();
        // die($access_token);
    $curl = curl_init();
    $endpoint_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization:Bearer '.$access_token)); //setting custom header

    $curl_post_data = array(
        'BusinessShortCode' => $merchant_id,
        'Password' => $password,
        'Timestamp' => $timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => $sumTotal,
        'PartyA' => $phone,
        'PartyB' => $merchant_id,
        'PhoneNumber' => $phone,
        'CallBackURL' => $callback_url,
        'AccountReference' => $account_reference,
        'TransactionDesc' => $transaction_description
    );

    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $curl_response = curl_exec($curl);
    // die($curl_response);

    $result = json_decode($curl_response);

    $sql_stk_push_payment_requests ="
    INSERT INTO `stk_push_payment_requests`(
        `order_id`,
        `merchant_request_id`,
        `checkout_request_id`,
        `amount`,
        `status`
    )
    VALUES(
        '".$orderNumber."',
        '".$result->MerchantRequestID."',
        '".$result->CheckoutRequestID."',
        '".$sumTotal."',
        '1'
    )
    ";

    $con = connect();
    $con->query($sql_stk_push_payment_requests);


    /*
        ------------------------------
            ======== END =========
        ------------------------------
    */
 
     

 $sql = "INSERT INTO
          `clientorders`(`addressId`, `orderNumber`, `orderItems`, `orderAmount`, `itemCount`, `time`, `date`, `month`, `year`, `status`) 
                 VALUES ($addressId,'$orderNumber','$orderItems','$sumTotal','$item_count','$time','$date','$month','$year','$status');";
 
 $con = connect();
 $con->query($sql);
 if($con->error){
     echo $con->error;
 }
 else{
     $_SESSION['ClientLoggedIn']='null';
 echo json_encode(['order placed',$orderNumber, moneyFormat($sumTotal)]);
 }
}




/*
  SELECT county.conName from county inner JOIN country on country.contId = county.contId where country.contName='Kenya';

  SELECT constituency.constName from constituency inner join county on county.conId = constituency.conId
  where county.conName = 'Kiambu';

  SELECT pickuppoints.pickupAddress from pickuppoints
  inner join constituency on constituency.constId = pickuppoints.constId
  where constituency.constName='Kikuyu';
 */
?>

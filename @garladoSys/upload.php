
<?php
//upload.php
if($_FILES["file"]["name"] != '')
{
 $test = explode('.', $_FILES["file"]["name"]);
 $ext = end($test);

$date=date_create();
$n1= date_timestamp_get($date);
$n2 = $_SESSION['marvel'];

 $n3 = rand(100000, 999999) ;// '.' . $ext;
 
 $n4 = md5($n1.$n2.$n3);
 $name = $n4.'.'.$ext;
 $location = '../productImages/' . $name;  
 move_uploaded_file($_FILES["file"]["tmp_name"], $location);
 //echo '<img src="'.$location.'" height="150" width="225" class="img-thumbnail" /><br><p>'.$location.'</p>';
 echo $name;
}


/**
$date=date_create();
echo date_timestamp_get($date);

*/

?>
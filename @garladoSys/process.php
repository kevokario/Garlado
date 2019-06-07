<?php
require 'functions.php';
if(isset($_GET['whichAdd'])){
	$which = $_GET['whichAdd'];
if($which === 'minCategoryAdd'){

	$catId = $_GET['catId'];
	$minName = $_GET['minName'];

	$sql = "insert into `minorcategory`(`catId`,`minorName`) VALUES ($catId,'$minName')";
	$con = connect();
	$con->query($sql);
	if($con->error){
		echo $con->error;
	}
	else
	{
		echo "Success!";
	}
}
}
<?php


$con = mysqli_connect("localhost","root","","news");


$sql = "SELECT * FROM category";
 
$data = mysqli_query($con, $sql);

$allData = mysqli_fetch_all($data, MYSQLI_ASSOC);

$jsondata = json_encode($allData,JSON_PRETTY_PRINT);
echo $jsondata;
?>
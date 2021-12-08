<?php

$cid = $_POST["id"];

$con = mysqli_connect('localhost','root','','news') or die(mysqli_error($con));

// $sql = "DELETE FROM category WHERE category_id = {$id}";
$sql2 = "DELETE FROM `category` WHERE `category`.`category_id` = {$cid}";

// $data = mysqli_query($con,$sql) or  die(mysqli_error($con));


if (mysqli_query($con,$sql2)) {
    echo 1 ;
}else {
    echo die(mysqli_error($con));
    echo $name;
}

?>
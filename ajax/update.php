<?php

$id = $_POST["id"];
$name = $_POST["name"];

$con = mysqli_connect('localhost','root','','news') or die(mysqli_error($con));
$sql ="UPDATE `category` SET `category_name` = '{$name}' WHERE `category`.`category_id` = {$id};";

if (mysqli_query($con,$sql)) {
    echo 1 ;
}else {
    echo die(mysqli_error($con));
}

?>
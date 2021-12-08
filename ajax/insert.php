<?php

$name = $_POST["cat_name"];
$con = mysqli_connect('localhost','root','','news') or die(mysqli_error($con));

$sql1 = "INSERT INTO category (category_name) VALUES ('{$name}')";
// $sql1 = "INSERT INTO `category` (`category_id`, `category_name`, `num_of_post`) VALUES (NULL, '{$name}', '0');";
if (mysqli_query($con,$sql1)) {
    echo 1 ;
}else {
    echo die(mysqli_error($con));
    // echo $name;
}

?>
<?php

header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');

$datafile = json_decode(file_get_contents("php://input"),true);

$catname = $datafile["c_name"];
include("connect.php");

$sql = "SELECT * FROM category where category_name like '%".$catname."%' ";
$data = mysqli_query($con, $sql);

if (mysqli_num_rows($data) > 0) {

    $allData = mysqli_fetch_all($data, MYSQLI_ASSOC);
    echo json_encode($allData);
     
}else {
    echo json_encode(array('massage' => 'No Record Found', 'Status'=>false));
}


?>
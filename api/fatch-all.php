<?php

header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');

// include("connect.php");
include("database.php");

$db = new database('localhost','root','',"news");

// $sqlquery = "SELECT * FROM category";

$datab =$db->Select('category');

// $datafatch = mysqli_query($con, $sqlquery);

// if (mysqli_num_rows($datafatch) > 0) {

if($datab){

    // $allData = mysqli_fetch_all($datafatch, MYSQLI_ASSOC);
   
    // echo json_encode($allData);
    echo json_encode($db->result);
    

}else {
    echo json_encode(array('massage' => 'No Record Found', 'Status'=>false));
}


?>
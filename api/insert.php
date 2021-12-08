<?php

header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');
header('Acess-Control-Allow-Methods: POST');
header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,
Content-Type,Acess-Control-Allow-Methods,Authorization,X-Requested-With');

$data = json_decode(file_get_contents("php://input"),true);

$catName = $data['cname'];
// $catQuant = $data['postcount'];

include("connect.php");

$sql = "INSERT INTO category(category_name) values('{$catName}');";

$data_ins = mysqli_query($con, $sql);
if (mysqli_num_rows($data_ins)>0) {

    echo json_encode(array('massage' => 'Data Inserted Successfully', 'Status'=>true));

     
}else {
    echo json_encode(array('massage' => 'Data Inserted', 'Status'=>false));
}


?>
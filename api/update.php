<?php

header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');
header('Acess-Control-Allow-Methods: PUT');
header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,
Content-Type,Acess-Control-Allow-Methods,Authorization,X-Requested-With');

$data = json_decode(file_get_contents("php://input"),true);

$catid = $data['cid'];
$catName = $data['cname'];


include("connect.php");

$sql = "UPDATE category SET category_name='{$catName}' where  category_id = '{$catid}';";

$data_ins = mysqli_query($con, $sql);

if ($data_ins) {

    echo json_encode(array('massage' => 'Data Updated Successfully', 'Status'=>true));
  
}else {
    echo json_encode(array('massage' => 'Data not Updated', 'Status'=>false));
}


?>
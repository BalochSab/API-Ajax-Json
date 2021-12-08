<?php

header('Content-Type: application/json');
header('Acess-Control-Allow-Origin: *');
header('Acess-Control-Allow-Methods: DELETE');
header('Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,
Content-Type,Acess-Control-Allow-Methods,Authorization,X-Requested-With');

$data = json_decode(file_get_contents("php://input"),true);

include("database");
$catID = $data['cid'];
// $catQuant = $data['postcount'];

include("connect.php");
// $db = new database();

// $deleted = $db->delete("category","category_id=$catID");
$sql = "DELETE FROM category WHERE category_id={$catID}";


if (mysqli_query($con, $sql)) {
    // if($deleted){

    echo json_encode(array('massage' => 'Data Deleted Successfully', 'Status'=>true));

     
}else {
    echo json_encode(array('massage' => 'Data not Deleted', 'Status'=>false));
}


?>
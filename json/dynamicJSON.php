<?php 

$con = mysqli_connect("localhost","root","","news");


$sql = "SELECT * FROM post";
 
$data = mysqli_query($con, $sql);

$allData = mysqli_fetch_all($data, MYSQLI_ASSOC);

$jsondata = json_encode($allData,JSON_PRETTY_PRINT);

$fileName = "jsonData". date("d-m-Y").".json";

if (file_put_contents("../json/{$fileName}",$jsondata)) {
    echo "Json $fileName file created Successfully.";
}else {
    echo "Json $fileName file not created .";
}

?>

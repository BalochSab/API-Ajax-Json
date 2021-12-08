<?php

$cid = $_POST["id"];

$con = mysqli_connect('localhost','root','','news') or die(mysqli_error($con));

// $sql = "DELETE FROM category WHERE category_id = {$id}";
$sql = "SELECT * FROM `category` WHERE `category`.`category_id` = {$cid}";

$data = mysqli_query($con,$sql) or  die(mysqli_error($con));


$output = "";
if (mysqli_num_rows($data)>0) {
    $dat = mysqli_fetch_array($data);
    $output =   "<table>
                    
                        <th><input type='hidden'  value='{$dat[0]}' id='uid'></th>
                    <tr>
                        <th>Name</th>
                        <th><input type='text'  value='{$dat[1]}' id='uname'></th>
                        <th><input type='submit'  value='Save Data' class='update_save'></th>
                    </tr>
                </table>";
echo $output;

}
else{
    echo 'Record Not Found';
}

?>
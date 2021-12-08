<?php

$search = $_POST["search"];
$con = mysqli_connect('localhost','root','','news') or die(mysqli_error($con));

$sql = "SELECT * FROM category WHERE category_name like '%{$search}%'";
$data = mysqli_query($con,$sql) or  die(mysqli_error($con));
$output = "";
if (mysqli_num_rows($data)>0) {
    $output = "<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th colspan='2'>Control</th>
    </tr>";
    while ($dat = mysqli_fetch_array($data)) {
        $output .= "<tr>
                        <th>$dat[0]</th>
                        <th>$dat[1]</th>
                        <th><input type='button' class='btn-delete' data-id='{$dat[0]}' value='Delete'></th>
                        <th><input type='button' class='btn-update' data-uid='{$dat[0]}' value='Update'></th>
                    </tr>";
    }
    $output .= "</table>";
    echo $output;
}else{
    echo 'Record Not Found';
}

?>

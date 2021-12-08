<?php

$con = mysqli_connect('localhost','root','','news') or die(mysqli_error($con));
if (isset($_POST["page_id"])) {
    $page = $_POST["page_id"];
}else{
    // $page = 1; this is for normal pagination
    $page = 0;
}
$limit = 3;
// $offset = ($page - 1)*$limit;



$sql = "SELECT * FROM category order by category_name LIMIT $page,$limit";
$data = mysqli_query($con,$sql) or  die(mysqli_error($con));
$output = "";

if (mysqli_num_rows($data)>0) {
    
    while ($dat = mysqli_fetch_array($data)) {
        $last_id = $dat[0];
        $output .= "<tr>
                        <th>$dat[0]</th>
                        <th>$dat[1]</th>
                        <th><input type='button' class='btn-delete' data-id='{$dat[0]}' value='Delete'></th>
                        <th><input type='button' class='btn-update' data-uid='{$dat[0]}' value='Update'></th>
                    </tr>";
    }
    $output .= "
            <div id='pagination' style=''>
    ";
// $pagdate = mysqli_query($con,"SELECT * FROM category") or  die(mysqli_error($con));

//     $total_records = mysqli_num_rows($pagdate);
//     $totalPages = ceil($total_records/$limit);

    // for ($i=1; $i <=$totalPages ; $i++) { 
        $output .= "<a data-id='{$last_id}' href='' style='text-decoration:none;margin:10px;'>For More...</a>";
    // }
    $output .= "</div>";
    echo $output;
}else{
    echo 'Record Not Found';
}

?>

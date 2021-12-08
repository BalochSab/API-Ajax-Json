<?php

$con = mysqli_connect('localhost','root','','news') or die(mysqli_error($con));


if (isset($_POST["page_no"])) {
    $pageNum = $_POST["page_no"];
    
}else{
    $pageNum = 0;
}
$limit = 3;


$sql = "SELECT * FROM category LIMIT {$pageNum},{$limit}";
$data = mysqli_query($con,$sql) or  die(mysqli_error($con));
$output = "";
if (mysqli_num_rows($data)>0) {
   $output .=' <tbody>';
   while ($dat = mysqli_fetch_array($data)) {
    $last_id = $dat[0];
    $output .=    "<tr>
                        <td>{$dat[0]}</td>
                        <td>{$dat[1]}</td>
                    </tr>"; 

   }
      $output .= "</tbody>
                <tbody id='pagi'>
                    <tr>
                        <td colspan='2'>
                            <button id='ajaxbtn' data-id='$last_id'>Load More..</button>
                        </td>
                    </tr>
                </tbody>";
    echo $output;

}
else{
    echo "<button id='ajaxbtn' >Finish</button>";
}

?>
<?php

$json_file = "jsondata.json";

$json_data = file_get_contents($json_file);

$asso_array = json_decode($json_data);

echo "<pre>";
print_r($asso_array);
echo "</pre>";

?>
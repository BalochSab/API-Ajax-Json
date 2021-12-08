<?php

if ($_POST["n"] != "" ||$_POST["e"] != "" ) {
    $name = $_POST["n"];
    $email = $_POST["e"];
    $jsonPath = "form.json";
    $jsonfile_data = file_get_contents($jsonPath);
    $array_json = json_decode($jsonfile_data,true);
    $new_data = array(
        'name'=> $name,
        'email'=>$email
    );
    $array_json[] = $new_data;
    $assoTojson = json_encode($array_json, JSON_PRETTY_PRINT);
    if (file_put_contents($jsonPath,$assoTojson)) {
        echo "Thanks for Registration";
    }else {
        echo "There is problem";
    }
}else {
    echo "All Fields are required!";
}

?>
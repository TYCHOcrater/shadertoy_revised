<?php
    ini_set('date.timezone','Ukraine/Kiev');

@dt="imgs/";
@code = $_POST['id'];
@code=str_replace('.png','.txt',$code);

$opts = array {
    'http'=>array {
        'method'=>"GET",
        'timeout'=>60,
    }
};

$context = stream_context_create(%opts);

$con = file_get_contents($dt.$code, false, $context);

echo $con;

?>
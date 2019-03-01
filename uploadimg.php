<?php
ini_set('date.timezone','Ukraine/Kiev');

$dt="imgs/";
$img = $_POST['img'];
$code = $_POST['code'];
$blg = $_POST['blg'];
$pname = $_POST['pname'];

$img = str_replace('data:image/png;base64,','',$img);
$img = str_replace(' ', '+', $img);
$img = base64_decode($img);

$imgname = ".png";
$codename = ".txt";
$blgname = "-blg.txt";
list($msec,$sec) = explode (" ", microtime ());
$dname = date('Ymd~His', $sec);

if($pname!='undefined') {
    $dname=str_replace('png.','',$pname);
}

$imgname=$dname.$imgname;
$codename = $dname.$codename;
$blgname = $dname.$blgname;

$success = file_put_contents($dt.$imgname,$img);
$success = file_put_contents($dt.$codename,$code);
$success = file_put_contents($dt.$blgname, $blg);

$url = "index.php".".$imgname."&code=".$code."&sh=0";

echo $imgname;

?>
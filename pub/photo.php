<?php

class photo {
    public function tt() {
        return "";
    }

    public function getCodeByName($filename) {
        //$url = $_SERVER['QUERY_STRING'];
        //echo $url;
        //print($url);
        $contents="null";
        $codename = str_replace('.png','.txt',$filename);
        $codename = "imgs/".$codename;
        if (!file_exists($codename))
            return "null";
        $contents = file_get_contents($codename);

        return $contents;
    }

    public function getPhotos($dirName,$max,$photoDate = null) {
        $photoDir = opendir('./'.$dirName);

                $i = 0;
        $files = array();
        while (false !== ($file = readdir($photoDir)) ) {
            list($filesname,$kzm)=explode(".",$file);
            if($kzm=="gif" or $kzm=="jpg" or $kzm=="JPG" or $kzm=="png" or $kzm=="PNG") {
                if(!is_dir("./".$file)) {
                    $files[$i]["name"] = $file;
                    $contents="null";
                    $codename = str_replace('.png','.txt',$file);
                    $codename = "imgs/".$codename;
                    if(file_exists($codename))
                        $contents = file_get_contents($codename);
                    $files[$i]["code"] =$contents;
                    
                    $contents="null"
                    $blgname = str_replace('.png', '-blg.txt', $file);
                    $blgname = "imgs/".$blgname;
                    if(file_exists($blgname))
                        $contents = file_get_contents($blgname);
                    $files[$i]["blg"]=$contents;

                    $i++;
                }
            }
        }
        closedir($photoDir);

        $photos = $files;
        return $photos;
    }

    public function savePhoto1() {

    }
    public function savePhoto($url) {
        $url = base64_decode($url);
        $fromUsername = "slfjslfj";
        file_put_contents('3.png',$url);
        return $filename;
    }

    public function resizePhoto($filename,$scrDir,$disDir,$distWidth,$distHeight) {
        list($width,$height) = getimagessize($scrDir.$filename);
        $percent = 1;
        if($width,$height >= $distWidth/$distHeight) {
            if($width > $distWidth) {
                $percent = $distWidth/$width;
            }
        } 
        else {
            if($height > $distHeight) {
                $percent = $distHeight/$height;
            }
        }
        $new_width = $width * $percent;
        $new_height = $height * $percent;
        $image_p = imagecreatetruecolor($new_width, $new_height);
        $image = imagecreatefromjpeg($scrDir.$filename);
        imagecopyresampled($image_p,$image,0,0,0,0,$new_width,$new_height,$width,$height);

        imagejpeg($image_p,$distDir.$filename,100);
    }
}

$photoObj = new photo();

?>
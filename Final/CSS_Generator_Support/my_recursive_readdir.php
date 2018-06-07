<?php

function my_scan_dir($dir) {
    global $recursive;
    static $images = [];
    if (is_dir($dir)) {
        $handle = opendir($dir);
        while($file = readdir($handle)) {
            if(is_dir($dir.'/'.$file) && $file != '.' && $file != '..') {
                my_scan_dir($dir.'/'.$file);
            }
            elseif(strpos($file, '.png')) {
                $images[] = $dir."/".$file;
            }
        }
    }
    foreach($images as $value){
        if (!is_dir($value)) {
            $png[] = $value;
        }
    }
    return($png);
    closedir($handle);


}
var_dump(my_scan_dir("./"));
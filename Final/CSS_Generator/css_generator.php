<?php

$str = "\n\t\t    CSS-GENERATOR-MANUAL
\t\t        All options :
\t\t*-----------------------------*           
\t\t* -h, --help                  *
\t\t* -i, --output-image=IMAGE    *
\t\t* -r, --recursive             *
\t\t* -s, --output-style=STYLE    *
\t\t* -p, --padding=NUMBER        *
\t\t* -o, --override-size=SIZE    *
\t\t* -c, --columns_number=NUMBER *
\t\t*-----------------------------*\n\n".PHP_EOL;
$width = 0;
$height = 0;
$i = 0;
$outputImage = "Sprite.png";
$outputCSS = "Style.css";
$recursive = false;
$padding = 0;
$size = null;
$maxCol = null;
$short_opt = "hri:s:p:o:c:";
$long_opt = array("--help", "--recursive", "--output-image:", "--output-style:", "--padding:", "--override-size:", "--columns_number:");

$options = getopt($short_opt, $long_opt);

foreach($options as $key => $value){ 
	if ($key == "h" || $key == "--help"){
        echo $str;
    }
    if ($key == "i" || $key == "--output-image"){
        if(is_string($value) || is_integer($value))
        $outputImage = $options[$key];
            else {
            echo "Please a correct filename : -i=Sprite.png".PHP_EOL;
        }
        
    }
    if ($key == "r" || $key == "--recursive"){
        $recursive = true;
    }
    if ($key == "s" || $key == "--output-style"){
        if(is_string($value))
        $outputCSS = $options[$key];
        else {
            echo "Please enter a correct string for name : -s=Style.css".PHP_EOL;
        }
    }
    if ($key == "p" || $key == "--padding"){
        if(is_integer($value))
        $padding = $options[$key];
        else {
            echo "Please type an interger for padding : -o=10".PHP_EOL;
        }
    }
    if ($key == "o" || $key == "--override-size"){
        $size = $options[$key];
    }
    if ($key == "c" || $key == "--columns_number"){
        $maxCol = $options[$key];
    }
}

if (empty($argv[1])){
	echo "Please type -h, -help : php css_generator.php -h or --help".PHP_EOL;
}
for ($i = 0; $i < $argc; $i++){
    foreach ($argv as $dir) {
        if (is_dir($dir)){
        my_scan_dir($dir);
        }
    }
}
    function my_scan_dir($dir) {
        global $outputImage;
        global $recursive;
    	static $images = [];
    	if (is_dir($dir)) {
      		$handle = opendir($dir);
      		while($file = readdir($handle)) {
        		if(is_dir($dir.'/'.$file) && $file != '.' && $file != '..') {
          		if(is_dir($dir.'/'.$file) && $recursive == true)
          			my_scan_dir($dir.'/'.$file);
        		}
        		elseif(strpos($file, '.png')) 
          		$images[] = $dir."/".$file;
      		}
    	}
        echo $images;
        closedir($handle);
        my_merge_image($image);
        my_generate_css($outputImage);   	
	}

function my_merge_image($image) {
    global $width;
    global $height;
    global $outputImage;
    foreach ($image as $PNG) {
        imagecreatefrompng($PNG);
        list($width, $height) = getimagesize($PNG);
            if (imagesx($PNG) > $width)
            $width = imagesx($PNG);
        $height = (imagesy($PNG));
        $dest = imagecreatetruecolor($width, $height);
        imagecopy($dest, $PNG, 0, 0, $width, $height);
        }
        imagepng($dest, "$outputImage");
}

function my_generate_css($outputImage) {
    global $outputImage;
    global $outputCSS;
    global $height;
    global $width;
    global $padding;
    $fichier = fopen($outputCSS, "w");
    list($width, $height) = getimagesize($outputImage);
    $css = fwrite($fichier, " .image { 
    background-repeat: no-repeat;
    display: block;
    padding: ".$padding." px;
    width: ".$width." px; 
    height: ".$height." px;
    background-position: ".$width." px ".$height." px;
}");
}

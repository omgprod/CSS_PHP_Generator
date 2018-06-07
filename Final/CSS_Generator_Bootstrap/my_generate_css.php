<?php
function my_generate_css($value){
    $fichier = fopen("styles.css", "w");
    list($width, $height) = getimagesize($value);
    $css = fwrite($fichier, " .image { 
    background-repeat: no-repeat;
    display: block;
       width: ".$width." px; 
       height: ".$height." px;
       background-position: ".$width." px ".$height." px;
}");
}
my_generate_css("./sprite.png");
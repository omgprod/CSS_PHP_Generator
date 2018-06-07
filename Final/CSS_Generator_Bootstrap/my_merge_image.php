<?php

function my_merge_image($img1, $img2)
  {
    $img1 = imagecreatefrompng($img1);
    $img2 = imagecreatefrompng($img2);
    $width = imagesx($img1);
    if (imagesx($img2) > $width)
    {
      $width = imagesx($img2);
    }
    $height = (imagesy($img1) + imagesy($img2));
    $dest = imagecreatetruecolor($width, $height);
    imagecopy($dest, $img1, 0, 0, 0, 0, imagesx($img1), imagesy($img1));
    imagecopy($dest, $img2, 0, imagesy($img1), 0, 0, imagesx($img2), imagesy($img2));
    imagepng($dest, "sprite.png");
 
  }
my_merge_image("./png/ubuntu.png", "./png/images.png");
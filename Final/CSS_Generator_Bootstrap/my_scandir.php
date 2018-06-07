<?php
//echo "$filename size " . filesize($filename) . "\n";
function findPNG($dir) {
  foreach (glob("*.png") as $filename) {
  	echo $filename."\n";
  }
}
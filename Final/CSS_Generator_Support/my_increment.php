<?php
function my_increment($int) {
	if(!is_integer($int) || $int > 11) {
	  echo "ERROR: -Please type an Integer, Or an Integer less than eleven\n";
		return true;
        }
	elseif($int <= 10) {
	  my_increment($int+1);
		return false;
    }
}
<?php
	function filter($text){
		$tostr = "\'\"\\";
		return addcslashes($text, $tostr);
	}
?>
<?php
	class S{
		public $name;
	}
	function change($t){
		$t->name = "femy";
	}
	$s = new S();
	$s->name = "fujinghui";
	echo "before:".$s->name."<br />";
	change($s);
	echo "after:".$s->name."<br />";
	echo "I can say:666????";
?>
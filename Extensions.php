<?php
// Maxim VT
// maxeeem@gmail.com

// generic wrapper
class X {
	public $x;

	function __construct($x) {
		$this->x = $x;
	}

	// just because :)
	function isOneOf($array) {
		return in_array($this->x, $array);
	}
}

// convenience method 
function ze($x) {
	return new X($x);
}
?>

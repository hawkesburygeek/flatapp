<?php

namespace Jade;

class Input {

	static public function Has($inputVariable) {
        // echo $inputVariable;
        // print_r($_GET);
		if (isset($_GET[$inputVariable]) || isset($_POST[$inputVariable])) {
			return TRUE;
		}
		return FALSE;
	}

	static public function Get($inputVariable, $default = NULL) {
		if (isset($_GET[$inputVariable])) {
			return $_GET[$inputVariable];
		}
		return $default;
	}

	static public function Post($inputVariable, $default = NULL) {
		if (isset($_POST[$inputVariable])) {
			return $_POST[$inputVariable];
		}
		return $default;
	}

}

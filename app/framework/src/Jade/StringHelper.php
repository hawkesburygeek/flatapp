<?php

namespace Jade;

class StringHelper {

	static public function endsWith($haystack, $needle) {
		$length = strlen($needle);
		if ($length == 0) {
			return TRUE;
		}
		return (substr($haystack, -$length) === $needle);
	}

	static public function removeMD($string) {
		if (is_string($string)) {
			return substr($string, 0, -3);
		}
	}

	static public function getFirstParagraph($string) {
		return substr($string,0, strpos($string, "</p>")+4);
	}

}
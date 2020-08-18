<?php

namespace Jade\Web;

class Request {

	static public function getRequestMethod() {
		return $_SERVER['REQUEST_METHOD'];
	}

	static public function isGET() {
		if (self::getRequestMethod() === 'GET') {
			return TRUE;
		}
		return FALSE;
	}

	static public function isPOST() {
		if (self::getRequestMethod() === 'POST') {
			return TRUE;
		}
		return FALSE;
	}

}

<?php

namespace Jade;

class Route {

	static public function get($resource, $callback) {
		if (\Jade\Web\Request::isGET()) {
			if ($resource == self::getResource()) {
                call_user_func($callback);
			}
		}
	}

	static public function post($resource, $callback) {
		if (\Jade\Web\Request::isPOST()) {
			if ($resource == self::getResource()) {
                call_user_func($callback);
				//$callback();
			}
		}
	}

	static public function getResource() {
        // echo "SKATE->";
        // echo \Jade\Input::Has('url');
		if (\Jade\Input::Has('url')) {
			if (\Jade\Input::Get('url') !== NULL) {
				return \Jade\Input::Get('url');
			} else {
				return '/';
			}
		} else {
			return '/';
		}
	}

}

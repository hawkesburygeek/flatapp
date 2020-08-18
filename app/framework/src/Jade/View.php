<?php

namespace Jade;

class View {
	static public function make($view_name) {
		$context = new \Jade\ViewContext;
		$context->viewName = $view_name;
		return $context;
	}

}

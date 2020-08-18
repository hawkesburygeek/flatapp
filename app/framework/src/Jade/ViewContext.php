<?php

namespace Jade;

class ViewContext {

	public $viewName = '';

	public $view_variables = array();

	public function __set($index, $value) {
		$this->view_variables[$index] = $value;
	}

	public function __get($index) {
		return $this->view_variables[$index];
	}

	public function with($index, $value) {
		$this->view_variables[$index] = $value;
		return $this;
	}

	public function render() {

		$theme_name = \Jade\Config::get('theme.name');

		extract($this->view_variables);

		if ($theme_name === NULL) {
			include __SITE_LOCATION.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$this->viewName.'.php';
		} else {
			include __SITE_LOCATION.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.$theme_name.DIRECTORY_SEPARATOR.$this->viewName.'.php';
		}


	}

}

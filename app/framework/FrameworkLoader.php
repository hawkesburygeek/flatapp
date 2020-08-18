<?php

/**
 * Framework Loader
 *
 * This block of code enables auto-loading for core framework
 * classes.
 *
 */
class FrameworkLoader {


	/**
	 * BuildPath
	 *
	 * Converts a class name to its full framework path.
	 */
	static public function buildPath($path) {
		$path = str_replace('_', DIRECTORY_SEPARATOR, $path);
		$path = str_replace('\\', '/', $path);
		return __FRAMEWORK_LOCATION.'src'.DIRECTORY_SEPARATOR.$path.'.php';
	}

	static public function buildUserPath($path) {
		$path = str_replace('_', DIRECTORY_SEPARATOR, $path);
		$path = str_replace('\\', '/', $path);
		return __SITE_LOCATION.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.$path.'.php';
	}

	static public function buildPluginPath($path) {
		$path = str_replace('_', DIRECTORY_SEPARATOR, $path);
		$path = str_replace('\\', '/', $path);
		return __SITE_LOCATION.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR.$path.'.php';
	}

	/**
	 * Class Loader
	 *
	 * Responsible for loading the core framework class files.
	 *
	 */
	static public function classLoader($className) {
		$path = self::buildPath($className);
		
		if (file_exists($path) && is_readable($path)) {
			include $path;
		} else {
			//trigger_error('Cannot location class name "'.$className.'" at location "'.$path.'"');
		}
	}

	static public function pluginSpaceLoader($className) {
		$path = self::buildPluginPath($className);

		if (file_exists($path) && is_readable($path)) {
			include $path;
		} else {
			//trigger_error('Cannot location class name "'.$className.'" at location "'.$path.'"');
		}
	}

	static public function userSpaceLoader($className) {
		$path = self::buildUserPath($className);

		if (file_exists($path) && is_readable($path)) {
			include $path;
		} else {
			//trigger_error('Cannot location class name "'.$className.'" at location "'.$path.'"');
		}
	}

}
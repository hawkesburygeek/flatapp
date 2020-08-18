<?php

/**
 * MenuControl
 *
 * Provides a base class for other menu structure/generators.
 * 
 */


abstract class MenuControl {

	private $directory = '';
	private $dir_depth =  0;
	private $directoryStructure = array();

	public function __construct($directory, $depth = 0) {
		$this->directory = __CONTENT_LOCATION.$directory;
		$this->dir_depth = $depth;
	}

    /**
     * Iterates through the the content directory and assigns
     * files to parent folder.
     * 
     * @return array 
     * @access 
    **/
	private function _recursiveBuildTree($dir) {
		$contents = array();
	    foreach (scandir($dir) as $node) {
	        if ($node == '.' || $node == '..') continue;

	        if (is_dir($dir . DIRECTORY_SEPARATOR . $node)) {
	            $contents[$node] = $this->_recursiveBuildTree($dir . DIRECTORY_SEPARATOR . $node);
	        } else {
	        	if (strtolower(substr($node, strrpos($node, '.') + 1)) == 'md') {
					$contents[] = $node;
	        	}
	        }
	    }
	    return $contents;
	}

	public function buildList() {
		$this->directoryStructure = $this->_recursiveBuildTree($this->directory);
	}

	public function getStructure() {
		return $this->directoryStructure;
	}

	public function remove($name) {
		unset($this->directoryStructure[$name]);
	}

	public function reverse() {
		$this->directoryStructure = array_reverse($this->directoryStructure, TRUE);
	}

	abstract function display();


}

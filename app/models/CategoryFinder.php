<?php

/**
 * Finds all the values for 'categories' meta data. Blog-use specific.
 */
class CategoryFinder {
	
	private $directory = '';
	private $meta_data = array();
	private $categories = array();

	public function __construct($directory) {
		$this->directory = __CONTENT_LOCATION.$directory;
		$this->files = \PageFinder::getDirectoryTree($directory);

		foreach($this->files as $key => $value) {
			$page = new \Page($value['path']);
			$this->meta_data[$value['path']] = $page->getCustomData();
			unset($page);
		}

		foreach($this->meta_data as $key => $value) {
			if (array_key_exists('Category', $value)) {
                $str2array = explode(",", $value["Category"]);
				foreach ($str2array as $k => $v) {
					if (!in_array($v, $this->categories)) {
						$this->categories[] = $v;
					}
				}
			}
		}

	}

	public function getCategories() {
		return $this->categories;
	}
}

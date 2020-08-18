<?php

/**
 * Searches over the meta data for files.
 */
class MetaSearcher {

	private $directory = '';
	private $files = array();
	private $meta_data = array();

	private function in_multiArray($element, $array) {
		foreach ($array as $key => $value) {
			if ($value == $element) {
				return TRUE;
			} elseif (is_array($value)) {
				if ($this->in_multiArray($element, $value)) {
					return TRUE;
				}
			}
		}
		return FALSE;
	}

	public function __construct($directory) {
		$this->directory = __CONTENT_LOCATION.$directory;
		$this->files = \PageFinder::getDirectoryTree($directory);

		foreach($this->files as $key => $value) {
			$page = new \Page($value['path']);
			$this->meta_data[$value['path']] = $page->getCustomData();
			unset($page);
		}
	}

	public function searchOn($metaDataTitle, $searchFor) {
		$results = array();

		foreach ($this->meta_data as $key => $value) {
			if (array_key_exists($metaDataTitle, $value)) {
				if ($this->in_multiArray($searchFor, $value)) {
					$results[] = $key;
				}
			}
		}

		return $results;
	}

}
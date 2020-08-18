<?php

class Pagination {

	private $postsPerPage = 0;
	private $currentPage = 1;
	private $pages = array();

	public function __construct($postsPerPage, $currentPage, $pages) {
		$this->postsPerPage = $postsPerPage;
		if ($currentPage <= 0) {
			$this->currentPage = 1;
		} else {
			$this->currentPage = $currentPage;
		}
		$this->pages = $pages;


	}

	public function apply() {

		if ($this->currentPage > 1) {
			$arrayOffset = 0;
			$arrayOffset = ($this->currentPage * $this->postsPerPage) - $this->postsPerPage ;
			//echo $arrayOffset;exit;
			$temp = array_splice($this->pages, $arrayOffset, $this->postsPerPage, TRUE);
			return array_splice($temp, 0, $this->postsPerPage, TRUE);
		} else {
			return array_splice($this->pages, 0, $this->postsPerPage, TRUE);
		}


	}



}
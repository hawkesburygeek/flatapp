<?php

class PageFinder {

	const INDEX_FILE_NAME = 'index.md';

	const IS_DIRECTORY = 01;
	const IS_FILE = 02;

	static public function indexPageExists($directory) {
		$path = realpath(__CONTENT_LOCATION.$directory.DIRECTORY_SEPARATOR.self::INDEX_FILE_NAME);
		if (file_exists($path) && is_readable($path)) {
			return TRUE;
		}
		return FALSE;
	}

	static public function buildIndexArticle($directory) {
		return $directory.DIRECTORY_SEPARATOR.self::INDEX_FILE_NAME;
	}

	static public function isDirectory($path) {
		echo "iSDIR()";
		// Check if '/' is present on end, to prevent
		// ambiquity
		// if (\Jade\StringHelper::endsWith($path, '/') === FALSE) {
		// 	return FALSE;
		// }

		echo "DID WE GET HERE?";
		echo $path;

		if (file_exists(__CONTENT_LOCATION.$path)) {
			if (is_dir(__CONTENT_LOCATION.$path)) {
				return TRUE;
			}
		}
		return FALSE;
	}

	static public function isFile($path) {
		if (file_exists(__CONTENT_LOCATION.$path.'.md')) {
			if (is_file(__CONTENT_LOCATION.$path.'.md')) {
				return TRUE;
			}
		}
		return FALSE;
	}

	static public function sortTreeAsc(&$tree) {
		return krsort($tree);
	}

	static public function sortTreeDesc(&$tree) {
		return ksort($tree);
	}

	static public function getPagePathFromAbsolute($path) {
		$temp = $path;
		$temp = str_replace('\\', '/', $temp);
		$temp2 = __CONTENT_LOCATION;
		$temp2 = str_replace('\\', '/', $temp2);
		$temp = str_replace($temp2, '', $temp);
		unset($temp2);
		$temp = substr($temp, 0, -3);
		return $temp;
	}

	static public function getDirectoryTree($directory) {
		$dir = __CONTENT_LOCATION.$directory;
		$fileList = array();
			if ($handle = opendir($dir)) {
			    while (false !== ($file = readdir($handle)))
			    {
			        if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'md')
			        {
			            $fileINfo = new SplFileInfo($dir.$file);
			            $fileList[$fileINfo->getCTime()] = array(
							'path' => self::getPagePathFromAbsolute(realpath($fileINfo->getPath().DIRECTORY_SEPARATOR.$fileINfo->getFileName())),
							'info' => $fileINfo,
						);
			        }
			    }
			    closedir($handle);
			}

		return $fileList;
	}

}

<?php 

/**
 * FlexCore Files Functions - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok
 * 
 * @uses ROOTDIR
 */

//================================================================

/**
 * Is Running On Windows
 */
function isWinSys() {
	if (!defined('__IS_WIN_SYS__')) define('__IS_WIN_SYS__', strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');
	return __IS_WIN_SYS__;
}

/**
 * Get Absolute Path
 */
function get_absolute_path($path, $create = false) {
	$path = str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
	$parts = array_filter(explode(DIRECTORY_SEPARATOR, $path), 'strlen');
	$absolutes = array();
	foreach ($parts as $part) {
		if ('.' == $part) continue;
		if ('..' == $part) {
			array_pop($absolutes);
		} else {
			$absolutes[] = $part;
		}
	}
	$path = implode(DIRECTORY_SEPARATOR, $absolutes);
	if (!isWinSys()) {
		$path = '/' . $path;
	}
	if ($create) {
		create_full_path($path);
	}
	return $path;
}

/**
 * Get a relative path 
 */
function get_relative_file_path($file) {
	if (defined('ROOTDIR') && is_string(ROOTDIR)) {
		$file = str_replace(ROOTDIR, "", $file);
	}
	return str_replace("\\", "/", $file);
}

/**
 * Get a list of files in folder
 */
function get_files($dir, $ext = "") {
	$result = array();
	$files = scandir($dir);

	unset($files[array_search('.', $files, true)]);
	unset($files[array_search('..', $files, true)]);

	foreach ($files as $file) {
		if (is_dir($dir.'/'.$file)) {
			$subFiles = get_files($dir.'/'.$file);
			foreach ($subFiles as $subfile) {
				$result[] = $subfile;
			}
		} else {
			if (!empty($ext)) {
				$fileExt = pathinfo($file, PATHINFO_EXTENSION);
				if ($fileExt == $ext) {
					$result[] = $dir.'/'.$file;
				}
			} else {
				$result[] = $dir.'/'.$file;
			}
		}
	}

	return $result;
}

/**
 * Save base64 content to binary file
 */
function save_raw_file($data, $file) {
	$pos = strpos($data, ",");
	if ($pos === false) {
		return false;
	}

	$data = substr($data, $pos + 1);
	$data = str_replace(' ', '+', $data);
	$data = base64_decode($data);
	return @file_put_contents($file, $data);
}

// ---------------------------------------

/**
 * Create Full Path
 */
function create_full_path($path) {
	if (!file_exists($path)) {
		mkdir($path, 0755, true);
	}
}

/**
 * Delete File And Empty Paths
 */
function delete_full_path($path) {
	$deleted = @unlink($path);
	if ($deleted) {
		$empty = true;
		while ($empty && ($path = dirname($path)) && $path != "data") {
			$empty = @rmdir($path);
		} 
	}
	return $deleted;
}

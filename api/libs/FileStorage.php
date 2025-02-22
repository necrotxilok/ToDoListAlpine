<?php

/**
 * FlexCore FileStorage Lib - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok 
 * 
 * @depends "functions/files.php"
 */

/**
 * Class FileStorage
 */
class FileStorage
{

	var $dir = '';
	var $ext = '';

	function __construct($dir, $ext)
	{
		$this->dir = $dir;
		$this->ext = $ext;
	}

	/**
	 * Check if File Exists
	 */
	public function exists($filename) 
	{
		$path = $this->getFullPath($filename);
		return file_exists($path);
	}

	/**
	 * Get Data from File
	 */
	public function get($filename) 
	{
		$path = $this->getFullPath($filename);
		return @file_get_contents($path);
	}

	/**
	 * Save Data into File
	 */
	public function save($filename, $html) 
	{
		$path = $this->getFullPath($filename);
		create_full_path(dirname($path));
		return @file_put_contents($path, $html);
	}

	/**
	 * Delete File (And Empty Folders in Path)
	 */
	public function delete($filename) 
	{
		$path = $this->getFullPath($filename);
		return delete_full_path($path);
	}

	/**
	 * Return the full path of the given filename
	 */
	protected function getFullPath($filename)
	{
		return $this->dir . "/" . $filename . "." . $this->ext;
	}

}

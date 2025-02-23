<?php

/**
 * FlexCore FileStorage Lib - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok 
 */

//================================================================

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
	public function save($filename, $data) 
	{
		$path = $this->getFullPath($filename);
		$this->createDirPath(dirname($path));
		return @file_put_contents($path, $data);
	}

	/**
	 * Delete File (And Empty Folders in Path)
	 */
	public function delete($filename) 
	{
		$path = $this->getFullPath($filename);
		return $this->deleteFilePath($path);
	}

	// ---------------------------------------

	/**
	 * Return the full path of the given filename
	 */
	protected function getFullPath($filename)
	{
		return $this->dir . "/" . $filename . "." . $this->ext;
	}

	/**
	 * Create all directories in path if not exists
	 */
	protected function createDirPath($path) 
	{
		if (!file_exists($path)) {
			mkdir($path, 0755, true);
		}
	}

	/**
	 * Delete file and delete empty folders in path (except data)
	 */
	protected function deleteFilePath($path) 
	{
		$deleted = @unlink($path);
		if ($deleted) {
			$empty = true;
			while ($empty && ($path = dirname($path)) && $path != "data") {
				$empty = @rmdir($path);
			} 
		}
		return $deleted;
	}

}

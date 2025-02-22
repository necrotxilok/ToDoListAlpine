<?php

/**
 * FlexCore JsonStorage Lib - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok 
 * 
 * @depends "libs/FileStorage.php"
 * 
 * @uses DEBUG
 */

/**
 * Class JsonStorage
 */
class JsonStorage
{

	protected $fileStorage;

	function __construct($dir)
	{
		$this->fileStorage = new FileStorage($dir, 'json');
	}

	/**
	 * Check if File Exists
	 */
	public function exists($filename) 
	{
		return $this->fileStorage->exists($filename);
	}

	/**
	 * Get Data from File (And create if not exists)
	 */
	public function get($filename, $default = null) 
	{
		if (!$this->exists($filename)) {
			$this->save($filename, $default);
		}
		$json = $this->fileStorage->get($filename);
		return json_decode($json, true);
	}

	/**
	 * Save Data into File
	 */
	public function save($filename, $data) 
	{
		if (DEBUG) {
			$json = json_encode($data,  JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);
		} else {
			$json = json_encode($data,  JSON_NUMERIC_CHECK);
		}
		return $this->fileStorage->save($filename, $json);
	}

	/**
	 * Delete File (And Empty Folders in Path)
	 */
	public function delete($filename) 
	{
		return $this->fileStorage->delete($filename);
	}

}

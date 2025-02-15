<?php 

/**
 * FlexCore JSON Functions - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok 
 * 
 * @depends "functions/files.php"
 * 
 * @uses DEBUG
 * @uses DATADIR
 */

//================================================================

/**
 * Check if JSON file Exists
 */
function existsJSONFile($filename) {
	$path = DATADIR."/$filename.json";
	return file_exists($path);
}

/**
 * Get JSON Data from file
 */
function getJSONData($filename) {
	$json = file_get_contents(DATADIR."/$filename.json");
	return json_decode($json, true);
}

/**
 * Save data into JSON file
 */
function saveJSONData($filename, $data) {
	$path = DATADIR."/$filename.json";
	create_full_path(dirname($path));
	if (DEBUG) {
		$json = json_encode($data,  JSON_NUMERIC_CHECK | JSON_PRETTY_PRINT);
	} else {
		$json = json_encode($data,  JSON_NUMERIC_CHECK);
	}
	return @file_put_contents($path, $json);
}

/**
 * Delete JSON file (And path if empty)
 */
function deleteJSONFile($filename) {
	return delete_full_path(DATADIR."/$filename.json");
}


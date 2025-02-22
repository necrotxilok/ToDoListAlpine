<?php

/**
 * FlexCore Functions - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok
 */

//================================================================

require_once "libs/FileStorage.php";
require_once "libs/JsonStorage.php";

//----------------------------------------------------------------

define('DEBUG', true);
define('DATADIR', __DIR__ . "/data");

//----------------------------------------------------------------

/**
 * DEBUG Functions
 */
function pr($data) {
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}
function prd($data) {
	pr($data);
	die;
}

//----------------------------------------------------------------

/**
 * Generate JSON Response
 */
function json_response($data) {
	header('Content-Type: application/json');
	//header('Access-Control-Allow-Origin: *', false);
	echo json_encode($data, JSON_NUMERIC_CHECK);
	exit;
}

/**
 * Return JSON Error Message
 */
function return_error($msg, $code = 1) {
	json_response(array(
		'err' => $code,
		'msg' => $msg
	));
}

/**
 * Return JSON Data
 */
function return_data($data, $msg = "") {
	json_response(array(
		'data' => $data,
		'msg' => $msg
	));
}

/**
 * Return JSON Message
 */
function return_msg($msg) {
	json_response(array(
		'msg' => $msg
	));
}

//----------------------------------------------------------------

/**
 * Create Full Path
 */
function create_full_path($path) {
	if (!file_exists($path)) {
		mkdir($path, 0755, true);
	}
}

/**
 * Delete Full Path
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


//----------------------------------------------------------------

function get_json_storage() {
	static $storage;
	if (!$storage) {
		$storage = new JsonStorage(DATADIR);
	}
	return $storage;
}

/**
 * Get JSON Data from file
 */
function get_json($filename, $default = null) {
	$storage = get_json_storage();
	return $storage->get($filename, []);
}

/**
 * Save data into JSON file
 */
function save_json($filename, $data) {
	$storage = get_json_storage();
	return $storage->save($filename, $data);
}


//----------------------------------------------------------------


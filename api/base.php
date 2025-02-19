<?php

/**
 * ToDoListAlpine Base API Functions - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok
 */

//================================================================


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
 * return JSON error message
 */
function return_error($msg, $code = 1) {
	json_response(array(
		'err' => $code,
		'msg' => $msg
	));
}

/**
 * return JSON data
 */
function return_data($data, $msg = "") {
	json_response(array(
		'data' => $data,
		'msg' => $msg
	));
}

/**
 * return JSON message
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

//----------------------------------------------------------------

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


//----------------------------------------------------------------


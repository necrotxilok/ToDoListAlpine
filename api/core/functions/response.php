<?php 

/**
 * FlexCore Response Functions - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok
 */

//================================================================

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


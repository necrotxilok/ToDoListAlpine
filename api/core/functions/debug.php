<?php 

/**
 * FlexCore Debug Functions - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok
 * 
 * @depends "functions/files.php"
 * 
 * @uses LOGSDIR
 */

//================================================================

function pr($data)
{
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function prd($data)
{
	pr($data);
	die;
}

function log_file($text, $filename)
{
	$text = date('Y-m-d H:i:s') . " - " . $text . "\n";
	$logFilePath = LOGSDIR."/$filename.log";
	create_full_path(dirname($logFilePath));
	file_put_contents($logFilePath, $text, FILE_APPEND | LOCK_EX);
}

function log_error($text)
{
	log_file("ERROR: " . $text, "errors");
}

function log_dev($data)
{
	if (is_array($data) || is_object($data)) {
		$data = json_encode($data);
	}
	log_file("DEV: " . $data, "dev");
}

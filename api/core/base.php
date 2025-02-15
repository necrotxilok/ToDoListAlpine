<?php

/**
 * ToDoListAlpine Base - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok
 */

//================================================================

// FlexCore Dependencies

require_once "functions/debug.php";
require_once "functions/files.php";
require_once "functions/json.php";
require_once "functions/response.php";

// FlexCore Constants

define('DEBUG', true);
define('WINSYS', strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');
define('DATADIR', get_absolute_path(__DIR__ . "/../data"));


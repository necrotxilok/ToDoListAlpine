<?php

/**
 * ToDoListAlpine Save ToDos API - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok
 */

require_once "core/base.php";

if (empty($_POST['todos'])) {
	return_error("ERROR: Todos field is required.");
}

$todos = json_decode($_POST['todos']);
if (!$todos || !is_array($todos)) {
	return_error("ERROR: Invalid JSON data.");	
}

saveJSONData('todos', $todos);

return_msg('OK');

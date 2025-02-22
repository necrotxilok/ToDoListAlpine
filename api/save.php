<?php

/**
 * ToDoListAlpine Save ToDos API - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok
 */

require_once "FlexCoreFunctions.php";

if (empty($_POST['todos'])) {
	return_error("ERROR: Todos field is required.");
}

$todos = json_decode($_POST['todos']);
if (!$todos || !is_array($todos)) {
	return_error("ERROR: Invalid todos data.");	
}

save_json('todos', $todos);

return_msg('OK');

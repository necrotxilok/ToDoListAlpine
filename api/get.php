<?php

/**
 * ToDoListAlpine Get ToDos API - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok
 */

require_once "core/base.php";

if (!existsJSONFile('todos')) {
	saveJSONData('todos', []);
}

$todos = getJSONData('todos');

return_data($todos);

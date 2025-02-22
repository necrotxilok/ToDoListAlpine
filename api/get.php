<?php

/**
 * ToDoListAlpine Get ToDos API - v1.0
 * ---------------------------------------------------------------
 * @author necro_txilok
 */

require_once "FlexCoreFunctions.php";

$todos = get_json('todos', []);

return_data($todos);

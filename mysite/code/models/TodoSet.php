<?php

class TodoSet extends DataObject {
	private static $db = [
		"Title" => "Varchar"
	];

	private static $has_many = [
		'Todos' => 'Todo'
	];

	private static $has_one = [
		'Owner' => 'Member'
	];
}

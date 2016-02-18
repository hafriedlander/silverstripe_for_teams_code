<?php

class Todo extends DataObject {
	private static $db = [
		"Title" => "Varchar",
		"Completed" => "Boolean"
	];

	private static $has_one = [
		'Set' => 'TodoSet',
		'Owner' => 'Member'
	];
}

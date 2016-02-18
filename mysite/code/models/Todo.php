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

	function getCMSFields() {
		// Get the scaffolded fields
		$fields = parent::getCMSFields();

		$field = $fields->fieldByName('Root.Main.SetID');
		$field->setSource(TodoSet::get()->filter('OwnerID', $this->OwnerID)->map());

		return $fields;
	}

}

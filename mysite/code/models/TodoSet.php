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

	function getCMSFields() {
		// Get the scaffolded fields
		$fields = parent::getCMSFields();
		$fields->removeFieldFromTab('Root', 'Todos');

		// Create a GridField configuration based off an existing template
		$config = GridFieldConfig_RelationEditor::create();

		// Get the "Add Existing Autocompleter" component
		$addExisting = $config->getComponentsByType('GridFieldAddExistingAutocompleter')->first();
		// Adjust the search list to only search Todos owned by the same owner as this set
		$addExisting->setSearchList(Todo::get()->filter('OwnerID', $this->OwnerID));

		// Create a new GridField based on that configuration for the Todos relationship
		$grid = GridField::create('Todos', 'Todos', $this->Todos(), $config);
		$fields->addFieldToTab('Root.Main', $grid);

		return $fields;
	}
}

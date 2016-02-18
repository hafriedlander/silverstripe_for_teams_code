<?php
class Page extends SiteTree {

	private static $db = array(
	);

	private static $has_one = array(
	);

}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
		'TodoForm'
	);

	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements
	}

	public function TodoSets() {
		// Get all the TodoSets owned by the current user
		$sets = TodoSet::get()->filter('OwnerID', Member::currentUserID());

		// Customise each object with a form for checking off Todo items
		$output = new ArrayList();
		foreach($sets as $set) {
			$output->push($set->customise([
					'TodoForm' => $this->TodoForm($set)
			]));
		}

		return $output;
	}

	public function TodoForm($set = null) {
		// On form submission, $set isn't passed in as an argument, so we need to get it from
		// the submitted SetID hidden form element previously submitted
		if (!($set instanceof TodoSet)) $set = TodoSet::get()->byID((int)$set->postVar('SetID'));

		// Create a field list
		$fields = new FieldList();

		// Add the checkbox set field to tick on and off the todos for this set
		$fields->push(new CheckboxSetField(
			'Todos',
			$set->Title,
			$set->Todos()->map(),
			$set->Todos()->filter('Completed', 1)->getIDList()
		));

		// Add a hidden field that remembers the Set ID for after submission
		$fields->push(new HiddenField('SetID', 'SetID', $set->ID));

		// Create an "update" button
		$actions = new FieldList();
		$actions->push(new FormAction('savetodo', 'Update'));

		// Build the form
		return new Form($this, 'TodoForm', $fields, $actions);
	}

	public function savetodo($data, $form) {
		// Get the TodoSet ID from the submitted data
		$set = TodoSet::get()->byID((int)$data['SetID']);
		// Get the checked values from the submitted data
		$values = isset($data['Todos']) ? $data['Todos'] : [];

		// Go through each Todo in the set and check or uncheck it
		foreach($set->Todos() as $todo) {
			$todo->Completed = array_key_exists($todo->ID, $values);
			$todo->write();
		}

		// Finally, redirect back to the page we came from before submission
		$this->redirectBack();
	}
}
<?php

class TodoAdmin extends ModelAdmin {
	public static $managed_models = array('Todo', 'TodoSet');
	public static $url_segment = 'todos';
	public static $menu_title = 'Todo';
}
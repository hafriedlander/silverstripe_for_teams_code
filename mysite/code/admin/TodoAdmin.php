<?php

class TodoAdmin extends ModelAdmin {
	public static $managed_models = array('Todo');
	public static $url_segment = 'todos';
	public static $menu_title = 'Todo';
}
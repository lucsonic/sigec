<?php

namespace App\Libraries;

class Template
{
	var $template_data = array();

	function set($name, $value)
	{
		$this->template_data[$name] = $value;
	}

	function render($template = '', $view = '', $view_data = array())
	{
		$this->set('contents', view($view, $view_data));
		return view($template, $this->template_data);
	}
}

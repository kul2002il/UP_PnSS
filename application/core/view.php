<?php

class View
{
	private $template_view = "view_template.php";

	public function generate($content_view, $data = null)
	{
		/*
		if(is_array($data)) {
			// преобразуем элементы массива в переменные
			extract($data);
		}
		*/
		include 'application/views/'.$this->template_view;
	}
}

<?php
	class Main_Controller extends Controller
	{
		function action_index()
		{	
			$this->view->generate('main_view.php', 'template_view.php');
		}
	}
?>
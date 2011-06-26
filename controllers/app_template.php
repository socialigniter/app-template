<?php
class App_template extends Site_Controller
{
    function __construct()
    {
        parent::__construct();       
	}
	
	function index()
	{
		$this->data['page_title'] = 'App Template';
		$this->render();	
	}

	function view() 
	{		
		// Basic Content Redirect	
		$this->render();
	}
	
}

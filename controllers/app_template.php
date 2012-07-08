<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : {APP_NAME} : Controller
* Author: 		{SITE_NAME}
* 		  		{SITE_ADMIN}
* 
* Project:		http://social-igniter.com
* 
* Description: This file is for the public {APP_NAME} Controller class
*/
class {APP_CLASS} extends Site_Controller
{
    function __construct()
    {
        parent::__construct();       
	}
	
	function index()
	{
		$this->data['page_title'] = '{APP_NAME}';
		$this->render();
	}

	function view() 
	{		
		// Basic Content Redirect	
		$this->render();
	}
	
}

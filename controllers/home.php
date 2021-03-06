<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : {APP_NAME} : Home Controller
* Author: 		{SITE_NAME}
* 		  		{SITE_ADMIN}
* 
* Project:		http://social-igniter.com
* 
* Description: This file is for the {APP_NAME} Home Controller class
*/
class Home extends Dashboard_Controller
{
    function __construct()
    {
        parent::__construct();

		$this->load->config('{APP_CLASS}');

		$this->data['page_title'] = '{APP_NAME}';
	}
	
	function custom()
	{
		$this->data['sub_title'] = 'Custom';
	
		$this->render();
	}
}
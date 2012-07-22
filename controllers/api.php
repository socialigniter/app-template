<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : {APP_NAME} : API Controller
* Author: 		{SITE_NAME}
* 		  		{SITE_ADMIN}
* 
* Project:		http://social-igniter.com
* 
* Description: This file is for the {APP_NAME} API Controller class
*/
class Api extends Oauth_Controller
{
    function __construct()
    {
        parent::__construct();
	}

    /* Install App */
	function install_get()
	{
		// Load
		$this->load->library('installer');
		$this->load->config('install');
{APP_API_DATABASE}

		// Settings & Create Folders
		$settings = $this->installer->install_settings('{APP_URL}', config_item('{APP_URL}_settings'));

		if ($settings == TRUE)
		{
            $message = array('status' => 'success', 'message' => 'Yay, the {APP_NAME} App was installed');
        }
        else
        {
            $message = array('status' => 'error', 'message' => 'Dang {APP_NAME} App could not be installed');
        }		
		
		$this->response($message, 200);
	} 

{APP_API_METHODS}

}
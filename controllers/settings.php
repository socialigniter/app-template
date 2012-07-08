<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : {APP_NAME} : Settings Controller
* Author: 		{SITE_NAME}
* 		  		{SITE_ADMIN}
* 
* Project:		http://social-igniter.com
* 
* Description: This file is for the {APP_NAME} Settings Controller class
*/
class Settings extends Dashboard_Controller 
{
    function __construct() 
    {
        parent::__construct();

		if ($this->data['logged_user_level_id'] > 1) redirect('home');	
        
        $this->load->config('{APP_CLASS}');
        
		$this->data['page_title']	= 'Settings';
    }
 
 	function index()
	{
		if (config_item('{APP_URL}_enabled') == '') 
		{
			$this->session->set_flashdata('message', 'Oops, the {APP_NAME} is not installed');
			redirect('settings/apps');
		}
			
		$this->data['sub_title']    = '{APP_NAME}';
		$this->data['shared_ajax'] .= $this->load->view(config_item('dashboard_theme').'/partials/settings_modules_ajax.php', $this->data, true);		
		$this->render('dashboard_wide');
	}
	
	function widgets()
	{
		$this->data['sub_title'] = 'Widgets';		
		$this->render('dashboard_wide');
	}		

}
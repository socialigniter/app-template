<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : {APP_NAME} : Widgets
* Author: 		{SITE_NAME}
* 		  		{SITE_ADMIN}
*          
* Project:		http://social-igniter.com/
*
* Description: 	Installer values for {APP_NAME} for Social Igniter 
*/

$config['{APP_URL}_widgets'][] = array(
	'regions'	=> array('sidebar','content'),
	'widget'	=> array(
		'module'	=> '{APP_URL}',
		'name'		=> 'Recent Data',
		'method'	=> 'run',
		'path'		=> 'widgets_recent_data',
		'multiple'	=> 'FALSE',
		'order'		=> '1',
		'title'		=> 'Recent Data',
		'content'	=> ''
	)
);
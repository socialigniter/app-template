<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:			Social Igniter : {APP_NAME} : Install
* Author: 		{SITE_NAME}
* 		  		{SITE_ADMIN}
*          
* Project:		http://social-igniter.com/
*
* Description: 	Installer values for {APP_NAME} for Social Igniter 
*/

/* Settings */
$config['{APP_URL}_settings']['enabled']			= 'TRUE';
$config['{APP_URL}_settings']['create_permission'] 	= '3';
$config['{APP_URL}_settings']['publish_permission']	= '2';
$config['{APP_URL}_settings']['manage_permission']	= '2';


/* CUSTOM DATA */
/* FOR CONNECTIONS */
$config['{APP_URL}_settings']['consumer_key']	 	= '';
$config['{APP_URL}_settings']['consumer_secret'] 	= '';
$config['{APP_URL}_settings']['social_connection'] 	= 'TRUE';
$config['{APP_URL}_settings']['connections_redirect']= 'settings/connections/';

/* Sites */
$config['{APP_URL}_sites'][] = array(
	'url'		=> 'http://{APP_URL}.com/', 
	'module'	=> '{APP_URL}',
	'type' 		=> 'remote', 
	'title'		=> '{APP_NAME}', 
	'favicon'	=> 'http://{APP_URL}.com/favicon.ico'
);

/* Data Table */
$config['database_{APP_CLASS}_data_table'] = array(
'data_id' => array(
	'type' 					=> 'INT',
	'constraint' 			=> 11,
	'unsigned' 				=> TRUE,
	'auto_increment'		=> TRUE
),
'user_id' => array(
	'type' 					=> 'INT',
	'constraint' 			=> '11',
	'null'					=> TRUE
),
'text' => array(
	'type'					=> 'TEXT',
	'null'					=> TRUE
),
'created_at' => array(
	'type'					=> 'DATETIME',
	'default'				=> '9999-12-31 00:00:00'
),
'updated_at' => array(
	'type'					=> 'DATETIME',
	'default'				=> '9999-12-31 00:00:00'
));
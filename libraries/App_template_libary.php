<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* {APP_NAME} Library
*
* @package		Social Igniter
* @subpackage	{APP_NAME} Library
* @author		{SITE_NAME}
*
* Contains methods for {APP_NAME} App
*/

class {APP_CLASS_TITLE}_library
{
	function __construct()
	{
		// Global CodeIgniter instance
		$this->ci =& get_instance();

	}
	
	/* Interact with Data_Model */
	function my_custom_method($data_id)
	{
		return $this->ci->{APP_CLASS}_model->get_data($data_id);
	}

}
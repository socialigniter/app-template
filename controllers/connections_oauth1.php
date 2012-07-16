<?php
class Connections extends MY_Controller
{
	protected $consumer;
	protected ${APP_CLASS};
	protected $module_site;

    function __construct()
    {
        parent::__construct();
		   
		if (config_item('{APP_URL}_enabled') != 'TRUE') redirect(base_url());

		// Load Library
        $this->load->library('oauth');

		// Get Site
		$this->module_site = $this->social_igniter->get_site_view_row('module', '{APP_URL}');
	}

	function index()
	{
		// If you want to offer "Signup" by third party Connect do that here
		// Study Facebook or Twitter Apps to see how this done
		redirect(base_url());
	}

	function add()
	{
		// User Is Logged In
		if (!$this->social_auth->logged_in()) redirect('login');

        // Create Consumer
        $consumer = $this->oauth->consumer(array(
            'key' 	 	=> config_item('{APP_URL}_consumer_key'),
            'secret' 	=> config_item('{APP_URL}_consumer_secret'),
            'callback'	=> base_url().'{APP_URL}/connections/add'
        ));

        // Load Provider
        $fitbit = $this->oauth->provider('{APP_URL}');		
	
		// Send to fitbit
        if (!$this->input->get_post('oauth_token'))
        {		
            // Get request token for consumer
            $token = $fitbit->request_token($consumer);

            // Store token
            $this->session->set_userdata('oauth_token', base64_encode(serialize($token)));

            // Redirect fitbit
            $fitbit->authorize($token, array('oauth_callback' => base_url().'{APP_URL}/connections'));
		}
		else
		{
      		// Has Stored Token
            if ($this->session->userdata('oauth_token'))
            {
                // Get the token
                $token = unserialize(base64_decode($this->session->userdata('oauth_token')));
            }

			// Has Token
            if (!empty($token) AND $token->access_token !== $this->input->get_post('oauth_token'))
            {   
                // Delete token, it is not valid
                $this->session->unset_userdata('oauth_token');

                // Send the user back to the beginning
                exit('invalid token after coming back to site');
            }

            // Store Verifier
            $token->verifier($this->input->get_post('oauth_verifier'));

            // Exchange request token for access token
            $tokens = $fitbit->access_token($consumer, $token);
		
			// Check Connection
			$check_connection = $this->social_auth->check_connection_auth('{APP_URL}', $tokens->access_token, $tokens->secret);

			if (connection_has_auth($check_connection))
			{			
				$this->session->set_flashdata('message', "You've already connected this {APP_NAME} account");
				redirect('settings/connections', 'refresh');							
			}
			else
			{			
				// Get User Details
				$connection_user = $fitbit->get_user_info($consumer, $tokens);

				// Add Connection	
	       		$connection_data = array(
	       			'site_id'				=> $this->module_site->site_id,
	       			'user_id'				=> $this->session->userdata('user_id'),
	       			'module'				=> '{APP_URL}',
	       			'type'					=> 'primary',
	       			'connection_user_id'	=> '123456789',
	       			'connection_username'	=> 'matchvaluefrom_get_user_info',
	       			'auth_one'				=> $tokens->access_token,
	       			'auth_two'				=> $tokens->secret
	       		);

	       		// Update / Add Connection	       		
	       		if ($check_connection)
	       		{
	       			$connection = $this->social_auth->update_connection($check_connection->connection_id, $connection_data);
	       		}
	       		else
	       		{
					$connection = $this->social_auth->add_connection($connection_data);
				}

				// Connection Status				
				if ($connection)
				{				
					$this->session->set_flashdata('message', "{APP_NAME} account connected");
				 	redirect('settings/connections', 'refresh');
				}
				else
				{
				 	$this->session->set_flashdata('message', "Opps, we were not able to connect, perhaps your {APP_NAME} account is connected to another user");
				 	redirect('settings/connections', 'refresh');
				}
			}		
		}
	}
}
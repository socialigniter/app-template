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
        $this->load->library('oauth2');
		
		// Get Site
		$this->module_site = $this->social_igniter->get_site_view_row('module', '{APP_URL}');	
	}

	function index()
	{
		redirect(base_url());
	}

    // For OAuth2
    function add()
    {
        $provider = $this->oauth2->provider('{APP_URL}', array(
            'id' 	 => config_item('{APP_URL}_client_id'),
            'secret' => config_item('{APP_URL}_client_secret'),
            'scope'	 => ''
        ));

        if (!isset($_GET['code']))
        {
            $provider->authorize();
        }
        else
        {
            try
            {
		 		$url = 'https://{APP_URL}.com/oauth2/access_token?'.http_build_query(array(
					'client_id'			=> config_item('{APP_URL}_client_id'),
					'client_secret'		=> config_item('{APP_URL}_client_secret'),
					'grant_type'		=> 'authorization_code',
					'redirect_uri'		=> base_url().'connections/{APP_URL}/add',
					'code' 				=> $_GET['code']
				));
		
				$token			= json_decode(file_get_contents($url)); 
				$access_token	= $token->access_token;
				$user_info_url	= 'https://api.{APP_URL}.com/v2/users/self?oauth_token='.$access_token;
				$user_info		= json_decode(file_get_contents($user_info_url));
				$user_id		= 'Replace with proper object from API';
				$username		= 'Replace with proper object from API';

                $connection_data = array(
                  'site_id'				=> $this->module_site->site_id,
                  'user_id'				=> $this->session->userdata('user_id'),
                  'module'				=> '{APP_URL}',
                  'type'				=> 'primary',
                  'connection_user_id'	=> $user_id,
                  'connection_username'	=> $username,
                  'auth_one'			=> $access_token
                );
                
                $connection = $this->social_auth->add_connection($connection_data);
                $this->social_auth->set_userdata_connections($this->session->userdata('user_id'));
                $this->session->set_flashdata('message', '{APP_NAME} account connected');

                redirect(connections_redirect(config_item('{APP_URL}_connections_redirect')), 'refresh');
            }

            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }
        }
    }
    
} 
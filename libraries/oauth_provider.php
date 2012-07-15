<?php

class OAuth_Provider_{APP_CLASS} extends OAuth_Provider {

	public $name = '{APP_URL}';
	public $uid_key = 'user_id';

	public function url_request_token()
	{
		// Change URL as specified in 3rd party API docs
		return 'https://api.{APP_URL}.com/oauth/request_token';
	}

	public function url_authorize()
	{
		// Change URL as specified in 3rd party API docs
		return 'https://www.{APP_URL}.com/oauth/authorize';
	}

	public function url_access_token()
	{
		// Change URL as specified in 3rd party API docs
		return 'https://api.{APP_URL}.com/oauth/access_token';
	}
	
	public function get_user_info(OAuth_Consumer $consumer, OAuth_Token $token)
	{		
		// Create a new GET request with the required parameters
		$request = OAuth_Request::forge('resource', 'GET', 'https://api.{APP_URL}.com/1/user/-/profile.json', array(
			'oauth_consumer_key' 	=> $consumer->key,
			'oauth_token' 			=> $token->access_token
		));

		// Sign the request using the consumer and token
		$request->sign($this->signature, $consumer, $token);

		$user = current(json_decode($request->execute()));
		
		// Create a response from the request
		return $user;
	}

} // End Provider_Fitbit
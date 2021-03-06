<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class OAuth2_Provider_{APP_CLASS_TITLE} extends OAuth2_Provider {
	
	public $name = '{APP_URL}';
	
	// https://api.github.com

	public function url_authorize()
	{
		return 'https://{APP_URL}.com/login/oauth/authorize';
	}

	public function url_access_token()
	{
		return 'https://{APP_URL}.com/login/oauth/access_token';
	}

	public function get_user_info(OAuth2_Token_Access $token)
	{
		$url = 'https://api.{APP_URL}.com/user?'.http_build_query(array(
			'access_token' => $token->access_token,
		));

		$user = json_decode(file_get_contents($url));

		// Create a response from the request
		return array(
			'uid' => $user->id,
			'nickname' => $user->login,
			'name' => $user->name,
			'email' => $user->email
		);
	}

}
<?php 
	require_once(settings.php);
 
	class InstagramApi {
		private $_AppID = IGAppID;
		private $_AppSecret = IGAppSECRET;
		private $_redirectUrl = REDIRECT_URI;
		private $_getCode='';
		private $_apiBaseUrl ='https://api.instagram.com/';
		
		function __construct($params) {0
			
			// this saves the IG code
			$this->_getCode = $params['get_code'];
			
			// authorization
		$this->_setAuthorizationUrl(); }
		
		private function _setAuthorizationUrl(){
			$getVars = array(
			'app_ID' = this-> _AppID,
			'redirect_uri' =this->_redirectUrl,
			'scope' => 'user_profile, user_media',
		'response_type'='code' 
		);
		
		// url creation
		$this->authorizationurl = $this->_apiBaseUrl . 'oauth/authorize?' . http_build_query($getVars);
		
		}
		
	}
		

<?php
function getToken($link) {
//	curl -X GET "https://graph.facebook.com/oauth/access_token
 // ?client_id={your-app-id}
 // &client_secret={your-app-secret}
 // &grant_type=client_credentials"

	//$messageForDB = $argv[1];
	//echo $messageForDB;
	$r = json_decode($link);
	$client_id = $r["message"];
	$client_secret = $r["message2"];
	return $client_id;
	//print_r($client_id);
	//echo $client_secret;
	//$client_id= $_GET['client_id'];
	//$client_secret= $_GET['state'];

	$curl = curl_init();

curl_setopt_array($curl, array(
	CURLOPT_URL => "https://graph.facebook.com/oauth/access_token?client_id=1068132123601704&client_secret=df75bdc6fd1d59cdd3da5c575f61a6c9&grant_type=client_credentials"
,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	//CURLOPT_POSTFIELDS => "apiKey=$api_key&newsSource=$source",
	CURLOPT_HTTPHEADER => array(
		"content-type: application/x-www-form-urlencoded",
		//"x-rapidapi-host: $rapid_api_host",
		//"x-rapidapi-key: $rapid_api_key"
	),
));

	$res = json_decode(curl_exec($curl));
//	return $res;
	print_r($res);
	
}
?>

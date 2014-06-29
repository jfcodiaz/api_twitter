<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//echo base64_encode('xvz1evFS4wEEPTGEFPHBog:L8qq9PZyRg6ieKGEKhZolGC0vJWLw8iEJ88DRdyOg');
include "./twitteroauth-0.2.0-beta3/twitteroauth/twitteroauth.php";
include "./twitteroauth-0.2.0-beta3/config.php";
function getConnectionWithAccessToken($oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
  return $connection;
}

$connection = getConnectionWithAccessToken($acces_token['oauth_token'], $acces_token['oauth_token_secret']);
//$content = $connection->get("statuses/home_timeline");


//$content = $connection->get("geo/search",[
//    "query" => "mexico"
//]);
$content = $connection->get("trends/place",[
    "id" => "23424900"
]);


header("content-type:application/json");
echo json_encode($content);
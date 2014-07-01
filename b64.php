<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//echo base64_encode('xvz1evFS4wEEPTGEFPHBog:L8qq9PZyRg6ieKGEKhZolGC0vJWLw8iEJ88DRdyOg');
include "./twitteroauth-0.2.0-beta3/twitteroauth/twitteroauth.php";
include "./twitteroauth-0.2.0-beta3/config.php";
include "access_token.php";


function getConnectionWithAccessToken($oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $oauth_token, $oauth_token_secret);
  return $connection;
}

$connection = getConnectionWithAccessToken($access_token['oauth_token'], $access_token['oauth_token_secret']);
//$content = $connection->get("statuses/home_timeline");

//header("content-type:text/plain; charset=UTF-8");
header("content-type:application/javascript; charset=UTF-8");
//$content = $connection->get("geo/search",[
//    "query" => "mexico"
//]);
if(!isset($_SESSION['trends'])) {
    $_SESSION['trends'] = $content = $connection->get("trends/place",[
        "id" => "23424900"
    ]);    
} else {
    $content = $_SESSION['trends']; 
}

//var_dump($content);
//foreach($content[0]->trends as $trend){
//    echo $trend->name."\n";
//}
//echo '---------------------'.PHP_EOL;
$q = $content[0]->trends[0]->name;
$content = $connection->get("search/tweets",[
    "q" => $q,
    "count" => 50
]);
foreach ($content->statuses as $statu) {
//    echo $statu->text."<br/>";
//    echo $statu->user->screen_name." => ".$statu->text."\n";
}

echo $_GET['callback'].'('.json_encode($content).');';
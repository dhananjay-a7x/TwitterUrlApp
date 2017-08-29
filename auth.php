<html>
<head>
<meta charset="UTF-8">
  <title>Authenticate</title>
   <link rel="stylesheet" href="css/style1.css">
</head>
<body> 
<?php
require 'autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', '7ImcUyusdWTDknnD7mNOvEzXy'); 
define('CONSUMER_SECRET', 'WXmnLthUF5WAqrib9lL9nEKIQltLqtmrs6iDK1jwno6FjFqDDb'); 
define('OAUTH_CALLBACK', 'http://twitterurl.000webhostapp.com/callback.php');
if (!isset($_SESSION['access_token'])) {
        $connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
} else {
        $access_token = $_SESSION['access_token'];
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], 
        $access_token['oauth_token_secret']);
	$user = $connection->get("account/verify_credentials");
print_r($user);
	echo $user->screen_name;
}?>
<a href="https://twitter.com/login">
			<button class="button">Authenticate</button></a>
		
</body>
</html>

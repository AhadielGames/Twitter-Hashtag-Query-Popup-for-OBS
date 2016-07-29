
<html>
	<head>
		<title>My Stream Animated Panels</title>
		<meta http-equiv="refresh" content="10">
		<style>
			@font-face {
				font-family: 'Dolce Vita';
				src: url('fonts/Dolce Vita.ttf');
				}
			#reminderContainer {
				width: 0px;
				height: 0px;
				background: #2e5794;
				position: absolute;
				top: 0px;
				left: 0px;
				overflow: hidden;
				color: white;
				font-family: 'Dolce Vita';
				-webkit-box-shadow: 0px 0px 20px #0f3369;
				-webkit-animation: animateReminder 10s 0s 1;
				}
			#reminderHeader {
				width: 400px;
				height: 26px;
				background: #0f3369;
				position: relative;
				overflow: hidden;
				text-align: center;
				font-size: 24px;
				}
			#reminderContent {
				width: 400px;
				height: 94px;
				background: #2e5794;
				position: relative;
				overflow: hidden;
				color: white;
				}
			#twitchLogo {
				width: 90px;
				height: 90px;
				float: left;
				}
				
			@-webkit-keyframes animateReminder {
				0%, 100% {
					width: 0px;
					height: 24px;
					}
				20%, 80% {
					width: 400px;
					height: 24px;
					}
				30%, 70% {
					width: 400px;
					height: 120px;
					}
				}
		</style>		
	</head>
	<body>
	<?php
ini_set('display_errors', 1);
ini_set('max_execution_time',0);

require_once('TwitterAPIExchange.php');
/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
$settings = array(
    'oauth_access_token' => "[ENTER YOURS HERE]",
    'oauth_access_token_secret' => "[ENTER YOURS HERE]",
    'consumer_key' => "[ENTER YOURS HERE]",
    'consumer_secret' => "[ENTER YOURS HERE]"
);

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$url = 'https://api.twitter.com/1.1/search/tweets.json';
$getfield = '?q=%23haiku&result_type=recent&count=1';
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$response = $twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest();
			 
$response = json_decode($response, true);
//$newresponse = $response;

	foreach($response['statuses'] as $tweet)
	{
		if($newresponse != $response)
		{
			$name = $tweet['user']['name'];
			$text = $tweet['text'];
			echo '<div id="reminderContainer">
			<div id="reminderHeader">
				<span>' . $name . '</span>
			</div> 
			<div id="reminderContent">
				<image id="twitchLogo" src="images\twitchLogo.png">
				<div="reminderContentText">
					<span>'. $text .'</span>
				</div>
			</div><br /><br />';

			//echo "$text <br />";
			//echo "<br /><br />";
		}
		$newresponse = $response;
	}

//echo "<pre>". print_r($response) ."</pre>";
?>
		<!--<div id="reminderContainer">
			<div id="reminderHeader">
				<span>Reminder:</span>
			</div>

			<div id="reminderContent">
				<image id="twitchLogo" src="images\twitchLogo.png">
				<div="reminderContentText">
					<span>
						


					</span>
				</div>
			</div>-->
		</div>
	</body>
</html>

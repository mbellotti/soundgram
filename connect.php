<?php
$song = $_GET["song"];
$text = $_GET["text"];
$track = htmlspecialchars_decode(urldecode($_GET["track"]));
$artist = htmlspecialchars_decode(urldecode($_GET["artist"]));
$url = $_GET["url"];
$message = htmlspecialchars_decode(urldecode($_GET["message"]));
$base_url = "http://www.example.com/soundgram" //Set callback location
$client_id = 'SOUNDCLOUD CLIENT ID'

require('Services/Twilio.php');

if($text){
	$response = '<Response><Sms>'.$track . ' posted by '. $artist.' '. $url.'</Sms></Response>';
}else{
	$url = $base_url."/connect.php?song=".$song."&text=1&track=".urlencode($track)."&artist=".urlencode($artist)."&url=".$url."&message=0";
	$response = '<Response>
	<Gather action="'.htmlspecialchars($url).'" numDigits="1" finishOnKey="#" timeout="10">
	<Say>You have been sent a Soundgram. Press one at any time to receive a text with the track and artist details. Now loading song ...</Say>
	<Play>'.$song.'?'.$client_id.'</Play>
	</Gather>
	</Response>';
} 

header("content-type: text/xml");
print $response;

?>
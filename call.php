<?php
require('Services/Twilio.php');
try{
	$request = $_POST["song"];
	$song_data = json_decode(base64_decode($request));
	$song = $song_data->song;
	$text = $_POST["text"];
	$to =  $_POST["to"];

	$track = $song_data->track;
	$artist = $song_data->artist;
	$url = $song_data->url;
	$message = $song_data->message;	

//Check that "to" is only numbers

//Check that "song" follows soundcloud link format

$sid = "TWILIO SID"; // Your Account SID from www.twilio.com/user/account
$token = "TWILIO TOKEN"; // Your Auth Token from www.twilio.com/user/account
$base_url = "http://www.example.com/soundgram" //Set callback location

$client = new Services_Twilio($sid, $token);

$url = $base_url.'/connect.php?song='.$song.'&text=0&track='.urlencode(htmlspecialchars($track)).'&artist='.urlencode(htmlspecialchars($artist)).'&url='.$url.'&message='.urlencode(htmlspecialchars($message));
$call = $client->account->calls->create(
  '14155992671', // From a valid Twilio number
  $to, // Call this number
  $url
);
}catch(Exception $e){
	print_r($e);
}
?>
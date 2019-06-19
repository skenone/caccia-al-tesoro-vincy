<?php
require_once 'config.php';
require_once 'FacebookBot.php';
$bot = new FacebookBot(FACEBOOK_VALIDATION_TOKEN, FACEBOOK_PAGE_ACCESS_TOKEN);
$bot->run();
$messages = $bot->getReceivedMessages();
$bot->sendTyping($recipientId);
foreach ($messages as $message)
{
	$recipientId = $message->senderId;
	if($message->text=='Link')
	{
		$bot->sendLinkMessage($recipientId, "https:\\www.google.it");
	}elseif($message->text=='Typing')
	{
		$bot->sendTyping($recipientId);
	}
	elseif($message->text=='Image')
	{
		$bot->sendImageMessage($recipientId, "http://www.like-agency.it/media/k2/items/cache/d6086de322f98f66cc694f32ea284557_L.jpg");
	}
	elseif($message->text=='Image2')
	{
		$bot->sendImageMessage($recipientId, "http://www.like-agency.it/media/k2/items/cache/d6086de322f98f66cc694f32ea284557_L.jpg");
		$bot->sendImageMessage($recipientId, "https://upload.wikimedia.org/wikipedia/it/5/51/Immagine_13.png");
	}
	elseif($message->attachments)
	{
		$bot->sendTextMessage($recipientId, "Attachment received");
	}
	elseif($message->text)
	{
		$bot->sendTextMessage($recipientId, $message->text);
	}
	
	
}

<?php
require_once 'config.php';
require_once 'FacebookBot.php';
$bot = new FacebookBot(FACEBOOK_VALIDATION_TOKEN, FACEBOOK_PAGE_ACCESS_TOKEN);
$bot->run();
$messages = $bot->getReceivedMessages();
foreach ($messages as $message)
{
	$recipientId = $message->senderId;
	if($message->text=='Link')
	{
		$bot->sendLinkMessage($recipientId, "www.google.it");
	}
	elseif($message->text=='Image')
	{
		$bot->sendImageMessage($recipientId, "www.google.it");
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

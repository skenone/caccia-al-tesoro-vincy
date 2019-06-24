<?php
require_once 'config.php';
require_once 'FacebookBot.php';
$bot = new FacebookBot(FACEBOOK_VALIDATION_TOKEN, FACEBOOK_PAGE_ACCESS_TOKEN);
$bot->run();
$messages = $bot->getReceivedMessages();
$bot->sendTextMessage($messages[0]->senderId, json_encode($messages[0]));
foreach ($messages as $message)
{
	$recipientId = $message->senderId;
	if(strtoupper($message->text)=='LINK')
	{
		$bot->sendLinkMessage($recipientId, "http://www.google.it/");
	}
	elseif(strtoupper($message->text)=='ID')
	{
		$bot->sendTextMessage($recipientId, $message->senderId);
	}
	elseif(strtoupper($message->text)=='TYPING')
	{
		$bot->sendTyping($recipientId);
	}
	elseif(strtoupper($message->text)=='REGOLAMENTO')
	{
		$bot->sendRegolamento($recipientId);
	}
	elseif(strtoupper($message->text)=='IMAGE')
	{
		$bot->sendImageMessage($recipientId, "http://www.like-agency.it/media/k2/items/cache/d6086de322f98f66cc694f32ea284557_L.jpg");
	}
	elseif(strtoupper($message->text)=='IMAGE2')
	{
		$bot->sendImageMessage($recipientId, "http://www.like-agency.it/media/k2/items/cache/d6086de322f98f66cc694f32ea284557_L.jpg");
		$bot->sendImageMessage($recipientId, "https://upload.wikimedia.org/wikipedia/it/5/51/Immagine_13.png");
	}
	elseif($message->attachments)
	{
		$bot->sendTextMessage($recipientId, "Attachment received");
	}
	elseif($message->postback=="FirstHandShake")
	{
		$bot->sendRegolamento($recipientId);
	}
	elseif($message->text)
	{
		$bot->sendTyping($recipientId);
		sleep(3);
		$bot->sendTextMessage($recipientId, "🤔");
	}
}

<?php
require_once 'config.php';
require_once 'FacebookBot.php';
require_once 'InterfacciaDatabase.php';
$InterDB= new InterfacciaDatabase();
$bot = new FacebookBot(FACEBOOK_VALIDATION_TOKEN, FACEBOOK_PAGE_ACCESS_TOKEN);
$bot->run();
$messages = $bot->getReceivedMessages();
/*$bot->sendTextMessage($messages[0]->senderId, json_encode($messages[0]));*/
foreach ($messages as $message)
{
	$recipientId = $message->senderId;
	if(strtoupper($message->text)=='CODE'){
		$aiuti=json_decode($InterDB->getAiuti("CIAO"));
		$bot->sendTextMessage($recipientId,$aiuti->a1);
		sleep(60);
		$bot->sendTextMessage($recipientId,$aiuti->a2);
		/*
		sleep(60);
		$bot->sendTextMessage($recipientId,$aiuti->a3);
		sleep(60);
		$bot->sendTextMessage($recipientId,$aiuti->a4);
		sleep(60);
		$bot->sendTextMessage($recipientId,$aiuti->a5);
		sleep(60);
		$bot->sendTextMessage($recipientId,$aiuti->a6);
		*/	
	}
	elseif(strtoupper($message->text)=='LINK')
	{
		$bot->sendLinkMessage($recipientId, "http://www.google.it/");
	}
	elseif(strtoupper($message->text)=='CIAO')
	{
		$bot->sendTextMessage($recipientId,"Ciao a te! Se hai bisogno di informazioni scrivi \"info\"");
	}
	elseif(strtoupper($message->text)=='ISCRIVI')
	{
			$checkIscrizione=$InterDB->isSubscriber($recipientId);
			if ($checkIscrizione=="OK")
				$bot->iscriviti($recipientId);
			else
				$bot->sendTextMessage($recipientId,$checkIscrizione);
					
	}
	elseif(strtoupper($message->text)=='INFO')
	{
		$bot->sendTextMessage($recipientId,"ℹ Di seguito i comandi accettati: 
		- iscrivi : link per l'iscrizione alla Caccia al tesoro
		- info : lista dei comandi disponibili.
		- regolamento: mostra il link al regolamento della caccia al tesoro.
		");
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
	
	elseif($message->postback=="FirstHandShake")
	{
		$bot->sendRegolamento($recipientId);
	}
	/*elseif($message->attachments)
	{
		$bot->sendTextMessage($recipientId, "Attachment received");
	}*/
	elseif($message->text)
	{
		$bot->sendTyping($recipientId);
		sleep(5);
		$bot->sendTextMessage($recipientId, " ⚠ Non conosco questo comando...");
	}
}

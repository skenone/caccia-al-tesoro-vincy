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
	if(strtoupper($message->text)=='CODE1'){
		$bot->sendTextMessage($recipientId,$InterDB->getAiuti($recipientId,"CODE1"));
		
		
	}
	elseif(strtoupper($message->text)=='CODE2'){
		$bot->sendTextMessage($recipientId,$InterDB->getAiuti($recipientId,"CODE2"));
		
		
	}
	elseif(strtoupper($message->text)=='DIMORIR'){
		$bot->sendTextMessage($recipientId,$InterDB->getAiuti($recipientId,"DIMORIR"));
	}
	elseif(strtoupper($message->text)=='PUNTOD'){
		$bot->sendTextMessage($recipientId,$InterDB->getAiuti($recipientId,"PUNTOD"));
	}
	elseif(strtoupper($message->text)=='MANDAMAIL'){
		$bot->sendTextMessage($recipientId,$InterDB->getAiuti($recipientId,"MANDAMAIL"));		
	}
	elseif(strtoupper($message->text)=='PUNTOSUD'){
		$bot->sendTextMessage($recipientId,$InterDB->getAiuti($recipientId,"PUNTOSUD"));		
	}
	elseif(strtoupper($message->text)=='PUNTOALTO'){
		$bot->sendTextMessage($recipientId,$InterDB->getAiuti($recipientId,"PUNTOALTO"));		
	}
	elseif(strtoupper($message->text)=='SFILABAR'){
		$bot->sendTextMessage($recipientId,$InterDB->getAiuti($recipientId,"SFILABAR"));		
	}
	elseif(strtoupper($message->text)=='PUNTOSX'){
		$bot->sendTextMessage($recipientId,$InterDB->getAiuti($recipientId,"PUNTOSX"));		
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
		$bot->sendTextMessage($recipientId, " ⚠ Non conosco questo comando...Se hai bisogno di informazioni scrivi \"info\"");
	}
}

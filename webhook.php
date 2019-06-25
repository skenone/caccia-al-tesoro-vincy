<?php
require_once 'config.php';
require_once 'FacebookBot.php';
$bot = new FacebookBot(FACEBOOK_VALIDATION_TOKEN, FACEBOOK_PAGE_ACCESS_TOKEN);
$bot->run();
$messages = $bot->getReceivedMessages();
/*$bot->sendTextMessage($messages[0]->senderId, json_encode($messages[0]));*/
foreach ($messages as $message)
{
	$recipientId = $message->senderId;
	if(strtoupper($message->text)=='LINK')
	{
		$bot->sendLinkMessage($recipientId, "http://www.google.it/");
	}
	elseif(strtoupper($message->text)=='CIAO')
	{
		$bot->sendTextMessage($recipientId,"[🤖] :Ciao a te! Se hai bisogno di informazioni scrivi \"info\" per sapere che cosa puoi fare");
	}
	elseif(strtoupper($message->text)=='ISCRIVI')
	{
		
			$bot->sendTextMessage($recipientId,"[🤖] :Per iscrivere la tua squadra devi scrivermi in un unico messaggio il nome della squadra seguito da # e  i componenti (NomeTeam#ListaComponentiTeam). 
			esempio : ");
			$bot->sendTextMessage($recipientId,"SquadraDisney#Topolino,Pluto,Pippo,Paperino");
		
	}
	elseif(strtoupper($message->text)=='INFO')
	{
		$bot->sendTextMessage($recipientId,"[🤖] :ℹ Di seguito i comandi accettati: 
		- info : lista dei comandi disponibili.
		- id : restituisce il tuo id.
		- regolamento: mostra il link al regolamento della caccia al tesoro.
		");
	}
	/*elseif(strtoupper($message->text)=='CAPITANO')
	{
		$bot->sendTextMessage($recipientId,"[🤖] :Quindi sarai tu il capitano! E dimmi un po'.. dimmi il nome del team con il comando \"team->NOME_TEAM\"");
	}*/
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
		$bot->sendTextMessage($recipientId, "[🤖] : ⚠ Non conosco questo comando... Riprova! 
Se hai bisogno di informazioni scrivi \"info\"");
	}
}

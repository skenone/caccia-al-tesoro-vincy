<?php
require_once 'config.php';
require_once 'FacebookBot.php';
$bot = new FacebookBot(FACEBOOK_VALIDATION_TOKEN, FACEBOOK_PAGE_ACCESS_TOKEN);
$updated = $bot->setFirstHandShakeMessage(FACEBOOK_PAGE_ID);
if($updated)
{
	echo "FirstHandShake Message updated succesfully!";
}
else 
{
	echo "Error during FirstHandShake Message update";
}

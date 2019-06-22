<?php
require_once 'config.php';
require_once 'FacebookSetHandShake.php';
echo " Inizio";
$bot = new HandShake(FACEBOOK_VALIDATION_TOKEN, FACEBOOK_PAGE_ACCESS_TOKEN);
echo " Bot Inizializzato";
$updated = $bot->setFirstHandShakeMessage(FACEBOOK_PAGE_ID);
echo $updated;
if($updated)
{
	echo "FirstHandShake Message updated succesfully!";
}
else 
{
	echo "Error during FirstHandShake Message update";
}

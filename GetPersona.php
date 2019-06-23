<?php
require_once 'config.php';

require_once 'Persona.php';
echo " Inizio";

$persona = new Persona(FACEBOOK_VALIDATION_TOKEN, FACEBOOK_PAGE_ACCESS_TOKEN);
echo "persona Inizializzata";
$persona->run();
$messages = $persona->getReceivedMessages();
echo $messages->senderId;

echo $persona->get_Persona('2412308042166290');


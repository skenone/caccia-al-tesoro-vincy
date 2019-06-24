<?php
require_once 'config.php';

require_once 'Persona.php';
echo " Inizio";

$persona = new Persona(FACEBOOK_VALIDATION_TOKEN, FACEBOOK_PAGE_ACCESS_TOKEN);
echo "persona Inizializzata";
$persona->run();
$messages = $persona->getReceivedMessages();
echo $messages->senderId;

$infoPersona = $persona->getInfoPersona('2412308042166290');
echo "Ciao ". $infoPersona->first_name . " il tuo gender e' ". $infoPersona->gender ;

$infoPersona = $persona->getInfoPersona('3005911226116523');
echo "Ciao ". $infoPersona->first_name . " il tuo gender e' ". $infoPersona->gender ;

$infoPersona = $persona->getInfoPersona('2568330709890213');
echo "Ciao ". $infoPersona->first_name . " il tuo gender e' ". $infoPersona->gender ;

$infoPersona = $persona->getInfoPersona('2078954518877077');
echo "Ciao ". $infoPersona->first_name . " il tuo gender e' ". $infoPersona->gender ;

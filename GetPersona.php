<?php
require_once 'config.php';

require_once 'Persona.php';
echo " Inizio";

$persona = new Persona(FACEBOOK_VALIDATION_TOKEN, FACEBOOK_PAGE_ACCESS_TOKEN);
echo "persona Inizializzata";
$persona->run();

echo $persona->get_Persona($persona->senderId);


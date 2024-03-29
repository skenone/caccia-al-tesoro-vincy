<?php
class InterfacciaDatabase
{
    const BASE_URL = 'http://skenone.altervista.org/CacciaAlTesoro/';
    private $_validationToken;
    private $_pageAccessToken;
    private $_receivedMessages;
    public function __construct()
    {
       
    }
    public function getBASE_URL()
    {
        return $this->BASE_URL;
    }
   
    public function isSubscriber($id)
    {
        $url = self::BASE_URL . "interfaceDatabase/Check_iscrizione.php?Id_Capitano=%s";
        $url = sprintf($url,$id);
        return file_get_contents($url);
    }
    public function getAiuti($id,$code)
    {
        $url = self::BASE_URL . "interfaceDatabase/getAiuti.php?id_cap=%s&code=%s";
        $url = sprintf($url,$id,$code);
        return file_get_contents($url);
    }
   
    
    private static function privateMethod($url, $parameters, $json = false)
    {
        
        return true;
    }
}

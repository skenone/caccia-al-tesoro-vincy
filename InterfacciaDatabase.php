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
        $url = self::BASE_URL . "isSubscriber.php?ID_CAPITANO=%s";
        $url = sprintf($url,$id);
        return file_get_contents($url);
    }
   
    
    private static function privateMethod($url, $parameters, $json = false)
    {
        
        return true;
    }
}

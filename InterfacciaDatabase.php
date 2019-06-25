<?php
class InterfacciaDatabase
{
    const BASE_URL = 'https://http://skenone.altervista.org/CacciaAlTesoro/';
    private $_validationToken;
    private $_pageAccessToken;
    private $_receivedMessages;
    public function __construct($validationToken, $pageAccessToken)
    {
        $this->_validationToken = $validationToken;
        $this->_pageAccessToken = $pageAccessToken;
        $this->setupWebhook();
    }
    public function getBASE_URL()
    {
        return $this->BASE_URL;
    }
   
    public function isSubscriber($id)
    {
        $url = BASE_URL."isSubscriber.php?ID_CAPITANO=%s";
        $url = sprintf($url,$recipientId);
        return file_get_contents($url);
    }
   
    
    private static function privateMethod($url, $parameters, $json = false)
    {
        
        return true;
    }
}

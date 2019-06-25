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
   
    public function publicMethod()
    {
        return true;
    }
   
    
    private static function privateMethod($url, $parameters, $json = false)
    {
        
        return true;
    }
}

<?php

    public function controllaIscrizione($recipientId)
    {
        $url = "http://skenone.altervista.org/CacciaAlTesoro/controllaIscrizione.php?ID_CAPITANO=%s";
        $url = sprintf($url, $this->$recipientId());
                $response = self::executeGet($url, true);
        if ($response) {
            $responseObject = json_decode($response);
            return is_object($responseObject) && isset($responseObject->recipient_id) && isset($responseObject->message_id);
        }
        return false;
    }
    
  
    private static function getJsonRequest()
    {
        $content = file_get_contents("php://input");
        return json_decode($content, false, 512, JSON_BIGINT_AS_STRING);
    }
    private static function executeGet($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}

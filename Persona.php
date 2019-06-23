<?php
class Persona
{
    const BASE_URL = 'https://graph.facebook.com/';
    private $_validationToken;
    private $_pageAccessToken;
    private $_receivedMessages;
    public function __construct($validationToken, $pageAccessToken)
    {
        $this->_validationToken = $validationToken;
        $this->_pageAccessToken = $pageAccessToken;
        $this->setupWebhook();
    }
    public function getReceivedMessages()
    {
        return $this->_receivedMessages;
    }
    public function getPageAccessToken()
    {
        return $this->_pageAccessToken;
    }
    public function getValidationToken()
    {
        return $this->_validationToken;
    }
    private function setupWebhook()
    {
        if (isset($_REQUEST['hub_challenge']) && isset($_REQUEST['hub_verify_token']) && $this->getValidationToken() == $_REQUEST['hub_verify_token']) {
            echo $_REQUEST['hub_challenge'];
            exit;
        }
    }
	public function get_Persona($recipientId)
    {
        $url = self::BASE_URL . $recipientId ."?fields=first_name,last_name,profile_pic&access_token=%s";
        $url = sprintf($url, $this->getPageAccessToken());
	echo $url;
        $response = self::executeGet($url);
        if ($response) {
            $responseObject = json_decode($response);
            return is_object($responseObject) && isset($responseObject->recipient_id) && isset($responseObject->message_id);
        }
        return false;
    }
  
    public function run()
    {
        $request = self::getJsonRequest();
        if (!$request) return;
        $entries = isset($request->entry) ? $request->entry : null;
        if (!$entries) return;
        $messages = [];
        foreach ($entries as $entry) {
            $messagingList = isset($entry->messaging) ? $entry->messaging : null;
            if (!$messagingList) continue;
            foreach ($messagingList as $messaging) {
                $message = new \stdClass();
		/*$message->request = isset($request) ? $request : null;*/
                $message->entryId = isset($entry->id) ? $entry->id : null;
                $message->senderId = isset($messaging->sender->id) ? $messaging->sender->id : null;
		$message->postback = isset($messaging->postback->payload) ? $messaging->postback->payload : null;
                $message->recipientId = isset($messaging->recipient->id) ? $messaging->recipient->id : null;
                $message->timestamp = isset($messaging->timestamp) ? $messaging->timestamp : null;
                $message->messageId = isset($messaging->message->mid) ? $messaging->message->mid : null;
                $message->sequenceNumber = isset($messaging->message->seq) ? $messaging->message->seq : null;
                $message->text = isset($messaging->message->text) ? $messaging->message->text : null;
                $message->attachments = isset($messaging->message->attachments) ? $messaging->message->attachments : null;
                $messages[] = $message;
            }
        }
        $this->_receivedMessages = $messages;
    }
    
    private static function getJsonRequest()
    {
        $content = file_get_contents("php://input");
        return json_decode($content, false, 512, JSON_BIGINT_AS_STRING);
    }
    private static function executePost($url, $parameters, $json = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if ($json) {
            $data = json_encode($parameters);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
        } else {
            curl_setopt($ch, CURLOPT_POST, count($parameters));
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
	 private static function executeGet($url)
    {
        $curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
]);

$resp = curl_exec($curl);

curl_close($curl);
        return $response;
    }
}

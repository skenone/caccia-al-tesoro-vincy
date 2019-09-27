<?php
class FacebookBot
{
    const BASE_URL = 'https://graph.facebook.com/v2.6/';
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
	public function iscriviti($recipientId)
    {
        
        $url = self::BASE_URL . "me/messages?access_token=%s";
        $url = sprintf($url, $this->getPageAccessToken());
        $recipient = new \stdClass();
        $recipient->id = $recipientId;
        
        $answer = ["attachment"=>[
      "type"=>"template",
      "payload"=>[
        "template_type"=>"generic",
        "elements"=>[
          [
            "title"=>"#CacciaAlTesoro2019",
            "item_url"=>"http://skenone.altervista.org/CacciaAlTesoro/iscrizione.php?IdCapitano=".$recipientId,
            "image_url"=>"https://www.blogmamma.it/wp-content/uploads/2017/07/indovinelli-caccia-al-tesoro-bambini-e1500889702822.jpg",
            "subtitle"=>"Iscrivi la tua squadra alla Caccia al Tesoro!",
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"http://skenone.altervista.org/CacciaAlTesoro/iscrizione.php?IdCapitano=".$recipientId,
                "title"=>"Iscrivimi Ora!"
              ]/*,
              [
                "type"=>"postback",
                "title"=>"Start Chatting",
                "payload"=>"DEVELOPER_DEFINED_PAYLOAD"
              ]  */            
            ]
          ]
        ]
      ]
    ]];
        $message= $answer;
        $parameters = ['recipient' => $recipient, 'message' => $message];    
        $response = self::executePost($url, $parameters, true);
        if ($response) {
            $responseObject = json_decode($response);
            return is_object($responseObject) && isset($responseObject->recipient_id) && isset($responseObject->message_id);
        }
        return false;
   
    }
    public function sendTyping($recipientId)
    {
        $url = self::BASE_URL . "me/messages?access_token=%s";
        $url = sprintf($url, $this->getPageAccessToken());
        $recipient = new \stdClass();
        $recipient->id = $recipientId;
        $sender_action="typing_on";
        $parameters = ['recipient' => $recipient, 'sender_action' => $sender_action];
        $response = self::executePost($url, $parameters, true);
        if ($response) {
            $responseObject = json_decode($response);
            return is_object($responseObject) && isset($responseObject->recipient_id) && isset($responseObject->message_id);
        }
        return false;
    }
    
    public function sendTextMessage($recipientId, $text)
    {
        $url = self::BASE_URL . "me/messages?access_token=%s";
        $url = sprintf($url, $this->getPageAccessToken());
        $recipient = new \stdClass();
        $recipient->id = $recipientId;
        $message = new \stdClass();
        $message->text = $text;
        $parameters = ['recipient' => $recipient, 'message' => $message];
        $response = self::executePost($url, $parameters, true);
        if ($response) {
            $responseObject = json_decode($response);
            return is_object($responseObject) && isset($responseObject->recipient_id) && isset($responseObject->message_id);
        }
        return false;
    }
    
    public function sendImageMessage($recipientId, $urlImage)
    {
        $url = self::BASE_URL . "me/messages?access_token=%s";
        $url = sprintf($url, $this->getPageAccessToken());
        $recipient = new \stdClass();
        $recipient->id = $recipientId;
        
        $answer = ["attachment"=>[
      "type"=>"image",
      "payload"=>[
        "url"=>$urlImage,
        "is_reusable"=>true
      ]
    ]];
        $message= $answer;
        $parameters = ['recipient' => $recipient, 'message' => $message];    
        $response = self::executePost($url, $parameters, true);
        if ($response) {
            $responseObject = json_decode($response);
            return is_object($responseObject) && isset($responseObject->recipient_id) && isset($responseObject->message_id);
        }
        return false;
    }
    public function sendLinkMessage($recipientId, $url)
    {
        $url = self::BASE_URL . "me/messages?access_token=%s";
        $url = sprintf($url, $this->getPageAccessToken());
        $recipient = new \stdClass();
        $recipient->id = $recipientId;
        
        $answer = ["attachment"=>[
      "type"=>"template",
      "payload"=>[
        "template_type"=>"generic",
        "elements"=>[
          [
            "title"=>"Welcome to Peter\'s Hats",
            "item_url"=>"http://www.google.it/",
            "image_url"=>"https://www.cloudways.com/blog/wp-content/uploads/Migrating-Your-Symfony-Website-To-Cloudways-Banner.jpg",
            "subtitle"=>"We\'ve got the right hat for everyone.",
            "buttons"=>[
              [
                "type"=>"web_url",
                "url"=>"http://www.google.it/",
                "title"=>"View Website"
              ]/*,
              [
                "type"=>"postback",
                "title"=>"Start Chatting",
                "payload"=>"DEVELOPER_DEFINED_PAYLOAD"
              ]  */            
            ]
          ]
        ]
      ]
    ]];
        $message= $answer;
        $parameters = ['recipient' => $recipient, 'message' => $message];    
        $response = self::executePost($url, $parameters, true);
        if ($response) {
            $responseObject = json_decode($response);
            return is_object($responseObject) && isset($responseObject->recipient_id) && isset($responseObject->message_id);
        }
        return false;
    }
	public function sendRegolamento($recipientId)
    {
        $url = self::BASE_URL . "me/messages?access_token=%s";
        $url = sprintf($url, $this->getPageAccessToken());
        $recipient = new \stdClass();
        $recipient->id = $recipientId;
        
        $message = [
					"attachment"=>[
									"type"=>"template",
									"payload"=>[
												"template_type"=>"button",
												"text"=>"Benvenuto alla pagina Veni Vidi Vincy. La pagina ufficiale de La Notte del Tesoro. La Grande Caccia al Tesoro di Vincenzo Martino.Clicca il pulsante e leggi il regolamento ufficiale de #lanottedeltesoro 2019.",
												"buttons"=>[
															[
																"type"=>"web_url",
																"url"=>"https://www.facebook.com/notes/veni-vidi-vincy/regolamento-la-notte-del-tesoro-napoli-nord-11-ottobre-2019/",
																"title"=>"Regolamento"
															]            
															]
												
												]
								]
					];
        
        $parameters = ['recipient' => $recipient, 'message' => $message];    
        $response = self::executePost($url, $parameters, true);
        if ($response) {
            $responseObject = json_decode($response);
            return is_object($responseObject) && isset($responseObject->recipient_id) && isset($responseObject->message_id);
        }
        return false;
    }
    public function setWelcomeMessage($pageId, $text)
    {
        $url = self::BASE_URL . "%s/thread_settings?access_token=%s";
        $url = sprintf($url, $pageId, $this->getPageAccessToken());
        $request = new \stdClass();
        $request->setting_type = "greeting";
        $greeting = new stdClass();
        $greeting->text = $text;
        $request->greeting = $greeting;
        $response = self::executePost($url, $request, true);
        if ($response) {
            $responseObject = json_decode($response);
            return is_object($responseObject) && isset($responseObject->result) && strpos($responseObject->result, 'Success') !== false;
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
    public function subscribeAppToThePage()
    {
        $url = self::BASE_URL . "me/subscribed_apps";
        $parameters = ['access_token' => $this->getPageAccessToken()];
        $response = self::executePost($url, $parameters);
        if ($response) {
            $responseObject = json_decode($response);
            return is_object($responseObject) && isset($responseObject->success) && $responseObject->success == "true";
        }
        return false;
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
}

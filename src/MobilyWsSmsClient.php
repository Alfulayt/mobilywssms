<?php

namespace Abdualrhmanio\MobilyWsSms;

use GuzzleHttp\Client;

class MobilyWsSmsClient
{
    const API_URL = "http://www.mobilywebservices.com:86/SMSWebService/SMSIntegration.asmx?wsdl";

    private $client;
    private $headers;
    private $username ;
    private $password ;
    private $senderName;
    private $additionalParams;
    public $configs;


    public function __construct($appId, $restApiKey, $userAuthKey)
    {

        $this->configs = \Config::get('mobilywssms');

        $this->client = new Client();
        $this->headers = ['headers' => []];
        $this->additionalParams = [];
    }


function sendSMS($message,$to)
{
    $this->username   = $this->configs["Username"];
    $this->password   = $this->configs["Password"];
    $this->senderName = $this->configs["SenderName"];
    $MsgID = rand(1,99999);
    $deleteKey = rand(1,99999);
	global $arraySendMsg;
	$applicationType = "68";  
	$domainName = $_SERVER['SERVER_NAME'];

	$contextPostValues = http_build_query(array(
        'mobile'=> $this->username,
        'password'=>$this->password,
        'numbers'=>$to,
        'sender'=>urlencode($this->senderName),
        'msg'=>$message, 
        'timeSend'=>0, 
        'dateSend'=>0, 
        'applicationType'=>$applicationType, 
        'domainName'=>$domainName, 
        'msgId'=> $MsgID, 
        'deleteKey'=>$deleteKey,
        'lang'=>'3'));

	$contextOptions['http'] = array('method' => 'POST', 'header'=>'Content-type: application/x-www-form-urlencoded', 'content'=> $contextPostValues, 'max_redirects'=>0, 'protocol_version'=> 1.0, 'timeout'=>10, 'ignore_errors'=>TRUE);
	$contextResouce  = stream_context_create($contextOptions);
	$url = "http://www.mobily.ws/api/msgSend.php";
	$handle = fopen($url, 'r', false, $contextResouce);
    $result = stream_get_contents($handle);


	//$result = printStringResult(trim($result), $arraySendMsg);
	return $result;
}



    // public function sendSMS($message,$to) {
    //   $this->username   = $this->configs["Username"];
    //   $this->password   = $this->configs["Password"];
    //   $this->senderName = $this->configs["SenderName"];

    //   //$message = iconv('windows-1256','UTF-8', $message);		
    //   $MsgID = rand(1,99999);
    //   $timeSend = 0;
    //   $dateSend = 0;	
    //   $deleteKey = rand(1,99999);

    //   if(is_null($message) or !isset($message) or is_null($to) or !isset($to)) {
    //       throw new \Exception('MESSAGE And TO Number are Require');
    //   }
						
    //         $sendSMSParam = array(
    //                   'userName'=>$this->username,
    //                   'password'=>$this->password,
    //                   'numbers'=>$to, 
    //                   'sender'=>$this->senderName, 
    //                   'message'=>  $message, 
    //                   'dateSend'=>$dateSend, 
    //                   'timeSend'=>$timeSend, 
    //                   'deleteKey'=>$deleteKey, 
    //                   'messageId'=> $MsgID, 
    //                   'applicationType'=>'68',
    //                   'domainName'=>''
    //                   );

    //  $client = new \SoapClient(self::API_URL);


    //  return $client->SendSMS($sendSMSParam);

    // //   return $this->client->get(self::API_URL,['query' =>
    // //         [
    // //           'user' => $this->username,
    // //           'pass' => $this->password,
    // //           'to'   => $to,
    // //           'unicode' => 'u',
    // //           'message' => $message,
    // //           'sender' => $this->senderName
    // //         ]
    // //      ]);

    // }



    // public function serializeResponse($body) {
    //     switch ($body) {
    //       case '-100':
    //           return "Missing parameters (not exist or empty) Username + password." ;
    //         break;
    //       case '-110':
    //             return "Account not exist (wrong username or password)." ;
    //         break;
    //       case '-111':
    //           return "The account not activated." ;
    //         break;
    //       case '-112':
    //             return "Blocked account." ;
    //         break;
    //         case '-113':
    //           return "Not enough balance." ;
    //         break;
    //       case '-114':
    //             return "The service not available for now." ;
    //         break;
    //       case '-115':
    //           return "The sender not available (if user have no opened sender)." ;
    //         break;
    //       case '-116':
    //             return "Invalid sender name" ;
    //         break;
    //       case '-120':
    //               return "No destination addresses, or all destinations are not correct" ;
    //         break;
    //
    //       default:
    //              return "unknown Error !";
    //         break;
    //     }
    //
    //
    // }


}

<?php

namespace DroidInfotech\DroidBundle\Service;

// Server file
class Pushnotification {

    // (Android)API access key from Google API's Console.
    private static $API_ACCESS_KEY = 'AAAAtnfD40U:APA91bFp5wO6fEg8vKFRdf-zqYXKBAMB63NnWi26uo0ilXGSvnoNlYwKKfEZyVWTRudo5d5F7IU4a4yCsCbgtshazydT9lX4mcJYkwhrAW97u0AovQoIQuySyTeqiutHQSE_H0clt5Wy';
    // (iOS) Private key's passphrase.
    private static $passphrase = 'welcome';
    // (Windows Phone 8) The name of our push channel.
    private static $channelName = "joashp";

    /**
     * Constructor
     *
     * @author     Ashwani 
     *
     */
    public function __construct() {
        
    }
/*{
    "to" : "e1w6hEbZn-8:APA91bEUIb2JewYCIiApsMu5JfI5Ak...",
"priority" : "high",
    "notification": {
        "body": "Cool offers. Get them before expiring!",
        "title": "Flat 80% discount",
        "icon": "appicon"
    },
    "data" : {
     "name" : "LG LED TV S15",
     "product_id" : "123",
     "final_price" : "2500"
   }
}
*/
    // Sends Push notification for Android users
    public function android($data, $token) {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $fields = array(
            'to' => $token,
            'priority'=>'high',
            'notification' => array('title' =>$data['mtitle'], 'body' => $data['mdesc'],"is_background" => "false","sound" => "Enabled"),
            'data' => array('title' =>$data['mtitle'], 'body' => $data['mdesc'])
        );
      
        $headers = array(
            'Authorization:key=' . self::$API_ACCESS_KEY,
            'Content-Type:application/json'
        );


        return $this->useCurl($url, $headers, json_encode($fields));
    }

    // Sends Push's toast notification for Windows Phone 8 users
    public function WP($data, $uri) {
        $delay = 2;
        $msg = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
                "<wp:Notification xmlns:wp=\"WPNotification\">" .
                "<wp:Toast>" .
                "<wp:Text1>" . htmlspecialchars($data['mtitle']) . "</wp:Text1>" .
                "<wp:Text2>" . htmlspecialchars($data['mdesc']) . "</wp:Text2>" .
                "</wp:Toast>" .
                "</wp:Notification>";

        $sendedheaders = array(
            'Content-Type: text/xml',
            'Accept: application/*',
            'X-WindowsPhone-Target: toast',
            "X-NotificationClass: $delay"
        );

        $response = $this->useCurl($uri, $sendedheaders, $msg);

        $result = array();
        foreach (explode("\n", $response) as $line) {
            $tab = explode(":", $line, 2);
            if (count($tab) == 2)
                $result[$tab[0]] = trim($tab[1]);
        }

        return $result;
    }

    // Sends Push notification for iOS users
    public function iOS($data, $devicetoken, $useSandbox) {
        $apnURL = "ssl://gateway.push.apple.com:2195";
       // if ($useSandbox) {
         //   $apnURL = "ssl://gateway.sandbox.push.apple.com:2195";
        //}
        $deviceToken = $devicetoken;

        $ctx = stream_context_create();
        // ck.pem is your certificate file
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'WenderCastPush.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', self::$passphrase);

        // Open a connection to the APNS server
        $fp = stream_socket_client(
                $apnURL, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        // Create the payload body
        $body['aps'] = array('alert' => array("body" => $data["mdesc"], "action-loc-key" => "View"), 'badge' => 0, 'sound' => 'default');
        // Encode the payload as JSON
        $payload = json_encode($body);

        // Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));

        // Close the connection to the server
        fclose($fp);

        if (!$result)
            return 'Message not delivered' . PHP_EOL;
        else
            return 'Message successfully delivered' . PHP_EOL;
    }

    // Curl 
    private function useCurl($url, $headers, $fields = null) {
        // Open connection
        $ch = curl_init();
        if ($url) {
            // Set the url, number of POST vars, POST data
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Disabling SSL Certificate support temporarly
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            if ($fields) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            }

            // Execute post
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Curl failed: ' . curl_error($ch));
            }

            // Close connection
            curl_close($ch);

            return $result;
        }
    }

}

?>
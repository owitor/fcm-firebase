<?php 

namespace FcmFirebase;

use FcmFirebase\Firebase\Firebase;

class Notification implements Firebase
{

    /**
    * URL TO API FCM
    * @var string 
    */
    CONST API = 'https://fcm.googleapis.com/fcm/send';

    /**
    * Key project to send message
    *
    * @access private
    * @var string
    */
    private $keyServer;

    /**
     * Informations to send server
     *
     * @var array
     */
    private $data = null;

    public function __construct($key) {
        $this->keyServer = $key;
    }

    /**
    * Title Notification
    *
    * @param $chave string
    * @return FirebaseNotification
    */
    public function setTitle($title) {
        $this->data['notification']['title'] = $title;
        return $this;
    }

    /**
    * Body Notification
    *
    * @param $text string
    * @return FirebaseNotification
    */
    public function setBody($text) {
        $this->data['notification']['body'] = $text;
        return $this;
    }

    /**
    * Imagem to Notification
    *
    * @param $texto string
    * @return FirebaseNotification
    */
    public function setImage($url) {
        $this->data['notification']['image'] = $url;
        return $this;
    }

    /**
     * Params Additional Notification
     *
     * @param array $params
     * @return FirebaseNotification
     */
    public function setData($params) {
        $this->data['data'] = $params;
        return $this;
    }

    /**
     * Priority Notification
     *
     * @param string $priority
     * @return FirebaseNotification
     */
    public function setPriority($priority) {
        $this->data['priority'] = $priority;
        return $this;
    }

    /**
     * Multiples Conditions
     * 
     * @param array $topicos
     * @return FirebaseNotification
     */
    public function condition($topic) {
        $this->data['condition'] = $topic;
        return $this;
    }

    /**
     * Send data to firebase
     *
     * @param array $params
     * @return array
     */
    public function send($params = []) {
        //JSON
        $json = json_encode($this->data) ?: $params;

        //Headers
        $headers = [
            'Content-Type:application/json',
            'Authorization:key=' . $this->keyServer
        ];

        $ch = curl_init(self::API);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpcode == 401) {
            throw new \Exception('Wrong Key to Server', 1);
        }

        if ($httpcode == 200) {
            $result = json_decode($result, true);

            if (!empty($result['failure'])) {
                throw new \Exception('Send Notification Failed', 2);
            }

            return $result;
        }
    }
}
<?php 

require_once './vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

date_default_timezone_set('America/Sao_Paulo');

try {
    $result = $fcm
        ->setTitle('Title')
        ->setBody('Body')
        ->setPriority('high')
        ->setImage('https://firebase.google.com/images/social.png')
        ->condition("'companycode-0001' in topics || 'companycode-0002' in topics")
        // ->setData(["score" => "5x1", "time" => "15:10"])
        ->send();
    
    echo "Success!<br/>";

    echo "<pre>";
    var_dump($result);    
    echo "</pre>";
} catch(Exception $e) {
    echo "Erro: " . $e->getMessage();
}
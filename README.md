# fcm-firebase
Send fcm type notifications to firebase

## Example to send fcm notification with php

```
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
```

<?php
    $url = 'http://localhost/web/coupdepouce/index.php?controller=utilisateurs&action=ajouter';    
    $data = array(
        "nom" => "Le méchant",
        "prenom" => "Pirate",
        "login" => "lepirate",
        "email" => "toto@3il.fr",
        "mot_de_passe" => "123456",
        "verification" => "123456",
        "formation" => "I1"
    );
    
    $options = array (
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        )
    );
    
    $context = stream_context_create($options);
    $result = file_get_contents($url,false,$context);
    
    echo $result;
?>


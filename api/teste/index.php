<?php

    include('../inc/init.php');

    // indicação se a api está a funcionar ou não    
    $resposta = array(
        'STATUS' => 'OK',
        'MESSAGE' => 'API disponível'
    );
           
    echo json_encode($resposta);
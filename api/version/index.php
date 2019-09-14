<?php

    include('../inc/init.php');

    // retrieves the API version
    $response = array(
        'STATUS' => 'OK',
        'MESSAGE' => API_VERSION,
        'TOKEN' => $token
    );
           
    echo json_encode($response);
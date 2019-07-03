<?php

    /* preparation */
    date_default_timezone_set('Europe/Lisbon');
    header("Content-Type: application/json; charset=UTF-8");

    /* includes */
    include('../inc/config.php');    
    include('../inc/gestor.php');

    /* prepare initial response */
    $response = array();

    /* get request data */
    $data = json_decode(file_get_contents('php://input'), true);

    /* if there is no post information, data will be always an empty array */
    if(!is_array($data)){
        $data = array();
    }

    if(array_key_exists('Token',$data)){
        $Token = $data['Token'];
    } else {
        $Token = round(microtime(true) * 1000);
    }
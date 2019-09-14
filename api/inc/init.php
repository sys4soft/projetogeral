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

    // ---------------------------------------------
    // check if app_key exists
    if(!key_exists('app_key', $data)){
        $response['status'] = 'Missing app_key.';
        echo json_encode($response);
        die();
    } else {
        $params = array(
            ':app_key' => $data['app_key']
        );
        $gestor = new cl_gestorBD();
        $dTemp = $gestor->EXE_QUERY("SELECT id_app FROM stock_apps WHERE app_key = :app_key AND active = 1", $params);
        if(count($dTemp) == 0){
            $response['status'] = 'App without permission to access API.';
            echo json_encode($response);
            die();
        }
    }
    // ---------------------------------------------

    if(array_key_exists('Token',$data)){
        $Token = $data['Token'];
    } else {
        $Token = round(microtime(true) * 1000);
    }
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
    // token
    if(array_key_exists('Token',$data)){
        $token = $data['Token'];
    } else {
        $token = round(microtime(true) * 1000);
    }

    // ---------------------------------------------
    // check if app_key exists
    if(!key_exists('app_key', $data)){
        $response['STATUS'] = 'KO';
        $response['MESSAGE'] = 'Missing app_key.';
        $response['TOKEN'] = $token;
        echo json_encode($response);
        die();
    } else {
        $params = array(
            ':app_key' => $data['app_key']
        );
        $gestor = new cl_gestorBD();
        $dTemp = $gestor->EXE_QUERY("SELECT id_app FROM stock_apps WHERE app_key = :app_key AND active = 1", $params);
        if(count($dTemp) == 0){
            $response['STATUS'] = 'KO';
            $response['MESSAGE'] = 'App without permission to access API.';
            $response['TOKEN'] = $token;
            echo json_encode($response);
            die();
        }
    }    
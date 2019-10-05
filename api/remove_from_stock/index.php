<?php

    include('../inc/init.php');

    // check if id_produto was given
    if(!key_exists('id_produto', $data)){
        $response['STATUS'] = 'KO';
        $response['MESSAGE'] = 'Missing id_produto.';
        $response['TOKEN'] = $token;
        echo json_encode($response);
        die();
    }

    // check if quantity was given
    if(!key_exists('quantidade', $data)){
        $response['STATUS'] = 'KO';
        $response['MESSAGE'] = 'Missing quantidade.';
        $response['TOKEN'] = $token;
        echo json_encode($response);
        die();
    }

    // check if quantity is < 1
    if($data['quantidade'] < 1){
        $response['STATUS'] = 'KO';
        $response['MESSAGE'] = 'Invalid quantity.';
        $response['TOKEN'] = $token;
        echo json_encode($response);
        die();
    }

    $gestor = new cl_gestorBD();

    // ---------------------------------------
    // check if product exists and if exists, check quantity available
    $params = Array(
        ':id_produto' => $data['id_produto']
    );
    $response['RESULTS'] = $gestor->EXE_QUERY(
        "SELECT id_produto, quantidade ".
        "FROM stock_produtos ".
        "WHERE id_produto = :id_produto"
    , $params);    
    if(count($response['RESULTS']) == 0){
        $response['STATUS'] = 'KO';
        $response['MESSAGE'] = 'Inexistent product.';
        $response['TOKEN'] = $token;
        echo json_encode($response);
        die();
    }
    // check if quantity if sufficient for the request
    if($response['RESULTS'][0]['quantidade'] < $data['quantidade']){
        $response['STATUS'] = 'KO';
        $response['MESSAGE'] = 'Quantity unavailable.';
        $response['TOKEN'] = $token;
        echo json_encode($response);
        die();
    }
    
    // remove from stock
    // insert stock_movimentos ...
    // update stock_produtos set ...
    
    

    
    
    // // get product stock quantity by id
    // $params = Array(
    //     ':id_produto' => $data['id_produto']
    // );
    // $response['RESULTS'] = $gestor->EXE_QUERY(
    //     "SELECT " .
    //     "id_produto, designacao AS nome_produto, quantidade " .        
    //     "FROM stock_produtos ".        
    //     "WHERE id_produto = :id_produto"
    // , $params);

    // if(count($response['RESULTS']) == 0){
    //     $response['MESSAGE'] = 'Inexistent product.';
    // }

    // token
    $response['TOKEN'] = $token;

    // output do endpoint
    echo json_encode($response);
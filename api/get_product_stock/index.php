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

    $gestor = new cl_gestorBD();

    // get product stock quantity by id
    $params = Array(
        ':id_produto' => $data['id_produto']
    );
    $response['RESULTS'] = $gestor->EXE_QUERY(
        "SELECT " .
        "id_produto, designacao AS nome_produto, quantidade " .        
        "FROM stock_produtos ".        
        "WHERE id_produto = :id_produto"
    , $params);

    if(count($response['RESULTS']) == 0){
        $response['MESSAGE'] = 'Inexistent product.';
    }

    // token
    $response['TOKEN'] = $token;

    // output do endpoint
    echo json_encode($response);
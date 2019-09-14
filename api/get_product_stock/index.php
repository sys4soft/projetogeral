<?php

    include('../inc/init.php');

    // check if id_produto was given
    if(!key_exists('id_produto', $data)){
        $response['status'] = 'Missing id_produto.';
        echo json_encode($response);
        die();
    }

    $gestor = new cl_gestorBD();

    // get product stock quantity by id
    $params = Array(
        ':id_produto' => $data['id_produto']
    );
    $results['Results'] = $gestor->EXE_QUERY(
        "SELECT " .
        "id_produto, designacao AS nome_produto, quantidade " .        
        "FROM stock_produtos ".        
        "WHERE id_produto = :id_produto"
    , $params);

    if(count($results['Results']) == 0){
        $results['status'] = 'Inexistent product.';
    }

    // token
    $results['Token'] = $Token;

    // output do endpoint
    echo json_encode($results);
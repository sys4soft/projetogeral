<?php

    include('../inc/init.php');

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

    $id_produto = $data['id_produto'];
    $quantidade = $data['quantidade'];

    // check if quantity is valid
    if($quantidade < 1 || $quantidade > 10000){
        $response['STATUS'] = 'KO';
        $response['MESSAGE'] = 'Quantidade inválida (entre 1 e 10000).';
        $response['TOKEN'] = $token;
        echo json_encode($response);
        die();
    }

    

    $gestor = new cl_gestorBD();

    // check if the product exists
    $params = Array(
        ':id_produto' => $id_produto
    );
    $response['RESULTS'] = $gestor->EXE_QUERY(
        "SELECT id_produto ".
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

    // insert row in stock_movimentos
    $params = array(
        ':id_app'=> $data['app_id'],
        ':id_produto' => $id_produto,
        ':quantidade' => $quantidade
    );
    $gestor->EXE_NON_QUERY("
        INSERT INTO stock_movimentos
        VALUES(
            0,
            :id_app,
            :id_produto,
            :quantidade,
            0,
            'entrada',
            NOW(),
            ''
        )
    ", $params);

    // update stock_produtos
    $params = array(
        ':id_produto' => $id_produto,
        ':quantidade' => $quantidade
    );
    $gestor->EXE_NON_QUERY("
        UPDATE stock_produtos
        SET 
            quantidade = quantidade + :quantidade,
            atualizacao = NOW()
        WHERE id_produto = :id_produto
    ",$params);
    
    $response['STATUS'] = 'OK';
    $response['MESSAGE'] = 'SUCCESS';

    // token
    $response['TOKEN'] = $token;

    // output do endpoint
    echo json_encode($response);
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

    // notes
    $observacoes = '';
    if(key_exists('observacoes', $data)){
        $observacoes = $data['observacoes'];
    }  
    
    // buscar os dados do produto selecionado
    $params = Array(
        ':id_produto' => $data['id_produto']
    );
    $results = $gestor->EXE_QUERY(
        "SELECT *, stock_produtos.id_taxa AS produto_id_taxa FROM stock_produtos ".
        "LEFT JOIN stock_taxas ".
        "ON stock_produtos.id_taxa = stock_taxas.id_taxa ".
        "WHERE stock_produtos.id_produto = :id_produto"
    , $params);

    $produto = $results[0];

    // without taxes 
    $preco_total = $data['quantidade']*$produto['preco'];

    if($produto['produto_id_taxa'] != 0){
        // with taxes
        $preco_total = $preco_total * (1 + ($produto['percentagem']/100));
    }
    
    echo $preco_total;
    die();
    

    // executar os cálculos para perceber o preço total


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
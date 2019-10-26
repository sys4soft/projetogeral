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
    $preco_total_sem_taxas = $preco_total;
    $preco_total_com_taxas = $preco_total;

    if($produto['produto_id_taxa'] != 0){
        // with taxes
        $preco_total = $preco_total * (1 + ($produto['percentagem']/100));
        $preco_total_com_taxas = $preco_total;
    }      

    $params = array(
        ':id_app' => $data['app_id'],
        ':id_produto' => $data['id_produto'],
        ':quantidade' => $data['quantidade'],
        ':preco_total' => $preco_total,
        ':entrada_saida' => 'saida',
        ':observacoes' => $data['observacoes']
    );

    // inserir movimento no stock_movimentos
    $gestor->EXE_NON_QUERY("
        INSERT INTO stock_movimentos VALUES(
            0,
            :id_app,
            :id_produto,
            :quantidade,
            :preco_total,
            :entrada_saida,
            NOW(),
            :observacoes
        )", $params);
    
    // update stock_produtos (atualizar o stock de produto vendido)
    $params = array(
        ':id_produto' => $data['id_produto'],
        ':quantidade' => $data['quantidade']
    );
    $gestor->EXE_NON_QUERY("
        UPDATE stock_produtos SET
        quantidade = quantidade - :quantidade,
        atualizacao = NOW()
        WHERE id_produto = :id_produto
    ",$params);

    // procurar a quantidade atual de stock do produto
    $params = array(
        ':id_produto' => $data['id_produto']
    );
    $dTemp = $gestor->EXE_QUERY(
        "SELECT quantidade FROM ".
        "stock_produtos ".
        "WHERE id_produto = :id_produto", $params);

    $response['RESULTS'] = array(
        'id_produto' => $data['id_produto'],
        'quantidade vendida' => $data['quantidade'],
        'preço final (sem taxas)' => $preco_total_sem_taxas,
        'preço final (com taxas)' => $preco_total_com_taxas,
        'quantidade disponível' => $dTemp[0]['quantidade'],
        'data da venda' => date('Y-m-d H:i:s')
    );
    
    $response['STATUS'] = 'OK';
    $response['MESSAGE'] = 'SUCCESS';

    // token
    $response['TOKEN'] = $token;

    // output do endpoint
    echo json_encode($response);
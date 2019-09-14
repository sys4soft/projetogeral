<?php

    include('../inc/init.php');

    // check if id_familia was given
    if(!key_exists('id_familia', $data)){
        $response['status'] = 'Missing id_familia.';
        echo json_encode($response);
        die();
    }

    $gestor = new cl_gestorBD();

    // get all products from family
    $params = Array(
        ':id_familia' => $data['id_familia']
    );
    $results['Results'] = $gestor->EXE_QUERY(
        "SELECT " .
            "p.id_produto, ".
            "p.id_familia, ".
            "p.designacao AS nome_produto, ".
            "p.descricao, ".
            "CONCAT('".IMG_PATH."', p.imagem) as imagem, ".
            "p.preco, ".
            "p.id_taxa, ".
            "p.quantidade, ".
            "p.detalhes, ".            
            "f.designacao AS familia, " .
            "t.designacao AS taxa, t.percentagem " .
        "FROM stock_produtos p ".
        "LEFT JOIN stock_familias f ON p.id_familia = f.id_familia " .
        "LEFT JOIN stock_taxas t ON p.id_taxa = t.id_taxa " .
        "WHERE p.id_familia = :id_familia"
    , $params);

    // token
    $results['Token'] = $Token;

    // output do endpoint
    echo json_encode($results);
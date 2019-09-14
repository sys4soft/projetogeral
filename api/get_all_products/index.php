<?php

    include('../inc/init.php');

    $gestor = new cl_gestorBD();

    // define status
    $results['STATUS'] = 'OK';
    $results['MESSAGE'] = 'SUCCESS';

    // get all products
    $results['RESULTS'] = $gestor->EXE_QUERY(
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
        "LEFT JOIN stock_taxas t ON p.id_taxa = t.id_taxa"
    );

    // token
    $results['TOKEN'] = $token;

    // output do endpoint
    echo json_encode($results);
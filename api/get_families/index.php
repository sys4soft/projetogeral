<?php

    include('../inc/init.php');

    $gestor = new cl_gestorBD();

    $response['STATUS'] = 'OK';
    $response['MESSAGE'] = 'SUCCESS';

    // get all product families
    $response['RESULTS'] = $gestor->EXE_QUERY("SELECT * FROM stock_familias");

    // token
    $response['TOKEN'] = $token;

    // output do endpoint
    echo json_encode($response);
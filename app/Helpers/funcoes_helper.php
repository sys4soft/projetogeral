<?php

    // ==================================================
    function verDados($array){
        echo '<pre>';
        echo 'Dados do Array<hr>';
        foreach ($array as $key => $value) {
            echo "<p>$key => $value</p>";
        }
        echo '</pre>';
        die();
    }

    // ==================================================
    function verSessao(){
        
        // ver todos os dados guardados na sessão
        $session = \Config\Services::session();
        echo '<pre>';
        echo 'Dados da Sessão<hr>';
        print_r($_SESSION);
        echo '</pre>';
        die();
    }
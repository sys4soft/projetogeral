<?php

    // ==================================================
    function aesEncrypt($valor_original){
        return bin2hex(openssl_encrypt($valor_original, 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV));
    }

    // ==================================================
    function aesDecrypt($valor_encriptado){

        $resultado = -1;
        try {
            $resultado = openssl_decrypt(hex2bin($valor_encriptado), 'aes-256-cbc', AES_KEY, OPENSSL_RAW_DATA, AES_IV);
            if(gettype($resultado) == 'boolean'){ return -1; }
        } catch (\Throwable $th) {
            return -1;
        }

        return $resultado;
    }

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
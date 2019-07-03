<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CriptoModel;

class Cripto extends BaseController
{
    public function index(){
        echo 'estou no cripto.';
    }

    public function guadarCartao(){
        $numero_cartao = '456345FG';

        $model = new CriptoModel();
        $model->encriptar($numero_cartao);
        echo 'Cartão adicionado com sucesso.';
    }

    public function apresentarCartao($id){
        $model = new CriptoModel();
        $resultado = $model->desencriptar($id);
        echo '<pre>';
        print_r($resultado);
        echo '</pre>';
    }

    public function procurarCartao($numero_cartao){
        $model = new CriptoModel();
        $resultado = $model->procurarCartao($numero_cartao);
        echo '<pre>';
        print_r($resultado);
        echo '</pre>';
    }
}

// 123456AB
// 456345FG
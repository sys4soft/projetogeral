<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\StocksModel;

class Stocks extends BaseController{

    // ==================================================
    public function index(){
        echo view('stocks/main');
    }





    // ==================================================
    // FAMILIAS
    // ==================================================
    public function familias(){

        // carregar os dados das famílias para passar para a view
        $model = new StocksModel();
        $data['familias'] = $model->get_all_families();        
        echo view('stocks/familias', $data);
    }

    // ==================================================
    public function familia_adicionar(){

        // adicionar nova família

        // carregar os dados das famílias para passar para a view
        $model = new StocksModel();
        $data['familias'] = $model->get_all_families();
        $error = '';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // vamos buscar os dados submetidos pelo formulário
            $request = \Config\Services::request();            
            
            // verificar se já existe a família com mesmo nome
            $resultado = $model->check_family($request->getPost('text_designacao'));
            if($resultado){
                $error = 'Já existe uma família com a mesma designação';
            }
            
            // guardar a nova família na base de dados
            if($error == ''){
                $model->family_add();
                $data['success'] = "Família adicionada com sucesso.";
                $data['familias'] = $model->get_all_families();
            } else {
                $data['error'] = $error;
            }
        }

        echo view('stocks/familias_adicionar', $data);
    }

    // ==================================================
    public function familia_editar($id_familia){
        
        // editar família

        // carregar os dados das famílias para passar para a view
        $model = new StocksModel();
        $data['familias'] = $model->get_all_families();
        $data['familia'] = $model->get_family($id_familia);
        $error = '';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // vamos buscar os dados submetidos pelo formulário
            $request = \Config\Services::request();            
            
            // verificar se já existe a família com mesmo nome
            $resultado = $model->check_other_family($request->getPost('text_designacao'), $id_familia);
            if($resultado){
                $error = 'Já existe outra família com a mesma designação';
            }
            
            // atualizar os dados da família na base de dados
            if($error == ''){
                $model->family_edit($id_familia);
                $data['success'] = "Família atualizada com sucesso.";
                
                // redirecionamento para stocks/familias
                return redirect()->to(site_url('stocks/familias'));

            } else {
                $data['error'] = $error;
            }
        }

        echo view('stocks/familias_editar', $data);

    }

    // ==================================================
    public function familia_eliminar($id_familia, $resposta = 'nao'){
        
        $model = new StocksModel();
        $data['familia'] = $model->get_family($id_familia);

        if($resposta == 'sim'){
            
            // eliminação da família
            $model->delete_family($id_familia);

            // redirecionamento para stocks/familias
            return redirect()->to(site_url('stocks/familias'));
        }

        echo view('stocks/familias_eliminar', $data);
    }











    // ==================================================
    // MOVIMENTOS
    // ==================================================
    public function movimentos(){
        echo view('stocks/movimentos');
    }









    // ==================================================
    // PRODUTOS
    // ==================================================
    public function produtos(){

        // carregar os produtos existentes
        $model = new StocksModel();
        $data['produtos'] = $model->get_all_products();
        echo view('stocks/produtos', $data);
    }

    // ==================================================
    public function produtos_adicionar(){

        $model = new StocksModel();
        
        // carregar familias    
        $data['familias'] = $model->get_all_families();

        // carregar as taxas
        $data['taxas'] = $model->get_all_taxes();

        // tratar a submissao do formulario
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            // definição do nome da imagem do produto
            $novo_ficheiro = round(microtime(true) * 1000) . '.'.pathinfo($_FILES["file_imagem"]["name"], PATHINFO_EXTENSION);

            $model = new StocksModel();
            $model->product_add($novo_ficheiro);

            // upload da imagem            
            $target_file = '';
            $target_file .= 'assets/product_images/';
            $target_file .= $novo_ficheiro;
            $file_success = move_uploaded_file($_FILES["file_imagem"]["tmp_name"], $target_file);
        }

        // apresentar o formulário
        echo view('stocks/produtos_adicionar', $data);
        
    }










    // ==================================================
    // TAXAS
    // ==================================================
    public function taxas(){

        // carregar os dados das taxas para passar para a view
        $model = new StocksModel();
        $data['taxas'] = $model->get_all_taxes();

        echo view('stocks/taxas', $data);
    }

    // ==================================================
    public function taxas_adicionar(){

        $model = new StocksModel();
        $data = array();
        $error = '';

        // adicionar nova taxa
        if($_SERVER['REQUEST_METHOD'] == 'POST'){            

            // vamos buscar os dados submetidos pelo formulário
            $request = \Config\Services::request();            
            
            // verificar se já existe a taxa com mesmo nome
            $resultado = $model->check_tax($request->getPost('text_designacao'));
            if($resultado){
                $error = 'Já existe uma taxa com a mesma designação';
            }
            
            // guardar a nova taxa na base de dados
            if($error == ''){
                $model->tax_add();
                $data['success'] = "Taxa adicionada com sucesso.";
            } else {
                $data['error'] = $error;
            }
        }

        echo view('stocks/taxas_adicionar', $data);
    }

    // ==================================================
    public function taxas_editar($id_taxa){
        
        // editar taxa

        // carregar os dados das taxas para passar para a view
        $model = new StocksModel();
        $data['taxa'] = $model->get_tax($id_taxa);

        $error = '';

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            // vamos buscar os dados submetidos pelo formulário
            $request = \Config\Services::request();            
            
            // verificar se já existe a taxa com mesmo nome
            $resultado = $model->check_other_tax($request->getPost('text_designacao'), $id_taxa);
            if($resultado){
                $error = 'Já existe outra taxa com a mesma designação';
            }
            
            // atualizar os dados da taxa na base de dados
            if($error == ''){
                $model->tax_edit($id_taxa);
                
                // redirecionamento para stocks/taxas
                return redirect()->to(site_url('stocks/taxas'));

            } else {
                $data['error'] = $error;
            }
        }

        echo view('stocks/taxas_editar', $data);
    }

    // ==================================================
    public function taxas_eliminar($id_taxa, $resposta = 'nao'){
        
        $model = new StocksModel();
        $data['taxa'] = $model->get_tax($id_taxa);

        if($resposta == 'sim'){
            
            // eliminação da taxa
            $model->delete_tax($id_taxa);

            // redirecionamento para stocks/taxas
            return redirect()->to(site_url('stocks/taxas'));
        }

        echo view('stocks/taxas_eliminar', $data);
    }
}
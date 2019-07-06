<?php namespace App\Models;

use CodeIgniter\Model;

class StocksModel extends Model{

    protected $db;

    // ===========================================
    public function __construct(){
        $this->db = db_connect();
    }

    // ===========================================
    public function get_all_families(){

        // returns all families
        // return $this->query("SELECT * FROM stock_familias")->getResult('array');
        return $this->query('

        SELECT a.*, b.designacao AS parent
        FROM stock_familias a LEFT JOIN stock_familias b
        ON a.id_parent = b.id_familia

        ')->getResult('array');
    }

    // ===========================================
    public function get_family($id_family){

        // returns the family
        $params = array($id_family);
        $results = $this->query("SELECT * FROM stock_familias WHERE id_familia = ?", $params)->getResult('array');
        
        if(count($results) == 1){
            return $results[0];
        } else {
            return array();
        }
    }

    // ===========================================
    public function check_family($designacao){

        $params = array(
            $designacao
        );

        $results = $this->query("SELECT * FROM stock_familias WHERE designacao = ?", $params)->getResult('array');
        if(count($results) != 0){
            return true;
        } else {
            return false;
        }        
    }

    // ===========================================
    public function family_add(){

        // adicionar uma nova família de produtos à base de dados
        $request = \Config\Services::request();
        $params = array(
            $request->getPost('select_parent'),
            $request->getPost('text_designacao')
        );

        $this->query("INSERT INTO stock_familias VALUES(0, ?, ?, '')", $params);
    }

    // ===========================================
    public function check_other_family($designacao, $id_family){

        $params = array(
            $designacao,
            $id_family
        );

        $results = $this->query("SELECT * FROM stock_familias WHERE designacao = ? AND id_familia != ?", $params)->getResult('array');
        if(count($results) != 0){
            return true;
        } else {
            return false;
        }        
    }

    // ===========================================
    public function family_edit($id_family){

        // editar os dados da família
        $request = \Config\Services::request();
        $params = array(
            $request->getPost('select_parent'),
            $request->getPost('text_designacao'),
            $id_family
        );

        $this->query(
            "UPDATE stock_familias ".
            "SET id_parent = ?, ".
            "designacao = ? ".
            "WHERE id_familia = ?",
            $params);
    }

    // ===========================================
    public function delete_family($id_family){

        // eliminar a família e alterar o id dos parents
        $params = array(
            $id_family
        );

        // delete the selected family
        $this->query("DELETE FROM stock_familias WHERE id_familia = ?", $params);

        // updates all the families where id_parent is id_family
        $this->query("UPDATE stock_familias SET id_parent = 0 WHERE id_parent = ?", $params);
    }

}
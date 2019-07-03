<?php namespace App\Models;

use CodeIgniter\Model;

class CriptoModel extends Model
{
    protected $db;
    protected $key = '68jvabhJbxDhEADu';

    // =============================================
    public function __construct(){
        $this->db = db_connect();
    }

    // =============================================
    public function encriptar($cartao){
        // guardar na bd o cartao de crédito encritado
        $params = array(
            $cartao
        );
        $this->db->query(
        "INSERT INTO criptografia VALUES(0,".
        "AES_ENCRYPT(?,UNHEX(SHA2('".$this->key."',512)))".
        ")"
        , $params);
    }

    // =============================================
    public function desencriptar($id){
        // retorna o cartão de crédito desencritado
        $params = array(
            $id
        );
        return $this->db->query("
            SELECT id_cartao,
            AES_DECRYPT(numero_cartao,UNHEX(SHA2('".$this->key."',512))) AS numero_cartao
            FROM criptografia
            WHERE id_cartao = ?
        ",$params)->getResult('array');
    }

    // =============================================
    public function procurarCartao($numero_cartao){
        $params = array(
            $numero_cartao
        );
        return $this->db->query(
        "SELECT id_cartao, 
                AES_DECRYPT(numero_cartao,UNHEX(SHA2('".$this->key."',512))) AS numero_cartao
                FROM criptografia
                WHERE AES_DECRYPT(numero_cartao,UNHEX(SHA2('".$this->key."',512))) = ?"    
        ,$params)->getResult('array');
    }
}
<?php namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $db;

    // =============================================
    public function __construct(){
        $this->db = db_connect();
    }

    // =============================================
    public function verifyLogin($username, $password){
        $params = array(
            $username,
            md5(sha1($password))
        );

        $query = "SELECT * FROM users WHERE username = ? AND passwrd = ? AND deleted = 0";
        $results = $this->db->query($query,$params)->getResult('array');

        if(count($results) == 0){
            return false;
        } else {

            // update last_login in the database
            $params = array(
                $results[0]['id_user']
            );
            $this->db->query("UPDATE users SET last_login = NOW() WHERE id_user = ?", $params);

            // returns valid login
            return $results[0];
        }
    }

    // =============================================
    public function resetPassword($email){

        // resets the users password

        // checks if there is a user with the email
        $params = array(
            $email
        );
        $query = "SELECT id_user FROM users WHERE email = ?";
        $results = $this->db->query($query,$params)->getResult('array');

        if(count($results) != 0){
            // existe o email

            // change the user's password
            $newPassword = $this->randomPassword();
            $params = array(
                md5(sha1($newPassword)),
                $results[0]['id_user']
            );
            $query = "UPDATE users SET passwrd = ? WHERE id_user = ?";
            $this->db->query($query,$params);

            // show the new passwords
            echo '(Mensagem de email)';
            echo 'A sua nova password é: ' . $newPassword;

            // aaa
            // d5d849bdba01233f855b16da071127ae

            return true;
        } else {
            // não existe
            echo 'Não existe esse email registado.';
            return false;
        }

    }

    // =============================================
    public function checkEmail($email){
        // checks if the email is from a user's account
        $params = array(
            $email
        );
        $query = "SELECT id_user FROM users WHERE email = ?";
        return $this->db->query($query,$params)->getResult('array');
    }

    // =============================================
    public function sendPurl($email, $id_user){

        /*
        1. gerar um código purl e guarda na bd > FEITO
        2. envia uma mensagem com o link do purl
        */
        $purl = $this->randomPassword(6);
        $params = array(
            $purl,
            $id_user
        );
        $query = "UPDATE users SET purl = ? WHERE id_user = ?";
        $this->db->query($query,$params);

        // "envio" do email
        echo '(mensagem de email) Link para redefinir a sua password: ';
        echo '<a href="'.site_url('users/redefine_password/' . $purl).'">Redefinir password</a>';
    }

    // =============================================
    public function getPurl($purl){

        // returns the row with the given purl
        $params = array(
            $purl
        );

        $query = "SELECT id_user FROM users WHERE purl = ?";
        return $this->db->query($query,$params)->getResult('array');
    }

    // =============================================
    public function redefinePassword($id, $pass){

        // update the user's password
        $params = array(
            md5(sha1($pass)),
            $id
        );
        $query = "UPDATE users SET passwrd = ? WHERE id_user = ?";
        $this->db->query($query,$params);

        // removes the purl from the user
        $params = array(
            $id
        );
        $this->db->query("UPDATE users SET purl = '' WHERE id_user = ?", $params);
    }


    // =============================================
    public function getUsers(){

        // returns all users in the database
        $query = "SELECT * FROM users";
        return $this->db->query($query)->getResult('array');
    }

    // =============================================
    public function getUser($id_user){

        // returns a user in the database
        $params = array($id_user);        
        $query = "SELECT * FROM users WHERE id_user = ?";
        return $this->db->query($query, $params)->getResult('array');
    }

    // =============================================
    public function checkExistingUser(){

        // verifies is there is already an user with the same username or email address
        $request = \Config\Services::request();
        $dados = $request->getPost();

        $params = array(
            $dados['text_username'],
            $dados['text_email']
        );

        return $this->db->query('SELECT id_user FROM users WHERE username = ? OR email = ?', $params)->getResult('array');        
    }

    // =============================================
    public function checkAnotherUserEmail($id_user){

        // verifies if there is already another user with the same email address
        $request = \Config\Services::request();
        $dados = $request->getPost();

        $params = array(            
            $dados['text_email'],
            $id_user
        );

        return $this->db->query('SELECT id_user FROM users WHERE email = ? AND id_user <> ?', $params)->getResult('array');        
    }

    // =============================================
    public function addNewUser(){

        $request = \Config\Services::request();
        $dados = $request->getPost();

        // profile
        $profileTemp = array();
        if(isset($dados['check_admin'])){
            array_push($profileTemp, 'admin');
        }

        if(isset($dados['check_moderator'])){
            array_push($profileTemp, 'moderator');
        }

        if(isset($dados['check_user'])){
            array_push($profileTemp, 'user');
        }

        $profile = implode(',',$profileTemp);

        $params = array(
            $dados['text_username'],
            md5(sha1($dados['text_password'])),
            $dados['text_name'],
            $dados['text_email'],
            $profile
        );

        $this->db->query("INSERT INTO users(username, passwrd, name, email, profile) VALUES(?,?,?,?,?)", $params);
    }

    // =============================================
    public function editUser(){

        // editar os dados do utilizador na bd
        $request = \Config\Services::request();
        $dados = $request->getPost();

        // profile
        $profileTemp = array();
        if(isset($dados['check_admin'])){
            array_push($profileTemp, 'admin');
        }

        if(isset($dados['check_moderator'])){
            array_push($profileTemp, 'moderator');
        }

        if(isset($dados['check_user'])){
            array_push($profileTemp, 'user');
        }

        $profile = implode(',',$profileTemp);

        $params = array(
            $dados['text_name'],
            $dados['text_email'],
            $profile,
            $dados['id_user']
        );

        $this->db->query('UPDATE users SET name = ?, email = ?, profile = ? WHERE id_user = ?', $params);
    }

    // =============================================
    public function deleteUser($id_user){

        $params = array(
            $id_user
        );

        // UNIX_TIMESTAMP()

        $this->db->query('UPDATE users SET deleted = UNIX_TIMESTAMP() WHERE id_user = ?', $params);
    }

    // =============================================
    public function recoverUser($id_user){

        // recover deleted user
        $params = array(
            $id_user
        );

        $this->db->query('UPDATE users SET deleted = 0 WHERE id_user = ?', $params);
    }


    // =============================================
    private function randomPassword($numChars = 8){
        // generates a random password
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($chars),0,$numChars);
    }
    
}
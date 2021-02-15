<?php

/**
 * Description of conexao
 *
 */
class Connection {
    public $db;
    
    function __construct() {
        $this->newConnection();
    }
    
    public function newConnection() {
        try {
            $this->db = new PDO(
                    DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME,
                    DB_USER,
                    DB_PASS
                );
        } catch (PDOException $exc) {
            echo '<script>window.alert("Houve um problema com a conexão ao banco de dados!\nEntre em contato com o administrador do sistema!");</script>';
            exit;
        }
    }
}

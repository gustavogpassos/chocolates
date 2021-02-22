<?php

require_once SERVER_ROOT . 'lib/connection.php';

class ClientModel extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     * funcção que retorna os clientes cadastrados no sistema
     */
    public function index(){
        $select = "select * from adm_client";
        $query = $this->db->query($select);
        if(is_bool($query)){
            return false;
        }else{
            return $query->fetchAll();
        }
    }

    /**
     * @param $data
     * @return boolean
     *
     * funcção para cadastro de um novo cliente
     */
    public function newClient($data){
        $insert = 'insert into adm_client (name,cpf,contact, address, obs) 
                        values(:name, :cpf, :contact, :address, :obs)';
        $query = $this->db->prepare($insert);
        return $query->execute($data);
    }

    /**
     * @param $search
     * @return mixed
     *
     * funcção para buscar um cliente pelo nome ou cpf e retona um ou mais registros caso encontre
     */
    public function searchClient($search){
        $select = "select * from adm_client where name like '%':search'%' or cpf like '%':search'%'";

        $query = $this->db->prepare($select);
        $query->execute(array('search'=>$search));

        if(is_bool($query)){
            return $query->errorInfo();
        }else{
            return $query->fetchAll();
        }
    }

    /**
     * @param $id
     * @return mixed
     *
     * função para buscar um cliente pelo id, geralmente usada para atualizar o cadastro
     */
    public function getClient($cpf){
        $select = "select * from adm_client where cpf=:cpf";

        $query = $this->db->prepare($select);
        $query->execute(array('cpf'=>$cpf));

        if(is_bool($query)){
            return $query->errorInfo();
        }else{
            return $query->fetch();
        }
    }

    /**
     * @param $data
     * @return mixed
     *
     * função para atualizar alguns dados do cliente
     * não altera o cpf nem o nome
     */
    public function updateClient($data){
        $update = "update adm_client set 
                      name=:name,
                      contact=:contact,
                      address=:address,
                      obs=:obs
                      where cpf=:cpf";
        $query = $this->db->prepare($update);
        return $query->execute($data);
    }
}
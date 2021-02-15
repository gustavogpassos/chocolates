<?php


class ClientModel extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }


    public function index(){
        $select = "select * from adm_client";
        $query = $this->db->query($select);
        if(is_bool($query)){
            return false;
        }else{
            return $query->fetchAll();
        }
    }

    public function newClient($data){
        $insert = 'insert into adm_client (name,cpf,contact) values(:name,:cpf,:contact)';
        $query = $this->db->prepare($insert);
        return $query->execute($data);
    }

    public function searchClient($search){
        $select = "select * from adm_client where name like '%':search'%' or cpf like '%':search'%'";

        $query = $this->db->prepare($select);
        $query->execute(array('search'=>$search));

        if(is_bool($query)){
            return false;
        }else{
            return $query->fetchAll();
        }
    }
}
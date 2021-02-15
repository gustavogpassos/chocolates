<?php

class ProductModel extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return false or array
     * função que busca todos os produtos cadastrados na listagem
     */
    public function index(){
        $select  = "select * from adm_product";
        $query = $this->db->query($select);
        if(is_bool($query)){
            return false;
        } else {
            return $query->fetchAll();
        }
    }

    public function newProduct($data){
        $insert = "insert into adm_product values (:name, :weight)";
        $query = $this->db->prepare($insert);
        return $query->execute($data);
    }

    public function searchProduct ($search){
        $select = "select * from adm_product where id like :search'%' or name like '%':search'%'";
        $query = $this->db->prepare($select);
        $query->execute(array('search'=>$search));
        if(is_bool($query)){
            return false;
        }else{
            return  $query->fetchAll();
        }
    }

    public function getProduct($id){
        $select = "select * from adm_product where id=:id";
        $query = $this->db->prepare($select);
        $query->execute(array('id'=>$id));
        if(is_bool($query)){
            return false;
        }else{
            return $query->fetch();
        }
    }

    public function updateProduct($data){
        $update = "update adm_produtc set
                    name=:name, weight=:weight
                    where id=:id";
        $query = $this->db->prepare($update);
        return $query->execute($data);
    }


}
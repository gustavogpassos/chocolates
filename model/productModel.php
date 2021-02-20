<?php

require_once SERVER_ROOT . 'lib/connection.php';

class ProductModel extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
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

    /**
     * @param $data
     * @return mixed
     *
     * funcção para cadastro de um novo produto, recebe um array com os dados
     */
    public function storeProduct($data){
        $insert = "insert into adm_product(sku, name, weight) values (:sku, :name, :weight)";
        $query = $this->db->prepare($insert);
        return $query->execute($data);
    }

    /**
     * @param $search
     * @return bool array
     *
     * funcção para buscar um produto pelo código ou nome e retorna um array caso encontre
     * ou retorna boolean se não encontrar
     */
    public function searchProduct ($search){
        $select = "select * from adm_product where sku like :search'%' or name like '%':search'%'";
        $query = $this->db->prepare($select);
        $query->execute(array('search'=>$search));
        if(is_bool($query)){
            return $query->errorInfo();
        }else{
            return  $query->fetchAll();
        }
    }

    /**
     * @param $id
     * @return bool array
     *
     * função para buscar produto pelo código
     */
    public function getProduct($sku){
        print_r($sku);
        $select = "select * from adm_product where sku=:sku";
        $query = $this->db->prepare($select);
        $query->execute(array('sku'=>$sku));
        if(is_bool($query)){
            return $query->errorInfo();
        }else{
            return $query->fetch();
        }
    }

    /**
     * @param $data
     * @return boolean
     *
     * função para atualizar os dados de algum produto
     */
    public function updateProduct($data){
        $update = "update adm_produtc set
                    name=:name, weight=:weight
                    where sku=:sku";
        $query = $this->db->prepare($update);
        return $query->execute($data);
    }


}
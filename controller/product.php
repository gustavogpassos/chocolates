<?php

require SERVER_ROOT . 'model/productModel.php';

class Product
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index(){
        $data = $this->productModel->index();
        require SERVER_ROOT . 'view/product/index.php';
    }

    /**
     * @return boolean
     * função que chama o formulario para cadastrar um novo produto
     */
    public function newProduct()
    {
        $action = 'index.php?ctrl=product&action=store';
        require SERVER_ROOT . 'view/product/form.php';
    }

    /**
     * função que envia os dados de um novo produto para cadastrar na base de dados
     */
    public function store(){
        $data = $_POST;
        try{
            $this->productModel->storeProduct($data);
            print_r("produto cadastrado");
            $this->index();
        }catch (ErrorException $e){
            print_r($e);
        }
    }

    /**
     * função para atualizar os dados de um produto
     */
    public function update(){
        $data = $_GET;

        try {
            $this->productModel->updateProduct($data);
            print_r("produto atualizado");
            $this->index();
        }catch (Exception $e) {
            print_r($e);
        }
    }

    /**
     * @return bool
     *
     * função para pesquisar um produto pelo nome ou código
     */
    public function search(){
        $search = $_POST['data'];
        print_r($search);

        $result = $this->productModel->searchProduct($search);

        $r = $result;

        print_r($r);
        if(count($result)<1){
            $msg = "Nenhum resultado";
            return $msg;
        }else{
            return $result;
        }
    }

    public function get(){
        $sku = $_GET['sku'];
        $action = 'index.php?ctrl=product&action=update';
        $data = $this->productModel->getProduct($sku);
        require SERVER_ROOT . 'view/product/form.php';
    }

}
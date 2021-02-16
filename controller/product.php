<?php

//require SERVER_ROOT . 'model/productModel.php';

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
            $this->productModel->newProduct($data);
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
        $data = $_POST;

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
        $search = $_POST;

        $result = $this->productModel->searchProduct($search);
        if(is_bool($result)){
            echo "Nenhum resultado";
        }else{
            return $result;
        }
    }

    public function get(){
        $data = $_POST;
        $action = 'index.php?ctrl=product&action=update';
        $product = $this->productModel->getProduct($data);
        require SERVER_ROOT . 'view/product/form.php';
    }

}
<?php

require SERVER_ROOT . 'model/sellOrderModel.php';
require SERVER_ROOT . 'model/productModel.php';
require SERVER_ROOT . 'model/stockModel.php';

class SellOrder
{
    private $sellOrderModel;
    private $productModel;
    private $stockModel;

    public function __construct()
    {
        $this->sellOrderModel = new SellOrderModel();
        $this->productModel= new ProductModel();
        $this->stockModel= new StockModel();
    }

    public function index(){
        $data = $this->sellOrderModel->index();
        require SERVER_ROOT . 'view/sellOrder/index.php';
    }

    public function newBuyOrder(){
        $action = "index.php?ctrl=sellOrder&action=store";
        require SERVER_ROOT . 'view/sellOrder/newOrder.php';
    }

    public function store(){
        if($this->sellOrderModel->newSellOrder($_POST)){
            $this->index();
        }else{
            echo "<script>window.alert(não foi incluido o pedido);</script>";
            $this->index();
        }
    }

}
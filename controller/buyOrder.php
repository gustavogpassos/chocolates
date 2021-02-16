<?php

require SERVER_ROOT.'model/buyOrderModel.php';
require SERVER_ROOT.'model/productModel.php';

class buyOrder
{
    private $buyOrderModel;
    private $productModel;

    public function __construct()
    {
        $this->buyOrderModel = new BuyOrderModel();
        $this->productModel= new ProductModel();
    }

    public function index(){
        $data = $this->buyOrderModel->index();
        require SERVER_ROOT . 'view/buyOrder/index.php';
    }

    public function newBuyOrder(){
        $action = "index.php?ctrl=buyOrder&action=store";
        require SERVER_ROOT . 'view/newBuyOrder.php';
    }

    public function store(){

    }

}
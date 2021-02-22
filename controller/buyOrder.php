<?php

require SERVER_ROOT . 'model/buyOrderModel.php';
require SERVER_ROOT . 'model/productModel.php';
require SERVER_ROOT . 'model/stockModel.php';

class BuyOrder
{
    private $buyOrderModel;
    private $productModel;
    private $stockModel;

    public function __construct()
    {
        $this->buyOrderModel = new BuyOrderModel();
        $this->productModel = new ProductModel();
        $this->stockModel = new StockModel();
    }

    public function index()
    {
        $data = $this->buyOrderModel->index();
        require SERVER_ROOT . 'view/buyOrder/index.php';
    }

    public function newBuyOrder()
    {
        $action = "index.php?ctrl=buyOrder&action=store";
        require SERVER_ROOT . 'view/buyOrder/form.php';
    }

    public function store()
    {
        $return = $this->buyOrderModel->storeBuyOrder($_POST);
        if (is_array($return)) {
            $counter = 0;
            $items = $_POST['products'];
            foreach ($items as $item) {
                if ($this->stockModel->updateStock($item['product_sku'], $item['quantity'], 'i')) {
                    $counter++;
                }
            }
            if(count($items) > $counter){
                $this->deleteOrder($return[0]);
                echo "<script>window.alert('Não foi possível atualizar o estoque, \n pedido de compra excluído');</script>";
            }
            $this->index();
        } else {
            echo "<script>window.alert('Não foi incluído o pedido');</script>";
            $this->index();
        }
    }

    public function getOder(){
        $id = $_GET['id'];
        $data = $this->buyOrderModel->getBuyOrder($id);
        $readonly = 'readonly';
        require 'view/buyOrder/form.php';
    }

    public function deleteOrder()
    {

    }

}
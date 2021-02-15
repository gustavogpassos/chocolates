<?php

require_once 'stockModel.php';

class SellOrderModel extends Connection
{
    private $stock;
    public function __construct()
    {
        parent::__construct();
        $stock = new StockModel();
    }

    public function index()
    {
        $select = "select * from sell_order";
        $query = $this->db->query($select);
        return $query->fetchAll();
    }

    public function newSellOrder($data)
    {
        $insertOrder = 'insert into sell_order (
                        client_id, 
                        amount,
                        payment_method, 
                        payment_condition) 
                        values (
                            :client_id,
                            :amount,
                            :payment_method,
                            :payment_condition)';

        $query = $this->db->prepare($insertOrder);

        $query->execute(array(
                'amount' => $data['amount'],
                'payment_method' => $data['payment_method'],
                'payment_condition' => $data['payment_condition'])
        );

        $getLastId = "select last_insert_id()";
        $query = $this->db->query($getLastId);

        $sellOrderId = $query->fetch();

        $insertOrderItem = "insert into sell_order_item (
                                sell_order_id, 
                                product_id,
                                un_value,
                                quantity,
                                total_value,
                                discount,
                                net_value)
                                values(
                                :sell_order_id, 
                                :product_id,
                                :un_value,
                                :quantity,
                                :total_value,
                                :discount,
                                :net_value
                                )";

        $items = $data['items'];
        $counter = 0;
        foreach ($items as $item) {
            $query = $this->db->prepare($insertOrderItem);
            $query->execute(array(
                'sell_order_id' => $sellOrderId[0],
                'product_id' => $item['product_id'],
                'un_value' => $item['un_value'],
                'quantity' => $item['quantity'],
                'total_value' => $item['total_value'],
                'discount' => $item['discount'],
                'net_value' => $item['net_value']
            ));
            if ($query) {
                $counter++;
                $r = $this->stock->updateStock($item['product_id'], $item['quantity'], 'o');
                if(!$r){return false;}
            }else{
                return false;
            }
        }
        if(count($items) == $counter){
            return true;
        }
    }

}
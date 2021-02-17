<?php

require_once SERVER_ROOT . 'lib/connection.php';

class BuyOrderModel extends Connection
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     * function returns a list fo all buy orders
     */
    public function index()
    {
        $select = "select * from buy_order";
        $query = $this->db->query($select);
        return $query->fetchAll();
    }

    /**
     * @param $data
     * @return bool
     *
     * funcção que insere uma nova ordem de compra
     * recebe as informações da ordem e dos itens da ordem
     */
    public function storeBuyOrder($data)
    {
        $insertOrder = 'insert into buy_order (amount,payment_method, payment_condition) values (:amount,:payment_method,:payment_condition)';

        $query = $this->db->prepare($insertOrder);

        $query->execute(array(
                'amount' => $data['amount'],
                'payment_method' => $data['payment_method'],
                'payment_condition' => $data['payment_condition'])
        );

        $getLastId = "select last_insert_id()";
        $query = $this->db->query($getLastId);

        $buyOrderId = $query->fetch();

        $insertOrderItem = "insert into buy_order_item (
                                buy_order_id, 
                                product_id,
                                un_value,
                                quantity,
                                total_value,
                                discount,
                                net_value)
                                values(
                                :buy_order_id, 
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
                'buy_order_id' => $buyOrderId[0],
                'product_id' => $item['product_id'],
                'un_value' => $item['un_value'],
                'quantity' => $item['quantity'],
                'total_value' => $item['total_value'],
                'discount' => $item['discount'],
                'net_value' => $item['net_value']
            ));
            if ($query) {
                $counter++;
            }else{
                return false;
            }
        }
        if(count($items) == $counter){
            return $buyOrderId;
        }
    }

}
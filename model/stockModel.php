<?php

require_once SERVER_ROOT . 'lib/connection.php';

class StockModel extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }


    public function updateStock($productId, $quantity, $updateType)
    {
        $month = new Date("m");
        $year = new Date("Y");
        $select = 'select * from adm_stock where month=:month and year=:year and product_id=:product_id';

        $return = '';

        $query = $this->db->prepare($select);
        if ($query->execute(array('month' => $month, 'year' => $year, 'product_id' => $productId))) {
            $return = $query->fetch();

            if ($updateType == 'i') {
                $return['qtd_in'] += $quantity;
                $return['qtd_actual'] += $quantity;

                $update = 'update adm_stock set
                            qtd_in=:qtd_in,
                            qtd_actual:qtd_actual
                            where id=:id';

                $query = $this->db->prepare($update);
                return $query->execute(array('qtd_in' => $return['qtd_in'],
                    'qtd_actual' => $return['qtd_actual'],
                    'id' => $return['id']));
            } elseif ($updateType == 'o') {
                $return['qtd_out'] += $quantity;
                $return['qtd_actual'] -= $quantity;

                $update = 'update adm_stock set
                            qtd_out=:qtd_in,
                            qtd_actual:qtd_actual
                            where id=:id';

                $query = $this->db->prepare($update);
                return $query->execute(array('qtd_out' => $return['qtd_out'],
                    'qtd_actual' => $return['qtd_actual'],
                    'id' => $return['id']));
            }

        } else {
            if ($updateType == 'i') {
                $insert = 'insert into adm_stock (month, year, product_id, qtd_in, qtd_actual)
                            values(:month, :year, :product_id, :qtd_in, :qtd_actual)';

                $query = $this->db->prepare($insert);
                return $query->execute(array('month' => $month,
                    'year' => $year,
                    'product_id' => $productId,
                    'qtd_in' => $quantity,
                    'qtd_actual' => $quantity));
            } elseif ($updateType == 'o') {
                $select = "select * from adm_stock 
                            where prudct_id=:product_id
                            order by id desc limit 1";
                $query = $this->db->prepare($select);
                if ($query->execute(array('product_id' => $productId))) {
                    $return = $query->fetch();
                    if ($return['qtd_actual'] == 0 || $return['qtd_actual'] < $quantity) {
                        return false;
                    }

                    $insert = 'insert into adm_stock (
                                month, 
                                year, 
                                product_id, 
                                qtd_previous_month, 
                                qtd_out,
                                qtd_actual)
                                values(
                                    :month, 
                                    :year, 
                                    :product_id, 
                                    :qtd_previous_month, 
                                    :qtd_out,
                                    :qtd_actual
                                )';

                    $query = $this->db->prepare($insert);

                    $r = $query->execute(array(
                        'month'=>$month,
                        'year'=>$year,
                        'product_id'=>$productId,
                        'qtd_previous_month'=>$return['qtd_actual'],
                        'qtd_out'=>$quantity,
                        'qtd_actual'=>$quantity
                    ));

                    if($r){
                        return true;
                    }else{
                        return false;
                    }

                } else {
                    return false;
                }
            }else{
                return false;
            }
        }


    }
}
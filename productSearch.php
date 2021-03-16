<?php


/**
 * Created by PhpStorm.
 * User: PC
 * Date: 13/10/2017
 * Time: 15:03


require 'controller/product.php';

$cont = new Product();

echo json_encode($cont->search($_POST));



*/

require_once 'lib/config.php';

require_once 'model/productModel.php';

$model = new ProductModel();

$r = $model->searchProduct($_POST['data']);

//print_r($r);

echo json_encode($r, true);

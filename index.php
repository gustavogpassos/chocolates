<?php
require_once 'lib/config.php';
require SERVER_ROOT . 'lib/adminController.php';

?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="./resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="./resources/css/custom.css">
    <script src="./resources/js/bootstrap.min.js"></script>

    <title>Controle de compra e venda</title>
</head>
<body>
<header>
    <div class="navbar navbar-expand-lg navbar-light bg-light">
        <a href="index.php" class="navbar-brand">Chocolates</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="index.php?ctrl=product" class="nav-link">Produtos</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?ctrl=client" class="nav-link">Clientes</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?ctrl=buyOrder" class="nav-link">Pedido de compra</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?ctrl=sellOrder" class="nav-link">Pedido de venda</a>
                </li>
            </ul>
        </div>
    </div>
</header>
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="card-body">
                        <?php if (!isset($_GET['ctrl']) && !isset($_GET['action'])) { ?>
                            <h3>Bem vindo</h3>
                            <h6>Escolha uma opção abaixo</h6>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <a href="index.php?ctrl=product" class="btn btn-outline-info">Product</a>
                                    <a href="index.php?ctrl=client" class="btn btn-outline-info">Client</a>
                                    <a href="index.php?ctrl=buyOrder" class="btn btn-outline-info">Buy Order</a>
                                    <a href="index.php?ctrl=sellOrder" class="btn btn-outline-info">Sell order</a>
                                </li>
                            </ul>
                        <?php } else {
                            $app = new AdminController();
                        } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>

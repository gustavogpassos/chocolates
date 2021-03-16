<?php
$today = date('Y-m-d');

?>

<div class="col col-12">
    <div class="col col-12" style="margin-bottom: 10px">
        <a href="index.php?ctrl=buyOrder" class="btn btn-outline-info"><i class="bi bi-chevron-left"></i> Voltar</a>
    </div>
    <hr/>
    <section>
        <div class="col-12">
            <h3 class="page-title"><?php echo isset($data) ? "Detalhes do pedido " . $data['id'] : "Novo pedido de compra"; ?></h3>
            <form action="<?= $action ?>" method="post">
                <div class="mb-3">
                    <input type="date" name="date" id="date" placeholder="Data" class="form-control"
                        <?php echo isset($data) ? 'value="' . $data['order_date'] . '" disabled' : 'value="' . $today . '" disabled' ?>
                           required>
                </div>
                <div class="mb-3">
                    <h4>Produtos</h4>

                    <?php
                    if (isset($data['items'])) {
                        foreach ($data['items'] as $item) {
                            ?>
                            <div class="form-inline">

                                <input type="text" name="sku" id="sku" value="<?= $item['sku'] ?>"
                                       class="form-control form-check-inline" required>
                                <input type="text" name="name" id="name" value="<?= $item['name'] ?>"
                                       class="form-control form-check-inline" required>
                                <input type="text" name="weight" id="weight" value="<?= $item['weight'] ?>"
                                       class="form-control form-check-inline" required>

                            </div>
                        <?php }
                    } else { ?>
                        <input type="text" name="product" id="product" class="form-control"
                               placeholder="Digite o código ou nome do produto" onkeyup="searchProduct(this.value)"/>
                        <div id="livesearch"></div>
                        <br/>
                        <div class="mb-3">
                            <table class="table" id="products">
                                <thead>
                                <td>SKU</td>
                                <td>Nome</td>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    <?php } ?>

                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-success" value="Salvar">
                    <a href="index.php?ctrl=buyOrder" class="btn btn-danger">Cancelar</a>
                </div>

            </form>
        </div>
    </section>
</div>


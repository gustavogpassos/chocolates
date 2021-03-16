<?php

?>

<div class="col col-12">
    <div class="col col-12" style="margin-bottom: 10px">
        <a href="index.php" class="btn btn-outline-info"><i class="bi bi-chevron-left"></i> Voltar</a>
        <a href="index.php?ctrl=buyOrder&action=newBuyOrder" class="btn btn-success"><i class="bi-plus-circle"></i>
            Novo</a>
    </div>
    <section>
        <div class="col-12">
            <table id="table" class="table table-hover">
                <thead>
                <tr>
                    <th>Nº</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Ver detalhes</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($data) && count($data) > 0) {
                    foreach ($data as $item) {
                        ?>
                        <tr>
                            <td><?= $item['id'] ?></td>
                            <td><?= $item['amount'] ?></td>
                            <td><?= $item['order_date'] ?></td>
                            <td>
                                <a href="index.php?ctrl=buyOrder&action=get&id=<?= $item['id'] ?>" aria-label="Ver mais"
                                   alt="Ver mais">
                                    <i class="bi-plus"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

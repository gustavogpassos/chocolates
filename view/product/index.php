<?php

?>

<div class="col col-12">
    <div class="col col-12" style="margin-bottom: 10px">
        <a href="index.php" class="btn btn-outline-info"><i class="bi bi-chevron-left"></i> Voltar</a>
        <a href="index.php?ctrl=product&action=newProduct" class="btn btn-success"><i class="bi-plus-circle"></i>
            Novo</a>
    </div>
    <section>
        <div class="col-12">
            <table id="table" class="table table-hover">
                <thead>
                <tr>
                    <th>SKU</th>
                    <th>Nome</th>
                    <th>Peso (g)</th>
                    <th>Editar</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($data) && count($data) > 0) {
                    foreach ($data as $item) {
                        ?>
                        <tr>
                            <td><?= $item['sku'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['weight'] ?></td>
                            <td>
                                <a href="index.php?ctrl=product&action=get&sku=<?= $item['sku'] ?>" aria-label="Editar"
                                   alt="Editar">
                                    <i class="bi-pencil-square"></i>
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

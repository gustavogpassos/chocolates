<?php

?>

<div class="col col-12">
    <div class="col col-12" style="margin-bottom: 10px">
        <a href="index.php" class="btn btn-outline-info"><i class="bi bi-chevron-left"></i> Voltar</a>
        <a href="index.php?ctrl=client&action=newClient" class="btn btn-success"><i class="bi-plus-circle"></i>
            Novo</a>
    </div>
    <section>
        <div class="col-12">
            <table id="table" class="table table-hover">
                <thead>
                <tr>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Contato</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($data) && count($data) > 0) {
                    foreach ($data as $item) {
                        ?>
                        <tr>
                            <td><?= $item['cpf'] ?></td>
                            <td><?= $item['name'] ?></td>
                            <td><?= $item['contact'] ?></td>
                            <td>
                                <a href="index.php?ctrl=client&action=get&sku=<?= $item['cpf'] ?>" aria-label="Editar"
                                   alt="Editar">
                                    <i class="bi-pencil-square"></i>
                                </a>
                            </td>
                            <td>
                                <a href="index.php?ctrl=client&action=delete&id=<?= $item['cpf'] ?>"
                                   aria-label="Excluir">
                                    <i class="bi-x-square"></i>
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

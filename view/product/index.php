<?php

?>

<div class="col col-12">
    <div class="col col-12" style="margin-bottom: 10px">
        <a href="index.php" class="btn btn-outline-info"><i class="bi bi-chevron-left"></i> Voltar</a>
        <a href="index.php?ctrl=product&action=newProduct" class="btn btn-success"><i class="bi-plus-circle"></i> Novo</a>
    </div>
    <section>
        <div class="col-12">
            <?php if (isset($data)) { print_r($data); ?>
                <table id="table" class="table table-hover">
                    <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Nome</th>
                        <th>Peso</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php ?>
                    </tbody>
                </table>
            <?php } else {
                echo "Cadastro de produtos";
            } ?>
        </div>
    </section>
</div>

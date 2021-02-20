<?php

?>

<div class="col col-12">
    <div class="col col-12" style="margin-bottom: 10px">
        <a href="index.php?ctrl=product" class="btn btn-outline-info"><i class="bi bi-chevron-left"></i> Voltar</a>
        <a href="index.php?ctrl=product&action=newProduct" class="btn btn-success"><i class="bi-plus-circle"></i>
            Novo</a>
    </div>
    <hr/>
    <section>
        <div class="col-12">
            <h3 class="page-title"><?php echo isset($data) ? "Editar registro" : "Novo produto"; ?></h3>
            <form action="<?= $action ?>" method="post">
                <div class="mb-3">
                    <input type="text" name="sku" id="sku" placeholder="SKU" class="form-control"
                        <?php echo isset($data)? 'value="'.$data['sku'].'" disabled':'' ?> required>
                </div>
                <div class="mb-3">
                    <input type="text" name="name" id="name" placeholder="Nome" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="weight" id="weight" placeholder="peso" class="form-control" required>
                </div>
                <div class="mb-3">
                    <input type="submit" class="btn btn-success" value="Salvar">
                    <a href="index.php?ctrl=product" class="btn btn-danger">Cancelar</a>
                </div>

            </form>
        </div>
    </section>
</div>


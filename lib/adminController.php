<?php

/**
 * Description of controlador
 *
 */
class AdminController {

    function __construct() {

        if (isset($_GET['ctrl'])) {

            $ctrNome = $_GET['ctrl'];

            if (!isset($_GET['action']))
                $acao = 'index';
            else
                $acao = $_GET['action'];

            $arq = './controller/' . $ctrNome . '.php';

            if (file_exists($arq)) {
                require $arq;

                $controlador = new $ctrNome();
                if (method_exists($controlador, $acao)) {
                    $controlador->$acao();
                } else {
                    $controlador->index();
                }
            } else {
                echo "<script>
                            window.alert('Caminho não encontrado');
                            window.location.href = \"index.php\";
                        </script>";
            }
        } else {
            echo '<h1>Bem vindo!</h1>';
        }
    }

}

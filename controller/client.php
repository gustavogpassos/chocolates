<?php

require SERVER_ROOT . 'model/clientModel.php';

class Client
{
    private $clientModel;

    public function __construct()
    {
        $this->clientModel = new ClientModel();
    }

    public function index(){
        $data = $this->clientModel->index();
        require SERVER_ROOT . 'view/client/index.php';
    }

    /**
     * @return boolean
     * função que chama o formulario para cadastrar um novo produto
     */
    public function newClient()
    {
        $action = 'index.php?ctrl=client&action=store';
        require SERVER_ROOT . 'view/client/form.php';
    }

    /**
     * função que envia os dados de um novo produto para cadastrar na base de dados
     */
    public function store(){
        $data = $_POST;
        try{
            $this->clientModel->newclient($data);
            print_r("produto cadastrado");
            $this->index();
        }catch (ErrorException $e){
            print_r($e);
        }
    }

    /**
     * função para atualizar os dados de um produto
     */
    public function update(){
        $data = $_POST;
        print_r($data);
        try {
            $this->clientModel->updateclient($data);
            print_r("cliente atualizado");
            $this->index();
        }catch (Exception $e) {
            print_r($e);
        }
    }

    /**
     * @return bool
     *
     * função para pesquisar um produto pelo nome ou código
     */
    public function search(){
        $search = $_POST;

        $result = $this->clientModel->searchClient($search);
        if(is_bool($result)){
            echo "Nenhum resultado";
        }else{
            return $result;
        }
    }

    /**
     * função que busca um cliente e inclui o formulario para edição dos dados
     */
    public function get(){
        $cpf = $_GET['cpf'];
        $action = 'index.php?ctrl=client&action=update';
        $data = $this->clientModel->getClient($cpf);
        require SERVER_ROOT . 'view/client/form.php';
    }

}
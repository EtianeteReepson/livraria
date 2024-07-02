<?php
include_once '../DAO/carrinhocompras.php';
include_once '../DTO/carrinhocompras.php';

class CarrinhoController
{
    private $carrinho;
    private $endpoint;
     private $method;
     public function __construct()
    {
    $this->carrinho = new carrinhoDAO();
    $this->endpoint = $_SERVER['PATH_INFO'];
    $this->method = $_SERVER['REQUEST_METHOD'];
    }

    public function processRequest(){
        header("Content-Type: application/json");

        switch ($this->method) {
                case 'GET':
                    if ($this->endpoint === 'carrinho') {
                        $result = $this->carrinho->getCarrinho();
                         echo json_encode($result);
                            }else if (preg_match('/^\/user\/(\d+)$/', $this->endpoint, $matches)) {
                                $id = $matches[1];
                                $result = $this->carrinho->getCarrinhoById($id);
                                echo json_encode([$result]);
                            }
                    }
                
                break;

                case 'POST':
                    if ($this->endpoint[0] == 'carrinho') {
                        $data = json_decode(file_get_contents('php://input'), true);
                        $result = $CarrinhoComprasController->addItemToCarrinho($data['cliente_id'], $data['livro_id'], $data['quantidade'], $data['datacriacao']);
                        echo json_encode(['success' => $result]);
                        
                    }
                break;

                case 'PUT':
                    if (isset($this->endpoint[0])) {
                        if ($this->endpoint[0] == 'carrinho' && isset($this->endpoint[1]) && is_numeric($this->endpoint[1])) {
                        $id = intval($this->endpoint[1]);
                        $data = json_decode(file_get_contents('php://input'), true);
                        $result = $CarrinhoComprasController->updateItemInCarrinho($data['cliente_id'], $data['livro_id'], $data['quantidade'], $data['datacriacao']);
                        echo json_encode(['success' => $result]);
                        }
                    }
                
                break;
                
                case 'DELETE':
                    if (isset($this->endpoint[0])) {
                      if ($this->endpoint[0] == 'carrinho' && isset($this->endpoint[1]) && is_numeric($this->endpoint[1])) {
                        $id = intval($this->endpoint[1]);
                        $result = $CarrinhoComprasController->deleteItemFromCarrinho($id);
                        echo json_encode(['success' => $result]);
                        }
                    }    
                break;
            }      

        }
          

    }


}
<?php
require_once './models/DAO/cliente.php';
require_once './models/DTO/cliente.php';
header('Content-Type:application/json');
class ClienteController
{
  private $cliente;
  private $endpoint;
  private $method;
  public function __construct()
  {
    $this->cliente = new clienteDAO();
    $this->endpoint = $_SERVER['PATH_INFO'];
    $this->method = $_SERVER['REQUEST_METHOD'];
  }

  public function processRequest()
  {
    header('Content-Type: application/json');
    switch ($this->method) {
      case 'GET':
        if ($this->endpoint === '/cliente') {
          $result = $this->cliente->getCliente();
          echo json_encode($result);
          }else if (preg_match('/^\/user\/(\d+)$/', $this->endpoint, $matches)) {
          $id = $matches[1];
          $result = $this->cliente->getClienteById($id);
          echo json_encode([$result]);
        }
        break;
        case 'POST':
          if ($this->endpoint === '/cliente/criar') {
            $data = json_decode(file_get_contents('php://input'), true); 
            $nome = $data['nome'];
            $apelido = $data['apelido'];
            $senha = $data['senha'];
            $email = $data['email'];
            $telefone = $data['telefone'];
            $nacionalidade = $data['nacionalidade'];
            $numerocartao = $data['numerocartao'];
            $numBI = $data['numBI'];
            $profissao = $data['profissao'];
            $morada = $data['morada'];
  
            $cliente = new clienteDTO(
              $nome,
              $apelido,
              $senha,
              $email,
              $telefone,
              $nacionalidade,
              $numerocartao,
              $numBI,
              $profissao,
              $morada
            );
            $result = $this->cliente->createCliente($cliente);
            echo json_encode($result);
          } else if ($this->endpoint === '/cliente/login') {
            $data = json_decode(file_get_contents('php://input'), true);
  
            $email = $data['email'];
            $senha = $data['senha'];
  
            $result = $this->cliente->loginCliente($email, $senha);
            echo json_encode([$result]);
          }
          break;
          case 'DELETE':
            if (preg_match('/^\/client\/(\d+)$/', $this->endpoint, $matches)) {
              $id = $matches[1];
              $result = $this->cliente->DeleteCliente($id);
              if ($result) {
                echo json_encode(['Cliente removido']);
              }
            }
            break;
    }
  }
}

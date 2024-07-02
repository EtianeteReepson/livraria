<?php
include_once '../DAO/autor.php';
include_once '../DTO/autor.php';
header('Content-Type:application/json');

class AutorController
{
    private $autor;
    private $endpoint;
    private $method;
    
    public function __construct()
    {
        $this->autor = new autorDAO();
        $this->endpoint = $_SERVER['PATH_INFO'];
        $this->method = $_SERVER['REQUEST_METHOD'];
    }
    public function processRequest(){
        header('Content-Type:application/json');
        switch ($this->method) {
            case 'GET':
                if ($this->endpoint === '/autor') {
                    $result = $this->autor->getAutor();
                    echo json_encode($result);
                  } else if (preg_match('/^\/user\/(\d+)$/', $this->endpoint, $matches)) {
                    $id = $matches[1];
                    $result = $this->autor->getAutorById($id);
                    echo json_encode([$result]);
                  }
            break;

            case 'POST':
                if ($this->endpoint === '/cliente/criar') {
                    $data = json_decode(file_get_contents('php://input'), true);
                    $result = $this->autor->createAutor($autor);
                    echo json_encode(['success' => $result]);
                }
            break;

            case 'PUT':
                if (isset($path[0])) {
                    if ($this->endpoint[0] == 'autores' && isset($path[1]) && is_numeric($this->endpoint[1])) {
                        $id = intval($this->endpoint[1]);
                        $data = json_decode(file_get_contents('php://input'), true);
                        $result = $this->autor->updateAutor($id, $data['nome'], $data['nacionalidade'], $data['apelido']);
                        echo json_encode(['success' => $result]);
                    }
                }
            break;

            case 'DELETE':
                if (isset($path[0])) {
                    if ($this->endpoint[0] == 'autores' && isset($path[1]) && is_numeric($this->endpoint[1])) {
                        $id = intval($this->endpoint[1]);
                        $result = $this->autor->deleteAutor($id);
                        echo json_encode(['success' => $result]);
                    }
                }
                break;
        }


    }
    
}
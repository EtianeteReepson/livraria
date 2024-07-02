<?php
require_once './models/DAO/livro.php';
require_once './models/DTO/livro.php';
header('Content-Type:application/json');


class LivroController
{
    private $livro;
    private $endpoint;  
    private $method;
    public function __construct()
    {
    $this->livro = new livroDAO();
    $this->endpoint = $_SERVER['PATH_INFO'];
    $this->method = $_SERVER['REQUEST_METHOD'];
    }
    public function processRequest()
    {
        header('Content-Type: application/json');
        switch ($this->method) {
                case 'GET':
                    if (isset($path[0]) && is_numeric($this->endpoint[0])) {
                    $id = intval($this->endpoint[0]);
                    $livro = $this->livro->getLivro();
                    echo json_encode($livro);
                    } else if (preg_match('/^\/user\/(\d+)$/', $this->endpoint, $matches)){
                        $id = $matches[1];
                        $result = $this->livro->getLivroById($id);
                        echo json_encode([$result]);
                    }
                break;
                case 'POST':
                    $data = json_decode(file_get_contents('php://input'), true);
                    $id = intval($this->endpoint[0]);
                    $titulo = $data['titulo'];
                    $ISBN = $data['ISBN'];
                    $editora = ['editora'];
                    $AnoPublicacao = ['AnoPublicacao'];
                    $idAutor = ['idAutor'];
                    $result = $this->livro->createLivro($livro);
                    echo json_encode($result);
                break;
                case 'PUT':
                    if (isset($path[0]) && is_numeric($this->endpoint[0])) {
                        $id = intval($this->endpoint[0]);
                        $data = json_decode(file_get_contents('php://input'), true);
                        $titulo = $data['titulo'];
                        $ISBN = $data['ISBN'];
                        $editora = ['editora'];
                        $AnoPublicacao = ['AnoPublicacao'];
                        $idAutor = ['idAutor'];
                        $livro = $this->livro->updateLivro($titulo, $ISBN, $editora, $AnoPublicacao, $idAutor);
                        echo json_encode(['success' => $livro]);
                    }
                break;
                case 'DELETE':
                    if (isset($path[0]) && is_numeric($this->endpoint[0])) {
                        $id = intval($this->endpoint[0]);
                        $result = $this->livro->deleteLivro($id);
                        echo json_encode(['success' => $result]);
                    }
                break;
                   
                default:
                    http_response_code(405);
                    echo json_encode(['error' => 'Method Not Allowed']);
                break;
        }        
        
    }

}
<?php
include_once '../Connect/Database.php';
include_once '../DTO/livro.php';


class LivroDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function getLivro() {
        $stm = $this->pdo->prepare("SELECT * FROM livro");
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLivroById($id) {
        $stm = $this->pdo->prepare("SELECT * FROM livro WHERE id = :id");
        
        $stm->bindParam(":id", $id);
        $stm->execute();

        return  $stm->fetch(PDO::FETCH_ASSOC);
    }

    public function createLivro(LivroDTO $livroDTO) {
        $query = "INSERT INTO livro (titulo, ISBN, editora, AnoPublicacao, idAutor) VALUES (:nome, :ISBN, :editora, :AnoPublicacao, :idAutor)";
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(":nome", $livroDTO->titulo);
        $stm->bindParam(":ISBN", $livroDTO->ISBN);
        $stm->bindParam(":editora", $livroDTO->editora);
        $stm->bindParam(":AnoPublicacao", $livroDTO->AnoPublicacao);
        $stm->bindParam(":idAutor", $livroDTO->idAutor);

        $stm->execute();
        return $stm;
    }

    public function updateLivro(LivroDTO $livroDTO) {
        $query = "UPDATE livro SET titulo = :titulo, ISBN = :ISBN, editora = :editora, AnoPublicacao = :AnoPublicacao, idAutor = :idAutor WHERE id = :id";
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(":nome", $livroDTO->titulo);
        $stm->bindParam(":ISBN", $livroDTO->ISBN);
        $stm->bindParam(":editora", $livroDTO->editora);
        $stm->bindParam(":AnoPublicacao", $livroDTO->AnoPublicacao);
        $stm->bindParam(":idAutor", $livroDTO->idAutor);

        $stm->execute();
        return $stm;
    }

    public function deleteLivro($id) {
        $query = "DELETE FROM livro WHERE id = id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
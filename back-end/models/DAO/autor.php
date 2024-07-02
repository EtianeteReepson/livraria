<?php
include_once '../Connect/Database.php';
include_once '../DTOto/autor.php';

class AutorDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function getAutor() {
        $query = "SELECT * FROM autor";
        $stm = $this->pdo->prepare($query);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAutorById($id) {
        $query = "SELECT * FROM autor WHERE id = :id";
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(1, $id);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createAutor($autor) {
        $query = "INSERT INTO autor (nome, nacionalidade, apelido, ) VALUES (:nome, :nacionalidade, :apelido)";
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(":nome", $autor->nome);
        $stm->bindParam(":apelido", $autor->apelido);
        $stm->bindParam(":nacionalidade", $autor->nacionalidade);
        if ($stm->execute()) {
            return true;
        }
        return false;
    }

    public function updateAutor($autor) {
        $query = "UPDATE autor SET nome = :nome, nacionalidade = :nacionalidade, apelido = :apelido WHERE id = :id";
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(":nome", $autor->nome);
        $stm->bindParam(":apelido", $autor->apelido);
        $stm->bindParam(":nacionalidade", $autor->nacionalidade);
        $stm->bindParam(":id", $id);
        if ($stm->execute()) {
            return true;
        }
        return false;
    }

    public function deleteAutor($id) {
        $query = "DELETE FROM autor WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
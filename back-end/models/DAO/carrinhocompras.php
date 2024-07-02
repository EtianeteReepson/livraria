<?php
include_once '../Connect/Database.php';
include_once '../DTO/carrinhocompras.php';

class CarrinhoDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function getCarrinhoByClienteId($cliente_id) {
        $query = "SELECT * FROM carrinhoCompras WHERE cliente_id = :cliente_id";
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(1, $cliente_id);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addItemToCarrinho(CarrinhoDTO $carrinhoDTO) {
        $query = "INSERT INTO carrinhoCompras (cliente_id, quantidade, datacriacao, livro_id) VALUES (:cliente_id, :quantidade, :datacriacao, :livro_id)";
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(":cliente_id", $carrinhoDTO->cliente_id);
        $stm->bindParam(":quantidade", $carrinhoDTO->quantidade);
        $stm->bindParam(":datacriacao", $carrinhoDTO->datacriacao);
        $stm->bindParam(":livro_id", $carrinhoDTO->livro_id);
       
        $stm->execute();
        return $stm;
    }

    public function updateItemInCarrinho($carrinhoDTO) {
        $query = "UPDATE carrinhoCompras SET quantidade = :quantidade WHERE id = :id";
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(":quantidade", $carrinhoDTO->quantidade);
        $stm->bindParam(":id", $carrinhoDTO->id);
        
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteItemFromCarrinho($id) {
        $query = "DELETE FROM carrinhoCompras WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(1, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
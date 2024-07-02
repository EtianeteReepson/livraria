<?php
include_once '../Connect/Database.php';
include_once '../DTO/cliente.php';

class ClienteDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function getCliente()
    {
      $stm = $this->pdo->prepare("SELECT * FROM cliente");
      $stm->execute();
  
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClienteById($id)
    {
      $stm = $this->pdo->prepare("SELECT * FROM cliente WHERE id = :id");
      $stm->bindParam(":id", $id);
      $stm->execute();
  
      return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createCliente( ClienteDTO $clienteDTO) {
        $query = "INSERT INTO cliente (nome, apelido, nacionalidade, email, senha, numerocartao, profissao, numBI, morada, telefone) VALUES (:nome, :apelido, :nacionalidade, :email, :senha, :numerocartao, :profissao, :numBI, :morada, :telefone)";
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(":nome", $clienteDTO->nome);
        $stm->bindParam(":apelido", $clienteDTO->apelido);
        $stm->bindParam(":nacionalidade", $clienteDTO->nacionalidade);
        $stm->bindParam(":email", $clienteDTO->email);
        $stm->bindParam(":senha", $clienteDTO->senha);
        $stm->bindParam(":numerocarato", $clienteDTO->numerocartao);
        $stm->bindParam(":profissao", $clienteDTO->profissao);
        $stm->bindParam(":numBI", $clienteDTO->numBI);
        $stm->bindParam(":morada", $clienteDTO->morada);
        $stm->bindParam(":telefone", $clienteDTO->telefone);

        $stm->execute();
        return $stm;
    }

    public function updateCliente(ClienteDTO $clienteDTO, $id) {
        $query = "UPDATE cliente SET nome = :nome, apelido = :apelido, nacionalidade = :nacionalidade, email = :email, senha = :senha, numerocartao = :numerocartao, profissao = :profissao, numBI = :numBI, morada = :morada, telefone = :telefone WHERE id = :id?";
        $stm = $this->pdo->prepare($query);
        $stm->bindParam(":nome", $clienteDTO->nome);
        $stm->bindParam(":apelido", $clienteDTO->apelido);
        $stm->bindParam(":nacionalidade", $clienteDTO->nacionalidade);
        $stm->bindParam(":email", $clienteDTO->email);
        $stm->bindParam(":senha", $clienteDTO->senha);
        $stm->bindParam(":numerocarato", $clienteDTO->numerocartao);
        $stm->bindParam(":profissao", $clienteDTO->profissao);
        $stm->bindParam(":numBI", $clienteDTO->numBI);
        $stm->bindParam(":morada", $clienteDTO->morada);
        $stm->bindParam(":telefone", $clienteDTO->telefone);
        $stm->bindParam(":id", $id);

        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteCliente($id) {
        $query = "DELETE FROM clientes WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam("id", $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function loginCliente($email, $senha){
      $stm = $this->pdo->prepare("SELECT * FROM cliente WHERE email = :email");
      $stm->bindParam(":email", $email);
      $stm->execute();

      $clienteDTO = $stm->fetch(PDO::FETCH_ASSOC);

      if ($clienteDTO && password_verify($senha, $clienteDTO['password'])) {
      $_SESSION['id'] = $clienteDTO['id'];
      return true;
      } else {
      return false;
      }
   }
}

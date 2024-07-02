<?php

class ClienteDTO{
    public $id;
    public $nome;
    public $apelido;
    public $nacionalidade;
    public $email;
    public $senha;
    public $numerocartao;
    public $profissao;
    public $numBI;
    public $morada;
    public $telefone;
    

    public function __construct($nome, $apelido, $nacionalidade, $email, $senha, $numerocartao, $profissao, $numBI, $morada, $telefone ){
         
        $this->nome = $nome;
        $this->apelido = $apelido;
        $this->nacionalidade = $nacionalidade;
        $this->email = $email;
        $this->senha = password_hash($senha, PASSWORD_DEFAULT);
        $this->numerocartao = $numerocartao;
        $this->profissao = $profissao;
        $this->numBI = $numBI;
        $this->morada = $morada;
        $this->telefone = $telefone;
    }
}
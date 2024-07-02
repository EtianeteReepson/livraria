<?php
class AutorDTO
{
    public $id;
    public$nome;
    public $nacionalidade;
    public $apelido;

    

    public function __construct($id, $nome, $apelido, $nacionalidade)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->apelido = $apelido;
        $this->nacionalidade = $nacionalidade;
    }
}
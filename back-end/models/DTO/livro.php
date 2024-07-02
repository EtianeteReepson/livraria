<?php


class LivroDTO
{
    public $id;
    public $titulo;
    public $ISBN;
    public $editora;
    public $AnoPublicacao;
    public $idAutor;

    public function __construct($id, $titulo, $ISBN, $editora, $AnoPublicacao, $idAutor){
        $this->id = $id;
        $this->titulo = $titulo;
        $this->ISBN = $ISBN;
        $this->editora = $editora;
        $this->AnoPublicacao = $AnoPublicacao;
        $this->idAutor = $idAutor;
    }
}
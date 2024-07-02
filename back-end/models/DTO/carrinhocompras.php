<?php
class CarrinhoDTO
{
    public $id;
    public $cliente_id;
    public $datacriacao;
    public $quantidade;
    public $livro_id;


    public function __construct($id, $cliente_id, $datacriacao, $quantidade, $livro_id)
    {
        $this->id = $id;
        $this->cliente_id = $cliente_id;
        $this->datacriacao = $datacriacao;
        $this->quantidade = $quantidade;
        $this->livro_id = $livro_id;

        
    }
}
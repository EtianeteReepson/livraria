<?php
require_once "./controllers/ClienteController.php";
require_once "./controllers/LivroController.php";
require_once "./controllers/CarrinhoComprasController.php";
require_once "./controllers/AutorController.php";


$cliente = new ClienteController();
$cliente->processRequest();

$livro = new LivroController();
$livro->processRequest();

$carrinho = new CarrinhoController();
$carrinho->processRequest();

$autor = new AutorController();
$autor->processRequest();


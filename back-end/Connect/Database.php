<?php

class Database
{
    public static function getConnection()
    {
        try {
            $pdo = new PDO("mysql:dbname=livraria;host=localhost", "root", "root");
            return $pdo;
        } catch (PDOException $err) {
            echo $err;
        }
    }
}

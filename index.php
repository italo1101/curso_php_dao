<?php
    require_once("config.php");

    // Carrega um único usuário pelo ID
    // $root = new Usuario();
    // $root->loadById(4);
    // echo $root; 

    // Carrega uma lista de todos os usuários
    // $lista = Usuario::getList();
    // echo json_encode($lista);

    // Carrega uma lista de usuários buscando pelo login

    // $search = Usuario::search("Marcelo");
    // echo json_encode($search);

    // carrega um usuário usando o login e senha

    $usuario = new Usuario();
    $usuario->login("Ednaldo", "12345678");

    echo $usuario;
?>
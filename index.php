<?php

require_once("config.php");
//====CAMPO ABAIXO CARREGA 1 USUARIO==========
//$root = new Usuario();
//$root->loadById(6);
//echo $root
//============================================

//========CARREGA LISTA DE USUARIOS==========
//$lista = Usuario::getList();
//echo json_encode($lista);
//===========================================

//=========CARREGAUMA LISTA DE USUARIOS BUSCANDO NO BANCO DE DADOS
//$search = Usuario::search("ro");
//echo json_encode($search);
//===========================================

//=========CARREGA USUARIO USANDO O LOGIN E SENHA
//$usuario = new Usuario();
//$usuario->login("user","123456");
//echo $usuario;

//========INSERE UM USER COM APOIO DE UMA PROCEDURE RODANDO NO BANCO DE DADOS
$aluno = new Usuario();

$aluno->setDeslogin("Carlos");
$aluno->setDessenha("1234");


$aluno->insert();

echo $aluno;
?>

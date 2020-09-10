<?php

require 'config.php';

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if($name && $email){

	$sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email"); // Validação de email existente
	$sql->bindValue(':email', $email);
	$sql->execute();

	if($sql->rowCount() === 0){ //Quantidade

	$sql = $pdo->prepare("INSERT INTO usuarios (nome, email) VALUES (:name, :email)");  //Inserção
	$sql->bindValue(':name', $name); //Transformar o valor
	$sql->bindValue(':email', $email); //Transformar o valor
	$sql->execute();

	header("Location: index.php");
	exit;
}else{
	header("Location: adicionar.php");
	exit;	
}

}
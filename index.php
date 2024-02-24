<!-- TODO1: PHP: Execute um script que conecte com um banco de dados suportado no servidor -->
<!-- TODO2: PHP: Execute um script que crie uma tabela 'produtos' -->
<!-- TODO3: PHP: Execute um script que liste as tabelas criadas -->
<!-- TODO4: PHP: Execute um script que liste as colunas da tabela 'produtos' -->
<!-- TODO5: PHP: Execute um script que insira um conteúdo na tabela 'produtos' -->
<!-- TODO6: PHP: Execute um script que exiba o conteúdo das tuplas da tabela 'produtos' -->


<!DOCTYPE html>
<html lang="bzs">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Comércio Eletrônico</title>

	<link rel="shortcut icon" href="favicon/favicon.ico" /> <!-- favicon.ico-->
	<link rel="stylesheet" type="text/css" href="css/estilos.css" />

	<!-- A ordem aqui eh importante: primeiro deve vir o 'jquery.js', depois scripts.js, porque este último utiliza 'jquery.js'-->
	<script src="js/jquery-3.7.1.js"></script>
	<script src="js/decimal.js"></script>
	<script src="js/scripts.js"></script>

</head>

<body>

	<!-- TODO1 -->
	<?php

	echo '<h3>Drivers BD:</h3>';
	
	$DATABASE = "mysql";
	$HOST = "localhost";
	$DBNAME = "papelaria"; //mysql> create database papelaria;
	$USER = "lucio";
	$PASSWORD = "root";

	$db = new PDO("$DATABASE: host=$HOST; dbname=$DBNAME", $USER, $PASSWORD);
	var_dump($db);
	?>

	<!-- TODO2 -->
	<?php 
	$res = $db->query("create table produtos( id int primary key not null, nome varchar(50) not null)");
	if($res){
		echo "<h2>Tabela produtos criada com sucesso!</h2>";
	} else {
		echo "<h2>ERRO2: Erro na criacao da tabela produtos.</h2>";
	}

	?>

	<!-- TODO3 -->
	<?php
	$res = $db->query("show tables;");
	if($res){
		$res->setFetchMode(PDO::FETCH_COLUMN, 0);
		$vetor = $res->fetchAll();
		
		foreach ($vetor as $tabela){
			echo '<h3>' . $tabela . "</h3><br/>";
		}

	} else {
		echo "<h2>ERRO3: Erro na listagem das tabelas.</h2>";
	}
	?>

	<!-- TODO4 -->
	<?php
	$res = $db->query("show columns from produtos");
	if($res){
		$res->setFetchMode(PDO::FETCH_COLUMN);
		$vetor = $res->fetchAll();
		
		//var_dump($vetor);

		foreach ($vetor as $coluna => $val){
			echo $coluna . ",";
			foreach($val as $item){
				echo $item . ",";
			}
			echo '<br>';
		}


	} else {
		echo "<h2>ERRO4: Erro na listagem das colunas da tabela.</h2>";
	}
	?>

	<!-- TODO5 -->
	<?php
	$res = $db->query("insert into produtos values ( 1, 'Lápis')");
	if($res){
		echo "<h2>INSERT: Produto inserido com sucesso!</h2>";
	} else {
		echo "<h2>ERRO2: Erro na inserção do produto.</h2>";
	}
	?>


	<!-- TODO6 -->
	<?php
	$res = $db->query("select * from produtos");
	if($res){
		$res->setFetchMode(PDO::FETCH_OBJ);

		while( $tupla = $res->fetch() ){ //recupera uma linha por vez
			foreach($tupla as $coluna){
				echo '<h3>' . $coluna . "</h3>";
			}
			echo '<br>';
		}
			
		
		echo "<h2>SELECT: Consulta realizada com sucesso!</h2>";
	} else {
		echo "<h2>ERRO2: Erro na inserção do produto.</h2>";
	}
	?>


</body>

</html>
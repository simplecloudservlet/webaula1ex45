<!-- TODO1: PHP: Execute um script que conecte com um banco de dados suportado no servidor -->
<!-- TODO2: PHP: Execute um script que crie uma tabela 'produtos' com os seguintes campos: id, nome-->
<!-- TODO3: PHP: Execute um script que liste as tabelas criadas -->
<!-- TODO4: PHP: Execute um script que liste as colunas da tabela 'produtos' -->
<!-- TODO5: PHP: Execute um script que insira um conteúdo na tabela 'produtos' -->
<!-- TODO6: PHP: Execute um script que exiba todas as colunas das tuplas da tabela 'produtos' -->
<!-- TODO7: PHP: Execute um script que exiba apenas a coluna 'nome' das tuplas da tabela 'produtos' -->
<!-- TODO8: PHP: Execute um script que exiba apenas a coluna 'nome' da tupla com 'id=1' da tabela 'produtos'  -->
<!-- TODO9: PHP: Execute um script que exiba as tuplas ordenadas em ordem crescente pelo 'nome'  -->
<!-- TODO10: PHP: Execute um script que crie uma visao (view) das tuplas ordenadas em ordem decrescente pelo 'nome'  -->
<!-- TODO11: PHP: Execute um script que altere o nome da tupla que contem 'nome=Borracha' para 'nome=Caderno'  -->

<!-- TODO12: PHP: Execute um script que remova o conteúdo das tuplas da tabela 'produtos' -->
<!-- TODO13: PHP: Execute um script que remova a tabela 'produtos' -->

<!-- TODO14: PHP: Apresente um exemplo com chave estrangeira. 
                  'produtos(id)' tal que 'id' eh chave primaria na tabela 'fornecedor'-->

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
	<div id="todo1" class="selecionado">
	<?php

	echo '<h3>Conexão com o BD</h3>';
	
	$DATABASE = "mysql";
	$HOST = "localhost";
	$DBNAME = "papelaria"; //mysql> create database papelaria;
	$USER = "lucio";
	$PASSWORD = "root";

	try {
		$db = new PDO("$DATABASE: host=$HOST; dbname=$DBNAME", $USER, $PASSWORD); //Para o MySQL
		var_dump($db);
	} catch(PDOException $e){
		echo '<h3>EXCEPTION1: ' . $e->getMessage();
	}
	
	


	?>
	</div>

	<!-- TODO14 -->
	<div id="todo14">
	<?php
	echo "<h3>TODO14</h3><br>";

	$res = $db->query("CREATE TABLE fornecedor( id int primary key not null, nome varchar(50) not null)");
	if($res){
		echo "<h3>CREATE: Criação da tabela 'fornecedor' realizada com sucesso!</h3>";
	} else {
		echo "<h3>ERRO14: Erro na criação da tabela.</h3>";
	}

	
	?>
	</div>

	<!-- TODO2 -->
	<div id="todo2" >
	<?php 
	echo "<h3>TODO2</h3><br>";

	$res = $db->query("CREATE TABLE produtos( id int primary key not null, nome varchar(50) not null, id_fornecedor int not null, foreign key(id_fornecedor) references fornecedor(id))");
	if($res){
		echo "<h3>CREATE: Criação da tabela 'produtos' realizada com sucesso!</h3>";
	} else {
		echo "<h3>ERRO2: Erro na criacao da tabela produtos, OU a tabela já foi criada.</h3>";
	}
	?>
	</div>

	<!-- TODO3 -->
	<div id="todo3" class="selecionado">
	<?php
	echo "<h3>TODO3</h3><br>";

	try {

		$res = $db->query("SHOW TABLES");
		if($res){
			$res->setFetchMode(PDO::FETCH_COLUMN, 0);
			$vetor = $res->fetchAll();
		
			foreach ($vetor as $tabela){
				echo '<h3>' . $tabela . "</h3><br/>";
			}

		} else {
			echo "<h3>ERRO3: Erro na listagem das tabelas.</h3>";
		}

	} catch(PDOException $e){
		echo '<h3>EXCEPTION3: ' . $e->getMessage();
	}
	
	?>
	</div>

	<!-- TODO4 -->
	<div id="todo4" >
	<?php
	echo "<h3>TODO4</h3><br>";

	$res = $db->query("SHOW COLUMNS FROM produtos");
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
	</div>

	<!-- TODO5 -->
	<div id="todo5" class="selecionado">
	<?php
	echo "<h3>TODO5</h3><br>";

	$res = $db->query("INSERT INTO fornecedor VALUES ( 1, 'UTFPR1')");

	$res = $db->query("INSERT INTO fornecedor VALUES ( 2, 'UTFPR2')");

	$res = $db->query("INSERT INTO produtos VALUES ( 1, 'Lápis', 2)");
	$res = $db->query("INSERT INTO produtos(id,nome,id_fornecedor) values ( 2, 'Borracha', 1)");
	if($res){
		echo "<h3>INSERT: Produto inserido com sucesso!</h3>";
	} else {
		echo "<h3>ERRO5: Erro na inserção do produto.</h3>";
	}
	?>
	</div>


	<!-- TODO6 -->
	<div id="todo6">
	<?php
	echo "<h3>TODO6</h3><br>";

	$res = $db->query("SELECT * FROM produtos");
	if($res){
		$res->setFetchMode(PDO::FETCH_OBJ);

		while( $tupla = $res->fetch() ){ //recupera uma linha por vez
			echo '<h3>';
			foreach($tupla as $coluna){
				echo $coluna . ", ";
			}
			echo '</h3><br>';
		}

		echo "<h3>SELECT: Consulta realizada com sucesso!</h3>";
	} else {
		echo "<h3>ERRO6: Erro na consulta.</h3>";
	}
	?>
	</div>

	<!-- TODO7 -->
	<div id="todo7" class="selecionado">
	<?php
	echo "<h3>TODO7</h3><br>";

	$res = $db->query("SELECT nome FROM produtos");
	if($res){
		$res->setFetchMode(PDO::FETCH_OBJ);

		
		while( $tupla = $res->fetch() ){ //recupera uma linha por vez
			echo '<h3>';
			foreach($tupla as $coluna){
				echo $coluna . ", ";
			}
			echo '</h3><br>';
		}
		

		echo "<h3>SELECT: Consulta realizada com sucesso!</h3>";
	} else {
		echo "<h3>ERRO7: Erro na consulta.</h3>";
	}
	?>
	</div>


	<!-- TODO8 -->
	<div id="todo8">
	<?php
	echo "<h3>TODO8</h3><br>";

	$res = $db->query("SELECT nome FROM produtos WHERE id=1");
	if($res){
		$res->setFetchMode(PDO::FETCH_OBJ);

		while( $tupla = $res->fetch() ){ //recupera uma linha por vez
			foreach($tupla as $coluna){
				echo '<h3>' . $coluna . "</h3>";
			}
			echo '<br>';
		}
		echo "<h3>SELECT: Consulta realizada com sucesso!</h3>";
	} else {
		echo "<h3>ERRO8: Erro na consulta.</h3>";
	}
	?>
	</div>

	<!-- TODO9 -->
	<div id="todo9" class="selecionado">
	<?php
	echo "<h3>TODO9</h3><br>";

	$res = $db->query("SELECT nome FROM produtos ORDER BY nome");
	if($res){
		$res->setFetchMode(PDO::FETCH_OBJ);

		while( $tupla = $res->fetch() ){ //recupera uma linha por vez
			foreach($tupla as $coluna){
				echo '<h3>' . $coluna . "</h3>";
			}
			echo '<br>';
		}
		echo "<h3>SELECT: Consulta realizada com sucesso!</h3>";
	} else {
		echo "<h3>ERRO9: Erro na consulta.</h3>";
	}
	?>
	</div>

	<!-- TODO10 -->
	<div id="todo10">
	<?php
	echo "<h3>TODO10</h3><br>";

	$res = $db->query("CREATE VIEW visaoDesc AS SELECT nome FROM produtos ORDER BY nome DESC");
	$res = $db->query("SELECT nome FROM visaoDesc");

	if($res){
		$res->setFetchMode(PDO::FETCH_OBJ);

		while( $tupla = $res->fetch() ){ //recupera uma linha por vez
			foreach($tupla as $coluna){
				echo '<h3>' . $coluna . "</h3>";
			}
			echo '<br>';
		}
		echo "<h3>SELECT: Consulta realizada com sucesso!</h3>";
	} else {
		echo "<h3>ERRO10: Erro na consulta.</h3>";
	}
	?>
	</div>

	<!-- TODO11 -->
	<div id="todo11" class="selecionado">
	<?php
	echo "<h3>TODO11</h3><br>";

	$res = $db->query("UPDATE produtos SET nome='Caderno' WHERE nome='Borracha'");
	$res = $db->query("SELECT * FROM produtos");

	if($res){
		$res->setFetchMode(PDO::FETCH_OBJ);

		while( $tupla = $res->fetch() ){ //recupera uma linha por vez
			echo '<h3>';
			foreach($tupla as $coluna){
				echo $coluna . ", ";
			}
			echo '</h3><br>';
		}

		echo "<h3>SELECT: Consulta realizada com sucesso!</h3>";
	} else {
		echo "<h3>ERRO11: Erro na consulta.</h3>";
	}
	?>
	</div>



	<!-- TODO12 -->
	<div id="todo12" >
	<?php
	echo "<h3>TODO12</h3><br>";

	$res = $db->query("delete from produtos where id > 0");
	if($res){
		echo "<h3>DELETE: Remoção das tuplas realizada com sucesso!</h3>";
	} else {
		echo "<h3>ERRO12: Erro na remoção da tupla.</h3>";
	}
	?>
	</div>

	<!-- TODO13 -->
	<div id="todo13" class="selecionado">
	<?php
	echo "<h3>TODO13</h3><br>";

	
	$res = $db->query("drop table produtos");
	if($res){
		echo "<h3>DELETE: Remoção da tabela 'produtos' realizada com sucesso!</h3>";
	} else {
		echo "<h3>ERRO13b: Erro na remoção da tabela.</h3>";
	}

	$res = $db->query("drop table fornecedor");
	if($res){
		echo "<h3>DELETE: Remoção da tabela 'fornecedor' realizada com sucesso!</h3>";
	} else {
		echo "<h3>ERRO13a: Erro na remoção da tabela.</h3>";
	}

	$res = $db->query("drop view visaoDesc");
	if($res){
		echo "<h3>DELETE: Remoção da visao 'visaoDesc' realizada com sucesso!</h3>";
	} else {
		echo "<h3>ERRO13c: Erro na remoção da visao.</h3>";
	}

	

	

	?>
	</div>

	


</body>

</html>
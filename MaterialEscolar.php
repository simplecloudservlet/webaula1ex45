
<?php 
class MaterialEscolar {

private $nome;
private $codigo;
private $email;

public function __construct($nome1, $codigo1, $email1){
	//A linguagem nao aceita 'variaveis nos parametros' de mesmo nome das 'variaveis de instancia'
	$this->nome = $nome1;
	$this->codigo = $codigo1;
	$this->email = $email1;
}

public function getDados(){
	return [$this->nome, $this->codigo, $this->email, $this->getCor(), $this->getTamanho()];
}

public function exibir(){
	//Eh necessario usar '$this' para metodos e variaveis
	$dados = $this->getDados();
	
	foreach($dados as $item){
		echo '<h2>' . $item . '</h2>';
	}
}		
public function getNome(){
	return $this->nome;
}
public function getCodigo(){
	return $this->codigo;
}
public function getEmail(){
	return $this->email;
}

}

?>
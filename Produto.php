<?php

final class Produto extends MaterialEscolar {

	private $cor;
	private $tamanho;
	public function __construct($nome1, $codigo1, $email1, $cor1, $tamanho1){

		//Construtor da superclasse
		parent::__construct($nome1, $codigo1, $email1);

		$this->cor = $cor1;
		$this->tamanho = $tamanho1;
	}
	public function getCor(){
		return $this->cor;
	}
	public function getTamanho(){
		return $this->tamanho;
	}

}

?>
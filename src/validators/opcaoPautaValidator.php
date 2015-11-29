<?php

require_once MODEL_PATH . 'opcao_pauta.php';

class OpcaoPautaValidator{

	private $opcao_pauta;
	private $erros_validacao;

	public function __construct($opcao_pauta){
		$this->opcao_pauta = $opcao_pauta;
		$this->erros_validacao = array();
	}

    function validar_informacoes(){
        if(empty($this->opcao_pauta->titulo))
        	array_push($this->erros_validacao, 'Favor, informe um título.');

        if(empty($this->opcao_pauta->descricao))
        	array_push($this->erros_validacao, 'Favor, informe uma descrição.');

        return $this->erros_validacao;
    }
}

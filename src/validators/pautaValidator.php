<?php

require_once MODEL_PATH . 'pauta.php';

class PautaValidator{

	private $pauta;
	private $erros_validacao;

	public function __construct($pauta){
		$this->pauta = $pauta;
		$this->erros_validacao = array();
	}

    function validar_informacoes(){
        if(empty($this->pauta->titulo))
        	array_push($this->erros_validacao, 'Favor, informe um título.');

        if(empty($this->pauta->descricao))
        	array_push($this->erros_validacao, 'Favor, informe uma descrição.');

        if(empty($this->pauta->data_inicio))
        	array_push($this->erros_validacao, 'Favor, informe uma data de abertura.');

        if(empty($this->pauta->data_fim))
        	array_push($this->erros_validacao, 'Favor, informe uma data de fechamento.');

        if($this->pauta->data_inicio > $this->pauta->data_fim)
        	array_push($this->erros_validacao, 'A data de abertura da pauta deve ser menor que sua data de fechamento.');
            
        return $this->erros_validacao;
    }
}

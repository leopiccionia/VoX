<?php

require_once MODEL_PATH . 'pauta.php';

class PesquisaValidator{

	private $dados_pesquisa;
	private $erros_validacao;

	public function __construct($dados_pesquisa){
		$this->dados_pesquisa = $dados_pesquisa;
		$this->erros_validacao = array();
	}

    function validar_informacoes(){
    	if(empty($this->dados_pesquisa->titulo) && empty($this->dados_pesquisa->data_fim) && empty($this->dados_pesquisa->data_inicio))
    		array_push($this->erros_validacao, 'Favor, informe o valor de pelo menos um dos campos.');

        if(!empty($this->dados_pesquisa->data_inicio) && !empty($this->dados_pesquisa->data_fim))
        {
            if($this->dados_pesquisa->data_inicio > $this->dados_pesquisa->data_fim)
                array_push($this->erros_validacao, 'A data de abertura da pauta deve ser menor que sua data de fechamento.');    
        }
        return $this->erros_validacao;
    }
}

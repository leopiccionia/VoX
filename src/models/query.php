<?php

require_once APP_PATH . 'controller.php';

class Query extends Controller{

	private $titulo;
    private $data_inicio;
    private $data_fim;
    private $tipo_pesquisa;

    public function __construct($titulo, $data_inicio, $data_fim, $senha_repetida){
		parent::__construct();
		$this->titulo = $titulo;
		$this->data_inicio = $data_inicio;
		$this->data_fim = $data_fim;

		$this->definir_tipo_pesquisa();
	}

	public function pesquisar(){

	}

	private function definir_tipo_pesquisa(){

	}

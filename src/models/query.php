<?php

require_once APP_PATH . 'controller.php';
require_once MODEL_PATH . 'pauta.php';

class Query extends Controller{

	public $titulo;
    public $data_inicio;
    public $data_fim;
    private $clausula_where_query;
    private $query_busca;
    private $resultados_pesquisa;

    public function __construct($titulo = null, $data_inicio = null, $data_fim = null){
		parent::__construct();

		if($titulo)
			$titulo = trim($titulo);

		$this->titulo = $titulo;
		$this->data_inicio = ($data_inicio) ? $this->transformarStringEmData($data_inicio) : $data_inicio;
		$this->data_fim = ($data_fim) ? $this->transformarStringEmData($data_fim) : $data_fim;
		$this->montar_clausula_where_query();
		$this->resultados_pesquisa = array();
	}

	public function pesquisar(){

		$conexao = $this->abrir_conexao();
		$query = mysqli_query($conexao, $this->query_busca);

		while($row = mysqli_fetch_array($query))
		{
			$pauta = new Pauta($row['titulo'], $row['descricao'], $row['data_inicio'], $row['data_fim'], $row['pauta_id']);
			array_push($this->resultados_pesquisa, $pauta);
		}
		return $this->resultados_pesquisa;
	}

	private function montar_clausula_where_query(){
		$this->query_titulo();
		$this->query_data_inicio();
		$this->query_data_fim();

		$this->query_busca = 'SELECT * FROM pauta WHERE' . $this->clausula_where_query;
	}

	private function query_titulo(){
		if($this->titulo)
		{
			$this->verifica_necessidade_comando_AND();
			$this->clausula_where_query .= " titulo='{$this->titulo}'";				
		}
	}

	private function query_data_inicio(){
		if($this->data_inicio)
		{
			$this->verifica_necessidade_comando_AND();
			$this->clausula_where_query .= " data_inicio >= '{$this->data_inicio}'";						
		}
	}

	private function query_data_fim(){
		if($this->data_fim)
		{
			$this->verifica_necessidade_comando_AND();
			$this->clausula_where_query .= " data_fim <= '{$this->data_fim}'";						
		}	
	}

	private function verifica_necessidade_comando_AND(){
		if(strlen($this->clausula_where_query) > 0)
			$this->clausula_where_query .= " AND";
	}

    private function transformarStringEmData($data){
        $novoFormato = str_replace('/', '-', $data);
        return date('Y-m-d', strtotime($novoFormato));
    }
}

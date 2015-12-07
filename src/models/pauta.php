<?php
require_once APP_PATH . 'controller.php';
require_once MODEL_PATH . 'usuario.php';
require_once MODEL_PATH . 'opcao_pauta.php';

class Pauta extends Controller{
    
    public $pauta_id;
    public $titulo;
    public $descricao;
    public $data_criacao;
    public $data_inicio;
    public $data_fim;
    public $autor;
        
    function __construct($titulo, $descricao, $data_inicio, $data_fim, $pauta_id = null){
        parent::__construct();

        $this->pauta_id = $pauta_id;
        $this->titulo = mysql_real_escape_string($titulo);
        $this->descricao = mysql_real_escape_string($descricao);

        $this->data_inicio = $this->transformarStringEmData($data_inicio);
        $this->data_fim = $this->transformarStringEmData($data_fim);

        $this->autor = (int)$_SESSION['usuario']->get_id();
    }
    
    public function cadastrar(){
		try{
			$conexao = $this->abrir_conexao();
			$query = mysqli_query($conexao, "INSERT INTO pauta(autor_id, titulo, descricao, data_criacao, data_inicio, data_fim) VALUES({$this->autor}, '{$this->titulo}', '{$this->descricao}', NOW(), '{$this->data_inicio}', '{$this->data_fim}')");
            return $query;
		}
		catch(Exception $e){
			return false;
		}
    }

    public function buscar_mais_recente(){
        $conexao = $this->abrir_conexao();
        $query = mysqli_query($conexao, "SELECT pauta_id FROM pauta WHERE autor_id = {$this->autor} ORDER BY pauta_id DESC LIMIT 1");

        if($row = mysqli_fetch_array($query))
            return $row['pauta_id'];

        return -1;
    }
    
    public function buscar_opcoes_pauta($id){
        $opcoes = array();
        $conexao = $this->abrir_conexao();
        $query = mysqli_query($conexao, "SELECT opcao_id, titulo, descricao FROM opcao_pauta WHERE pauta_id = $id");
        while($row = mysqli_fetch_array($query))
        {
            $opcao = new OpcaoPauta($row['titulo'], $row['descricao'], $id);
            $opcao->id = $row['opcao_id'];
            array_push($opcoes, $opcao);
        }
        return $opcoes;
    }

    private function transformarStringEmData($data){
        $novoFormato = str_replace('/', '-', $data);
        return date('Y-m-d', strtotime($novoFormato));
    }

    public static function encontrar_pauta_por_id($id){

        $db_file = file_get_contents(APP_PATH . 'assets/private.json');
        $db_json = json_decode($db_file, true);

        $db_servidor = $db_json[ENV]['database']['server'];
        $db_usuario = $db_json[ENV]['database']['username'];
        $db_senha = $db_json[ENV]['database']['password'];
        $db_nome = $db_json[ENV]['database']['name'];

        $conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha, $db_nome);
        $query = mysqli_query($conexao, "SELECT * FROM pauta WHERE pauta_id = $id");

        if($row = mysqli_fetch_array($query))
        {
            $pauta = new Pauta($row['titulo'], $row['descricao'], $row['data_inicio'], $row['data_fim'], $row['pauta_id']);
            $pauta->data_criacao = $row['data_criacao'];

            return $pauta;
        }
        

        return null;
    }
}
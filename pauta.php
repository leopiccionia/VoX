<?php
require_once 'controller.php';
require_once 'opcao_pauta.php';

class Pauta extends Controller{
    
    public $titulo;
    public $descricao;
    public $data_criacao;
    public $data_inicio;
    public $data_fim;
    public $autor;
        
    function __construct($titulo, $descricao, $data_inicio, $data_fim, $data_criacao = null){
        parent::__construct();
        
        if($data_criacao == null)
            $this->data_criacao = time();

        $this->titulo = mysql_real_escape_string($titulo);
        $this->descricao = mysql_real_escape_string($descricao);
        $this->data_inicio = strtotime($data_inicio);
        $this->data_fim = strtotime($data_fim);
        $this->autor = (int)$_SESSION['usuario']->id;
    }
    
    function validar(){
        if(empty($this->titulo) || empty($this->data_inicio) || empty($this->data_fim))
            return false;

        if(empty($this->data_inicio) || empty($this->data_fim) || $this->data_inicio > $this->data_fim)
            return false;

        return true;
    }
    
    function cadastrar(){
		try{
			$conexao = mysqli_connect($this->db_servidor, $this->db_usuario, $this->db_senha, $this->db_nome);
			if(mysqli_query($conexao, "INSERT INTO pauta(autor_id, titulo, descricao, data_criacao, data_inicio, data_fim) VALUES($this->autor, '$this->titulo', '$this->descricao', NOW(), '$this->data_inicio', '$this->data_fim')"))
            {
			    $id_query = mysqli_query($conexao, "SELECT pauta_id FROM pauta WHERE autor_id = {$this->autor} ORDER BY pauta_id DESC LIMIT 1");
			    if($row = mysqli_fetch_array($id_query))
			        return $row['pauta_id'];
			    else
			        return -1;
			}
			else
			    return -1;
		}
		catch(Exception $e){
			return -1;
		}
    }
    
    function opcoes(){
        $opcoes = array();
        $conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
        $query = mysqli_query($conexao, "SELECT opcao_id, titulo, descricao FROM opcao_pauta WHERE pauta_id = $id");
        while($row = mysqli_fetch_array($query)){
            $opcao = new OpcaoPauta();
            $opcao->id = $row['id'];
            $opcao->titulo = $row['titulo'];
            $opcao->descricao = $row['descricao'];
            array_push($opcoes, $opcao);
        }
        return $opcoes;
    }
}
?>
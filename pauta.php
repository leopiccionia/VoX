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
        
    function __construct($titulo, $descricao, $data_inicio, $data_fim, $autor, $data_criacao = null){
        parent::__construct();
        if($data_criacao == null)
            $this->$data_criacao = time();
        $this->$titulo = mysql_real_escape_string($titulo);
        $this->$descricao = mysql_real_escape_string($descricao);
        $this->$data_inicio = strtotime($data_inicio);
        $this->$data_fim = strtotime($data_fim);
        $this->$autor = $autor;
    }
    
    function valida(){
        if(empty($titulo) || empty($data_inicio) || empty($data_fim))
            return false;
        if(empty($data_inicio) || empty($data_fim) || $data_inicio > $data_fim)
            return false;
        return true;
    }
    
    function cadastra(){
		try{
			$conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
			if(mysqli_query($conexao, "INSERT INTO pauta(autor_id, titulo, descricao, data_criacao, data_inicio, data_fim) VALUES($autor, '$titulo', '$descricao', NOW(), '$data_inicio', '$data_fim')")){
			    $id_query = mysqli_query($conexao, "SELECT pauta_id FROM pauta WHERE autor_id = $autor ORDER BY pauta_id DESC LIMIT 1");
			    if($row = mysqli_fetch_array($id_query))
			        return $row['pauta_id'];
			    else
			        return -1;
			}
			else
			    return -1;
		}
		catch(Exception $e){
			return false;
		}
    }
    
    function opcoes(){
        $opcoes = array();
        $conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
        $query = mysqli_query($conexao, "SELECT opcao_id, titulo, descricao FROM opcao_pauta WHERE pauta_id = $id");
        while($row = mysqli_fetch_array($query)){
            $opcao = new OpcaoPauta();
            $opcao->$id = $row['id'];
            $opcao->$titulo = $row['titulo'];
            $opcao->$descricao = $row['descricao'];
            array_push($opcoes, $opcao);
        }
        return $opcoes;
    }
}
?>
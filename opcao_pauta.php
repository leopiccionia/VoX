<?php
    require_once 'controller.php';
    
    class OpcaoPauta extends Controller{
        public $id;
        public $titulo;
        public $descricao;
        
        public function __construct($titulo, $descricao, $pauta){
            parent::__construct();
            $this->titulo = $titulo;
            $this->descricao = $descricao;
            $this->pauta = $pauta;
        }
    
        public function cadastrar(){
            try{
                $conexao = mysqli_connect($this->db_servidor, $this->db_usuario, $this->db_senha, $this->db_nome);
                return mysqli_query($conexao, "INSERT INTO opcao_pauta(titulo, descricao, pauta_id) VALUES('$this->titulo', '$this->descricao', $this->pauta)");
            }
            catch(Exception $e){
                return false;
            }
        }
    }
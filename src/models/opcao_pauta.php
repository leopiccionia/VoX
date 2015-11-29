<?php
    require_once APP_PATH . 'controller.php';
    
    class OpcaoPauta extends Controller{
        public $titulo;
        public $descricao;
        public $pauta_id;
        
        public function __construct($titulo, $descricao, $pauta_id){
            parent::__construct();
            $this->titulo = $titulo;
            $this->descricao = $descricao;
            $this->pauta_id = $pauta_id;
        }
    
        public function cadastrar(){
            try{
                $conexao = $this->abrir_conexao();
                return mysqli_query($conexao, "INSERT INTO opcao_pauta(titulo, descricao, pauta_id) VALUES('{$this->titulo}', '{$this->descricao}', {$this->pauta_id})");
            }
            catch(Exception $e){
                return false;
            }
        }
    }
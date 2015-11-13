<?php
    require_once 'controller.php';
    
    class OpcaoPauta extends Controller{
        public $id;
        public $titulo;
        public $descricao;
        
        public function __construct($titulo, $descricao, $pauta){
            parent::__construct();
            $this->$titulo = $titulo;
            $this->$descricao = $descricao;
            $this->$pauta = $pauta;
        }
    
        public function cadastra(){
            try{
                $conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
                return mysqli_query($conexao, "INSERT INTO opcao_pauta(titulo, descricao, pauta_id) VALUES('$titulo', '$descricao', $pauta)");
            }
            catch(Exception $e){
                return false;
            }
        }
        
    }
?>
<?php
    require_once 'controller.php';
    
    class OpcaoPauta extends Controller{
        public $id;
        public $titulo;
        public $descricao;
        public $pauta;
        
        public function __construct(){
            parent::__construct();
        }
    }
?>
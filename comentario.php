<?php
    require_once 'controller.php';

    class Comentario extends Controller{
        public $id;
        public $autor;
        public $autor_nome;
        public $conteudo;
        public $tipo;
        
        public function renderizar(){
            switch($this->tipo){
                case 'T':
                    return "<p>{$this->conteudo}</p>";
                case 'U':
                    return "<p><a href='{$this->conteudo}'>{$this->conteudo}</a></p>";
                case 'V':
                    return "<iframe width='320' height='240' src='{$this->conteudo}'><p><a href='{$this->conteudo}'>{$this->conteudo}</a></p></iframe>";
            }
        }
    }
?>
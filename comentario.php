<?php
    require_once 'controller.php';

    class Comentario extends Controller{
        public $id;
        public $opcao;
        public $autor;
        public $autor_nome;
        public $conteudo;
        public $tipo;
        
        const REGEX_YOUTUBE_VIDEO = '#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#';
        
        public function renderizar(){
            switch($this->tipo){
                case 'T':
                    return "<p>{$this->conteudo}</p>";
                case 'U':
                    return "<p><a href='{$this->conteudo}'>{$this->conteudo}</a></p>";
                case 'V':
                    return "<iframe width='320' height='240' src='http://www.youtube.com/embed/{$this->conteudo}'><p><a href='{$this->conteudo}'>{$this->conteudo}</a></p></iframe>";
            }
        }
        
        public function validar(){
            if(!isset($this->tipo) || !isset($this->conteudo))
                return false;
            switch($this->tipo){
                case 'U':
                    if(filter_var($this->conteudo, FILTER_VALIDATE_URL) == false)
                        return false;
                    return true;
                case 'V':
                    if(preg_match(REGEX_YOUTUBE_VIDEO, $this->conteudo) != 1)
                        return false;
                    return true;
                default:
                    return true;
            }
        }
        
        public function cadastrar(){
            try{
                $conexao = mysqli_connect($this->db_servidor, $this->db_usuario, $this->db_senha, $this->db_nome);
                return mysqli_query($conexao, "INSERT INTO comentario(opcao_id, autor_id, conteudo, tipo) VALUES({$this->opcao}, {$this->autor}, '" .conteudoSanitizado() ."', '{$this->tipo}'");
            }
            catch(Exception $e){
                return false;
            }
        }
        
        private function conteudoSanitizado(){
            switch($this->tipo){
                case 'U':
                    return filter_var($this->conteudo, FILTER_VALIDATE_URL);
                case 'V':
                    $matches = array();
                    preg_match(REGEX_YOUTUBE_VIDEO, $this->conteudo, $matches);
                    return $matches[1];
                default:
                    return $this->conteudo;
            }
        }
    }
?>
<?php
    require_once APP_PATH . 'controller.php';
    require_once MODEL_PATH . 'comentario.php';
    
    class OpcaoPauta extends Controller{
        public $id;
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
        
        public function contarComentarios(){
            $conexao = $this->abrir_conexao();
            $query = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM comentario WHERE opcao_id = {$this->id}");
            mysqli_close($conexao);

            if($row = mysqli_fetch_array($query))
                return $row['total'];
                
            return 0;        
        }
        
        public function obterComentarios(){
            $conexao = $this->abrir_conexao();
            $query = mysqli_query($conexao, "SELECT c.comentario_id, c.conteudo, c.tipo, c.autor_id, u.nome as autor_nome FROM comentario INNER JOIN usuario u ON c.autor_id = u.usuario_id WHERE pauta_id = {$this->pauta_id}");
            $resultado = array();
            while($row = mysqli_fetch_array($query)){
                $comentario = new Comentario();
                $comentario->id = $row['id'];
                $comentario->autor_nome = $row['autor_nome'];
                $comentario->autor = $row['autor_id'];
                $comentario->conteudo = $row['conteudo'];
                $comentario->tipo = $row['tipo'];
                array_push($resultado, $comentario);
            }
            mysqli_close($conexao);
            return $resultado;
        }
        
    }
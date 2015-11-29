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
        
        /* SPRINT 3 */
        
        public function contarComentarios(){
            $conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
            $query = mysqli_query($conexao, "SELECT COUNT(*) AS total FROM comentario WHERE pauta_id = {$this->id}");
            $row = mysqli_fetch_assoc($query);
            mysqli_close($conexao);
            return $row['total'];
        }
        
        public function obterComentarios(){
            $conexao = mysqli_connect($db_servidor, $db_usuario, $db_senha);
            $query = mysqli_query($conexao, "SELECT c.id, c.conteudo, c.tipo, c.autor_id, u.nome as autor_nome FROM comentario INNER JOIN usuario u ON c.autor_id = u.if WHERE pauta_id = {$this->id}");
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
        
        /* FIM SPRINT 3 */
    
    }
?>
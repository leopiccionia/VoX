<?php
class Pauta{
    
    public $titulo;
    public $descricao;
    public $data_inicio;
    public $data_fim;
        
    function _construct($titulo, $descricao, $data_inicio, $data_fim){
        $this->$titulo = mysql_real_escape_string($titulo);
        $this->$descricao = mysql_real_escape_string($descricao);
        $this->$data_inicio = strtotime($data_inicio);
        $this->$data_fim = strtotime($data_fim);
    }
    
    function valida(){
        if(empty($titulo) || empty($data_inicio) || empty($data_fim))
            return false;
        if(empty($data_inicio) || empty($data_fim) || $data_inicio > $data_fim)
            return false;
        return true;
    }
    
}
?>
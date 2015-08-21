<?php

class Error
{
    public $codigo;
    public $idRegistro;
    public $tabla;
    public $error;
    
    public function __construct($code, $id, $table,  $message){
        $this->codigo = $code;
        $this->idRegistro = $id;
        $this->tabla = $table;
        $this->error = $message;
    }
    
}

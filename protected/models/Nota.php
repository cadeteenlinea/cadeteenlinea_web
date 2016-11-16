<?php

/*
 * Clase encargada de los metodos generales de las clases NotasParciales y Notas Finales
 */
class Nota {
    
    public static function deleteZero($dato){
        if($dato=='0'){
            $dato = '';
        }
        return $dato;
    }
}

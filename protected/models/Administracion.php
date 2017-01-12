<?php

class Administracion
{
    
    public static function reiniciarTodo(){
        Administracion::deleteCalificaciones();
        Administracion::deleteNotasParciales();
        Administracion::deleteNotasFinales();
        Administracion::deleteNotasFisico();
        Administracion::deleteNivelacion();
        Administracion::deleteTransaccion();
        Administracion::deleteInglesTae();
        Administracion::deleteAsignatura();
        Administracion::deleteFranco();
        Administracion::deleteResumen();
        Administracion::deleteCadeteApoderado();
        Administracion::deleteCadete();
        Administracion::deleteApoderado();
        Administracion::deleteUsuarioNoticia();
        Administracion::deleteUsuarios();
    }
    
    public static function deleteUsuarios(){
        Yii::app()->db->createCommand('delete from usuario WHERE perfil <> "funcionario";')->query();
    }
    
    public static function deleteCalificaciones(){
        Yii::app()->db->createCommand('delete from calificaciones;')->query();
    }
    
    public static function deleteNotasParciales(){
        Yii::app()->db->createCommand('delete from notas_parciales;')->query();
    }
    
    public static function deleteNotasFinales(){
        Yii::app()->db->createCommand('delete from notas_finales;')->query();
    }
    
    public static function deleteNotasFisico(){
        Yii::app()->db->createCommand('delete from notas_fisico;')->query();
    }
    
    public static function deleteNivelacion(){
        Yii::app()->db->createCommand('delete from nivelacion;')->query();
    }
    
    public static function deleteTransaccion(){
        Yii::app()->db->createCommand('delete from transaccion;')->query();
    }
    
    public static function deleteInglesTae(){
        Yii::app()->db->createCommand('delete from ingles_tae;')->query();
    }
    
    public static function deleteAsignatura(){
        Yii::app()->db->createCommand('delete from asignatura;')->query();
    }
    
    public static function deleteFranco(){
        Yii::app()->db->createCommand('delete from francos;')->query();
    }
    
    public static function deleteResumen(){
        Yii::app()->db->createCommand('delete from resumen;')->query();
    }
    
    public static function deleteCadeteApoderado(){
        Yii::app()->db->createCommand('delete from cadete_apoderado;')->query();
    }
    
    public static function deleteCadete(){
        Yii::app()->db->createCommand('delete from cadete;')->query();
    }
    
    public static function deleteApoderado(){
        Yii::app()->db->createCommand('delete from apoderado;')->query();
    }
    
    public static function deleteUsuarioNoticia(){
        Yii::app()->db->createCommand('delete from usuario_noticia;')->query();
    }
    
    public static function deleteFinanzas(){
        Yii::app()->db->createCommand('delete from transaccion;')->query();
    }
}


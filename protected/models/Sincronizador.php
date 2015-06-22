<?php

class Sincronizador
{
    public static function cargadoGeneral($stringJson, $tipo){
        $objects = CJSON::decode($stringJson);
        $errors = array();
        
        foreach($objects as $obj){
             switch ($tipo) {
                 case "cadete":
                     $sincronizador = new Sincronizador();
                    $model = $sincronizador->cargadoClaseCadete($obj);
                 break;
             }
             /*if(count($model->getErrors())>0){
                foreach($model->getErrors() as $error){
                   $errors[] = array("rut"=>$model->rut, "error"=>$error);
                }
             }else{
                 $errors[] = array("identificador"=>$model->rut, "error"=>"Actualizado/Ingresado");
             }*/
             $errors[] = array("error" => $model->getErrors());
        }
        //$respuesta = array($errors);
        return $errors;
    }
    
    private function cargadoClaseCadete($cad){
        $cadete = Cadete::model()->findByPk($cad["rut"]);
        $usuario = Usuario::model()->findByPk($cad["rut"]);
        if(empty($cadete)){
            $cadete = new Cadete();
            $cadete->rut = $cad["rut"];
        }
                    
        if(empty($usuario)){
            $usuario = new Usuario();
            $usuario->rut = $cad["rut"];
            $usuario->password_2 = substr($cad["rut"], -5);
            $usuario->apellidoPat = $cad["apellidoPaterno"];
            $usuario->apellidoMat = $cad["apellidoMaterno"];
            $usuario->nombres = $cad["nombres"];
            $usuario->perfil = 'cadete';
            $usuario->email = 'seb.frab@gmail.com';
            if(!$usuario->save()){
                return $usuario;
            }
        }
        $cadete->nCadete = $cad["nCadete"];
        $cadete->direccion = $cad["direccion"];
        $cadete->comuna = $cad["comuna"];
        $cadete->ciudad = $cad["ciudad"];
        $cadete->region = $cad["region"];
        $cadete->curso = $cad["curso"];
        $cadete->division = $cad["division"];
        $cadete->anoIngreso = $cad["anoIngreso"];
        $cadete->anoNacimiento = $cad["anoNacimiento"];
        $cadete->mesNacimiento = $cad["mesNacimiento"];
        $cadete->diaNacimiento = $cad["diaNacimiento"];
        $cadete->lugarNacimiento = $cad["lugarNacimiento"];
        $cadete->nacionalidad = $cad["nacionalidad"];
        $cadete->seleccion = $cad["seleccion"];
        $cadete->nivel = $cad["nivel"];
        $cadete->circulo = $cad["circulo"];
        $especialidad = Especialidad::model()->findEspecialidadLetra($cad["especialidad"]);
        $cadete->especialidad_idespecialidad = null;
        if(!empty($especialidad))
            $cadete->especialidad_idespecialidad = $especialidad->idespecialidad;
        
        if($cadete->save()){
            return $cadete;
        }else{
            if(!empty($usuario)){
                if($usuario->delete()){
                    return $cadete;
                }
            }
            return $cadete;
        }
    }
}
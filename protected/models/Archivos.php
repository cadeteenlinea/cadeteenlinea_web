<?php

/**
 * This is the model class for table "archivos".
 *
 * The followings are the available columns in table 'archivos':
 * @property integer $idarchivos
 * @property string $fecha
 * @property integer $tipo_archivo_idtipo_archivo
 *
 * The followings are the available model relations:
 * @property TipoArchivo $tipoArchivo
 */
class Archivos extends CActiveRecord
{
	public $archivo;
        
	public function tableName()
	{
		return 'archivos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo_archivo_idtipo_archivo, fecha, archivo', 'required'),
			array('tipo_archivo_idtipo_archivo', 'numerical', 'integerOnly'=>true),
                        array('archivo', 'file', 'types'=>'csv'),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idarchivos, fecha, tipo_archivo_idtipo_archivo', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tipoArchivo' => array(self::BELONGS_TO, 'TipoArchivo', 'tipo_archivo_idtipo_archivo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idarchivos' => '#',
			'fecha' => 'Fecha',
			'tipo_archivo_idtipo_archivo' => 'Tabla',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idarchivos',$this->idarchivos);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('tipo_archivo_idtipo_archivo',$this->tipo_archivo_idtipo_archivo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Archivos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function publicarArchivo(){
            $lineas = file("./csv/".$this->idarchivos.".csv");
            $i=1;
            $errors = array();
            $countErrors=0;
            $countSuccess=0;
            
            if($this->tipoArchivo->tabla_sincronizar=="cadete_apoderado"){
                Yii::app()->db->createCommand('truncate table cadete_apoderado')->execute();
            }
            /*if($this->tipoArchivo->tabla_sincronizar=="cadete"){
                Yii::app()->db->createCommand('TRUNCATE TABLE cadete')->execute();
                Yii::app()->db->createCommand('DELETE FROM usuario WHERE perfil = "cadete"')->execute();
            }*/
            
            foreach ($lineas as $linea_num => $linea)
            {
                if($i>1){
                    $datos = explode(";", $linea);
                    switch ($this->tipoArchivo->tabla_sincronizar) {
                        case "cadete":
                            $model = $this->cargadoClaseCadete($datos);
                            break;
                        case "apoderado":
                            $model = $this->cargadoClaseApoderado($datos);
                            break;
                        case "cadete_apoderado":
                            $model = $this->cargadoClaseCadeteApoderado($datos);
                            break;
                        case "transaccion":
                            $model = $this->cargadoClaseTransacciones($datos);
                            break;
                    }
                    $errors[] = array("columna"=>$i, "error" => $model->getErrors());
                    if(!empty($model->getErrors())){
                        $countErrors++;
                    }else{
                        $countSuccess++;
                    }
                }
                $i++;
            }
            $respuesta = array($errors, $countErrors, $countSuccess);
            return $respuesta;
        }
        
        private function cargadoClaseCadete($datos){
            $rut = substr(strtolower($datos[1]),0,-2);
            $cadete = Cadete::model()->findByPk($rut);
            $usuario = Usuario::model()->findByPk($rut);
            if(empty($cadete)){
                $cadete = new Cadete();
                $cadete->rut = $rut;
            }
            
            if(empty($usuario)){
                $usuario = new Usuario();
                $usuario->rut = $rut;
                $usuario->password_2 = substr($rut, -5);
                $usuario->apellidoPat = $datos[2];
                $usuario->apellidoMat = $datos[3];
                $usuario->nombres = $datos[4];
                $usuario->perfil = 'cadete';
                $usuario->email = 'seb.frab@gmail.com';
                if(!$usuario->save()){
                    return $usuario;
                }
            }

            $cadete->nCadete = $datos[0];
            $cadete->direccion = $datos[15];
            $cadete->comuna = $datos[16];
            $cadete->ciudad = $datos[17];
            $cadete->region = $datos[18];
            $cadete->curso = $datos[5];
            $cadete->division = $datos[8];
            $cadete->anoIngreso = $datos[9];
            $cadete->anoNacimiento = $datos[10];
            $cadete->mesNacimiento = $datos[11];
            $cadete->diaNacimiento = $datos[12];
            $cadete->lugarNacimiento = $datos[13];
            $cadete->nacionalidad = $datos[14];
            $cadete->seleccion = $datos[23];
            $cadete->nivel = $datos[24];
            $cadete->circulo = $datos[25];
            $especialidad = Especialidad::model()->findEspecialidadLetra($datos[6]);
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
        
        private function cargadoClaseApoderado($datos){
            $rut = substr(strtolower($datos[3]),0,-2);
            $apoderado = Apoderado::model()->findByPk($rut);
            $usuario = Usuario::model()->findByPk($rut);
            
            if(empty($apoderado)){
                $apoderado = new Apoderado();
                $apoderado->rut = $rut;
            }
            
            if(empty($usuario)){
                $usuario = new Usuario();
                $usuario->rut = $rut;
                $usuario->password_2 = substr($rut, -5);
                $usuario->apellidoPat = $datos[0];
                $usuario->apellidoMat = $datos[1];
                $usuario->nombres = $datos[2];
                $usuario->perfil = 'apoderado';
                $usuario->email = 'seb.frab@gmail.com';
                if(!$usuario->save()){
                    return $usuario;
                }
            }
            
            $apoderado->direccion = $datos[4];
            $apoderado->comuna = $datos[5];
            $apoderado->region = $datos[6];
            $apoderado->fono = $datos[9];
            $apoderado->fonoComercial = $datos[10];
            if(empty($datos[12])){
                $apoderado->difunto = "no";  
            }else{
               if($datos[12]=="N"){
                   $apoderado->difunto = "no"; 
               }else{
                   $apoderado->difunto = "si"; 
               }
            }
            
            if($apoderado->save()){
                return $apoderado;
            }else{
                if(!empty($usuario)){
                    $usuario->delete();
                }
                return $apoderado;
            }
        }
        
        private function cargadoClaseCadeteApoderado($datos){
            $nCadete = $datos[0];
            $rutApoderado = substr(strtolower($datos[1]),0,-2);
            
            $criteria = new CDbCriteria;
            $criteria->addCondition("nCadete=".$nCadete);
            $cadete = Cadete::model()->find($criteria);
            
            $apoderado = Apoderado::model()->findByPk($rutApoderado);
            
            $tipo = "";
            switch ($datos[2]) {
                case "PA":
                    $tipo = "Padre";
                    break;
                case "MA":
                    $tipo = "Madre";
                    break;
                case "AT":
                    $tipo = "Apoderado Titular";
                    break;
                case "AS":
                    $tipo = "Apoderado suplente";
                    break;
            }
            
            if(!empty($cadete)){
                if(!empty($apoderado)){
                    $criteria = new CDbCriteria;
                    $criteria->addCondition("cadete_rut=".$cadete->rut);
                    $criteria->addCondition("apoderado_rut=".$apoderado->rut);
                    $relacion = CadeteApoderado::model()->find($criteria);
                    
                    if(empty($relacion)){
                        $relacion = new CadeteApoderado();
                        $relacion->cadete_rut = $cadete->rut;
                        $relacion->apoderado_rut = $apoderado->rut;
                    }
                    $relacion->tipoApoderado = $tipo;
                    
                    if($relacion->save()){
                        return $relacion;
                    }else{
                        return $relacion;
                    }
                }else{
                    $apoderado = new Apoderado();
                    $apoderado->addError('rut','Apoderado no registrado');
                    return $apoderado;
                }
            }else{
                $cadete = new Cadete();
                $cadete->addError('rut','Cadete no registrado');
                return $cadete;
            }
        }
        
        public function subirArchivo(){
            $ext = $this->archivo->getExtensionName();
            $path="csv/$this->idarchivos.$ext";
            if($this->archivo->saveAs($path)){    
                return true;
            }else{
                return false;
            }
        }
        
        protected function afterDelete(){
            parent::afterDelete();
            unlink('csv/'.$this->idarchivos.'.csv');
        }
         
        private function cargadoClaseTransacciones($datos){
            $cadete = Cadete::model()->findByPk($datos[1]);
            
            if(!empty($cadete)){
                $transaccion = Transaccion::model()->findByPk($datos[0]);
                if(empty($transaccion)){
                    $transaccion = new Transaccion();
                }
                $transaccion->idtransaccion = $datos[0];
                $transaccion->cadete_rut = $datos[1];
                $transaccion->tipoTransaccion = $datos[2];
                $transaccion->monto = $datos[3];
                $transaccion->fechaMovimiento = $datos[4];
                $transaccion->descripcion = $datos[5];
                if(trim($datos[6])=="Colegiatura")
                    $transaccion->tipoCuenta = "Colegiatura";
                else if(trim($datos[6])=="Cta Cte")
                    $transaccion->tipoCuenta = "Cta Cte";
                else
                    $transaccion->tipoCuenta = "Equipo";
                
                if($transaccion->save()){
                    return $transaccion;
                }else{
                    return $transaccion;
                }
                
            }else{
                $cadete = new Cadete();
                $cadete->addError('rut','Cadete no registrado');
                return $cadete;
            }
        }
         
}

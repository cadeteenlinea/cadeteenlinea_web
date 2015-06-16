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
			'tipo_archivo_idtipo_archivo' => 'Tipo Archivo',
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
            
            $lineas = file("./txt/".$this->idarchivos.".csv");
            $i=1;
            $errors = array();
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
                    }
                    $errors[] = array("columna"=>$i, "error" => $model->getErrors());
                }
                $i++;
            }
            return $errors;
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
                $usuario->password_2 = $rut;
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
            $cadete->especialidad_idespecialidad = 1;
            
            if($cadete->save()){
                return $cadete;
            }else{
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
                $usuario->password_2 = $rut;
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
                return $apoderado;
            }
        }
        
}

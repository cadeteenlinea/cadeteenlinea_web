<?php

/**
 * This is the model class for table "cadete".
 *
 * The followings are the available columns in table 'cadete':
 * @property string $rut
 * @property string $nCadete
 * @property string $direccion
 * @property string $comuna
 * @property string $ciudad
 * @property string $region
 * @property string $curso
 * @property string $division
 * @property string $anoIngreso
 * @property string $anoNacimiento
 * @property string $mesNacimiento
 * @property string $diaNacimiento
 * @property string $lugarNacimiento
 * @property string $nacionalidad
 * @property string $seleccion
 * @property string $nivel
 * @property string $circulo
 * @property integer $especialidad_idespecialidad
 *
 * The followings are the available model relations:
 * @property Usuario $rut0
 * @property Especialidad $especialidad
 * @property CadeteApoderado[] $cadeteApoderados
 * @property NotasParciales[] $notasParciales
 * @property Transaccion[] $transaccions
 * @property NotasFinales[] $notasFinales
 * @property InglesTae[] $inglesTae
 * @property InglesTae[] $calificaciones
 */
class Cadete extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cadete';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut, nCadete, curso, anoIngreso, nacionalidad, especialidad_idespecialidad', 'required'),
			array('especialidad_idespecialidad', 'numerical', 'integerOnly'=>true),
			array('rut, nCadete, anoIngreso, anoNacimiento, mesNacimiento, diaNacimiento', 'length', 'max'=>10),
			array('direccion, lugarNacimiento', 'length', 'max'=>100),
			array('comuna, ciudad, region, nacionalidad, seleccion, nivel, circulo', 'length', 'max'=>25),
                        array('circulo', 'length', 'max'=>25),
			array('curso', 'length', 'max'=>2),
			array('division', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rut, nCadete, direccion, comuna, ciudad, region, curso, division, anoIngreso, anoNacimiento, mesNacimiento, diaNacimiento, lugarNacimiento, nacionalidad, seleccion, nivel, circulo, especialidad_idespecialidad', 'safe', 'on'=>'search'),
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
                        'usuario' => array(self::BELONGS_TO, 'Usuario', 'rut'),
			'cadeteApoderados' => array(self::HAS_MANY, 'CadeteApoderado', 'cadete_rut'),
			'transacciones' => array(self::HAS_MANY, 'Transaccion', 'cadete_rut', 
                            'order'=>'transacciones.fechaMovimiento ASC'),
                        'sumTransacciones'=>array(self::STAT,  'Transaccion', 'invoice_id', 'select' => 'SUM(amount)'),
			'especialidad' => array(self::BELONGS_TO, 'Especialidad', 'especialidad_idespecialidad'),
			'notasFinales' => array(self::HAS_MANY, 'NotasFinales', 'cadete_rut'),
			'inglesTae' => array(self::HAS_MANY, 'InglesTae', 'cadete_rut'),
                        'calificaciones' => array(self::HAS_MANY, 'Calificaciones', 'cadete_rut'),
			'notasParciales' => array(self::HAS_MANY, 'NotasParciales', 'cadete_rut'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rut' => 'Rut',
			'nCadete' => 'N° Cadete',
			'direccion' => 'Direccion',
			'comuna' => 'Comuna',
			'ciudad' => 'Ciudad',
			'region' => 'Region',
			'curso' => 'Curso',
			'division' => 'Division',
			'anoIngreso' => 'Ano Ingreso',
			'anoNacimiento' => 'Ano Nacimiento',
			'mesNacimiento' => 'Mes Nacimiento',
			'diaNacimiento' => 'Dia Nacimiento',
			'lugarNacimiento' => 'Lugar Nacimiento',
			'nacionalidad' => 'Nacionalidad',
			'seleccion' => 'Seleccion',
			'nivel' => 'Nivel',
			'circulo' => 'Circulo',
			'especialidad_idespecialidad' => 'Especialidad Idespecialidad',
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

		$criteria->compare('rut',$this->rut,true);
		$criteria->compare('nCadete',$this->nCadete,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('comuna',$this->comuna,true);
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('curso',$this->curso,true);
		$criteria->compare('division',$this->division,true);
		$criteria->compare('anoIngreso',$this->anoIngreso,true);
		$criteria->compare('anoNacimiento',$this->anoNacimiento,true);
		$criteria->compare('mesNacimiento',$this->mesNacimiento,true);
		$criteria->compare('diaNacimiento',$this->diaNacimiento,true);
		$criteria->compare('lugarNacimiento',$this->lugarNacimiento,true);
		$criteria->compare('nacionalidad',$this->nacionalidad,true);
		$criteria->compare('seleccion',$this->seleccion,true);
		$criteria->compare('nivel',$this->nivel,true);
		$criteria->compare('circulo',$this->circulo,true);
		$criteria->compare('especialidad_idespecialidad',$this->especialidad_idespecialidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Cadete the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        function beforeDelete(){
            if( $this->cadeteApoderados !== array() )
                return false;
            if( $this->transacciones !== array() )
                return false;
            if( $this->notasFinales !== array() )
                return false;
            if( $this->notasParciales !== array() )
                return false;
            return parent::beforeDelete();
        }
        
        //retorn la visualización del atributo nCadete, el cual en el sistema
        //se guarda como int, pero por estandar de la escuela la visualizacion
        //es de formato 000, es decir de 3 digitos
        public function getnCadeteView()
        {
            return str_pad($this->nCadete, 3, "0", STR_PAD_LEFT);
        }
        
        public function getCursoNumero(){
            return substr($this->curso, 0,1);
        }
        
        
        //retorna todas las transacciones que tiene el cadete, según
        //ano y tipo de cuenta
        public function getTransacciones($ano=null, $tipoCuenta){
            $criteria=new CDbCriteria;
            $criteria->addCondition("rut=$this->rut","AND");
            $criteria->addCondition("transacciones.tipoCuenta='$tipoCuenta'","AND");
            if($ano!=null)
                $criteria->addCondition("YEAR(transacciones.fechaMovimiento)='$ano'","AND");
            return $this->with('transacciones')->find($criteria);
        }
        
        public function getNotasParcialesAsignatura($idAsignatura){
            $criteria=new CDbCriteria;
            $criteria->addCondition('t.asignatura_idasignatura='.$idAsignatura);
            $criteria->addCondition('t.cadete_rut='.$this->rut);
            $model = NotasParciales::model()->findAll($criteria);
            return $model;
        }
        
        public function getPromedioNotasParcialesAsignatura($idAsignatura){
            $criteria=new CDbCriteria;
            $criteria->select = "AVG(t.nota) as 'nota'"; 
            $criteria->addCondition('t.asignatura_idasignatura='.$idAsignatura);
            $criteria->addCondition('t.cadete_rut='.$this->rut);
            $model = NotasParciales::model()->find($criteria);
            return round($model->nota,1);
        }
        
        public function getCalificacionesAnoSemestre($ano, $semestre){
            $criteria = new CDbCriteria();
            //$criteria->with = array('calificaciones');
            $criteria->addCondition('ano='.$ano);
            $criteria->addCondition('semestre='.$semestre);
            $criteria->addCondition('cadete_rut='.$this->rut);
            $model = Calificaciones::model()->find($criteria);
            return $model;
        }
}

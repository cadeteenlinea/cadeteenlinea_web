<?php

/**
 * This is the model class for table "cadete".
 *
 * The followings are the available columns in table 'cadete':
 * @property string $rut
 * @property string $ncadete
 * @property string $apellidoPat
 * @property string $apellidoMat
 * @property string $nombres
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
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Usuario $rut0
 * @property CadeteApoderado[] $cadeteApoderados
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
			array('rut, ncadete, apellidoPat, apellidoMat, nombres, direccion, comuna, ciudad, region, curso, division, anoIngreso, anoNacimiento, mesNacimiento, diaNacimiento, lugarNacimiento, nacionalidad, seleccion, nivel', 'required'),
			array('rut, ncadete, anoIngreso, anoNacimiento, mesNacimiento, diaNacimiento', 'length', 'max'=>10),
			array('apellidoPat, apellidoMat, comuna, ciudad, region, nacionalidad, seleccion, nivel, circulo, email', 'length', 'max'=>25),
			array('nombres', 'length', 'max'=>50),
			array('direccion, lugarNacimiento', 'length', 'max'=>100),
			array('curso', 'length', 'max'=>2),
			array('division', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rut, ncadete, apellidoPat, apellidoMat, nombres, direccion, comuna, ciudad, region, curso, division, anoIngreso, anoNacimiento, mesNacimiento, diaNacimiento, lugarNacimiento, nacionalidad, seleccion, nivel, circulo, email', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rut' => 'Rut',
			'ncadete' => 'Ncadete',
			'apellidoPat' => 'Apellido Pat',
			'apellidoMat' => 'Apellido Mat',
			'nombres' => 'Nombres',
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
			'email' => 'Email',
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
		$criteria->compare('ncadete',$this->ncadete,true);
		$criteria->compare('apellidoPat',$this->apellidoPat,true);
		$criteria->compare('apellidoMat',$this->apellidoMat,true);
		$criteria->compare('nombres',$this->nombres,true);
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
		$criteria->compare('email',$this->email,true);

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
        
        public function getnCadeteView()
        {
            return str_pad($this->nCadete, 3, "0", STR_PAD_LEFT);
        }
}

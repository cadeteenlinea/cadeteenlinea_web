<?php

/**
 * This is the model class for table "cadete".
 *
 * The followings are the available columns in table 'cadete':
 * @property string $rut
 * @property string $curso
 * @property string $divicion
 * @property string $anoIngreso
 * @property string $anoNacimiento
 * @property string $mesNacimiento
 * @property string $diaNacimiento
 * @property string $lugarNacimiento
 * @property string $nacionalidad
 * @property string $seleccion
 * @property string $nivel
 * @property string $circulo
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
			array('rut, curso, divicion, anoIngreso, anoNacimiento, mesNacimiento, diaNacimiento, lugarNacimiento, nacionalidad, seleccion, nivel', 'required'),
			array('rut, anoIngreso, anoNacimiento, mesNacimiento, diaNacimiento', 'length', 'max'=>10),
			array('curso', 'length', 'max'=>2),
			array('divicion', 'length', 'max'=>1),
			array('lugarNacimiento', 'length', 'max'=>100),
			array('nacionalidad, seleccion, nivel, circulo', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rut, curso, divicion, anoIngreso, anoNacimiento, mesNacimiento, diaNacimiento, lugarNacimiento, nacionalidad, seleccion, nivel, circulo', 'safe', 'on'=>'search'),
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
			'rut0' => array(self::BELONGS_TO, 'Usuario', 'rut'),
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
			'curso' => 'Curso',
			'divicion' => 'Divicion',
			'anoIngreso' => 'Ano Ingreso',
			'anoNacimiento' => 'Ano Nacimiento',
			'mesNacimiento' => 'Mes Nacimiento',
			'diaNacimiento' => 'Dia Nacimiento',
			'lugarNacimiento' => 'Lugar Nacimiento',
			'nacionalidad' => 'Nacionalidad',
			'seleccion' => 'Seleccion',
			'nivel' => 'Nivel',
			'circulo' => 'Circulo',
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
		$criteria->compare('curso',$this->curso,true);
		$criteria->compare('divicion',$this->divicion,true);
		$criteria->compare('anoIngreso',$this->anoIngreso,true);
		$criteria->compare('anoNacimiento',$this->anoNacimiento,true);
		$criteria->compare('mesNacimiento',$this->mesNacimiento,true);
		$criteria->compare('diaNacimiento',$this->diaNacimiento,true);
		$criteria->compare('lugarNacimiento',$this->lugarNacimiento,true);
		$criteria->compare('nacionalidad',$this->nacionalidad,true);
		$criteria->compare('seleccion',$this->seleccion,true);
		$criteria->compare('nivel',$this->nivel,true);
		$criteria->compare('circulo',$this->circulo,true);

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
}

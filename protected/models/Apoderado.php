<?php

/**
 * This is the model class for table "apoderado".
 *
 * The followings are the available columns in table 'apoderado':
 * @property string $rut
 * @property string $nombres
 * @property string $apellidoPat
 * @property string $apellidoMat
 */
class Apoderado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'apoderado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut, nombres, apellidoPat, apellidoMat', 'required'),
			array('rut', 'length', 'max'=>10),
			array('nombres', 'length', 'max'=>75),
			array('apellidoPat, apellidoMat', 'length', 'max'=>25),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rut, nombres, apellidoPat, apellidoMat', 'safe', 'on'=>'search'),
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
                    'cadeteApoderado' => array(self::BELONGS_TO,'CadeteApoderado','apoderado_rut'),
                    'cadetes'=>array(self::MANY_MANY, 'Cadete','cadete_apoderado(apoderado_rut, cadete_rut)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rut' => 'Rut',
			'nombres' => 'Nombres',
			'apellidoPat' => 'Apellido Pat',
			'apellidoMat' => 'Apellido Mat',
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
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('apellidoPat',$this->apellidoPat,true);
		$criteria->compare('apellidoMat',$this->apellidoMat,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Apoderado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

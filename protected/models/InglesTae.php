<?php

/**
 * This is the model class for table "ingles_tae".
 *
 * The followings are the available columns in table 'ingles_tae':
 * @property integer $idingles_tae
 * @property integer $ano
 * @property integer $mes
 * @property integer $speaking
 * @property integer $understanding
 * @property integer $writing
 * @property integer $average
 * @property string $cadete_rut
 *
 * The followings are the available model relations:
 * @property Cadete $cadeteRut
 */
class InglesTae extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ingles_tae';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ano, mes, speaking, understanding, writing, average, cadete_rut', 'required'),
			array('ano, mes, speaking, understanding, writing, average', 'numerical', 'integerOnly'=>true),
			array('cadete_rut', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idingles_tae, ano, mes, speaking, understanding, writing, average, cadete_rut', 'safe', 'on'=>'search'),
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
			'cadeteRut' => array(self::BELONGS_TO, 'Cadete', 'cadete_rut'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idingles_tae' => 'Idingles Tae',
			'ano' => 'Ano',
			'mes' => 'Mes',
			'speaking' => 'Speaking',
			'understanding' => 'Understanding',
			'writing' => 'Writing',
			'average' => 'Average',
			'cadete_rut' => 'Cadete Rut',
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

		$criteria->compare('idingles_tae',$this->idingles_tae);
		$criteria->compare('ano',$this->ano);
		$criteria->compare('mes',$this->mes);
		$criteria->compare('speaking',$this->speaking);
		$criteria->compare('understanding',$this->understanding);
		$criteria->compare('writing',$this->writing);
		$criteria->compare('average',$this->average);
		$criteria->compare('cadete_rut',$this->cadete_rut,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InglesTae the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

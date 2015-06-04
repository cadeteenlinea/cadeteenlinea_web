<?php

/**
 * This is the model class for table "notas_parciales".
 *
 * The followings are the available columns in table 'notas_parciales':
 * @property integer $idnotas_parciales
 * @property double $nota
 * @property integer $dia
 * @property integer $mes
 * @property integer $ano
 * @property integer $semestre
 * @property integer $asignatura_idasignatura
 * @property string $cadete_rut
 *
 * The followings are the available model relations:
 * @property Asignatura $asignaturaIdasignatura
 * @property Cadete $cadeteRut
 */
class NotasParciales extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notas_parciales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nota, dia, mes, ano, semestre, asignatura_idasignatura, cadete_rut', 'required'),
			array('dia, mes, ano, semestre, asignatura_idasignatura', 'numerical', 'integerOnly'=>true),
			array('nota', 'numerical'),
			array('cadete_rut', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idnotas_parciales, nota, dia, mes, ano, semestre, asignatura_idasignatura, cadete_rut', 'safe', 'on'=>'search'),
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
			'asignaturaIdasignatura' => array(self::BELONGS_TO, 'Asignatura', 'asignatura_idasignatura'),
			'cadeteRut' => array(self::BELONGS_TO, 'Cadete', 'cadete_rut'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idnotas_parciales' => 'Idnotas Parciales',
			'nota' => 'Nota',
			'dia' => 'Dia',
			'mes' => 'Mes',
			'ano' => 'Ano',
			'semestre' => 'Semestre',
			'asignatura_idasignatura' => 'Asignatura Idasignatura',
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

		$criteria->compare('idnotas_parciales',$this->idnotas_parciales);
		$criteria->compare('nota',$this->nota);
		$criteria->compare('dia',$this->dia);
		$criteria->compare('mes',$this->mes);
		$criteria->compare('ano',$this->ano);
		$criteria->compare('semestre',$this->semestre);
		$criteria->compare('asignatura_idasignatura',$this->asignatura_idasignatura);
		$criteria->compare('cadete_rut',$this->cadete_rut,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NotasParciales the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getFecha(){
            return $this->dia.'/'.$this->mes.'/'.$this->ano;
        }
}

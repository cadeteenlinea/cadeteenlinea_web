<?php

/**
 * This is the model class for table "asignatura".
 *
 * The followings are the available columns in table 'asignatura':
 * @property integer $idasignatura
 * @property string $codigo
 * @property integer $ano
 * @property integer $semestre
 * @property integer $curso
 * @property string $nombre
 * @property integer $especialidad_idespecialidad
 *
 * The followings are the available model relations:
 * @property Especialidad $especialidadIdespecialidad
 * @property NotasFinales[] $notasFinales
 * @property NotasParciales[] $notasParciales
 */
class Asignatura extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'asignatura';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codigo, ano, semestre, curso, nombre, especialidad_idespecialidad', 'required'),
			array('ano, semestre, curso, especialidad_idespecialidad', 'numerical', 'integerOnly'=>true),
			array('codigo', 'length', 'max'=>6),
			array('nombre', 'length', 'max'=>75),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idasignatura, codigo, ano, semestre, curso, nombre, especialidad_idespecialidad', 'safe', 'on'=>'search'),
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
			'especialidadIdespecialidad' => array(self::BELONGS_TO, 'Especialidad', 'especialidad_idespecialidad'),
			'notasFinales' => array(self::HAS_MANY, 'NotasFinales', 'asignatura_idasignatura'),
			'notasParciales' => array(self::HAS_MANY, 'NotasParciales', 'asignatura_idasignatura'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idasignatura' => 'Idasignatura',
			'codigo' => 'Codigo',
			'ano' => 'Ano',
			'semestre' => 'Semestre',
			'curso' => 'Curso',
			'nombre' => 'Nombre',
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

		$criteria->compare('idasignatura',$this->idasignatura);
		$criteria->compare('codigo',$this->codigo,true);
		$criteria->compare('ano',$this->ano);
		$criteria->compare('semestre',$this->semestre);
		$criteria->compare('curso',$this->curso);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('especialidad_idespecialidad',$this->especialidad_idespecialidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Asignatura the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getAsignaturasAnoCursoEspecialidad($ano, $curso, $especialidad){
            $criteria=new CDbCriteria;
            $criteria->with = array('notasParciales','notasParciales.cadeteRut');
            $criteria->addCondition('t.ano='.$ano);
            $criteria->addCondition('t.curso='.$curso);
            $criteria->addCondition('t.especialidad_idespecialidad='.$especialidad);
            $criteria->order= 't.nombre ASC';
            $model = Asignatura::model()->findAll($criteria);
            return $model;
        }
        
        public static function getAsignaturasCadeteAno($ano, $rutCadete){
            $criteria=new CDbCriteria;
            $criteria->with = array('notasFinales','notasFinales.cadete');
            $criteria->addCondition('t.ano='.$ano);
            $criteria->addCondition('cadete.rut='.$rutCadete);
            $criteria->order= 't.nombre ASC';
            $model = Asignatura::model()->findAll($criteria);
            return $model;
        }
}

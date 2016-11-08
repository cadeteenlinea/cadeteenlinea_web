<?php

/**
 * This is the model class for table "funcionario".
 *
 * The followings are the available columns in table 'funcionario':
 * @property string $rut
 * @property string $departamento_iddepartamento
 * @property string $tipo
 *
 * The followings are the available model relations:
 * @property Usuario $rut0
 * @property Departamento $departamento
 */
class Funcionario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'funcionario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut, tipo', 'required'),
			array('rut, departamento_iddepartamento', 'length', 'max'=>10),
			array('tipo', 'length', 'max'=>14),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rut, departamento_iddepartamento, tipo', 'safe', 'on'=>'search'),
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
			'departamento' => array(self::BELONGS_TO, 'Departamento', 'departamento_iddepartamento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rut' => 'Rut',
			'departamento_iddepartamento' => 'Departamento Iddepartamento',
			'tipo' => 'Tipo',
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
		$criteria->compare('departamento_iddepartamento',$this->departamento_iddepartamento,true);		
		$criteria->compare('tipo',$this->tipo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Funcionario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getCadetesOficiales(){
            $model = Cadete::model()->with('usuario')->findAll(array('order' => 'usuario.apellidoPat, usuario.apellidoMat, usuario.nombres  ASC'));
            return $model;
        }
        
        /*****METEDOS AGREGADOS PARA LA VISUALIZACIÓN DE CADETES PARA OFICIALES*****/
        public function seleccionarCadeteOficial($rutCadete){
            if($this->validarCadeteAsociado($rutCadete)){
                Yii::app()->getSession()->remove('rutCadete');
                Yii::app()->getSession()->add('rutCadete', $rutCadete);
                
                $model = Cadete::model()->findByPk($rutCadete);
                Yii::app()->getSession()->remove('nCadete');
                Yii::app()->getSession()->add('nCadete', $model->nCadete);
                Yii::app()->getSession()->remove('apellidoPaternoCadete');
                Yii::app()->getSession()->add('apellidoPaternoCadete', $model->usuario->apellidoPat);
                
                return true;
            }else{
                return false;
            }
        }
        
        private function validarCadeteAsociado($rutCadete){
            return true;
        }
}

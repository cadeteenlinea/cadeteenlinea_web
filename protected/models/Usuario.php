<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $rut
 * @property string $password_2
 * @property string $perfil
 *
 * The followings are the available model relations:
 * @property Apoderado $apoderado
 * @property Cadete $cadete
 * @property Funcionario $funcionario
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut, password_2', 'required'),
			array('rut', 'length', 'max'=>10),
			array('password_2', 'length', 'max'=>250),
			array('perfil', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rut, password_2, perfil', 'safe', 'on'=>'search'),
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
			'apoderado' => array(self::HAS_ONE, 'Apoderado', 'rut'),
			'cadete' => array(self::HAS_ONE, 'Cadete', 'rut'),
			'funcionario' => array(self::HAS_ONE, 'Funcionario', 'rut'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rut' => 'Rut',
			'password_2' => 'Clave',
			'perfil' => 'Perfil',
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
		$criteria->compare('password_2',$this->password_2,true);
		$criteria->compare('perfil',$this->perfil,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function validatePassword($password){
            //return $this->hashPassword($password)===$this->password_2;
            return $this->password_2 === $password;
        }
        
        public function hashPassword($password){
            return md5($password);
        }
        
        public function imagen(){
            if(file_exists(Yii::app()->request->baseUrl."/images/usuario/".$this->rut.".jpg")){
                return Yii::app()->request->baseUrl."/images/usuario/$this->rut";
            }else{
                return Yii::app()->request->baseUrl."/images/usuario/000.jpg";
            }
        }
}

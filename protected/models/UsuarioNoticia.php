<?php

/**
 * This is the model class for table "usuario_noticia".
 *
 * The followings are the available columns in table 'usuario_noticia':
 * @property integer $idusuario_noticia
 * @property integer $noticia_idnoticia
 * @property string $usuario_rut
 *
 * The followings are the available model relations:
 * @property Noticia $noticia
 * @property Usuario $usuario
 */
class UsuarioNoticia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario_noticia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('noticia_idnoticia, usuario_rut', 'required'),
			array('noticia_idnoticia', 'numerical', 'integerOnly'=>true),
			array('usuario_rut', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idusuario_noticia, noticia_idnoticia, usuario_rut', 'safe', 'on'=>'search'),
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
			'noticia' => array(self::BELONGS_TO, 'Noticia', 'noticia_idnoticia'),
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_rut'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idusuario_noticia' => 'Idusuario Noticia',
			'noticia_idnoticia' => 'Noticia Idnoticia',
			'usuario_rut' => 'Usuario Rut',
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

		$criteria->compare('idusuario_noticia',$this->idusuario_noticia);
		$criteria->compare('noticia_idnoticia',$this->noticia_idnoticia);
		$criteria->compare('usuario_rut',$this->usuario_rut,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuarioNoticia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function insertNoticiaUsuario($usuarios, $idNoticia){
            foreach($usuarios as $usuario){
                $usuarioNoticia = new UsuarioNoticia();
                $usuarioNoticia->noticia_idnoticia = $idNoticia;
                $usuarioNoticia->usuario_rut = $usuario->rut;
                $usuarioNoticia->save();
            }
        }
}

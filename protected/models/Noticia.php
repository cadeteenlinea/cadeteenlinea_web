<?php

/**
 * This is the model class for table "noticia".
 *
 * The followings are the available columns in table 'noticia':
 * @property integer $idnoticia
 * @property string $titulo
 * @property string $cuerpo
 * @property string $fecha
 *
 * The followings are the available model relations:
 * @property UsuarioNoticia[] $usuarioNoticias
 */
class Noticia extends CActiveRecord
{
    
        public static $tipos = array('todos'=>'Todos','apoderado'=>'Solo apoderado', 'cadete'=>'Solo cadete');
        public $tipoUsuario;
        public $division;
        public $curso;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'noticia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, cuerpo, fecha, tipoUsuario', 'required'),
			array('titulo', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idnoticia, titulo, cuerpo, fecha', 'safe', 'on'=>'search'),
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
			'usuarioNoticias' => array(self::HAS_MANY, 'UsuarioNoticia', 'noticia_idnoticia'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idnoticia' => 'Idnoticia',
			'titulo' => 'Titulo',
			'cuerpo' => 'Cuerpo',
			'fecha' => 'Fecha',
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

		$criteria->compare('idnoticia',$this->idnoticia);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('cuerpo',$this->cuerpo,true);
		$criteria->compare('fecha',$this->fecha,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Noticia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getTipoUsuarioNoticia($key=null){
            if($key!==null)
                return self::$tipos[$key];
            return self::$tipos; 
        }
        
        public static function deleteAllNoticiaUsuario($idnoticia){
            $criteria=new CDbCriteria;
            $criteria->addCondition('t.noticia_idnoticia = '.$idnoticia);
            $model = UsuarioNoticia::model()->findAll($criteria);
            foreach($model as $item){
                $item->delete();
            }
        }
        
        public static function getAllUsuarioNoticiaInsert($tipoUsuario, $division, $curso){
            $usuarios = null;
            $criteria=new CDbCriteria;
            switch ($tipoUsuario) {
                case 'todos':
                    $criteria->addCondition('t.perfil<>"funcionario"');
                    break;
                case 'apoderado':
                    $criteria->with = array('apoderado', 'apoderado.cadeteApoderados', 'apoderado.cadeteApoderados.cadeteRut');
                    $criteria->addCondition('t.perfil="apoderado"');
                    if($division!=null){
                        $criteria->addCondition('cadeteRut.division="'.$division.'"');
                    }
                    if($curso!=null){
                        $criteria->addCondition('cadeteRut.curso="'.$curso.'"');
                    }
                    break;
                case 'cadete':
                    $criteria->with = array('cadete');
                    $criteria->addCondition('t.perfil="cadete"');
                    if($division!=null){
                        $criteria->addCondition('cadete.division="'.$division.'"');
                    }
                    if($curso!=null){
                        $criteria->addCondition('cadete.curso="'.$curso.'"');
                    }
                    break;
            }
            $usuarios = Usuario::model()->findAll($criteria);
            return $usuarios;
        }
}

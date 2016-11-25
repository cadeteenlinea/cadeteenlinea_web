<?php

/**
 * This is the model class for table "noticia".
 *
 * The followings are the available columns in table 'noticia':
 * @property integer $idnoticia
 * @property string $titulo
 * @property string $cuerpo
 * @property string $fecha
 * @property string $tipo_usuario
 * @property string $division
 * @property string $curso
 * @property string $extension
 * @property string $usuario_rut
 *
 * The followings are the available model relations:
 * @property UsuarioNoticia[] $usuarioNoticias
 * @property Usuario $usuario
 */
class Noticia extends CActiveRecord
{
    
        public static $tipos = array('todos'=>'Todos','apoderado'=>'Solo apoderados', 'cadete'=>'Solo cadetes');
        public $documento;

	public function tableName()
	{
		return 'noticia';
	}

	public function rules()
	{
		return array(
			array('titulo, cuerpo, fecha, tipo_usuario', 'required'),
			array('titulo', 'length', 'max'=>45),
                        array('division, curso', 'length', 'max'=>2),
                        array('extension', 'length', 'max'=>5),
                        array('documento', 
                            'file',
                            'types' =>'jpg,png,doc,docx,xls,xlsx,pdf',
                            'maxSize' => 1024 * 1024 * 10, // 10MB                
                            'tooLarge' => 'Máximo 10MB. Por favor suba un archivo de menor peso.', 
                            'on'=>'insert',
                            'allowEmpty' => true,
                        ),
                        array('documento', 
                            'file',
                            'types' =>'jpg,png,doc,docx,xls,xlsx,pdf',
                            'maxSize' => 1024 * 1024 * 10, // 10MB                
                            'tooLarge' => 'Máximo 10MB. Por favor suba un archivo de menor peso.',     
                            'on'=>'update', 
                            'allowEmpty' => true, 
                        ),
			array('idnoticia, titulo, cuerpo, fecha, documento, tipo_usuario, division, curso, extension', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
			'usuarioNoticias' => array(self::HAS_MANY, 'UsuarioNoticia', 'noticia_idnoticia'),
                        'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_rut'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'idnoticia' => 'Idnoticia',
			'titulo' => 'Titulo',
			'cuerpo' => 'Cuerpo',
			'fecha' => 'Fecha',
                        'documento' => 'Documento',
                        'curso' => 'Curso',
                        'division' => 'División',
                        'tipo_usuario' => 'Para',
                        'extension' => 'Extension',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('idnoticia',$this->idnoticia);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('cuerpo',$this->cuerpo,true);
		$criteria->compare('fecha',$this->fecha,true);
                $criteria->compare('tipo_usuario',$this->tipo_usuario,true);
                $criteria->compare('division',$this->division,true);
                $criteria->compare('curso',$this->curso,true);
                $criteria->compare('extension',$this->extension,true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

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
                    $criteria->with = array('apoderado', 'apoderado.cadeteApoderados', 'apoderado.cadeteApoderados.cadete');
                    $criteria->addCondition('t.perfil="apoderado"');
                    if($division!=null){
                        $criteria->addCondition('cadete.division="'.$division.'"');
                    }
                    if($curso!=null){
                        $criteria->addCondition('cadete.curso="'.$curso.'"');
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
        
        public function documento(){
            if(file_exists('news/'.$this->idnoticia.'.'.$this->extension)){
                return Yii::app()->request->baseUrl.'/news/'.$this->idnoticia.'.'.$this->extension;
            }else{
                return null;
            }
        }
        
        public function tipoDocumento(){
            if($this->documento()!=null){
                switch ($this->extension) {
                    case 'pdf':
                        return Yii::app()->request->baseUrl.'/images/iconos/pdf.png';
                        break;
                    case 'doc':
                        return Yii::app()->request->baseUrl.'/images/iconos/word.png';
                        break;
                    case 'docx':
                        return Yii::app()->request->baseUrl.'/images/iconos/word.png';
                        break;
                    case 'xls':
                        return Yii::app()->request->baseUrl.'/images/iconos/excel.png';
                        break;
                    case 'xlsx':
                        return Yii::app()->request->baseUrl.'/images/iconos/excel.png';
                        break;
                    case 'jpg':
                        return Yii::app()->request->baseUrl.'/images/iconos/imagen.png';
                        break;
                    case 'png':
                        return Yii::app()->request->baseUrl.'/images/iconos/imagen.png';
                        break;
                }
            }
        }
        
        public function getCuerpoNoticia(){
            $cadena = $this->cuerpo;
            /*if(strlen($cadena) > 220){
                $cadena = substr($cadena,0,220)."...";
            }*/
            return $cadena;
        }
}

<?php

/**
 * This is the model class for table "resumen".
 *
 * The followings are the available columns in table 'resumen':
 * @property integer $idresumen
 * @property integer $nCadete
 * @property integer $curso
 * @property integer $ano
 * @property string $especialidad
 * @property double $calificacion_primer_semestre
 * @property double $calificacion_segundo_semestre
 * @property double $promedio_calificacion
 * @property double $promedio_academico
 * @property double $promedio_final
 * @property double $antiguedad
 * @property string $cadete_rut
 * @property integer $especialidad_idespecialidad
 *
 * The followings are the available model relations:
 * @property Cadete $cadeteRut
 * @property Especialidad $especialidad
 */
class Resumen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'resumen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idresumen, nCadete, curso, ano, especialidad_idespecialidad, calificacion_primer_semestre, calificacion_segundo_semestre, promedio_calificacion, promedio_academico, promedio_final, antiguedad, cadete_rut', 'required'),
			array('idresumen, nCadete, curso, ano', 'numerical', 'integerOnly'=>true),
			array('calificacion_primer_semestre, calificacion_segundo_semestre, promedio_calificacion, promedio_academico, promedio_final, antiguedad', 'numerical'),
			array('especialidad', 'length', 'max'=>1),
			array('cadete_rut', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idresumen, nCadete, curso, ano, especialidad, calificacion_primer_semestre, calificacion_segundo_semestre, promedio_calificacion, promedio_academico, promedio_final, antiguedad, cadete_rut', 'safe', 'on'=>'search'),
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
			'cadete' => array(self::BELONGS_TO, 'Cadete', 'cadete_rut'),
                        'especialidad' => array(self::BELONGS_TO, 'Especialidad', 'especialidad_idespecialidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idresumen' => 'Idresumen',
			'nCadete' => 'N Cadete',
			'curso' => 'Curso',
			'ano' => 'Ano',
			'especialidad' => 'Especialidad',
			'calificacion_primer_semestre' => 'Calificacion Primer Semestre',
			'calificacion_segundo_semestre' => 'Calificacion Segundo Semestre',
			'promedio_calificacion' => 'Promedio Calificacion',
			'promedio_academico' => 'Promedio Academico',
			'promedio_final' => 'Promedio Final',
			'antiguedad' => 'Antiguedad',
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

		$criteria->compare('idresumen',$this->idresumen);
		$criteria->compare('nCadete',$this->nCadete);
		$criteria->compare('curso',$this->curso);
		$criteria->compare('ano',$this->ano);
		$criteria->compare('especialidad',$this->especialidad,true);
		$criteria->compare('calificacion_primer_semestre',$this->calificacion_primer_semestre);
		$criteria->compare('calificacion_segundo_semestre',$this->calificacion_segundo_semestre);
		$criteria->compare('promedio_calificacion',$this->promedio_calificacion);
		$criteria->compare('promedio_academico',$this->promedio_academico);
		$criteria->compare('promedio_final',$this->promedio_final);
		$criteria->compare('antiguedad',$this->antiguedad);
		$criteria->compare('cadete_rut',$this->cadete_rut,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Resumen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function saveWeb($resumenes){
            
            /*ELIMINO TODOS LOS REGISTROS ANTES DE REALIZAR EL CARGADO DE DATOS*/
            $models = Resumen::model()->findAll();
            foreach($models as $model){
                $model->delete();
            }
            
            $error = "";
            $errores = "";
            foreach ($resumenes as $resumen){
                $model = Resumen::model()->findByPk($resumen["idresumen"]);
                if(empty($model)){
                    $model =  new Resumen();
                    $model->idresumen = $resumen["idresumen"];
                }
                
                $model->nCadete = $resumen["nCadete"];
                $model->curso = $resumen["curso"];
                $model->ano = $resumen["ano"];
                $model->especialidad = $resumen["especialidad"];
                $model->calificacion_primer_semestre = $resumen["calificacion_primer_semestre"];
                $model->calificacion_segundo_semestre = $resumen["calificacion_segundo_semestre"];
                $model->promedio_calificacion = $resumen["promedio_calificacion"];
                $model->promedio_academico = $resumen["promedio_academico"];
                $model->promedio_final = $resumen["promedio_final"];
                $model->antiguedad = $resumen["antiguedad"];

                $model->cadete_rut = $resumen["cadete_rut"];
                
                $criteria=new CDbCriteria;
                $criteria->addCondition('codigo="'.$resumen["especialidad"].'"');
                $especialidad = Especialidad::model()->find($criteria);
                if(!empty($especialidad)){
                    $model->especialidad_idespecialidad = $especialidad->idespecialidad;
                }
                
                try{
                    if(!$model->save()){
                        foreach($model->errors as $error){
                            $er = new Error('99999', $model->idresumen, 'resumen', $error[0]);
                            $errores[] = $er;
                        }
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $model->idresumen, 'resumen', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
}

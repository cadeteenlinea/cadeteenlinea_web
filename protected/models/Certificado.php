<?php

/**
 * This is the model class for table "certificado".
 *
 * The followings are the available columns in table 'certificado':
 * @property integer $idcertificado
 * @property string $fecha_solicitud
 * @property string $fecha_vencimiento
 * @property string $fecha_aprobacion
 * @property integer $motivo_idmotivo
 * @property string $usuario_rut
 * @property integer $tipo_certificado_idtipo_certificado
 * @property string $cadete_rut
 * @property string $usuario_rut_aprobado
 *
 * The followings are the available model relations:
 * @property Cadete $cadete
 * @property Motivo $motivo
 * @property TipoCertificado $tipoCertificado
 * @property Usuario $usuario
 * @property Usuario $aprobador
 */
class Certificado extends CActiveRecord
{
	public $estado;
        
	public function tableName()
	{
		return 'certificado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fecha_solicitud, motivo_idmotivo, usuario_rut, tipo_certificado_idtipo_certificado, cadete_rut', 'required', 'except'=>'validar'),
			array('idcertificado, motivo_idmotivo, tipo_certificado_idtipo_certificado', 'numerical', 'integerOnly'=>true),
			array('fecha_solicitud, fecha_vencimiento, fecha_aprobacion', 'length', 'max'=>50),
			array('usuario_rut, cadete_rut, usuario_rut_aprobado', 'length', 'max'=>10),
                    
                    
                        array('idcertificado, cadete_rut', 'required', 'on' => 'validar'),
                        array('cadete_rut', 'validateRut', 'on' => 'validar'),
                    
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcertificado, fecha_solicitud, fecha_vencimiento, fecha_aprobacion, motivo_idmotivo, usuario_rut, tipo_certificado_idtipo_certificado, cadete_rut', 'safe', 'on'=>'search'),
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
			'motivo' => array(self::BELONGS_TO, 'Motivo', 'motivo_idmotivo'),
			'tipoCertificado' => array(self::BELONGS_TO, 'TipoCertificado', 'tipo_certificado_idtipo_certificado'),
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_rut'),
                        'aprobador' => array(self::BELONGS_TO, 'Usuario', 'usuario_rut_aprobado'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcertificado' => 'Folio',
			'fecha_solicitud' => 'Fecha Solicitud',
			'fecha_vencimiento' => 'Fecha Vencimiento',
			'fecha_aprobacion' => 'Fecha Aprobacion',
			'motivo_idmotivo' => 'Motivo',
			'usuario_rut' => 'Usuario',
			'tipo_certificado_idtipo_certificado' => 'Tipo Certificado',
			'cadete_rut' => 'RUN Cadete',
                        'usuario_rut_aprobado' => 'Aprobado por',
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
       
        public function search($filtro)
	{
		$criteria=new CDbCriteria;
                $criteria->with = 'cadete';
		$criteria->compare('idcertificado',$this->idcertificado);
		$criteria->compare('fecha_solicitud',$this->fecha_solicitud,true);
		$criteria->compare('fecha_vencimiento',$this->fecha_vencimiento,true);
		$criteria->compare('fecha_aprobacion',$this->fecha_aprobacion,true);
		$criteria->compare('motivo_idmotivo',$this->motivo_idmotivo);
		$criteria->compare('usuario_rut',$this->usuario_rut,true);
                $criteria->condition = "cadete.nCadete IS NOT NULL";
		$criteria->compare('tipo_certificado_idtipo_certificado',$this->tipo_certificado_idtipo_certificado);
                
                //se recepciona el tipo de search o filtor que se requiere
                switch ($filtro) {
                    case "porAprobar":
                        $criteria->addCondition('fecha_aprobacion IS NULL');
                        break;
                    case "misCertificados":
                        $criteria->addCondition('usuario_rut ='.Yii::app()->user->id);
                        break;
                    case "aprobados":
                        $criteria->addCondition('fecha_aprobacion IS NOT NULL');
                        break;
                }

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Certificado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public static function getAllCertificadosCadete(){
            $criteria=new CDbCriteria;
            $criteria->addCondition('t.usuario_rut='.Yii::app()->user->id);
            $model = Certificado::model()->findAll($criteria);
            
            return $model;
        }
        
        public static function getCertificadoValidar($idcertificado, $cadete_rut){
            $criteria=new CDbCriteria;
            $criteria->addCondition('t.idcertificado='.$idcertificado);
            $criteria->addCondition("t.fecha_aprobacion <>'' ");
            $criteria->addCondition('t.cadete_rut='.$cadete_rut);
            
            $model = Certificado::model()->find($criteria);
            return $model;
        }
        
        
        //Validación de rut chileno
        public function validateRut($attribute, $params) {
            $data = explode('-', $this->cadete_rut);
            $evaluate = strrev($data[0]);
            $multiply = 2;
            $store = 0;
            for ($i = 0; $i < strlen($evaluate); $i++) {
                $store += $evaluate[$i] * $multiply;
                $multiply++;
                if ($multiply > 7)
                    $multiply = 2;
            }
            isset($data[1]) ? $verifyCode = strtolower($data[1]) : $verifyCode = '';
            $result = 11 - ($store % 11);
            if ($result == 10)
                $result = 'k';
            if ($result == 11)
                $result = 0;
            if ($verifyCode != $result)
                $this->addError('cadete_rut', 'Rut inválido.');
        }
        
        public function validacion(){
            $fechaActual = date("Y-m-d H:i:s");
            $fechaActual = strtotime($fechaActual);
            
            $fechaCertificado = strtotime($this->fecha_vencimiento);
            if($fechaCertificado >= $fechaActual){
                return true;
            }
            return false;
        }
        
        public function estado(){
            $fechaActual = date("Y-m-d H:i:s");
            $fechaActual = strtotime($fechaActual);
            
            $fechaCertificado = strtotime($this->fecha_vencimiento);
            if(!is_null($this->fecha_aprobacion)){
                if($fechaCertificado >= $fechaActual){
                    return "Caduca: ".date("d-m-Y",strtotime($this->fecha_vencimiento));
                }
            }else{
                return "Por aprobar";
            }
            return "Caducado";
        }
        
        public function getFecha_vencimiento(){
            //$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            $this->fecha_vencimiento = str_replace("-","/",$this->fecha_vencimiento);
            
            echo date('d', strtotime($this->fecha_vencimiento))." de ".$meses[date('n', strtotime($this->fecha_vencimiento))-1]. " de ".date('Y', strtotime($this->fecha_vencimiento));
        }
        
        public function getFecha_aprobacion(){
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            echo date('d', strtotime($this->fecha_aprobacion))." de ".$meses[date('n', strtotime($this->fecha_aprobacion))-1]. " de ".date('Y', strtotime($this->fecha_aprobacion));
        }
        
        public function avisoDeAprobacion(){
            if($this->usuario->email != 'cadete@escuelanaval.cl'){
                $body = '<div style="background: #23415b; padding: 15px; margin: 0px;">'
                        . '<br/><br/><h2 style="color: #fff;">Solicitud de Certificado</h2>'
                        . '</div>';

                $body .= '<div style="background: #fafafa; padding: 15px; margin: 0px; border: 1px solid #e6e6e6;">';
                $body .= '<p>Hola, '.$this->usuario->nombres.'</p>';
                $body .= '<p>Se encuentra disponible para descarga el siguiente certificado: </p>';
                $body .= '<ul><li>Folio: '.$this->idcertificado.'</li>';
                $body .= '<li>Cadete: ['.$this->cadete->getnCadeteView().'] '.$this->cadete->usuario->getNombreCompleto().'</li>';
                $body .= '<li>Tipo de Certificado: '.$this->tipoCertificado->nombre.'</li></ul>';
                $body .= '<br/><p></p>';
                $body .= 'Ingresa a <a href="http://portalcadete.escuelanaval.cl/">http://portalcadete.escuelanaval.cl/</a><br/><br/>';

                $body .= '<p>Atentamente.<br/>'
                        . 'Equipo Portal Cadete</p>';
                $body .= '</div>';

                $mail=Yii::app()->Smtpmail;
                $mail->IsHTML(true);
                $mail->SetFrom('noreply@escuelanaval.cl', '[Portal Cadete]');
                $mail->Subject    = 'Solicitud de Certificado';
                $mail->MsgHTML($body);
                $mail->AddAddress($this->usuario->email, "");
                $sw = false;

                if($mail->Send()) {
                    $sw = true;
                }
                $mail->ClearAddresses(); //clear addresses for next email sending

                return $sw;
            }
            return false;
        }
}

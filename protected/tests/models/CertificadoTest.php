<?php

/**
 * @group Model_Certificado
 */

class CertificadoTest extends CTestCase {
    protected $object;
    protected $objectCertificado;
    public $fixture = array(
        'apoderado'=>'4954924',
        'cadete'=>'18176975',
        'tipoCertificado' => 1,
        'fecha' => '2015-11-26 18:40:34',
        'aprobacion' => '2015-11-27 18:40:34',
        'vencimiento' => '2016-01-27 18:40:34',
        'motivo' => 1
    );
    
    protected function setUp() {
        $this->object = new Nivelacion;
        $this->objectCertificado = new Certificado;
    }

    protected function tearDown() {
        unset($this->object);
    }

    public function testNuevoCertificadoYAprobacion() {
        $this->objectCertificado->fecha_solicitud = $this->fixture["fecha"];
        $this->objectCertificado->tipo_certificado_idtipo_certificado = $this->fixture["tipoCertificado"];
        $this->objectCertificado->motivo_idmotivo = $this->fixture["motivo"];
        $this->objectCertificado->cadete_rut = $this->fixture["cadete"];
        $this->objectCertificado->usuario_rut = $this->fixture["apoderado"];
        
        /*valida se cree la petición de nuevo certificado*/
        $this->assertEquals(true,$this->objectCertificado->save());
        
        /*valida la aprobación del certificado al establecer una fecha de vencimiento*/
        $this->objectCertificado->fecha_vencimiento = $this->fixture["vencimiento"];
        $this->objectCertificado->fecha_aprobacion = $this->fixture["aprobacion"];
        $this->assertEquals(true,$this->objectCertificado->save());
    }
    
}


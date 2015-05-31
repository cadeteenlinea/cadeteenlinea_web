<?php

/**
 * @group Model_Usuario
 */
class UsuarioTest extends CTestCase {

    protected $object;
    public $fixture = array(
        'rut'=>'17558919',
    );

    protected function setUp() {
        $this->object = new Usuario;
    }

    protected function tearDown() {
        unset($this->object);
    }

    public function testAsignarCodVerificaciónYFecha() { 
        $this->object = Usuario::model()->findByPk($this->fixture['rut']);
        $this->assertNotEmpty($this->object->asignarCodVerificaciónYFecha());
        $this->assertNotEmpty($this->object->codVerificacion);
        $this->assertNotEmpty($this->object->fechaVerificacion);        
    }
    
    
}
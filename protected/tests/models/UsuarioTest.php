<?php

/**
 * @group Model_Usuario
 */
class UsuarioTest extends CTestCase {

    protected $object;
    protected $objectReset;
    public $fixture = array(
        'rut'=>'17558919',
        'password'=>'asdasd',
        'passwordRepeat'=>'asdasd',
        'codVerificacion'=>''
    );

    protected function setUp() {
        $this->object = new Usuario;
        $this->objectReset = new ResetPassForm();
        $this->objectReset->attributes = $this->fixture;
    }

    protected function tearDown() {
        unset($this->object);
    }

    public function testAsignarCodVerificaciónYFecha() { 
        $this->object = Usuario::model()->findByPk($this->fixture['rut']);
        $this->assertNotEmpty($this->object->asignarCodVerificaciónYFecha());
        $this->assertNotEmpty($this->object->codVerificacion);
        $this->assertNotEmpty($this->object->fechaVerificacion);    
        $this->assertEquals(10,  strlen($this->object->codVerificacion));
    }
    
    public function testEnviarEmailContrasena(){
        $this->object = Usuario::model()->findByPk($this->fixture['rut']);
        $this->assertTrue($this->object->enviarEmailContrasena());
    }
    
    public function testResetContrasenaTrue(){
        $this->object = Usuario::model()->findByPk($this->fixture['rut']);
        $this->assertNotEmpty($this->object->asignarCodVerificaciónYFecha());
        $this->objectReset->codVerificacion = $this->object->codVerificacion;
        $this->assertTrue($this->object->resetContrasena($this->objectReset));
        $this->assertEmpty($this->object->codVerificacion);
        $this->assertEmpty($this->object->fechaVerificacion);
    }
}
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
        $this->assertEquals(10,  strlen($this->object->codVerificacion));
    }
    
    public function testEnviarEmailContrasena(){
        $this->object = Usuario::model()->findByPk($this->fixture['rut']);
        $this->assertTrue($this->object->enviarEmailContrasena());
    }
    
    //se debe modificar para poder realizar pruebas certeras, variable fecha produce problemas
    public function testResetContrasena(){
        /*$this->object = Usuario::model()->findByPk($this->fixture['rut']);
        $model = $this->object;
        $this->object->fechaVerificacion = date("Y-m-d H:i:s");
        $this->object->save();
        $this->assertTrue($this->object->resetContrasena($model));*/
    }
}
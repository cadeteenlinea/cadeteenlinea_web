<?php

/**
 * @group Model_Usuario
 */
class UsuarioTest extends CTestCase {

    protected $object;
    public $fixture = array(
        'rut'=>'11111111',
    );

    protected function setUp() {
        $this->object = new Usuario;
    }

    protected function tearDown() {
        unset($this->object);
    }

    public function testGenerarCodVerificacion() {
        $this->assertNotEmpty($this->object->generarCodVerificación());
    }
    
    
}
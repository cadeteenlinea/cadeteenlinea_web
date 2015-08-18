<?php

/**
 * @group PruebasSoapUsuarioTest
 */
class PruebasSoapUsuarioTest extends CTestCase {
    protected $object;
    public $usuarios = array(
        'jsonTrue'=>'[{"rut":11111111,"apellidoPat":"RAVENTÓS","apellidoMat":"ÁGUILA","nombre":"XIMENA","password_2":"4954924","perfil":"apoderado"},{"rut":6378128,"apellidoPat":"ACEVEDO","apellidoMat":"PEDREROS","nombre":"RAMÓN ARTURO","password_2":"6378128","perfil":"apoderado"}]',
        'jsonFalse'=>'[{"rut":22222222,"apellidoPat":"","apellidoMat":"ÁGUILA","nombre":"XIMENA","password_2":"4954924","perfil":"apoderado"},{"rut":6378128,"apellidoPat":"ACEVEDO","apellidoMat":"PEDREROS","nombre":"RAMÓN ARTURO","password_2":"6378128","perfil":""}]',
    );
    
    protected function setUp() {}
    
    protected function tearDown() {}
    
    public function testSaveTrue() {
        $usuarios = CJSON::decode($this->usuarios["jsonTrue"]);
        $result = Usuario::saveWeb($usuarios);
        $this->assertEmpty($result);
    }
    
    /*se envian datos invalidos o faltante*/
    public function testSaveFalse() {
        $usuarios = CJSON::decode($this->usuarios["jsonFalse"]);
        $result = Usuario::saveWeb($usuarios);
        $this->assertNotEmpty($result);
    }
    
    public function testDeleteTrue(){
        $usuarios = CJSON::decode($this->usuarios["jsonTrue"]);
        $result = Usuario::deleteWeb($usuarios);
        $this->assertEmpty($result);
    }
    
    /*se envian idTransaccion no existente*/
    public function testDeleteFalse(){
        $usuarios = CJSON::decode($this->usuarios["jsonFalse"]);
        $result = Usuario::deleteWeb($usuarios);
        $this->assertNotEmpty($result);
    }
}

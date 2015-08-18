<?php

/**
 * @group PruebasSoapCadeteTest
 */
class PruebasSoapCadeteTest extends CTestCase {
    protected $object;
    public $cadetes = array(
        'jsonTrue'=>'[{"rut":11111111,"nCadete":190,"direccion":"","comuna":"","ciudad":"","region":"","curso":"3C","division":"07","anoIngreso":2009,"anoNacimiento":1990,"mesNacimiento":12,"diaNacimiento":8,"lugarNacimiento":"VALPARAISO","nacionalidad":"CHILENA","seleccion":"VELA","nivel":"Aficionado","circulo":"TEATRO","especialidad":"E"}]',
        'jsonFalse'=>'[{"rut":22222222,"nCadete":190,"direccion":"","comuna":"","ciudad":"","region":"","curso":"3C","division":"07","anoIngreso":2009,"anoNacimiento":1990,"mesNacimiento":12,"diaNacimiento":8,"lugarNacimiento":"VALPARAISO","nacionalidad":"CHILENA","seleccion":"VELA","nivel":"Aficionado","circulo":"TEATRO","especialidad":"K"}]',
    );
    
    protected function setUp() {}
    
    protected function tearDown() {}
    
    public function testSaveTrue() {
        $cadetes = CJSON::decode($this->cadetes["jsonTrue"]);
        $result = Cadete::saveWeb($cadetes);
        $this->assertEmpty($result);
    }
    
    /*se envian datos invalidos o faltante*/
    public function testSaveFalse() {
        $cadetes = CJSON::decode($this->cadetes["jsonFalse"]);
        $result = Cadete::saveWeb($cadetes);
        $this->assertNotEmpty($result);
    }
    
    public function testDeleteTrue(){
        $cadetes = CJSON::decode($this->cadetes["jsonTrue"]);
        $result = Cadete::deleteWeb($cadetes);
        $this->assertEmpty($result);
    }
    
    /*se envian idTransaccion no existente*/
    public function testDeleteFalse(){
        $cadetes = CJSON::decode($this->cadetes["jsonFalse"]);
        $result = Cadete::deleteWeb($cadetes);
        $this->assertNotEmpty($result);
    }
}

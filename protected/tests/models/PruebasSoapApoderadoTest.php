<?php

/**
 * @group PruebasSoapApoderadoTest
 */
class PruebasSoapApoderadoTest extends CTestCase {
    protected $object;
    public $fixture = array(
        'usuario'=>'[{"rut":11111111,"apellidoPat":"asd","apellidoMat":"asd","nombre":"asd","password_2":"asd","perfil":"apoderado"}]',
        'apoderado'=>'[{"rut":11111111,"direccion":"1","comuna":"1","ciudad":"1","region":"","fono":"1","fonoComercial":"1","difunto":"no"}]',
        'cadeteApoderado'=>'[{"idcadete_apoderado":1044,"cadete_rut":18312151,"apoderado_rut":11111111,"tipoApoderado":"Padre"}]'
    );
    
    protected function setUp() {}
    
    protected function tearDown() {}
    
    public function testDelete() {
        $usuarios = CJSON::decode($this->fixture["usuario"]);
        $result = Usuario::saveWeb($usuarios);
        $this->assertEmpty($result);
        
        $apoderados = CJSON::decode($this->fixture["apoderado"]);
        $result = Apoderado::saveWeb($apoderados);
        $this->assertEmpty($result);
        
        $cadeteApoderado = CJSON::decode($this->fixture['cadeteApoderado']);
        $result = CadeteApoderado::saveWeb($cadeteApoderado);
        $this->assertEmpty($result);
        
        $result = Apoderado::deleteWeb($apoderados);
        print_r($result);
    }
}

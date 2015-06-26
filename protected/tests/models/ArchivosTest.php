<?php

/**
 * @group Model_Archivos
 */
class ArchivosTest extends CTestCase {
    protected $object;
    public $fixture = array(
        'idarchivos'=>'',
        'tipo_archivo_idtipo_archivo' => 1,
        'archivo' => 'C:\xampp\htdocs\cadeteenlinea\csv\1.csv',
    );
    public $fixture2 = array(
        'idarchivos' => '',
    );
    
    protected function setUp() {
        $this->object = new Archivos;
    }

    protected function tearDown() {
        unset($this->object);
    }

    public function testIngresar(){
        $this->object->fecha = date("Y-m-d H:i:s");
        $this->object->archivo = $this->fixture['archivo'];
        $this->object->tipo_archivo_idtipo_archivo = $this->fixture['tipo_archivo_idtipo_archivo'];
        $this->object->archivo=CUploadedFile::getInstance($this->object,'archivo');
        $this->assertNotEmpty($this->object);
        $this->assertTrue($this->object->save());
        $this->assertTrue($this->object->subirArchivo());        
    }
    
    public function testDelete(){
        $this->object = Archivos::model()->findByPk($this->fixture2['idarchivos']);
        $this->assertTrue($this->object->delete());
    }
    
}

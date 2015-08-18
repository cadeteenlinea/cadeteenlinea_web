<?php

/**
 * @group PruebasSoapTransaccionTest
 */
class PruebasSoapTransaccionTest extends CTestCase {
    protected $object;
    public $transacciones = array(
        'jsonTrue'=>'[{"idtransaccion":61732,"cadete_rut":17559990,"tipoTransaccion":"Cargo","monto":3499,"fechaMovimiento":"\/Date(1418128506613)\/","descripcion":"BOLETA PAÃ‘OL","tipoCuenta":"Cuenta Corriente"},{"idtransaccion":61733,"cadete_rut":17559990,"tipoTransaccion":"Cargo","monto":6640,"fechaMovimiento":"\/Date(1418128506613)\/","descripcion":"BOLETA PAÃ‘OL","tipoCuenta":"Cuenta Corriente"},{"idtransaccion":61734,"cadete_rut":17559990,"tipoTransaccion":"Cargo","monto":6640,"fechaMovimiento":"\/Date(1418128506630)\/","descripcion":"BOLETA PAÃ‘OL","tipoCuenta":"Cuenta Corriente"}]',
        'jsonFalse'=>'[{"idtransaccion":998899,"cadete_rut":1755999,"tipoTransaccion":"CargoS","monto":3499,"fechaMovimiento":"\/Date(1418128506613)\/","descripcion":"BOLETA PAÃ‘OL","tipoCuenta":"Cuenta Corriente"}]',
    );
    
    protected function setUp() {}
    
    protected function tearDown() {}
    
    public function testTransaccionesSaveTrue() {
        $transacciones = CJSON::decode($this->transacciones["jsonTrue"]);
        $result = Transaccion::saveWeb($transacciones);
        $this->assertEmpty($result);
    }
    
    /*se envian datos invalidos o faltante*/
    public function testTransaccionesSaveFalse() {
        $transacciones = CJSON::decode($this->transacciones["jsonFalse"]);
        $result = Transaccion::saveWeb($transacciones);
        $this->assertNotEmpty($result);
    }
    
    public function testTransaccionDeleteTrue(){
        $transacciones = CJSON::decode($this->transacciones["jsonTrue"]);
        $result = Transaccion::deleteWeb($transacciones);
        $this->assertEmpty($result);
    }
    
    /*se envian idTransaccion no existente*/
    public function testTransaccionDeleteFalse(){
        $transacciones = CJSON::decode($this->transacciones["jsonFalse"]);
        $result = Transaccion::deleteWeb($transacciones);
        $this->assertNotEmpty($result);
    }
}

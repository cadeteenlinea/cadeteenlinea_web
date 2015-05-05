<?php

/**
 * @group models
 */
class LoginFormTest extends CTestCase {

    /**
     * @var LoginForm
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new LoginForm;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        unset($this->object);
    }

    public function testModel(){
        $this->assertObjectHasAttribute('username',$this->object);
        $this->assertObjectHasAttribute('password',$this->object);
        $this->assertObjectHasAttribute('rememberMe',$this->object);
    }
    
    public function testRules(){
        $this->assertInternalType('array',$this->object->rules());
    }
    

}

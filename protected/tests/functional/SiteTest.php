<?php
/**
 * @group selenium
 */

class SiteTest extends WebTestCase
{

	public function testIndex()
	{
		$this->windowMaximize();
		$this->open('');
		$this->assertElementPresent('name=LoginForm[username]');
                $this->type('name=LoginForm[username]','4954924-5');
                $this->assertElementPresent('name=LoginForm[password]');
                $this->type('LoginForm[password]','4954924');
                $this->click('name=yt0');
                
	}
        /*
	public function testContact()
	{
                $this->windowMaximize();
		$this->open('site/contact');
		$this->assertTextPresent('Contact Us');
		$this->assertElementPresent('name=ContactForm[name]');

		$this->type('name=ContactForm[name]','tester');
		$this->type('name=ContactForm[email]','tester@example.com');
		$this->type('name=ContactForm[subject]','test subject');
		$this->click("//input[@value='Submit']");
		//$this->waitForTextPresent('Body cannot be blank.');
	}
    
	public function testLoginLogout()
	{
		$this->open('');
                $this->windowMaximize();
                $this->setSpeed("1000");
		// Garantizar que usuario este desconectado
		if($this->isTextPresent('Logout'))
			$this->clickAndWait('link=Logout (17558919-8)');

		// Inicio de sesión, incluye validación
		$this->clickAndWait('link=Ingresar');
		$this->assertElementPresent('name=LoginForm[username]');
		$this->type('name=LoginForm[username]','17558919-8');
		$this->click("//input[@value='Iniciar Sesión']");
		$this->waitForTextPresent('Clave no puede ser nulo.');
		$this->type('name=LoginForm[password]','clave_prueba');
		$this->clickAndWait("//input[@value='Iniciar Sesión']");

		// Cierre de sesión
		$this->assertTextNotPresent('Iniciar Sesión');
		$this->clickAndWait('link=Logout (17558919-8)');
		$this->assertTextPresent('Ingresar');
	}
     
       /*
       public function testLogin(){
        $this->windowMaximize();
        $this->open("site/login");
        
        $this->type("LoginForm_username", "17558919-8"); //Donde LoginForm_username es el id del usuario
        $this->type("LoginForm_password", "asdasd");
        $this->click("//button[@type='submit']");
        
        $this->waitForPageToLoad("3000");
        //
        //$element = $this->findElementBy(LocatorStrategy::name, "yt0");
        
        
        
        //$this->click("input[@value='Iniciar Sesión']");
        //$this->waitForPageToLoad(self::PAGE_LOAD_WAIT_TIME); //constante que declaré para esperar un tiempo
       }*/
}

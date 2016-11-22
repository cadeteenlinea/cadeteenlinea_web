<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
                        array('username', 'validateRut'),
			// username and password are required
			array('username, password', 'required'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
                        array('password', 'length', 'max'=>25),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'RUT',
                        'password'=>'Clave',
                        'rememberMe'=>'Recuérdame',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password', $this->_identity->errorMessageX);
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
        
        //Validación de rut chileno
        public function validateRut($attribute, $params) {
            $data = explode('-', $this->username);
            $evaluate = strrev($data[0]);
            $multiply = 2;
            $store = 0;
            for ($i = 0; $i < strlen($evaluate); $i++) {
                $store += $evaluate[$i] * $multiply;
                $multiply++;
                if ($multiply > 7)
                    $multiply = 2;
            }
            isset($data[1]) ? $verifyCode = strtolower($data[1]) : $verifyCode = '';
            $result = 11 - ($store % 11);
            if ($result == 10)
                $result = 'k';
            if ($result == 11)
                $result = 0;
            if ($verifyCode != $result)
                $this->addError('username', 'Rut inválido.');
        }
}

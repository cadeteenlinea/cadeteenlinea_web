
<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
        const ERROR_USER_BANNED = 12 ;
        
	public function authenticate()
	{
            $username=substr(strtolower($this->username),0,-2);
            $usuario=Usuario::model()->find('LOWER(rut)=?',array($username));
            
            //usuario no existe o incorrecto
            if($usuario===null)
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            //contraseña incorrecta
            else if(!$usuario->validatePassword($this->password))
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            //usuario desactivado - cadete se a retirado
            else if($usuario->estado_idestado == 0){
                $this->errorCode=self::ERROR_USER_BANNED;
            }
            else{
                $this->_id=$usuario->rut;
                if($usuario->perfil=='cadete'){
                    Yii::app()->getSession()->add('rutCadete', $usuario->rut);
                }
                Yii::app()->getSession()->add('perfil', $usuario->perfil);
                if($usuario->perfil == "funcionario"){
                    Yii::app()->getSession()->add('tipoFuncionario', $usuario->funcionario->tipo);
                }
                
                /*Actualizamos el last_login del usuario que se esta autenticando*/
                /*$sql = "update usuario set last_login = now() where rut=$this->_id";
                $connection = Yii::app() -> db;
                $command = $connection -> createCommand($sql);
                $command -> execute();
                */
                /*Consultamos los datos del usuario por el username ($user->username) */
                //$info_usuario = Usuario::model()->find('LOWER(username)=?', array($user->username));
                /*En las vistas tendremos disponibles last_login */
                //$this->setState('last_login',$info_usuario->last_login);

                $this->errorCode=self::ERROR_NONE;
            }
            return !$this->errorCode;
	}
        
        public function getId(){
            return $this->_id;
        }
        
        public function getErrorMessageX() #or whatever method name
        {
            switch ($this->errorCode)
            {
                case self::ERROR_USER_BANNED:
                    return 'Lo sentimos, su cuenta ha sido desactivada';

                case self::ERROR_USERNAME_INVALID:
                    return 'RUN o Contraseña incorrectos';

                case self::ERROR_PASSWORD_INVALID:
                    return 'RUN o Contraseña incorrectos';

                case self::ERROR_ACCOUNT_NOT_CONFIRMED:
                    return 'This Account needs confirmation';
            }
        }
}
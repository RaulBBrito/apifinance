<?php namespace App\Controllers;

use Exception;
use Config\Services;
use Firebase\JWT\JWT;

class AuthController extends BaseController {

	public function __construct()
    {
        helper('secure_password');
    }

	public function login(){
		try {
			
			$newUser = $this->request->getJSON();

			$email = $newUser->username;
			$password = $newUser->password;

			$usuarioModel = new \App\Models\UserModel();
			$where = ['email_user' => $email, 'senha_user' => $password];
			
			$validaUsuario = $usuarioModel->where($where)->first();

			if($validaUsuario == null){
				return $this->response->setJSON([
					'response'  => 'error',
					'msg'       => 'Usuario não encontrado',
			]);
			}

			if(verifyPassword($password, hasPassword($validaUsuario['senha_user']))){
				$jwt = $this->generateJWT($validaUsuario);
				return $this->response->setJSON(['token' => $jwt], 201);
			}

			return $this->response->setJSON([
				'response'  => 'success',
				'msg'       => 'Usuario encontrado',
		]);

		} catch (Exception $e) {
			return $this->response->setJSON([
				'response'  => 'error',
				'msg'       => 'Erro no Servidor',
		]);
		}
	}

	protected function generateJWT($validaUsuario){
			$Key = Services::getSecretKey();
			$time = time();
			$payload = [
				'aud' => base_url(),
				'iat' => $time,
				'exp' => $time + 60,
				'data' => [
						'nome' => $validaUsuario['nome_user'],
						'email' => $validaUsuario['email_user']
				]
			];

			$jwt = JWT::encode($payload, $Key, 'HS256');
			return $jwt;
	}
}











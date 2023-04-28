<?php 

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use Firebase\JWT\JWT;

use App\Controllers\ValidacaoUtil;
use Exception;

class AuthController extends ValidacaoUtil //ResourceController
{

	protected $format = 'json';

	public function create()
	{
		/**
		 * JWT claim types
		 * https://auth0.com/docs/tokens/concepts/jwt-claims#reserved-claims
		 */
        $userLogin = $this->request->getJSON();
		
		$email = $userLogin->email_user; //$this->request->getPost('email');
		$password = $userLogin->senha_user; //$this->request->getPost('password');
    
    
        

        $response = [
            'response'  => 'Sucesso'.$password,
            'msg'       => 'Ok Cheguei aqui'.$email
        ];
        
        //return $this->response->setJSON($response);
		

		// add code to fetch through db and check they are valid
		// sending no email and password also works here because both are empty
		if ($email === $password) {
		    $time = time();
			$key = Services::getSecretKey();
			$payload = [
				'iat' => $time,
				'exp' => $time + 60, // em segundos
				'data' => ['email'=>'admin@admin.com','name'=>'Raul']
			];

			/**
			 * IMPORTANT:
			 * You must specify supported algorithms for your application. See
			 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
			 * for a list of spec-compliant algorithms.
			 */
			$jwt = JWT::encode($payload, $key);
			//return $this->respond(['token' => $jwt], 200);
			return $this->response->setJSON($payload);
		}

		return $this->respond(['message' => 'Invalid login details'], 401);
	}
	
	protected function validadeToken($token){
	  try{
	      $key = Services::getSecretKey();
	      return JWT::decode($token,$key,array('HS256'));
	  }catch(\Exception $e){
	      return false;
	  } 
	}
	
	public function verifyToken(){
         $key = Services::getSecretKey();  
         $token = $this->request->getPost("token");
         
         if($this-validadeToken($token) == false){
             return $this->respond(['message'=>'Token Invalido'],401);
         }else{
             $data = JWT::decode($token,$key,array('HS256'));
             return $this->respond(['data'=>$data],200);
         }
	}
}











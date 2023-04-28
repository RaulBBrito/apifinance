<?php namespace App\Filters;


use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;

class AuthFilter implements FilterInterface
{

  public function before(RequestInterface $request, $arguments = null){

    try {
      $key = Services::getSecretKey();
      $authHeader = $request->getServer('HTTP_AUTHORIZATION');

      if($authHeader == null){
        return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED, 'Não foi enviado o JWT requerido!');
      }

      $arr = explode(' ', $authHeader);
      $jwt = $arr[1];

      JWT::decode($jwt, new Key($key, 'HS256'));

    }catch (SignatureInvalidException $e) {
      return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED, 'Chave padrão inválido!');
    }catch (ExpiredException $e) {
      return Services::response()->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED, 'Token expirado!');
    } catch (\Exception $e) {
      return Services::response()->setStatusCode(ResponseInterface::HTTP_INTERNAL_SERVER_ERROR, 'Ocorreu um erro no servidor para validar o token!');
    }
  }

  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null){
    try {
      
    } catch (\Exception $e) {
      
    }
  }
}
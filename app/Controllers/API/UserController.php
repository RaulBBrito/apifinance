<?php namespace App\Controllers\API;

use Exception;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController{ //ValidacaoUtil
    
    private $userModel;
    public $descricaoController = "Usuário";
    private $builder;
    
    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
        $db      = \Config\Database::connect();
        $this->builder = $db->table('tbfin_user');
    }
    
    public function list()
    {
        $usuarios = $this->userModel->findAll();
        return $this->respond($usuarios);
        //return $this->response->setJSON($this->userModel->findAll());
    }
    
    public function create()
    {
        $newUser = $this->request->getJSON();

        $response = [
            'response'  => 'error',
            'msg'       => 'Error ao criar '.$this->descricaoController,
        ];

        if(isset($newUser->nome_user) && isset($newUser->email_user) && isset($newUser->senha_user)){

            $user = new \App\Entities\User();
            $user->nome_user = $newUser->nome_user;
            $user->email_user  = $newUser->email_user;
            $user->senha_user  = $newUser->senha_user;
           
           if($this->userModel->save($user)){
            $response = [
                'response'  => 'success',
                'msg'       => $this->descricaoController.' criado com sucesso',
            ];
           }
        }

        return $this->response->setJSON($response);
        
    }
    
    public function delete($id = null){

        $response = [];
        
        if(is_null($id)){
            $response = [
                'response'  => 'error',
                'msg'       => $this->descricaoController.' não encontrado',
            ];
        }else{
            
            if($this->userModel->delete($id)){
                $response = [
                    'response'  => 'success',
                    'msg'       => $this->descricaoController.' deletado com sucesso',
                ];
            }
        }

        return $this->response->setJSON($response);
        
    }
    
    public function buscar($id = null){

        $response = [];
        
        if(is_null($id)){
            $response = [
                'response'  => 'error',
                'msg'       => $this->descricaoController.' não encontrado',
            ];
            
        }else{
            $response = $this->userModel->find($id);
        }

        return $this->response->setJSON($response);
        
    }
    
   public function update($id = null){

        $response = [
            'response'  => 'error',
            'msg'       => 'Error ao atualizar '.$this->descricaoController,
        ];

        $newUser = $this->request->getJSON();
        $user = $this->userModel->find($newUser->id_user);
      
        if(isset($user->id_user)){
            if(isset($newUser->nome_user)){ $user->nome_user = $newUser->nome_user; }
            if(isset($newUser->email_user)){ $user->email_user = $newUser->email_user; }
                
            try{
                if($this->userModel->save($user)){
                    $response = [
                        'response'  => 'success',
                        'msg'       => $this->descricaoController.' atualizado com sucesso',
                    ];
                }else{
                    $response = [
                        'response'  => 'error',
                        'msg'       => 'Erro ao cadastrar '.$this->descricaoController,
                        'errors'    => $this->userModel->errors()
                    ];
                }

            }catch(Exception $e){
                $response = [
                    'response'  => 'error',
                    'msg'       => 'Erro ao cadastrar '.$this->descricaoController,
                    'errors'    => [
                        'exception' => $e->getCode() //  $e->getMessage()
                    ]
                ];
            }

        }

        return $this->response->setJSON($response);
    }
    
    
}





















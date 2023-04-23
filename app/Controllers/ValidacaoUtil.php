<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ValidacaoUtil extends ResourceController{
    
    public $model;
    
    public function _validaToken()
    {
        return $this->request->getHeaderLine('token') == env('TOKEN');
    }
    
    public function setModel($classModel = NULL)
    {
        $this->model = $classModel;
    }
    
    public function createUtil($nameControl, $newRegister)
    {
        $response = [];
        if($this->_validaToken() == true){
            
            try{
                if($this->model->insert($newRegister)){
                    $response = [
                        'response'  => 'success',
                        'msg'       => $nameControl.' cadastrado com sucesso',
                    ];
                }else{
                    $response = [
                        'response'  => 'error',
                        'msg'       => 'Erro ao cadastra '.$nameControl,
                        'errors'    => $this->model->errors()
                    ];
                }
            }catch(Exception $e){
                $response = [
                        'response'  => 'error',
                        'msg'       => 'Erro ao cadastra '.$nameControl,
                        'errors'    => [
                            'exception' =>  $e->getMessage()
                        ]
                    ];
            }
            
        }else{
            $response = [
                'response'  => 'error',
                'msg'       => 'token inválido',
            ];
        }
        
        return $this->response->setJSON($response);
        
    }
    
    public function deleteUtil($nameControl, $id = null){
        
        $response = [];
          
        if($this->model->delete($id)){
            $response = [
                'response'  => 'success',
                'msg'       => $nameControl.' excluído com sucesso',
                ];
        }else{
            $response = [
                'response'  => 'error',
                'msg'       => 'Erro ao excluir '.$nameControl,
                'errors'    => $this->model->errors()
                ];
        }
        
        return $this->response->setJSON($response);
    }
    
    public function buscarUtil($nameControl, $id = null){
        
        if(is_null($id)){
            $response = [
                'response'  => 'error',
                'msg'       => $nameControl.' não encontrado',
            ];
            return $this->response->setJSON($response);
        }else{
            return $this->response->setJSON($this->model->find($id));
        }
        
    }
    
}
<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use Exception;

class CartaoController extends ResourceController{
    
    private $cartaoModel;
    public $descricaoController = "Cartão";
    
    public function __construct()
    {
        $this->cartaoModel = new \App\Models\CartaoModel();
    }
    
    public function list()
    {
        return $this->response->setJSON($this->cartaoModel->findAll());
       
    }
    
    public function create()
    {

        $newCartao = $this->request->getJSON();

        $response = [
            'response'  => 'error',
            'msg'       => 'Error ao criar '.$this->descricaoController,
        ];

        if(isset($newCartao->desc_cartao) && isset($newCartao->num_final_cartao)){
            $cartao = new \App\Entities\Cartao();
            $cartao->desc_cartao = $newCartao->desc_cartao;
            $cartao->num_final_cartao = $newCartao->num_final_cartao;
            $cartao->data_venc_cartao = (isset($newCartao->data_venc_cartao)) ? $newCartao->data_venc_cartao : null; 
            $cartao->data_corte_cartao =  (isset($newCartao->data_corte_cartao)) ? $newCartao->data_corte_cartao : null;
            $cartao->bandeira_cartao =  (isset($newCartao->bandeira_cartao)) ? $newCartao->bandeira_cartao : null;
            $cartao->vlr_limite_cartao =  (isset($newCartao->vlr_limite_cartao)) ? $newCartao->vlr_limite_cartao : null;

            if($this->cartaoModel->save($cartao)){
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
        
        if(is_null($id) || !is_numeric($id)){
            $response = [
                'response'  => 'error',
                'msg'       => $this->descricaoController.' não encontrado',
            ];
        }else{
            
            if($this->cartaoModel->delete($id)){
                $response = [
                    'response'  => 'success',
                    'msg'       => $this->descricaoController.' deletado com sucesso',
                ];
            }
        }

        return $this->response->setJSON($response);
       
        
    }
    
    //Retornar esse ponto
    public function buscar($id = null){
        
        $response = [];
        
        if(is_null($id)){
            $response = [
                'response'  => 'error',
                'msg'       => $this->descricaoController.' não encontrado',
            ];
            
        }else{
            $response = $this->cartaoModel->find($id);
        }

        return $this->response->setJSON($response);
        
    }
    
    public function update($id = null){
       
       $newCartao = $this->request->getJSON();

       $response = [
        'response'  => 'error',
        'msg'       => 'Error ao atualizar '.$this->descricaoController,
        ];

    if(isset($newCartao->id_cartao)){
        $cartao = $this->cartaoModel->find($newCartao->id_cartao);
    
        if(isset($cartao->id_cartao)){
            if(isset($newCartao->desc_cartao)){ $cartao->desc_cartao = $newCartao->desc_cartao; }
            if(isset($newCartao->num_final_cartao)) $cartao->num_final_cartao = $newCartao->num_final_cartao; 
            if(isset($newCartao->data_venc_cartao)) $cartao->data_venc_cartao = $newCartao->data_venc_cartao; 
            if(isset($newCartao->data_corte_cartao)) $cartao->data_corte_cartao = $newCartao->data_corte_cartao; 
            if(isset($newCartao->bandeira_cartao)) $cartao->bandeira_cartao = $newCartao->bandeira_cartao; 
            if(isset($newCartao->vlr_limite_cartao)) $cartao->vlr_limite_cartao = $newCartao->vlr_limite_cartao;

            try{
                if($this->cartaoModel->save($cartao)){
                    $response = [
                        'response'  => 'success',
                        'msg'       => $this->descricaoController.' atualizado com sucesso',
                    ];
                }else{
                    $response = [
                        'response'  => 'error',
                        'msg'       => 'Erro ao cadastrar '.$this->descricaoController,
                        'errors'    => $this->model->errors()
                    ];
                }
            }catch(Exception $e){
                $response = [
                    'response'  => 'error',
                    'msg'       => 'Erro ao cadastrar '.$this->descricaoController,
                    'errors'    => [
                        'exception' =>  $e->getMessage()
                    ]
                ];
            }
        }
    }

    return $this->response->setJSON($response);
        
    }
    
    
}
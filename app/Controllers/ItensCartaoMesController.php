<?php

namespace App\Controllers;

use App\Controllers\ValidacaoUtil;
use Exception;

class ItensCartaoMesController extends ValidacaoUtil{
    
    private $itensCartaoMesModel;
    public $descricaoController = "Itens Cartão Mês";
    
    public function __construct()
    {
        $this->itensCartaoMesModel = new \App\Models\ItensCartaoMesModel();
    }
    
    public function list()
    {        
        return $this->response->setJSON($this->itensCartaoMesModel->findAll());
    }
    
    public function create()
    {
        $newItensCartaoMes = $this->request->getJSON();

        $response = [
            'response'  => 'error',
            'msg'       => 'Error ao criar '.$this->descricaoController,
        ];

        if(isset($newItensCartaoMes->id_cartao)
            && isset($newItensCartaoMes->dt_venc_itens_cartao_mes)){

            $itensCartaoMes = new \App\Entities\ItensCartaoMes();
            $itensCartaoMes->id_cartao = $newItensCartaoMes->id_cartao;
            $itensCartaoMes->dt_venc_itens_cartao_mes  = $newItensCartaoMes->dt_venc_itens_cartao_mes;
            if(isset($newItensCartaoMes->vlr_t_itens_mes)){ $itensCartaoMes->vlr_t_itens_mes = $newItensCartaoMes->vlr_t_itens_mes; }
           
           if($this->itensCartaoMesModel->save($itensCartaoMes)){
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
            
            if($this->itensCartaoMesModel->delete($id)){
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
            $response = $this->itensCartaoMesModel->find($id);
        }

        return $this->response->setJSON($response);
        
    }
    
     public function update($id = null){
       
        $response = [
            'response'  => 'error',
            'msg'       => 'Error ao atualizar '.$this->descricaoController,
        ];

        $newItensCartaoMes = $this->request->getJSON();
        $itensCartaoMes = $this->itensCartaoMesModel->find($newItensCartaoMes->id_itens_cartao_mes);
      
        if(isset($itensCartaoMes->id_itens_cartao_mes)){
            if(isset($newItensCartaoMes->vlr_t_itens_mes)){ $itensCartaoMes->vlr_t_itens_mes = $newItensCartaoMes->vlr_t_itens_mes; }
            if(isset($newItensCartaoMes->dt_venc_itens_cartao_mes)){ $itensCartaoMes->dt_venc_itens_cartao_mes = $newItensCartaoMes->dt_venc_itens_cartao_mes; }
            if(isset($newItensCartaoMes->id_cartao)){ $itensCartaoMes->id_cartao = $newItensCartaoMes->id_cartao; }
            if(isset($newItensCartaoMes->status_pag_itens_cartao_mes)){ $itensCartaoMes->status_pag_itens_cartao_mes = $newItensCartaoMes->status_pag_itens_cartao_mes; }
                
            try{
                if($this->itensCartaoMesModel->save($itensCartaoMes)){
                    $response = [
                        'response'  => 'success',
                        'msg'       => $this->descricaoController.' atualizado com sucesso',
                    ];
                }else{
                    $response = [
                        'response'  => 'error',
                        'msg'       => 'Erro ao cadastrar '.$this->descricaoController,
                        'errors'    => $this->itensCartaoMesModel->errors()
                    ];
                }

            }catch(Exception $e){
                $response = [
                    'response'  => 'error',
                    'msg'       => 'Erro ao cadastrar '.$this->descricaoController,
                    'errors'    => [
                        'exception' => $e->getMessage()
                    ]
                ];
            }

        }

        return $this->response->setJSON($response);
    }
    
}
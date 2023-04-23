<?php

namespace App\Controllers;

use App\Controllers\ValidacaoUtil;
use Exception;

class ItensMesController extends ValidacaoUtil{
    
    private $itensMesModel;
    public $descricaoController = "Itens Mês";
    
    public function __construct()
    {
        $this->itensMesModel = new \App\Models\ItensMesModel();
    }
    
    public function list()
    {
       return $this->response->setJSON($this->itensMesModel->findAll());
    }
    
    public function create()
    {
        /*$newItensMes['desc_itens_mes'] = $this->request->getPost('descricaoItem');
        $newItensMes['vlr_itens_mes'] = $this->request->getPost('valorItem');
        $newItensMes['data_venc_itens_mes'] = $this->request->getPost('dataVencimento');
        $newItensMes['data_pag_itens_mes'] = $this->request->getPost('dataPagamento');
        $newItensMes['id_tipo_item_mes'] = $this->request->getPost('codigoTipoItem');
        $newItensMes['id_recurso_itens'] = $this->request->getPost('codigoRecurso');
        $newItensMes['id_cartao'] = $this->request->getPost('codigoCartao');
        $newItensMes['status_pag_itens_mes'] = $this->request->getPost('statusPagamento');
        
        $this->setModel($this->itensMesModel);
        
        return $this->createUtil($this->descricaoController, $newItensMes);*/

        $newItensMes = $this->request->getJSON();

        $response = [
            'response'  => 'error',
            'msg'       => 'Error ao criar '.$this->descricaoController,
        ];

        if(isset($newItensMes->desc_itens_mes)
            && isset($newItensMes->data_venc_itens_mes)
            && isset($newItensMes->id_tipo_item_mes)
            && isset($newItensMes->id_recurso_itens)){

            $itensMes = new \App\Entities\ItensMes();
            $itensMes->desc_itens_mes = $newItensMes->desc_itens_mes;
            $itensMes->data_venc_itens_mes  = $newItensMes->data_venc_itens_mes;

            $itensMes->id_tipo_item_mes = $newItensMes->id_tipo_item_mes;
            $itensMes->id_recurso_itens  = $newItensMes->id_recurso_itens;

            if(isset($newItensMes->vlr_itens_mes)){ $itensMes->vlr_itens_mes = $newItensMes->vlr_itens_mes; }
            if(isset($newItensMes->data_pag_itens_mes)){ $itensMes->data_pag_itens_mes = $newItensMes->data_pag_itens_mes; }
            if(isset($newItensMes->id_cartao)){ $itensMes->id_cartao = $newItensMes->id_cartao; }
            if(isset($newItensMes->status_pag_itens_mes)){ $itensMes->status_pag_itens_mes = $newItensMes->status_pag_itens_mes; }
           
           if($this->itensMesModel->save($itensMes)){
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
            
            if($this->itensMesModel->delete($id)){
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
            $response = $this->itensMesModel->find($id);
        }

        return $this->response->setJSON($response);
        
    }
    
      public function update($id = null){

        $response = [
            'response'  => 'error',
            'msg'       => 'Error ao atualizar '.$this->descricaoController,
        ];

        $newItensMes = $this->request->getJSON();
        $itensMes = $this->itensMesModel->find($newItensMes->id_itens_mes);
      
        if(isset($itensMes->id_itens_mes)){

            if(isset($newItensMes->desc_itens_mes)){ $itensMes->desc_itens_mes = $newItensMes->desc_itens_mes; }
            if(isset($newItensMes->vlr_itens_mes)){ $itensMes->vlr_itens_mes = $newItensMes->vlr_itens_mes; }
            if(isset($newItensMes->data_venc_itens_mes)){ $itensMes->data_venc_itens_mes = $newItensMes->data_venc_itens_mes; }
            if(isset($newItensMes->data_pag_itens_mes)){ $itensMes->data_pag_itens_mes = $newItensMes->data_pag_itens_mes; }
            if(isset($newItensMes->id_tipo_item_mes)){ $itensMes->id_tipo_item_mes = $newItensMes->id_tipo_item_mes; }
            if(isset($newItensMes->id_recurso_itens)){ $itensMes->id_recurso_itens = $newItensMes->id_recurso_itens; }
            if(isset($newItensMes->id_cartao)){ $itensMes->id_cartao = $newItensMes->id_cartao; }
            if(isset($newItensMes->status_pag_itens_mes)){ $itensMes->status_pag_itens_mes = $newItensMes->status_pag_itens_mes; }
                
            try{
                if($this->itensMesModel->save($itensMes)){
                    $response = [
                        'response'  => 'success',
                        'msg'       => $this->descricaoController.' atualizado com sucesso',
                    ];
                }else{
                    $response = [
                        'response'  => 'error',
                        'msg'       => 'Erro ao cadastrar '.$this->descricaoController,
                        'errors'    => $this->itensMesModel->errors()
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
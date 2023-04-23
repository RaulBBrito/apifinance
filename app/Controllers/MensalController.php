<?php

namespace App\Controllers;

use App\Controllers\ValidacaoUtil;
use Exception;

class MensalController extends ValidacaoUtil{
    
    private $mensalModel;
    public $descricaoController = "Mensal"; 
    
    public function __construct()
    {
        $this->mensalModel = new \App\Models\MensalModel();
    }
    
    public function list()
    {
        return $this->response->setJSON($this->mensalModel->findAll());
    }
    
    public function create()
    {
        $newMensal = $this->request->getJSON();

        $response = [
            'response'  => 'error',
            'msg'       => 'Error ao criar '.$this->descricaoController,
        ];

        if(isset($newMensal->data_mes_ano_mensal)
            && isset($newMensal->id_user)){

            $mensal = new \App\Entities\Mensal();
            $mensal->data_mes_ano_mensal = $newMensal->data_mes_ano_mensal;
            $mensal->id_user = $newMensal->id_user;

            if(isset($newMensal->vlrt_renda_mensal)){ $mensal->vlrt_renda_mensal = $newMensal->vlrt_renda_mensal; }
            if(isset($newMensal->vlrt_despesa_mensal)){ $mensal->vlrt_despesa_mensal = $newMensal->vlrt_despesa_mensal; }
            if(isset($newMensal->vlrt_cartao_mensal)){ $mensal->vlrt_cartao_mensal = $newMensal->vlrt_cartao_mensal; }
            if(isset($newMensal->vlr_saldo_conta_mensal)){ $mensal->vlr_saldo_conta_mensal = $newMensal->vlr_saldo_conta_mensal; }
           
           if($this->mensalModel->save($mensal)){
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
            
            if($this->mensalModel->delete($id)){
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
            $response = $this->mensalModel->find($id);
        }

        return $this->response->setJSON($response);
        
    }
    
    public function update($id = null){
       
        $response = [
            'response'  => 'error',
            'msg'       => 'Error ao atualizar '.$this->descricaoController,
        ];

        $newMensal = $this->request->getJSON();
        $mensal = $this->mensalModel->where('id_user',$newMensal->id_user)->find($newMensal->id_mensal);
      
        if(isset($mensal->id_mensal)){
                
            if(isset($newMensal->data_mes_ano_mensal)){ $mensal->data_mes_ano_mensal = $newMensal->data_mes_ano_mensal; }
            if(isset($newMensal->vlrt_renda_mensal)){ $mensal->vlrt_renda_mensal = $newMensal->vlrt_renda_mensal; }
            if(isset($newMensal->vlrt_despesa_mensal)){ $mensal->vlrt_despesa_mensal = $newMensal->vlrt_despesa_mensal; }
            if(isset($newMensal->vlrt_cartao_mensal)){ $mensal->vlrt_cartao_mensal = $newMensal->vlrt_cartao_mensal; }
            if(isset($newMensal->vlr_saldo_conta_mensal)){ $mensal->vlr_saldo_conta_mensal = $newMensal->vlr_saldo_conta_mensal; }
                
            try{
                if($this->mensalModel->save($mensal)){
                    $response = [
                        'response'  => 'success',
                        'msg'       => $this->descricaoController.' atualizado com sucesso',
                    ];
                }else{
                    $response = [
                        'response'  => 'error',
                        'msg'       => 'Erro ao cadastrar '.$this->descricaoController,
                        'errors'    => $this->mensalModel->errors()
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

    public function getDadosMensal(){
        $dados = $this->request->getJSON();

        $mensal = $this->mensalModel->where('id_user',$dados->id_user)->find($dados->id_user);


    }
    
}